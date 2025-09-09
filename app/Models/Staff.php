<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';
    protected $primaryKey = 'StaffID';

    protected $fillable = [
        'penggunaID', 'alamat', 'foto', 'jabatan', 'gaji'
    ];

    public function staff()
{
    return $this->belongsTo(Staff::class);
}

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'penggunaID', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'StaffID', 'StaffID');
    }
}
