<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutangs';
    protected $primaryKey = 'hutangID';

    protected $fillable = [
        'SuplierID',
        'tanggal_hutang',
        'jatuh_tempo',
        'total_hutang',
        'status_pembayaran',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SuplierID', 'id');
    }
}
