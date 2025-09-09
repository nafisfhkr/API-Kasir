<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Model implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Authenticatable;

    protected $table = 'penggunas'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'user_id',
        'Nama',
        'Email',
        'Password',
        'No_hp',
        'Code_referral',
        'Role',
    ];

    // Relasi ke Staff
    public function staff()
    {
        return $this->hasOne(Staff::class, 'penggunaID', 'id');
    }

    // Relasi ke Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'penggunaID', 'id');
    }

    // Relasi ke LaporanTransaksi
    public function laporanTransaksi()
    {
        return $this->hasMany(LaporanTransaksi::class, 'penggunaID', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
