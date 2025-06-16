-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2025 pada 11.29
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_checksheet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cs_changemodel`
--

CREATE TABLE `cs_changemodel` (
  `id` int(10) UNSIGNED NOT NULL,
  `area` varchar(9) NOT NULL,
  `line` int(11) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `list` int(11) DEFAULT NULL,
  `station` varchar(20) DEFAULT NULL,
  `check_item` varchar(200) DEFAULT NULL,
  `standard` varchar(50) DEFAULT NULL,
  `actual` varchar(50) DEFAULT NULL,
  `trigger` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cs_changemodel`
--

INSERT INTO `cs_changemodel` (`id`, `area`, `line`, `model`, `list`, `station`, `check_item`, `standard`, `actual`, `trigger`) VALUES
(3, 'FA', 5, 'FSST8F010849-GD0M', 3, 'ST. 5', 'Kesesuaian Applique & LCD', 'Applique R = FB', 'scan', NULL),
(4, 'FA', 5, 'FSST8F010849-GD0M', 4, 'ST. 5', 'Kesesuaian Applique & LCD', 'LCD : STD', 'scan', 'LTHB'),
(5, 'FA', 5, 'FSST8F010849-GD0M', 5, 'ST. 5', 'Pencegahan part tercampur', 'Tidak ada part tipe lain di line produksi', 'check', NULL),
(6, 'FA', 5, 'FSST8F010849-GD0M', 6, 'ST. 10', 'Work Order', 'WO-K1ZVNAMB-YJ-BRADY-2503', 'check', NULL),
(7, 'FA', 5, 'FSST8F010849-GD0M', 7, 'ST. 10', 'Program Mesin', 'VPST8F-10849-GD-1', 'check', NULL),
(8, 'FA', 5, 'FSST8F010849-GD0M', 8, 'ST. 10', 'Label barcode', 'scan barcode muncul part no = kunci \"K1ZVNAMB\"', 'scan', NULL),
(9, 'FA', 5, 'FSST8F010849-GD0M', 9, 'ST. 10', 'Label barcode', 'D1K1ZNAA', 'check', NULL),
(10, 'FA', 5, 'FSST8F010849-GD0M', 10, 'ST. 10', 'Label barcode', 'VISTEON', 'check', NULL),
(11, 'FA', 5, 'FSST8F010849-GD0M', 11, 'ST. 10', 'Label barcode', '3710-K1Z-NA11-C1', 'check', NULL),
(12, 'FA', 5, 'FSST8F010849-GD0M', 12, 'ST. 10', 'Label barcode', 'VPST8F-10849-GD', 'check', NULL),
(13, 'FA', 5, 'FSST8F010849-GD0M', 13, 'ST. 10', 'Label barcode', 'MADE IN INDONESIA', 'check', NULL),
(14, 'FA', 5, 'FSST8F010849-GD0M', 14, 'ST. 10', 'Label barcode', 'Tanggal Produksi', 'check', NULL),
(15, 'FA', 5, 'FSST8F010849-GD0M', 15, 'ST. 10', 'Label barcode', 'Jam Produksi', 'check', NULL),
(16, 'FA', 5, 'FSST8F010849-GD0M', 16, 'ST. 10', 'Pencegahan part tercampur', 'Tidak ada PWBA tipe lain di line produksi', 'check', NULL),
(17, 'FA', 5, 'FSST8F010849-GD0M', 17, 'ST. 15', 'Rearcover Assy', 'Nut Spring tersedia di ST.15', 'check', NULL),
(18, 'FA', 5, 'FSST8F010849-GD0M', 18, 'ST. 15', 'Program Mesin', '10', 'check', NULL),
(19, 'FA', 5, 'FSST8F010849-GD0M', 19, 'ST. 15', 'Filter vent', 'Warna Putih', 'check', NULL),
(20, 'FA', 5, 'FSST8F010849-GD0M', 20, 'ST.25a', 'Mesin auto Rearcover', 'Mesin aktif', 'check', NULL),
(21, 'FA', 5, 'FSST8F010849-GD0M', 21, 'ST.25b', 'Mesin auto screw Lens', 'Mesin aktif', 'check', NULL),
(22, 'FA', 5, 'FSST8F010849-GD0M', 22, 'ST.30', 'Program Mesin', 'EOL 1 Version 20250325 K1ZVNAMB', 'check', NULL),
(23, 'FA', 5, 'FSST8F010849-GD0M', 23, 'ST.30', 'Sensor screw', 'Screw lens aktif & Rear cover aktif', 'check', NULL),
(24, 'FA', 5, 'FSST8F010849-GD0M', 24, 'ST.30', 'Program Mesin', 'EOL 2 Version 20250325 K1ZVNAMB', 'check', NULL),
(25, 'FA', 5, 'FSST8F010849-GD0M', 25, 'ST.30', 'Sensor screw', 'Screw lens aktif & Rear cover aktif', 'check', NULL),
(26, 'FA', 5, 'FSST8F010849-GD0M', 26, 'ST.35', 'Program Mesin', 'PDI Version 20250325 K1ZVNAMB', 'check', NULL),
(27, 'FA', 5, 'FSST8F010849-GD0M', 27, 'ST. Rework', 'Pencegahan part tercampur', 'Tidak ada part selain tipe yang sedang berjalan di', 'check', NULL),
(28, 'FA', 5, 'FSST8F010849-GD0M', 28, 'Tag produk', 'Warna tag produk', 'Biru', 'check', NULL),
(29, 'FA', 5, 'FSST8F010849-GD0M', 29, 'Tag produk', 'Kesesuaian tag produk & PACO', 'Kode tag produk : K1Z-NA', 'check', NULL),
(30, 'FA', 5, 'FSST8F010849-GD0M', 30, 'Tag produk', 'Kesesuaian tag produk & PACO', 'Kode tag PACO : K1ZV-NAB', 'check', NULL),
(31, 'FA', 5, 'FSST8F010849-GD0M', 31, 'Tag produk', 'Kesesuaian tag produk & PACO', 'Part number : 3710A-K1Z -NA02-DL', 'check', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cs_changemodel`
--
ALTER TABLE `cs_changemodel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cs_changemodel`
--
ALTER TABLE `cs_changemodel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
