-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2024 pada 09.51
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
-- Struktur dari tabel `tblpemohonpersyaratan2`
--

CREATE TABLE `tblpemohonpersyaratan2` (
  `tblpemohonpersyaratan_id` bigint(20) UNSIGNED NOT NULL,
  `tblpemohon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tblpersyaratan_id` int(11) DEFAULT NULL,
  `tblpemohonpersyaratan_file` varchar(255) DEFAULT NULL,
  `tblpemohonpersyaratan_isaktif` enum('T','F') DEFAULT 'T',
  `tblpemohonpersyaratan_keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblpemohonpersyaratan2`
--

INSERT INTO `tblpemohonpersyaratan2` (`tblpemohonpersyaratan_id`, `tblpemohon_id`, `tblpersyaratan_id`, `tblpemohonpersyaratan_file`, `tblpemohonpersyaratan_isaktif`, `tblpemohonpersyaratan_keterangan`) VALUES
(3795, 636, 504, '636_syarat_504_pas foto misla.jpeg', 'T', NULL),
(3796, 636, 181, '636_syarat_181_SURAT PERMOHONAN sipp.pdf', 'T', NULL),
(3797, 636, 457, '636_syarat_457_STR ALIH JENJANG MISLA.pdf', 'T', NULL),
(3798, 636, 365, '636_syarat_365_badan sehat misla.pdf', 'T', NULL),
(3799, 636, 366, '636_syarat_366_REKOMENDASI PPNI.pdf', 'T', NULL),
(3800, 636, 297, '636_syarat_297_SURAT PERYATAAN.jpg', 'T', NULL),
(3801, 636, 474, '636_syarat_474_SIPP LAMA.pdf', 'T', NULL),
(3802, 636, 367, '636_syarat_367_REKOMENDASI RS.pdf', 'T', '-'),
(4525, 729, 181, '729_syarat_181_surat permohonan SIPB.pdf', 'T', NULL),
(4526, 729, 475, '729_syarat_475_SIP HERLIYANI.pdf', 'T', NULL),
(4527, 729, 377, '729_syarat_377_STR K HERLI.pdf', 'T', NULL),
(4528, 729, 365, '729_syarat_365_skbs herli.pdf', 'T', NULL),
(4530, 729, 366, '729_syarat_366_REkom SIPB Herliyani.pdf', 'T', NULL),
(4531, 729, 297, '729_syarat_297_Surat Pernyataan SIPB.pdf', 'T', NULL),
(5155, 729, 436, '1621935405Dokumen_Syarat_.pdf', 'T', '-'),
(5434, 729, 504, '729_syarat_504_Herli Merah.png', 'T', '-'),
(17707, 2159, 181, '2159_syarat_181_WhatsApp Image 2024-01-03 at 09.51.22.jpeg', 'T', NULL),
(17708, 2159, 456, '2159_syarat_456_1.ijazah ,transkrip lina.pdf', 'T', NULL),
(17709, 2159, 457, '2159_syarat_457_STR LINA.pdf', 'T', NULL),
(17710, 2159, 458, '2159_syarat_458_surat ket kerja.pdf', 'T', NULL),
(17711, 2159, 365, '2159_syarat_365_WhatsApp Image 2023-12-28 at 08.14.13.jpeg', 'T', NULL),
(17712, 2159, 366, '2159_syarat_366_Rekom OP utk SIP lina erliani.pdf', 'T', NULL),
(17713, 2159, 504, '2159_syarat_504_2159_syarat_504_3x4 12.JPG', 'T', NULL),
(17714, 2159, 291, '2159_syarat_291_kebenaran dukomen.pdf', 'T', NULL),
(17716, 2159, 367, '1675931394Dokumen_Syarat_.pdf', 'T', 'Upt pkm panggung'),
(19262, 2325, 181, '2325_syarat_181_SURAT PERMOHONAN SURAT IJIN PRAKTEK.pdf', 'T', NULL),
(19263, 2325, 379, '2325_syarat_379_STR.pdf', 'T', NULL),
(19264, 2325, 364, '2325_syarat_364_SURAT PERNYTAAN PRAKTEK RS BCM DR AGI.pdf', 'T', NULL),
(19265, 2325, 504, '2325_syarat_504_FOTO.pdf', 'T', NULL),
(19266, 2325, 297, '2325_syarat_297_SURAT PERNYTAAN  DR AGI.pdf', 'T', NULL),
(19293, 2325, 366, '2325_syarat_366_REKOM IDI.pdf', 'T', NULL),
(19332, 2325, 367, '1689343251Dokumen_Syarat_.pdf', 'T', 'klinik utama ammariz'),
(19413, 2325, 381, '2325_syarat_381_REKOMENDASI dr. AGI.pdf', 'T', '-'),
(19414, 2325, 367, '1689666852Dokumen_Syarat_.pdf', 'T', 'rshb'),
(21245, 2551, 181, '2551_syarat_181_Permohonan SIP.pdf', 'T', NULL),
(21246, 2551, 366, '2551_syarat_366_REKOM IDI 3 Tempat.pdf', 'T', NULL),
(21247, 2551, 379, '2551_syarat_379_STR seumur hidup dr jauhari.pdf', 'T', NULL),
(21248, 2551, 504, '2551_syarat_504_Pas Foto.jpg', 'T', NULL),
(21249, 2551, 297, '2551_syarat_297_Surat Pernyataan.pdf', 'T', NULL),
(21250, 2551, 393, '2551_syarat_393_SIP PKM 2019_page-0001.jpg', 'T', NULL),
(21251, 2551, 367, NULL, 'T', 'DPP DR.Erlinawati PT.Gawi Makmur Kalimantan'),
(21252, 2551, 367, NULL, 'T', 'pkm jorong'),
(21253, 2551, 367, NULL, 'T', 'praktik mandiri'),
(21254, 2325, 367, '1704251619Dokumen_Syarat_.pdf', 'T', 'rsbcm'),
(21255, 2159, 367, '1704421081Dokumen_Syarat_.pdf', 'T', 'pkm pgg'),
(21256, 1307, 181, '1307_syarat_181_SURAT PERMOHONAN_0001.pdf', 'T', NULL),
(21257, 1307, 474, '1307_syarat_474_SIPP.pdf', 'T', NULL),
(21258, 1307, 457, '1307_syarat_457_E STR SEUMUR HIDUP.pdf', 'T', NULL),
(21259, 1307, 365, '1307_syarat_365_KIR SIPP 2024_0001.pdf', 'T', NULL),
(21260, 1307, 366, '1307_syarat_366_REKOM SIPP.pdf', 'T', NULL),
(21261, 1307, 504, '1307_syarat_504_PAS FOTO.jpeg', 'T', NULL),
(21262, 1307, 297, '1307_syarat_297_SURAT KET BENAR DAN LENGKAP.pdf', 'T', NULL),
(21263, 1307, 367, '1704421705Dokumen_Syarat_.pdf', 'T', 'pkm bentok kampung'),
(21264, 729, 436, '1704765762Dokumen_Syarat_.pdf', 'T', 'pkm bumi makmur'),
(21266, 636, 456, '636_syarat_456_IJAZAH NERS (1).pdf', 'T', NULL),
(21267, 636, 458, '636_syarat_458_REKOMENDASI RS.pdf', 'T', NULL),
(21268, 636, 491, '636_syarat_491_REKOMENDASI PPNI.pdf', 'T', NULL),
(21269, 2554, 181, '2554_syarat_181_PERMOHONAN SIP .pdf', 'T', NULL),
(21270, 2554, 379, '2554_syarat_379_str.jpg', 'T', NULL),
(21271, 2554, 366, '2554_syarat_366_Rekom IDI BCM.pdf', 'T', NULL),
(21272, 2554, 381, '2554_syarat_381_PERMOHONAN SIP .pdf', 'T', NULL),
(21273, 2554, 364, '2554_syarat_364_PERMOHONAN SIP .pdf', 'T', NULL),
(21274, 2554, 504, '2554_syarat_504_foto.jpg', 'T', NULL),
(21275, 2554, 297, '2554_syarat_297_PERMOHONAN SIP .pdf', 'T', NULL),
(21276, 2554, 367, '1704422258Dokumen_Syarat_.pdf', 'T', 'rsbcm'),
(21277, 2529, 366, '2529_syarat_366_Rekom SIPB Eka Susilo Sri.pdf', 'T', NULL),
(21278, 2529, 504, '2529_syarat_504_FOTO BAJU IBI LATAR MERAH.JPG', 'T', NULL),
(21279, 2529, 365, '2529_syarat_365_SURAT SEHAT.pdf', 'T', NULL),
(21280, 2529, 377, '2529_syarat_377_STR SEUMUR HIDUP.pdf', 'T', NULL),
(21281, 2529, 475, '2529_syarat_475_SIPB.pdf', 'T', NULL),
(21282, 2529, 181, '2529_syarat_181_Surat Permohonan Eka SSB.pdf', 'T', NULL),
(21283, 2529, 297, '2529_syarat_297_SURAT PERNYATAAN BERMATERAI.pdf', 'T', NULL),
(21284, 2527, 181, '2527_syarat_181_Surat permohonan Devi .pdf', 'T', NULL),
(21285, 2527, 475, '2527_syarat_475_6. SIP.pdf', 'T', NULL),
(21286, 2527, 377, '2527_syarat_377_STR BARU.pdf', 'T', NULL),
(21287, 2527, 365, '2527_syarat_365_1704454987403_SURAT SEHAT.pdf', 'T', NULL),
(21288, 2527, 504, '2527_syarat_504_1704454985382_foto baju ibi latar merah.jpg', 'T', NULL),
(21289, 2527, 297, '2527_syarat_297_Punya mba dev surat pernyataan.pdf', 'T', NULL),
(21290, 2527, 366, '2527_syarat_366_Rekom SIPB Devi Soswiningrum.pdf', 'T', NULL),
(21304, 636, 291, '636_syarat_291_SURAT PERNYATAAN.pdf', 'T', NULL),
(21305, 2529, 436, '1704764892Dokumen_Syarat_.pdf', 'T', 'rsbcm'),
(21306, 2527, 436, '1704763820Dokumen_Syarat_.pdf', 'T', 'rsbcm'),
(21307, 636, 367, '1704765302Dokumen_Syarat_.pdf', 'T', 'RSHB'),
(21308, 2559, 476, '2559_syarat_476_SIP TTK.pdf', 'T', NULL),
(21309, 2559, 181, '2559_syarat_181_surat permohonan PTSP.pdf', 'T', NULL),
(21310, 2559, 373, '2559_syarat_373_STRTTK 2023 Maulida Ramayanti.pdf', 'T', NULL),
(21311, 2559, 376, '2559_syarat_376_Rekom Pc Pafi Maulida Ramayanti.pdf', 'T', NULL),
(21312, 2559, 504, '2559_syarat_504_foto.pdf', 'T', NULL),
(21313, 2559, 297, '2559_syarat_297_surat pernyataan_rotated.pdf', 'T', NULL),
(21314, 2559, 367, NULL, 'T', 'rshb');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblpemohonpersyaratan2`
--
ALTER TABLE `tblpemohonpersyaratan2`
  ADD PRIMARY KEY (`tblpemohonpersyaratan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblpemohonpersyaratan2`
--
ALTER TABLE `tblpemohonpersyaratan2`
  MODIFY `tblpemohonpersyaratan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21338;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
