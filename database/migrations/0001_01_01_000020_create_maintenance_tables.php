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
        Schema::create('mst_truck_maintenence', function (Blueprint $table) {
            $table->id();
            $table->integer('mst_line_item')->nullable();
            $table->integer('schedule_days')->nullable();
            $table->float('schedule_km')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('mst_line_item')->references('id')->on('mst_line_item')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_truck_maintenence');
    }
};
