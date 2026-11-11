<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiLaporan extends Model
{
    protected $table = 'lokasi_laporan';

    protected $fillable = [
        'nama lokasi',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'latitude',
        'longitude',
    ];
}
