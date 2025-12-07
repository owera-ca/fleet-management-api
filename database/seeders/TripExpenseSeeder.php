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
        Trip::factory()->count(5)->create();
        TripDamage::factory()->count(3)->create();
        TripLogbook::factory()->count(10)->create();
        TripPickupDrop::factory()->count(10)->create();
        Expense::factory()->count(5)->create();
        ExpenseItem::factory()->count(10)->create();
    }
}
