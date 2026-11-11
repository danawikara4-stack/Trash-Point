<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}