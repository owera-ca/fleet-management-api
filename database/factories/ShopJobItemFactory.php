<?php

namespace Database\Factories;

use App\Models\ShopJobItem;
use App\Models\Program;
use App\Models\ShopJob;
use App\Models\LineItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopJobItemFactory extends Factory
{
    protected $model = ShopJobItem::class;

    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'qty' => $this->faker->randomFloat(2, 1, 10),
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'program_id' => Program::factory(),
            'shop_job_id' => ShopJob::factory(),
            'mst_line_item_id' => LineItem::factory(),
        ];
    }
}
