<?php

namespace Database\Factories;

use App\Models\EmailTemplate;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailTemplateFactory extends Factory
{
    protected $model = EmailTemplate::class;

    public function definition()
    {
        return [
            'subject_line' => $this->faker->sentence,
            'subject_params' => json_encode(['param1', 'param2']),
            'body_text' => $this->faker->paragraph,
            'body_params' => json_encode(['param1', 'param2']),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
