-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2023 pada 10.11
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

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
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(1) NOT NULL,
  `nip_kadis` varchar(100) NOT NULL,
  `nama_kadis` varchar(100) NOT NULL,
  `nik_kadis` varchar(50) NOT NULL,
  `pangkat_kadis` varchar(100) NOT NULL,
  `token_wa` varchar(225) NOT NULL,
  `token_tte` varchar(225) NOT NULL,
  `redaksi_ditolak` text NOT NULL,
  `redaksi_diterima` text NOT NULL,
  `redaksi_tte` text NOT NULL,
  `wa_testing` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `nip_kadis`, `nama_kadis`, `nik_kadis`, `pangkat_kadis`, `token_wa`, `token_tte`, `redaksi_ditolak`, `redaksi_diterima`, `redaksi_tte`, `wa_testing`, `status`) VALUES
(1, '196405021987031020', 'Ir. Suharyo', '6301040205640001', 'PEMBINA UTAMA MUDA / (IV/c)', 'XpRwbzSygblLGEhFx9Vb3ArSYngoVmPBh6Xdyhct51LsQF5K06MMQ6ykOXrSHJd7', 'ZWdvdjphcHJpbG51cmlsY2FudGlr', 'Yth. {{nama_pemohon}},\r\nTerimakasih untuk menggunakan layanan kami, mohon maaf permohonan dengan nomor {{no_pendaftaran}}, kami tolak karena {{alasan}} , mohon diperbaiki dengan mengakses halaman permohonan kemudian klik detail lalu klik perbaiki', 'Yth. {{nama_pemohon}},\r\nTerimakasih untuk menggunakan layanan kami, permohonan dengan nomor {{no_pendaftaran}} sudah kami terima, mohon menunggu proses selanjutnya, anda dapat melihat progres permohonan dengan mengakses halaman permohonan kemudian klik detail atau melalui website DPMPTS Tanah Laut pada menu cek perizinan -> status online ', 'Yth. {{nama_pemohon}},\r\nTerimakasih untuk menggunakan layanan kami, permohonan dengan nomor {{no_pendaftaran}} sudah ditanda tangani secara elektronik anda dapat mengunduh surat keterangan pada halaman riwayat permohonan atau dengan mengklik link berikut {{link_dokumen_digital}}', '085245065929', 'T');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
