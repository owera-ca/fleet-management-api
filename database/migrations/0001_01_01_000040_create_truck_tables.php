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
        Schema::create('tbl_truck', function (Blueprint $table) {
            $table->id();
            $table->integer('carrier_id')->nullable();
            $table->string('vin')->nullable();
            $table->string('number_plate')->nullable();
            $table->dateTime('registered_at')->nullable();
            $table->float('total_km')->nullable();
            $table->enum('status', ['pending-registration', 'in-service', 'in-shop', 'retured', 'suspended'])->nullable();
            $table->float('towing_capacity_kg')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('carrier_id')->references('id')->on('tbl_carrier')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_truck_maintenance', function (Blueprint $table) {
            $table->id();
            $table->integer('mst_truck_maintenance_id')->nullable();
            $table->integer('truck_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->enum('status', ['pending', 'in-progress', 'inspection', 'completed', 'cancelled'])->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('mst_truck_maintenance_id')->references('id')->on('mst_truck_maintenance')->onDelete('set null');
            $table->foreign('truck_id')->references('id')->on('tbl_truck')->onDelete('set null');
            $table->foreign('shop_id')->references('id')->on('tbl_shop')->onDelete('set null');
        });

        Schema::create('tbl_truck_maintenance_item', function (Blueprint $table) {
            $table->id();
            $table->integer('truck_maintenance_id')->nullable();
            $table->integer('mst_line_item_id')->nullable();
            $table->float('price')->nullable();
            $table->float('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('truck_maintenance_id')->references('id')->on('tbl_truck_maintenance')->onDelete('cascade');
            $table->foreign('mst_line_item_id')->references('id')->on('mst_line_item')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_truck_tracking', function (Blueprint $table) {
            $table->id();
            $table->integer('truck_id')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('truck_id')->references('id')->on('tbl_truck')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_truck');
        Schema::dropIfExists('tbl_truck_maintenance');
        Schema::dropIfExists('tbl_truck_maintenance_item');
        Schema::dropIfExists('tbl_truck_tracking');
    }
};
