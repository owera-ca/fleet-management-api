<?php

namespace Database\Factories;

use App\Models\TruckTracking;
use App\Models\Truck;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckTrackingFactory extends Factory
{
    protected $model = TruckTracking::class;

    public function definition()
    {
        return [
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'truck_id' => Truck::factory(),
            'program_id' => Program::factory(),
        ];
    }
}
