<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nama_barang' => $this->faker->word(),
            'kategoriID' => \App\Models\Kategori::factory(), // pastikan ada factory untuk kategori
            'foto' => $this->faker->imageUrl(640, 480, 'people', true, 'barang'),
            'Harga_jual' => $this->faker->randomFloat(2, 1000, 100000), // harga antara 1,000 - 100,000
            'Harga_dasar' => $this->faker->randomFloat(2, 500, 90000),  // harga antara 500 - 90,000
            'Stok' => $this->faker->numberBetween(1, 100), // stok antara 1 - 100
        ];
    }
}