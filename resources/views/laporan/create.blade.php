
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - TrashPoint</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f1;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
        }

        h2 {
            color: #198754;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 13px;
            background: #198754;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 13px;
        }

        a {
            color: #198754;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Buat Laporan Sampah</h2>
    <p>Laporkan permasalahan sampah di lingkungan sekitar.</p>

    <a href="{{ route('laporan.index') }}">Lihat Riwayat Laporan</a>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <label>Judul Laporan</label>
        <input type="text" name="judul"
               value="{{ old('judul') }}"
               placeholder="Contoh: Tumpukan sampah di jalan"
               required>

        <label>Kategori Sampah</label>
        <select name="kategori_sampah_id" required>
            <option value="">Pilih Kategori</option>

            @foreach ($kategori as $item)
                <option value="{{ $item->id }}"
                    {{ old('kategori_sampah_id') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_kategori }}
                </option>
            @endforeach
        </select>

        <label>Nama Lokasi</label>
        <input type="text" name="nama_lokasi"
               value="{{ old('nama_lokasi') }}"
               placeholder="Contoh: Jalan Malioboro"
               required>

        <label>Alamat Lengkap</label>
        <textarea name="alamat" rows="3" required>{{ old('alamat') }}</textarea>

        <label>Kelurahan</label>
        <input type="text" name="kelurahan"
               value="{{ old('kelurahan') }}">

        <label>Kecamatan</label>
        <input type="text" name="kecamatan"
               value="{{ old('kecamatan') }}">

        <label>Kota / Kabupaten</label>
        <input type="text" name="kota_kabupaten"
               value="{{ old('kota_kabupaten') }}">

        <label>Deskripsi Laporan</label>
        <textarea name="deskripsi" rows="5"
                  placeholder="Jelaskan kondisi sampah..."
                  required>{{ old('deskripsi') }}</textarea>

        <label>Foto Bukti (Opsional)</label>
        <input type="file" name="foto_laporan"
               accept="image/jpeg,image/png,image/webp">

        <button type="submit">Kirim Laporan</button>

    </form>

</div>

</body>
</html>
