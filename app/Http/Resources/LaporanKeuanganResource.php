<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanKeuanganResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'laporanKeuanganID' => $this->laporanKeuanganID,
            'Periode_awal' => $this->Periode_awal,
            'Periode_akhir' => $this->Periode_akhir,
            'total_pemasukan' => $this->total_pemasukan,
            'total_pengeluaran' => $this->total_pengeluaran,
            'laba_bersih' => $this->laba_bersih,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
