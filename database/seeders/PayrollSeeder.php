<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll;
use App\Models\PayrollItem;

class PayrollSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        Payroll::factory()->count(3)->create(['program_id' => $program?->id]);
        PayrollItem::factory()->count(10)->create(['program_id' => $program?->id]);
    }
}
