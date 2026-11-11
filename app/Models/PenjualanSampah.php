<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanSampah extends Model
{
    protected $table = 'penjualan_sampah';

    protected $fillable = [
        'tanggal',
        'total_berat',
        'total_nominal',
    ];

    // Admin yang mencatat penjualan
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
