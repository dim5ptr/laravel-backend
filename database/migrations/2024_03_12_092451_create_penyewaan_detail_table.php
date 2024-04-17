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
        Schema::create('penyewaan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penyewaan_id')->nullable(false);
            $table->foreign('penyewaan_id')->references('id')->on('penyewaan')->onDelete('cascade');
            $table->unsignedBigInteger('alat_id')->nullable(false);
            $table->foreign('alat_id')->references('id')->on('alat')->onDelete('cascade');
            $table->integer('jumlah')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan_detail');
    }
};
