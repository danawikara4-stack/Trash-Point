<?php

use App\Http\Controllers\NotificationController;
use App\Models\User;
use App\Models\Laporan;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

// ==========================================
// HALAMAN UTAMA
// ==========================================

Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// ROUTE GUEST (BELUM LOGIN)
// ==========================================

Route::middleware('guest')->group(function () {

    // Registrasi
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// ==========================================
// LOGOUT
// ==========================================

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ==========================================
// ROUTE MASYARAKAT
// ==========================================

Route::middleware(['auth', 'role:masyarakat'])->group(function () {

    // Dashboard masyarakat
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ==========================================
    // NOTIFIKASI
    // ==========================================

    // Menampilkan semua notifikasi
    Route::get('/notifikasi', [NotificationController::class, 'index'])
        ->name('notifikasi.index');

    // Menandai satu notifikasi sudah dibaca
    Route::post('/notifikasi/{id}/baca', [NotificationController::class, 'markAsRead'])
        ->name('notifikasi.baca');

    // Menandai semua notifikasi sudah dibaca
    Route::post('/notifikasi/baca-semua', [NotificationController::class, 'markAllAsRead'])
        ->name('notifikasi.bacaSemua');

    // Membuka notifikasi dan menuju detail laporan
    Route::get('/notifikasi/{id}/buka', [
        NotificationController::class,
        'openNotification'
    ])->name('notifikasi.open');

    // ==========================================
    // LAPORAN MASYARAKAT
    // ==========================================

    // Riwayat laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // Form pembuatan laporan
    Route::get('/laporan/create', [LaporanController::class, 'create'])
        ->name('laporan.create');

    // Simpan laporan
    Route::post('/laporan', [LaporanController::class, 'store'])
        ->name('laporan.store');

    // Detail laporan
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])
        ->name('laporan.show');
});

// ==========================================
// ROUTE ADMIN
// ==========================================

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin', function () {

        $totalLaporan = Laporan::count();

        $laporanMenunggu = Laporan::where('status', 'menunggu')->count();

        $laporanDiproses = Laporan::where('status', 'diproses')->count();

        $laporanSelesai = Laporan::where('status', 'selesai')->count();

        $totalPengguna = User::count();

        $totalPetugas = User::where('role', 'petugas')->count();

        $persentaseSelesai = $totalLaporan > 0
            ? round(($laporanSelesai / $totalLaporan) * 100)
            : 0;

        $laporanTerbaru = Laporan::with([
            'user',
            'kategoriSampah',
            'lokasiLaporan'
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'laporanMenunggu',
            'laporanDiproses',
            'laporanSelesai',
            'totalPengguna',
            'totalPetugas',
            'persentaseSelesai',
            'laporanTerbaru'
        ));

    })->name('admin.dashboard');

    // ==========================================
    // KELOLA LAPORAN
    // ==========================================

    // Menampilkan semua laporan dengan pencarian dan filter
    Route::get('/admin/laporan', function (Request $request) {

        $query = Laporan::with([
            'kategoriSampah',
            'lokasiLaporan',
            'user',
            'penugasan.petugas'
        ]);

        // Pencarian berdasarkan judul atau deskripsi
        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', '%' . $keyword . '%')
                    ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where(
                'kategori_sampah_id',
                $request->kategori
            );
        }

        $laporans = $query->latest()->get();

        // Ambil daftar kategori
        $kategori = KategoriSampah::orderBy('nama_kategori')->get();

        // Ambil daftar petugas
        $petugas = User::where('role', 'petugas')
            ->orderBy('name')
            ->get();

        return view('admin.laporan', compact(
            'laporans',
            'petugas',
            'kategori'
        ));

    })->name('admin.laporan');

    // Mengubah status laporan
    Route::patch(
        '/admin/laporan/{laporan}/status',
        [LaporanController::class, 'updateStatus']
    )->name('admin.laporan.updateStatus');

    // Menugaskan laporan kepada Petugas
    Route::post(
        '/admin/laporan/{laporan}/tugaskan',
        [LaporanController::class, 'assignPetugas']
    )->name('admin.laporan.assignPetugas');

    // ==========================================
    // KELOLA PENGGUNA
    // ==========================================

    // Menampilkan data pengguna
    Route::get('/admin/pengguna', function (Request $request) {

        $query = User::query();

        // Pencarian berdasarkan nama atau email
        if ($request->filled('q')) {
            $keyword = $request->q;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        // Filter berdasarkan role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $penggunas = $query->latest()->get();

        return view('admin.pengguna', compact('penggunas'));

    })->name('admin.pengguna');

    // Detail pengguna
    Route::get('/admin/pengguna/{user}', function (User $user) {

        $user->loadCount('laporan');

        return view('admin.pengguna-detail', compact('user'));

    })->name('admin.pengguna.detail');

    // Mengubah role pengguna
    Route::patch('/admin/pengguna/{user}/role', function (Request $request, User $user) {

        $request->validate([
            'role' => 'required|in:admin,petugas,masyarakat',
        ]);

        // Admin tidak boleh mengubah role akun sendiri
        if ($user->id === Auth::id()) {
            return back()->with(
                'error',
                'Anda tidak dapat mengubah role akun sendiri.'
            );
        }

        $user->role = $request->role;
        $user->save();

        return back()->with(
            'success',
            'Role pengguna berhasil diperbarui.'
        );

    })->name('admin.pengguna.updateRole');

    // Menghapus pengguna
    Route::delete('/admin/pengguna/{user}', function (User $user) {

        // Admin tidak boleh menghapus akun sendiri
        if ($user->id === Auth::id()) {
            return back()->with(
                'error',
                'Anda tidak dapat menghapus akun sendiri.'
            );
        }

        // Periksa apakah pengguna masih memiliki data terkait
        $memilikiData = $user->laporan()->exists()
            || $user->penugasanSebagaiPetugas()->exists()
            || $user->penugasanDibuat()->exists()
            || $user->riwayatStatus()->exists()
            || $user->buktiPenanganan()->exists();

        if ($memilikiData) {
            return back()->with(
                'error',
                'Pengguna tidak dapat dihapus karena masih memiliki data laporan atau riwayat tugas.'
            );
        }

        $user->delete();

        return redirect()->route('admin.pengguna')->with(
            'success',
            'Pengguna berhasil dihapus.'
        );

    })->name('admin.pengguna.destroy');

});

// ==========================================
// ROUTE PETUGAS
// ==========================================

Route::middleware(['auth', 'role:petugas'])->group(function () {

    // Dashboard Petugas
    Route::get('/petugas', function () {

        $penugasans = Auth::user()
            ->penugasanSebagaiPetugas()
            ->with([
                'laporan.kategoriSampah',
                'laporan.lokasiLaporan',
                'laporan.user'
            ])
            ->latest()
            ->get();

        return view('petugas.dashboard', compact('penugasans'));

    })->name('petugas.dashboard');

    // Menyelesaikan tugas
    Route::post(
        '/petugas/laporan/{laporan}/selesaikan',
        [LaporanController::class, 'selesaikanTugas']
    )->name('petugas.laporan.selesaikan');

});
