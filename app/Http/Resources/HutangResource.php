<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HutangResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'hutangID' => $this->hutangID,
            'SuplierID' => $this->SuplierID,
            'tanggal_hutang' => $this->tanggal_hutang,
            'jatuh_tempo' => $this->jatuh_tempo,
            'total_hutang' => $this->total_hutang,
            'status_pembayaran' => $this->status_pembayaran,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
