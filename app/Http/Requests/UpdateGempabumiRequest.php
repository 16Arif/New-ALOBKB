<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGempabumiRequest extends FormRequest
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
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i:s',
            'waktu_utc' => '',
            'waktu_wita' => '',
            'bujur' => 'required|string',
            'lintang' => 'required|string',
            'magnitudo' => 'required|string',
            'kedalaman' => 'required|string',
            'jarak' => 'required|string',
            'dirasakan' => '',
            'keterangan' => '',
        ];
    }
}
