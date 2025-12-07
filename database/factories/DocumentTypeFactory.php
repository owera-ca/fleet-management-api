<?php

namespace Database\Factories;

use App\Models\DocumentType;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    protected $model = DocumentType::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('DOC???')),
            'name' => $this->faker->word,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
