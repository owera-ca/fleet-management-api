<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntityRoleDefinition;
use App\Models\EntityTransitionDefinition;
use App\Models\EntityTransitionRoleDefinition;


use App\Models\Entity;
use App\Models\Program;

class DefinitionSeeder extends Seeder
{
    public function run()
    {
        // 0. Get Default Program
        $program = Program::first();

        // --- SHIPMENT LIFECYCLE ---

        // 1. Ensure 'Shipment' Entity exists
        $shipmentEntity = Entity::firstOrCreate(
            ['name' => 'Shipment'],
            [
                'code' => 'SHIPMENT',
                'table' => 'tbl_shipment',
                'notes' => 'Shipment entity definition',
                'program_id' => $program?->id,
            ]
        );

        // 2. Define Lifecycle States/Transitions for Shipment
        $shipmentTransitions = [
            ['name' => 'create', 'code' => 'create', 'sort_order' => 1],
            ['name' => 'active-bidding', 'code' => 'active-bidding', 'sort_order' => 2],
            ['name' => 'inactive-bidding', 'code' => 'inactive-bidding', 'sort_order' => 3],
            ['name' => 'awarded', 'code' => 'awarded', 'sort_order' => 4],
            ['name' => 'in-transit', 'code' => 'in-transit', 'sort_order' => 5],
            ['name' => 'delivered', 'code' => 'delivered', 'sort_order' => 6],
            ['name' => 'invoice-paid', 'code' => 'invoice-paid', 'sort_order' => 7],
            ['name' => 'completed', 'code' => 'completed', 'sort_order' => 8],
        ];

        foreach ($shipmentTransitions as $transition) {
            EntityTransitionDefinition::firstOrCreate(
                [
                    'entity_id' => $shipmentEntity->id,
                    'code' => $transition['code'],
                ],
                [
                    'name' => $transition['name'],
                    'sort_order' => $transition['sort_order'],
                    'notes' => 'Shipment lifecycle state: ' . $transition['name'],
                    'program_id' => $program?->id,
                ]
            );
        }

        // --- CARGO LIFECYCLE ---

        // 1. Ensure 'Cargo' Entity exists
        $cargoEntity = Entity::firstOrCreate(
            ['name' => 'Cargo'],
            [
                'code' => 'CARGO',
                'table' => 'tbl_cargo',
                'notes' => 'Cargo entity definition',
                'program_id' => $program?->id,
            ]
        );

        // 2. Define Lifecycle States/Transitions for Cargo
        $cargoTransitions = [
            ['name' => 'created', 'code' => 'created', 'sort_order' => 1],
            ['name' => 'labels-generated', 'code' => 'labels-generated', 'sort_order' => 2],
            ['name' => 'pickup-done', 'code' => 'pickup-done', 'sort_order' => 3],
            ['name' => 'post-pickup-transit', 'code' => 'post-pickup-transit', 'sort_order' => 4],
            ['name' => 'before-customs', 'code' => 'before-customs', 'sort_order' => 5],
            ['name' => 'in-customs', 'code' => 'in-customs', 'sort_order' => 6],
            ['name' => 'customs-cleared', 'code' => 'customs-cleared', 'sort_order' => 7],
            ['name' => 'post-custom-transit', 'code' => 'post-custom-transit', 'sort_order' => 8],
            ['name' => 'arrived-destination', 'code' => 'arrived-destination', 'sort_order' => 9],
            ['name' => 'awaiting-confirmation', 'code' => 'awaiting-confirmation', 'sort_order' => 10],
            ['name' => 'delivered', 'code' => 'delivered', 'sort_order' => 11],
        ];

        foreach ($cargoTransitions as $transition) {
            EntityTransitionDefinition::firstOrCreate(
                [
                    'entity_id' => $cargoEntity->id,
                    'code' => $transition['code'],
                ],
                [
                    'name' => $transition['name'],
                    'sort_order' => $transition['sort_order'],
                    'notes' => 'Cargo lifecycle state: ' . $transition['name'],
                    'program_id' => $program?->id,
                ]
            );
        }
    }
}
