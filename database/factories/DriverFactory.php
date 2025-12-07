<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition()
    {
        return [
            'dl_number' => strtoupper($this->faker->bothify('??######')),
            'dl_expiry_date' => $this->faker->dateTimeBetween('now', '+5 years'),
            'is_canada_pr' => $this->faker->boolean,
            'is_us_pr' => $this->faker->boolean,
            'passport_number' => strtoupper($this->faker->bothify('??######')),
            'passport_expiry_date' => $this->faker->dateTimeBetween('now', '+10 years'),
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'user_id' => User::factory(),
        ];
    }
}
