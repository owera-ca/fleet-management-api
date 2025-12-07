<?php

namespace Database\Factories;

use App\Models\Email;
use App\Models\Program;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition()
    {
        return [
            'subject' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'attachments' => json_encode(['file1.pdf']),
            'status' => $this->faker->randomElement(['pending', 'sent', 'failed']),
            'try_counter' => $this->faker->numberBetween(0, 3),
            'context' => json_encode(['key' => 'value']),
            'program_id' => Program::factory(),
            'email_template_id' => EmailTemplate::factory(),
        ];
    }
}
