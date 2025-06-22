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
            'waktuUtc' => '',
            'magnitudo' => 'required|string',
            'lintang' => 'required|string',
            'bujur' => 'required|string',
            'jarak' => 'required|string',
            'kedalaman' => 'required|string',
            'dirasakan' => '',
            'keterangan' => '',
        ];
    }
}
