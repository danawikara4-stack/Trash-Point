
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Laporan - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

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
            white-space: nowrap;
        }

        .foto {
            width: 75px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .aksi-form {
            min-width: 210px;
        }

        .filter-card {
            border-radius: 12px;
        }

        @media (max-width: 768px) {
            .content {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
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

                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>


    <!-- KONTEN -->
    <div class="container-fluid content">

        <h3 class="fw-bold">Kelola Laporan Sampah</h3>

        <p class="text-muted">
            Lihat, pantau, cari, dan tugaskan laporan sampah dari masyarakat.
        </p>


        <!-- FORM PENCARIAN DAN FILTER -->
        <div class="card shadow-sm p-3 mt-4 mb-3 filter-card">

            <h5 class="mb-3">Pencarian dan Filter Laporan</h5>

            <form action="{{ route('admin.laporan') }}" method="GET">

                <div class="row g-3">

                    <!-- PENCARIAN -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">
                            Cari Laporan
                        </label>

                        <input
                            type="text"
                            name="q"
                            class="form-control"
                            placeholder="Cari judul atau deskripsi..."
                            value="{{ request('q') }}">
                    </div>


                    <!-- FILTER STATUS -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            Filter Status
                        </label>

                        <select name="status" class="form-select">

                            <option value="">
                                Semua Status
                            </option>

                            <option value="menunggu"
                                {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option value="diproses"
                                {{ request('status') == 'diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="selesai"
                                {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>
                    </div>


                    <!-- FILTER KATEGORI -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">
                            Filter Kategori
                        </label>

                        <select name="kategori" class="form-select">

                            <option value="">
                                Semua Kategori
                            </option>

                            @foreach ($kategori as $item)

                                <option
                                    value="{{ $item->id }}"
                                    {{ request('kategori') == $item->id ? 'selected' : '' }}>

                                    {{ $item->nama_kategori }}

                                </option>

                            @endforeach

                        </select>
                    </div>


                    <!-- TOMBOL -->
                    <div class="col-md-2 d-flex align-items-end gap-2">

                        <button type="submit"
                                class="btn btn-success w-100">
                            Cari
                        </button>

                        <a href="{{ route('admin.laporan') }}"
                           class="btn btn-secondary w-100">
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        <!-- TABEL LAPORAN -->
        <div class="card shadow-sm p-4 mt-3">


            <!-- NOTIFIKASI BERHASIL -->
            @if (session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            <!-- NOTIFIKASI ERROR -->
            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Terjadi kesalahan:</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- JUDUL TABEL -->
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
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($laporans as $laporan)

                            @php
                                $penugasan = $laporan->penugasan->first();
                            @endphp


                            <tr>

                                <!-- NOMOR -->
                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <!-- JUDUL DAN DESKRIPSI -->
                                <td>

                                    <strong>
                                        {{ $laporan->judul }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        {{ \Illuminate\Support\Str::limit($laporan->deskripsi, 60) }}
                                    </small>

                                </td>


                                <!-- KATEGORI -->
                                <td>
                                    {{ $laporan->kategoriSampah?->nama_kategori ?? '-' }}
                                </td>


                                <!-- LOKASI -->
                                <td>
                                    {{ $laporan->lokasiLaporan?->nama_lokasi ?? '-' }}
                                </td>


                                <!-- STATUS -->
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


                                <!-- FOTO -->
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


                                <!-- TANGGAL -->
                                <td>
                                    {{ $laporan->created_at?->format('d-m-Y H:i') }}
                                </td>


                                <!-- AKSI -->
                                <td>

                                    <div class="aksi-form">


                                        <!-- FORM UBAH STATUS -->
                                        <form
                                            action="{{ route('admin.laporan.updateStatus', $laporan->id) }}"
                                            method="POST"
                                            class="mb-3">

                                            @csrf
                                            @method('PATCH')

                                            <label class="form-label fw-bold">
                                                Ubah Status
                                            </label>

                                            <select
                                                name="status"
                                                class="form-select form-select-sm mb-2"
                                                required>

                                                <option value="menunggu"
                                                    {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>
                                                    Menunggu
                                                </option>

                                                <option value="diproses"
                                                    {{ $laporan->status == 'diproses' ? 'selected' : '' }}>
                                                    Diproses
                                                </option>

                                                <option value="selesai"
                                                    {{ $laporan->status == 'selesai' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>

                                            </select>

                                            <button
                                                type="submit"
                                                class="btn btn-success btn-sm w-100">

                                                Simpan Status

                                            </button>

                                        </form>


                                        <hr>


                                        <!-- PETUGAS SAAT INI -->
                                        <label class="form-label fw-bold">
                                            Petugas Saat Ini
                                        </label>

                                        @if ($penugasan && $penugasan->petugas)

                                            <div class="alert alert-info py-2 small">
                                                {{ $penugasan->petugas->name }}
                                            </div>

                                        @else

                                            <div class="alert alert-secondary py-2 small">
                                                Belum ditugaskan
                                            </div>

                                        @endif


                                        <!-- FORM PENUGASAN PETUGAS -->
                                        <form
                                            action="{{ route('admin.laporan.assignPetugas', $laporan->id) }}"
                                            method="POST">

                                            @csrf

                                            <label class="form-label fw-bold">
                                                Pilih Petugas
                                            </label>

                                            <select
                                                name="petugas_id"
                                                class="form-select form-select-sm mb-2"
                                                required>

                                                <option value="">
                                                    -- Pilih Petugas --
                                                </option>

                                                @foreach ($petugas as $p)

                                                    <option
                                                        value="{{ $p->id }}"
                                                        {{ $penugasan && $penugasan->petugas_id == $p->id ? 'selected' : '' }}>

                                                        {{ $p->name }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            <label class="form-label fw-bold">
                                                Catatan Penugasan
                                            </label>

                                            <textarea
                                                name="catatan"
                                                class="form-control form-control-sm mb-2"
                                                rows="2"
                                                placeholder="Contoh: Segera bersihkan lokasi sampah">{{ $penugasan?->catatan }}</textarea>


                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-sm w-100"
                                                @disabled($petugas->isEmpty())>

                                                Tugaskan Petugas

                                            </button>

                                            @if ($petugas->isEmpty())

                                                <small class="text-danger d-block mt-2">
                                                    Belum ada akun dengan role petugas.
                                                </small>

                                            @endif

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-4">

                                    Tidak ada laporan yang sesuai dengan pencarian.

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
