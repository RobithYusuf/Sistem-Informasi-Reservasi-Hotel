<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKamar extends Model
{
    use HasFactory;

    protected $table = 'stok_kamar';
    protected $primaryKey = 'id_stok';

    protected $fillable = ['id_stok', 'jenis_kamar', 'jumlah',];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'jenis_kamar', 'jenis_kamar');
    }
}
