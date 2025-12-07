<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntityRoleDefinition;
use App\Models\EntityTransitionDefinition;
use App\Models\EntityTransitionRoleDefinition;

class DefinitionSeeder extends Seeder
{
    public function run()
    {
        EntityRoleDefinition::factory()->count(5)->create();
        EntityTransitionDefinition::factory()->count(5)->create();
        EntityTransitionRoleDefinition::factory()->count(5)->create();
    }
}
