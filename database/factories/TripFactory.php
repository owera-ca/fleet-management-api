<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Program;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'program_id' => Program::factory(),
            'driver_id' => Driver::factory(),
        ];
    }
}
