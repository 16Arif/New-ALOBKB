<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMagnetPrekursorRequest extends FormRequest
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
            'nama_site' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'required|string|max:50',
            'longitude' => 'required|string|max:50',
            'tahun_instalasi' => 'nullable|string|max:50',
            'sensor' => 'nullable|string|max:255',
            'digitizer' => 'nullable|string|max:255',
            'regulator' => 'nullable|string|max:255',
        ];
    }
}
