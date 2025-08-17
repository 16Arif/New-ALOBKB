<?php

namespace App\Http\Controllers;

use App\Models\LogbookGempa;
use App\Models\LogbookPeralatan;
use App\Models\LogbookPetir;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportController extends Controller
{
    public function spatie_petir(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('uploads');
        $fullPath = Storage::path($path);

        // Header yang diharapkan (key = nama kolom di file, value = nama field DB)
        $expectedHeaders = [
            'tanggal'        => 'tanggal',
            'jam (wita)'     => 'jam',
            'on duty 1'      => 'onduty1',
            'on duty 2'      => 'onduty2',
            'on duty 3'      => 'onduty3',
            'pengamatan 1'   => 'pengamatan1',
            'pengamatan 2'   => 'pengamatan2',
            'pengamatan 3'   => 'pengamatan3',
            'pengamatan 4'   => 'pengamatan4',
            'pengamatan 5'   => 'pengamatan5',
            'pengamatan 6'   => 'pengamatan6',
            'pengamatan 7'   => 'pengamatan7',
            'kondisi'        => 'kondisi',
            'tugas tambahan' => 'note',
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
                $data = [];
                foreach ($expectedHeaders as $headerName => $dbField) {
                    $data[$dbField] = $row[$headerName] ?? null;
                }

                // Cek duplikat berdasarkan tanggal + jam
                $exists = LogbookPetir::where('tanggal', $data['tanggal'])
                    ->where('jam', $data['jam'])
                    ->exists();

                if (!$exists) {
                    LogbookPetir::create($data);
                    $inserted++;
                } else {
                    $skipped++;
                }
            });

            return back()->with('success', "Import selesai. {$inserted} data ditambahkan, {$skipped} duplikat di-skip.");
        } catch (\Exception $e) {
            Log::error('Import Excel Logbook Petir error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membaca file.');
        }
    }


    public function spatie_gempa(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('uploads');
        $fullPath = Storage::path($path);

        // Header yang diharapkan (key = nama kolom di file, value = nama field DB)
        $expectedHeaders = [
            'tanggal'        => 'tanggal',
            'jam (wita)'     => 'jam',
            'on duty 1'      => 'onduty1',
            'on duty 2'      => 'onduty2',
            'on duty 3'      => 'onduty3',
            'kegiatan 1'    => 'kegiatan1',
            'kegiatan 2'    => 'kegiatan2',
            'monitoring 1'  => 'monitoring1',
            'berita 1'      => 'berita1',
            'monitoring 2'  => 'monitoring2',
            'berita 2'      => 'berita2',
            'kondisi'        => 'kondisi',
            'tugas tambahan' => 'note',
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
                $data = [];
                foreach ($expectedHeaders as $headerName => $dbField) {
                    $data[$dbField] = $row[$headerName] ?? null;
                }

                // Cek duplikat berdasarkan tanggal + jam
                $exists = LogbookGempa::where('tanggal', $data['tanggal'])
                    ->where('jam', $data['jam'])
                    ->exists();

                if (!$exists) {
                    LogbookGempa::create($data);
                    $inserted++;
                } else {
                    $skipped++;
                }
            });

            return back()->with('success', "Import selesai. {$inserted} data ditambahkan, {$skipped} duplikat di-skip.");
        } catch (\Exception $e) {
            Log::error('Import Excel Logbook Gempabumi error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membaca file.');
        }
    }

    public function spatie_peralatan(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $request->file('file')->store('uploads');
        $fullPath = Storage::path($path);

        // Header yang diharapkan (key = nama kolom di file, value = nama field DB)
        $expectedHeaders = [
            'tanggal'        => 'tanggal',
            'jam (wita)'     => 'jam',
            'on duty 1'      => 'onduty1',
            'on duty 2'      => 'onduty2',
            'on duty 3'      => 'onduty3',
            'fingerprint' => 'fingerprint',
            'tds' => 'tds',
            'nexstorm' => 'nexstorm',
            'obs nexstorm' => 'obs_nexstorm',
            'cmss' => 'cmss',
            'monitoring' => 'monitoring',
            'accelerograf' => 'acc',
            'wrs ng' => 'wrsng',
            'integrasi data' => 'integrasi_data',
            'seiscomp' => 'seiscomp4',
            'pc magnet' => 'pc_magnet',
            'monitor zoom' => 'monitor_zoom',
            'internet ops' => 'internet_ops',
            'internet lokal' => 'internet_lokal',
            'shakemap' => 'shakemap',
            'seiscomp regional' => 'seiscomp_reg',
            'pc qc seiscomp' => 'qc_seiscomp',
            'monitor simap' => 'monitor_simap',
            'pc workstation simap' => 'ws_simap',
            'bkb server' => 'bkb_server',
            'penakar hujan' => 'penakar_hujan',
            'radio ssb' => 'radio_ssb',
            'tugas tambahan' => 'note',
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
                $data = [];
                foreach ($expectedHeaders as $headerName => $dbField) {
                    $data[$dbField] = $row[$headerName] ?? null;
                }

                // Cek duplikat berdasarkan tanggal + jam
                $exists = LogbookPeralatan::where('tanggal', $data['tanggal'])
                    ->where('jam', $data['jam'])
                    ->exists();

                if (!$exists) {
                    LogbookPeralatan::create($data);
                    $inserted++;
                } else {
                    $skipped++;
                }
            });

            return back()->with('success', "Import selesai. {$inserted} data ditambahkan, {$skipped} duplikat di-skip.");
        } catch (\Exception $e) {
            Log::error('Import Excel Logbook Peralatan error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membaca file.');
        }
    }
}
