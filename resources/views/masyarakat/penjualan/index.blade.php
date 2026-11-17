
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Penjualan - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7f5;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #198754;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,.06);
        }

        .content {
            padding: 30px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-bold">TrashPoint | Transparansi Penjualan</span>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm">
        Kembali ke Dashboard
    </a>
</nav>

<div class="container content">

    <h3 class="fw-bold">Rekapitulasi Penjualan Sampah</h3>
    <p class="text-muted">
        Informasi transparansi hasil penjualan sampah yang dikelola TrashPoint.
    </p>

    <!-- Ringkasan -->
    <div class="row g-3 mt-3">

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <p class="text-muted mb-1">Total Berat Terjual</p>
                <h4 class="fw-bold text-success">
                    {{ number_format($totalBerat, 2, ',', '.') }} kg
                </h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <p class="text-muted mb-1">Total Hasil Penjualan</p>
                <h4 class="fw-bold text-success">
                    Rp {{ number_format($totalNominal, 0, ',', '.') }}
                </h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card stat-card p-3">
                <p class="text-muted mb-1">Jumlah Transaksi</p>
                <h4 class="fw-bold">
                    {{ $jumlahTransaksi }} transaksi
                </h4>
            </div>
        </div>

    </div>

    <!-- Tabel Riwayat -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">

            <h5 class="fw-bold mb-3">Riwayat Penjualan</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-success">
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Total Berat</th>
                            <th>Hasil Penjualan</th>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada data penjualan sampah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <small class="text-muted">
                Data ini ditampilkan sebagai informasi transparansi hasil penjualan sampah.
            </small>

        </div>
    </div>

</div>

</body>
</html>
