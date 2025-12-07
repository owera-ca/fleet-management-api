<?php

namespace Database\Factories;

use App\Models\ShipmentBid;
use App\Models\Program;
use App\Models\Shipment;
use App\Models\Shipper;
use App\Models\Carrier;
use App\Models\Dispatch;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentBidFactory extends Factory
{
    protected $model = ShipmentBid::class;

    public function definition()
    {
        return [
            'proposal_text' => $this->faker->paragraph,
            'bid_amount' => $this->faker->randomFloat(2, 100, 5000),
            'sla_hours' => $this->faker->randomFloat(2, 1, 72),
            'state' => $this->faker->randomElement(['active', 'retracted', 'expired', 'awarded']),
            'program_id' => Program::factory(),
            'shipment_id' => Shipment::factory(),
            'shipper_id' => Shipper::factory(),
            'carrier_id' => Carrier::factory(),
            'dispatch_id' => Dispatch::factory(),
        ];
    }
}
