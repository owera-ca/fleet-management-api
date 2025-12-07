<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Program;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['shipment', 'expense', 'shop']),
            'subtotal' => $this->faker->randomFloat(2, 10, 10000),
            'total' => $this->faker->randomFloat(2, 10, 10000),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'from_id' => User::factory(),
            'to_id' => User::factory(),
            // 'trans_id' => Transaction::factory(), // Avoid circular dependency
        ];
    }
}
