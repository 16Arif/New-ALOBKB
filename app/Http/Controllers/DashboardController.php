<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request){

        $users = User::paginate(8);
        return view('pages.app.dashboard', compact('users'),  ['type_menu' => '']);
    }
}
