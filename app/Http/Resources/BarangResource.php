<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->BarangID,
            'nama_barang' => $this->Nama_barang,
            'kategori_id' => $this->kategoriID,
            'foto' => $this->foto,
            'harga_jual' => $this->Harga_jual,
            'harga_dasar' => $this->Harga_dasar,
            'stok' => $this->Stok,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
