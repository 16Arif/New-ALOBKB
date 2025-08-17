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

        $query = LogbookGempa::query();
        // pencarian
        if ($request->filled('search')) {
            $query->where('tanggal', 'like', "%{$request->search}%")
                ->orWhere('jam', 'like', "%{$request->search}%")
                ->orWhere('onduty1', 'like', "%{$request->search}%")
                ->orWhere('onduty2', 'like', "%{$request->search}%")
                ->orWhere('note', 'like', "%{$request->search}%")
                ->orWhere('onduty3', 'like', "%{$request->search}%");
        }

        // sorting
        switch ($request->sort) {
            case 'tanggal_asc':
                $query->orderBy('tanggal', 'asc');
                break;
            case 'tanggal_desc':
                $query->orderBy('tanggal', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc'); // default terbaru
        }

        $logbookgempas = $query->paginate(10);
        return view('pages.logbookgempa.index', compact('logbookgempas'));
    }

    public function show($id)
    {

        // $logbookgempa = LogbookGempa::findOrFail($id);

        // $mpdf = new \Mpdf\Mpdf();
        // $mpdf->WriteHTML(view('pages.logbookgempa.show', compact('logbookgempa')));

        // $mpdf->Output();
        $logbookgempa = LogbookGempa::findOrFail($id);

        // Tentukan nama file berdasarkan tanggal atau ID
        $tanggal = date('Y-m-d', strtotime($logbookgempa->tanggal)); // Sesuaikan dengan field tanggal di database
        $jam = date('H-i', strtotime($logbookgempa->jam)); // Format HH-MM-SS
        $onduty1 = $logbookgempa->onduty1;
        $onduty2 = $logbookgempa->onduty2;
        $onduty3 = $logbookgempa->onduty3;
        $namaFile = "LogbookGempa_{$tanggal}_{$jam}_{$onduty1}_{$onduty2}_{$onduty3}.pdf"; // Nama file yang akan diunduh

        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf();

        // Render tampilan Blade ke HTML
        $html = view('pages.logbookgempa.show', compact('logbookgempa'))->render();

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
        return view('pages.logbookgempa.create',  ['type_menu' => ''], compact('users'));
    }

    public function store(StoreLogbookgempaRequest $request)
    {
        $data = $request->validated();
        // Preset berdasarkan jam dinas
        $presets = match ($data['jam']) {
            '07.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 08.00-11.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 03.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 11.00-14.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 06.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '13.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 14.00-17.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 09.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 17.00-20.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 12.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '19.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 20.00-23.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 15.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 23.00-02.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 18.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '01.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 02.00-05.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 21.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 05.00-08.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 00.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            default => [],
        };

        // Gabungkan input user + preset otomatis
        $finalData = array_merge($data, $presets);

        LogbookGempa::create($finalData);

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

        // Update otomatis sesuai jam dinas
        $presets = match ($data['jam']) {
            '07.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 08.00-11.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 03.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 11.00-14.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 06.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '13.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 14.00-17.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 09.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 17.00-20.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 12.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '19.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 20.00-23.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 15.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 23.00-02.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 18.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            '01.00' => [
                'kegiatan1'   => 'Serah Terima Kehadiran, Cek Peralatan, Ceklist Acc',
                'kegiatan2'   => 'Monitoring GFZ, Index3.txt, WRS NG, WAG, SLMON2',
                'monitoring1' => 'Observasi Seiscomp4 jam 02.00-05.00 WITA',
                'berita1'     => 'Kirim Berita CMSS jam 21.00 GMT',
                'monitoring2' => 'Observasi Seiscomp4 jam 05.00-08.30 WITA',
                'berita2'     => 'Kirim Berita CMSS jam 00.00 GMT',
                'kondisi'     => 'BAIK',
            ],
            default => [],
        };

        $logbookgempa->update(array_merge($data, $presets));

        return redirect()->route('logbookgempa.index')->with('success', 'Logbook Gempabumi Berhasil Diperbaharui');
    }

    public function destroy(LogbookGempa $logbookgempa)
    {
        $logbookgempa->delete();
        return redirect()->route('logbookgempa.index')->with('success', 'Data Logbook Gempa Berhasil Dihapus');
    }
}
