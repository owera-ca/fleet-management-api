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
            $table->string('vin')->nullable();
            $table->string('number_plate')->nullable();
            $table->dateTime('registered_at')->nullable();
            $table->float('total_km')->nullable();
            $table->enum('status', ['pending-registration', 'in-service', 'in-shop', 'retured', 'suspended'])->nullable();
            $table->float('towing_capacity_kg')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('carrier_id')
                ->nullable()
                ->constrained('tbl_carrier')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_truck_maintenance', function (Blueprint $table) {
            $table->id();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->enum('status', ['pending', 'in-progress', 'inspection', 'completed', 'cancelled'])->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('mst_truck_maintenance_id')
                ->nullable()
                ->constrained('mst_truck_maintenence')->onDelete('set null');
            $table->foreignId('truck_id')
                ->nullable()
                ->constrained('tbl_truck')->onDelete('set null');
            $table->foreignId('shop_id')
                ->nullable()
                ->constrained('tbl_shop')->onDelete('set null');
        });

        Schema::create('tbl_truck_maintenance_item', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->float('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('truck_maintenance_id')
                ->nullable()
                ->constrained('tbl_truck_maintenance')->onDelete('set null');
            $table->foreignId('mst_line_item_id')
                ->nullable()
                ->constrained('mst_line_item')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_truck_tracking', function (Blueprint $table) {
            $table->id();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('truck_id')
                ->nullable()
                ->constrained('tbl_truck')->onDelete('set null');
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
        Schema::dropIfExists('tbl_truck');
        Schema::dropIfExists('tbl_truck_maintenance');
        Schema::dropIfExists('tbl_truck_maintenance_item');
        Schema::dropIfExists('tbl_truck_tracking');
    }
};
