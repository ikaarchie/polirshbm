<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanggilAntrianPoliklinik extends Model
{
    use HasFactory;

    protected $table = 'antrian_polikliniks';

    protected $fillable = [
        'namadokter',
        'pembayaran',
        'namapasien',
        'status_panggil'
    ];
}
