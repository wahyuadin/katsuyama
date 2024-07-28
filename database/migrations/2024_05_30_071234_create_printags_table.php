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
            $table->foreignUuid('id_packing')->nullable()->references('id')->on('packings')->cascadeOnDelete();
            $table->foreignUuid('id_loading')->nullable()->references('id')->on('loadings')->cascadeOnDelete();
            $table->date('date')->nullable();
            $table->string('proses')->nullable();
            $table->string('next_proses')->nullable();
            $table->string('lot_no')->nullable();
            $table->string('qty')->nullable();
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
