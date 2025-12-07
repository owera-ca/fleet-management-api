<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Truck;
use App\Models\MasterTruckMaintenance;
use App\Models\TruckMaintenance;
use App\Models\TruckMaintenanceItem;
use App\Models\TruckTracking;

class TruckMaintenanceSeeder extends Seeder
{
    public function run()
    {
        Truck::factory()->count(5)->create();
        MasterTruckMaintenance::factory()->count(3)->create();
        TruckMaintenance::factory()->count(5)->create();
        TruckMaintenanceItem::factory()->count(10)->create();
        TruckTracking::factory()->count(10)->create();
    }
}
