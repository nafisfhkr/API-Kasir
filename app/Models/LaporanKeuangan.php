<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'laporan_keuangan';
    protected $primaryKey = 'laporanKeuanganID';

    protected $fillable = [
        'Periode_awal',
        'Periode_akhir',
        'total_pemasukan',
        'total_pengeluaran',
        'laba_bersih',
    ];
}
