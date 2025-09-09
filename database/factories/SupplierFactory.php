<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'Nama' => $this->faker->name(),
            'Alamat' => $this->faker->address(),
            'Kontak' => $this->faker->phoneNumber()
        ];
    }
}
