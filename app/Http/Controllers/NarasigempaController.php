<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GempaBumi;

class NarasigempaController extends Controller
{

    public function index()
    {
        return view('pages.narasigempa.index');
    }

    public function createWithId($id)
    {
        $gempa = GempaBumi::findOrFail($id);
        return view('pages.gempabumi.createNarration', compact('gempa'),  ['type_menu' => '']);
    }
}
