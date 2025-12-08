<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Driver',
                'description' => 'Use driver app confirm pickup, view previous trips, view and complete own tasks, view own maintenence records, etc.',
            ],
            [
                'name' => 'Payroll',
                'description' => 'View all pickups, trips, tasks, maintenance records. Approve expenses, weights, checks. Responsible for payroll processing.',
            ],
            [
                'name' => 'Shop',
                'description' => 'Shop mechanics. View all damages, create work order, start repair, send invoice, vehicle safety approval.',
            ],
            [
                'name' => 'Customs',
                'description' => 'Custom handlers. View custom requests, provide responses, view shipments, routes, drivers.',
            ],
            [
                'name' => 'Dispatch',
                'description' => 'Handle dispatch. Bid on shipments, create trips, assign drivers. Messaging, invoicing.',
            ],
            [
                'name' => 'Shipper',
                'description' => 'Create shipments, view bids, track shipment, release payment.',
            ],
            [
                'name' => 'Finance',
                'description' => 'View invoices, mark as paid. View sub trips, mark completed. Release pay.',
            ],
            [
                'name' => 'Carrier',
                'description' => 'Add company info, contact info, select dispatchers.',
            ],
            [
                'name' => 'Admin',
                'description' => 'Full access to view all users, roles, shipments, routes, drivers, trucks, maintenance, payrolls, etc. Approve everything.',
            ],
        ];

        $program = \App\Models\Program::first();

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'program_id' => $program?->id
                ]
            );
        }
    }
}
