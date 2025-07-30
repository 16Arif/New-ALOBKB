<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogbookPeralatan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use App\Http\Requests\StoreLogbookpetirRequest;
use App\Http\Requests\StoreLogbookperalatanRequest;
use App\Http\Requests\UpdateLogbookperalatanRequest;

class LogbookperalatanController extends Controller
{
    public function index(Request $request)
    {

        $logbookperalatans = DB::table('logbook_peralatans')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('onduty1', 'like', '%' . $search . '%')
                    ->orWhere('onduty2', 'like', '%' . $search . '%')
                    ->orWhere('onduty3', 'like', '%' . $search . '%')
                    ->orWhere('note', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.logbookperalatan.index', compact('logbookperalatans'));
    }
    public function show($id)
    {

        $logbookperalatan = LogbookPeralatan::findOrFail($id);

        // Tentukan nama file berdasarkan tanggal atau ID
        $tanggal = date('Y-m-d', strtotime($logbookperalatan->tanggal)); // Sesuaikan dengan field tanggal di database
        $jam = date('H-i', strtotime($logbookperalatan->jam)); // Format HH-MM-SS
        $onduty1 = $logbookperalatan->onduty1;
        $onduty2 = $logbookperalatan->onduty2;
        $onduty3 = $logbookperalatan->onduty3;
        $namaFile = "LogbookPeralatan_{$tanggal}_{$jam}_{$onduty1}_{$onduty2}_{$onduty3}.pdf"; // Nama file yang akan diunduh

        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Render tampilan Blade ke HTML
        $html = view('pages.logbookperalatan.show', compact('logbookperalatan'))->render();

        // Tambahkan HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Unduh file dengan nama yang telah ditentukan
        return response()->make($mpdf->Output($namaFile, "I"), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('pages.logbookperalatan.create',  ['type_menu' => ''], compact('users'));
    }

    public function store(StoreLogbookperalatanRequest $request)
    {
        $data = $request->all();
        LogbookPeralatan::create($data);
        return redirect()->route('logbookperalatan.index')->with('success', 'Data Logbook Peralatan Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $users = User::all();
        $logbookperalatan = LogbookPeralatan::findOrFail($id);
        return view('pages.logbookperalatan.edit', compact('logbookperalatan', 'users'),  ['type_menu' => '']);
    }

    public function update(UpdateLogbookperalatanRequest $request, LogbookPeralatan $logbookperalatan)
    {
        $data = $request->validated();
        $logbookperalatan->update($data);
        return redirect()->route('logbookperalatan.index')->with('success', 'Logbook Peralatan Berhasil Diperbarui');
    }


    public function destroy(LogbookPeralatan $logbookperalatan)
    {
        $logbookperalatan->delete();
        return redirect()->route('logbookperalatan.index')->with('success', 'Data Logbook Peralatan Berhasil Dihapus');
    }
}
