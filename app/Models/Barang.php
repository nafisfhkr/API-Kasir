<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'BarangID';

    protected $fillable = [
        'Nama_barang', 'kategoriID', 'foto', 'Harga_jual', 'Harga_dasar', 'Stok'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategoriID', 'KategoriID');
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class, 'BarangID', 'BarangID');
    }

    public function stok()
    {
        return $this->hasMany(Stok::class, 'BarangID', 'BarangID');
    }

    public function diskon()
    {
        return $this->hasOne(Diskon::class, 'BarangID', 'BarangID');
    }

    public function supplierBarang()
    {
        return $this->belongsToMany(Supplier::class, 'supplier_barang', 'BarangID', 'SuplierID');
    }
}
