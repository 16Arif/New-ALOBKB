<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogbookperalatanRequest extends FormRequest
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

    public const VALIDATION_OPTIONS = 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF';

    public function rules(): array
    {

        return [
            'tanggal' => 'required',
            'jam' => 'required',
            'onduty1' => 'required|max:100|min:3',
            'onduty2' => '',
            'onduty3' => '',
            'kehadiran' => 'required|in:HADIR,TIDAK HADIR',
            'fingerprint' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'tds' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'nexstorm' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'obs_nexstorm' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'cmss' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'monitoring' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'acc' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'wrsng' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'integrasi_data' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'seiscomp4' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'pc_magnet' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'monitor_zoom' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'internet_ops' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'internet_lokal' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'shakemap' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'seiscomp_reg' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'qc_seiscomp' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'monitor_simap' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'ws_simap' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'bkb_server' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'penakar_hujan' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'radio_ssb' => 'required|in:BAIK,TIDAK BAIK,TIDAK AKTIF',
            'note' => '',
        ];
    }
}
