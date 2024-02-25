<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogbookgempaController extends Controller
{
    public function index(Request $request)
    {
        $logbookgempas = DB::table('logbook_gempas')
            ->when($request->input('search'), function ($query, $search) {
                return $query
                    ->where('onduty1', 'like', '%' . $search . '%')
                    ->orWhere('onduty2', 'like', '%' . $search . '%')
                    ->orWhere('onduty3', 'like', '%' . $search . '%')
                    ->orWhere('kehadiran', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.logbookgempa.index', compact('logbookgempas'));
    }
}
