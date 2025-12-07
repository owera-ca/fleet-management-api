<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Program;
use App\Models\Address;
use App\Models\Entity;
use App\Models\DocumentType;
use App\Models\EmailTemplate;
use App\Models\SmsTemplate;
use App\Models\Event;
use App\Models\LineItem;
use App\Models\MetadataField;
use App\Models\Shop;
use App\Models\OrgNode;
use App\Models\Role;

class MasterSeeder extends Seeder
{
    public function run()
    {
        Province::factory()->count(5)->create();
        Program::factory()->count(3)->create();
        Address::factory()->count(10)->create();
        Entity::factory()->count(5)->create();
        DocumentType::factory()->count(3)->create();
        EmailTemplate::factory()->count(2)->create();
        SmsTemplate::factory()->count(2)->create();
        Event::factory()->count(3)->create();
        LineItem::factory()->count(10)->create();
        MetadataField::factory()->count(5)->create();
        Shop::factory()->count(2)->create();
        OrgNode::factory()->count(3)->create();
        Role::factory()->count(3)->create();
    }
}
