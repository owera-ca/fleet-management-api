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
        Schema::create('tbl_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->float('amount')->nullable();
            $table->string('unique_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('tbl_order')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_order', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['shipment', 'expense', 'shop'])->nullable();
            $table->integer('from_id')->nullable();
            $table->integer('to_id')->nullable();
            $table->integer('trans_id')->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('from_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable();
            $table->integer('entity_id')->nullable();
            $table->float('price')->nullable();
            $table->integer('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('mst_entity')->onDelete('set null');
            $table->foreign('order_id')->references('id')->on('tbl_order')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_trans');
        Schema::dropIfExists('tbl_order_item');
        Schema::dropIfExists('tbl_order');
    }
};
