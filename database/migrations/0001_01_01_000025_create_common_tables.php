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
        Schema::create('tbl_asset', function (Blueprint $table) {
            $table->id();
            $table->string('content_type')->nullable();
            $table->string('filename')->nullable();
            $table->string('encrypted_filename')->nullable();
            $table->boolean('is_sensitive')->default(false);
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_document', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable();
            $table->string('encrypted_filename')->nullable();
            $table->enum('type', ['entity', 'entity_transition'])->nullable();
            $table->integer('type_id')->nullable(); // entity_id or entity_transition_id
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_email', function (Blueprint $table) {
            $table->id();
            $table->integer('email_template_id')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('body')->nullable();
            $table->longText('attachments')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->nullable();
            $table->integer('try_counter')->nullable();
            $table->longText('context')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('email_template_id')->references('id')->on('mst_email_template')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_sms', function (Blueprint $table) {
            $table->id();
            $table->integer('sms_template_id')->nullable();
            $table->longText('body')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->nullable();
            $table->integer('try_counter')->nullable();
            $table->longText('context')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('sms_template_id')->references('id')->on('mst_sms_template')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_entity_transition', function (Blueprint $table) {
            $table->id();
            $table->integer('def_entity_transition_id')->nullable();
            $table->integer('entity_id')->nullable();
            $table->integer('start_by')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->integer('end_by')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('def_entity_transition_id')->references('id')->on('mst_entity_transition')->onDelete('set null');
            $table->foreign('entity_id')->references('id')->on('mst_entity')->onDelete('set null');
            $table->foreign('start_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('end_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_messaging', function (Blueprint $table) {
            $table->id();
            $table->integer('from_role')->nullable();
            $table->integer('from_role_id')->nullable();
            $table->integer('to_role')->nullable();
            $table->integer('to_role_id')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->integer('read_by')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->longText('message')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('from_role')->references('id')->on('mst_role')->onDelete('set null');
            $table->foreign('from_role_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('to_role')->references('id')->on('mst_role')->onDelete('set null');
            $table->foreign('to_role_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('read_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_metadata', function (Blueprint $table) {
            $table->id();
            $table->integer('metadata_id')->nullable();
            $table->integer('entity_id')->nullable();
            $table->string('value')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('metadata_id')->references('id')->on('mst_metadata')->onDelete('set null');
            $table->foreign('entity_id')->references('id')->on('mst_entity')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_asset');
        Schema::dropIfExists('tbl_document');
        Schema::dropIfExists('tbl_email');
        Schema::dropIfExists('tbl_sms');
        Schema::dropIfExists('tbl_entity_transition');
        Schema::dropIfExists('tbl_messaging');
        Schema::dropIfExists('tbl_metadata');
    }
};
