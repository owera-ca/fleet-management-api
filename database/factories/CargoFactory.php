<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Program;
use App\Models\Shipper;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CargoFactory extends Factory
{
    protected $model = Cargo::class;

    public function definition()
    {
        return [
            'weight' => $this->faker->randomFloat(2, 10, 1000),
            'length' => $this->faker->randomFloat(2, 1, 5),
            'width' => $this->faker->randomFloat(2, 1, 3),
            'height' => $this->faker->randomFloat(2, 1, 3),
            'is_fragile' => $this->faker->boolean,
            'contents' => $this->faker->sentence,
            'notes' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['created', 'labels-generated', 'pickup-done', 'post-pickup-transit', 'before-customs', 'in-customs', 'customs-cleared', 'post-custom-transit', 'arrived-destination', 'awaiting-confirmation', 'delivered']),
            'pars_code' => strtoupper($this->faker->bothify('PARS-#####')),
            'ccd_code' => strtoupper($this->faker->bothify('CCD-#####')),
            'program_id' => Program::factory(),
            'shipper_id' => Shipper::factory(),
            'shipment_id' => Shipment::factory(),
        ];
    }
}
