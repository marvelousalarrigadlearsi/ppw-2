<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'fasilitas',
        'status',
    ];
}
