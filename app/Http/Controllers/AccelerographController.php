<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccelerographRequest;
use App\Http\Requests\UpdateAccelerographRequest;
use App\Models\Accelerograph;
use Illuminate\Http\Request;

class AccelerographController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Accelerograph::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('merk', 'like', "%{$search}%")
                    ->orWhere('tipe_accelerometer', 'like', "%{$search}%")
                    ->orWhere('digitizer', 'like', "%{$search}%");
            });
        }

        // Sorting
        switch ($request->sort) {
            case 'nama_asc':
                $query->orderBy('nama', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama', 'desc');
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

        $accelerographs = $query->paginate(10)->withQueryString();

        return view('pages.accelerograph.index', compact('accelerographs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.accelerograph.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccelerographRequest $request)
    {
        $data = $request->validated();
        Accelerograph::create($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Accelerograph berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Accelerograph $accelerograph)
    {
        return view('pages.accelerograph.show', compact('accelerograph'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accelerograph $accelerograph)
    {
        return view('pages.accelerograph.edit', compact('accelerograph'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccelerographRequest $request, Accelerograph $accelerograph)
    {
        $data = $request->validated();
        $accelerograph->update($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Accelerograph berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accelerograph $accelerograph)
    {
        $accelerograph->delete();

        return redirect()->route('aloptama.index')->with('success', 'Data Accelerograph berhasil dihapus.');
    }
}
