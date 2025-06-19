<?php

namespace App\Http\Controllers;

use App\Models\GempaBumi;
use App\Models\LogbookGempa;
use App\Models\LogbookPeralatan;
use App\Models\LogbookPetir;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Routing\Controller;

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

    public function spatie_parametergempa()
    {
        $rows = [];

        GempaBumi::query()->lazyById(2000, 'id')
            ->each(function ($datagempa) use (&$rows) {
                $rows[] = $datagempa->toArray();
            });
        SimpleExcelWriter::streamDownload('dataparametergempa.xlsx')
            ->addRows($rows);
    }
}
