<?php

namespace App\Http\Controllers;

use App\Models\LogbookGempa;
use App\Models\LogbookPeralatan;
use App\Models\LogbookPetir;
use App\Models\GempaBumi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data logbook (catatan petugas)
        $logbookpetirs = LogbookPetir::latest()->get();
        $logbookgempas = LogbookGempa::latest()->get();
        $logbookperalatans = LogbookPeralatan::latest()->get();

        $users = User::paginate(8);

        // 2. DATA TEKNIS: Dari model Gempabumi
        $totalGempabumi = GempaBumi::count();

        // Hitung gempa dirasakan (filter kolom dirasakan)
        $gempaDirasakan = GempaBumi::whereNotNull('dirasakan')
            ->where('dirasakan', '!=', '')
            ->count();

        // Ambil data gempa paling baru berdasarkan ID
        $latestGempa = GempaBumi::latest('id')->first();

        // Ambil data gempa paling awal untuk info "Sejak..."
        $firstGempa = GempaBumi::oldest('tanggal')->first();
        $tanggalPertama = $firstGempa ? $firstGempa->tanggal : null;

        // 3. STATISTIK GRAFIK (DATA MINGGUAN - 15 Minggu Terakhir)
        $weeklyStats = GempaBumi::select([
            DB::raw("DATE_FORMAT(tanggal, '%Y-%u') as period"),
            DB::raw("COUNT(*) as total")
        ])
            ->groupByRaw("DATE_FORMAT(tanggal, '%Y-%u')")
            ->orderByRaw("DATE_FORMAT(tanggal, '%Y-%u') DESC")
            ->take(15)
            ->get()
            ->reverse()
            ->values();

        // 4. STATISTIK GRAFIK (DATA BULANAN - 12 Bulan Terakhir)
        $monthlyStats = GempaBumi::select([
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
