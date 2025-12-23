<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengguna>
 */
class PenggunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // File: database/factories/PenggunaFactory.php

public function definition(): array
{
    return [
        // Membuat User secara otomatis untuk setiap Pengguna
        'user_id'       => \App\Models\User::factory(), 
        'Nama'          => $this->faker->name(),
        'Email'         => $this->faker->unique()->safeEmail(), // Menggunakan unique agar email tidak duplikat
        'Password'      => bcrypt('password123'),
        'No_hp'         => $this->faker->phoneNumber(),
        'Code_referral' => $this->faker->randomNumber(5),
        'Role'          => $this->faker->randomElement(['admin', 'kasir', 'pembeli']),
    ];
}
}
