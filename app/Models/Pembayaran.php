<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $fillable = [
        'id_bayar',
        'kode_reservasi',
        'jumlah_bayar',
        'tgl_bayar',
        'metode_bayar',
        'metode_pembayaran',
        'batas_waktu_pembayaran',
        'status'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'kode_reservasi', 'kode_reservasi');
    }
}
