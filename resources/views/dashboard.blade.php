
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
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
                TrashPoint
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>

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

                <a href="{{ route('laporan.create') }}"
                   class="menu-link">

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

                <a href="{{ route('laporan.index') }}"
                   class="menu-link">

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

                <div class="card border-0 shadow-sm p-3 h-100">

                    <h5>Penjualan Sampah</h5>

                    <p class="text-muted">
                        Lihat informasi rekapitulasi penjualan sampah.
                    </p>

                    <span class="text-secondary fw-semibold mt-auto">
                        Segera Hadir
                    </span>

                </div>

            </div>

        </div>

    </div>

</body>
</html>
