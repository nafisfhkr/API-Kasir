<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'penggunaID' => 'required|exists:penggunas,id', 
            'CustomerID' => 'nullable|exists:customers,CustomerID',
            'Tanggal_transaksi' => 'required|date',
            'metode_pembayaran' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.BarangID' => 'required|exists:barang,BarangID',
            'items.*.qty' => 'required|integer|min:1',
    ];
}
}