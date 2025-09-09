<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->TransaksiID,
            'pengguna' => $this->pengguna, // Data relasi pengguna
            'customer' => $this->customer, // Data relasi customer
            'tanggal_transaksi' => $this->Tanggal_transaksi,
            'total_harga' => $this->total_harga,
            'metode_pembayaran' => $this->metode_pembayaran,
            'detail_transactions' => $this->detailTransactions, // Data relasi detail transactions
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
