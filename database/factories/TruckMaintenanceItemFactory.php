<?php

namespace Database\Factories;

use App\Models\TruckMaintenanceItem;
use App\Models\TruckMaintenance;
use App\Models\LineItem;
use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckMaintenanceItemFactory extends Factory
{
    protected $model = TruckMaintenanceItem::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 500),
            'qty' => $this->faker->randomFloat(2, 1, 10),
            'composite_price' => $this->faker->randomFloat(2, 10, 5000),
            'truck_maintenance_id' => TruckMaintenance::factory(),
            'mst_line_item_id' => LineItem::factory(),
            'program_id' => Program::factory(),
        ];
    }
}
