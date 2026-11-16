<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StatusLaporanNotification extends Notification
{
    use Queueable;

    protected $laporan;
    protected $pesan;

    /**
     * Membuat notifikasi baru.
     */
    public function __construct(Laporan $laporan, string $pesan)
    {
        $this->laporan = $laporan;
        $this->pesan = $pesan;
    }

    /**
     * Menentukan saluran pengiriman notifikasi.
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Data yang disimpan ke tabel notifications.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'laporan_id' => $this->laporan->id,
            'judul_laporan' => $this->laporan->judul,
            'pesan' => $this->pesan,
            'url' => route('laporan.show', $this->laporan->id),
        ];
    }
}
