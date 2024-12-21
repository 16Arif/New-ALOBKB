<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogbookpetirRequest extends FormRequest
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
            'pengamatan1' => 'required|in:Pengamatan LD jam 02.00,Pengamatan LD jam 08.00,Pengamatan LD jam 14.00,Pengamatan LD jam 20.00',
            'pengamatan2' => 'required|in:Pengamatan LD jam 03.00,Pengamatan LD jam 09.00,Pengamatan LD jam 15.00,Pengamatan LD jam 21.00',
            'pengamatan3' => 'required|in:Pengamatan LD jam 04.00,Pengamatan LD jam 10.00,Pengamatan LD jam 16.00,Pengamatan LD jam 22.00',
            'pengamatan4' => 'required|in:Pengamatan LD jam 05.00,Pengamatan LD jam 11.00,Pengamatan LD jam 17.00,Pengamatan LD jam 23.00',
            'pengamatan5' => 'required|in:Pengamatan LD jam 06.00,Pengamatan LD jam 12.00,Pengamatan LD jam 18.00,Pengamatan LD jam 00.00',
            'pengamatan6' => 'required|in:Pengamatan LD jam 07.00,Pengamatan LD jam 13.00,Pengamatan LD jam 19.00,Pengamatan LD jam 01.00',
            'kondisi' => 'required|in:BAIK,TIDAK BAIK',
            'note' => '',
        ];
    }
}
