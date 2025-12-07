<?php

namespace Database\Factories;

use App\Models\PayrollItem;
use App\Models\Program;
use App\Models\Payroll;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollItemFactory extends Factory
{
    protected $model = PayrollItem::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['shipment', 'expense', 'damage']),
            'type_id' => $this->faker->randomNumber(),
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'processed_on' => $this->faker->dateTime,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'payroll_id' => Payroll::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
