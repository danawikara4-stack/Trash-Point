<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\KategoriSampah;
use App\Models\LokasiLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // Menampilkan daftar laporan milik pengguna
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

    // Menyimpan laporan ke database
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

        // Upload foto
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

            Laporan::create([
                'user_id' => Auth::id(),
                'kategori_sampah_id' => $validated['kategori_sampah_id'],
                'lokasi_laporan_id' => $lokasi->id,
                'judul' => $validated['judul'],
                'deskripsi' => $validated['deskripsi'],
                'foto_laporan' => $fotoPath,
            ]);
        });

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Laporan berhasil dikirim!');
    }

    // Menampilkan detail laporan
    public function show(Laporan $laporan)
    {
        // Memastikan laporan milik pengguna yang sedang login
        if ($laporan->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak memiliki akses ke laporan ini.');
        }

        // Mengambil relasi kategori, lokasi, dan riwayat status
        $laporan->load([
            'kategoriSampah',
            'lokasiLaporan',
            'riwayatStatus'
        ]);

        return view('laporan.show', compact('laporan'));
    }
}
