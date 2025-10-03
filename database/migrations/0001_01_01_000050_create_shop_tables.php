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
        Schema::create('tbl_shop_job', function (Blueprint $table) {
            $table->id();
            $table->integer('truck_id')->nullable();
            $table->enum('type', ['servicing', 'damage'])->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->integer('start_by')->nullable();
            $table->dateTime('return_at')->nullable();
            $table->integer('return_by')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('truck_id')->references('id')->on('tbl_truck')->onDelete('set null');
            $table->foreign('start_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('return_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shop_job_inspection', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_job_id')->nullable();
            $table->dateTime('inspected_at')->nullable();
            $table->integer('inspection_by')->nullable();
            $table->enum('result', ['ok', 'not ok'])->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('shop_job_id')->references('id')->on('tbl_shop_job')->onDelete('cascade');
            $table->foreign('inspection_by')->references('id')->on('tbl_mechanic')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shop_job_item', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_job_id')->nullable();
            $table->integer('mst_line_item_id')->nullable();
            $table->float('amount')->nullable();
            $table->float('qty')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->integer('start_by')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->integer('end_by')->nullable();
            $table->integer('program_id')->nullable();
            $table->timestamps();

            $table->foreign('shop_job_id')->references('id')->on('tbl_shop_job')->onDelete('cascade');
            $table->foreign('mst_line_item_id')->references('id')->on('mst_line_item')->onDelete('set null');
            $table->foreign('start_by')->references('id')->on('tbl_mechanic')->onDelete('set null');
            $table->foreign('end_by')->references('id')->on('tbl_mechanic')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_shop_job');
        Schema::dropIfExists('tbl_shop_job_inspection');
        Schema::dropIfExists('tbl_shop_job_item');
    }
};
