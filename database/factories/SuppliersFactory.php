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
            'corporateReason' => $this->faker->company(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'contact' => $this->faker->phoneNumber(),
        ];
    }
}
