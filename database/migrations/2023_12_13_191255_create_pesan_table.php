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
        Schema::create('pesan', function (Blueprint $table) {
            $table->id('id_pesan');
            $table->string('kode_reservasi')->nullable(); // Menggunakan nullable agar bisa dihapus pesan tanpa reservasi
            $table->foreign('kode_reservasi')->references('kode_reservasi')->on('reservasi')->onDelete('set null');
            $table->string('nama');
            $table->string('kontak');
            $table->text('subject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};
