<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_status';

    public $timestamps = false;

    protected $fillable = [
        'laporan_id',
        'status_sebelumnya',
        'status_baru',
        'catatan',
    ];

    // Riwayat perubahan status suatu laporan
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
