<?php

namespace Database\Factories;

use App\Models\Shipper;
use App\Models\Program;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipperFactory extends Factory
{
    protected $model = Shipper::class;

    public function definition()
    {
        return [
            'company_name' => $this->faker->company,
            'is_verified' => $this->faker->boolean,
            'is_suspended' => $this->faker->boolean,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'user_id' => User::factory(),
            'company_address_id' => Address::factory(),
            'representative_address_id' => Address::factory(),
        ];
    }
}
