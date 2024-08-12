-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2024 pada 08.23
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tefa2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(255) NOT NULL,
  `kelamin` enum('laki-laki','perempuan') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `pangkat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `nidn`, `kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `prodi`, `jabatan`, `pangkat`, `created_at`, `updated_at`) VALUES
(3, 8, '1234567', 'laki-laki', 'Jambi', '2005-01-01', 'adasda', '01982376', 'Teknologi Rekayasa Perangkat Lunak', 'Dosen', 'Dosen Tetap', '2024-08-09 03:46:06', '2024-08-09 03:46:06');

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
-- Struktur dari tabel `laporan_akhirs`
--

CREATE TABLE `laporan_akhirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `laporan_kemajuan_id` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_akhirs`
--

INSERT INTO `laporan_akhirs` (`id`, `user_id`, `laporan_kemajuan_id`, `file`, `created_at`, `updated_at`) VALUES
(7, 8, '5', 'laporan_akhir_files/1723363652_Tefa.pdf', '2024-08-11 01:07:32', '2024-08-11 01:07:32'),
(8, 8, '6', 'laporan_akhir_files/1723392034_SIAP PPDB Online _ Kota Jambi.pdf', '2024-08-11 09:00:34', '2024-08-11 09:00:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kemajuans`
--

CREATE TABLE `laporan_kemajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_proposal` varchar(255) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_kemajuans`
--

INSERT INTO `laporan_kemajuans` (`id`, `user_id`, `id_proposal`, `tanggal_upload`, `file`, `created_at`, `updated_at`) VALUES
(5, 8, '21', '2024-08-10', 'laporan_kemajuans/1723302009_Tefa.pdf', '2024-08-10 08:00:09', '2024-08-10 08:00:09'),
(6, 8, '22', '2024-08-11', 'laporan_kemajuans/1723391997_Manual Book - Pariwisata.docx', '2024-08-11 08:59:57', '2024-08-11 08:59:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `laporan_akhirs_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `logbooks`
--

INSERT INTO `logbooks` (`id`, `user_id`, `laporan_akhirs_id`, `tanggal`, `kegiatan`, `created_at`, `updated_at`) VALUES
(6, 8, 7, '2024-08-11', 'Memasaks', '2024-08-11 01:42:37', '2024-08-11 01:48:22'),
(7, 8, 8, '2024-08-16', 'tes', '2024-08-11 09:01:15', '2024-08-11 09:01:15');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_29_152749_create_dosens_table', 1),
(6, '2024_07_29_152804_create_proposals_table', 1),
(7, '2024_07_29_152821_create_laporan_kemajuans_table', 1),
(8, '2024_07_29_152833_create_laporan_akhirs_table', 1),
(9, '2024_07_29_152848_create_logbooks_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis_proposal` enum('penelitian kualitatif','penelitian pengembangan','pengabdian masyarakat') NOT NULL,
  `jenis` enum('penelitian','pengabdian') NOT NULL,
  `tahun` year(4) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `jangka_waktu` varchar(100) NOT NULL,
  `sumber_biaya` varchar(100) NOT NULL,
  `anggota` text NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `proposals`
--

INSERT INTO `proposals` (`id`, `user_id`, `judul`, `jenis_proposal`, `jenis`, `tahun`, `biaya`, `jangka_waktu`, `sumber_biaya`, `anggota`, `file`, `created_at`, `updated_at`) VALUES
(21, 8, 'Testing Proposal', 'pengabdian masyarakat', 'penelitian', '2024', '100.000', '4 Hari', 'LLDIKTI', 'Rezagi Meilano, Tanto, Badarusman', 'proposals/Tefa.pdf', '2024-08-10 07:30:54', '2024-08-11 00:31:20'),
(22, 8, 'proposal', 'pengabdian masyarakat', 'pengabdian', '2025', '1.000.000.000', '2 tahun', 'Kampus', 'asep, jamal, agus', 'proposals/virtualisasi di Linux Ubuntu.pdf', '2024-08-11 08:59:09', '2024-08-11 08:59:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) NOT NULL,
  `kategori_template` varchar(100) NOT NULL,
  `jenis_template` varchar(100) NOT NULL,
  `tipe_template` varchar(100) NOT NULL,
  `path_template` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `templates`
--

INSERT INTO `templates` (`id`, `kategori_template`, `jenis_template`, `tipe_template`, `path_template`, `created_at`, `updated_at`) VALUES
(1, 'proposal', 'pengabdian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(2, 'proposal', 'pengabdian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(3, 'proposal', 'penelitian', 'panduan', 'panduan_files/LAPORAN KEGIATAN.docx', NULL, '2024-08-11 18:02:24'),
(4, 'proposal', 'penelitian', 'template', 'template_files/4. format laporan kegiatan.docx', NULL, '2024-08-11 08:56:41'),
(5, 'laporan kemajuan', 'pengabdian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(6, 'laporan kemajuan', 'pengabdian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(7, 'laporan kemajuan', 'penelitian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(8, 'laporan kemajuan', 'penelitian', 'template', NULL, NULL, '2024-08-10 15:26:30'),
(9, 'laporan akhir', 'pengabdian', 'panduan', NULL, NULL, '2024-08-10 15:26:32'),
(10, 'laporan akhir', 'pengabdian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(11, 'laporan akhir', 'penelitian', 'panduan', 'panduan_files/18.04.2336_jurnal_eproc.pdf', NULL, '2024-08-11 02:02:23'),
(12, 'laporan akhir', 'penelitian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(13, 'logbook', 'pengabdian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(14, 'logbook', 'pengabdian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(15, 'logbook', 'penelitian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(16, 'logbook', 'penelitian', 'template', NULL, NULL, '2024-08-10 03:47:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Admin', 'admin@gmail.com', NULL, '$2y$10$PcCuJsI5qC7TtQ347yZG8uMinhTIFCdUdSXKpiY0eOMcondwXG9rS', 'admin', NULL, '2024-08-08 08:48:04', NULL),
(8, 'User', 'user@gmail.com', NULL, '$2y$10$hp9XG8hZJxRKwfmvVIWOR.QB0WOx3WB1x1ZwLHspSwgva/u4ajcVe', 'user', NULL, '2024-08-09 03:46:06', '2024-08-11 23:22:28'),
(9, 'User2', 'user2@gmail.com', NULL, '$2y$10$NqjAtVVB66brPa.4J3gYnOLx73DONlWR9DdfYfzVKPsdnmWQbot9.', 'user', NULL, '2024-08-11 00:25:29', '2024-08-11 23:22:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kemajuans_dosen_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporan_akhirs_id` (`laporan_akhirs_id`),
  ADD KEY `logbooks_dosen_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposals_dosen_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  ADD CONSTRAINT `laporan_kemajuans_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `laporan_akhirs` FOREIGN KEY (`laporan_akhirs_id`) REFERENCES `laporan_akhirs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logbooks_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
