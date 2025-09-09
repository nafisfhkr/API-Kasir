<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->SuplierID,
            'nama' => $this->Nama,
            'alamat' => $this->Alamat,
            'kontak' => $this->Kontak,
        ];
    }
}
