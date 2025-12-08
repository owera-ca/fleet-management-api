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
        Schema::create('tbl_carrier_dispatch', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_suspended')->default(false);
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('carrier_id')
                ->nullable()
                ->constrained('tbl_carrier')->onDelete('set null');
            $table->foreignId('dispatch_id')
                ->nullable()
                ->constrained('tbl_dispatch')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_ship_address', function (Blueprint $table) {
            $table->id();
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable();
            $table->string('email')->nullable();
            $table->string('alt_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('addr1')->nullable();
            $table->string('addr2')->nullable();
            $table->string('postal_zip')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('province_state_id')
                ->nullable()
                ->constrained('mst_province')->onDelete('set null');
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('mst_country')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shipment', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->float('calculated_distance')->nullable();
            $table->float('estimated_amount')->nullable();
            $table->float('final_amount')->nullable();
            $table->dateTime('bid_start_date')->nullable();
            $table->dateTime('bid_end_date')->nullable();
            $table->enum('status', ['create', 'active-bidding', 'awarded', 'in-transit', 'delivered', 'invoice-paid', 'completed'])->nullable();
            $table->enum('load_type', ['FTL', 'LTL'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shipper_id')
                ->nullable()
                ->constrained('tbl_shipper')->onDelete('set null');
            $table->foreignId('orgnode_id')
                ->nullable()
                ->constrained('mst_orgnode')->onDelete('set null');
            $table->foreignId('dispatch_id')
                ->nullable()
                ->constrained('tbl_dispatch')->onDelete('set null');
            $table->foreignId('from_address_id')
                ->nullable()
                ->constrained('tbl_ship_address')->onDelete('set null');
            $table->foreignId('to_address_id')
                ->nullable()
                ->constrained('tbl_ship_address')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_cargo', function (Blueprint $table) {
            $table->id();
            $table->float('weight')->nullable();
            $table->float('length')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->boolean('is_fragile')->default(false);
            $table->longText('contents')->nullable();
            $table->longText('notes')->nullable();
            $table->enum('status', ['created', 'labels-generated', 'pickup-done', 'post-pickup-transit', 'before-customs', 'in-customs', 'customs-cleared', 'post-custom-transit', 'arrived-destination', 'awaiting-confirmation', 'delivered'])->nullable();
            $table->string('pars_code')->nullable();
            $table->string('ccd_code')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shipper_id')
                ->nullable()
                ->constrained('tbl_shipper')->onDelete('set null');
            $table->foreignId('shipment_id')
                ->nullable()
                ->constrained('tbl_shipment')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });


        Schema::create('tbl_shipment_bid', function (Blueprint $table) {
            $table->id();
            $table->longText('proposal_text')->nullable();
            $table->float('bid_amount')->nullable();
            $table->float('sla_hours')->nullable();
            $table->enum('state', ['active', 'retracted', 'expired', 'awarded'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shipment_id')
                ->nullable()
                ->constrained('tbl_shipment')->onDelete('set null');
            $table->foreignId('shipper_id')
                ->nullable()
                ->constrained('tbl_shipper')->onDelete('set null');
            $table->foreignId('carrier_id')
                ->nullable()
                ->constrained('tbl_carrier')->onDelete('set null');
            $table->foreignId('dispatch_id')
                ->nullable()
                ->constrained('tbl_dispatch')->onDelete('set null');
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
        Schema::dropIfExists('tbl_shipment_bid');
        Schema::dropIfExists('tbl_cargo');
        Schema::dropIfExists('tbl_shipment');
        Schema::dropIfExists('tbl_ship_address');
        Schema::dropIfExists('tbl_carrier_dispatch');
    }
};
