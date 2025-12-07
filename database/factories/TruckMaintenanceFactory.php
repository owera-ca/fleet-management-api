<?php

namespace Database\Factories;

use App\Models\TruckMaintenance;
use App\Models\MasterTruckMaintenance;
use App\Models\Truck;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckMaintenanceFactory extends Factory
{
    protected $model = TruckMaintenance::class;

    public function definition()
    {
        return [
            'subtotal' => $this->faker->randomFloat(2, 100, 5000),
            'total' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'inspection', 'completed', 'cancelled']),
            'notes' => $this->faker->sentence,
            'mst_truck_maintenance_id' => MasterTruckMaintenance::factory(),
            'truck_id' => Truck::factory(),
            'shop_id' => Shop::factory(),
        ];
    }
}
