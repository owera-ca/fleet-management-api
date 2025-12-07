<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    protected $model = Entity::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('?????')),
            'name' => $this->faker->company,
            'table' => $this->faker->word,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
