-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2025 at 06:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualans`
--

CREATE TABLE `detail_penjualans` (
  `id` bigint UNSIGNED NOT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `total_harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_penjualans`
--

INSERT INTO `detail_penjualans` (`id`, `no_nota`, `nama_produk`, `barcode`, `harga`, `jumlah`, `total_harga`, `created_at`, `updated_at`) VALUES
(14, 'INV-250314_825', 'aliquid', '6645054046556', 9658, 1, 9658, '2025-03-14 03:43:24', '2025-03-14 03:43:24'),
(29, 'INV-250318_517', 'rerum', '3337590432506', 30046, 1, 30046, '2025-03-18 04:01:00', '2025-03-18 04:01:00'),
(30, 'INV-250318_517', 'est', '9890033231752', 37690, 1, 37690, '2025-03-18 04:01:00', '2025-03-18 04:01:00'),
(35, 'INV-250318_989', 'aliquid', '6645054046556', 9658, 1, 9658, '2025-03-18 05:01:20', '2025-03-18 05:01:20'),
(40, 'INV-250318_245', 'voluptas', '8974004826893', 47619, 1, 47619, '2025-03-18 06:14:17', '2025-03-18 06:14:17'),
(41, 'INV-250319_584', 'ut', '8530736567284', 34313, 2, 68626, '2025-03-19 14:48:11', '2025-03-19 14:48:11'),
(46, 'INV-250612_610', 'sit', '2571582097958', 8241, 1, 8241, '2025-06-12 01:24:30', '2025-06-12 01:24:30'),
(47, 'INV-250612_610', 'rerum', '3337590432506', 30046, 1, 30046, '2025-06-12 01:24:30', '2025-06-12 01:24:30'),
(48, 'INV-250612_610', 'repudiandae', '8266561728285', 44937, 1, 44937, '2025-06-12 01:24:30', '2025-06-12 01:24:30'),
(49, 'INV-250612_774', 'voluptas', '8974004826893', 47619, 1, 47619, '2025-06-12 01:48:50', '2025-06-12 01:48:50'),
(50, 'INV-250612_774', 'molestiae', '1254347970666', 31919, 1, 31919, '2025-06-12 01:48:50', '2025-06-12 01:48:50'),
(51, 'INV-250612_774', 'commodi', '7963304991302', 30556, 1, 30556, '2025-06-12 01:48:50', '2025-06-12 01:48:50'),
(52, 'INV-250614_692', 'est', '9890033231752', 37690, 1, 37690, '2025-06-14 08:25:50', '2025-06-14 08:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'aperiam', '2025-03-10 07:30:25', '2025-03-10 07:30:25'),
(2, 'facilis', '2025-03-10 07:30:32', '2025-03-10 07:30:32'),
(3, 'aliquam', '2025-03-10 07:30:32', '2025-03-10 07:30:32'),
(4, 'sed', '2025-03-10 07:30:32', '2025-03-10 07:30:32'),
(6, 'mollitia', '2025-03-10 07:30:40', '2025-03-10 07:30:40'),
(7, 'qui', '2025-03-10 07:30:40', '2025-03-10 07:30:40'),
(8, 'atque', '2025-03-10 07:30:40', '2025-03-10 07:30:40'),
(9, 'aut', '2025-03-10 07:30:40', '2025-03-10 07:30:40'),
(10, 'non', '2025-03-10 07:30:40', '2025-03-10 07:30:40'),
(11, 'iusto', '2025-03-10 07:30:44', '2025-03-10 07:30:44'),
(12, 'rem', '2025-03-10 07:30:44', '2025-03-10 07:30:44'),
(13, 'molestiae', '2025-03-10 07:30:44', '2025-03-10 07:30:44'),
(14, 'accusamus', '2025-03-10 07:30:44', '2025-03-10 07:30:44'),
(15, 'similique', '2025-03-10 07:30:44', '2025-03-10 07:30:44'),
(16, 'tempore', '2025-03-10 07:30:45', '2025-03-10 07:30:45'),
(17, 'distinctio', '2025-03-10 07:30:45', '2025-03-10 07:30:45'),
(19, 'occaecati', '2025-03-10 07:30:53', '2025-03-10 07:30:53'),
(20, 'ab', '2025-03-10 07:30:53', '2025-03-10 07:30:53'),
(21, 'quia', '2025-03-10 07:30:55', '2025-03-10 07:30:55'),
(22, 'animi', '2025-03-10 07:30:55', '2025-03-10 07:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_01_14_142957_users', 1),
(4, '2025_01_25_143023_kategori', 1),
(5, '2025_01_26_155458_produks', 1),
(6, '2025_01_27_151030_transaksi', 1),
(7, '2025_02_07_034720_create_temp_penjualans_table', 1),
(8, '2025_02_08_152721_create_detail_penjualans_table', 1),
(9, '2025_02_20_065805_create_suppliers_table', 1),
(10, '2025_02_23_110913_create_pembelians_table', 1),
(11, '2025_03_06_132746_create_pengeluarans_table', 1),
(12, '2025_03_10_141907_create_profil_toko_controllers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id_pembelian` bigint UNSIGNED NOT NULL,
  `no_pembelian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluarans`
--

CREATE TABLE `pengeluarans` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `total_pengeluaran` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengeluarans`
--

INSERT INTO `pengeluarans` (`id`, `tanggal`, `kategori`, `deskripsi`, `total_pengeluaran`, `created_at`, `updated_at`) VALUES
(1, '2025-03-11', 'Pengeluaran Gaji & Karyawan', 'gaji karyawan', 100000, '2025-03-11 04:51:32', '2025-03-11 04:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produks`
--

INSERT INTO `produks` (`id`, `nama_produk`, `barcode`, `id_kategori`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 'voluptates1', '60713200092131', 1, 1058, 0, '2025-03-10 07:32:33', '2025-03-18 04:09:54'),
(2, 'rerum', '3337590432506', 13, 30046, 75, '2025-03-10 07:32:33', '2025-06-12 01:24:30'),
(3, 'aliquid', '6645054046556', 15, 9658, 30, '2025-03-10 07:32:33', '2025-03-18 05:01:20'),
(4, 'voluptas', '8974004826893', 12, 47619, 91, '2025-03-10 07:32:33', '2025-06-12 01:48:50'),
(5, 'et', '4267365464366', 1, 11156, 27, '2025-03-10 07:32:33', '2025-03-10 07:32:33'),
(6, 'repellat', '9575210061154', 4, 33318, 94, '2025-03-10 07:32:33', '2025-03-10 07:32:33'),
(7, 'sit', '2571582097958', 10, 8241, 76, '2025-03-10 07:32:33', '2025-09-03 07:03:58'),
(9, 'enim', '5603556477675', 10, 26247, 22, '2025-03-10 07:32:39', '2025-03-10 07:32:39'),
(10, 'repudiandae', '8266561728285', 14, 44937, 25, '2025-03-10 07:32:39', '2025-09-03 07:03:58'),
(12, 'ratione', '2499939733550', 14, 7100, 48, '2025-03-10 07:32:46', '2025-03-10 07:32:46'),
(13, 'dignissimos', '3586944717602', 6, 25484, 41, '2025-03-10 07:32:49', '2025-03-10 07:32:49'),
(14, 'debitis', '5534290192695', 9, 11741, 24, '2025-03-10 07:32:51', '2025-03-10 07:32:51'),
(15, 'commodi', '7963304991302', 10, 30556, 35, '2025-03-10 07:32:51', '2025-06-12 01:48:50'),
(16, 'deserunt', '0247161403862', 1, 18754, 85, '2025-03-10 07:32:52', '2025-03-10 07:32:52'),
(17, 'voluptate', '4896981295216', 3, 5925, 27, '2025-03-10 07:32:53', '2025-03-19 14:26:00'),
(18, 'consectetur', '0484923911528', 11, 26181, 72, '2025-03-10 07:32:53', '2025-03-10 07:32:53'),
(19, 'illo', '1666120132084', 13, 5125, 35, '2025-03-10 07:32:54', '2025-03-10 07:32:54'),
(21, 'iure', '9675985170676', 4, 17600, 28, '2025-03-10 07:32:55', '2025-03-10 07:32:55'),
(22, 'molestiae', '1254347970666', 4, 31919, 57, '2025-03-10 07:32:56', '2025-06-12 01:48:50'),
(23, 'est', '9890033231752', 8, 37690, 22, '2025-03-10 07:32:56', '2025-06-14 08:25:50'),
(24, 'illum', '2150252832725', 7, 49329, 91, '2025-03-10 07:32:57', '2025-03-19 15:14:19'),
(25, 'ut', '8530736567284', 6, 34313, 65, '2025-03-10 07:32:57', '2025-03-19 14:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `profil_toko_controllers`
--

CREATE TABLE `profil_toko_controllers` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_operasional` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tiktok` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profil_toko_controllers`
--

INSERT INTO `profil_toko_controllers` (`id`, `nama_toko`, `alamat`, `no_telp`, `email`, `logo`, `jam_operasional`, `instagram`, `facebook`, `tiktok`, `created_at`, `updated_at`) VALUES
(100, 'Ravira Mart', 'Tawangmangu Karanganyar', '0831498867072', 'midone07@gmail.com', '1741755350.png', '06:00 - 20:30', 'ig', 'fb', 'tk', '2025-03-12 02:32:55', '2025-03-13 14:11:18');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'nabati', '12345678912', '2025-03-18 03:44:29', '2025-03-18 03:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `temp_penjualans`
--

CREATE TABLE `temp_penjualans` (
  `id` bigint UNSIGNED NOT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksies`
--

CREATE TABLE `transaksies` (
  `id` bigint UNSIGNED NOT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('berhasil','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int NOT NULL,
  `bayar` int NOT NULL,
  `nama_kasir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksies`
--

INSERT INTO `transaksies` (`id`, `no_nota`, `status`, `tanggal`, `total_harga`, `bayar`, `nama_kasir`, `created_at`, `updated_at`) VALUES
(9, 'INV-250314_825', 'berhasil', '2025-03-14', 9658, 10000, 'aku', '2025-03-14 03:43:24', '2025-03-14 03:43:24'),
(17, 'INV-250318_045', 'dibatalkan', '2025-03-18', 0, 120000, 'aku', '2025-03-18 03:56:09', '2025-03-19 14:26:00'),
(18, 'INV-250318_517', 'berhasil', '2025-03-18', 67736, 80000, 'saya2', '2025-03-18 04:01:00', '2025-03-18 04:01:00'),
(20, 'INV-250318_057', 'dibatalkan', '2025-03-18', 0, 2000, 'saya2', '2025-03-18 04:05:14', '2025-03-18 04:05:20'),
(22, 'INV-250318_989', 'berhasil', '2025-03-18', 9658, 10000, 'saya2', '2025-03-18 05:01:20', '2025-03-18 05:01:20'),
(26, 'INV-250318_245', 'berhasil', '2025-03-18', 47619, 50000, 'saya1', '2025-03-18 06:14:17', '2025-03-18 06:14:17'),
(27, 'INV-250319_584', 'berhasil', '2025-03-19', 68626, 70000, 'aku', '2025-03-19 14:48:11', '2025-03-19 14:48:11'),
(28, 'INV-250319_071', 'dibatalkan', '2025-03-19', 0, 50000, 'aku', '2025-03-19 14:49:16', '2025-03-19 15:14:19'),
(30, 'INV-250612_610', 'berhasil', '2025-06-12', 83224, 100000, 'zhuxin', '2025-06-12 01:24:29', '2025-06-12 01:24:29'),
(31, 'INV-250612_774', 'berhasil', '2025-06-12', 110094, 200000, 'zhuxin', '2025-06-12 01:48:50', '2025-06-12 01:48:50'),
(32, 'INV-250614_692', 'berhasil', '2025-06-14', 37690, 50000, 'zhuxin', '2025-06-14 08:25:50', '2025-06-14 08:25:50'),
(33, 'INV-250903_166', 'dibatalkan', '2025-09-03', 0, 100000, 'zhuxin', '2025-09-03 07:03:40', '2025-09-03 07:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('manager','admin','kasir') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kasir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `password`, `email`, `no_telp`, `role`, `created_at`, `updated_at`) VALUES
(2, 'saya', '$2y$12$ELaRUlbnMvsb7LmyAtqNq.d4Q/ggIW7zSnCrChNzmoMkvraExzPd.', 'mtawang07@gmail.com', '0987654321', 'admin', '2025-03-02 23:01:10', '2025-03-02 23:01:10'),
(8, 'dia', '$2y$12$sWYBqTiftLIcmHNySzKydeBD8.DSbNzDe43XS22Y9DIuV3cw3yJpe', 'xpander@gmail.com', '12340987654321', 'manager', '2025-03-18 03:06:43', '2025-03-18 03:06:43'),
(9, 'saya1', '$2y$12$pwIaCgnQqcZnOqhIEAPAuOrvsK/CalEwppQq5Qssfz8XAA78YfAs2', 'tw@gmail.com', '887655443322', 'kasir', '2025-03-18 03:58:48', '2025-03-18 03:58:48'),
(10, 'saya2', '$2y$12$7.DjLPwW6Oo7ISvnQeWv1ujJt5l4ZtlZLSj/SFUdBC5xDfUoBIOvK', 'mtawang02@gmail.com', '11223445667788', 'kasir', '2025-03-18 03:59:41', '2025-03-18 03:59:41'),
(11, 'zhuxin', '$2y$12$dRR9t74EGIRxLaF0EdkgcObxgB7I/sHGxheCFpHIffuU4O1vb34Te', 'zhuxin@gmail.com', '05478192874', 'kasir', '2025-06-12 01:19:50', '2025-06-12 01:19:50'),
(12, 'xpander', '$2y$12$XsQOw20IRoTciw9pua01NeJ7sWLQ0ZO/nReLCevbhz7wYvAWmIoK.', 'mobil@gmail.com', '0831234567', 'manager', '2025-06-17 19:18:35', '2025-06-17 19:18:35');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `detail_penjualans`
--
ALTER TABLE `detail_penjualans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategoris_kategori_unique` (`kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produks_nama_produk_unique` (`nama_produk`),
  ADD UNIQUE KEY `produks_barcode_unique` (`barcode`),
  ADD KEY `produks_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `profil_toko_controllers`
--
ALTER TABLE `profil_toko_controllers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_supplier_unique` (`supplier`),
  ADD UNIQUE KEY `suppliers_no_telp_unique` (`no_telp`);

--
-- Indexes for table `temp_penjualans`
--
ALTER TABLE `temp_penjualans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksies`
--
ALTER TABLE `transaksies`
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
-- AUTO_INCREMENT for table `detail_penjualans`
--
ALTER TABLE `detail_penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id_pembelian` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengeluarans`
--
ALTER TABLE `pengeluarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `profil_toko_controllers`
--
ALTER TABLE `profil_toko_controllers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_penjualans`
--
ALTER TABLE `temp_penjualans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transaksies`
--
ALTER TABLE `transaksies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
