<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrgNode;
use App\Models\Country;
use App\Models\Province;
use App\Models\Program;
use Illuminate\Support\Str;

class OrgNodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $program = Program::first(); // Assuming default program exists
        $programId = $program?->id;
        $programCode = $program?->code ?? 'DEF';

        $countries = Country::all();

        // City mapping for major provinces/states
        $cityMap = [
            'California' => ['Los Angeles', 'San Francisco', 'San Diego'],
            'New York' => ['New York City', 'Buffalo'],
            'Texas' => ['Houston', 'Austin', 'Dallas'],
            'Ontario' => ['Toronto', 'Ottawa'],
            'Quebec' => ['Montreal', 'Quebec City'],
            'British Columbia' => ['Vancouver', 'Victoria'],
        ];

        foreach ($countries as $country) {
            // 1. Create Root Node for Country
            // root_id = country_id as requested
            $countryNode = OrgNode::create([
                'name' => $country->name,
                'code' => $country->iso3_code . '-' . $programCode,
                'program_id' => $programId,
                'root_id' => $country->id,
            ]);

            // Fetch provinces for this country
            $provinces = Province::where('country_id', $country->id)->get();

            foreach ($provinces as $province) {
                // 2. Create Child Node for Province
                $provinceNode = OrgNode::create([
                    'name' => $province->name,
                    'code' => $country->iso3_code . '-' . Str::kebab($province->name) . '-' . $programCode,
                    'program_id' => $programId,
                    'parent_id' => $countryNode->id,
                    'root_id' => $country->id,
                ]);

                // 3. Create City Nodes if mapped
                if (isset($cityMap[$province->name])) {
                    foreach ($cityMap[$province->name] as $city) {
                        OrgNode::create([
                            'name' => $city,
                            'code' => $country->iso3_code . '-' . Str::kebab($city) . '-' . $programCode,
                            'program_id' => $programId,
                            'parent_id' => $provinceNode->id,
                            'root_id' => $country->id,
                        ]);
                    }
                }
            }
        }
    }
}
