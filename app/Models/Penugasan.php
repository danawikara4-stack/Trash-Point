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
        'admin_id',
        'tanggal_penugasan',
        'catatan',
    ];

    // Mengubah tanggal dari database menjadi objek tanggal Laravel
    protected function casts(): array
    {
        return [
            'tanggal_penugasan' => 'datetime',
        ];
    }

    // Relasi ke laporan
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    // Relasi ke petugas
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Relasi ke admin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
