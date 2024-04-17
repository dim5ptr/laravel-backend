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
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id')->nullable(false);
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->date('tgl_sewa')->nullable(false);
            $table->date('tgl_kembali')->nullable(false);
            $table->enum('status_pembayaran', ['Lunas', 'Belum Dibayar', 'DP'])->nullable(false)->default('Belum Dibayar');
            $table->enum('status_kembali', ['Sudah Kembali', 'Belum Kembali'])->nullable(false)->default('Belum Kembali');
            $table->integer('total_harga')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan');
    }
};
