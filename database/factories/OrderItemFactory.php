<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Program;
use App\Models\Order;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 500),
            'qty' => $this->faker->numberBetween(1, 10),
            'composite_price' => $this->faker->randomFloat(2, 10, 5000),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'order_id' => Order::factory(),
            'entity_id' => Entity::factory(),
        ];
    }
}
