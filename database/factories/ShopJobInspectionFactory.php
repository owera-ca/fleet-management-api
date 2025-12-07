<?php

namespace Database\Factories;

use App\Models\ShopJobInspection;
use App\Models\Program;
use App\Models\ShopJob;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopJobInspectionFactory extends Factory
{
    protected $model = ShopJobInspection::class;

    public function definition()
    {
        return [
            'inspected_at' => $this->faker->dateTime,
            'result' => $this->faker->randomElement(['ok', 'not ok']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'program_id' => Program::factory(),
            'shop_job_id' => ShopJob::factory(),
        ];
    }
}
