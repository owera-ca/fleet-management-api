<?php

namespace Database\Factories;

use App\Models\EntityRoleDefinition;
use App\Models\Program;
use App\Models\Entity;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityRoleDefinitionFactory extends Factory
{
    protected $model = EntityRoleDefinition::class;

    public function definition()
    {
        return [
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'entity_id' => Entity::factory(),
            'role_id' => Role::factory(),
        ];
    }
}
