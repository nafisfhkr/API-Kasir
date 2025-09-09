<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'CustomerID' => 'nullable|exists:customers,CustomerID',
            'Tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string|max:255',
        ];
    }
}
