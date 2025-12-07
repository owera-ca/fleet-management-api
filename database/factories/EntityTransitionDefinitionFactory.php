<?php

namespace Database\Factories;

use App\Models\EntityTransitionDefinition;
use App\Models\Program;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityTransitionDefinitionFactory extends Factory
{
    protected $model = EntityTransitionDefinition::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('TRN???')),
            'name' => $this->faker->word,
            'sort_order' => $this->faker->numberBetween(1, 100),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'entity_id' => Entity::factory(),
        ];
    }
}
