<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // Relasi ke pengguna yang membuat laporan
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke kategori sampah
    public function kategoriSampah(): BelongsTo
    {
        return $this->belongsTo(KategoriSampah::class, 'kategori_sampah_id');
    }

    // Relasi ke lokasi laporan
    public function lokasiLaporan(): BelongsTo
    {
        return $this->belongsTo(LokasiLaporan::class, 'lokasi_laporan_id');
    }

    // Relasi ke penugasan petugas
    public function penugasan(): HasMany
    {
        return $this->hasMany(Penugasan::class, 'laporan_id');
    }

    // Relasi ke riwayat perubahan status
    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'laporan_id');
    }

    // Relasi ke bukti penanganan
    public function buktiPenanganan(): HasMany
    {
        return $this->hasMany(BuktiPenanganan::class, 'laporan_id');
    }
}

