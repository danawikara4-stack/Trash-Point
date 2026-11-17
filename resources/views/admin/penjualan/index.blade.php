
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Sampah - TrashPoint</title>

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

        .sidebar a:hover,
        .sidebar a.active {
            background: #198754;
        }

        .content {
            padding: 30px;
        }

        .stat-card,
        .table-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,.06);
            height: 100%;
        }

        .stat-number {
            font-size: 30px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- Navbar -->
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
            <a href="{{ route('admin.penjualan.index') }}" class="active">
                Penjualan Sampah
            </a>
        </div>

        <!-- Konten -->
        <div class="col-md-10 content">

            <h3 class="fw-bold">Penjualan Sampah</h3>
            <p class="text-muted">
                Kelola dan pantau hasil penjualan sampah TrashPoint.
            </p>

            <!-- Statistik -->
            <div class="row g-3 mt-3">

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Berat Terjual</h6>
                        <div class="stat-number text-success">
                            {{ number_format($totalBerat, 2, ',', '.') }}
                        </div>
                        <small class="text-muted">Kilogram sampah terjual</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Nominal Penjualan</h6>
                        <div class="stat-number text-primary">
                            Rp {{ number_format($totalNominal, 0, ',', '.') }}
                        </div>
                        <small class="text-muted">Akumulasi hasil penjualan</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Jumlah Transaksi</h6>
                        <div class="stat-number text-info">
                            {{ $jumlahTransaksi }}
                        </div>
                        <small class="text-muted">Seluruh transaksi tercatat</small>
                    </div>
                </div>

            </div>

            <!-- Tabel Penjualan -->
            <div class="card table-card mt-4 p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Riwayat Penjualan</h5>

                    <a href="{{ route('admin.penjualan.create') }}"
                       class="btn btn-success btn-sm">
                        + Tambah Penjualan
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-success">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Total Berat</th>
                                <th>Total Nominal</th>
                                <th>Dicatat Oleh</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($penjualan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </td>

                                    <td>
                                        {{ number_format($item->total_berat, 2, ',', '.') }} kg
                                    </td>

                                    <td>
                                        Rp {{ number_format($item->total_nominal, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        {{ $item->admin->name ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada transaksi penjualan sampah.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Informasi -->
            <div class="card border-0 shadow-sm mt-4 p-4">
                <h5>Informasi Penjualan</h5>
                <p class="text-muted mb-0">
                    Admin dapat mencatat total berat sampah yang terjual
                    beserta nominal hasil penjualannya. Data ini digunakan
                    untuk memantau transparansi hasil penjualan sampah
                    dalam sistem TrashPoint.
                </p>
            </div>

        </div>
    </div>
</div>

</body>
</html>
