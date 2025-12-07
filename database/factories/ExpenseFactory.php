<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\Program;
use App\Models\Shipment;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'subtotal' => $this->faker->randomFloat(2, 10, 1000),
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'refused']),
            'program_id' => Program::factory(),
            'shipment_id' => Shipment::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
