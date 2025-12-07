<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Program;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'event_name' => $this->faker->word,
            'event_code' => strtoupper($this->faker->unique()->lexify('EVT???')),
            'roles' => json_encode(['role1', 'role2']),
            'send_email' => $this->faker->boolean,
            'send_sms' => $this->faker->boolean,
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'email_template_id' => EmailTemplate::factory(),
            'sms_template_id' => SmsTemplate::factory(),
        ];
    }
}
