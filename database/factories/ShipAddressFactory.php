<?php

namespace Database\Factories;

use App\Models\ShipAddress;
use App\Models\Program;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipAddressFactory extends Factory
{
    protected $model = ShipAddress::class;

    public function definition()
    {
        return [
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'alt_email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'alt_phone' => $this->faker->phoneNumber,
            'addr1' => $this->faker->streetAddress,
            'addr2' => $this->faker->secondaryAddress,
            'postal_zip' => $this->faker->postcode,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'country_id' => Country::factory(),
            'province_state_id' => Province::factory(),
        ];
    }
}
