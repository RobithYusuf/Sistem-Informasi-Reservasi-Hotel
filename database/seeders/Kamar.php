<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kamar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamars = [
            [
                'kode_kamar' => 'KM01',
                'jenis_kamar' => 'Superior Room',
                'no_kamar' => '100-104',
                'fasilitas' => 'AC, TV, Wi-Fi, Kasur, shower',
                'harga' => 350000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kamar' => 'KM02',
                'jenis_kamar' => 'Deluxe Room',
                'no_kamar' => '105-109',
                'fasilitas' => 'AC, TV, Wi-Fi, Kasur, shower, kursi',
                'harga' => 400000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kamar' => 'KM03',
                'jenis_kamar' => 'VIP Duluxe',
                'no_kamar' => '110-114',
                'fasilitas' => 'AC, TV, Wi-Fi, Kasur, shower, kursi, kulkas',
                'harga' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kamar' => 'KM04',
                'jenis_kamar' => 'Family Suite',
                'no_kamar' => '115-119',
                'fasilitas' => 'AC, TV, Wi-Fi, Kasur, shower, kursi, kulkas, kasur anak',
                'harga' => 550000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_kamar' => 'KM05',
                'jenis_kamar' => 'Executive Suite',
                'no_kamar' => '120-124',
                'fasilitas' => 'AC, TV, Wi-Fi, Kasur, shower, kursi, kulkas, meja kerja',
                'harga' => 600000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data kamar lainnya sesuai kebutuhan
        ];

        // Masukkan data ke tabel kamar
        DB::table('kamar')->insert($kamars);
    }
}
