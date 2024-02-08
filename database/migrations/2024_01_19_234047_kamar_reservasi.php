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
        Schema::create('kamar_reservasi', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('kamar_id'); // varchar(255)
            $table->string('reservasi_id'); // varchar(255)
            $table->date('tanggal_check_in');
            $table->date('tanggal_check_out');
            $table->integer('jumlah_kamar');

            $table->foreign('kamar_id')->references('kode_kamar')->on('kamar');
            $table->foreign('reservasi_id')->references('kode_reservasi')->on('reservasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_reservasi');
    }
};
