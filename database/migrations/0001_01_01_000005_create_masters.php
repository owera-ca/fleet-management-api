<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->softDeletes();
        });

        Schema::create('mst_province', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3_code', 3)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('country_id')
                ->nullable()
                ->constrained('mst_country')->onDelete('set null');
        });

        Schema::disableForeignKeyConstraints();

        Schema::create('mst_program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('company_address_id')
                ->nullable()
                ->constrained('tbl_address')->onDelete('set null');
            $table->foreignId('representative_address_id')
                ->nullable()
                ->constrained('tbl_address')->onDelete('set null');
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
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('mst_country')->onDelete('cascade');
            $table->foreignId('province_state_id')
                ->nullable()
                ->constrained('mst_province')->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();

        Schema::create('mst_entity', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('table')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_document', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_email_template', function (Blueprint $table) {
            $table->id();
            $table->longText('subject_line')->nullable();
            $table->longText('subject_params')->nullable();
            $table->longText('body_text')->nullable();
            $table->longText('body_params')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_sms_template', function (Blueprint $table) {
            $table->id();
            $table->longText('sms_body_text')->nullable();
            $table->longText('sms_body_params')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_event', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->nullable();
            $table->string('event_code')->nullable();
            $table->string('roles')->nullable();
            $table->boolean('send_email')->default(false);
            $table->boolean('send_sms')->default(false);
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
            $table->foreignId('email_template_id')
                ->nullable()
                ->constrained('mst_email_template')->onDelete('set null');
            $table->foreignId('sms_template_id')
                ->nullable()
                ->constrained('mst_sms_template')->onDelete('set null');
        });

        Schema::create('mst_line_item', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->float('price')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('cascade');
        });

        Schema::create('mst_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('external_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
            $table->foreignId('mst_entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
        });

        Schema::create('tbl_shop', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
            $table->foreignId('shop_address_id')
                ->nullable()
                ->constrained('tbl_address')->onDelete('set null');
            $table->foreignId('representative_address_id')
                ->nullable()
                ->constrained('tbl_address')->onDelete('set null');
        });

        Schema::create('mst_orgnode', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('_lft')->nullable();
            $table->integer('_rgt')->nullable();
            $table->integer('depth')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('mst_orgnode');
        Schema::dropIfExists('tbl_shop');
        Schema::dropIfExists('mst_metadata');
        Schema::dropIfExists('mst_line_item');
        Schema::dropIfExists('mst_event');
        Schema::dropIfExists('mst_sms_template');
        Schema::dropIfExists('mst_email_template');
        Schema::dropIfExists('mst_document');
        Schema::dropIfExists('mst_entity');
        Schema::dropIfExists('tbl_address');
        Schema::dropIfExists('mst_program');
        Schema::dropIfExists('mst_province');
        Schema::dropIfExists('mst_country');
        Schema::enableForeignKeyConstraints();
    }
};
