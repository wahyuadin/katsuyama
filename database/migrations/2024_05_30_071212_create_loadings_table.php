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
        Schema::create('hanggers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('type');
            $table->string('qty');
            $table->timestamps();
        });
        Schema::create('loadings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('planing_id')->references('id')->on('planings')->cascadeOnDelete();
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('hangger_id')->references('id')->on('hanggers')->cascadeOnDelete();
            $table->string('lot_no');
            $table->string('qty_in');
            $table->string('time_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loadings');
    }
};
