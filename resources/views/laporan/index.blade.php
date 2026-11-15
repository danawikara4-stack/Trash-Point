
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Laporan - TrashPoint</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f1;
            min-height: 100vh;
        }

        .navbar {
            background: #198754;
        }

        .main-container {
            max-width: 1100px;
            margin: 40px auto;
        }

        .header-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header-card h2 {
            color: #198754;
            font-weight: bold;
        }

        .laporan-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px;
            margin-top: 18px;
            transition: 0.3s;
        }

        .laporan-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .laporan-card h5 {
            font-weight: bold;
            color: #263238;
        }

        .info {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .deskripsi {
            color: #475569;
            line-height: 1.6;
            margin-top: 15px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #997404;
        }

        .status-diverifikasi {
            background: #cfe2ff;
            color: #084298;
        }

        .status-ditugaskan {
            background: #e2d9f3;
            color: #59359a;
        }

        .status-diproses {
            background: #cff4fc;
            color: #055160;
        }

        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #842029;
        }

        .foto-laporan {
            width: 180px;
            max-width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 12px;
        }

        .search-box {
            background: white;
            padding: 18px;
            border-radius: 12px;
            margin-top: 22px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .empty-state {
            background: white;
            padding: 45px 20px;
            text-align: center;
            border-radius: 12px;
            margin-top: 20px;
        }

        .btn-success {
            background: #198754;
        }

        @media (max-width: 576px) {
            .main-container {
                margin: 20px 12px;
            }

            .header-card {
                padding: 18px;
            }

            .laporan-card {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container">

            <a href="{{ route('dashboard') }}"
               class="navbar-brand fw-bold">
                TrashPoint
            </a>

            <a href="{{ route('dashboard') }}"
               class="btn btn-outline-light btn-sm">
                Kembali ke Dashboard
            </a>

        </div>
    </nav>


    <div class="container main-container">

        <!-- Header -->
        <div class="header-card">

            <h2>Riwayat Laporan Saya</h2>

            <p class="text-muted mb-3">
                Pantau dan lihat perkembangan laporan sampah
                yang telah kamu kirim.
            </p>

            <a href="{{ route('laporan.create') }}"
               class="btn btn-success">
                + Buat Laporan
            </a>

        </div>


        <!-- Pesan Berhasil -->
        @if (session('success'))

            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>

        @endif


        <!-- Pencarian dan Filter -->
        @if ($laporans->isNotEmpty())

            <div class="search-box">

                <div class="row g-3">

                    <div class="col-md-8">

                        <label class="form-label fw-bold">
                            Cari Laporan
                        </label>

                        <input
                            type="text"
                            id="searchLaporan"
                            class="form-control"
                            placeholder="Cari berdasarkan judul atau lokasi..."
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label fw-bold">
                            Filter Status
                        </label>

                        <select id="filterStatus" class="form-select">

                            <option value="">Semua Status</option>

                            @foreach ($laporans->pluck('status')->unique() as $statusFilter)

                                <option value="{{ strtolower($statusFilter) }}">
                                    {{ ucfirst($statusFilter) }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        @endif


        <!-- Daftar Laporan -->
        @forelse ($laporans as $laporan)

            @php
                $status = strtolower($laporan->status ?? 'menunggu');

                $statusClass = match ($status) {
                    'menunggu' => 'status-menunggu',
                    'diverifikasi' => 'status-diverifikasi',
                    'ditugaskan' => 'status-ditugaskan',
                    'diproses' => 'status-diproses',
                    'selesai' => 'status-selesai',
                    'ditolak' => 'status-ditolak',
                    default => 'status-menunggu',
                };
            @endphp

            <div class="laporan-card"
                 data-status="{{ $status }}">

                <div class="d-flex justify-content-between
                            align-items-start flex-wrap gap-2">

                    <div>

                        <h5>{{ $laporan->judul }}</h5>

                        <div class="info">
                            Kategori:
                            <strong>
                                {{ $laporan->kategoriSampah?->nama_kategori ?? '-' }}
                            </strong>
                        </div>

                        <div class="info">
                            Lokasi:
                            <strong>
                                {{ $laporan->lokasiLaporan?->nama_lokasi ?? '-' }}
                            </strong>
                        </div>

                    </div>

                    <span class="status {{ $statusClass }}">
                        {{ ucfirst($status) }}
                    </span>

                </div>


                <hr>


                <!-- Informasi Alamat -->
                <div class="info">

                    <strong>Alamat Lengkap:</strong><br>

                    {{ $laporan->lokasiLaporan?->alamat ?? '-' }}

                    @if ($laporan->lokasiLaporan?->kelurahan)
                        <br>Kelurahan:
                        {{ $laporan->lokasiLaporan->kelurahan }}
                    @endif

                    @if ($laporan->lokasiLaporan?->kecamatan)
                        <br>Kecamatan:
                        {{ $laporan->lokasiLaporan->kecamatan }}
                    @endif

                    @if ($laporan->lokasiLaporan?->kota_kabupaten)
                        <br>Kota/Kabupaten:
                        {{ $laporan->lokasiLaporan->kota_kabupaten }}
                    @endif

                </div>


                <!-- Deskripsi -->
                <div class="deskripsi">

                    <strong>Deskripsi Laporan:</strong>

                    <p>
                        {{ $laporan->deskripsi }}
                    </p>

                </div>


                <!-- Foto Bukti -->
                @if ($laporan->foto_laporan)

                    <div class="mt-3">

                        <strong>Foto Bukti:</strong><br>

                        <a href="{{ asset('storage/' . $laporan->foto_laporan) }}"
                           target="_blank">

                            <img
                                src="{{ asset('storage/' . $laporan->foto_laporan) }}"
                                alt="Foto bukti laporan"
                                class="foto-laporan"
                            >

                        </a>

                    </div>

                @endif


                <!-- Tanggal -->
                <div class="info mt-3">

                    <strong>Tanggal Laporan:</strong>

                    {{ $laporan->created_at?->format('d-m-Y H:i') ?? '-' }}

                </div>
               
                <!-- Tombol Detail -->
<div class="mt-3">
    <a href="{{ route('laporan.show', $laporan->id) }}"
       class="btn btn-success btn-sm">
        Lihat Detail
    </a>
</div>

            </div>

        @empty

            <div class="empty-state">

                <h5>Belum Ada Laporan</h5>

                <p class="text-muted">
                    Kamu belum mengirim laporan sampah.
                    Silakan buat laporan pertamamu.
                </p>

                <a href="{{ route('laporan.create') }}"
                   class="btn btn-success">

                    Buat Laporan Sekarang

                </a>

            </div>

        @endforelse


        <!-- Hasil Pencarian Kosong -->
        <div id="noSearchResult"
             class="empty-state"
             style="display: none;">

            <h5>Laporan Tidak Ditemukan</h5>

            <p class="text-muted">
                Tidak ada laporan yang sesuai dengan pencarianmu.
            </p>

        </div>

    </div>


    <!-- JavaScript Pencarian dan Filter -->
    <script>

        const searchInput = document.getElementById('searchLaporan');
        const filterStatus = document.getElementById('filterStatus');

        function filterLaporan() {

            const keyword = searchInput.value.toLowerCase();
            const selectedStatus = filterStatus.value.toLowerCase();

            const cards = document.querySelectorAll('.laporan-card');

            let jumlahTampil = 0;

            cards.forEach(card => {

                const isiLaporan = card.innerText.toLowerCase();
                const status = card.dataset.status;

                const cocokKeyword = isiLaporan.includes(keyword);

                const cocokStatus =
                    selectedStatus === '' ||
                    status === selectedStatus;

                if (cocokKeyword && cocokStatus) {

                    card.style.display = 'block';
                    jumlahTampil++;

                } else {

                    card.style.display = 'none';

                }

            });

            const noResult = document.getElementById('noSearchResult');

            if (noResult) {
                noResult.style.display =
                    cards.length > 0 && jumlahTampil === 0
                        ? 'block'
                        : 'none';
            }

        }

        if (searchInput && filterStatus) {

            searchInput.addEventListener('input', filterLaporan);

            filterStatus.addEventListener('change', filterLaporan);

        }

    </script>

</body>
</html>
