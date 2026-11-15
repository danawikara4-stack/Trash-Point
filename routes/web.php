
<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;

// Halaman utama diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ROUTE GUEST (Belum Login)
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

// Logout
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

    // Riwayat laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // Form laporan
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

        $totalLaporan = \App\Models\Laporan::count();
        $laporanMenunggu = \App\Models\Laporan::where('status', 'menunggu')->count();
        $totalPengguna = User::count();

        return view('admin.dashboard', compact(
            'totalLaporan',
            'laporanMenunggu',
            'totalPengguna'
        ));

    })->name('admin.dashboard');


    // Kelola Laporan
    Route::get('/admin/laporan', function () {

        $laporans = \App\Models\Laporan::with([
            'kategoriSampah',
            'lokasiLaporan',
            'user'
        ])->latest()->get();

        return view('admin.laporan', compact('laporans'));

    })->name('admin.laporan');


    // Data Pengguna
    Route::get('/admin/pengguna', function () {

        $penggunas = User::latest()->get();

        return view('admin.pengguna', compact('penggunas'));

    })->name('admin.pengguna');

});


// ==========================================
// ROUTE PETUGAS
// ==========================================

Route::middleware(['auth', 'role:petugas'])->group(function () {

    Route::get('/petugas', function () {
        return view('petugas.dashboard');
    })->name('petugas.dashboard');

});
