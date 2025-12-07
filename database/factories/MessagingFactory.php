<?php

namespace Database\Factories;

use App\Models\Messaging;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessagingFactory extends Factory
{
    protected $model = Messaging::class;

    public function definition()
    {
        return [
            'sent_at' => $this->faker->dateTime,
            'read_at' => $this->faker->dateTime,
            'message' => $this->faker->paragraph,
            'program_id' => Program::factory(),
            'from_role_id' => Role::factory(),
            'from_user_id' => User::factory(),
            'to_role_id' => Role::factory(),
            'to_user_id' => User::factory(),
            'read_by' => User::factory(),
        ];
    }
}
