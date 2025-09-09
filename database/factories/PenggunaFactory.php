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
    public function definition(): array
    {
        return [
            'name'=> $this->faker->name(),
            'email'=> $this->faker->email(),
            'password'=> $this->faker->password(),
            'phone_number'=> $this->faker->phoneNumber(),
            'referal_code'=> $this->faker->randomNumber(5),
            'jenis_pengguna'=> $this->faker->randomElement(['admin', 'pembeli', 'kasir'])
        ];
    }
}
