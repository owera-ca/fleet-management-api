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
        Schema::create('tbl_carrier_dispatch', function (Blueprint $table) {
            $table->id();
            $table->integer('carrier_id')->nullable();
            $table->integer('dispatch_id')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('carrier_id')->references('id')->on('tbl_carrier')->onDelete('set null');
            $table->foreign('dispatch_id')->references('id')->on('tbl_dispatch')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
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
            $table->integer('province_state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('province_state_id')->references('id')->on('mst_province')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('mst_country')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shipment', function (Blueprint $table) {
            $table->id();
            $table->integer('shipper_id')->nullable();
            $table->integer('orgnode_id')->nullable();
            $table->integer('dispatcher_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->integer('from_address_id')->nullable();
            $table->integer('to_address_id')->nullable();
            $table->float('calculated_distance')->nullable();
            $table->float('estimated_amount')->nullable();
            $table->float('final_amount')->nullable();
            $table->dateTime('bid_start_date')->nullable();
            $table->dateTime('bid_end_date')->nullable();
            $table->enum('status', ['create', 'active-bidding', 'awarded', 'in-transit', 'delivered', 'invoice-paid', 'completed'])->nullable();
            $table->enum('load_type', ['FTL', 'LTL'])->nullable();
            $table->timestamps();

            $table->foreign('shipper_id')->references('id')->on('tbl_shipper')->onDelete('set null');
            $table->foreign('orgnode_id')->references('id')->on('mst_orgnode')->onDelete('set null');
            $table->foreign('dispatcher_id')->references('id')->on('tbl_dispatcher')->onDelete('set null');
            $table->foreign('from_address_id')->references('id')->on('tbl_ship_address')->onDelete('set null');
            $table->foreign('to_address_id')->references('id')->on('tbl_ship_address')->onDelete('set null');
        });

        Schema::create('tbl_cargo', function (Blueprint $table) {
            $table->id();
            $table->integer('shipper_id')->nullable();
            $table->integer('shipment_id')->nullable();
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
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('shipper_id')->references('id')->on('tbl_shipper')->onDelete('set null');
            $table->foreign('shipment_id')->references('id')->on('tbl_shipment')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });


        Schema::create('tbl_shipment_bid', function (Blueprint $table) {
            $table->id();
            $table->integer('shipment_id')->nullable();
            $table->integer('shipper_id')->nullable();
            $table->integer('carrier_id')->nullable();
            $table->integer('dispatch_id')->nullable();
            $table->longText('proposal_text')->nullable();
            $table->float('bid_amount')->nullable();
            $table->float('sla_hours')->nullable();
            $table->enum('state', ['active', 'retracted', 'expired', 'awarded'])->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('shipment_id')->references('id')->on('tbl_shipment')->onDelete('set null');
            $table->foreign('shipper_id')->references('id')->on('tbl_shipper')->onDelete('set null');
            $table->foreign('carrier_id')->references('id')->on('tbl_carrier')->onDelete('set null');
            $table->foreign('dispatch_id')->references('id')->on('tbl_dispatch')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_carrier_dispatch');
        Schema::dropIfExists('tbl_ship_address');
        Schema::dropIfExists('tbl_shipment');
        Schema::dropIfExists('tbl_cargo');
        Schema::dropIfExists('tbl_shipment_bid');
    }
};
