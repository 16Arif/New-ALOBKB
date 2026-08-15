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
use App\Http\Traits\GempaFilterTrait;


class GempaController extends Controller
{
    use GempaFilterTrait;

    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 10);

        $query = $this->applyGempaFilters($request);
        $this->applyGempaSorting($query, $request);

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

        // Konversi dan bersihkan lintang & bujur
        $lintang = $this->parseCoordinate($data['lintang'], false);
        $bujur = $this->parseCoordinate($data['bujur'], true);

        // Koreksi otomatis jika data lintang & bujur tertukar
        if (abs($lintang) > abs($bujur)) {
            $temp = $lintang;
            $lintang = $bujur;
            $bujur = $temp;
        }

        $data['lintang'] = $lintang;
        $data['bujur'] = $bujur;

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

        // Konversi dan bersihkan lintang & bujur saat update
        $lintang = $this->parseCoordinate($data['lintang'], false);
        $bujur = $this->parseCoordinate($data['bujur'], true);

        // Koreksi otomatis jika data lintang & bujur tertukar
        if (abs($lintang) > abs($bujur)) {
            $temp = $lintang;
            $lintang = $bujur;
            $bujur = $temp;
        }

        $data['lintang'] = $lintang;
        $data['bujur'] = $bujur;

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
                        // Cari key di $row yang jika di-trim dan di-lowercase cocok dengan $headerName
                        $val = null;
                        foreach ($row as $key => $value) {
                            if (strtolower(trim($key)) === $headerName) {
                                $val = $value;
                                break;
                            }
                        }

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

                    // Bersihkan dan koreksi koordinat dari Excel
                    $lintang = $this->parseCoordinate($data['lintang'], false);
                    $bujur = $this->parseCoordinate($data['bujur'], true);

                    // Koreksi otomatis jika kolom tertukar
                    if (abs($lintang) > abs($bujur)) {
                        $temp = $lintang;
                        $lintang = $bujur;
                        $bujur = $temp;
                    }

                    $data['lintang'] = $lintang;
                    $data['bujur'] = $bujur;

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

    /**
     * Membersihkan dan memformat koordinat menjadi float desimal standar.
     * Mendukung auto-koreksi ribuan/ratusan ribuan akibat ribuan separator Excel terhapus.
     */
    private function parseCoordinate($val, $isLongitude = false)
    {
        if ($val === null || $val === '') {
            return null;
        }

        $str = trim((string)$val);

        // Deteksi arah mata angin untuk menentukan tanda negatif (-)
        $sign = 1;
        if (preg_match('/(LS|S|BB|W)/i', $str)) {
            $sign = -1;
        }

        // Hapus karakter non-numerik kecuali angka, titik, koma, dan minus
        $clean = preg_replace('/[^\d.,-]/', '', $str);

        if (str_starts_with($clean, '-')) {
            $sign = -1;
            $clean = ltrim($clean, '-');
        }

        // Ubah koma desimal menjadi titik desimal
        $clean = str_replace(',', '.', $clean);

        // Jika terdapat lebih dari satu titik desimal (pemisah ribuan ganda)
        $dotCount = substr_count($clean, '.');
        if ($dotCount > 1) {
            $clean = str_replace('.', '', $clean);
        }

        $num = (float)$clean;

        // Koreksi pergeseran desimal jika nilai merupakan integer besar (akibat thousands separator)
        if ($isLongitude) {
            if (abs($num) > 180.0) {
                $temp = abs($num);
                while ($temp > 180.0) {
                    $temp /= 10;
                }
                $num = $temp;
            }
        } else {
            if (abs($num) >= 10.0) {
                $temp = abs($num);
                while ($temp >= 10.0) {
                    $temp /= 10;
                }
                $num = $temp;
            }
        }

        return round($num * $sign, 5);
    }
}
