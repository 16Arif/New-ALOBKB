<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWrsNgRequest;
use App\Http\Requests\UpdateWrsNgRequest;
use App\Models\WrsNg;
use Illuminate\Http\Request;

class WrsNgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WrsNg::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_site', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
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

        $wrsNgs = $query->paginate(10)->withQueryString();

        return view('pages.wrsng.index', compact('wrsNgs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.wrsng.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWrsNgRequest $request)
    {
        $data = $request->validated();
        WrsNg::create($data);

        return redirect()->route('aloptama.index')->with('success', 'Data WRS NG berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WrsNg $wrsNg)
    {
        return view('pages.wrsng.show', compact('wrsNg'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WrsNg $wrsNg)
    {
        return view('pages.wrsng.edit', compact('wrsNg'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWrsNgRequest $request, WrsNg $wrsNg)
    {
        $data = $request->validated();
        $wrsNg->update($data);

        return redirect()->route('aloptama.index')->with('success', 'Data WRS NG berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WrsNg $wrsNg)
    {
        $wrsNg->delete();

        return redirect()->route('aloptama.index')->with('success', 'Data WRS NG berhasil dihapus.');
    }
}
