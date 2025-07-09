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
use Mews\Purifier\Facades\Purifier;

class GempaController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // default 10

        if ($perPage == 'all') {
            $datagempa = DB::table('gempa_bumis')
                ->when($request->input('search'), function ($query, $search) {
                    return $query->where('jarak', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->get(); // ambil semua data
        } else {
            $datagempa = GempaBumi::orderBy('id', 'desc')
                ->when($request->input('search'), function ($query, $search) {
                    return $query->where('jarak', 'like', '%' . $search . '%');
                })
                ->paginate($perPage)
                ->withQueryString();
        }

        return view('pages.gempabumi.index', compact('datagempa'), ['type_menu' => '']);
    }

    public function create()
    {
        return view('pages.gempabumi.create',  ['type_menu' => '']);
    }

    public function store(StoreGempabumiRequest $request)
    {
        // Validasi
        $data = $request->validated();

        // Konversi tanggal dan waktu
        $data['tanggal'] = Carbon::createFromFormat('d-M-y', $data['tanggal'])->format('Y-m-d');
        $data['waktu'] = Carbon::createFromFormat('H:i:s', $data['waktu'])->format('H:i:s');

        // Generate waktuUtc dari waktu (dalam zona WIB → UTC, minus 7 jam)
        $data['waktu_utc'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        // Konversi lintang
        if (preg_match('/([\d.]+)\s*(LU|LS)/i', $data['lintang'], $match)) {
            $nilaiLintang = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['lintang'] = $arah === 'LU' ? $nilaiLintang : -$nilaiLintang;
        }

        // Konversi bujur
        if (preg_match('/([\d.]+)\s*(BT|BB)/i', $data['bujur'], $match)) {
            $nilaiBujur = (float)$match[1];
            $arah = strtoupper($match[2]);
            $data['bujur'] = $arah === 'BT' ? $nilaiBujur : -$nilaiBujur;
        }





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
        // Generate waktu_utc dari waktu (dalam zona WIB → UTC, minus 7 jam)
        $data['waktu_utc'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->subHours(7)
            ->format('H:i:s');

        // Generate waktu_wita dari waktu (dalam zona WITB → WITA, plus 1 jam)
        $data['waktu_wita'] = \Carbon\Carbon::createFromFormat('H:i:s', $data['waktu'])
            ->addHours(1)
            ->format('H:i:s');

        $data['keterangan'] = Purifier::clean($request->input('keterangan'));

        $gempabumi->update($data);
        return redirect()->route('gempabumi.index')->with('success', 'Data Parameter Gempabumi Berhasil Diperbaharui');
    }

    public function destroy(GempaBumi $gempabumi)
    {
        $gempabumi->delete();
        return redirect()->route('gempabumi.index')->with('success', 'Data Paremeter Gempabumi Berhasil Dihapus');
    }

    public function destroyBatch(Request $request)
    {
        $ids = $request->id;

        if (!is_array($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'Format ID tidak sesuai.'
            ]);
        }

        GempaBumi::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data gempa berhasil dihapus.'
        ]);
    }

    public function infografiss(Request $request)
    {
        \Carbon\Carbon::setLocale('id');

        $ids = explode(',', $request->ids);
        $data = GempaBumi::whereIn('id', $ids)->get();
        $startDate = $data->min('tanggal');
        $endDate = $data->max('tanggal');


        return view('pages.gempabumi.infografis', compact('data', 'startDate', 'endDate'));
    }
}
