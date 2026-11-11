<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'kategori_sampah_id',
        'lokasi_laporan_id',
        'judul',
        'deskripsi',
        'foto_laporan',
    ];
}
