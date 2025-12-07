<?php

namespace Database\Factories;

use App\Models\MetadataField;
use App\Models\Program;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetadataFieldFactory extends Factory
{
    protected $model = MetadataField::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('META???')),
            'name' => $this->faker->word,
            'external_id' => $this->faker->uuid,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'mst_entity_id' => Entity::factory(),
        ];
    }
}
