<?php

namespace Database\Factories;

use App\Models\Piutang;
use App\Models\Transaksi;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PiutangFactory extends Factory
{
    protected $model = Piutang::class;

    public function definition(): array
    {
        return [
            'TransaksiID' => Transaksi::factory(),
            'CustomerID' => Customer::factory(),
            'tanggal_piutang' => $this->faker->date(),
            'jatuh_tempo' => $this->faker->dateTimeBetween('now', '+1 month'),
            'total_piutang' => $this->faker->randomFloat(2, 100, 10000),
            'status_pembayaran' => $this->faker->randomElement(['belum_lunas', 'lunas']),
        ];
    }
}
