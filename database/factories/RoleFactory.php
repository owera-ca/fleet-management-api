<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->jobTitle . ' ' . $this->faker->unique()->lexify('???'),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
