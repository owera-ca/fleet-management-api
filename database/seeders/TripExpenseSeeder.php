<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;
use App\Models\TripDamage;
use App\Models\TripLogbook;
use App\Models\TripPickupDrop;
use App\Models\Expense;
use App\Models\ExpenseItem;

class TripExpenseSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        Trip::factory()->count(5)->create(['program_id' => $program?->id]);
        TripDamage::factory()->count(3)->create(['program_id' => $program?->id]);
        TripLogbook::factory()->count(10)->create(['program_id' => $program?->id]);
        TripPickupDrop::factory()->count(10)->create(['program_id' => $program?->id]);
        Expense::factory()->count(5)->create(['program_id' => $program?->id]);
        ExpenseItem::factory()->count(10)->create(['program_id' => $program?->id]);
    }
}
