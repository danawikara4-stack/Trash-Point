<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Menampilkan notifikasi milik pengguna yang sedang login
    public function index()
    {
        $notifikasis = Auth::user()
            ->notifications()
            ->latest()
            ->get();

        return view('notifikasi.index', compact('notifikasis'));
    }

    // Menandai satu notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        $notifikasi = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notifikasi->markAsRead();

        return redirect()
            ->route('notifikasi.index')
            ->with('success', 'Notifikasi berhasil ditandai sudah dibaca.');
    }

    // Menandai seluruh notifikasi sebagai sudah dibaca
    public function markAllAsRead()
    {
        Auth::user()
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);

        return redirect()
            ->route('notifikasi.index')
            ->with('success', 'Semua notifikasi berhasil dibaca.');
    }

// Membuka notifikasi dan menuju detail laporan
public function openNotification($id)
{
    $notifikasi = Auth::user()
        ->notifications()
        ->where('id', $id)
        ->firstOrFail();

    // Tandai sebagai sudah dibaca
    $notifikasi->markAsRead();

    // Ambil ID laporan dari data notifikasi
    $laporanId = $notifikasi->data['laporan_id'] ?? null;

    if (!$laporanId) {
        return redirect()
            ->route('notifikasi.index')
            ->with('error', 'Data laporan tidak ditemukan.');
    }

    // Arahkan ke halaman detail laporan
    return redirect()->route('laporan.show', $laporanId);
}
    }
