<?php

namespace Database\Factories;

use App\Models\Truck;
use App\Models\Program;
use App\Models\Carrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    protected $model = Truck::class;

    public function definition()
    {
        return [
            'vin' => strtoupper($this->faker->unique()->bothify('1HGCM82633A######')),
            'number_plate' => strtoupper($this->faker->bothify('???-####')),
            'registered_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'total_km' => $this->faker->randomFloat(2, 1000, 500000),
            'status' => $this->faker->randomElement(['pending-registration', 'in-service', 'in-shop', 'retured', 'suspended']),
            'towing_capacity_kg' => $this->faker->randomFloat(2, 5000, 20000),
            'length' => $this->faker->randomFloat(2, 5, 15),
            'width' => $this->faker->randomFloat(2, 2, 3),
            'height' => $this->faker->randomFloat(2, 3, 4),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'carrier_id' => Carrier::factory(),
        ];
    }
}
