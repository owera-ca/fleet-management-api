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
        //Province::factory()->count(5)->create();
        $program = Program::firstOrCreate(['name' => 'Default Program'], ['code' => 'DEF']);
        Address::factory()->count(10)->create(['program_id' => $program->id]);
        Entity::factory()->count(5)->create(['program_id' => $program->id]);
        DocumentType::factory()->count(3)->create(['program_id' => $program->id]);
        EmailTemplate::factory()->count(2)->create(['program_id' => $program->id]);
        SmsTemplate::factory()->count(2)->create(['program_id' => $program->id]);
        Event::factory()->count(3)->create(['program_id' => $program->id]);
        LineItem::factory()->count(10)->create(['program_id' => $program->id]);
        MetadataField::factory()->count(5)->create(['program_id' => $program->id]);
        Shop::factory()->count(2)->create(['program_id' => $program->id]);
        OrgNode::factory()->count(3)->create(['program_id' => $program->id]);
        //Role::factory()->count(3)->create(['program_id' => $program->id]);
    }
}
