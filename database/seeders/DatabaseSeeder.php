<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            ProvinceSeeder::class,
            MasterSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DefinitionSeeder::class,
            CommonSeeder::class,
            UserDispatchSeeder::class,
            TruckMaintenanceSeeder::class,
            ShopSeeder::class,
            ShipperTransSeeder::class,
            PayrollSeeder::class,
            TripExpenseSeeder::class,
        ]);
    }
}
