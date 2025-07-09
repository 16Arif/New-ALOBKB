<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInatewsinformationRequest extends FormRequest
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
            'lat' => 'required',
            'long' => 'required',
            'elevasi' => 'required',
            'th_install' => 'required',
            'alamat_site' => 'required',
            'kel_site' => 'required',
            'kec_site' => 'required',
            'kota' => 'required',
            'prov' => 'required',
            'pic_site' => 'required',
            'kontak_pic' => 'required',
            'upt' => 'required',
            'alamat_upt' => 'required',
            'kel_upt' => 'required',
            'kec_upt' => 'required',
            'kota_upt' => 'required',
            'jab_pic_upt' => 'required',
            'pic_upt' => 'required',
            'kontak_pic_upt' => 'required'
        ];
    }
}
