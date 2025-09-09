<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanKeuanganRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ubah sesuai dengan kebijakan autentikasi
    }

    public function rules()
    {
        return [
            'Periode_awal' => 'required|date',
            'Periode_akhir' => 'required|date|after_or_equal:Periode_awal',
            'total_pemasukan' => 'required|numeric|min:0',
            'total_pengeluaran' => 'required|numeric|min:0',
            'laba_bersih' => 'required|numeric',
        ];
    }
}