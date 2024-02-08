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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_bayar');
            $table->string('kode_reservasi');
            $table->integer('jumlah_bayar');
            $table->string('status')->default('Unpaid');
            $table->string('metode_bayar')->nullable();
            $table->string('metode_pembayaran', 10)->nullable();
            $table->dateTime('batas_waktu_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('kode_reservasi')->references('kode_reservasi')->on('reservasi')->onDelete('cascade');
            $table->unique('kode_reservasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
