<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PiutangResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'piutangID' => $this->piutangID,
            'TransaksiID' => $this->TransaksiID,
            'CustomerID' => $this->CustomerID,
            'tanggal_piutang' => $this->tanggal_piutang,
            'jatuh_tempo' => $this->jatuh_tempo,
            'total_piutang' => $this->total_piutang,
            'status_pembayaran' => $this->status_pembayaran,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
