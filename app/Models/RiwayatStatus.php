<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_status';

    // Tabel ini tidak menggunakan created_at dan updated_at otomatis
    public $timestamps = false;

    protected $fillable = [
        'laporan_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'catatan',
        'created_at',
    ];

    // Relasi ke laporan
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // Pengguna yang mengubah status
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
