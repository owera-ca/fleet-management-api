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
            $table->integer('entity_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('def_entities')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('def_programs')->onDelete('cascade');
        });

        Schema::create('def_entity_transition', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id')->nullable();
            $table->string('code', 50)->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('def_entities')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('def_programs')->onDelete('cascade');
        });

        Schema::create('def_entity_transition_role', function (Blueprint $table) {
            $table->id();
            $table->integer('def_entity_transition_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('def_entity_transition_id')->references('id')->on('def_entity_transition')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('def_programs')->onDelete('cascade');
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
