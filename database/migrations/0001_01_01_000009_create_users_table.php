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
        Schema::create('mst_role', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('mst_role')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        // role dispatch
        Schema::create('tbl_dispatch', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_suspended')->default(false);
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        // role driver
        Schema::create('tbl_driver', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('dl_number')->nullable();
            $table->dateTime('dl_expiry_date')->nullable();
            $table->boolean('is_canada_pr')->default(false);
            $table->boolean('is_us_pr')->default(false);
            $table->string('passport_number')->nullable();
            $table->dateTime('passport_expiry_date')->nullable();
            $table->enum('status', ['inactive', 'active', 'suspended'])->default('inactive');
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        // role shipper
        Schema::create('tbl_shipper', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('representative_address_id')->nullable();
            $table->integer('company_address_id')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_suspended')->default(false);
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('representative_address_id')->references('id')->on('mst_address')->onDelete('set null');
            $table->foreign('company_address_id')->references('id')->on('mst_address')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        // role mechanic
        Schema::create('tbl_mechanic', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->enum('status', ['pending', 'active', 'retired', 'suspended'])->default('pending');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('last_date')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shop_id')->references('id')->on('tbl_shop')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        // role carrier
        Schema::create('tbl_carrier', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_address_id')->nullable();
            $table->integer('representative_address_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('logo_asset_id')->nullable();
            $table->integer('program_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('company_address_id')->references('id')->on('tbl_address')->onDelete('set null');
            $table->foreign('representative_address_id')->references('id')->on('tbl_address')->onDelete('set null');
            $table->foreign('program_id')->references('id')->on('mst_program')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_role');
        Schema::dropIfExists('tbl_dispatch');
        Schema::dropIfExists('tbl_driver');
        Schema::dropIfExists('tbl_shipper');
        Schema::dropIfExists('tbl_mechanic');
        Schema::dropIfExists('tbl_carrier');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
