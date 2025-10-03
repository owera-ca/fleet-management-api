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
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_document', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable();
            $table->string('encrypted_filename')->nullable();
            $table->enum('type', ['entity', 'entity_transition'])->nullable();
            $table->unsignedBigInteger('type_id')->nullable(); // entity_id or entity_transition_id
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_email', function (Blueprint $table) {
            $table->id();
            $table->longText('subject')->nullable();
            $table->longText('body')->nullable();
            $table->longText('attachments')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->nullable();
            $table->integer('try_counter')->nullable();
            $table->longText('context')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('email_template_id')
                ->nullable()
                ->constrained('mst_email_template')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_sms', function (Blueprint $table) {
            $table->id();
            $table->longText('body')->nullable();
            $table->enum('status', ['pending', 'sent', 'failed'])->nullable();
            $table->integer('try_counter')->nullable();
            $table->longText('context')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('sms_template_id')
                ->nullable()
                ->constrained('mst_sms_template')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_entity_transition', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('def_entity_transition_id')
                ->nullable()
                ->constrained('def_entity_transition')->onDelete('set null');
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
            $table->foreignId('start_by')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('end_by')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_messaging', function (Blueprint $table) {
            $table->id();
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('read_at')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('from_role_id')
                ->nullable()
                ->constrained('mst_role')->onDelete('set null');
            $table->foreignId('from_user_id')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('to_role_id')
                ->nullable()
                ->constrained('mst_role')->onDelete('set null');
            $table->foreignId('to_user_id')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('read_by')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('metadata_id')
                ->nullable()
                ->constrained('mst_metadata')->onDelete('set null');
            $table->foreignId('entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
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
        Schema::dropIfExists('tbl_asset');
        Schema::dropIfExists('tbl_document');
        Schema::dropIfExists('tbl_email');
        Schema::dropIfExists('tbl_sms');
        Schema::dropIfExists('tbl_entity_transition');
        Schema::dropIfExists('tbl_messaging');
        Schema::dropIfExists('tbl_metadata');
    }
};
