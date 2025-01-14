<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'nameProduct' => $this->faker->word(),
            'idDepartment' => Sector::factory(), // Cria ou associa a um setor
            'describe' => $this->faker->sentence(),
            'minQuantity' => $this->faker->numberBetween(1, 10),
            'currentQuantity' => $this->faker->numberBetween(10, 100),
            'location' => $this->faker->word(),
            'validity' => $this->faker->date(),
            'unitPrice' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
