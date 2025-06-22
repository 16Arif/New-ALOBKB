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

    public function spatie_petir()

    {
        $rows = [];

        // User::chunk(2000, function ($users) use (&$rows) {
        //     foreach ($users->toArray() as $user) {
        //         $rows[] = $user;
        //     }
        // });

        LogbookPetir::query()->lazyById(2000, 'id')
            ->each(function ($logbookpetir) use (&$rows) {
                $rows[] = $logbookpetir->toArray();
            });
        SimpleExcelWriter::streamDownload('logbookpetir.xlsx')
            // ->noHeaderRow()

            ->addRows($rows);
        // ->save('xlsx');
        // SimpleExcelWriter::streamDownload('logbookpetir.csv')
        //     ->noHeaderRow()
        //     ->addRows($rows);
    }



    public function spatie_peralatan()
    {
        $rows = [];

        LogbookPeralatan::query()->lazyById(2000, 'id')
            ->each(function ($logbookperalatan) use (&$rows) {
                $rows[] = $logbookperalatan->toArray();
            });
        SimpleExcelWriter::streamDownload('logbookperalatan.xlsx')
            ->addRows($rows);
    }

    public function spatie_gempa()
    {
        $rows = [];

        LogbookGempa::query()->lazyById(2000, 'id')
            ->each(function ($logbookgempa) use (&$rows) {
                $rows[] = $logbookgempa->toArray();
            });
        SimpleExcelWriter::streamDownload('logbookgempa.xlsx')
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
            'Tanggal','Waktu (WIB)' , 'Waktu (UTC)','Waktu (WITA)', 'Magnitudo', 'Lintang',
            'Bujur', 'Jarak', 'Kedalaman (Km)', 'Dirasakan', 'Keterangan'
        ];

        // Lazy load untuk efisiensi memori
        $data = GempaBumi::whereBetween('tanggal', [$start, $end])
        ->orderBy('tanggal')
        ->lazyById(1000, 'id')
        ->map(function ($item){
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
                'keterangan' => $item->keterangan,
            ];
        });

        // Langsung kirim download response
        SimpleExcelWriter::streamDownload("Data_Gempa_{$start->format('Ymd')}_{$end->format('Ymd')}.xlsx")
            ->addHeader($header)
            ->addRows($data);

        // Jangan gunakan `return` — karena streamDownload sudah handle response
    }
}
