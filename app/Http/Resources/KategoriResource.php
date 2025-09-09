<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->KategoriID,
            'nama_kategori' => $this->nama_kategori,
            'barang' => BarangResource::collection($this->whenLoaded('barang')), // Jika relasi dimuat
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
