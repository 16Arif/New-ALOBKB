<?php

namespace App\Http\Controllers;

use App\Models\Accelerograph;
use App\Models\LightningDetector;
use App\Models\MagnetPrekursor;
use App\Models\Seismograph;
use App\Models\WrsNg;
use Illuminate\Http\Request;

class AloptamaController extends Controller
{
    /**
     * Display a listing of Data Aloptama (Seismograph, Accelerograph, Lightning Detector, WRS NG, Magnet Prekursor).
     */
    public function index(Request $request)
    {
        // 1. Query Seismograph
        $seismoQuery = Seismograph::query();
        if ($request->filled('search_seismo')) {
            $search = $request->search_seismo;
            $seismoQuery->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('seismometer', 'like', "%{$search}%")
                    ->orWhere('accelerometer', 'like', "%{$search}%")
                    ->orWhere('digitizer', 'like', "%{$search}%");
            });
        } elseif ($request->filled('search')) {
            $search = $request->search;
            $seismoQuery->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('seismometer', 'like', "%{$search}%")
                    ->orWhere('accelerometer', 'like', "%{$search}%")
                    ->orWhere('digitizer', 'like', "%{$search}%");
            });
        }

        switch ($request->sort_seismo ?? $request->sort) {
            case 'nama_site_asc':
                $seismoQuery->orderBy('nama_site', 'asc');
                break;
            case 'nama_site_desc':
                $seismoQuery->orderBy('nama_site', 'desc');
                break;
            case 'lokasi_asc':
                $seismoQuery->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $seismoQuery->orderBy('lokasi', 'desc');
                break;
            default:
                $seismoQuery->orderBy('id', 'desc');
                break;
        }
        $seismographs = $seismoQuery->paginate(10, ['*'], 'page_seismo')->withQueryString();

        // 2. Query Accelerograph
        $accQuery = Accelerograph::query();
        if ($request->filled('search_acc')) {
            $searchAcc = $request->search_acc;
            $accQuery->where(function ($q) use ($searchAcc) {
                $q->where('nama', 'like', "%{$searchAcc}%")
                    ->orWhere('lokasi', 'like', "%{$searchAcc}%")
                    ->orWhere('merk', 'like', "%{$searchAcc}%")
                    ->orWhere('tipe_accelerometer', 'like', "%{$searchAcc}%")
                    ->orWhere('digitizer', 'like', "%{$searchAcc}%");
            });
        }

        switch ($request->sort_acc) {
            case 'nama_asc':
                $accQuery->orderBy('nama', 'asc');
                break;
            case 'nama_desc':
                $accQuery->orderBy('nama', 'desc');
                break;
            case 'lokasi_asc':
                $accQuery->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $accQuery->orderBy('lokasi', 'desc');
                break;
            default:
                $accQuery->orderBy('id', 'desc');
                break;
        }
        $accelerographs = $accQuery->paginate(10, ['*'], 'page_acc')->withQueryString();

        // 3. Query Lightning Detector
        $ldQuery = LightningDetector::query();
        if ($request->filled('search_ld')) {
            $searchLd = $request->search_ld;
            $ldQuery->where(function ($q) use ($searchLd) {
                $q->where('nama_site', 'like', "%{$searchLd}%")
                    ->orWhere('lokasi', 'like', "%{$searchLd}%")
                    ->orWhere('sensor', 'like', "%{$searchLd}%")
                    ->orWhere('receiver', 'like', "%{$searchLd}%");
            });
        }

        switch ($request->sort_ld) {
            case 'nama_site_asc':
                $ldQuery->orderBy('nama_site', 'asc');
                break;
            case 'nama_site_desc':
                $ldQuery->orderBy('nama_site', 'desc');
                break;
            case 'lokasi_asc':
                $ldQuery->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $ldQuery->orderBy('lokasi', 'desc');
                break;
            default:
                $ldQuery->orderBy('id', 'desc');
                break;
        }
        $lightningDetectors = $ldQuery->paginate(10, ['*'], 'page_ld')->withQueryString();

        // 4. Query WRS NG
        $wrsQuery = WrsNg::query();
        if ($request->filled('search_wrs')) {
            $searchWrs = $request->search_wrs;
            $wrsQuery->where(function ($q) use ($searchWrs) {
                $q->where('nama_site', 'like', "%{$searchWrs}%")
                    ->orWhere('lokasi', 'like', "%{$searchWrs}%");
            });
        }

        switch ($request->sort_wrs) {
            case 'nama_site_asc':
                $wrsQuery->orderBy('nama_site', 'asc');
                break;
            case 'nama_site_desc':
                $wrsQuery->orderBy('nama_site', 'desc');
                break;
            case 'lokasi_asc':
                $wrsQuery->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $wrsQuery->orderBy('lokasi', 'desc');
                break;
            default:
                $wrsQuery->orderBy('id', 'desc');
                break;
        }
        $wrsNgs = $wrsQuery->paginate(10, ['*'], 'page_wrs')->withQueryString();

        // 5. Query Magnet Prekursor
        $magnetQuery = MagnetPrekursor::query();
        if ($request->filled('search_magnet')) {
            $searchMagnet = $request->search_magnet;
            $magnetQuery->where(function ($q) use ($searchMagnet) {
                $q->where('nama_site', 'like', "%{$searchMagnet}%")
                    ->orWhere('lokasi', 'like', "%{$searchMagnet}%")
                    ->orWhere('sensor', 'like', "%{$searchMagnet}%")
                    ->orWhere('digitizer', 'like', "%{$searchMagnet}%")
                    ->orWhere('regulator', 'like', "%{$searchMagnet}%");
            });
        }

        switch ($request->sort_magnet) {
            case 'nama_site_asc':
                $magnetQuery->orderBy('nama_site', 'asc');
                break;
            case 'nama_site_desc':
                $magnetQuery->orderBy('nama_site', 'desc');
                break;
            case 'lokasi_asc':
                $magnetQuery->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $magnetQuery->orderBy('lokasi', 'desc');
                break;
            default:
                $magnetQuery->orderBy('id', 'desc');
                break;
        }
        $magnetPrekursors = $magnetQuery->paginate(10, ['*'], 'page_magnet')->withQueryString();

        return view('pages.aloptama.index', compact('seismographs', 'accelerographs', 'lightningDetectors', 'wrsNgs', 'magnetPrekursors'));
    }

    /**
     * Display Peta Sebaran Aloptama.
     */
    public function peta()
    {
        $seismographs = Seismograph::all();
        $accelerographs = Accelerograph::all();
        $lightningDetectors = LightningDetector::all();
        $wrsNgs = WrsNg::all();
        $magnetPrekursors = MagnetPrekursor::all();

        return view('pages.aloptama.peta-aloptama', compact('seismographs', 'accelerographs', 'lightningDetectors', 'wrsNgs', 'magnetPrekursors'));
    }
}
