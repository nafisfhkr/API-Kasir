<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // Gunakan kolom default id
            'penggunas' => $this->whenLoaded('penggunas'), // Pastikan relasi dimuat
            'alamat' => $this->alamat,
            'foto' => $this->foto,
            'jabatan' => $this->jabatan, // Perbaiki kapitalisasi
            'gaji' => $this->gaji,
            'transactions' => $this->whenLoaded('transactions'), // Pastikan relasi dimuat
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ];
    }    
}
