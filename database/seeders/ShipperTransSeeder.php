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
        Carrier::factory()->count(3)->create();
        Shipper::factory()->count(3)->create();
        CarrierDispatch::factory()->count(5)->create();
        ShipAddress::factory()->count(5)->create();
        Shipment::factory()->count(5)->create();
        Cargo::factory()->count(10)->create();
        ShipmentBid::factory()->count(5)->create();
        Transaction::factory()->count(10)->create();
        Order::factory()->count(5)->create();
        OrderItem::factory()->count(10)->create();
    }
}
