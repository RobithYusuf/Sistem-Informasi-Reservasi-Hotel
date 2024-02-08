<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_kamar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $table = 'Kamar';
    protected $fillable = ['kode_kamar', 'jenis_kamar', 'no_kamar', 'fasilitas', 'harga'];


    // public function reservasi()
    // {
    //     return $this->hasMany(Reservasi::class, 'jenis_kamar', 'jenis_kamar');
    // }
    public function reservasi()
    {
        return $this->belongsToMany(Reservasi::class, 'kamar_reservasi', 'kamar_id', 'reservasi_id')
            ->withPivot('tanggal_check_in', 'tanggal_check_out', 'jumlah_kamar');
    }
    // App\Models\Kamar.php

    public function stokKamar()
    {
        return $this->hasOne(StokKamar::class, 'jenis_kamar', 'jenis_kamar');
    }
}
