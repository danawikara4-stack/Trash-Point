<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi pengguna dengan laporan
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'user_id');
    }

    // Relasi pengguna sebagai petugas
    public function penugasanSebagaiPetugas(): HasMany
    {
        return $this->hasMany(Penugasan::class, 'petugas_id');
    }

    // Relasi pengguna sebagai admin pemberi tugas
    public function penugasanDibuat(): HasMany
    {
        return $this->hasMany(Penugasan::class, 'admin_id');
    }

    // Relasi pengguna dengan riwayat perubahan status
    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatStatus::class, 'user_id');
    }

    // Relasi pengguna sebagai petugas penanganan
    public function buktiPenanganan(): HasMany
    {
        return $this->hasMany(BuktiPenanganan::class, 'petugas_id');
    }

    // Relasi admin dengan data penjualan sampah
    public function penjualanSampah(): HasMany
    {
        return $this->hasMany(PenjualanSampah::class, 'created_by');
    }
}
