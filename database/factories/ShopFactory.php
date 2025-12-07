<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\Program;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition()
    {
        return [
            'shop_name' => $this->faker->company,
            'parent_id' => null,
            '_lft' => 0,
            '_rgt' => 0,
            'depth' => 0,
            'program_id' => Program::factory(),
            'shop_address_id' => Address::factory(),
            'representative_address_id' => Address::factory(),
        ];
    }
}
