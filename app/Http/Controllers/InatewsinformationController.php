<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InatewsInformation;
use App\Http\Requests\StoreInatewsinformationRequest;
use App\Http\Requests\UpdateInatewsinformationRequest;

class InatewsinformationController extends Controller
{
    public function create()
    {
        return view('pages.inatewsinformation.create',  ['type_menu' => '']);
    }
    public function edit($id)
    {
        $inatewsinformation = InatewsInformation::findOrFail($id);
        return view('pages.inatewsinformation.edit', compact('inatewsinformation'),  ['type_menu' => '']);
    }

    public function store(StoreInatewsinformationRequest $request)
    {
        $data = $request->all();
        InatewsInformation::create($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Informasi Site InaTEWS Berhasil Ditambahkan');
    }

    public function update(UpdateInatewsinformationRequest $request, InatewsInformation $inatewsinformation)
    {
        $data = $request->validated();
        $inatewsinformation->update($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Informasi Site InaTEWS Berhasil Diperbaharui');
    }

    public function destroy(InatewsInformation $inatewsinformation)
    {
        $inatewsinformation->delete();
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Informasi Site InaTEWS Berhasil Dihapus');
    }
}
