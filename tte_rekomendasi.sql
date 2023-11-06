-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Nov 2023 pada 01.22
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptsp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tte_rekomendasi`
--

CREATE TABLE `tte_rekomendasi` (
  `id` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `pangkat` varchar(224) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `tblkendalibloksistem_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tte_rekomendasi`
--

INSERT INTO `tte_rekomendasi` (`id`, `nik`, `nama`, `pangkat`, `nip`, `tblkendalibloksistem_id`) VALUES
(1, '6301032910860002', 'dr. Hj. Isna Farida, M.Kes', 'Pembina Tk. I/ IV.b', '197406122005012016', '134'),
(5, '19193871239813', 'IBNU', 'INI PANGKAT', '6301032910860002', '137');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tte_rekomendasi`
--
ALTER TABLE `tte_rekomendasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tte_rekomendasi`
--
ALTER TABLE `tte_rekomendasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
