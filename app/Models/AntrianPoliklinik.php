<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianPoliklinik extends Model
{
    use HasFactory;
    protected $fillable = [
        'namadokter',
        'pembayaran',
        'namapasien',
        'status_panggil'
    ];
}
