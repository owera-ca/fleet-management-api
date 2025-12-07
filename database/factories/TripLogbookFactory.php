<?php

namespace Database\Factories;

use App\Models\TripLogbook;
use App\Models\Program;
use App\Models\Trip;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripLogbookFactory extends Factory
{
    protected $model = TripLogbook::class;

    public function definition()
    {
        return [
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'reason_stop' => $this->faker->randomElement(['break', 'fuel', 'delivered']),
            'program_id' => Program::factory(),
            'trip_id' => Trip::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
