<?php

namespace Database\Factories;

use App\Models\CarrierDispatch;
use App\Models\Program;
use App\Models\Carrier;
use App\Models\Dispatch;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarrierDispatchFactory extends Factory
{
    protected $model = CarrierDispatch::class;

    public function definition()
    {
        return [
            'is_suspended' => $this->faker->boolean,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'carrier_id' => Carrier::factory(),
            'dispatch_id' => Dispatch::factory(),
        ];
    }
}
