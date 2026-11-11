<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPenanganan extends Model
{
    protected $table = 'bukti_penanganan';

    protected $fillable = [
        'laporan_id',
        'petugas_id',
        'foto',
        'keterangan',
    ];
}