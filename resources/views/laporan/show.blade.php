
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-success">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold">
            TrashPoint
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <h3 class="text-success fw-bold">
                Detail Laporan Sampah
            </h3>

            <hr>

            <h5>{{ $laporan->judul }}</h5>

            <p>
                <strong>Kategori:</strong>
                {{ $laporan->kategoriSampah?->nama_kategori ?? '-' }}
            </p>

            <p>
                <strong>Lokasi:</strong>
                {{ $laporan->lokasiLaporan?->nama_lokasi ?? '-' }}
            </p>

            <p>
                <strong>Alamat:</strong>
                {{ $laporan->lokasiLaporan?->alamat ?? '-' }}
            </p>

            <p>
                <strong>Kelurahan:</strong>
                {{ $laporan->lokasiLaporan?->kelurahan ?? '-' }}
            </p>

            <p>
                <strong>Kecamatan:</strong>
                {{ $laporan->lokasiLaporan?->kecamatan ?? '-' }}
            </p>

            <p>
                <strong>Kota/Kabupaten:</strong>
                {{ $laporan->lokasiLaporan?->kota_kabupaten ?? '-' }}
            </p>

            <p>
                <strong>Deskripsi:</strong><br>
                {{ $laporan->deskripsi }}
            </p>

            <p>
                <strong>Status:</strong>
                <span class="badge bg-warning text-dark">
                    {{ ucfirst($laporan->status) }}
                </span>
            </p>

            @if ($laporan->foto_laporan)
                <div class="mb-3">
                    <strong>Foto Bukti:</strong><br>

                    <img
                        src="{{ asset('storage/' . $laporan->foto_laporan) }}"
                        class="img-fluid rounded mt-2"
                        style="max-width: 400px;"
                        alt="Foto laporan">
                </div>
            @endif

            <p>
                <strong>Tanggal Laporan:</strong>
                {{ $laporan->created_at?->format('d-m-Y H:i') }}
            </p>

            <hr>

            <a href="{{ route('laporan.index') }}"
               class="btn btn-secondary">
                Kembali ke Riwayat
            </a>

        </div>
    </div>

</div>

</body>
</html>
