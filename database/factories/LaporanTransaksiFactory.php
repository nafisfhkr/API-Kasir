<?php

namespace Database\Factories;

use App\Models\LaporanTransaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanTransaksiFactory extends Factory
{
    protected $model = LaporanTransaksi::class;

    public function definition()
    {
        return [
            'tanggal' => $this->faker->date(),
            'total_transaksi' => $this->faker->numberBetween(1, 100),
            'total_pendapatan' => $this->faker->numberBetween(1000, 100000),
            'jumlah_diskon' => $this->faker->numberBetween(0, 1000),
            'penggunaID' => Pengguna::factory(),
        ];
    }
}
