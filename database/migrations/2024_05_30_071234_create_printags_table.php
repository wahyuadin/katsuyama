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
        Schema::create('printags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('id_user')->references('id')->on('users')->cascadeOnDelete();
            $table->date('tanggal');
            $table->string('part_no');
            $table->string('part_name');
            $table->string('proses');
            $table->string('next_proses');
            $table->string('lot_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printags');
    }
};
