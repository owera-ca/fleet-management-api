<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Program;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 10000),
            'unique_id' => $this->faker->uuid,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
