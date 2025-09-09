<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'SuplierID';

    protected $fillable = ['Nama', 'Alamat', 'Kontak'];

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'supplier_barang', 'SuplierID', 'BarangID');
    }
}
