<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pengguna;
use App\Models\Staff;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penggunaID' => Pengguna::factory(),
            'CustomerID' => Customer::factory(),
            'Tanggal_transaksi' => $this->faker->dateTimeThisYear(),
            'total_harga' => $this->faker->randomFloat(2, 100, 10000),
            'metode_pembayaran' => $this->faker->randomElement(['Cash', 'Credit Card', 'Online Payment']),
        ];
    }
}
