<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarrierDispatch;
use App\Models\ShipAddress;
use App\Models\Shipment;
use App\Models\Cargo;
use App\Models\ShipmentBid;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Carrier;
use App\Models\Shipper;

class ShipperTransSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        Carrier::factory()->count(3)->create(['program_id' => $program?->id]);
        Shipper::factory()->count(3)->create(['program_id' => $program?->id]);
        CarrierDispatch::factory()->count(5)->create(['program_id' => $program?->id]);
        ShipAddress::factory()->count(5)->create(['program_id' => $program?->id]);
        Shipment::factory()->count(5)->create(['program_id' => $program?->id]);
        Cargo::factory()->count(10)->create(['program_id' => $program?->id]);
        ShipmentBid::factory()->count(5)->create(['program_id' => $program?->id]);
        Transaction::factory()->count(10)->create(['program_id' => $program?->id]);
        Order::factory()->count(5)->create(['program_id' => $program?->id]);
        OrderItem::factory()->count(10)->create(['program_id' => $program?->id]);
    }
}
