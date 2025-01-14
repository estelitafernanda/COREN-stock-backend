<?php

namespace Database\Factories;

use App\Models\Movement;
use App\Models\Product;
use App\Models\User;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovementFactory extends Factory
{
    protected $model = Movement::class;

    public function definition()
    {
        return [
            'idProduct' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 50),
            'movementDate' => $this->faker->dateTime(),
            'idResponsible' => User::factory(),
            'idOriginSector' => Sector::factory(),
            'idDestinationSector' => Sector::factory(),
            'movementStatus' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
