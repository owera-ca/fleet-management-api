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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('tbl_trans', function (Blueprint $table) {
            $table->id();
            $table->float('amount')->nullable();
            $table->string('unique_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained('tbl_order')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        Schema::create('tbl_order', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['shipment', 'expense', 'shop'])->nullable();
            $table->float('subtotal')->nullable();
            $table->float('total')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('from_id')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('to_id')
                ->nullable()
                ->constrained('users')->onDelete('set null');
            $table->foreignId('trans_id')
                ->nullable()
                ->constrained('tbl_trans')->onDelete('set null');
            $table->foreignId('program_id')
                ->nullable()
                ->constrained('mst_program')->onDelete('set null');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('tbl_order_item', function (Blueprint $table) {
            $table->id();
            $table->float('price')->nullable();
            $table->integer('qty')->nullable();
            $table->float('composite_price')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('entity_id')
                ->nullable()
                ->constrained('mst_entity')->onDelete('set null');
            $table->foreignId('order_id')
                ->nullable()
                ->constrained('tbl_order')->onDelete('set null');
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
        Schema::dropIfExists('tbl_trans');
        Schema::dropIfExists('tbl_order_item');
        Schema::dropIfExists('tbl_order');
    }
};
