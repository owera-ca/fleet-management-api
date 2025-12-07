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
        Asset::factory()->count(5)->create();
        Document::factory()->count(5)->create();
        Email::factory()->count(5)->create();
        Sms::factory()->count(5)->create();
        EntityTransition::factory()->count(5)->create();
        Messaging::factory()->count(5)->create();
        MetadataValue::factory()->count(5)->create();
    }
}
