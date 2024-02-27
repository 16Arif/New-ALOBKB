<?php

namespace App\Http\Controllers;

use App\Models\LogbookPetir;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportController extends Controller
{
    public function spatie()
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
            ->noHeaderRow()
            ->addRows($rows);
            // ->save('xlsx');
        // SimpleExcelWriter::streamDownload('logbookpetir.csv')
        //     ->noHeaderRow()
        //     ->addRows($rows);
    }
}
