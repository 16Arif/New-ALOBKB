<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMagnetPrekursorRequest;
use App\Http\Requests\UpdateMagnetPrekursorRequest;
use App\Models\MagnetPrekursor;
use Illuminate\Http\Request;

class MagnetPrekursorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MagnetPrekursor::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('sensor', 'like', "%{$search}%")
                    ->orWhere('digitizer', 'like', "%{$search}%")
                    ->orWhere('regulator', 'like', "%{$search}%");
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

        $magnetPrekursors = $query->paginate(10)->withQueryString();

        return view('pages.magnetprekursor.index', compact('magnetPrekursors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.magnetprekursor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMagnetPrekursorRequest $request)
    {
        $data = $request->validated();
        MagnetPrekursor::create($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Magnet Prekursor berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MagnetPrekursor $magnetPrekursor)
    {
        return view('pages.magnetprekursor.show', compact('magnetPrekursor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MagnetPrekursor $magnetPrekursor)
    {
        return view('pages.magnetprekursor.edit', compact('magnetPrekursor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMagnetPrekursorRequest $request, MagnetPrekursor $magnetPrekursor)
    {
        $data = $request->validated();
        $magnetPrekursor->update($data);

        return redirect()->route('aloptama.index')->with('success', 'Data Magnet Prekursor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MagnetPrekursor $magnetPrekursor)
    {
        $magnetPrekursor->delete();

        return redirect()->route('aloptama.index')->with('success', 'Data Magnet Prekursor berhasil dihapus.');
    }
}
