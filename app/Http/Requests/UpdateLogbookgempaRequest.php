<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogbookgempaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => 'required',
            'jam' => 'required',
            'onduty1' => 'required',
            'onduty2' => '',
            'onduty3' => '',
            'kehadiran' => 'required|in:HADIR,TIDAK HADIR',
            'kegiatan1' => 'required',
            'kegiatan2' => 'required',
            'monitoring1' => 'required|in:Observasi Seiscomp4 jam 08.00-11.00 WITA,Observasi Seiscomp4 jam 14.00-17.00 WITA,Observasi Seiscomp4 jam 20.00-23.00 WITA,Observasi Seiscomp4 jam 02.00-05.00 WITA',
            'berita1' => 'required|in:Kirim Berita CMSS jam 03.00 GMT,Kirim Berita CMSS jam 09.00 GMT,Kirim Berita CMSS jam 15.00 GMT,Kirim Berita CMSS jam 21.00 GMT',
            'monitoring2' => 'required|in:Observasi Seiscomp4 jam 11.00-14.00 WITA,Observasi Seiscomp4 jam 17.00-20.00 WITA,Observasi Seiscomp4 jam 23.00-02.00 WITA,Observasi Seiscomp4 jam 05.00-08.00 WITA',
            'berita2' => 'required|in:Kirim Berita CMSS jam 06.00 GMT,Kirim Berita CMSS jam 12.00 GMT,Kirim Berita CMSS jam 18.00 GMT,Kirim Berita CMSS jam 00.00 GMT',
            'kondisi' => 'required|in:BAIK,TIDAK BAIK',
            'note' => ''
        ];
    }
}
