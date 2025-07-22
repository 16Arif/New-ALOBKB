<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogbookPetir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLogbookpetirRequest;
use App\Http\Requests\UpdateLogbookpetirRequest;


class LogbookpetirController extends Controller
{
    public function index(Request $request)
    {

        $logbookpetirs = DB::table('logbook_petirs')
            ->when($request->input('search'), function ($query, $search) {
                return $query->where('onduty1', 'like', '%' . $search . '%')
                    ->orWhere('onduty2', 'like', '%' . $search . '%')
                    ->orWhere('onduty3', 'like', '%' . $search . '%')
                    ->orWhere('note', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('pages.logbookpetir.index', compact('logbookpetirs'));
    }

    public function create()
    {
        $users = User::all();
        return view('pages.logbookpetir.create',  ['type_menu' => ''], compact('users'));
    }

    public function store(StoreLogbookpetirRequest $request)
    {
        $data = $request->validated();
        $presets = match ($data['jam']) {
            '01.00' => [
                'pengamatan1' => 'Pengamatan LD jam 02.00',
                'pengamatan2' => 'Pengamatan LD jam 03.00',
                'pengamatan3' => 'Pengamatan LD jam 04.00',
                'pengamatan4' => 'Pengamatan LD jam 05.00',
                'pengamatan5' => 'Pengamatan LD jam 06.00',
                'pengamatan6' => 'Pengamatan LD jam 07.00',
                'pengamatan7' => 'Pengamatan LD jam 08.00',
                'kondisi'     => 'BAIK',
            ],
            '07.00' => [
                'pengamatan1' => 'Pengamatan LD jam 08.00',
                'pengamatan2' => 'Pengamatan LD jam 09.00',
                'pengamatan3' => 'Pengamatan LD jam 10.00',
                'pengamatan4' => 'Pengamatan LD jam 11.00',
                'pengamatan5' => 'Pengamatan LD jam 12.00',
                'pengamatan6' => 'Pengamatan LD jam 13.00',
                'pengamatan7' => 'Pengamatan LD jam 14.00',
                'kondisi'     => 'BAIK',
            ],
            '13.00' => [
                'pengamatan1' => 'Pengamatan LD jam 14.00',
                'pengamatan2' => 'Pengamatan LD jam 15.00',
                'pengamatan3' => 'Pengamatan LD jam 16.00',
                'pengamatan4' => 'Pengamatan LD jam 17.00',
                'pengamatan5' => 'Pengamatan LD jam 18.00',
                'pengamatan6' => 'Pengamatan LD jam 19.00',
                'pengamatan7' => 'Pengamatan LD jam 20.00',
                'kondisi'     => 'BAIK',
            ],
            '19.00' => [
                'pengamatan1' => 'Pengamatan LD jam 20.00',
                'pengamatan2' => 'Pengamatan LD jam 21.00',
                'pengamatan3' => 'Pengamatan LD jam 22.00',
                'pengamatan4' => 'Pengamatan LD jam 23.00',
                'pengamatan5' => 'Pengamatan LD jam 00.00',
                'pengamatan6' => 'Pengamatan LD jam 01.00',
                'pengamatan7' => 'Pengamatan LD jam 02.00',
                'kondisi'     => 'BAIK',
            ],
            default => [],
        };

        // Gabungkan input user + preset otomatis
        $finalData = array_merge($data, $presets);

        LogbookPetir::create($finalData);
        return redirect()->route('logbookpetir.index')->with('success', 'Data Logbook Petir Successfully Created');
    }

    public function edit($id)
    {
        $users = User::all();
        $logbookpetir = LogbookPetir::findOrFail($id);
        return view('pages.logbookpetir.edit', compact('logbookpetir', 'users'),  ['type_menu' => '']);
    }

    public function show($id)
    {

        $logbookpetir = LogbookPetir::findOrFail($id);

        // Tentukan nama file berdasarkan tanggal atau ID
        $tanggal = date('Y-m-d', strtotime($logbookpetir->tanggal)); // Sesuaikan dengan field tanggal di database
        $jam = date('H-i', strtotime($logbookpetir->jam)); // Format HH-MM-SS
        $namaFile = "LogbookPetir_{$tanggal}_{$jam}.pdf"; // Nama file yang akan diunduh

        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Render tampilan Blade ke HTML
        $html = view('pages.logbookpetir.show', compact('logbookpetir'))->render();

        // Tambahkan HTML ke mPDF
        $mpdf->WriteHTML($html);

        // Unduh file dengan nama yang telah ditentukan
        return response()->make($mpdf->Output($namaFile, "I"), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function update(UpdateLogbookpetirRequest $request, LogbookPetir $logbookpetir)
    {
        $data = $request->validated();
        $presets = match ($data['jam']) {
            '01.00' => [
                'pengamatan1' => 'Pengamatan LD jam 02.00',
                'pengamatan2' => 'Pengamatan LD jam 03.00',
                'pengamatan3' => 'Pengamatan LD jam 04.00',
                'pengamatan4' => 'Pengamatan LD jam 05.00',
                'pengamatan5' => 'Pengamatan LD jam 06.00',
                'pengamatan6' => 'Pengamatan LD jam 07.00',
                'pengamatan7' => 'Pengamatan LD jam 08.00',
                'kondisi'     => 'BAIK',
            ],
            '07.00' => [
                'pengamatan1' => 'Pengamatan LD jam 08.00',
                'pengamatan2' => 'Pengamatan LD jam 09.00',
                'pengamatan3' => 'Pengamatan LD jam 10.00',
                'pengamatan4' => 'Pengamatan LD jam 11.00',
                'pengamatan5' => 'Pengamatan LD jam 12.00',
                'pengamatan6' => 'Pengamatan LD jam 13.00',
                'pengamatan7' => 'Pengamatan LD jam 14.00',
                'kondisi'     => 'BAIK',
            ],
            '13.00' => [
                'pengamatan1' => 'Pengamatan LD jam 14.00',
                'pengamatan2' => 'Pengamatan LD jam 15.00',
                'pengamatan3' => 'Pengamatan LD jam 16.00',
                'pengamatan4' => 'Pengamatan LD jam 17.00',
                'pengamatan5' => 'Pengamatan LD jam 18.00',
                'pengamatan6' => 'Pengamatan LD jam 19.00',
                'pengamatan7' => 'Pengamatan LD jam 20.00',
                'kondisi'     => 'BAIK',
            ],
            '19.00' => [
                'pengamatan1' => 'Pengamatan LD jam 20.00',
                'pengamatan2' => 'Pengamatan LD jam 21.00',
                'pengamatan3' => 'Pengamatan LD jam 22.00',
                'pengamatan4' => 'Pengamatan LD jam 23.00',
                'pengamatan5' => 'Pengamatan LD jam 00.00',
                'pengamatan6' => 'Pengamatan LD jam 01.00',
                'pengamatan7' => 'Pengamatan LD jam 02.00',
                'kondisi'     => 'BAIK',
            ],
            default => [],
        };

        // Gabungkan input user + preset otomatis
        $finalData = array_merge($data, $presets);

        $logbookpetir->update($finalData);
        return redirect()->route('logbookpetir.index')->with('success', 'logbookpetir Successfully Updated');
    }


    public function destroy(LogbookPetir $logbookpetir)
    {
        $logbookpetir->delete();
        return redirect()->route('logbookpetir.index')->with('success', 'Data Logbook Petir Successfully Deleted');
    }
}
