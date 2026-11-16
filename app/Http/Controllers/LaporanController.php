<?php

namespace App\Http\Controllers;

use App\Models\BuktiPenanganan;
use App\Models\RiwayatStatus;
use App\Models\Laporan;
use App\Models\KategoriSampah;
use App\Models\LokasiLaporan;
use App\Models\Penugasan;
use App\Models\User;
use App\Notifications\StatusLaporanNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan milik masyarakat
    public function index()
    {
        $laporans = Laporan::with([
            'kategoriSampah',
            'lokasiLaporan'
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('laporan.index', compact('laporans'));
    }

    // Menampilkan form pembuatan laporan
    public function create()
    {
        $kategori = KategoriSampah::all();

        return view('laporan.create', compact('kategori'));
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'kategori_sampah_id' => 'required|exists:kategori_sampah,id',
            'nama_lokasi' => 'required|string|max:150',
            'alamat' => 'required|string',
            'kelurahan' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kota_kabupaten' => 'nullable|string|max:100',
            'deskripsi' => 'required|string',
            'foto_laporan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto laporan
        $fotoPath = null;

        if ($request->hasFile('foto_laporan')) {
            $fotoPath = $request->file('foto_laporan')
                ->store('laporan', 'public');
        }

        // Simpan lokasi dan laporan
        DB::transaction(function () use ($validated, $fotoPath) {

            $lokasi = LokasiLaporan::create([
                'nama_lokasi' => $validated['nama_lokasi'],
                'alamat' => $validated['alamat'],
                'kelurahan' => $validated['kelurahan'] ?? null,
                'kecamatan' => $validated['kecamatan'] ?? null,
                'kota_kabupaten' => $validated['kota_kabupaten'] ?? null,
            ]);

            $laporan = Laporan::create([
                'user_id' => Auth::id(),
                'kategori_sampah_id' => $validated['kategori_sampah_id'],
                'lokasi_laporan_id' => $lokasi->id,
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'foto_laporan' => $fotoPath,
            ]);

            // Catat status awal laporan
            RiwayatStatus::create([
                'laporan_id' => $laporan->id,
                'user_id' => Auth::id(),
                'status_sebelumnya' => null,
                'status_baru' => $laporan->status,
                'catatan' => 'Laporan baru dibuat.',
                'created_at' => now(),
            ]);
        });

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    // Menampilkan detail laporan
    public function show(Laporan $laporan)
    {
        // Pastikan laporan milik pengguna yang login
        if ($laporan->user_id != Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke laporan ini.');
        }

        // Ambil seluruh data yang diperlukan
        $laporan->load([
            'kategoriSampah',
            'lokasiLaporan',
            'riwayatStatus.user',
            'buktiPenanganan.petugas',
        ]);

        return view('laporan.show', compact('laporan'));
    }

    // Mengubah status laporan oleh Admin
    public function updateStatus(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai',
        ]);

        $statusSebelumnya = $laporan->status;
        $statusBaru = $validated['status'];

        // Tidak perlu mencatat jika status tidak berubah
        if ($statusSebelumnya == $statusBaru) {
            return redirect()
                ->route('admin.laporan')
                ->with('success', 'Status laporan tidak mengalami perubahan.');
        }

        DB::transaction(function () use (
            $laporan,
            $statusSebelumnya,
            $statusBaru
        ) {
            // Simpan riwayat perubahan status
            RiwayatStatus::create([
                'laporan_id' => $laporan->id,
                'user_id' => Auth::id(),
                'status_sebelumnya' => $statusSebelumnya,
                'status_baru' => $statusBaru,
                'catatan' => 'Status diperbarui oleh Admin.',
                'created_at' => now(),
            ]);

            // Perbarui status laporan
            $laporan->status = $statusBaru;
            $laporan->save();
        });

        // Kirim notifikasi kepada masyarakat pemilik laporan
        $laporan->refresh();

        $pesan = 'Status laporan "' . $laporan->judul .
            '" telah diubah menjadi ' . ucfirst($statusBaru) . '.';

        $laporan->user->notify(
            new StatusLaporanNotification($laporan, $pesan)
        );

        return redirect()
            ->route('admin.laporan')
            ->with('success', 'Status laporan berhasil diperbarui dan notifikasi dikirim!');
    }

    // Menugaskan laporan kepada Petugas oleh Admin
    public function assignPetugas(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'petugas_id' => 'required|exists:users,id',
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Pastikan pengguna yang dipilih benar-benar Petugas
        $petugas = User::where('id', $validated['petugas_id'])
            ->where('role', 'petugas')
            ->first();

        if (!$petugas) {
            return back()->withErrors([
                'petugas_id' => 'Pengguna yang dipilih bukan petugas.',
            ]);
        }

        if ($laporan->status == 'selesai') {
            return back()->withErrors([
                'petugas_id' => 'Laporan yang sudah selesai tidak dapat ditugaskan kembali.',
            ]);
        }

        $statusSebelumnya = $laporan->status;

        DB::transaction(function () use (
            $laporan,
            $petugas,
            $validated,
            $statusSebelumnya
        ) {
            // Simpan atau perbarui penugasan
            Penugasan::updateOrCreate(
                ['laporan_id' => $laporan->id],
                [
                    'petugas_id' => $petugas->id,
                    'admin_id' => Auth::id(),
                    'tanggal_penugasan' => now(),
                    'catatan' => $validated['catatan'] ?? null,
                ]
            );

            // Ubah status menjadi diproses
            $laporan->status = 'diproses';
            $laporan->save();

            // Catat riwayat jika status berubah
            if ($statusSebelumnya != 'diproses') {
                RiwayatStatus::create([
                    'laporan_id' => $laporan->id,
                    'user_id' => Auth::id(),
                    'status_sebelumnya' => $statusSebelumnya,
                    'status_baru' => 'diproses',
                    'catatan' => 'Laporan ditugaskan kepada Petugas: ' . $petugas->name,
                    'created_at' => now(),
                ]);
            }
        });

        // Kirim notifikasi penugasan kepada masyarakat
        $laporan->refresh();

        $pesan = 'Laporan "' . $laporan->judul .
            '" telah ditugaskan kepada petugas ' . $petugas->name . '.';

        $laporan->user->notify(
            new StatusLaporanNotification($laporan, $pesan)
        );

        return redirect()
            ->route('admin.laporan')
            ->with('success', 'Petugas berhasil ditugaskan dan notifikasi dikirim!');
    }

    // Petugas menyelesaikan tugas dan mengunggah bukti
    public function selesaikanTugas(Request $request, Laporan $laporan)
    {
        // Pastikan laporan ditugaskan kepada Petugas yang login
        $penugasan = $laporan->penugasan()
            ->where('petugas_id', Auth::id())
            ->first();

        if (!$penugasan) {
            abort(403, 'Kamu tidak memiliki penugasan untuk laporan ini.');
        }

        // Cegah penyelesaian berulang
        if ($laporan->status == 'selesai') {
            return redirect()
                ->route('petugas.dashboard')
                ->with('success', 'Tugas ini sudah diselesaikan sebelumnya.');
        }

        // Validasi foto dan keterangan
        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'keterangan' => 'required|string|max:1000',
        ]);

        // Upload foto bukti
        $fotoPath = $request->file('foto')
            ->store('bukti-penanganan', 'public');

        $statusSebelumnya = $laporan->status;

        DB::transaction(function () use (
            $laporan,
            $validated,
            $fotoPath,
            $statusSebelumnya
        ) {
            // Simpan bukti penanganan
            BuktiPenanganan::create([
                'laporan_id' => $laporan->id,
                'petugas_id' => Auth::id(),
                'foto' => $fotoPath,
                'keterangan' => $validated['keterangan'],
            ]);

            // Catat riwayat perubahan status
            RiwayatStatus::create([
                'laporan_id' => $laporan->id,
                'user_id' => Auth::id(),
                'status_sebelumnya' => $statusSebelumnya,
                'status_baru' => 'selesai',
                'catatan' => $validated['keterangan'],
                'created_at' => now(),
            ]);

            // Ubah status laporan menjadi selesai
            $laporan->status = 'selesai';
            $laporan->save();
        });

        // Kirim notifikasi penyelesaian kepada masyarakat
        $laporan->refresh();

        $pesan = 'Laporan "' . $laporan->judul .
            '" telah selesai ditangani oleh petugas.';

        $laporan->user->notify(
            new StatusLaporanNotification($laporan, $pesan)
        );

        return redirect()
            ->route('petugas.dashboard')
            ->with('success', 'Tugas berhasil diselesaikan dan notifikasi berhasil dikirim!');
    }
}
