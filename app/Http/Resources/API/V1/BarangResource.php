<?php

namespace App\Http\Resources\API\V1;

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
        'id'            => $this->BarangID,
        'name'          => $this->Nama_barang,
        'category'      => $this->kategori ? $this->kategori->nama_kategori : 'Tanpa Kategori', 
        'stock'         => $this->Stok,
        'base_price'    => (float) $this->Harga_dasar,
        'selling_price' => (float) $this->Harga_jual,
        'display_price' => 'Rp ' . number_format($this->Harga_jual, 0, ',', '.'),
        'stock_status'  => $this->Stok < 10 ? 'Low Stock' : 'Available',
        'image_url'     => $this->foto ? asset('storage/' . $this->foto) : null,
    ];
}
}
