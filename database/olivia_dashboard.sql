-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2025 at 11:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olivia_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita_pengumuman`
--

CREATE TABLE `berita_pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `writer` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berkas_lomba`
--

CREATE TABLE `berkas_lomba` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tim` bigint(20) UNSIGNED NOT NULL,
  `pengesahan` varchar(255) NOT NULL,
  `orisinalitas` varchar(255) NOT NULL,
  `biodata` varchar(255) NOT NULL,
  `form_pendaftaran` varchar(255) NOT NULL,
  `url_file` varchar(255) NOT NULL,
  `status_verifikasi` enum('pending','valid','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berkas_lomba`
--

INSERT INTO `berkas_lomba` (`id`, `id_tim`, `pengesahan`, `orisinalitas`, `biodata`, `form_pendaftaran`, `url_file`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(7, 10, 'berkas_lomba/rGG5Vw2hZYpLoeYKGWynjYkP3h6XheJYVuxZGJSv.pdf', 'berkas_lomba/ce65fLG5Ax55Qmg8UmY0MXegdUBTzQmOgxcUUyyK.pdf', 'berkas_lomba/5jL5nHwMf2WxKJrMzTECsG1VDzy0gDriT3IqiQ08.pdf', 'berkas_lomba/dZZ4gf3Jxs3f020S1CgScvbvq5xhnZwXfgsuxWLI.pdf', 'https://chatgpt.com/g/g-p-67d582cc53c48191b7c818ded680d765-web/', 'valid', '2025-03-21 12:34:08', '2025-03-21 12:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_admin@gmail.com|127.0.0.1', 'i:1;', 1742401557),
('laravel_cache_admin@gmail.com|127.0.0.1:timer', 'i:1742401557;', 1742401557),
('laravel_cache_admin@gmail.comn|127.0.0.1', 'i:1;', 1742587348),
('laravel_cache_admin@gmail.comn|127.0.0.1:timer', 'i:1742587348;', 1742587348);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detil_peserta`
--

CREATE TABLE `detil_peserta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `id_tim` bigint(20) UNSIGNED DEFAULT NULL,
  `scan_ktm` varchar(255) DEFAULT NULL,
  `no_wa` varchar(255) NOT NULL,
  `foto_anggota` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detil_peserta`
--

INSERT INTO `detil_peserta` (`id`, `nim`, `nama_lengkap`, `id_tim`, `scan_ktm`, `no_wa`, `foto_anggota`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(19, '233140700111040', 'Ardian Wahyu Nizar', 10, 'ktm/Ei8dWUxN4fVORWcc4symGWdknpHxwmNEsqLVgGnQ.jpg', '081999999993', 'anggota/9Cm2HS8gxBIgzM0XA842RH1ciNibt1yC3eYXCwMX.png', 'pending', '2025-03-21 12:25:07', '2025-03-21 12:26:21'),
(20, '233140700111041', 'naim plung', 10, 'ktm/0v50A5BgLWPN3lUtBPP4HPaD5IcEqBn8nCw8EtNG.jpg', '081999999933', 'anggota/qrXbzD9wwdEUCYZXwy5LVuBfet2SK5i3Q7Ws1Vm3.jpg', 'pending', '2025-03-21 12:27:47', '2025-03-21 12:27:47'),
(21, '233140700111141', 'naim 2', 10, 'ktm/OyvBsIMt6qTMx4TUMH4Cjsqw6uDU9QTA5luusdOs.jpg', '081999999913', 'anggota/GHwqHo2V4opZZvjwF9STcXW0cgFnwgqEQhz2VYOn.jpg', 'pending', '2025-03-21 12:28:29', '2025-03-21 12:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `kategori_lomba`
--

CREATE TABLE `kategori_lomba` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `jumlah_anggota_maksimal` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_lomba`
--

INSERT INTO `kategori_lomba` (`id`, `nama_kategori`, `jumlah_anggota_maksimal`, `created_at`, `updated_at`) VALUES
(1, 'Karya Tulis Ilmiah', 3, NULL, NULL),
(2, 'Business Plan', 3, NULL, NULL),
(3, 'Live Cooking', 2, NULL, NULL),
(4, 'Piranti Cerdas', 5, NULL, NULL),
(5, 'Cyber Security', 3, '2025-03-21 12:42:21', '2025-03-21 12:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2025_03_05_145811_create_tim_lomba_table', 1),
(11, '2025_03_05_145812_create_berkas_lomba_table', 1),
(12, '2025_03_05_145812_create_detil_peserta_table', 1),
(13, '2025_03_05_150048_create_berita_pengumuman_table', 1),
(14, '2025_03_07_100024_remove_two_factor_from_users', 2),
(15, '2025_03_07_100148_update_users_default_role_status', 3),
(16, '2025_03_09_191711_update_tables_for_verification_and_pembayaran', 4),
(17, '2025_03_12_152208_remove_cabang_lomba_from_tim_lomba', 5),
(18, '2025_03_12_154731_create_departemen_lomba_table', 5),
(19, '2025_03_12_154859_create_kategori_lomba_table', 5),
(20, '2025_03_12_154952_add_kategori_id_to_tim_lomba', 5),
(21, '2025_03_12_161936_remove_foreign_key_from_kategori_lomba', 6),
(22, '2025_03_12_162819_add_jumlah_anggota_to_kategori_lomba', 6),
(23, '2025_03_13_161800_drop_departemen_lomba_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_lomba`
--

CREATE TABLE `pembayaran_lomba` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tim` bigint(20) UNSIGNED NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status_verifikasi` enum('pending','valid','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran_lomba`
--

INSERT INTO `pembayaran_lomba` (`id`, `id_tim`, `bukti_pembayaran`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(7, 10, 'bukti_pembayaran/Q36R6cJ7vchPoaZ95EqIKYL3u4Qzt7Y3pTOMGxcO.jpg', 'valid', '2025-03-21 12:28:46', '2025-03-21 12:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('YgErVsbpJhqOxyVvYt9oa9nNNiQFlJlz53HPaesw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakNVVnF4bkNpc0xNNVdnOE9MS3B5a1JteDhUN3JjU21QYmV3ZDhIeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1742587288),
('Yt0RlSjqNTjOg8uy7fsxWJm8CWZLyQPLHIQYlSR4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemtUTVBCZm0xNnlvTEtLZjVtOGtKMGUxTmVLWENFanIzbURqaDRLaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1742586862);

-- --------------------------------------------------------

--
-- Table structure for table `tim_lomba`
--

CREATE TABLE `tim_lomba` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_tim` varchar(255) NOT NULL,
  `nama_kampus` varchar(255) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED DEFAULT NULL,
  `foto_tim` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `status_final_submit` tinyint(1) NOT NULL DEFAULT 0,
  `id_ketua` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tim_lomba`
--

INSERT INTO `tim_lomba` (`id`, `nama_tim`, `nama_kampus`, `kategori_id`, `foto_tim`, `status_verifikasi`, `status_final_submit`, `id_ketua`, `created_at`, `updated_at`) VALUES
(10, 'Team Bangan', 'Universitas Blitar', 2, 'tim_foto/z6gsDFhL1dMQLwGJHgusY31XiTLpR55n8EKZbDT1.jpg', 'pending', 1, 12, '2025-03-21 12:26:21', '2025-03-21 12:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` bigint(20) DEFAULT NULL,
  `no_wa` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'ketua_tim',
  `status` enum('register','active') NOT NULL DEFAULT 'register',
  `profile` varchar(250) DEFAULT NULL,
  `ktm` varchar(250) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `no_wa`, `name`, `email`, `role`, `status`, `profile`, `ktm`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, NULL, NULL, 'Admin', 'admin@example.com', 'admin', 'active', NULL, NULL, NULL, '$2y$12$5AyC./LTHZAplziKQBzt2uieV0lMcctYFWXAT6lr.Lk7mCoUfW2FS', 'uk5sPYjsw0F72FEfEJKUK6064sbdguCS0kQobqGi8A6zq0eh4KCxipUNJL5O', '2025-03-10 11:55:28', '2025-03-10 11:55:28'),
(12, 233140700111040, '081999999993', 'Ardian Wahyu Nizar', 'ardianwahyunizar614@gmail.com', 'ketua_tim', 'active', 'profile/9Cm2HS8gxBIgzM0XA842RH1ciNibt1yC3eYXCwMX.png', 'ktm/Ei8dWUxN4fVORWcc4symGWdknpHxwmNEsqLVgGnQ.jpg', NULL, '$2y$12$SrTYIEfOuwrj9cr9uLHLQOxfdbeBBDXtpGbJGoijoR2eiaO/CrUzO', 'Mtsds64YWNrVRotgcsGAFkbqvd1zpW5nweVmLVetMs9iiMMjOSYn9QuxUxmY', '2025-03-21 12:22:43', '2025-03-21 12:25:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita_pengumuman`
--
ALTER TABLE `berita_pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_pengumuman_writer_foreign` (`writer`);

--
-- Indexes for table `berkas_lomba`
--
ALTER TABLE `berkas_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berkas_lomba_id_tim_foreign` (`id_tim`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detil_peserta`
--
ALTER TABLE `detil_peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `detil_peserta_nim_unique` (`nim`),
  ADD KEY `detil_peserta_id_tim_foreign` (`id_tim`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_lomba`
--
ALTER TABLE `kategori_lomba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembayaran_lomba`
--
ALTER TABLE `pembayaran_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_lomba_id_tim_foreign` (`id_tim`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tim_lomba`
--
ALTER TABLE `tim_lomba`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tim_lomba_id_ketua_foreign` (`id_ketua`),
  ADD KEY `tim_lomba_kategori_id_foreign` (`kategori_id`);

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
-- AUTO_INCREMENT for table `berita_pengumuman`
--
ALTER TABLE `berita_pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berkas_lomba`
--
ALTER TABLE `berkas_lomba`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detil_peserta`
--
ALTER TABLE `detil_peserta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_lomba`
--
ALTER TABLE `kategori_lomba`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pembayaran_lomba`
--
ALTER TABLE `pembayaran_lomba`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tim_lomba`
--
ALTER TABLE `tim_lomba`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita_pengumuman`
--
ALTER TABLE `berita_pengumuman`
  ADD CONSTRAINT `berita_pengumuman_writer_foreign` FOREIGN KEY (`writer`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berkas_lomba`
--
ALTER TABLE `berkas_lomba`
  ADD CONSTRAINT `berkas_lomba_id_tim_foreign` FOREIGN KEY (`id_tim`) REFERENCES `tim_lomba` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detil_peserta`
--
ALTER TABLE `detil_peserta`
  ADD CONSTRAINT `detil_peserta_id_tim_foreign` FOREIGN KEY (`id_tim`) REFERENCES `tim_lomba` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_lomba`
--
ALTER TABLE `pembayaran_lomba`
  ADD CONSTRAINT `pembayaran_lomba_id_tim_foreign` FOREIGN KEY (`id_tim`) REFERENCES `tim_lomba` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tim_lomba`
--
ALTER TABLE `tim_lomba`
  ADD CONSTRAINT `tim_lomba_id_ketua_foreign` FOREIGN KEY (`id_ketua`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tim_lomba_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_lomba` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
