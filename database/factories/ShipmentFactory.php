<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\Program;
use App\Models\Shipper;
use App\Models\OrgNode;
use App\Models\Dispatch;
use App\Models\ShipAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'calculated_distance' => $this->faker->randomFloat(2, 10, 1000),
            'estimated_amount' => $this->faker->randomFloat(2, 100, 5000),
            'final_amount' => $this->faker->randomFloat(2, 100, 5000),
            'bid_start_date' => $this->faker->dateTime,
            'bid_end_date' => $this->faker->dateTime,
            'status' => $this->faker->randomElement(['create', 'active-bidding', 'awarded', 'in-transit', 'delivered', 'invoice-paid', 'completed']),
            'load_type' => $this->faker->randomElement(['FTL', 'LTL']),
            'program_id' => Program::factory(),
            'shipper_id' => Shipper::factory(),
            'orgnode_id' => OrgNode::factory(),
            'dispatch_id' => Dispatch::factory(),
            'from_address_id' => ShipAddress::factory(),
            'to_address_id' => ShipAddress::factory(),
        ];
    }
}
