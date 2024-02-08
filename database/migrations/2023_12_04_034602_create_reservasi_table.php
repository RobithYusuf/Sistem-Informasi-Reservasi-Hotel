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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->string('kode_reservasi')->primary();
            $table->foreignId('user_id')->constrained(); // Foreign key referencing the 'id' column in the 'users' table
            $table->string('no_ktp');
            $table->string('nama_tamu');
            $table->string('no_hp');
            $table->string('jenis_kamar');
            $table->double('harga');
            $table->date('checkIn');
            $table->date('checkOut');
            $table->integer('jumlah_kamar');
            $table->integer('status_reservasi')->nullable();
            $table->timestamps();

            // Menambahkan kunci asing
            $table->foreign('jenis_kamar')->references('jenis_kamar')->on('kamar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
