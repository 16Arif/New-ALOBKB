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
            'tanggal' => 'required|date',
            'jam' => 'required|in:07.00,13.00,19.00,01.00',
            'onduty1' => 'required|string',
            'onduty2' => 'nullable|string',
            'onduty3' => 'nullable|string',
            'onduty4' => 'nullable|string',
            'onduty5' => 'nullable|string',
            'note'    => 'nullable|string'
        ];
    }
}
