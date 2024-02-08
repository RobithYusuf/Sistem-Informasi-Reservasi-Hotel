<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    
    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';
    protected $fillable = ['nama', 'kontak', 'subject'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'kode_reservasi', 'kode_reservasi');
    }
}
