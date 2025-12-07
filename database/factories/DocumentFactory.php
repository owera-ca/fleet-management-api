<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            'filename' => $this->faker->word . '.pdf',
            'encrypted_filename' => $this->faker->uuid . '.pdf',
            'type' => $this->faker->randomElement(['entity', 'entity_transition']),
            'type_id' => $this->faker->randomNumber(),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
