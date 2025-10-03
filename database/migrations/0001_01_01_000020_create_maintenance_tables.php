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
            $table->integer('schedule_days')->nullable();
            $table->float('schedule_km')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('mst_line_item')
                ->nullable()
                ->constrained('mst_line_item')->onDelete('set null');
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
        Schema::dropIfExists('mst_truck_maintenence');
    }
};
