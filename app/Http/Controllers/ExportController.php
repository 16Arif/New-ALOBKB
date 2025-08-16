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
        $request->validate([
            'start' => 'required|date',
            'end'   => 'required|date|after_or_equal:start',
        ]);

        $start = $request->start;
        $end = $request->end;

        $rows = [];

        LogbookPetir::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->lazyById(2000, 'id')
            ->each(function ($logbook) use (&$rows) {
                $rows[] = [
                    'Tanggal'       => $logbook->tanggal,
                    'Jam'           => $logbook->jam . ' WITA',
                    'On Duty 1'     => $logbook->onduty1,
                    'On Duty 2'     => $logbook->onduty2,
                    'On Duty 3'     => $logbook->onduty3,
                    'Pengamatan 1'  => $logbook->pengamatan1,
                    'Pengamatan 2'  => $logbook->pengamatan2,
                    'Pengamatan 3'  => $logbook->pengamatan3,
                    'Pengamatan 4'  => $logbook->pengamatan4,
                    'Pengamatan 5'  => $logbook->pengamatan5,
                    'Pengamatan 6'  => $logbook->pengamatan6,
                    'Kondisi'       => $logbook->kondisi,
                    'Catatan'       => strip_tags($logbook->note),
                ];
            });

        SimpleExcelWriter::streamDownload("logbook_petirs_{$start}_to_{$end}.xlsx")
            ->addRows($rows);
    }



    public function spatie_peralatan(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end'   => 'required|date|after_or_equal:start',
        ]);

        $start = $request->start;
        $end = $request->end;

        $rows = [];

        LogbookPeralatan::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->lazyById(2000, 'id')
            ->each(function ($logbookperalatan) use (&$rows) {
                $rows[] = [
                    'Tanggal'       => $logbookperalatan->tanggal,
                    'Jam'           => $logbookperalatan->jam . ' WITA',
                    'On Duty'       => implode(', ', array_filter([$logbookperalatan->onduty1, $logbookperalatan->onduty2, $logbookperalatan->onduty3])),
                    'Fingerprint' => $logbookperalatan->fingerprint,
                    'TDS' => $logbookperalatan->tds,
                    'Nexstorm' => $logbookperalatan->nextorm,
                    'Obs Nexstorm' => $logbookperalatan->obs_nexstorm,
                    'CMSS' => $logbookperalatan->cmss,
                    'Monitoring' => $logbookperalatan->monitoring,
                    'Accelerograf' => $logbookperalatan->acc,
                    'WRS NG' => $logbookperalatan->wrsng,
                    'Integrasi Data' => $logbookperalatan->integrasi_data,
                    'Seiscomp' => $logbookperalatan->seiscomp4,
                    'PC Magnet' => $logbookperalatan->pc_magnet,
                    'Monitor Zoom' => $logbookperalatan->monitor_zoom,
                    'Internet Ops' => $logbookperalatan->internet_ops,
                    'Internet Lokal' => $logbookperalatan->internet_lokal,
                    'Shakemap' => $logbookperalatan->shakemap,
                    'Seiscomp Regional' => $logbookperalatan->seiscomp_reg,
                    'PC QC Seiscomp' => $logbookperalatan->qc_seiscomp,
                    'Monitor Simap' => $logbookperalatan->monitor_simap,
                    'PC Workstation Simap' => $logbookperalatan->ws_simap,
                    'BKB Server' => $logbookperalatan->bkb_server,
                    'Penakar Hujan' => $logbookperalatan->penakar_hujan,
                    'Radio SSB' => $logbookperalatan->radio_ssb,
                    'Catatan'          => strip_tags($logbookperalatan->note),
                ];
            });

        SimpleExcelWriter::streamDownload("logbookperalatan_{$start}_to_{$end}.xlsx")
            ->addRows($rows);
    }

    public function spatie_gempa(Request $request)
    {

        $request->validate([
            'start' => 'required|date',
            'end'   => 'required|date|after_or_equal:start',
        ]);

        $start = $request->start;
        $end = $request->end;

        $rows = [];

        LogbookGempa::whereBetween('tanggal', [$start, $end])
            ->orderBy('tanggal')
            ->lazyById(2000, 'id')
            ->each(function ($logbookgempa) use (&$rows) {
                $rows[] = [
                    'Tanggal'       => $logbookgempa->tanggal,
                    'Jam'           => $logbookgempa->jam . ' WITA',
                    'On Duty'       => implode(', ', array_filter([$logbookgempa->onduty1, $logbookgempa->onduty2, $logbookgempa->onduty3])),
                    'Kegiatan 1'    => $logbookgempa->kegiatan1,
                    'Kegiatan 2'    => $logbookgempa->kegiatan2,
                    'Monitoring 1'  => $logbookgempa->monitoring1,
                    'Berita 1'      => $logbookgempa->berita1,
                    'Monitoring 2'  => $logbookgempa->monitoring2,
                    'Berita 2'      => $logbookgempa->berita2,
                    'Kondisi'       => $logbookgempa->kondisi,
                    'Catatan'          => $logbookgempa->note,
                ];
            });

        SimpleExcelWriter::streamDownload("logbookgempa_{$start}_to_{$end}.xlsx")
            ->addRows($rows);
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
