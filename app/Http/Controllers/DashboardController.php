<?php

namespace App\Http\Controllers;

use App\Models\LogbookGempa;
use App\Models\LogbookPeralatan;
use App\Models\LogbookPetir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Data yang sudah ada sebelumnya
        $logbookpetirs = LogbookPetir::latest()->get();
        $logbookgempas = LogbookGempa::latest()->get(); // Ini data logbook (catatan petugas)
        $logbookperalatans = LogbookPeralatan::latest()->get();
        $users = User::paginate(8);

        // DATA BARU: Dari model Gempabumi (Data Teknis)
        $totalGempabumi = \App\Models\Gempabumi::count();

        // Asumsi: gempa dirasakan ditandai dengan kolom 'dirasakan' yang tidak null atau bernilai true
        $gempaDirasakan = \App\Models\Gempabumi::whereNotNull('dirasakan')->where('dirasakan', '!=', '')->count();

        // Ambil 1 data gempa terbaru
        $latestGempa = \App\Models\Gempabumi::latest('id')->first();

        $firstGempa = \App\Models\Gempabumi::oldest('tanggal')->first();
        $tanggalPertama = $firstGempa ? $firstGempa->tanggal : null;

        // Di DashboardController.php

        // Pastikan ini ada di paling atas file controller!


        // 1. DATA MINGGUAN
        $weeklyStats = \App\Models\Gempabumi::select([
            DB::raw("DATE_FORMAT(tanggal, '%Y-%u') as period"),
            DB::raw("COUNT(*) as total")
        ])
            ->groupByRaw("DATE_FORMAT(tanggal, '%Y-%u')")
            ->orderByRaw("DATE_FORMAT(tanggal, '%Y-%u') DESC")
            ->take(15)
            ->get()
            ->reverse()
            ->values();

        // 2. DATA BULANAN 
        $monthlyStats = \App\Models\Gempabumi::select([
            DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as period"),
            DB::raw("COUNT(*) as total")
        ])
            ->groupByRaw("DATE_FORMAT(tanggal, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(tanggal, '%Y-%m') DESC")
            ->take(12)
            ->get()
            ->reverse()
            ->values();

        return view('pages.app.dashboard2', compact(
            'users',
            'logbookpetirs',
            'logbookgempas',
            'logbookperalatans',
            'totalGempabumi',
            'gempaDirasakan',
            'latestGempa',
            'tanggalPertama',
            'weeklyStats',
            'monthlyStats'
        ), ['type_menu' => '']);
    }
}
