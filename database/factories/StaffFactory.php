<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pengguna;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
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
            'alamat' => $this->faker->address(),
            'foto' => $this->faker->imageUrl(640, 480, 'people', true, 'Staff'),
            'Jabatan' => $this->faker->jobTitle(),
            'Gaji' => $this->faker->randomFloat(2, 3000, 10000), // Gaji antara 3000-10000
        ];
    }
}
