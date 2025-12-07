<?php

namespace Database\Factories;

use App\Models\Payroll;
use App\Models\Program;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    protected $model = Payroll::class;

    public function definition()
    {
        return [
            'start_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'subtotal' => $this->faker->randomFloat(2, 1000, 5000),
            'total' => $this->faker->randomFloat(2, 1000, 5000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'cancelled']),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
