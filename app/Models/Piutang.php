<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutangs';
    protected $primaryKey = 'piutangID';

    protected $fillable = [
        'TransaksiID',
        'CustomerID',
        'tanggal_piutang',
        'jatuh_tempo',
        'total_piutang',
        'status_pembayaran',
    ];

    // Relasi ke tabel transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'TransaksiID');
    }

    // Relasi ke tabel customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
}
