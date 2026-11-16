
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f1;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #198754;
        }

        .container {
            margin-top: 35px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .table thead {
            background: #198754;
            color: white;
        }

        h3 {
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid px-4">
            <span class="navbar-brand fw-bold">
                TrashPoint | Admin
            </span>

            <div>
                <a href="{{ route('admin.dashboard') }}"
                   class="btn btn-outline-light btn-sm">
                    Dashboard
                </a>

                <form action="{{ route('logout') }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container">

        <div class="card p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3>Data Pengguna</h3>
                    <p class="text-muted mb-0">
                        Kelola dan lihat seluruh pengguna TrashPoint.
                    </p>
                </div>

                <span class="badge bg-success fs-6">
                    Total: {{ $penggunas->count() }} Pengguna
                </span>
            </div>

            <hr>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pencarian dan Filter -->
            <form action="{{ route('admin.pengguna') }}"
                  method="GET"
                  class="row g-2 mb-4">

                <div class="col-md-6">
                    <input
                        type="text"
                        name="q"
                        class="form-control"
                        placeholder="Cari nama atau email pengguna..."
                        value="{{ request('q') }}">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">Semua Role</option>

                        <option value="admin"
                            {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="petugas"
                            {{ request('role') == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>

                        <option value="masyarakat"
                            {{ request('role') == 'masyarakat' ? 'selected' : '' }}>
                            Masyarakat
                        </option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-success w-100">
                        Cari
                    </button>

                    <a href="{{ route('admin.pengguna') }}"
                       class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>

            </form>

            <!-- Tabel Pengguna -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Registrasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($penggunas as $index => $pengguna)

                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td class="fw-bold">
                                    {{ $pengguna->name }}
                                </td>

                                <td>
                                    {{ $pengguna->email }}
                                </td>

                                <td>
                                    @if($pengguna->role == 'admin')
                                        <span class="badge bg-danger">
                                            Admin
                                        </span>
                                    @elseif($pengguna->role == 'petugas')
                                        <span class="badge bg-primary">
                                            Petugas
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Masyarakat
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $pengguna->created_at
                                        ? $pengguna->created_at->format('d-m-Y H:i')
                                        : '-' }}
                                </td>

                                <!-- Tombol Detail -->
                                <td>
                                    <a href="{{ route('admin.pengguna.detail', $pengguna->id) }}"
                                       class="btn btn-info btn-sm text-white">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Tidak ada pengguna yang cocok dengan pencarian.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="btn btn-secondary mt-3"
               style="width: fit-content;">
                Kembali ke Dashboard
            </a>

        </div>

    </div>

</body>
</html>
