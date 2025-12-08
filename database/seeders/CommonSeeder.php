<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
use App\Models\Document;
use App\Models\Email;
use App\Models\Sms;
use App\Models\EntityTransition;
use App\Models\Messaging;
use App\Models\MetadataValue;

class CommonSeeder extends Seeder
{
    public function run()
    {
        $program = \App\Models\Program::first();

        Asset::factory()->count(5)->create(['program_id' => $program?->id]);
        Document::factory()->count(5)->create(['program_id' => $program?->id]);
        Email::factory()->count(5)->create(['program_id' => $program?->id]);
        Sms::factory()->count(5)->create(['program_id' => $program?->id]);
        EntityTransition::factory()->count(5)->create(['program_id' => $program?->id]);
        Messaging::factory()->count(5)->create(['program_id' => $program?->id]);
        MetadataValue::factory()->count(5)->create(['program_id' => $program?->id]);
    }
}
