
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7f5;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #198754;
        }

        .sidebar {
            min-height: 100vh;
            background: #146c43;
            padding: 25px 15px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background: #198754;
        }

        .content {
            padding: 30px;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,.06);
            height: 100%;
        }

        .table-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,.06);
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-bold">TrashPoint | Admin</span>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
    </form>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h5 class="text-white mb-4">Menu Admin</h5>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.laporan') }}">Kelola Laporan</a>
            <a href="{{ route('admin.pengguna') }}">Data Pengguna</a>
        </div>

        <!-- Konten Dashboard -->
        <div class="col-md-10 content">

            <h3 class="fw-bold">Dashboard Admin</h3>
            <p class="text-muted">
                Selamat datang di halaman administrator TrashPoint.
            </p>

            <!-- Statistik -->
            <div class="row g-3 mt-3">

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Laporan</h6>
                        <div class="stat-number text-success">
                            {{ $totalLaporan }}
                        </div>
                        <small class="text-muted">Jumlah seluruh laporan</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Laporan Menunggu</h6>
                        <div class="stat-number text-warning">
                            {{ $laporanMenunggu }}
                        </div>
                        <small class="text-muted">Belum ditangani</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Laporan Diproses</h6>
                        <div class="stat-number text-primary">
                            {{ $laporanDiproses }}
                        </div>
                        <small class="text-muted">Sedang ditangani petugas</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Laporan Selesai</h6>
                        <div class="stat-number text-success">
                            {{ $laporanSelesai }}
                        </div>
                        <small class="text-muted">Sudah selesai ditangani</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Pengguna</h6>
                        <div class="stat-number text-info">
                            {{ $totalPengguna }}
                        </div>
                        <small class="text-muted">Seluruh pengguna terdaftar</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Petugas</h6>
                        <div class="stat-number text-secondary">
                            {{ $totalPetugas }}
                        </div>
                        <small class="text-muted">Petugas terdaftar</small>
                    </div>
                </div>

            </div>

            <!-- Persentase Penyelesaian -->
            <div class="card border-0 shadow-sm mt-4 p-4">
                <h5>Persentase Penyelesaian Laporan</h5>

                <div class="d-flex justify-content-between mt-2">
                    <span class="text-muted">Laporan selesai</span>
                    <strong>{{ $persentaseSelesai }}%</strong>
                </div>

                <div class="progress mt-2" style="height: 15px;">
                    <div
                        class="progress-bar bg-success"
                        role="progressbar"
                        style="width: {{ $persentaseSelesai }}%;"
                        aria-valuenow="{{ $persentaseSelesai }}"
                        aria-valuemin="0"
                        aria-valuemax="100">
                    </div>
                </div>
            </div>

            <!-- Laporan Terbaru -->
            <div class="card table-card mt-4 p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Laporan Terbaru</h5>

                    <a href="{{ route('admin.laporan') }}"
                       class="btn btn-success btn-sm">
                        Lihat Semua
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Judul Laporan</th>
                                <th>Pelapor</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($laporanTerbaru as $laporan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ $laporan->judul }}
                                    </td>

                                    <td>
                                        {{ $laporan->user->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $laporan->kategoriSampah->nama_kategori ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($laporan->status == 'menunggu')
                                            <span class="badge bg-warning text-dark">
                                                Menunggu
                                            </span>
                                        @elseif ($laporan->status == 'diproses')
                                            <span class="badge bg-primary">
                                                Diproses
                                            </span>
                                        @elseif ($laporan->status == 'selesai')
                                            <span class="badge bg-success">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ $laporan->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada laporan yang masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="card border-0 shadow-sm mt-4 p-4">
                <h5>Informasi Sistem</h5>
                <p class="text-muted mb-0">
                    Admin dapat mengelola laporan sampah,
                    memantau pengguna, melihat perkembangan penanganan,
                    dan mengawasi aktivitas sistem TrashPoint.
                </p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
