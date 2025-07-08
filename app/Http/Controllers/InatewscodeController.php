<?php

namespace App\Http\Controllers;

use App\Models\InatewsCode;
use Illuminate\Http\Request;
use App\Models\InatewsEquipment;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreKodeinatewsReqeust;
use App\Http\Requests\UpdateKodeinatewsRequest;

class InatewscodeController extends Controller
{
    public function create()
    {
        return view('pages.inatewscode.create',  ['type_menu' => '']);
    }
    public function store(StoreKodeinatewsReqeust $request)
    {
        $data = $request->all();
        InatewsCode::create($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Kode Site InaTEWS Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $inatewscode = InatewsCode::findOrFail($id);
        return view('pages.inatewscode.edit', compact('inatewscode'),  ['type_menu' => '']);
    }

    public function update(UpdateKodeinatewsRequest $request, InatewsCode $inatewscode)
    {
        $data = $request->validated();
        $inatewscode->update($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Kode Site InaTEWS Berhasil Diperbaharui');
    }
    public function destroy(InatewsCode $inatewscode)
    {
        $inatewscode->delete();
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Kode Site InaTEWS Berhasil Dihapus');
    }
}
