<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class HutangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'SuplierID' => Supplier::factory(),
            'tanggal_hutang' => $this->faker->date(),
            'jatuh_tempo' => $this->faker->dateTimeBetween('now', '+1 month'),
            'total_hutang' => $this->faker->randomFloat(2, 1000, 100000),
            'status_pembayaran' => $this->faker->randomElement(['belum_lunas', 'lunas']),
        ];
    }
}
