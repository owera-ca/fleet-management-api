<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dispatch;
use App\Models\Driver;

class UserDispatchSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(5)->create();
        Dispatch::factory()->count(5)->create();
        Driver::factory()->count(5)->create();
    }
}
