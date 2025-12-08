<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'United States', 'iso3_code' => 'USA'],
            ['name' => 'Canada', 'iso3_code' => 'CAN'],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(
                ['iso3_code' => $country['iso3_code']],
                ['name' => $country['name']]
            );
        }
    }
}
