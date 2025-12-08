<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dispatch;
use App\Models\Driver;
use App\Models\Program;

class UserDispatchSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        User::factory()->count(5)->create(['program_id' => $program?->id]);
        Dispatch::factory()->count(5)->create(['program_id' => $program?->id]);
        Driver::factory()->count(5)->create(['program_id' => $program?->id]);
    }
}
