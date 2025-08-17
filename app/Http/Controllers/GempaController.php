<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GempaBumi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreGempabumiRequest;
use App\Http\Requests\UpdateGempabumiRequest;
use Mews\Purifier\Facades\Purifier;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class GempaController extends Controller
{

    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 10);

        $query = GempaBumi::query()
            ->when($request->filled('filter_start') && $request->filled('filter_end'), function ($q) use ($request) {
                return $q->whereBetween('tanggal', [$request->filter_start, $request->filter_end]);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                return $q->where('jarak', 'like', '%' . $request->search . '%');
            });

        // 🔽 Sorting pakai switch
        switch ($request->get('sort')) {
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // default: terbaru
        }

        if ($perPage === 'all') {
            $datagempa = $query->get();
        } else {
            $datagempa = $query->paginate($perPage)->appends($request->query());
        }

        return view('pages.gempabumi.index', compact('datagempa'), ['type_menu' => '']);
    }



    public function create()
    {
        return view('pages.gempabumi.create',  ['type_menu' => '']);
    }

    public function store(StoreGempabumiRequest $request)
    {
        // Validasi
        $data = $request->validated();

        // Konversi tanggal dan waktu
        $data['tanggal'] = Carbon::createFromFormat('d-M-y', $data['tanggal'])->format('Y-m-d');
        $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');

        // Generate waktuUtc dari waktu (dalam zona WIB → UTC, minus 7 jam)
        $data['waktu_utc'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        // Konversi lintang
        if (preg_match('/([\d.]+)\s*(LU|LS)/i', $data['lintang'], $match)) {
            $nilaiLintang = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['lintang'] = $arah === 'LU' ? $nilaiLintang : -$nilaiLintang;
        }

        // Konversi bujur
        if (preg_match('/([\d.]+)\s*(BT|BB)/i', $data['bujur'], $match)) {
            $nilaiBujur = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['bujur'] = $arah === 'BT' ? $nilaiBujur : -$nilaiBujur;
        }

        GempaBumi::create($data);
        return redirect()->route('gempabumi.index')->with('success', 'Data gempa berhasil disimpan!');
    }


    public function edit($id)
    {
        $users = User::all();
        $datagempa = GempaBumi::findOrFail($id);
        return view('pages.gempabumi.edit', compact('datagempa', 'users'),  ['type_menu' => '']);
    }

    public function update(UpdateGempabumiRequest $request, GempaBumi $gempabumi)
    {
        $data = $request->validated();

        // Konversi tanggal dan waktu
        // $data['tanggal'] = Carbon::createFromFormat('d/m/Y', $data['tanggal'])->format('Y-m-d');
        $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');
        // Generate waktu_utc dari waktu (dalam zona WIB → UTC, minus 7 jam)
        $data['waktu_utc'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        $data['keterangan'] = Purifier::clean($request->input('keterangan'));

        $gempabumi->update($data);
        return redirect()->route('gempabumi.index')->with('success', 'Data Parameter Gempabumi Berhasil Diperbaharui');
    }

    public function destroy(GempaBumi $gempabumi)
    {
        $gempabumi->delete();
        return redirect()->route('gempabumi.index')->with('success', 'Data Paremeter Gempabumi Berhasil Dihapus');
    }

    public function destroyBatch(Request $request)
    {
        $ids = $request->id;

        if (!is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Format ID tidak sesuai.'
            ]);
        }

        GempaBumi::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data gempa berhasil dihapus.'
        ]);
    }

    public function infografiss(Request $request)
    {
        \Carbon\Carbon::setLocale('id');

        $ids = explode(',', $request->ids);
        $data = GempaBumi::whereIn('id', $ids)->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc')->get();
        $startDate = $data->min('tanggal');
        $endDate = $data->max('tanggal');


        return view('pages.gempabumi.infografis', compact('data', 'startDate', 'endDate'));
    }

    public function createOnedata()
    {
        return view('pages.gempabumi.createOnedata',  ['type_menu' => '']);
    }


    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('uploads');
        $fullPath = Storage::path($path);

        // Header yang diharapkan (key => nama database)
        $expectedHeaders = [
            'tanggal'       => 'tanggal',
            'waktu'   => 'waktu',
            'waktu (utc)'   => 'waktu_utc',
            'waktu (wita)'  => 'waktu_wita',
            'magnitudo'     => 'magnitudo',
            'lintang'       => 'lintang',
            'bujur'         => 'bujur',
            'jarak'         => 'jarak',
            'kedalaman'     => 'kedalaman',
            'dirasakan'     => 'dirasakan',
            'keterangan'    => 'keterangan',
        ];

        try {
            $reader = SimpleExcelReader::create($fullPath);
            $headersFromFile = array_map('strtolower', array_map('trim', $reader->getHeaders()));

            // Cek apakah semua kolom yang dibutuhkan ada
            $missingHeaders = array_diff(array_keys($expectedHeaders), $headersFromFile);
            if (!empty($missingHeaders)) {
                return back()->with('error', 'Format Excel tidak sesuai. Kolom hilang: ' . implode(', ', $missingHeaders));
            }

            $inserted = 0;
            $skipped = 0;

            $reader->getRows()->each(function (array $row) use ($expectedHeaders, &$inserted, &$skipped) {
                // Mapping nama kolom file -> field DB
                $data = [];
                foreach ($expectedHeaders as $headerName => $dbField) {
                    $data[$dbField] = $row[$headerName] ?? null;
                }

                // Cek duplikat
                $exists = GempaBumi::where('tanggal', $data['tanggal'])
                    ->where('magnitudo', $data['magnitudo'])
                    ->where('lintang', $data['lintang'])
                    ->where('bujur', $data['bujur'])
                    ->exists();

                if (!$exists) {
                    GempaBumi::create($data);
                    $inserted++;
                } else {
                    $skipped++;
                }
            });

            return back()->with('success', "Import selesai. {$inserted} data ditambahkan, {$skipped} duplikat di-skip.");
        } catch (\Exception $e) {
            Log::error('Import Excel error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membaca file.');
        }
    }
}
