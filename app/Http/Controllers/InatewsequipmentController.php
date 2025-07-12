<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInatewsequipmentRequest;
use App\Models\InatewsCode;
use Illuminate\Http\Request;
use App\Models\InatewsEquipment;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreKodeinatewsReqeust;
use App\Http\Requests\UpdateInatewsequipmentRequest;
use App\Http\Requests\UpdateKodeinatewsRequest;
use App\Models\InatewsInformation;

class InatewsequipmentController extends Controller
{

    public function index(Request $request)
    {
        $dataCode = InatewsCode::orderBy('id', 'desc')
            ->paginate(5, ['*'], 'code-page')
            ->withQueryString();
        $dataInformation = InatewsInformation::orderBy('id', 'desc')
            ->paginate(5, ['*'], 'information-page')
            ->withQueryString();
        $dataEquipment = InatewsEquipment::orderBy('id', 'desc')
            ->paginate(5, ['*'], 'equipment-page')
            ->withQueryString();
        return view('pages.inatews_equipment.index', compact('dataCode', 'dataInformation', 'dataEquipment'));
    }
    public function create()
    {
        return view('pages.inatews_equipment.create',  ['type_menu' => '']);
    }

    public function store(StoreInatewsequipmentRequest $request)
    {
        $data = $request->all();
        InatewsEquipment::create($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Kode InaTEWS Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $inatewsequipment = InatewsEquipment::findOrFail($id);
        return view('pages.inatews_equipment.edit', compact('inatewsequipment'),  ['type_menu' => '']);
    }

    public function update(UpdateInatewsequipmentRequest $request, InatewsEquipment $inatewsequipment)
    {
        $data = $request->validated();
        $inatewsequipment->update($data);
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Site InaTEWS Berhasil Diperbaharui');
    }

    public function destroy(InatewsEquipment $inatewsequipment)
    {
        $inatewsequipment->delete();
        return redirect()->route('inatewsequipment.index')->with('success', 'Data Site InaTEWS Berhasil Dihapus');
    }
}
