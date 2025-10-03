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

        Schema::create('tbl_trip', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_damage', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->longText('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'penalty'])->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('tbl_trip')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_logbook', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->enum('reason_stop', ['break', 'fuel', 'delivered'])->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('tbl_trip')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_pickup_drop', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id')->nullable();
            $table->enum('type', ['pickup', 'drop'])->nullable();
            $table->integer('cargo_id')->nullable();
            $table->integer('ship_address_id')->nullable();
            $table->integer('representative_address_id')->nullable();
            $table->enum('status', ['pending', 'completed'])->nullable();
            $table->integer('sort_order')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('trip_id')->references('id')->on('tbl_trip')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('mst_cargo')->onDelete('set null');
            $table->foreign('ship_address_id')->references('id')->on('tbl_ship_address')->onDelete('set null');
            $table->foreign('representative_address_id')->references('id')->on('mst_address')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_expense', function (Blueprint $table) {
            $table->id();
            $table->integer('shipment_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->longText('description')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->enum('status', ['pending', 'approved', 'refused'])->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('shipment_id')->references('id')->on('tbl_shipment')->onDelete('set null');
            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_expense_item', function (Blueprint $table) {
            $table->id();
            $table->integer('expense_id')->nullable();
            $table->integer('mst_line_item_id')->nullable();
            $table->float('price')->nullable();
            $table->integer('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('expense_id')->references('id')->on('tbl_expense')->onDelete('cascade');
            $table->foreign('mst_line_item_id')->references('id')->on('mst_line_item')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_trip');
        Schema::dropIfExists('tbl_trip_damage');
        Schema::dropIfExists('tbl_trip_logbook');
        Schema::dropIfExists('tbl_trip_pickup_drop');
        Schema::dropIfExists('tbl_expense');
        Schema::dropIfExists('tbl_expense_item');
    }
};
