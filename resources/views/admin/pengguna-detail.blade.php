
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengguna - TrashPoint</title>

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

        h3 {
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid px-4">
            <span class="navbar-brand fw-bold">
                TrashPoint | Admin
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="card p-4">

            <h3>Detail Pengguna</h3>
            <p class="text-muted">
                Informasi lengkap akun pengguna TrashPoint.
            </p>

            <hr>

            <!-- INFORMASI PENGGUNA -->
            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nama Pengguna</div>
                <div class="col-md-8">{{ $user->name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Email</div>
                <div class="col-md-8">{{ $user->email }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Role Saat Ini</div>
                <div class="col-md-8">
                    @if($user->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @elseif($user->role == 'petugas')
                        <span class="badge bg-primary">Petugas</span>
                    @else
                        <span class="badge bg-success">Masyarakat</span>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tanggal Registrasi</div>
                <div class="col-md-8">
                    {{ $user->created_at
                        ? $user->created_at->format('d-m-Y H:i')
                        : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Jumlah Laporan</div>
                <div class="col-md-8">
                    {{ $user->laporan_count }} laporan
                </div>
            </div>

            <hr>

            <!-- PESAN BERHASIL -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- PESAN ERROR -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- FORM UBAH ROLE -->
            <h5 class="fw-bold mb-3">Kelola Role Pengguna</h5>

            @if($user->id === Auth::id())

                <div class="alert alert-warning">
                    Anda sedang melihat akun sendiri. Role akun sendiri tidak dapat diubah.
                </div>

            @else

                <form action="{{ route('admin.pengguna.updateRole', $user->id) }}"
                      method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="row align-items-end">

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label fw-bold">
                                Pilih Role Baru
                            </label>

                            <select name="role" id="role" class="form-select" required>

                                <option value="masyarakat"
                                    {{ $user->role == 'masyarakat' ? 'selected' : '' }}>
                                    Masyarakat
                                </option>

                                <option value="petugas"
                                    {{ $user->role == 'petugas' ? 'selected' : '' }}>
                                    Petugas
                                </option>

                                <option value="admin"
                                    {{ $user->role == 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <button type="submit"
                                    class="btn btn-success"
                                    onclick="return confirm('Apakah Anda yakin ingin mengubah role pengguna ini?')">
                                Simpan Perubahan Role
                            </button>
                        </div>

                    </div>

                </form>

            @endif

            <hr>

            
<div class="d-flex flex-wrap gap-2">

    <a href="{{ route('admin.pengguna') }}"
       class="btn btn-secondary">
        Kembali ke Data Pengguna
    </a>

    @if($user->id !== Auth::id())

        <form action="{{ route('admin.pengguna.destroy', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
                Hapus Pengguna
            </button>

        </form>

    @endif

</div>

        </div>

    </div>

</body>
</html>
