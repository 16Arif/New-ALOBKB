<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GempaBumi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreGempabumiRequest;
use App\Http\Requests\UpdateGempabumiRequest;
use Mews\Purifier\Facades\Purifier;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class GempaController extends Controller
{

    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 10);

        $query = GempaBumi::query()
            ->when($request->filled('filter_start') && $request->filled('filter_end'), function ($q) use ($request) {
                return $q->whereBetween('tanggal', [$request->filter_start, $request->filter_end]);
            })
            ->when($request->filled('filter_provinsi'), function ($q) use ($request) {
                $prov = $request->filter_provinsi;
                
                $provMap = [
                    'KALBAR' => '61',
                    'KALTENG' => '62',
                    'KALSEL' => '63',
                    'KALTIM' => '64',
                    'KALTARA' => '65',
                ];

                if (isset($provMap[$prov])) {
                    $kodeProv = $provMap[$prov];
                    return $q->whereRaw("ST_Contains(
                        (SELECT geom FROM provinsi_borders WHERE kode_prov = ? LIMIT 1),
                        ST_GeomFromText(CONCAT('POINT(', CAST(bujur AS DOUBLE), ' ', CAST(lintang AS DOUBLE), ')'))
                    )", [$kodeProv]);
                } elseif ($prov === 'LAINNYA') {
                    return $q->whereRaw("NOT EXISTS (
                        SELECT 1 FROM provinsi_borders 
                        WHERE ST_Contains(
                            provinsi_borders.geom,
                            ST_GeomFromText(CONCAT('POINT(', CAST(gempa_bumis.bujur AS DOUBLE), ' ', CAST(gempa_bumis.lintang AS DOUBLE), ')'))
                        )
                    )");
                }
            })
            ->when($request->filled('filter_kab_kota'), function ($q) use ($request) {
                $kodeKk = $request->filter_kab_kota;
                return $q->whereRaw("ST_Contains(
                    (SELECT geom FROM kab_kota_borders WHERE kode_kk = ? LIMIT 1),
                    ST_GeomFromText(CONCAT('POINT(', CAST(bujur AS DOUBLE), ' ', CAST(lintang AS DOUBLE), ')'))
                )", [$kodeKk]);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                return $q->where('jarak', 'like', '%' . $request->search . '%');
            });

        // 🔽 Sorting pakai switch
        switch ($request->get('sort')) {
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc')->orderBy('waktu', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // default: terbaru berdasarkan ID input
        }

        if ($perPage === 'all') {
            $datagempa = $query->get();
        } else {
            $datagempa = $query->paginate($perPage)->appends($request->query());
        }

        $listKabKota = DB::table('kab_kota_borders')
            ->select('kode_kk', 'nama_kab_kota', 'kode_prov')
            ->orderBy('nama_kab_kota', 'asc')
            ->get()
            ->groupBy('kode_prov');

        return view('pages.gempabumi.index', compact('datagempa', 'listKabKota'), ['type_menu' => '']);
    }



    public function create()
    {
        return view('pages.gempabumi.create5',  ['type_menu' => '']);
    }

    public function store(StoreGempabumiRequest $request)
    {
        // Validasi
        $data = $request->validated();

        // Konversi tanggal dan waktu
        $data['tanggal'] = Carbon::createFromFormat('d-M-y', $data['tanggal'])->format('Y-m-d');
        $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');

        // Generate waktuUtc dari waktu (dalam zona WIB → UTC, minus 7 jam)
        $data['waktu_utc'] = Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        // Konversi lintang (mendukung koma desimal)
        $lintangRaw = str_replace(',', '.', $data['lintang']);
        if (preg_match('/([\d.-]+)\s*(LU|LS)/i', $lintangRaw, $match)) {
            $nilaiLintang = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['lintang'] = $arah === 'LU' ? $nilaiLintang : -$nilaiLintang;
        } else {
            $data['lintang'] = $lintangRaw;
        }

        // Konversi bujur (mendukung koma desimal)
        $bujurRaw = str_replace(',', '.', $data['bujur']);
        if (preg_match('/([\d.-]+)\s*(BT|BB)/i', $bujurRaw, $match)) {
            $nilaiBujur = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['bujur'] = $arah === 'BT' ? $nilaiBujur : -$nilaiBujur;
        } else {
            $data['bujur'] = $bujurRaw;
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
        $data['waktu_utc'] = Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        // Konversi lintang (mendukung koma desimal) saat update
        $lintangRaw = str_replace(',', '.', $data['lintang']);
        if (preg_match('/([\d.-]+)\s*(LU|LS)/i', $lintangRaw, $match)) {
            $nilaiLintang = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['lintang'] = $arah === 'LU' ? $nilaiLintang : -$nilaiLintang;
        } else {
            $data['lintang'] = $lintangRaw;
        }

        // Konversi bujur (mendukung koma desimal) saat update
        $bujurRaw = str_replace(',', '.', $data['bujur']);
        if (preg_match('/([\d.-]+)\s*(BT|BB)/i', $bujurRaw, $match)) {
            $nilaiBujur = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['bujur'] = $arah === 'BT' ? $nilaiBujur : -$nilaiBujur;
        } else {
            $data['bujur'] = $bujurRaw;
        }

        $data['keterangan'] = Purifier::clean($request->input('keterangan'));
        $data['dirasakan'] = $request->input('dirasakan');

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
        $confirmation = $request->input('confirmation');

        if (!is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Format ID tidak sesuai.'
            ]);
        }

        if ($confirmation !== 'Saya yakin menghapus data gempa yang dipilih') {
            return response()->json([
                'success' => false,
                'message' => 'Konfirmasi kalimat tidak valid.'
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
        Carbon::setLocale('id');

        $ids = explode(',', $request->ids);
        $data = GempaBumi::whereIn('id', $ids)->orderBy('tanggal', 'desc')->orderBy('waktu', 'desc')->get();
        $startDate = $data->min('tanggal');
        $endDate = $data->max('tanggal');


        return view('pages.gempabumi.infografis3', compact('data', 'startDate', 'endDate'));
    }

    public function createOnedata()
    {
        return view('pages.gempabumi.createOnedata',  ['type_menu' => '']);
    }

    public function createOneInfographic(Request $request)
    {
        // Mengambil satu ID saja dari request
        $id = $request->ids;

        // Mencari data atau error 404 jika ID tidak ada
        $gempa = GempaBumi::findOrFail($id);

        return view('pages.gempabumi.createOneInfographic', compact('gempa'));
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

            DB::transaction(function () use ($reader, $expectedHeaders, &$inserted, &$skipped) {
                $reader->getRows()->each(function (array $row) use ($expectedHeaders, &$inserted, &$skipped) {
                    // Mapping nama kolom file -> field DB
                    $data = [];
                    foreach ($expectedHeaders as $headerName => $dbField) {
                        $val = $row[$headerName] ?? null;

                        // Batasi panjang karakter untuk kolom bertipe string agar tidak melebihi kapasitas database
                        if (is_string($val)) {
                            if (in_array($dbField, ['dirasakan', 'keterangan'])) {
                                $val = mb_substr($val, 0, 65535);
                            } elseif (in_array($dbField, ['jarak', 'lintang', 'bujur', 'magnitudo', 'kedalaman'])) {
                                $val = mb_substr($val, 0, 255);
                            }
                        }

                        $data[$dbField] = $val;
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
            });

            return back()->with('success', "Import selesai. {$inserted} data ditambahkan, {$skipped} duplikat di-skip.");
        } catch (\Exception $e) {
            Log::error('Import Excel error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membaca file: ' . $e->getMessage());
        }
    }
}
