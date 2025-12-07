<?php

namespace Database\Factories;

use App\Models\EntityTransition;
use App\Models\Program;
use App\Models\EntityTransitionDefinition;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityTransitionFactory extends Factory
{
    protected $model = EntityTransition::class;

    public function definition()
    {
        return [
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'program_id' => Program::factory(),
            'def_entity_transition_id' => EntityTransitionDefinition::factory(),
            'entity_id' => Entity::factory(),
            'start_by' => User::factory(),
            'end_by' => User::factory(),
        ];
    }
}
