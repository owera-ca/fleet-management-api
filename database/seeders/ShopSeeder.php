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
        ShopJob::factory()->count(5)->create();
        ShopJobInspection::factory()->count(5)->create();
        ShopJobItem::factory()->count(10)->create();
    }
}
