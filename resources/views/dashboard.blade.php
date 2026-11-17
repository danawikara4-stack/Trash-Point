<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .menu-card {
            transition: 0.3s;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.12) !important;
        }

        .menu-link {
            text-decoration: none;
            color: inherit;
        }

        .notification-menu {
            width: 340px;
            max-width: 90vw;
            max-height: 420px;
            overflow-y: auto;
        }

        .notification-item {
            white-space: normal;
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                TrashPoint
            </a>

            <div class="d-flex align-items-center">

                <!-- Notifikasi -->
                @php
                    $jumlahNotifikasi = auth()->user()
                        ->unreadNotifications()
                        ->count();

                    $daftarNotifikasi = auth()->user()
                        ->notifications()
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                <div class="dropdown me-3">

                    <button
                        class="btn btn-outline-light position-relative"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        title="Notifikasi">

                        <span style="font-size: 18px;">🔔</span>

                        @if($jumlahNotifikasi > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $jumlahNotifikasi }}
                            </span>
                        @endif

                    </button>

                    <div class="dropdown-menu dropdown-menu-end p-2 notification-menu">

                        <h6 class="dropdown-header fw-bold">
                            Notifikasi Terbaru
                        </h6>

                        @forelse($daftarNotifikasi as $notifikasi)

                            <div class="dropdown-item notification-item border-bottom py-2">

                                <div class="fw-bold">
                                    {{ $notifikasi->data['judul'] ?? 'Notifikasi TrashPoint' }}
                                </div>

                                <p class="small mb-1 text-wrap">
                                    {{ $notifikasi->data['pesan'] ?? 'Ada pembaruan pada laporan Anda.' }}
                                </p>

                                <small class="text-muted">
                                    {{ $notifikasi->created_at->format('d-m-Y H:i') }}
                                </small>

                                @if(is_null($notifikasi->read_at))

                                    <form
                                        action="{{ route('notifikasi.baca', $notifikasi->id) }}"
                                        method="POST"
                                        class="mt-2">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-success">
                                            Tandai sudah dibaca
                                        </button>

                                    </form>

                                @else

                                    <small class="text-success d-block mt-1">
                                        ✓ Sudah dibaca
                                    </small>

                                @endif

                            </div>

                        @empty

                            <p class="text-muted text-center small p-3 mb-0">
                                Belum ada notifikasi.
                            </p>

                        @endforelse

                    </div>
                </div>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </nav>

    <!-- Konten Dashboard -->
    <div class="container py-5">

        <!-- Informasi Akun -->
        <div class="card shadow-sm border-0 p-4">

            <h3 class="fw-bold">
                Selamat Datang, {{ auth()->user()->name }}!
            </h3>

            <p class="text-muted mb-4">
                Selamat datang di sistem TrashPoint.
                Sistem pelaporan dan penanganan sampah lingkungan.
            </p>

            <hr>

            <h5 class="fw-bold mb-3">Informasi Akun</h5>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Nama</div>
                <div class="col-md-9">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Email</div>
                <div class="col-md-9">
                    {{ auth()->user()->email }}
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-3 text-muted">Role</div>
                <div class="col-md-9">
                    <span class="badge bg-success">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </div>

        </div>

        <!-- Menu Dashboard -->
        <div class="row mt-4 g-3">

            <!-- Pelaporan Sampah -->
            <div class="col-md-4">

                <a href="{{ route('laporan.create') }}" class="menu-link">

                    <div class="card border-0 shadow-sm p-3 h-100 menu-card">

                        <h5>Pelaporan Sampah</h5>

                        <p class="text-muted">
                            Laporkan permasalahan sampah di lingkungan sekitar.
                        </p>

                        <span class="text-success fw-semibold mt-auto">
                            Buat Laporan →
                        </span>

                    </div>

                </a>

            </div>

            <!-- Status Laporan -->
            <div class="col-md-4">

                <a href="{{ route('laporan.index') }}" class="menu-link">

                    <div class="card border-0 shadow-sm p-3 h-100 menu-card">

                        <h5>Status Laporan</h5>

                        <p class="text-muted">
                            Pantau perkembangan laporan yang telah dikirim.
                        </p>

                        <span class="text-success fw-semibold mt-auto">
                            Lihat Laporan →
                        </span>

                    </div>

                </a>

            </div>

            <!-- Penjualan Sampah -->
        <div class="col-md-4">

            <a href="{{ route('masyarakat.penjualan.index') }}"
            class="menu-link">

                <div class="card border-0 shadow-sm p-3 h-100 menu-card">

                    <h5>Penjualan Sampah</h5>

                    <p class="text-muted">
                        Lihat informasi rekapitulasi penjualan sampah.
                    </p>

                    <span class="text-success fw-semibold mt-auto">
                        Lihat Rekapitulasi →
                    </span>

                </div>

            </a>

        </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
