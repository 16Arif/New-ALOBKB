<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\GempaBumi;
use App\Models\LogbookGempa;
use App\Models\LogbookPetir;
use App\Models\LogbookPeralatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportController extends Controller
{

    public function spatie_petir(Request $request)

    {
        // ✅ Validasi input lebih ringkas + custom pesan error opsional
        $validated = $request->validate([
            'start' => ['required', 'date'],
            'end'   => ['required', 'date', 'after_or_equal:start'],
        ]);

        $start = $validated['start'];
        $end   = $validated['end'];

        SimpleExcelWriter::streamDownload("logbook_petirs_{$start}_to_{$end}.xlsx")
            ->addRows(
                LogbookPetir::query()
                    ->whereBetween('tanggal', [$start, $end])
                    ->orderBy('tanggal')
                    ->cursor() // membaca baris demi baris
                    ->map(function ($logbook) {
                        return [
                            'tanggal'       => $logbook->tanggal,
                            'jam (wita)'           => $logbook->jam,
                            'on duty 1'     => $logbook->onduty1,
                            'on duty 2'     => $logbook->onduty2,
                            'on duty 3'     => $logbook->onduty3,
                            'pengamatan 1'  => $logbook->pengamatan1,
                            'pengamatan 2'  => $logbook->pengamatan2,
                            'pengamatan 3'  => $logbook->pengamatan3,
                            'pengamatan 4'  => $logbook->pengamatan4,
                            'pengamatan 5'  => $logbook->pengamatan5,
                            'pengamatan 6'  => $logbook->pengamatan6,
                            'pengamatan 7'  => $logbook->pengamatan7,
                            'kondisi'       => $logbook->kondisi,
                            'tugas tambahan'       => strip_tags($logbook->note),
                        ];
                    })
            );
    }
    public function spatie_gempa(Request $request)

    {
        // ✅ Validasi input lebih ringkas + custom pesan error opsional
        $validated = $request->validate([
            'start' => ['required', 'date'],
            'end'   => ['required', 'date', 'after_or_equal:start'],
        ]);

        $start = $validated['start'];
        $end   = $validated['end'];

        SimpleExcelWriter::streamDownload("logbookgempa_{$start}_to_{$end}.xlsx")
            ->addRows(
                LogbookGempa::query()
                    ->whereBetween('tanggal', [$start, $end])
                    ->orderBy('tanggal')
                    ->cursor() // membaca baris demi baris
                    ->map(function ($logbookgempa) {
                        return [
                            'tanggal'       => $logbookgempa->tanggal,
                            'jam (wita)'           => $logbookgempa->jam,
                            'on duty 1'     => $logbookgempa->onduty1,
                            'on duty 2'     => $logbookgempa->onduty2,
                            'on duty 3'     => $logbookgempa->onduty3,
                            'kegiatan 1'    => $logbookgempa->kegiatan1,
                            'kegiatan 2'    => $logbookgempa->kegiatan2,
                            'monitoring 1'  => $logbookgempa->monitoring1,
                            'berita 1'      => $logbookgempa->berita1,
                            'monitoring 2'  => $logbookgempa->monitoring2,
                            'berita 2'      => $logbookgempa->berita2,
                            'kondisi'       => $logbookgempa->kondisi,
                            'tugas tambahan'       => strip_tags($logbookgempa->note),
                        ];
                    })
            );
    }

    public function spatie_peralatan(Request $request)

    {
        // ✅ Validasi input lebih ringkas + custom pesan error opsional
        $validated = $request->validate([
            'start' => ['required', 'date'],
            'end'   => ['required', 'date', 'after_or_equal:start'],
        ]);

        $start = $validated['start'];
        $end   = $validated['end'];

        SimpleExcelWriter::streamDownload("logbookperalatan_{$start}_to_{$end}.xlsx")
            ->addRows(
                LogbookPeralatan::query()
                    ->whereBetween('tanggal', [$start, $end])
                    ->orderBy('tanggal')
                    ->cursor() // membaca baris demi baris
                    ->map(function ($logbookperalatan) {
                        return [
                            'tanggal'       => $logbookperalatan->tanggal,
                            'jam (wita)'           => $logbookperalatan->jam,
                            'on duty 1'     => $logbookperalatan->onduty1,
                            'on duty 2'     => $logbookperalatan->onduty2,
                            'on duty 3'     => $logbookperalatan->onduty3,
                            'fingerprint' => $logbookperalatan->fingerprint,
                            'tds' => $logbookperalatan->tds,
                            'nexstorm' => $logbookperalatan->nexstorm,
                            'obs nexstorm' => $logbookperalatan->obs_nexstorm,
                            'cmss' => $logbookperalatan->cmss,
                            'monitoring' => $logbookperalatan->monitoring,
                            'accelerograf' => $logbookperalatan->acc,
                            'wrs ng' => $logbookperalatan->wrsng,
                            'integrasi data' => $logbookperalatan->integrasi_data,
                            'seiscomp' => $logbookperalatan->seiscomp4,
                            'pc magnet' => $logbookperalatan->pc_magnet,
                            'monitor zoom' => $logbookperalatan->monitor_zoom,
                            'internet ops' => $logbookperalatan->internet_ops,
                            'internet lokal' => $logbookperalatan->internet_lokal,
                            'shakemap' => $logbookperalatan->shakemap,
                            'seiscomp regional' => $logbookperalatan->seiscomp_reg,
                            'pc qc seiscomp' => $logbookperalatan->qc_seiscomp,
                            'monitor simap' => $logbookperalatan->monitor_simap,
                            'pc workstation simap' => $logbookperalatan->ws_simap,
                            'bkb server' => $logbookperalatan->bkb_server,
                            'penakar hujan' => $logbookperalatan->penakar_hujan,
                            'radio ssb' => $logbookperalatan->radio_ssb,
                            'tugas tambahan'       => strip_tags($logbookperalatan->note),
                        ];
                    })
            );
    }



    public function spatie_parametergempa(Request $request)
    {

        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        // Header kolom
        $header = [
            'tanggal',
            'waktu',
            'waktu (utc)',
            'waktu (wita)',
            'magnitudo',
            'lintang',
            'bujur',
            'jarak',
            'kedalaman',
            'dirasakan',
            'keterangan',
        ];

        // Lazy load untuk efisiensi memori
        $data = GempaBumi::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->lazyById(1000, 'id')
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('Y-m-d'),
                    'waktu' => $item->waktu,
                    'waktu_utc' => $item->waktu_utc,
                    'waktu_wita' => $item->waktu_wita,
                    'magnitudo' => $item->magnitudo,
                    'lintang' => $item->lintang,
                    'bujur' => $item->bujur,
                    'jarak' => $item->jarak,
                    'kedalaman' => $item->kedalaman,
                    'dirasakan' => $item->dirasakan,
                    'keterangan' => strip_tags($item->keterangan ?? ''),
                ];
            });

        // Langsung kirim download response
        SimpleExcelWriter::streamDownload("Data_Gempa_{$start->format('Ymd')}_{$end->format('Ymd')}.xlsx")
            ->addHeader($header)
            ->addRows($data);
    }

    public function spatie_parametergempa_csv(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        // Lazy load untuk efisiensi memori
        $data = GempaBumi::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->lazyById(1000, 'id')
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('Y-m-d'),
                    'waktu' => $item->waktu,
                    'waktu_utc' => $item->waktu_utc,
                    'waktu_wita' => $item->waktu_wita,
                    'magnitudo' => $item->magnitudo,
                    'lintang' => $item->lintang,
                    'bujur' => $item->bujur,
                    'jarak' => $item->jarak,
                    'kedalaman' => $item->kedalaman,
                    'dirasakan' => $item->dirasakan,
                    'keterangan' => strip_tags($item->keterangan ?? ''),
                ];
            });

        // Langsung kirim download response
        SimpleExcelWriter::streamDownload("Data_Gempa_{$start->format('Ymd')}_{$end->format('Ymd')}.csv")
            // ->noHeaderRow()
            ->addRows($data);
    }
}
