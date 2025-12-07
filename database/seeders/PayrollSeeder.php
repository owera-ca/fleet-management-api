<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll;
use App\Models\PayrollItem;

class PayrollSeeder extends Seeder
{
    public function run()
    {
        Payroll::factory()->count(3)->create();
        PayrollItem::factory()->count(10)->create();
    }
}
