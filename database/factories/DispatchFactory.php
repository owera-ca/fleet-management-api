<?php

namespace Database\Factories;

use App\Models\Dispatch;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DispatchFactory extends Factory
{
    protected $model = Dispatch::class;

    public function definition()
    {
        return [
            'notes' => $this->faker->sentence,
            'program_id' => Program::factory(),
            'user_id' => User::factory(),
        ];
    }
}
