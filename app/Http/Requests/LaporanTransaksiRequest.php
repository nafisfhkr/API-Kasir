<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanTransaksiRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on authentication/authorization logic
    }

    public function rules()
    {
        return [
            'tanggal' => 'required|date',
            'total_transaksi' => 'required|integer|min:0',
            'total_pendapatan' => 'required|numeric|min:0',
            'jumlah_diskon' => 'nullable|numeric|min:0',
            'penggunaID' => 'required|exists:penggunas,id',
        ];
    }
}
