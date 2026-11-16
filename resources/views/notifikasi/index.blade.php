
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - TrashPoint</title>

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

        .notification-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 12px;
            background: white;
        }

        .unread {
            border-left: 5px solid #198754;
            background: #f3fbf6;
        }

        .notification-title {
            color: #212529;
            text-decoration: none;
        }

        .notification-title:hover {
            color: #198754;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container-fluid px-4">
        <span class="navbar-brand fw-bold">
            TrashPoint | Masyarakat
        </span>

        <a href="{{ route('dashboard') }}"
           class="btn btn-outline-light btn-sm">
            Kembali ke Dashboard
        </a>
    </div>
</nav>

<div class="container">
    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3 class="text-success fw-bold">Notifikasi</h3>
                <p class="text-muted">
                    Informasi terbaru mengenai laporan sampah kamu.
                </p>
            </div>

            @if(Auth::user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifikasi.bacaSemua') }}"
                      method="POST">
                    @csrf

                    <button class="btn btn-success btn-sm" type="submit">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        <hr>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @forelse($notifikasis as $notifikasi)

            <div class="notification-item {{ $notifikasi->read_at ? '' : 'unread' }}">

                <div class="d-flex justify-content-between flex-wrap gap-2">

                    <strong>
                        <a href="{{ route('notifikasi.open', $notifikasi->id) }}"
                           class="notification-title">
                            {{ $notifikasi->data['judul_laporan'] ?? 'Pembaruan Laporan' }}
                        </a>
                    </strong>

                    @if(!$notifikasi->read_at)
                        <span class="badge bg-success">Belum Dibaca</span>
                    @else
                        <span class="badge bg-secondary">Sudah Dibaca</span>
                    @endif

                </div>

                <p class="mt-2 mb-2">
                    {{ $notifikasi->data['pesan'] ?? 'Ada pembaruan pada laporan kamu.' }}
                </p>

                <small class="text-muted">
                    {{ $notifikasi->created_at->format('d-m-Y H:i') }}
                </small>

                <div class="mt-3 d-flex gap-2 flex-wrap">

                    <a href="{{ route('notifikasi.open', $notifikasi->id) }}"
                       class="btn btn-success btn-sm">
                        Lihat Detail Laporan
                    </a>

                    @if(!$notifikasi->read_at)
                        <form action="{{ route('notifikasi.baca', $notifikasi->id) }}"
                              method="POST">
                            @csrf

                            <button type="submit"
                                    class="btn btn-outline-success btn-sm">
                                Tandai Sudah Dibaca
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        @empty

            <div class="alert alert-info text-center">
                Belum ada notifikasi.
            </div>

        @endforelse

    </div>
</div>

</body>
</html>
