<?php

namespace Database\Factories;

use App\Models\Request;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    protected $model = Request::class;

    public function definition()
    {
        return [
            'describe' => $this->faker->sentence(),
            'requestDate' => $this->faker->dateTime(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'idSupplier' => Supplier::factory(),
        ];
    }
}
