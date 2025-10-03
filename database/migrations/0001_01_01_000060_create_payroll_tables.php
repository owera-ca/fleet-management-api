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
        Schema::create('tbl_payroll', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'cancelled'])->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_payroll_item', function (Blueprint $table) {
            $table->id();
            $table->integer('payroll_id')->nullable();
            $table->integer('driver_id')->nullable();
            $table->enum('type', ['shipment', 'expense', 'damage'])->nullable();
            $table->integer('type_id')->nullable();
            $table->float('amount')->nullable();
            $table->dateTime('processed_on')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('payroll_id')->references('id')->on('tbl_payroll')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('tbl_driver')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_payroll');
        Schema::dropIfExists('tbl_payroll_item');
    }
};
