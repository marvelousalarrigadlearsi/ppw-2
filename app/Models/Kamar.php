<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kamar extends Model
{
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga',
        'fasilitas',
        'status',
    ];
    public function getTanggalDibuatAttribute()
{
    return Carbon::parse($this->created_at)->format('d-m-Y H:i');
}
}
