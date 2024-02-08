<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokKamar extends Seeder
{
    public function run(): void
    {
        $stokKamars = [
            [
                'id_stok' => 'SK1',
                'jenis_kamar' => 'Superior Room',
                'jumlah' => 6,
                'created_at' => '2024-01-15 01:04:10',
                'updated_at' => '2024-01-15 01:04:10',
            ],
            [
                'id_stok' => 'SK2',
                'jenis_kamar' => 'Deluxe Room',
                'jumlah' => 15,
                'created_at' => '2024-01-15 01:04:10',
                'updated_at' => '2024-01-18 01:07:27',
            ],
            [
                'id_stok' => 'SK3',
                'jenis_kamar' => 'VIP Duluxe',
                'jumlah' => 6,
                'created_at' => '2024-01-15 01:04:10',
                'updated_at' => '2024-01-18 01:05:34',
            ],
            [
                'id_stok' => 'SK4',
                'jenis_kamar' => 'Family Suite',
                'jumlah' => 6,
                'created_at' => '2024-01-15 01:04:10',
                'updated_at' => '2024-01-17 19:55:52',
            ],
            [
                'id_stok' => 'SK5',
                'jenis_kamar' => 'Executive Suite',
                'jumlah' => 10,
                'created_at' => '2024-01-15 01:04:10',
                'updated_at' => '2024-01-18 21:54:52',
            ],
            // Tambahkan data kamar lainnya sesuai kebutuhan
        ];

        // Masukkan data ke tabel kamar
        DB::table('stok_kamar')->insert($stokKamars);
    }
}
