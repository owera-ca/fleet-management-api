<?php

namespace Database\Factories;

use App\Models\OrgNode;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgNodeFactory extends Factory
{
    protected $model = OrgNode::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'parent_id' => null,
            '_lft' => 0,
            '_rgt' => 0,
            'depth' => 0,
            'program_id' => Program::factory(),
        ];
    }
}
