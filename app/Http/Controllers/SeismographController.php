<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeismographRequest;
use App\Http\Requests\UpdateSeismographRequest;
use App\Models\Seismograph;
use Illuminate\Http\Request;

class SeismographController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Seismograph::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('seismometer', 'like', "%{$search}%")
                    ->orWhere('accelerometer', 'like', "%{$search}%")
                    ->orWhere('digitizer', 'like', "%{$search}%");
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

        $seismographs = $query->paginate(10)->withQueryString();

        return view('pages.aloptama.index', compact('seismographs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.aloptama.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeismographRequest $request)
    {
        $data = $request->validated();
        Seismograph::create($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Seismograph berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seismograph $seismograph)
    {
        return view('pages.aloptama.show', compact('seismograph'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seismograph $seismograph)
    {
        return view('pages.aloptama.edit', compact('seismograph'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeismographRequest $request, Seismograph $seismograph)
    {
        $data = $request->validated();
        $seismograph->update($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Seismograph berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seismograph $seismograph)
    {
        $seismograph->delete();

        return redirect()->route('aloptama.index')->with('success', 'Data Seismograph berhasil dihapus.');
    }
}
