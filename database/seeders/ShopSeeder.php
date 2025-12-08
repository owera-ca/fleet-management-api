<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopJob;
use App\Models\ShopJobInspection;
use App\Models\ShopJobItem;

class ShopSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        ShopJob::factory()->count(5)->create(['program_id' => $program?->id]);
        ShopJobInspection::factory()->count(5)->create(['program_id' => $program?->id]);
        ShopJobItem::factory()->count(10)->create(['program_id' => $program?->id]);
    }
}
