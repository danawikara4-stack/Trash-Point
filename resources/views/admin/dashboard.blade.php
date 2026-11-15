
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

        <div class="col-md-2 sidebar">
            <h5 class="text-white mb-4">Menu Admin</h5>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.laporan') }}">Kelola Laporan</a>
            <a href="{{ route('admin.pengguna') }}">Data Pengguna</a>
        </div>

        <div class="col-md-10 content">

            <h3 class="fw-bold">Dashboard Admin</h3>
            <p class="text-muted">
                Selamat datang di halaman administrator TrashPoint.
            </p>

            <div class="row g-3 mt-3">

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Laporan</h6>
                        <h2 class="text-success">0</h2>
                        <small class="text-muted">Jumlah laporan sampah</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Laporan Menunggu</h6>
                        <h2 class="text-warning">0</h2>
                        <small class="text-muted">Belum ditangani</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card stat-card p-4">
                        <h6>Total Pengguna</h6>
                        <h2 class="text-primary">0</h2>
                        <small class="text-muted">Pengguna terdaftar</small>
                    </div>
                </div>

            </div>

            <div class="card border-0 shadow-sm mt-4 p-4">
                <h5>Informasi Sistem</h5>
                <p class="text-muted mb-0">
                    Admin dapat mengelola laporan sampah,
                    memantau pengguna, dan mengawasi aktivitas
                    sistem TrashPoint.
                </p>
            </div>

        </div>

    </div>
</div>

</body>
</html>
