<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLightningDetectorRequest;
use App\Http\Requests\UpdateLightningDetectorRequest;
use App\Models\LightningDetector;
use Illuminate\Http\Request;

class LightningDetectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LightningDetector::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('sensor', 'like', "%{$search}%")
                    ->orWhere('receiver', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama_site_asc':
                $query->orderBy('nama_site', 'asc');
                break;
            case 'nama_site_desc':
                $query->orderBy('nama_site', 'desc');
                break;
            case 'lokasi_asc':
                $query->orderBy('lokasi', 'asc');
                break;
            case 'lokasi_desc':
                $query->orderBy('lokasi', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $lightningDetectors = $query->paginate(10)->withQueryString();

        return view('pages.lightningdetector.index', compact('lightningDetectors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.lightningdetector.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLightningDetectorRequest $request)
    {
        $data = $request->validated();
        LightningDetector::create($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Lightning Detector berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LightningDetector $lightningDetector)
    {
        return view('pages.lightningdetector.show', compact('lightningDetector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LightningDetector $lightningDetector)
    {
        return view('pages.lightningdetector.edit', compact('lightningDetector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLightningDetectorRequest $request, LightningDetector $lightningDetector)
    {
        $data = $request->validated();
        $lightningDetector->update($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Lightning Detector berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LightningDetector $lightningDetector)
    {
        $lightningDetector->delete();

        return redirect()->route('aloptama.index')->with('success', 'Data Lightning Detector berhasil dihapus.');
    }
}
