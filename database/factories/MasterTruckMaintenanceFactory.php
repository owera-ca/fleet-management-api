<?php

namespace Database\Factories;

use App\Models\MasterTruckMaintenance;
use App\Models\Program;
use App\Models\LineItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MasterTruckMaintenanceFactory extends Factory
{
    protected $model = MasterTruckMaintenance::class;

    public function definition()
    {
        return [
            'schedule_days' => $this->faker->numberBetween(30, 365),
            'schedule_km' => $this->faker->randomFloat(2, 5000, 50000),
            'notes' => $this->faker->sentence,
            'mst_line_item' => LineItem::factory(),
            'program_id' => Program::factory(),
        ];
    }
}
