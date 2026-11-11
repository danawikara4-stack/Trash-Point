<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanSampah extends Model
{
    protected $table = 'penjualan_sampah';

    protected $fillable = [
        'tanggal',
        'total_berat',
        'total_nominal',
    ];
}