<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePiutangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'TransaksiID' => 'required|exists:transactions,id',
            'CustomerID' => 'required|exists:customers,id',
            'tanggal_piutang' => 'required|date',
            'jatuh_tempo' => 'required|date|after_or_equal:tanggal_piutang',
            'total_piutang' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:belum_lunas,lunas',
        ];
    }
}
