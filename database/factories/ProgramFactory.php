<?php

namespace Database\Factories;

use App\Models\Program;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    protected $model = Program::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'code' => strtoupper($this->faker->lexify('???')),
            'company_address_id' => Address::factory(),
            'representative_address_id' => Address::factory(),
        ];
    }
}
