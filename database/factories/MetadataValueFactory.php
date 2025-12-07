<?php

namespace Database\Factories;

use App\Models\MetadataValue;
use App\Models\Program;
use App\Models\MetadataField;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetadataValueFactory extends Factory
{
    protected $model = MetadataValue::class;

    public function definition()
    {
        return [
            'value' => $this->faker->word,
            'program_id' => Program::factory(),
            'metadata_id' => MetadataField::factory(),
            'entity_id' => Entity::factory(),
        ];
    }
}
