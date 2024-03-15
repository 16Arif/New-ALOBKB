<?php

namespace App\Http\Controllers;

use App\Models\LogbookGempa;
use App\Models\LogbookPeralatan;
use App\Models\LogbookPetir;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $logbookpetirs = LogbookPetir::latest()->get();
        $logbookgempas = LogbookGempa::latest()->get();
        $logbookperalatans = LogbookPeralatan::latest()->get();

        $users = User::paginate(8);
        return view('pages.app.dashboard', compact('users', 'logbookpetirs', 'logbookgempas', 'logbookperalatans'),  ['type_menu' => '']);
    }
}
