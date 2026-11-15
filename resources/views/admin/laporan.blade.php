
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Laporan - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7f5;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #198754;
        }

        .content {
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .table th {
            background: #198754;
            color: white;
        }

        .status {
            font-weight: bold;
        }

        .foto {
            width: 75px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark px-4">
    <span class="navbar-brand fw-bold">
        TrashPoint | Admin
    </span>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-light btn-sm">
            Dashboard
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container-fluid content">

    <h3 class="fw-bold">Kelola Laporan Sampah</h3>

    <p class="text-muted">
        Lihat dan pantau seluruh laporan sampah dari masyarakat.
    </p>

    <div class="card shadow-sm p-4 mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h5>Daftar Laporan Masyarakat</h5>

            <span class="badge bg-success">
                Total: {{ $laporans->count() }} Laporan
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($laporans as $laporan)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $laporan->judul }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit($laporan->deskripsi, 60) }}
                                </small>
                            </td>

                            <td>
                                {{ $laporan->kategoriSampah?->nama_kategori ?? '-' }}
                            </td>

                            <td>
                                {{ $laporan->lokasiLaporan?->nama_lokasi ?? '-' }}
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
                                        {{ ucfirst($laporan->status) }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if ($laporan->foto_laporan)
                                    <img
                                        src="{{ asset('storage/' . $laporan->foto_laporan) }}"
                                        class="foto"
                                        alt="Foto laporan">
                                @else
                                    <span class="text-muted">
                                        Tidak ada foto
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $laporan->created_at?->format('d-m-Y H:i') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada laporan dari masyarakat.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>
