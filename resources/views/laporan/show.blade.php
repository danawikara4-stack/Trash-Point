
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Laporan - TrashPoint</title>

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

        .card {
            border: none;
            border-radius: 12px;
        }

        .foto-laporan {
            max-width: 400px;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .foto-penanganan {
            width: 100%;
            max-width: 350px;
            height: 220px;
            object-fit: cover;
            border-radius: 10px;
        }

        .timeline {
            border-left: 3px solid #198754;
            padding-left: 20px;
            margin-left: 8px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -29px;
            top: 4px;
            width: 15px;
            height: 15px;
            background: #198754;
            border-radius: 50%;
        }

        .section-title {
            color: #198754;
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-dark">
        <div class="container">

            <a href="{{ route('dashboard') }}"
               class="navbar-brand fw-bold">
                TrashPoint
            </a>

            <a href="{{ route('laporan.index') }}"
               class="btn btn-outline-light btn-sm">
                Riwayat Laporan
            </a>

        </div>
    </nav>


    <div class="container py-5">

        {{-- NOTIFIKASI --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        {{-- INFORMASI LAPORAN --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body p-4">

                <h3 class="section-title">
                    Detail Laporan Sampah
                </h3>

                <hr>

                <h5 class="fw-bold">
                    {{ $laporan->judul }}
                </h5>

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


                {{-- STATUS --}}
                <p>
                    <strong>Status Laporan:</strong>

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
                </p>


                {{-- FOTO LAPORAN AWAL --}}
                @if ($laporan->foto_laporan)

                    <div class="mb-3">

                        <strong>Foto Laporan Awal:</strong><br>

                        <img
                            src="{{ asset('storage/' . $laporan->foto_laporan) }}"
                            class="img-fluid foto-laporan mt-2"
                            alt="Foto laporan">

                    </div>

                @endif


                <p>
                    <strong>Tanggal Laporan:</strong>
                    {{ $laporan->created_at?->format('d-m-Y H:i') }}
                </p>

            </div>
        </div>


        {{-- RIWAYAT STATUS --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body p-4">

                <h4 class="section-title">
                    Riwayat Status Laporan
                </h4>

                <hr>

                @forelse ($laporan->riwayatStatus->sortBy('created_at') as $riwayat)

                    <div class="timeline">

                        <div class="timeline-item">

                            <h6 class="fw-bold">

                                {{ ucfirst($riwayat->status_sebelumnya ?? 'Awal') }}

                                <span class="text-success">
                                    →
                                </span>

                                {{ ucfirst($riwayat->status_baru) }}

                            </h6>

                            <p class="text-muted mb-1">
                                {{ $riwayat->created_at
                                    ? \Carbon\Carbon::parse($riwayat->created_at)->format('d-m-Y H:i')
                                    : '-' }}
                            </p>

                            <p class="mb-1">
                                <strong>Diubah oleh:</strong>
                                {{ $riwayat->user?->name ?? 'Pengguna tidak diketahui' }}
                            </p>

                            @if ($riwayat->catatan)
                                <p class="mb-0">
                                    <strong>Catatan:</strong>
                                    {{ $riwayat->catatan }}
                                </p>
                            @endif

                        </div>

                    </div>

                @empty

                    <div class="alert alert-info">
                        Belum ada riwayat perubahan status untuk laporan ini.
                    </div>

                @endforelse

            </div>
        </div>


        {{-- BUKTI PENANGANAN --}}
        <div class="card shadow-sm mb-4">

            <div class="card-body p-4">

                <h4 class="section-title">
                    Bukti Penanganan Petugas
                </h4>

                <hr>

                @forelse ($laporan->buktiPenanganan as $bukti)

                    <div class="border rounded p-3 mb-3">

                        <h6 class="fw-bold text-success">
                            Bukti Penanganan
                        </h6>

                        <p class="mb-2">
                            <strong>Petugas:</strong>
                            {{ $bukti->petugas?->name ?? '-' }}
                        </p>

                        @if ($bukti->foto)

                            <div class="mb-3">

                                <strong>Foto Hasil Penanganan:</strong><br>

                                <img
                                    src="{{ asset('storage/' . $bukti->foto) }}"
                                    class="img-fluid foto-penanganan mt-2"
                                    alt="Bukti penanganan">

                            </div>

                        @endif

                        <p class="mb-2">
                            <strong>Keterangan:</strong><br>
                            {{ $bukti->keterangan ?? 'Tidak ada keterangan.' }}
                        </p>

                        <p class="text-muted mb-0">
                            <small>
                                Tanggal Upload:
                                {{ $bukti->created_at?->format('d-m-Y H:i') ?? '-' }}
                            </small>
                        </p>

                    </div>

                @empty

                    <div class="alert alert-warning">
                        Belum ada bukti penanganan dari Petugas.
                    </div>

                @endforelse

            </div>
        </div>


        {{-- TOMBOL KEMBALI --}}
        <div class="mb-4">

            <a href="{{ route('laporan.index') }}"
               class="btn btn-secondary">
                Kembali ke Riwayat
            </a>

        </div>

    </div>

</body>
</html>
