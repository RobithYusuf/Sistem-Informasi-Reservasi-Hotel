<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'kode_reservasi';
    protected $dates = ['checkin', 'checkout'];

    protected $fillable = [
        'user_id',
        'kode_reservasi',
        'no_ktp',
        'nama_tamu',
        'no_hp',
        'jenis_kamar',
        'harga',
        'checkIn',
        'checkOut',
        'jumlah_kamar',
        'total_harga',
        'status_reservasi'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->kode_reservasi) {
                // Gunakan tanggal dan waktu saat ini
                // $datetime = now()->format('Ymdis');

                // Gabungkan semua elemen untuk kode_reservasi
                // $model->kode_reservasi = 'KR' . $datetime;

                // Gunakan tanggal dan waktu saat ini
                $datetime = now()->format('ymdhis-v');

                // Gabungkan semua elemen untuk kode_reservasi
                $model->kode_reservasi = 'KR' . $datetime;

                // Tambahkan angka unik di belakang kode_reservasi (misal: 3 angka acak)
                $model->kode_reservasi .= mt_rand(100, 999);
            }
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'kode_reservasi', 'kode_reservasi');
    }

    // public function kamar()
    // {
    //     return $this->belongsTo(Kamar::class, 'jenis_kamar', 'jenis_kamar');
    // }
    public function kamar()
    {
        return $this->belongsToMany(Kamar::class, 'kamar_reservasi', 'reservasi_id', 'kamar_id')
            ->withPivot('tanggal_check_in', 'tanggal_check_out', 'jumlah_kamar');
    }

    public function pesan()
    {
        return $this->hasOne(Pesan::class, 'kode_reservasi', 'kode_reservasi');
    }
}
