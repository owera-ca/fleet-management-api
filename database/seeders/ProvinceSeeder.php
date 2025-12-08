<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Country;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usa = Country::where('iso3_code', 'USA')->first();
        $canada = Country::where('iso3_code', 'CAN')->first();

        // US States
        $usStates = [
            ['name' => 'Alabama', 'iso3_code' => 'AL'],
            ['name' => 'Alaska', 'iso3_code' => 'AK'],
            ['name' => 'Arizona', 'iso3_code' => 'AZ'],
            ['name' => 'Arkansas', 'iso3_code' => 'AR'],
            ['name' => 'California', 'iso3_code' => 'CA'],
            ['name' => 'Colorado', 'iso3_code' => 'CO'],
            ['name' => 'Connecticut', 'iso3_code' => 'CT'],
            ['name' => 'Delaware', 'iso3_code' => 'DE'],
            ['name' => 'Florida', 'iso3_code' => 'FL'],
            ['name' => 'Georgia', 'iso3_code' => 'GA'],
            ['name' => 'Hawaii', 'iso3_code' => 'HI'],
            ['name' => 'Idaho', 'iso3_code' => 'ID'],
            ['name' => 'Illinois', 'iso3_code' => 'IL'],
            ['name' => 'Indiana', 'iso3_code' => 'IN'],
            ['name' => 'Iowa', 'iso3_code' => 'IA'],
            ['name' => 'Kansas', 'iso3_code' => 'KS'],
            ['name' => 'Kentucky', 'iso3_code' => 'KY'],
            ['name' => 'Louisiana', 'iso3_code' => 'LA'],
            ['name' => 'Maine', 'iso3_code' => 'ME'],
            ['name' => 'Maryland', 'iso3_code' => 'MD'],
            ['name' => 'Massachusetts', 'iso3_code' => 'MA'],
            ['name' => 'Michigan', 'iso3_code' => 'MI'],
            ['name' => 'Minnesota', 'iso3_code' => 'MN'],
            ['name' => 'Mississippi', 'iso3_code' => 'MS'],
            ['name' => 'Missouri', 'iso3_code' => 'MO'],
            ['name' => 'Montana', 'iso3_code' => 'MT'],
            ['name' => 'Nebraska', 'iso3_code' => 'NE'],
            ['name' => 'Nevada', 'iso3_code' => 'NV'],
            ['name' => 'New Hampshire', 'iso3_code' => 'NH'],
            ['name' => 'New Jersey', 'iso3_code' => 'NJ'],
            ['name' => 'New Mexico', 'iso3_code' => 'NM'],
            ['name' => 'New York', 'iso3_code' => 'NY'],
            ['name' => 'North Carolina', 'iso3_code' => 'NC'],
            ['name' => 'North Dakota', 'iso3_code' => 'ND'],
            ['name' => 'Ohio', 'iso3_code' => 'OH'],
            ['name' => 'Oklahoma', 'iso3_code' => 'OK'],
            ['name' => 'Oregon', 'iso3_code' => 'OR'],
            ['name' => 'Pennsylvania', 'iso3_code' => 'PA'],
            ['name' => 'Rhode Island', 'iso3_code' => 'RI'],
            ['name' => 'South Carolina', 'iso3_code' => 'SC'],
            ['name' => 'South Dakota', 'iso3_code' => 'SD'],
            ['name' => 'Tennessee', 'iso3_code' => 'TN'],
            ['name' => 'Texas', 'iso3_code' => 'TX'],
            ['name' => 'Utah', 'iso3_code' => 'UT'],
            ['name' => 'Vermont', 'iso3_code' => 'VT'],
            ['name' => 'Virginia', 'iso3_code' => 'VA'],
            ['name' => 'Washington', 'iso3_code' => 'WA'],
            ['name' => 'West Virginia', 'iso3_code' => 'WV'],
            ['name' => 'Wisconsin', 'iso3_code' => 'WI'],
            ['name' => 'Wyoming', 'iso3_code' => 'WY'],
            ['name' => 'District of Columbia', 'iso3_code' => 'DC'],
        ];

        if ($usa) {
            foreach ($usStates as $state) {
                Province::firstOrCreate(
                    ['iso3_code' => $state['iso3_code'], 'country_id' => $usa->id],
                    ['name' => $state['name']]
                );
            }
        }

        // Canadian Provinces
        $caProvinces = [
            ['name' => 'Alberta', 'iso3_code' => 'AB'],
            ['name' => 'British Columbia', 'iso3_code' => 'BC'],
            ['name' => 'Manitoba', 'iso3_code' => 'MB'],
            ['name' => 'New Brunswick', 'iso3_code' => 'NB'],
            ['name' => 'Newfoundland and Labrador', 'iso3_code' => 'NL'],
            ['name' => 'Northwest Territories', 'iso3_code' => 'NT'],
            ['name' => 'Nova Scotia', 'iso3_code' => 'NS'],
            ['name' => 'Nunavut', 'iso3_code' => 'NU'],
            ['name' => 'Ontario', 'iso3_code' => 'ON'],
            ['name' => 'Prince Edward Island', 'iso3_code' => 'PE'],
            ['name' => 'Quebec', 'iso3_code' => 'QC'],
            ['name' => 'Saskatchewan', 'iso3_code' => 'SK'],
            ['name' => 'Yukon', 'iso3_code' => 'YT'],
        ];

        if ($canada) {
            foreach ($caProvinces as $province) {
                Province::firstOrCreate(
                    ['iso3_code' => $province['iso3_code'], 'country_id' => $canada->id],
                    ['name' => $province['name']]
                );
            }
        }
    }
}
