<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiLaporan extends Model
{
    protected $table = 'lokasi_laporan';

    protected $fillable = [
        'nama_lokasi',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota_kabupaten',
        'latitude',
        'longitude',
    ];

    // Satu lokasi dapat memiliki banyak laporan
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'lokasi_laporan_id');
    }
}
