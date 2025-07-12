<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInatewsequipmentRequest extends FormRequest
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
            'manufaktur_seismo' => 'required',
            'tipe_seismo' => 'required',
            'sn_seismo' => 'required',
            'tglinstall_seismo' => 'required',
            'manufaktur_acc' => 'required',
            'tipe_acc' => 'required',
            'sn_acc' => 'required',
            'tglinstall_acc' => 'required',
            'manufaktur_digitizer' => 'required',
            'tipe_digitizer' => 'required',
            'sn_digitizer' => 'required',
            'tglinstall_digitizer' => 'required',
            'manufaktur_antenna' => 'required',
            'tipe_antenna' => 'required',
            'sn_antenna' => 'required',
            'tglinstall_antenna' => 'required',
            'manufaktur_modem_vsat' => 'required',
            'tipe_modem_vsat' => 'required',
            'sn_modem_vsat' => 'required',
            'tglinstall_modem_vsat' => 'required',
            'manufaktur_modem_gsm' => '',
            'tipe_modem_gsm' => '',
            'sn_modem_gsm' => '',
            'tglinstall_modem_gsm' => '',
            'manufaktur_gps' => 'required',
            'tipe_gps' => 'required',
            'sn_gps' => 'required',
            'tglinstall_gps' => 'required',
            'manufaktur_solar' => 'required',
            'tipe_solar' => 'required',
            'sn_solar' => 'required',
            'tglinstall_solar' => 'required',
            'manufaktur_charge' => 'required',
            'tipe_charge' => 'required',
            'sn_charge' => 'required',
            'tglinstall_charge' => 'required',
            'manufaktur_battery' => 'required',
            'tipe_battery' => 'required',
            'sn_battery' => 'required',
            'tglinstall_battery' => 'required',
            'ip_digitizer' => '',
            'ip_modem_vsat' => '',
            'ip_modem_gsm' => '',
        ];
    }
}
