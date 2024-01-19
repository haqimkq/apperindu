-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jan 2024 pada 06.44
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
-- Struktur dari tabel `tblpemohonpersyaratan_migrasi`
--

CREATE TABLE `tblpemohonpersyaratan_migrasi` (
  `tblpemohonpersyaratan_id` bigint(20) UNSIGNED NOT NULL,
  `tblpemohon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tblpersyaratan_id` int(11) DEFAULT NULL,
  `tblpemohonpersyaratan_file` varchar(255) DEFAULT NULL,
  `tblpemohonpersyaratan_isaktif` enum('T','F') DEFAULT 'T',
  `tblpemohonpersyaratan_keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblpemohonpersyaratan_migrasi`
--

INSERT INTO `tblpemohonpersyaratan_migrasi` (`tblpemohonpersyaratan_id`, `tblpemohon_id`, `tblpersyaratan_id`, `tblpemohonpersyaratan_file`, `tblpemohonpersyaratan_isaktif`, `tblpemohonpersyaratan_keterangan`) VALUES
(5894, 902, 181, '902_syarat_181_CamScanner 22-12-2023 15.19.pdf', 'T', NULL),
(5895, 902, 373, '902_syarat_373_XE00000066420830.pdf', 'T', NULL),
(5896, 902, 374, '902_syarat_374_CamScanner 08-12-2023 15.10.pdf', 'T', NULL),
(5897, 902, 376, '902_syarat_376_Rekom SIPTTK 2023 an.Yusmalina.pdf', 'T', NULL),
(5898, 902, 504, '902_syarat_504_DSC_3340 copy.jpg', 'T', NULL),
(6247, 902, 291, '902_syarat_291_CamScanner 23-12-2023 16.12.pdf', 'T', NULL),
(6251, 902, 367, '1626089332Dokumen_Syarat_.pdf', 'T', '-'),
(6692, 994, 181, '994_syarat_181_Pelaihari, 21 Desember 2023.pdf', 'T', NULL),
(6693, 994, 379, '994_syarat_379_KONSIL KEDOKTERAN INDONESIA.pdf', 'T', NULL),
(6694, 994, 366, '994_syarat_366_Rekom SIP dr.Arian.pdf', 'T', NULL),
(6695, 994, 381, '994_syarat_381_PEMERINTAH KABUPATEN TANAH LAUT (1).pdf', 'T', NULL),
(6696, 994, 364, '994_syarat_364_SURAT PERNYATAAN (3).pdf', 'T', NULL),
(6697, 994, 504, '994_syarat_504_Screen Shot 2020-01-08 at 10.24.21 AM.png', 'T', NULL),
(6698, 994, 297, '994_syarat_297_SURAT PERNYATAAN (3).pdf', 'T', NULL),
(6699, 994, 367, '1627974758Dokumen_Syarat_.pdf', 'T', '-'),
(7811, 1114, 181, '1114_syarat_181_surat permohonan sipp.pdf', 'T', NULL),
(7812, 1114, 456, '1114_syarat_456_FC IJAZAH SIP.jpg', 'T', NULL),
(7813, 1114, 457, '1114_syarat_457_STR Fitri 28.pdf', 'T', NULL),
(7814, 1114, 458, '1114_syarat_458_UMPEG20231122_0962.pdf', 'T', NULL),
(7815, 1114, 365, '1114_syarat_365_KIR SIPP Viet.pdf', 'T', NULL),
(7816, 1114, 366, '1114_syarat_366_rekom OP utk SIP a.n Fitriani.pdf', 'T', NULL),
(7818, 1114, 291, '1114_syarat_291_surat pernyataan mtrai sipp.pdf', 'T', NULL),
(7826, 1114, 504, '1114_syarat_504_IMG_20221120_084944.jpg', 'T', '-'),
(7827, 1114, 367, '1703728353Dokumen_Syarat_.pdf', 'T', '-'),
(8036, 1113, 504, '1113_syarat_504_foto fitriyah.jpeg', 'T', NULL),
(8037, 1113, 366, '1113_syarat_366_rekom OP utk SIP fitriyah.pdf', 'T', NULL),
(8038, 1113, 365, '1113_syarat_365_KIR SIPP.pdf', 'T', NULL),
(8039, 1113, 458, '1113_syarat_458_Rekom SIPPPKM.pdf', 'T', NULL),
(8040, 1113, 457, '1113_syarat_457_STR NEW.pdf', 'T', NULL),
(8041, 1113, 456, '1113_syarat_456_IJAZAH SEKOLAH TINGGI ILMU KESEHATAN.pdf', 'T', NULL),
(9037, 1260, 181, '1260_syarat_181_CamScanner 05-12-2023 12.14.pdf', 'T', NULL),
(9038, 1260, 53, '1260_syarat_53_ktp ngatminah.pdf', 'T', NULL),
(9039, 1260, 377, '1260_syarat_377_PC00000107075959.pdf', 'T', NULL),
(9040, 1260, 365, '1260_syarat_365_CamScanner 28-12-2023 13.59.pdf', 'T', NULL),
(9041, 1260, 364, '1260_syarat_364_pernyataan tempat praktik.pdf', 'T', NULL),
(9042, 1260, 378, '1260_syarat_378_ket.kerja ngatminah.PDF', 'T', NULL),
(9043, 1260, 504, '1260_syarat_504_DSC_0197(1).jpg', 'T', NULL),
(9044, 1260, 42, '1260_syarat_42_IZAZAH D3.pdf', 'T', NULL),
(9045, 1260, 446, '1260_syarat_446_Rekom SIPBM Siti Ngatminah.pdf', 'T', NULL),
(9046, 1260, 291, '1260_syarat_291_surat pernyataan.pdf', 'T', NULL),
(9047, 1260, 367, '1639534462Dokumen_Syarat_.pdf', 'T', '-'),
(11065, 1113, 291, '1113_syarat_291_Surat pernyataan SIP PKM.pdf', 'T', NULL),
(11066, 1113, 181, '1113_syarat_181_Surat Permohonan SIPP 2023 New.pdf', 'T', NULL),
(12147, 1113, 367, '1650846788Dokumen_Syarat_.pdf', 'T', '-'),
(17320, 1993, 457, '1993_syarat_457_Str.pdf', 'T', NULL),
(17321, 1993, 458, '1993_syarat_458_Surat ket kerja okta.pdf', 'T', NULL),
(17322, 1993, 365, '1993_syarat_365_Surat sehat 2.pdf', 'T', NULL),
(17323, 1993, 366, '1993_syarat_366_SERKOM SIPP.pdf', 'T', NULL),
(17324, 1993, 504, '1993_syarat_504_2DC7AEE0-3D5F-4929-8BAE-B0C1560582AD.jpeg', 'T', NULL),
(17325, 1993, 291, '1993_syarat_291_Surat pernytaan okta.pdf', 'T', NULL),
(17326, 1993, 456, '1993_syarat_456_Izasah.pdf', 'T', NULL),
(17468, 1993, 181, '1993_syarat_181_surat permohonan okta-1.pdf', 'T', NULL),
(17607, 994, 367, NULL, 'T', '-'),
(17608, 994, 366, '1675669957Dokumen_Syarat_.pdf', 'T', 'pkm panggung'),
(17609, 994, 367, '1703144815Dokumen_Syarat_.pdf', 'T', 'pkm panggung'),
(17629, 2151, 53, '2151_syarat_53_foto ktp (2).jpg', 'T', NULL),
(17630, 2151, 377, '2151_syarat_377_STR BARU (3).jpg', 'T', NULL),
(17631, 2151, 504, '2151_syarat_504_3x4 4.JPG', 'T', NULL),
(17632, 2151, 42, '2151_syarat_42_FOTO IJAZAH D3 (8).jpg', 'T', NULL),
(17633, 2151, 446, '2151_syarat_446_Rekom SIPB Erma Novitasari (10).pdf', 'T', NULL),
(17634, 2151, 181, '2151_syarat_181_PERMOHONAN.jpeg', 'T', NULL),
(17635, 2151, 365, '2151_syarat_365_berbadan sehat.jpeg', 'T', NULL),
(17636, 2151, 364, '2151_syarat_364_SURAT KEPEMILIKAN TEMPAT PRAKTIK PDF.pdf', 'T', NULL),
(17637, 2151, 291, '2151_syarat_291_PERNYATAAN BERMATERAI.jpeg', 'T', NULL),
(17638, 2151, 378, '2151_syarat_378_SURAT KERJA PKM PGG (5).jpeg', 'T', NULL),
(17641, 2151, 367, '1675841423Dokumen_Syarat_.pdf', 'T', 'upt. pkm panggung'),
(18602, 1113, 367, '1684113769Dokumen_Syarat_.pdf', 'T', 'upt pkm padang luas'),
(18731, 2262, 181, '2262_syarat_181_surat permohonan.pdf', 'T', NULL),
(18732, 2262, 53, '2262_syarat_53_8AF13EC6-E163-4429-9416-BC24D0C227BE.jpeg', 'T', NULL),
(18733, 2262, 396, '2262_syarat_396_SURAT KETERANGAN TIDAK BEKERJA DI PERUSAHAAN FARMASI.pdf', 'T', NULL),
(18734, 2262, 394, '2262_syarat_394_32F4C683-3FC9-47C4-8C3F-3F885DEE9DD0.jpeg', 'T', NULL),
(18735, 2262, 372, '2262_syarat_372_F5068140-E458-471A-8178-1D4F7ED12AE7.jpeg', 'T', NULL),
(18736, 2262, 291, '2262_syarat_291_Penyataan berkas.jpeg', 'T', NULL),
(18742, 2262, 59, '2262_syarat_59_C77F4D35-EC8D-4FCA-B115-796B750F351C.png', 'T', NULL),
(18743, 2262, 395, '2262_syarat_395_35EE88FC-CEC1-4E24-BA72-C8BE394EBDCE.png', 'T', NULL),
(18757, 2262, 367, '1685002877Dokumen_Syarat_.pdf', 'T', 'apotek selaras'),
(18777, 2262, 154, '2262_syarat_154_Surat rekomendasi.pdf', 'T', NULL),
(21114, 1260, 475, '1260_syarat_475_SK Izin KLINIK_82_12_2021 - SIP SITI.pdf', 'T', NULL),
(21115, 1260, 436, '1260_syarat_436_Rekom SIPB BPM Siti Ngatminah.pdf', 'T', NULL),
(21116, 1260, 366, '1260_syarat_366_Rekom SIPB BPM Siti Ngatminah.pdf', 'T', NULL),
(21117, 1260, 297, '1260_syarat_297_surat pernytaan.pdf', 'T', NULL),
(21121, 1260, 436, '1702434329Dokumen_Syarat_.pdf', 'T', 'PKM TAKISUNG'),
(21160, 2540, 53, '2540_syarat_53_KTP NSW.pdf', 'T', NULL),
(21161, 2540, 377, '2540_syarat_377_STR NUR SETYA WISRI (SEUMUR HIDUP).pdf', 'T', NULL),
(21162, 2540, 504, '2540_syarat_504_FOTO LATAR KUNING.jpeg', 'T', NULL),
(21163, 2540, 42, '2540_syarat_42_Nur Setya Wisri (Ijazah)-1_removed.pdf', 'T', NULL),
(21164, 2540, 446, '2540_syarat_446_Rekom SIPB Nur Stya Wisri.pdf', 'T', NULL),
(21165, 2540, 365, '2540_syarat_365_Wisri KIR.pdf', 'T', NULL),
(21171, 2540, 181, '2540_syarat_181_SURAT PERMOHONAN SIPB.pdf', 'T', NULL),
(21187, 2543, 181, '2543_syarat_181_usul sip 2024.pdf', 'T', NULL),
(21188, 2543, 456, '2543_syarat_456_IJAZAH D3.pdf', 'T', NULL),
(21189, 2543, 458, '2543_syarat_458_keterangan praktek.pdf', 'T', NULL),
(21190, 2543, 365, '2543_syarat_365_kir kesehatan.pdf', 'T', NULL),
(21191, 2543, 504, '2543_syarat_504_foto latar orange (1) compres.jpg', 'T', NULL),
(21192, 2543, 291, '2543_syarat_291_pernyataan sip.pdf', 'T', NULL),
(21193, 2543, 366, '2543_syarat_366_REKOM SIPP SYAHRUL HASANI.pdf', 'T', NULL),
(21208, 1113, 474, '1113_syarat_474_SIPP.pdf', 'T', NULL),
(21209, 2543, 457, '2543_syarat_457_SIP 2022.pdf', 'T', NULL),
(21210, 2543, 367, '1703124812Dokumen_Syarat_.pdf', 'T', 'psc'),
(21211, 1113, 297, '1113_syarat_297_Pernytaan SIPP 2023 new.pdf', 'T', NULL),
(21212, 1113, 367, '1703125214Dokumen_Syarat_.pdf', 'T', 'pkm pd luas'),
(21213, 2540, 378, '2540_syarat_378_surat ket.kerja.pdf', 'T', NULL),
(21214, 2540, 291, '2540_syarat_291_surat pernyataan.pdf', 'T', NULL),
(21215, 994, 367, NULL, 'T', 'pkm panggung'),
(21216, 1853, 181, '1853_syarat_181_BIODATA PEMOHON.pdf', 'T', NULL),
(21217, 1853, 456, '1853_syarat_456_izasah.pdf', 'T', NULL),
(21218, 1853, 457, '1853_syarat_457_STR 2023 HERI.pdf', 'T', NULL),
(21219, 1853, 458, '1853_syarat_458_SRT KETERANGAN.pdf', 'T', NULL),
(21220, 1853, 365, '1853_syarat_365_KIR.pdf', 'T', NULL),
(21221, 1853, 366, '1853_syarat_366_REKOM SIPP.pdf', 'T', NULL),
(21222, 1853, 504, '1853_syarat_504_FOTO.jpg', 'T', NULL),
(21223, 1853, 291, '1853_syarat_291_SRT PERNYATAAN.pdf', 'T', NULL),
(21224, 2262, 367, '1703212615Dokumen_Syarat_.pdf', 'T', 'apotek al munawarroh'),
(21225, 1853, 367, '1703212331Dokumen_Syarat_.pdf', 'T', 'rshb'),
(21226, 2151, 367, '1703728782Dokumen_Syarat_.pdf', 'T', 'pkm pgg'),
(21227, 902, 367, '1703728561Dokumen_Syarat_.pdf', 'T', 'rshb'),
(21228, 2550, 377, '2550_syarat_377_str.jpeg', 'T', NULL),
(21229, 2550, 365, '2550_syarat_365_surat ket sehat.jpeg', 'T', NULL),
(21230, 2550, 504, '2550_syarat_504_Poto wahidah.jpeg', 'T', NULL),
(21231, 2550, 366, '2550_syarat_366_REkom SIPB.jpeg', 'T', NULL),
(21232, 2550, 181, '2550_syarat_181_srt permohonan.jpeg', 'T', NULL),
(21233, 2550, 475, '2550_syarat_475_SIPB.jpeg', 'T', NULL),
(21234, 2550, 297, '2550_syarat_297_srt pernyataan.jpeg', 'T', NULL),
(21235, 2550, 436, '2550_syarat_436_rekom.jpeg', 'T', NULL),
(21236, 2550, 436, '1703819825Dokumen_Syarat_.pdf', 'T', 'pkm kintap'),
(21237, 1993, 367, '1704155168Dokumen_Syarat_.pdf', 'T', 'rsbcm'),
(21238, 1260, 436, '1703820449Dokumen_Syarat_.pdf', 'T', 'BPM ANANDA'),
(21239, 2540, 367, '1703820136Dokumen_Syarat_.pdf', 'T', 'PKM TIRTA JAYA'),
(21338, 2262, 373, '2262_syarat_373_strttk.pdf', 'T', NULL),
(21339, 2262, 374, '2262_syarat_374_surat permohonan.pdf', 'T', NULL),
(21340, 2262, 376, '2262_syarat_376_Rekom SIPTTK 2023 An.Rusmaniah.pdf', 'T', NULL),
(21341, 2262, 504, '2262_syarat_504_WhatsApp Image 2024-01-16 at 21.28.07.jpeg', 'T', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblpemohonpersyaratan_migrasi`
--
ALTER TABLE `tblpemohonpersyaratan_migrasi`
  ADD PRIMARY KEY (`tblpemohonpersyaratan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblpemohonpersyaratan_migrasi`
--
ALTER TABLE `tblpemohonpersyaratan_migrasi`
  MODIFY `tblpemohonpersyaratan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21347;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
