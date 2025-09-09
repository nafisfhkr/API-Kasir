<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HutangRequest extends FormRequest
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
            'SuplierID' => 'required|exists:supplier,SuplierID',
            'tanggal_hutang' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_hutang',
            'total_hutang' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_lunas,lunas',
        ];
    }
}