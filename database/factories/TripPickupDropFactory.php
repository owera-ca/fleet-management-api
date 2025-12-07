<?php

namespace Database\Factories;

use App\Models\TripPickupDrop;
use App\Models\Program;
use App\Models\Trip;
use App\Models\Cargo;
use App\Models\ShipAddress;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripPickupDropFactory extends Factory
{
    protected $model = TripPickupDrop::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['pickup', 'drop']),
            'status' => $this->faker->randomElement(['pending', 'completed']),
            'sort_order' => $this->faker->numberBetween(1, 10),
            'program_id' => Program::factory(),
            'trip_id' => Trip::factory(),
            'cargo_id' => Cargo::factory(),
            'ship_address_id' => ShipAddress::factory(),
            'representative_address_id' => Address::factory(),
        ];
    }
}
