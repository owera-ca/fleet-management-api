<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Program;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

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
            // 'program_id' => Program::factory(), // Avoid circular dependency if possible, or handle carefully
            'country_id' => function () {
                return Country::inRandomOrder()->first()->id ?? Country::factory()->create()->id;
            },
            'province_state_id' => function (array $attributes) {
                // Try to get a province from the selected country
                $countryId = $attributes['country_id'] ?? null;
                if ($countryId) {
                    $province = Province::where('country_id', $countryId)->inRandomOrder()->first();
                    if ($province) {
                        return $province->id;
                    }
                }
                return Province::inRandomOrder()->first()->id ?? Province::factory()->create()->id;
            },
        ];
    }
}
