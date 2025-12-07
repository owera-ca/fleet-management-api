<?php

namespace Database\Factories;

use App\Models\Carrier;
use App\Models\Program;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarrierFactory extends Factory
{
    protected $model = Carrier::class;

    public function definition()
    {
        return [
            'is_active' => $this->faker->boolean,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'user_id' => User::factory(),
            'company_address_id' => Address::factory(),
            'representative_address_id' => Address::factory(),
        ];
    }
}
