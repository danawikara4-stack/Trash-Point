-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2026 pada 01.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trashpoint`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_penanganan`
--

CREATE TABLE `bukti_penanganan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bukti_penanganan`
--

INSERT INTO `bukti_penanganan` (`id`, `laporan_id`, `petugas_id`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'bukti-penanganan/8MSkPJXsLUHbhC4qEEKE9XVzAVwGFR6vYeXhwMHQ.jpg', 'sudah selesai bersihin sampahnya', '2026-11-16 03:35:52', '2026-11-16 03:35:52'),
(2, 4, 3, 'bukti-penanganan/yn3Tv27kwTySYlcXpPmSvewEkkVXbkGHvSlEZANs.png', 'memilah dengan benar', '2026-11-17 00:26:20', '2026-11-17 00:26:20'),
(3, 5, 3, 'bukti-penanganan/Jt4edVLsBL3STvcbZR4xF0fqVG5XaCJJIzjZTHaa.png', 'berhasil diambil', '2026-11-17 01:34:42', '2026-11-17 01:34:42'),
(4, 6, 3, 'bukti-penanganan/yX6Wh0Mw9hUJbKYQMgiDe7MKMiTHSOV2V3g3xfYi.jpg', 'Sampah sudah di bereskan', '2026-11-18 02:37:07', '2026-11-18 02:37:07'),
(5, 7, 3, 'bukti-penanganan/ZSvDQsFGFwcalJnjvN551VATHTVg2s9ENQ2YKsS8.jpg', 'sudah dibersihkan', '2026-11-24 09:22:55', '2026-11-24 09:22:55'),
(6, 9, 3, 'bukti-penanganan/dgKKjFNxHF70qpYjPtNSurHH5t0wi18wPI8x3tB4.jpg', 'Sudah dibersihkan', '2026-11-25 07:12:57', '2026-11-25 07:12:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_sampah`
--

CREATE TABLE `kategori_sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_sampah`
--

INSERT INTO `kategori_sampah` (`id`, `nama_kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Organik', 'Sampah yang mudah terurai secara alami', '2026-11-15 08:51:21', '2026-11-15 08:51:21'),
(2, 'Anorganik', 'Sampah seperti plastik, kaca, dan logam', '2026-11-15 08:51:21', '2026-11-15 08:51:21'),
(3, 'B3', 'Sampah bahan berbahaya dan beracun', '2026-11-15 08:51:21', '2026-11-15 08:51:21'),
(4, 'Campuran', 'Sampah yang terdiri dari beberapa jenis', '2026-11-15 08:51:21', '2026-11-15 08:51:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kategori_sampah_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi_laporan_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto_laporan` varchar(255) DEFAULT NULL,
  `status` enum('menunggu','diverifikasi','ditugaskan','diproses','selesai','ditolak') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `user_id`, `kategori_sampah_id`, `lokasi_laporan_id`, `judul`, `deskripsi`, `foto_laporan`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Penumpukan Sampah di Pinggir Jalan', 'Terdapat penumpukan sampah organik di pinggir jalan yang menyebabkan lingkungan terlihat kotor dan menimbulkan bau tidak sedap. Sampah belum dibersihkan sehingga perlu dilakukan penanganan.', NULL, 'selesai', '2026-11-15 03:14:31', '2026-11-16 06:33:57'),
(3, 4, 4, 3, 'Sampah rumahku', 'Sampahku akehh', 'laporan/kDVq5YpSvHeNM5O5a2hP4EhkyHVaMFNRHSpWsCSV.png', 'selesai', '2026-11-16 23:42:49', '2026-11-17 21:13:20'),
(4, 4, 1, 4, 'Sampah Properti', 'banyak dan basah', 'laporan/tk8vX76g77S7XGsNZ4y234iOq14Ot3fVQjqix6sb.webp', 'selesai', '2026-11-16 23:59:32', '2026-11-17 00:26:20'),
(5, 4, 2, 5, 'Tumpukan sampah di trotoar', 'agak basah dan kering', 'laporan/Mfu4baSUbZniRRAuheGFQU0Cz0CZIRZfskTtfVpb.webp', 'selesai', '2026-11-17 01:33:06', '2026-11-17 01:34:42'),
(6, 4, 4, 6, 'Sampah di ringroad', 'Menumpuk berserakan dan baub, mengganggu aktivitas kendaraan', 'laporan/Xr8JmlhaEA9d6b3mUo9lLHAoN4vECVsNt5qj7XpX.webp', 'selesai', '2026-11-18 02:34:14', '2026-11-18 02:37:07'),
(7, 4, 4, 7, 'SAMPAH NUMPUK', 'bau menyengat dan menganggu penguna jalan', 'laporan/fpwDQ2J7FFtPal5EgSgI5URwqAkHl5mbQWWiACtY.jpg', 'selesai', '2026-11-24 09:10:10', '2026-11-24 09:22:55'),
(8, 4, 1, 8, 'test sampah 1', 'menumpuk', 'laporan/1RaPN3Hpd2nfhrTG5UuRyDlwUU1lCj9OSej9As5e.webp', 'selesai', '2026-11-24 09:22:27', '2026-11-25 07:09:30'),
(9, 4, 4, 9, 'orang nyampah sembarangan', 'bau menyengat dan tidak terurus', 'laporan/Zra8xyGUq1HHCnqFhkl3voe46GCbnlf81SF550Ol.jpg', 'selesai', '2026-11-25 07:08:29', '2026-11-25 07:12:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_laporan`
--

CREATE TABLE `lokasi_laporan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lokasi` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lokasi_laporan`
--

INSERT INTO `lokasi_laporan` (`id`, `nama_lokasi`, `alamat`, `kelurahan`, `kecamatan`, `kota_kabupaten`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Jalan Malioboro', 'Jalan Malioboro, Kota Yogyakarta, Daerah Istimewa Yogyakarta', 'Sosromenduran', 'Sosromenduran', 'Kota Yogyakarta', NULL, NULL, '2026-11-15 03:14:31', '2026-11-15 03:14:31'),
(3, 'Pondok surya', 'Klaten raya', 'Temuwangi', 'Pedan', 'Klaten', NULL, NULL, '2026-11-16 23:42:49', '2026-11-16 23:42:49'),
(4, 'Malioboro', 'Jalanan Malioboro, gang janti, sarkem', 'Ngupasan', 'Jogja', 'Yogyakarta', NULL, NULL, '2026-11-16 23:59:32', '2026-11-16 23:59:32'),
(5, 'Jl babarsari', 'Jl babarsari, tambak bayan', 'sleman', 'sleman', 'yogyakarta', NULL, NULL, '2026-11-17 01:33:06', '2026-11-17 01:33:06'),
(6, 'Giwangan', 'Giwangan, Yogyakarta', 'Umbulharjo', 'Girisuko', 'Yogyakarta', NULL, NULL, '2026-11-18 02:34:14', '2026-11-18 02:34:14'),
(7, 'Jalan Babarsari', 'Caturtunggal, Kapanewon Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta', 'Catur tunggal', 'Depok', 'Yogyakarta', NULL, NULL, '2026-11-24 09:10:10', '2026-11-24 09:10:10'),
(8, 'nawungan', 'selopamioro', 'banyul', 'mbantul', 'yogyakarta', NULL, NULL, '2026-11-24 09:22:27', '2026-11-24 09:22:27'),
(9, 'Jl. Babarsari', 'Caturtunggal, Kecamatan Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta', 'Caturtunggal', 'depok', 'sleman', NULL, NULL, '2026-11-25 07:08:29', '2026-11-25 07:08:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_16_123833_create_notifications_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0181f241-eadf-4483-bf18-b55d631275f3', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":5,\"judul_laporan\":\"Tumpukan sampah di trotoar\",\"pesan\":\"Laporan \\\"Tumpukan sampah di trotoar\\\" telah selesai ditangani oleh petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/5\"}', '2026-11-17 01:58:57', '2026-11-17 01:34:42', '2026-11-17 01:58:57'),
('05100326-a862-46e0-abb7-1d3b1e9b01d2', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":7,\"judul_laporan\":\"SAMPAH NUMPUK\",\"pesan\":\"Laporan \\\"SAMPAH NUMPUK\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/7\"}', NULL, '2026-11-24 09:11:29', '2026-11-24 09:11:29'),
('1cddc340-c117-406c-954d-7cad6685e17a', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":5,\"judul_laporan\":\"Tumpukan sampah di trotoar\",\"pesan\":\"Laporan \\\"Tumpukan sampah di trotoar\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/5\"}', '2026-11-17 01:58:59', '2026-11-17 01:33:58', '2026-11-17 01:58:59'),
('1f0d3f88-e6cc-4296-a6d7-7671795a1f4c', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":7,\"judul_laporan\":\"SAMPAH NUMPUK\",\"pesan\":\"Status laporan \\\"SAMPAH NUMPUK\\\" telah diubah menjadi Diproses.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/7\"}', NULL, '2026-11-24 09:19:53', '2026-11-24 09:19:53'),
('2d3d455d-49ce-48f5-9106-5fb029906164', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Status laporan \\\"Sampah Properti\\\" telah diubah menjadi Menunggu.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:22', '2026-11-17 00:14:04', '2026-11-17 00:17:22'),
('385140d8-7ce6-47b2-9ee3-1afc607ce08a', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Status laporan \\\"Sampah Properti\\\" telah diubah menjadi Diproses.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:20', '2026-11-17 00:14:11', '2026-11-17 00:17:20'),
('4aa43333-8538-432d-bf07-6618268b7ab9', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":7,\"judul_laporan\":\"SAMPAH NUMPUK\",\"pesan\":\"Laporan \\\"SAMPAH NUMPUK\\\" telah selesai ditangani oleh petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/7\"}', '2026-11-24 09:23:12', '2026-11-24 09:22:55', '2026-11-24 09:23:12'),
('4d7ae409-7423-4d63-81e3-923baad8569c', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Laporan \\\"Sampah Properti\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:24', '2026-11-17 00:13:33', '2026-11-17 00:17:24'),
('6c48534b-1df7-49dc-b810-60a8c1bcf7c7', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Laporan \\\"Sampah Properti\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:18', '2026-11-17 00:14:20', '2026-11-17 00:17:18'),
('729640fa-faeb-43dd-a6f0-3ced6c2e4c71', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":3,\"judul_laporan\":\"Sampah rumahku\",\"pesan\":\"Status laporan \\\"Sampah rumahku\\\" telah diubah menjadi Selesai.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/3\"}', '2026-11-18 02:30:26', '2026-11-17 21:13:22', '2026-11-18 02:30:26'),
('82642845-8d1e-4949-a251-b19ad05a2b27', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 1, '{\"laporan_id\":1,\"judul_laporan\":\"Penumpukan Sampah di Pinggir Jalan\",\"pesan\":\"Status laporan \\\"Penumpukan Sampah di Pinggir Jalan\\\" telah diubah menjadi Diproses.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/1\"}', '2026-11-16 06:32:48', '2026-11-16 06:23:38', '2026-11-16 06:32:48'),
('88272e58-b3da-40a7-9547-adb50ec20031', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":6,\"judul_laporan\":\"Sampah di ringroad\",\"pesan\":\"Laporan \\\"Sampah di ringroad\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/6\"}', NULL, '2026-11-18 02:35:46', '2026-11-18 02:35:46'),
('8a275ab2-c5e9-4e11-bc72-b6901e7c682c', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":6,\"judul_laporan\":\"Sampah di ringroad\",\"pesan\":\"Status laporan \\\"Sampah di ringroad\\\" telah diubah menjadi Diproses.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/6\"}', NULL, '2026-11-18 02:35:30', '2026-11-18 02:35:30'),
('8eccc688-418c-4530-a50d-e4b860e6dafe', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 1, '{\"judul\":\"Pembaruan Laporan\",\"pesan\":\"Status laporan \\\"Penumpukan Sampah di Pinggir Jalan\\\" telah diubah menjadi Menunggu.\",\"laporan_id\":1,\"nama_laporan\":\"Penumpukan Sampah di Pinggir Jalan\",\"status\":\"menunggu\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/1\"}', '2026-11-16 06:11:37', '2026-11-16 05:46:21', '2026-11-16 06:11:37'),
('9062e566-e17d-4bf3-bcc1-a8069a3e1dc1', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":6,\"judul_laporan\":\"Sampah di ringroad\",\"pesan\":\"Laporan \\\"Sampah di ringroad\\\" telah selesai ditangani oleh petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/6\"}', '2026-11-18 03:10:05', '2026-11-18 02:37:07', '2026-11-18 03:10:05'),
('a3e917c3-edf8-47da-a50d-3ee871c31d3d', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":8,\"judul_laporan\":\"test sampah 1\",\"pesan\":\"Status laporan \\\"test sampah 1\\\" telah diubah menjadi Selesai.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/8\"}', NULL, '2026-11-25 07:09:32', '2026-11-25 07:09:32'),
('aa862666-28ea-4a63-887e-532fab5472ca', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Laporan \\\"Sampah Properti\\\" telah selesai ditangani oleh petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 01:14:50', '2026-11-17 00:26:20', '2026-11-17 01:14:50'),
('ae33c641-bf4e-4e72-b8c3-108dacb33d61', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":7,\"judul_laporan\":\"SAMPAH NUMPUK\",\"pesan\":\"Status laporan \\\"SAMPAH NUMPUK\\\" telah diubah menjadi Selesai.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/7\"}', '2026-11-24 09:16:43', '2026-11-24 09:15:54', '2026-11-24 09:16:43'),
('bb84e04a-0bac-4dc3-8aab-f61aca6ab400', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 1, '{\"laporan_id\":1,\"judul_laporan\":\"Penumpukan Sampah di Pinggir Jalan\",\"pesan\":\"Status laporan \\\"Penumpukan Sampah di Pinggir Jalan\\\" telah diubah menjadi Selesai.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/1\"}', '2026-11-16 06:34:27', '2026-11-16 06:33:57', '2026-11-16 06:34:27'),
('c8774edf-3f6e-4fea-bf28-5f0ab9116926', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Laporan \\\"Sampah Properti\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:11', '2026-11-17 00:13:14', '2026-11-17 00:17:11'),
('e332463b-ec3a-40ad-b330-17f78e213d15', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":9,\"judul_laporan\":\"orang nyampah sembarangan\",\"pesan\":\"Laporan \\\"orang nyampah sembarangan\\\" telah selesai ditangani oleh petugas.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/9\"}', '2026-11-25 17:36:26', '2026-11-25 07:12:57', '2026-11-25 17:36:26'),
('ec583c03-4bda-4f67-bc17-c94d4c422af6', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":4,\"judul_laporan\":\"Sampah Properti\",\"pesan\":\"Laporan \\\"Sampah Properti\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/4\"}', '2026-11-17 00:17:27', '2026-11-17 00:13:13', '2026-11-17 00:17:27'),
('ec94084d-e09b-4e3a-85ee-e578b4c673dc', 'App\\Notifications\\StatusLaporanNotification', 'App\\Models\\User', 4, '{\"laporan_id\":9,\"judul_laporan\":\"orang nyampah sembarangan\",\"pesan\":\"Laporan \\\"orang nyampah sembarangan\\\" telah ditugaskan kepada petugas Petugas TrashPoint.\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/laporan\\/9\"}', NULL, '2026-11-25 07:10:37', '2026-11-25 07:10:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_sampah`
--

CREATE TABLE `penjualan_sampah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `total_berat` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan_sampah`
--

INSERT INTO `penjualan_sampah` (`id`, `tanggal`, `total_berat`, `total_nominal`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2026-11-17', 25.00, 250000.00, 2, '2026-11-17 01:12:58', '2026-11-17 01:12:58'),
(2, '2026-11-17', 30.00, 25000.00, 2, '2026-11-17 01:28:02', '2026-11-17 01:28:02'),
(3, '2026-11-17', 12.60, 12000.00, 2, '2026-11-17 01:35:26', '2026-11-17 01:35:26'),
(4, '2026-11-17', 1000.00, 10000000.00, 2, '2026-11-17 01:36:44', '2026-11-17 01:36:44'),
(5, '2026-11-17', 12.00, 134000.00, 2, '2026-11-17 01:50:04', '2026-11-17 01:50:04'),
(6, '2026-11-18', 300.00, 650000.00, 2, '2026-11-18 02:38:13', '2026-11-18 02:38:13'),
(7, '2026-11-18', 75.00, 245000.00, 2, '2026-11-18 03:22:52', '2026-11-18 03:22:52'),
(8, '2026-11-25', 76.00, 120000.00, 2, '2026-11-25 07:14:34', '2026-11-25 07:14:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penugasan`
--

CREATE TABLE `penugasan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `petugas_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penugasan` timestamp NOT NULL DEFAULT current_timestamp(),
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penugasan`
--

INSERT INTO `penugasan` (`id`, `laporan_id`, `petugas_id`, `admin_id`, `tanggal_penugasan`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '2026-11-16 03:07:42', 'segera bersihkan sampah yang ada dilokasi', '2026-11-16 03:06:27', '2026-11-16 03:07:42'),
(2, 4, 3, 2, '2026-11-17 00:14:20', 'gasken', '2026-11-17 00:13:12', '2026-11-17 00:14:20'),
(3, 5, 3, 2, '2026-11-17 01:33:58', 'gerak cepat', '2026-11-17 01:33:58', '2026-11-17 01:33:58'),
(4, 6, 3, 2, '2026-11-18 02:35:46', 'Segera Mangkat', '2026-11-18 02:35:46', '2026-11-18 02:35:46'),
(5, 7, 3, 2, '2026-11-24 09:11:28', 'SEGERA BERSIHKAN!!!!!!!!!!!!!!', '2026-11-24 09:11:28', '2026-11-24 09:11:28'),
(6, 9, 3, 2, '2026-11-25 07:10:37', 'CEPET BERSIHINN', '2026-11-25 07:10:37', '2026-11-25 07:10:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_status`
--

CREATE TABLE `riwayat_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `laporan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_sebelumnya` varchar(30) DEFAULT NULL,
  `status_baru` varchar(30) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `riwayat_status`
--

INSERT INTO `riwayat_status` (`id`, `laporan_id`, `user_id`, `status_sebelumnya`, `status_baru`, `catatan`, `created_at`) VALUES
(1, 1, 3, 'diproses', 'selesai', 'sudah selesai bersihin sampahnya', '2026-11-16 03:35:52'),
(2, 1, 2, 'selesai', 'menunggu', 'Status diperbarui oleh Admin.', '2026-11-16 05:46:20'),
(3, 1, 2, 'menunggu', 'selesai', 'Status diperbarui oleh Admin.', '2026-11-16 05:51:22'),
(4, 1, 2, 'selesai', 'diproses', 'Status diperbarui oleh Admin.', '2026-11-16 06:23:38'),
(5, 1, 2, 'diproses', 'selesai', 'Status diperbarui oleh Admin.', '2026-11-16 06:33:57'),
(6, 3, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-16 23:42:49'),
(7, 4, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-16 23:59:32'),
(8, 4, 2, 'menunggu', 'diproses', 'Laporan ditugaskan kepada Petugas: Petugas TrashPoint', '2026-11-17 00:13:12'),
(9, 4, 2, 'diproses', 'menunggu', 'Status diperbarui oleh Admin.', '2026-11-17 00:14:04'),
(10, 4, 2, 'menunggu', 'diproses', 'Status diperbarui oleh Admin.', '2026-11-17 00:14:11'),
(11, 4, 3, 'diproses', 'selesai', 'memilah dengan benar', '2026-11-17 00:26:20'),
(12, 5, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-17 01:33:06'),
(13, 5, 2, 'menunggu', 'diproses', 'Laporan ditugaskan kepada Petugas: Petugas TrashPoint', '2026-11-17 01:33:58'),
(14, 5, 3, 'diproses', 'selesai', 'berhasil diambil', '2026-11-17 01:34:42'),
(15, 3, 2, 'menunggu', 'selesai', 'Status diperbarui oleh Admin.', '2026-11-17 21:13:20'),
(16, 6, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-18 02:34:14'),
(17, 6, 2, 'menunggu', 'diproses', 'Status diperbarui oleh Admin.', '2026-11-18 02:35:29'),
(18, 6, 3, 'diproses', 'selesai', 'Sampah sudah di bereskan', '2026-11-18 02:37:07'),
(19, 7, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-24 09:10:10'),
(20, 7, 2, 'menunggu', 'diproses', 'Laporan ditugaskan kepada Petugas: Petugas TrashPoint', '2026-11-24 09:11:28'),
(21, 7, 2, 'diproses', 'selesai', 'Status diperbarui oleh Admin.', '2026-11-24 09:15:54'),
(22, 7, 2, 'selesai', 'diproses', 'Status diperbarui oleh Admin.', '2026-11-24 09:19:53'),
(23, 8, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-24 09:22:27'),
(24, 7, 3, 'diproses', 'selesai', 'sudah dibersihkan', '2026-11-24 09:22:55'),
(25, 9, 4, NULL, 'menunggu', 'Laporan baru dibuat.', '2026-11-25 07:08:29'),
(26, 8, 2, 'menunggu', 'selesai', 'Status diperbarui oleh Admin.', '2026-11-25 07:09:30'),
(27, 9, 2, 'menunggu', 'diproses', 'Laporan ditugaskan kepada Petugas: Petugas TrashPoint', '2026-11-25 07:10:37'),
(28, 9, 3, 'diproses', 'selesai', 'Sudah dibersihkan', '2026-11-25 07:12:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4veP6m7tGGcBYqVpEzUuXGT2VvHKXu9Ur6a5KDSt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRE5SU0tianFSM1Y5Z0Z5QWZOR2JBY1VPWXB2bEpYT2xEUVVOMTF3ayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7czo1OiJyb3V0ZSI7czo4OiJyZWdpc3RlciI7fX0=', 1795653971),
('EzAM3dixCaoJf4i7DTSNgoeT1gSM52lKNShwbz0c', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidVpGU0dPU0NuZ3N1T0JvM2hMdjZLUVhUNWpCNFlRbk5ORUFGd2lDNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiNTY2MzUyY2Q2NjAyZGVjODM0YzZiMjEwNTMxOWMyYjlmOTYxNjc1NmRiNDdjNzg0YTUwYWM1NjU3Mzc4OGY0MiI7fQ==', 1795620705),
('rXhlGvYPHH0x6BhjiFa7HKcrAmMQMNBkBxOM1yk1', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSFR0Y2JWajZTWlNEMTVFVTNQQ3JPYnFGTmFuNjlDUnVlQU5PbTg4ayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZW5qdWFsYW4iO3M6NToicm91dGUiO3M6MjE6ImFkbWluLnBlbmp1YWxhbi5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjQ6IjliYzgwY2NkMWFlMWZmYTE3MTRiMDU4ZmMwY2I1ZjgxZjc5ZjQwMjllNTE3NTJhMDJhNjM5NGVmN2VmYTE2ZjYiO30=', 1795537573),
('vL9XZnYwBcVfe4p6CEgM52uXZsuiMLx8d2knPH1B', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/158.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiOVRQUVpFNDA5Z2JxSGhRTkZ4bG1sR3ZmNUl3QzEwVTNadFhDaGNpNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1795653807);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','masyarakat','petugas') NOT NULL DEFAULT 'masyarakat',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nauverio alfathir', 'nauverioalfathir@gmail.com', NULL, '$2y$12$tANHePqKU2CIC2HKqiVYhezy13gFnJ6l4ZF4oQLRxOxUaAgPHwSOW', 'masyarakat', NULL, '2026-11-15 02:59:09', '2026-11-25 07:15:20'),
(2, 'Admin TrashPoint', 'admin@trashpoint.test', NULL, '$2y$12$NXaxnp8rgkfGRzPhZssuJ.k3ozu9DC7fsY1JBwtKdPy3XdjwpS9cG', 'admin', NULL, '2026-11-15 03:40:56', '2026-11-15 03:40:56'),
(3, 'Petugas TrashPoint', 'petugas@trashpoint.test', NULL, '$2y$12$BQpt3PiRxwcY4j.dw8wPXON0JEyVQ0TkeYg9960b9TyIgKg/aHZwG', 'petugas', NULL, '2026-11-15 03:41:08', '2026-11-15 03:41:08'),
(4, 'danawikara', 'danawikara@gmail.com', NULL, '$2y$12$fvJ73AIZ1Pgc05GP3TQnde1yAO5NJswJA8OQYC98gXNh.MuAApOQm', 'masyarakat', NULL, '2026-11-16 23:35:00', '2026-11-18 03:02:16'),
(5, 'hiu', 'hiu@gmail.com', NULL, '$2y$12$0DEnWar2.d0mrSYRRmlteuxPxy13Hn6XUyw9gsF5t64WUZGfiCbXK', 'masyarakat', NULL, '2026-11-18 03:11:23', '2026-11-18 03:11:23');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bukti_penanganan`
--
ALTER TABLE `bukti_penanganan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bukti_laporan` (`laporan_id`),
  ADD KEY `fk_bukti_petugas` (`petugas_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_laporan_user` (`user_id`),
  ADD KEY `fk_laporan_kategori` (`kategori_sampah_id`),
  ADD KEY `fk_laporan_lokasi` (`lokasi_laporan_id`),
  ADD KEY `idx_laporan_status` (`status`),
  ADD KEY `idx_laporan_tanggal` (`created_at`);

--
-- Indeks untuk tabel `lokasi_laporan`
--
ALTER TABLE `lokasi_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `penjualan_sampah`
--
ALTER TABLE `penjualan_sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penjualan_admin` (`created_by`),
  ADD KEY `idx_penjualan_tanggal` (`tanggal`);

--
-- Indeks untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penugasan_laporan` (`laporan_id`),
  ADD KEY `fk_penugasan_admin` (`admin_id`),
  ADD KEY `idx_penugasan_petugas` (`petugas_id`);

--
-- Indeks untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_riwayat_user` (`user_id`),
  ADD KEY `idx_riwayat_laporan` (`laporan_id`,`created_at`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bukti_penanganan`
--
ALTER TABLE `bukti_penanganan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_sampah`
--
ALTER TABLE `kategori_sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lokasi_laporan`
--
ALTER TABLE `lokasi_laporan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penjualan_sampah`
--
ALTER TABLE `penjualan_sampah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bukti_penanganan`
--
ALTER TABLE `bukti_penanganan`
  ADD CONSTRAINT `fk_bukti_laporan` FOREIGN KEY (`laporan_id`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bukti_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_kategori` FOREIGN KEY (`kategori_sampah_id`) REFERENCES `kategori_sampah` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_laporan_lokasi` FOREIGN KEY (`lokasi_laporan_id`) REFERENCES `lokasi_laporan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_sampah`
--
ALTER TABLE `penjualan_sampah`
  ADD CONSTRAINT `fk_penjualan_admin` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penugasan`
--
ALTER TABLE `penugasan`
  ADD CONSTRAINT `fk_penugasan_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penugasan_laporan` FOREIGN KEY (`laporan_id`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penugasan_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `riwayat_status`
--
ALTER TABLE `riwayat_status`
  ADD CONSTRAINT `fk_riwayat_laporan` FOREIGN KEY (`laporan_id`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_riwayat_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
