<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogbookgempaRequest;
use App\Http\Requests\UpdateLogbookgempaRequest;
use App\Models\LogbookGempa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogbookgempaController extends Controller
{
    public function index(Request $request)
    {
        $logbookgempas = DB::table('logbook_gempas')
            ->when($request->input('search'), function ($query, $search) {
                return $query
                    ->where('onduty1', 'like', '%' . $search . '%')
                    ->orWhere('onduty2', 'like', '%' . $search . '%')
                    ->orWhere('onduty3', 'like', '%' . $search . '%')
                    ->orWhere('kehadiran', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.logbookgempa.index', compact('logbookgempas'));
    }

    public function show($id)
    {

        $logbookgempa = LogbookGempa::findOrFail($id);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('pages.logbookgempa.show', compact('logbookgempa')));
        $mpdf->Output();
    }

    public function create()
    {
        $users = User::all();
        return view('pages.logbookgempa.create',  ['type_menu' => ''], compact('users'));
    }

    public function store(StoreLogbookgempaRequest $request)
    {
        $data = $request->all();
        LogbookGempa::create($data);
        return redirect()->route('logbookgempa.index')->with('success', 'Data Logbook Gempabumi Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $users = User::all();
        $logbookgempa = LogbookGempa::findOrFail($id);
        return view('pages.logbookgempa.edit', compact('logbookgempa', 'users'),  ['type_menu' => '']);
    }

    public function update(UpdateLogbookgempaRequest $request, LogbookGempa $logbookgempa)
    {
        $data = $request->validated();
        $logbookgempa->update($data);
        return redirect()->route('logbookgempa.index')->with('success', 'Logbook Gempabumi Berhasil Diperbaharui');
    }

    public function destroy(LogbookGempa $logbookgempa)
    {
        $logbookgempa->delete();
        return redirect()->route('logbookgempa.index')->with('success', 'Data Logbook Gempa Berhasil Dihapus');
    }
}
