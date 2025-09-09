<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'penggunaID' => 'required|exists:penggunas,id',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|string|max:255', // URL atau path foto
            'Jabatan' => 'required|string|max:100',
            'Gaji' => 'required|numeric|min:0',
        ];
    }
}
