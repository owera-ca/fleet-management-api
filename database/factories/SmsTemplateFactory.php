<?php

namespace Database\Factories;

use App\Models\SmsTemplate;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmsTemplateFactory extends Factory
{
    protected $model = SmsTemplate::class;

    public function definition()
    {
        return [
            'sms_body_text' => $this->faker->sentence,
            'sms_body_params' => json_encode(['param1', 'param2']),
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
        ];
    }
}
