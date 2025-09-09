<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'TransaksiID';

    protected $fillable = [
        'penggunaID', 'CustomerID', 'Tanggal_transaksi', 'total_harga', 'metode_pembayaran'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'penggunaID', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class, 'TransaksiID', 'TransaksiID');
    }
}
