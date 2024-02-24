<?php

namespace App\Http\Controllers;

use App\Models\LogbookPetir;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $logbookpetirs = LogbookPetir::all();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('pages.logbookpetir.shows', compact('logbookpetirs')));
        $mpdf->Output();
    }
}
