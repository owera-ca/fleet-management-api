<?php

namespace Database\Factories;

use App\Models\Sms;
use App\Models\Program;
use App\Models\SmsTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmsFactory extends Factory
{
    protected $model = Sms::class;

    public function definition()
    {
        return [
            'body' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'sent', 'failed']),
            'try_counter' => $this->faker->numberBetween(0, 3),
            'context' => json_encode(['key' => 'value']),
            'program_id' => Program::factory(),
            'sms_template_id' => SmsTemplate::factory(),
        ];
    }
}
