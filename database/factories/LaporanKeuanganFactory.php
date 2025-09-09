<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanKeuanganFactory extends Factory
{
    protected $model = LaporanKeuangan::class;

    public function definition()
    {
        $periode_awal = $this->faker->date();
        $periode_akhir = $this->faker->date('Y-m-d', strtotime($periode_awal . ' +1 month'));
        $total_pemasukan = $this->faker->randomFloat(2, 1000, 10000);
        $total_pengeluaran = $this->faker->randomFloat(2, 500, 5000);
        $laba_bersih = $total_pemasukan - $total_pengeluaran;

        return [
            'Periode_awal' => $periode_awal,
            'Periode_akhir' => $periode_akhir,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'laba_bersih' => $laba_bersih,
        ];
    }
}
