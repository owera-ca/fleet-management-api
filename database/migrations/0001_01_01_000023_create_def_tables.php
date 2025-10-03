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

        Schema::create('def_entity_role', function (Blueprint $table) {
            $table->id();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('mst_role')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('def_entity_transition', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('sort_order')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('def_entity_transition_role', function (Blueprint $table) {
            $table->id();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('def_entity_transition_id')
                ->nullable()
                ->constrained('def_entity_transition')->onDelete('set null');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('mst_role')->onDelete('set null');
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
        Schema::dropIfExists('def_entity_role');
        Schema::dropIfExists('def_entity_transition');
        Schema::dropIfExists('def_entity_transition_role');
    }
};
