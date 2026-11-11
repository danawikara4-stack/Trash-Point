<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penugasan extends Model
{
    protected $table = 'penugasan';

    protected $fillable = [
        'laporan_id',
        'petugas_id',
        'catatan',
    ];

    // Penugasan terhubung dengan laporan
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // Petugas yang menerima penugasan
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Admin yang membuat penugasan
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
