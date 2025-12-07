<?php

namespace Database\Factories;

use App\Models\ShopJob;
use App\Models\Program;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopJobFactory extends Factory
{
    protected $model = ShopJob::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['servicing', 'damage']),
            'subtotal' => $this->faker->randomFloat(2, 100, 5000),
            'total' => $this->faker->randomFloat(2, 100, 5000),
            'start_at' => $this->faker->dateTime,
            'return_at' => $this->faker->dateTime,
            'program_id' => Program::factory(),
            'truck_id' => Truck::factory(),
        ];
    }
}
