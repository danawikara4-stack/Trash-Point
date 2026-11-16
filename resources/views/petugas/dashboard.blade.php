
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Petugas - TrashPoint</title>

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

        .foto {
            width: 100%;
            max-width: 220px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .judul {
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark px-4">

        <span class="navbar-brand fw-bold">
            TrashPoint | Petugas
        </span>

        <div class="d-flex align-items-center gap-3">

            <span class="text-white">
                {{ Auth::user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>

        </div>

    </nav>


    <div class="container-fluid content">

        <h3 class="fw-bold">Dashboard Petugas</h3>

        <p class="text-muted">
            Selamat datang, {{ Auth::user()->name }}!
            Berikut daftar laporan yang ditugaskan kepada Anda.
        </p>


        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- TOTAL PENUGASAN --}}
        <div class="row mt-4 mb-4">

            <div class="col-md-4">

                <div class="card shadow-sm p-4">

                    <h6 class="text-muted">Total Penugasan</h6>

                    <h2 class="judul">
                        {{ $penugasans->count() }}
                    </h2>

                    <small class="text-muted">
                        Jumlah laporan yang ditugaskan kepada Anda
                    </small>

                </div>

            </div>

        </div>


        <h5 class="fw-bold mb-3">Daftar Tugas Saya</h5>


        @forelse ($penugasans as $penugasan)

            @php
                $laporan = $penugasan->laporan;
            @endphp

            @if ($laporan)

                <div class="card shadow-sm p-4 mb-4">

                    <div class="row">

                        {{-- FOTO LAPORAN --}}
                        <div class="col-md-3 mb-3">

                            @if ($laporan->foto_laporan)

                                <img
                                    src="{{ asset('storage/' . $laporan->foto_laporan) }}"
                                    class="foto"
                                    alt="Foto laporan">

                            @else

                                <div class="bg-light rounded p-4 text-center">
                                    Tidak ada foto laporan
                                </div>

                            @endif

                        </div>


                        {{-- INFORMASI LAPORAN --}}
                        <div class="col-md-9">

                            <div class="d-flex justify-content-between flex-wrap gap-2">

                                <h5 class="fw-bold">
                                    {{ $laporan->judul }}
                                </h5>

                                @if ($laporan->status == 'selesai')

                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                @elseif ($laporan->status == 'diproses')

                                    <span class="badge bg-primary">
                                        Diproses
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        {{ ucfirst($laporan->status) }}
                                    </span>

                                @endif

                            </div>


                            <p class="text-muted">
                                {{ $laporan->deskripsi }}
                            </p>

                            <p class="mb-1">
                                <strong>Kategori:</strong>
                                {{ $laporan->kategoriSampah?->nama_kategori ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Lokasi:</strong>
                                {{ $laporan->lokasiLaporan?->nama_lokasi ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Alamat:</strong>
                                {{ $laporan->lokasiLaporan?->alamat ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Pelapor:</strong>
                                {{ $laporan->user?->name ?? '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Tanggal Laporan:</strong>
                                {{ $laporan->created_at?->format('d-m-Y H:i') }}
                            </p>

                            <p class="mb-1">
                                <strong>Tanggal Penugasan:</strong>
                                {{ $penugasan->tanggal_penugasan?->format('d-m-Y H:i') }}
                            </p>


                            <hr>


                            {{-- CATATAN ADMIN --}}
                            <div class="alert alert-info">

                                <strong>Catatan dari Admin:</strong>

                                <p class="mb-0 mt-1">
                                    {{ $penugasan->catatan ?: 'Tidak ada catatan khusus.' }}
                                </p>

                            </div>


                            {{-- FORM PENYELESAIAN --}}
                            @if ($laporan->status != 'selesai')

                                <div class="border rounded p-3">

                                    <h6 class="fw-bold mb-3">
                                        Selesaikan Penanganan Sampah
                                    </h6>

                                    <form
                                        action="{{ route('petugas.laporan.selesaikan', $laporan->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data">

                                        @csrf

                                        <div class="mb-3">

                                            <label class="form-label">
                                                Foto Bukti Penanganan
                                            </label>

                                            <input
                                                type="file"
                                                name="foto"
                                                class="form-control"
                                                accept="image/jpeg,image/png,image/webp"
                                                required>

                                            <small class="text-muted">
                                                Format JPG, PNG, atau WEBP. Maksimal 2 MB.
                                            </small>

                                        </div>


                                        <div class="mb-3">

                                            <label class="form-label">
                                                Keterangan Penanganan
                                            </label>

                                            <textarea
                                                name="keterangan"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Jelaskan tindakan yang telah dilakukan..."
                                                required></textarea>

                                        </div>


                                        <button
                                            type="submit"
                                            class="btn btn-success">

                                            Selesaikan Tugas

                                        </button>

                                    </form>

                                </div>

                            @else

                                <div class="alert alert-success">
                                    <strong>Tugas sudah diselesaikan!</strong>
                                    <p class="mb-0">
                                        Bukti penanganan telah dikirim.
                                    </p>
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

        @empty

            <div class="card shadow-sm p-5 text-center">

                <h5 class="text-muted">Belum Ada Penugasan</h5>

                <p class="text-muted mb-0">
                    Saat ini belum ada laporan yang ditugaskan kepada Anda.
                </p>

            </div>

        @endforelse

    </div>

</body>
</html>
