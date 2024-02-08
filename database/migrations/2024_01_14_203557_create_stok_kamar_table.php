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
        Schema::create('stok_kamar', function (Blueprint $table) {
            $table->string('id_stok')->primary();
            $table->string('jenis_kamar');
            $table->integer('jumlah');
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
        Schema::dropIfExists('stok_kamar');
    }
};
