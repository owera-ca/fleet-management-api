<?php

namespace Database\Factories;

use App\Models\Province;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceFactory extends Factory
{
    protected $model = Province::class;

    public function definition()
    {
        return [
            'name' => $this->faker->state,
            'iso3_code' => strtoupper($this->faker->lexify('???')),
            'country_id' => Country::inRandomOrder()->first()->id ?? Country::factory(),
        ];
    }
}
