<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriSampah extends Model
{
    protected $table = 'kategori_sampah';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    // Satu kategori dapat memiliki banyak laporan
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'kategori_sampah_id');
    }
}
