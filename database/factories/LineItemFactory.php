<?php

namespace Database\Factories;

use App\Models\LineItem;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineItemFactory extends Factory
{
    protected $model = LineItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'parent_id' => null, // Or handle hierarchy logic if needed
            '_lft' => 0,
            '_rgt' => 0,
            'depth' => 0,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
