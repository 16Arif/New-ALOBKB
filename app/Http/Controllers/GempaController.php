<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\GempaBumi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreGempabumiRequest;
use App\Http\Requests\UpdateGempabumiRequest;

class GempaController extends Controller
{

        public function index(Request $request){
        $datagempa = DB::table('gempa_bumis')
            ->when($request->input('search'), function ($query, $search) {
                return $query
                    ->where('jarak', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
            return view('pages.gempabumi.index', compact('datagempa'),  ['type_menu' => '']);
        }

        public function create(){
            return view('pages.gempabumi.create',  ['type_menu' => '']);
        }

        public function store(StoreGempabumiRequest $request){
             // Validasi
            $data = $request->validated();

            // Konversi tanggal dan waktu
            $data['tanggal'] = Carbon::createFromFormat('d-M-y', $data['tanggal'])->format('Y-m-d');
            $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');

            GempaBumi::create($data);
            return redirect()->route('gempabumi.index')->with('success', 'Data gempa berhasil disimpan!');

        }


        public function edit($id)
        {
            $users = User::all();
            $datagempa = GempaBumi::findOrFail($id);
            return view('pages.gempabumi.edit', compact('datagempa', 'users'),  ['type_menu' => '']);
        }

        public function update(UpdateGempabumiRequest $request, GempaBumi $gempabumi)
        {
            $data = $request->validated();

            // Konversi tanggal dan waktu
            // $data['tanggal'] = Carbon::createFromFormat('d/m/Y', $data['tanggal'])->format('Y-m-d');
            $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');

            $gempabumi->update($data);
            return redirect()->route('gempabumi.index')->with('success', 'Data Parameter Gempabumi Berhasil Diperbaharui');
        }

        public function destroy(GempaBumi $gempabumi)
        {
            $gempabumi->delete();
            return redirect()->route('gempabumi.index')->with('success', 'Data Paremeter Gempabumi Berhasil Dihapus');
        }
}
