<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AloptamaController extends Controller
{
    /**
     * Display a listing of Data Aloptama.
     */
    public function index()
    {
        return view('pages.aloptama.index');
    }

    /**
     * Display Peta Sebaran Aloptama.
     */
    public function peta()
    {
        return view('pages.aloptama.peta');
    }
}
