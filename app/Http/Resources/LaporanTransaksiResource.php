<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LaporanTransaksiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->laporan_transaksiID,
            'tanggal' => $this->tanggal,
            'total_transaksi' => $this->total_transaksi,
            'total_pendapatan' => $this->total_pendapatan,
            'jumlah_diskon' => $this->jumlah_diskon,
            'penggunas' => $this->whenLoaded('penggunas'),
        ];
    }
}
