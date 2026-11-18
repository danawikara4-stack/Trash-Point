
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan - TrashPoint</title>

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

        .form-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,.06);
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
            <a href="{{ route('admin.penjualan.index') }}" class="active">
                Penjualan Sampah
            </a>
        </div>

        <!-- Konten -->
        <div class="col-md-10 content">

            <h3 class="fw-bold">Tambah Penjualan</h3>
            <p class="text-muted">
                Masukkan data hasil penjualan sampah.
            </p>

            <div class="card form-card p-4 mt-3">

                <form action="{{ route('admin.penjualan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tanggal Penjualan
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="{{ date('Y-m-d') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Total Berat Sampah (kg)
                        </label>

                        <input
                            type="number"
                            name="total_berat"
                            class="form-control"
                            step="0.01"
                            min="0.01"
                            placeholder="Contoh: 25.50"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Total Nominal Penjualan (Rp)
                        </label>

                        <input
                            type="number"
                            name="total_nominal"
                            class="form-control"
                            min="0.01"
                            step="0.01"
                            placeholder="Contoh: 150000"
                            required>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.penjualan.index') }}"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-success">
                            Simpan Penjualan
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

</body>
</html>
