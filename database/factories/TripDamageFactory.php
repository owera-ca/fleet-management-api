<?php

namespace Database\Factories;

use App\Models\TripDamage;
use App\Models\Program;
use App\Models\Trip;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripDamageFactory extends Factory
{
    protected $model = TripDamage::class;

    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'penalty']),
            'program_id' => Program::factory(),
            'trip_id' => Trip::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
