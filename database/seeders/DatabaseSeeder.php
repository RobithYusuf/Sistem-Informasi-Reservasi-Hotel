<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk tabel users
        $this->call(UsersAdmin::class);

        // Panggil seeder untuk tabel kamar
        $this->call(Kamar::class);

        // Panggil seeder untuk tabel stok kamar
        $this->call(StokKamar::class);
    }
}
