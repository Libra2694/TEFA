-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 11:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`id`, `user_id`, `nidn`, `kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `prodi`, `jabatan`, `pangkat`, `created_at`, `updated_at`) VALUES
(3, 8, '1234567', 'laki-laki', 'Jambi', '2005-01-01', 'adasda', '01982376', 'Teknologi Rekayasa Perangkat Lunak', 'Dosen', 'Dosen Tetap', '2024-08-09 03:46:06', '2024-08-09 03:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhirs`
--

CREATE TABLE `laporan_akhirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `laporan_kemajuan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_akhirs`
--

INSERT INTO `laporan_akhirs` (`id`, `user_id`, `laporan_kemajuan_id`, `file`, `created_at`, `updated_at`) VALUES
(7, 8, '5', 'laporan_akhir_files/1723363652_Tefa.pdf', '2024-08-11 01:07:32', '2024-08-11 01:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kemajuans`
--

CREATE TABLE `laporan_kemajuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id_proposal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_upload` date NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_kemajuans`
--

INSERT INTO `laporan_kemajuans` (`id`, `user_id`, `id_proposal`, `tanggal_upload`, `file`, `created_at`, `updated_at`) VALUES
(5, 8, '21', '2024-08-10', 'laporan_kemajuans/1723302009_Tefa.pdf', '2024-08-10 08:00:09', '2024-08-10 08:00:09');

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `laporan_akhirs_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kegiatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logbooks`
--

INSERT INTO `logbooks` (`id`, `user_id`, `laporan_akhirs_id`, `tanggal`, `kegiatan`, `created_at`, `updated_at`) VALUES
(6, 8, 7, '2024-08-11', 'Memasaks', '2024-08-11 01:42:37', '2024-08-11 01:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_proposal` enum('penelitian kualitatif','penelitian pengembangan','pengabdian masyarakat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('penelitian','pengabdian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year(4) NOT NULL,
  `biaya` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jangka_waktu` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_biaya` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `user_id`, `judul`, `jenis_proposal`, `jenis`, `tahun`, `biaya`, `jangka_waktu`, `sumber_biaya`, `anggota`, `file`, `created_at`, `updated_at`) VALUES
(21, 8, 'Testing Proposal', 'pengabdian masyarakat', 'penelitian', 2024, '100.000', '4 Hari', 'LLDIKTI', 'Rezagi Meilano, Tanto, Badarusman', 'proposals/Tefa.pdf', '2024-08-10 07:30:54', '2024-08-11 00:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) NOT NULL,
  `kategori_template` varchar(100) NOT NULL,
  `jenis_template` varchar(100) NOT NULL,
  `tipe_template` varchar(100) NOT NULL,
  `path_template` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `kategori_template`, `jenis_template`, `tipe_template`, `path_template`, `created_at`, `updated_at`) VALUES
(1, 'proposal', 'pengabdian', 'panduan', NULL, NULL, '2024-08-10 03:47:54'),
(2, 'proposal', 'pengabdian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
(3, 'proposal', 'penelitian', 'panduan', NULL, NULL, '2024-08-10 15:26:25'),
(4, 'proposal', 'penelitian', 'template', NULL, NULL, '2024-08-10 03:47:54'),
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Admin', 'admin@gmail.com', NULL, '$2y$10$PcCuJsI5qC7TtQ347yZG8uMinhTIFCdUdSXKpiY0eOMcondwXG9rS', 'admin', NULL, '2024-08-08 08:48:04', NULL),
(8, 'Rezagi', 'rezagi@gmail.com', NULL, '$2y$10$JVyezGpBThUq1yQGWxrLdeLa5iVOe/DvzI5wxLLTMCTVUdt0H/znm', 'user', NULL, '2024-08-09 03:46:06', '2024-08-09 03:46:06'),
(9, 'Tanto', 'tanto@gmail.com', NULL, '$2y$10$28gWRhtTGEEPHlNqVm6Gt.kSsdletzVj6BTldFBZCMTn8sG6xJvX6', 'user', NULL, '2024-08-11 00:25:29', '2024-08-11 00:25:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosens_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_kemajuans_dosen_id_foreign` (`user_id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `laporan_akhirs_id` (`laporan_akhirs_id`),
  ADD KEY `logbooks_dosen_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposals_dosen_id_foreign` (`user_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosens`
--
ALTER TABLE `dosens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_akhirs`
--
ALTER TABLE `laporan_akhirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_kemajuans`
--
ALTER TABLE `laporan_kemajuans`
  ADD CONSTRAINT `laporan_kemajuans_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD CONSTRAINT `laporan_akhirs` FOREIGN KEY (`laporan_akhirs_id`) REFERENCES `laporan_akhirs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `logbooks_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_dosen_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
