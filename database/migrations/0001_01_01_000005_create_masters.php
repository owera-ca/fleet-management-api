<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {  

        Schema::create('mst_country', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3_code', 3)->nullable();
            $table->timestamps();
        });

        Schema::create('mst_province', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3_code', 3)->nullable();
            $table->integer('country_id')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('mst_country')->onDelete('cascade');
        });

        Schema::create('tbl_address', function (Blueprint $table) {
            $table->id();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->nullable();
            $table->string('alt_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('addr1')->nullable();
            $table->string('addr2')->nullable();
            $table->string('postal_zip')->nullable();
            $table->integer('province_state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('mst_country')->onDelete('cascade');
            $table->foreign('province_state_id')->references('id')->on('mst_province')->onDelete('cascade');
        });

        Schema::create('mst_program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('company_address_id')->nullable();
            $table->integer('representative_address_id')->nullable();
            $table->timestamps();
        });

        Schema::create('mst_entity', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('table')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_document', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_email_template', function (Blueprint $table) {
            $table->id();
            $table->longText('subject_line')->nullable();
            $table->longText('subject_params')->nullable();
            $table->longText('body_text')->nullable();
            $table->longText('body_params')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_sms_template', function (Blueprint $table) {
            $table->id();
            $table->longText('sms_body_text')->nullable();
            $table->longText('sms_body_params')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_event', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->nullable();
            $table->string('event_code')->nullable();
            $table->string('roles')->nullable();
            $table->integer('email_template_id')->nullable();
            $table->integer('sms_template_id')->nullable();
            $table->boolean('send_email')->default(false);
            $table->boolean('send_sms')->default(false);
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
            $table->foreign('email_template_id')->references('id')->on('mst_email_template')->onDelete('cascade');
            $table->foreign('sms_template_id')->references('id')->on('mst_sms_template')->onDelete('cascade');
        });

        Schema::create('mst_line_item', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->float('price')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->integer('mst_entity_id')->nullable();
            $table->string('external_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
            $table->foreign('mst_entity_id')->references('id')->on('mst_entity')->onDelete('cascade');
        });

        Schema::create('tbl_shop', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->integer('shop_address_id')->nullable();
            $table->integer('representative_address_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
            $table->foreign('shop_address_id')->references('id')->on('tbl_address')->onDelete('set null');
            $table->foreign('representative_address_id')->references('id')->on('tbl_address')->onDelete('set null');
        });

        Schema::create('mst_orgnode', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_country');
        Schema::dropIfExists('mst_province');
        Schema::dropIfExists('tbl_address');
        Schema::dropIfExists('mst_program');
        Schema::dropIfExists('mst_entity');
        Schema::dropIfExists('mst_document');
        Schema::dropIfExists('mst_email_template');
        Schema::dropIfExists('mst_sms_template');
        Schema::dropIfExists('mst_event');
        Schema::dropIfExists('mst_line_item');
        Schema::dropIfExists('mst_metadata');
        Schema::dropIfExists('tbl_shop');
        Schema::dropIfExists('mst_orgnode');
    }
};
