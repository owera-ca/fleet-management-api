<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Driver',
            'Payroll',
            'Shop',
            'Customs',
            'Dispatch',
            'Shipper',
            'Finance',
            'Carrier',
            'Admin',
        ];

        foreach ($roles as $roleName) {
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                $this->command->warn("Role {$roleName} not found. Skipping users for this role.");
                continue;
            }

            $program = Program::first(); // Added this line

            for ($i = 1; $i <= 2; $i++) {
                $email = strtolower($roleName) . $i . '@example.com';

                User::firstOrCreate(
                    ['email' => $email],
                    [
                        'f_name' => $roleName,
                        'l_name' => 'User ' . $i,
                        'password' => Hash::make('password'),
                        'role_id' => $role->id,
                        'phone' => '555-000-' . str_pad($role->id, 3, '0', STR_PAD_LEFT) . $i,
                        'program_id' => $program?->id, // Added this line
                    ]
                );
            }
        }
    }
}
