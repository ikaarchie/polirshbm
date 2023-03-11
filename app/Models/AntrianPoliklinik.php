<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianPoliklinik extends Model
{
    use HasFactory;
    
    protected $table = 'antrian_polikliniks';

    protected $fillable = [
        'nama_dokter',
        'waktu_praktek',
        'jenis_poli',
        'nama_pasien',
        'status_panggil'
    ];
}
