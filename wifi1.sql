-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2024 pada 15.03
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
-- Database: `wifi1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `area`
--

CREATE TABLE `area` (
  `area_id` int(10) NOT NULL,
  `kode_area` varchar(255) NOT NULL,
  `nama_area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `area`
--

INSERT INTO `area` (`area_id`, `kode_area`, `nama_area`) VALUES
(1, 'SUMBE', 'SLOROK'),
(2, 'JENGG', 'TALUN'),
(3, 'CTMP', 'TRITIH'),
(4, 'SUMBS', 'SUMBERSARI'),
(5, 'CBK', 'BENDELONJE'),
(6, 'BANGG', 'BANGGLE'),
(7, 'CP', 'PAKEL'),
(8, 'CTLG', 'TLOGO'),
(9, 'CM', 'SEMANDING'),
(10, 'CSTY', 'SATREYAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(6) NOT NULL,
  `nama_cust` varchar(30) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `kode_cust` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kd_area` int(10) NOT NULL,
  `tgl_pemasangan` date NOT NULL,
  `paket_wifi` int(2) NOT NULL,
  `biaya_pemasangan` int(9) NOT NULL,
  `status` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`cust_id`, `nama_cust`, `ip`, `kode_cust`, `no_telp`, `alamat`, `kd_area`, `tgl_pemasangan`, `paket_wifi`, `biaya_pemasangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'anne', '345.436.576.568', 'JENGG_0001', '855642', 'blitar', 2, '2021-06-18', 0, 35456, 1, '2024-11-16 12:47:33', '2024-01-10 03:05:22'),
(2, 'wisnu', '232.020.132.222', 'CTMP_0001', '0899', 'gedok', 3, '2021-06-18', 1, 2453, 1, '2024-11-16 12:47:37', '2024-01-10 03:25:43');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_10_071303_create_area', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `paket_id` int(2) NOT NULL,
  `bandwidth` varchar(10) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`paket_id`, `bandwidth`, `harga`) VALUES
(0, '1 MB', 100000),
(1, '3 MB', 150000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `bayar_id` int(10) NOT NULL,
  `cust_id` int(6) NOT NULL,
  `user_id` int(20) NOT NULL,
  `tgl_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `jumlah_bayar` int(15) NOT NULL,
  `bulan_terbayar` date NOT NULL,
  `metode_bayar` varchar(10) NOT NULL,
  `ket` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`bayar_id`, `cust_id`, `user_id`, `tgl_pembayaran`, `jumlah_bayar`, `bulan_terbayar`, `metode_bayar`, `ket`) VALUES
(2, 1, 8, '2024-11-15 17:00:00', 200000, '2024-11-16', 'Tunai', 'Cash'),
(3, 2, 8, '2024-11-15 17:00:00', 150000, '2024-11-16', 'Transfer', 'BRI');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `noHp` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nama`, `alamat`, `email`, `noHp`, `username`, `password`, `jabatan`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '1234567890', 'admin', 'admin', 'admin', NULL, NULL),
(2, 'John Doe', 'John Doe', 'doe@gmail.com', '1234567890', 'owner', '12345', 'owner', NULL, NULL),
(3, 'John Doeds', 'John Doeks', 'john@gmail.com', '123456978m', 'peg1', '12345s', 'pegawai', NULL, '2024-01-09 21:53:26'),
(8, 'anne rufaedah', 'blitar', 'a@m.n', '9450', 'anne', 'anne', 'pegawai', '2024-01-08 08:09:11', '2024-01-08 08:09:11'),
(11, 'davidm', 'talun', 'david@d.g', '09832', 'david', 'david', 'pegawai', '2024-01-08 08:15:06', '2024-01-09 09:55:04'),
(12, 'w', 'w', 'w@we.d', '234', 'www', 'www', 'pegawai', '2024-01-09 10:05:02', '2024-01-09 10:05:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`),
  ADD UNIQUE KEY `area_kode_area_unique` (`kode_area`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `paket_wifi` (`paket_wifi`),
  ADD KEY `kode_area` (`kd_area`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`bayar_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `area`
--
ALTER TABLE `area`
  MODIFY `area_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `bayar_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`paket_wifi`) REFERENCES `paket` (`paket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`kd_area`) REFERENCES `area` (`area_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
