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

        Schema::create('tbl_trip', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('tbl_driver')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_damage', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->enum('status', ['pending', 'accepted', 'penalty'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('tbl_trip')->onDelete('cascade');
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('tbl_driver')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_logbook', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->enum('reason_stop', ['break', 'fuel', 'delivered'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('tbl_trip')->onDelete('cascade');
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('tbl_driver')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_trip_pickup_drop', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pickup', 'drop'])->nullable();
            $table->enum('status', ['pending', 'completed'])->nullable();
            $table->integer('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('trip_id')
                ->nullable()
                ->constrained('tbl_trip')->onDelete('cascade');
            $table->foreignId('cargo_id')
                ->nullable()
                ->constrained('tbl_cargo')->onDelete('set null');
            $table->foreignId('ship_address_id')
                ->nullable()
                ->constrained('tbl_ship_address')->onDelete('set null');
            $table->foreignId('representative_address_id')
                ->nullable()
                ->constrained('tbl_address')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_expense', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->enum('status', ['pending', 'approved', 'refused'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shipment_id')
                ->nullable()
                ->constrained('tbl_shipment')->onDelete('set null');
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained('tbl_driver')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_expense_item', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->integer('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('expense_id')
                ->nullable()
                ->constrained('tbl_expense')->onDelete('cascade');
            $table->foreignId('mst_line_item_id')
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
        Schema::dropIfExists('tbl_expense_item');
        Schema::dropIfExists('tbl_expense');
        Schema::dropIfExists('tbl_trip_pickup_drop');
        Schema::dropIfExists('tbl_trip_logbook');
        Schema::dropIfExists('tbl_trip_damage');
        Schema::dropIfExists('tbl_trip');
    }
};
