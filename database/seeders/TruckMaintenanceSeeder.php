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
        $program = \App\Models\Program::first();

        Truck::factory()->count(5)->create(['program_id' => $program?->id]);
        MasterTruckMaintenance::factory()->count(3)->create(['program_id' => $program?->id]);
        TruckMaintenance::factory()->count(5)->create(); // No program_id
        TruckMaintenanceItem::factory()->count(10)->create(['program_id' => $program?->id]);
        TruckTracking::factory()->count(10)->create(['program_id' => $program?->id]);
    }
}
