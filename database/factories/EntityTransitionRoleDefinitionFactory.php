<?php

namespace Database\Factories;

use App\Models\EntityTransitionRoleDefinition;
use App\Models\Program;
use App\Models\EntityTransitionDefinition;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityTransitionRoleDefinitionFactory extends Factory
{
    protected $model = EntityTransitionRoleDefinition::class;

    public function definition()
    {
        return [
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'def_entity_transition_id' => EntityTransitionDefinition::factory(),
            'role_id' => Role::factory(),
        ];
    }
}
