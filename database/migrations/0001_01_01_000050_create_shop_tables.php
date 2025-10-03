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
            $table->enum('type', ['servicing', 'damage'])->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('return_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('truck_id')
                ->nullable()
                ->constrained('tbl_truck')->onDelete('set null');
            $table->foreignId('start_by')
                ->nullable()
                ->constrained('tbl_mechanic')->onDelete('set null');
            $table->foreignId('return_by')
                ->nullable()
                ->constrained('tbl_mechanic')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shop_job_inspection', function (Blueprint $table) {
            $table->id();
            $table->dateTime('inspected_at')->nullable();
            $table->enum('result', ['ok', 'not ok'])->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shop_job_id')
                ->nullable()
                ->constrained('tbl_shop_job')->onDelete('cascade');
            $table->foreignId('inspection_by')
                ->nullable()
                ->constrained('tbl_mechanic')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_shop_job_item', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->nullable();
            $table->float('qty')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('shop_job_id')
                ->nullable()
                ->constrained('tbl_shop_job')->onDelete('cascade');
            $table->foreignId('mst_line_item_id')
                ->nullable()
                ->constrained('mst_line_item')->onDelete('set null');
            $table->foreignId('start_by')
                ->nullable()
                ->constrained('tbl_mechanic')->onDelete('set null');
            $table->foreignId('end_by')
                ->nullable()
                ->constrained('tbl_mechanic')->onDelete('set null');
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
        Schema::dropIfExists('tbl_shop_job');
        Schema::dropIfExists('tbl_shop_job_inspection');
        Schema::dropIfExists('tbl_shop_job_item');
    }
};
