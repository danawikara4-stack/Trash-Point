<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuktiPenanganan extends Model
{
    protected $table = 'bukti_penanganan';

    protected $fillable = [
        'laporan_id',
        'petugas_id',
        'foto',
        'keterangan',
    ];

    // Bukti penanganan milik laporan tertentu
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // Petugas yang mengunggah bukti
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
