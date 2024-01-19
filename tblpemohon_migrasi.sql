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
-- Struktur dari tabel `tblpemohon_migrasi`
--

CREATE TABLE `tblpemohon_migrasi` (
  `tblpemohon_id` int(10) NOT NULL,
  `tblpemohon_nomorinduk` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `refstatuspemohon_id` int(1) NOT NULL DEFAULT 1,
  `tblpemohon_nama` varchar(150) DEFAULT NULL,
  `tblpemohon_alamat` varchar(500) DEFAULT NULL,
  `refjenisidentitas_id` int(1) NOT NULL DEFAULT 0,
  `tblpemohon_noidentitas` varchar(25) DEFAULT NULL,
  `tblpemohon_npwp` varchar(30) DEFAULT NULL,
  `tblpemohon_telpon` varchar(50) DEFAULT NULL,
  `tblpemohon_email` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_nikpemilik` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_namapemilik` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_alamatpemilik` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_telponpemilik` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_npwppemilik` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_status` char(2) CHARACTER SET utf8 NOT NULL DEFAULT 'T',
  `tblpemohon_finger` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `tblpemohon_idonline` int(10) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tblpemohon_migrasi`
--

INSERT INTO `tblpemohon_migrasi` (`tblpemohon_id`, `tblpemohon_nomorinduk`, `refstatuspemohon_id`, `tblpemohon_nama`, `tblpemohon_alamat`, `refjenisidentitas_id`, `tblpemohon_noidentitas`, `tblpemohon_npwp`, `tblpemohon_telpon`, `tblpemohon_email`, `tblpemohon_nikpemilik`, `tblpemohon_namapemilik`, `tblpemohon_alamatpemilik`, `tblpemohon_telponpemilik`, `tblpemohon_npwppemilik`, `tblpemohon_status`, `tblpemohon_finger`, `tblpemohon_idonline`) VALUES
(2725, '-', 1, 'EKO SUSILOWATI', 'JL. A. YANI KM. 122 RT. 016 RW. 003 DESA SIMPANG EMPAT ASAM-ASAM KEC. JORONG KAB. TANAH LAUT', 1, '6301024207630001', '02.575.952.3-731.000', '081349731283', ' -', ' ', ' ', ' ', ' ', ' ', 'T', ' ', 0),
(2728, '-', 1, 'GAZALI RAHMAN', 'JL. A. YANI RT. 002 RW. 001 KEL. PABAHANAN KEC. PELAIHARI KAB. TANAH LAUT', 1, '6301031207720009', '03.122.923.0.732.000', '081251321753', ' -', ' ', ' ', ' ', ' ', ' ', 'T', ' ', 0),
(3051, '-', 1, 'SUNATUR', 'JL. MANGGA RT.004 RW.001 DESA MEKAR SARI KEC. KINTAP KAB. TANAH LAUT', 1, '6301070309770002', '70.971.874.6-732.000', '081352785799', ' ', ' ', ' ', ' ', ' ', ' ', 'T', ' ', 0),
(5134, '', 1, 'H. AHMAD ZAINI', 'JL. MURUNG EMBANG RT. 006 RW. 003 DESA BENUA RAYA KEC. BATI - BATI', 1, '630105140770000', '98.570.951.8.732.000', '-', '', '', '', '', '', '', 'T', '', 0),
(6117, '', 1, 'CHAIRIL', 'JL. A. SYAIRANI KOMP. KIJANG MAS NO. 29 RT. 11 RW. 004 KEL. SARANG HALANG KEC. PELAIHARI', 1, '6301033107640001', '79.768.649.0.732.000', '082153083564', '', '', '', '', '', '', 'T', '', 0),
(6664, '', 1, 'FERY APRIADI', 'JL. MAWAR RT. 06 RW. 02 DESA BUKIT MULIA KEC. KINTAP', 1, '6301070504900004', '644.17.696.1.732.000', '-', '-', '', '', '', '', '', 'T', '', 0),
(7127, '', 1, 'Ir. GUSTI NOVIAR KUSUMA, ST, MT', 'JL. PRAMUKA KOMP. CITRA PURI NO.23 RT. 007 RW. 001 KEL. PEMURUS LUAR KEC. BANJARMASIN TIMUR KAB. TANAH LAUT', 1, '6371021511860006', '-', '081349464653', '-', '', '', '', '', '', 'T', 'GUSTI NOVIAR KUSUMA, ST', 0),
(7251, '', 1, 'Hj. NOOR AIDA', 'DESA MALUKA BAULIN RT. 002 RW. 001 KEC. KURAU KAB. TANAH LAUT', 1, '6301044606610018', '81.802.189.1-732.000', '081349677570', '-', '', '', '', '', '', 'T', 'Hj. NOOR AIDA', 0),
(7357, '', 1, 'SYAIFUL', 'JL. A. YANI RT. 007 RW. 003 DESA MUARA KINTAP KEC. KINTAP', 1, '6301071305700001', '15.042..073.5-732.000', '082252934217', '-', '', '', '', '', '', 'T', '', 0),
(7361, '', 1, 'AKHMAD HULYANI', 'DESA KANDANGAN LAMA RT. 006 RW. 003 KEC. PANYIPATAN KAB. TANAH LAUT', 1, '6301060105750001', '15.548.641.8-732.000', '085248479184', 'raisaakbar66@gmail.com', '', '', '', '', '', 'T', '-', 0),
(7505, '', 1, 'HADERI', 'DESA KALI BESAR RT. 003 RW. 001 KEC. KURAU KAB. TANAH LAUT', 1, '6301040507920002', '92.863.438.5-732.000', '082255778003', 'haderi.abd@gmail.com', '', '', '', '', '', 'T', 'HADERI', 0),
(7532, '', 1, 'DINA ANGGRAINI', 'JL. KH. MANSYUR GANG KENANGA RT. 004 RW. 005 KEL. ANGSAU KEC. PELAIHARI', 1, '6301034701910003', '82.221.936.6-732.000', '085251920854', '-', '', '', '', '', '', 'T', '', 0),
(7627, '', 1, 'Ir. GUSTI NOVIAR KUSUMA, ST. MT', 'JL. PRAMUKA KOMP. CITRA PURI NO.23 RT. 007 RW. 001 KEL. PEMURUS LUAR KEC. BANJARMASIN TIMUR KOTA BANJARMASIN', 1, '6371021511860006', '-', '051221065 / 051221157', '-', '', '', '', '', '', 'T', 'GUSTI NOVIAR KUSUMA, ST', 0),
(7653, '', 1, 'EKO SUSILOWATI', 'JL. A. YANI KM. 122 RT. 016 RW. 003 DESA SIMPANG EMPAT SUNGAI BARU KEC. JORONG', 1, '6301024207830001', '31.673.005.0-732.000', '0852 4868 6669', 'rsiabcm@gmail.com', '', '', '', '', '', 'T', '-', 0),
(8113, '', 1, 'CHAIRUL ANWAR', 'JL. A. YANI RT. 003 RW. 001 DESA PANGGUNG KEC. PELAIHARI KAB. TANAH LAUT', 1, '6301031604800001', '96.568.304.8-732.000', '08115506626', 'chairulanwarmubarak@gmail.com', '', '', '', '', '', 'T', 'CHAIRUL ANWAR', 0),
(8981, '', 1, 'Yusmalina', 'Jl. Pusara Rt 3/Rw 1/Kec. Pelaihari/Kel. Pelaihari', 1, '6301034911970001', '', '0895700518497', 'yyusmalina@yahoo.com', '6301034911970001', 'Yusmalina', 'Jl. Pusara Rt 3/Rw 1/Kec. Pelaihari/Kel. Pelaihari', '0895700518497', '', 'T', '', 902),
(9060, '', 1, 'dr. Arian Rizki Amalia', 'Jl. Purnawirawan, RT/RW 003/001, No.5, Kel.Angsau, Kec.Pelaihari, Kab.Tanah Laut, Kalsel (70814)', 1, '6301035801930001', '', '081348494969', 'arianrizki.a.7@gmail.com', '6301035801930001', 'dr. Arian Rizki Amalia', 'Jl. Purnawirawan, RT/RW 003/001, No.5, Kel.Angsau, Kec.Pelaihari, Kab.Tanah Laut, Kalsel (70814)', '081348494969', '', 'T', '', 994),
(9238, '', 1, 'HELDA HERLISA', 'JL. MANGGA BESAR KOMP. MANGGA PERMAI RESIDENCE RT. 009 RW. 005 KEL. SARANG HALANG KEC. PELAIHARI', 1, '6301034503940001', '82.101.079.0.732.000', '083159236892', '-', '', '', '', '', '', 'T', '', 0),
(9272, '', 1, 'Fitriani', 'Jln. Jendral Sudirman Rt.08 Rw.04 Desa Gunung Makmur Kec. Takisung Kab. Tanah Laut', 1, '6301015904900001', '', '082351730158', 'fitri.anii041990@gmail.com', '6301015904900001', 'Fitriani', 'Jln. Jendral Sudirman Rt.08 Rw.04 Desa Gunung Makmur Kec. Takisung Kab. Tanah Laut', '082351730158', '', 'T', '', 1114),
(9498, '', 1, 'Siti Ngatminah', 'Jln. Raya Takisung Desa Gunung Makmur RT 8 Kecamatan Takisung', 1, '6301015412710001', '', '081349403403', 'margaretahabibah99@gmail.com', '6301015412710001', 'Siti Ngatminah', 'Jln. Raya Takisung Desa Gunung Makmur RT 8 Kecamatan Takisung', '081349403403', '', 'T', '', 1260),
(9756, '', 1, 'SELVI CHRISINDA', 'JL. BUMI LARAS BARAT I NO.7 KOMP. PERSADA MAS A RT. 010 RW. 003 KEL. MANARAP LAMA KEC. KERTAK HANYAR KAB. BANJAR', 1, '6303027108840001', '03.018.392.5.732.000', '081224530161', '-', '', '', '', '', '', 'T', 'SELVI CHRISINDA', 0),
(10006, '', 1, 'Fitriyah', 'Jl.A.Yani RT.002/RW.002 Kec.Bati Bati Kel.Benua raya', 1, '6301054712940001', '', '083141584279', 'Fitriyah215@ymail.com', '6301054712940001', 'Fitriyah', 'Jl.A.Yani RT.002/RW.002 Kec.Bati Bati Kel.Benua raya', '083141584279', '', 'T', '', 1113),
(10093, '', 1, 'NELLY ROSANIA', 'KOMP. GRIYA HAMPARAN BLOK B NO. 04B RT. 11 RW. 002 DESA ATU ATU KEC. PELAIHARI', 1, '6301036910750001', '5.358.007.1.732.000', '081350037150', '', '', '', '', '', '', 'T', '', 0),
(10666, '', 1, 'JOHANSYAH', 'DESA SUNGAI BAKAU RT. 001 RW. 001 KEC. KURAU ', 1, '6301042106770001', '61.162.810.8.732.000', '082151935599', '', '', '', '', '', '', 'T', '', 0),
(10822, '', 1, 'BUDI HARTONO', 'JL. A. YANI KM. 121 RT. 12 RW. 002 DESA SIMPANG 4 SEI. BARU KEC.KINTAP', 1, '63010710008860007', '61.950.485.5.732.000', '08225022555', '', '', '', '', '', '', 'T', '', 0),
(10854, '', 1, 'MUHAMMAD FIRDAUS', 'JL. BIDURI RT. 012 KEL. SUNGAI DANAU KEC. SATUI KAB. TANAH BUMBU', 1, '6371020504910007', '-', '081251523844', '', '', '', '', '', '', 'T', '', 0),
(10978, '', 1, 'Erma Novitasari', 'Desa pemuda Rt 1 Rw 1 jl.Mekar Sari kecamatan Pelaihari kabupaten tanah laut', 1, '6301036811960001', '', '082251411264', 'novitaerma28@gmail.com', '6301036811960001', 'Erma Novitasari', 'Desa pemuda Rt 1 Rw 1 jl.Mekar Sari kecamatan Pelaihari kabupaten tanah laut', '082251411264', '', 'T', '', 2151),
(11269, '', 1, 'SUSILO', 'JL. A. YANI KM. 124 RT. 001 RW. 001 DESA SIMPANG EMPAI SUNGAI BARU KEC. JORONG', 1, '6301020409910003', '66.169.973.6-732.000', '08115450814', '-', '', '', '', '', '', 'T', '', 0),
(11273, '', 1, 'Siti Munawwaroh', 'Jl. Raya Pagatan Besar RT 003 RW 001 Kec. Takisung Kab. Tanah Laut', 1, '6301015310970002', '', '085156423322', 'munawwaroh56789@gmail.com', '6301015310970002', 'Siti Munawwaroh', 'Jl. Raya Pagatan Besar RT 003 RW 001 Kec. Takisung Kab. Tanah Laut', '085156423322', '', 'T', '', 2262),
(11794, '', 1, 'Syahrul Hasani', 'Jalan waduk RT 06 Desa Benua Tengah Kecamatan Takisung', 1, '6301011407810002', '', '081348438043', 'syahrulhasani44@gmail.com', '6301011407810002', 'Syahrul Hasani', 'Jalan waduk RT 06 Desa Benua Tengah Kecamatan Takisung', '081348438043', '', 'T', '', 2543),
(11795, '', 1, 'SYAIFUL KOHAR', 'JL. A. TILAM RT. 006 RW. 003 DESA KUNYIT KEC. BAJUIN', 1, '6371050100800012', '-', '081349580149', '-', '', '', '', '', '', 'T', '', 0),
(11796, '', 1, 'HERDA ARIYANI', 'JL. SEI MIAI DALAM NO. 19 RT. 006 RW. 001 KEC. SUNGAI MIAI KEC. BANJARMASIN UTARA', 1, '6371046910900006', '-', '-', '-', '', '', '', '', '', 'T', '', 0),
(11797, '', 1, 'AKHMAD JUNAIDI', 'JL. KARANG JAWA RT. 002 RW. 001 KEL. KARANG TARUNA', 1, '6301030112950002', '-', '081254974572', '-', '', '', '', '', '', 'T', '', 0),
(11798, '', 1, 'Heri susilo wibowo', 'Jl padat karya / rt 03 / rw 02 / kec pelaihari / desa kampung baru.', 1, '6301032710890012', '', '082351937064', 'susilowibowoheri@gmail.com', '6301032710890012', 'Heri susilo wibowo', 'Jl padat karya / rt 03 / rw 02 / kec pelaihari / desa kampung baru.', '082351937064', '', 'T', '', 1853),
(11799, '', 1, 'SUPRIANTO', 'JL. WISATA AIR TEJUN RT.003 RW. 001 DESA SUNGAI BAKAR KEC. BAJUIN', 1, '6301100903840001', '-', '083862158617 - 082155549556', '', '', '', '', '', '', 'T', '', 0),
(11800, '', 1, 'SAMSUDDIN NOOR, ST', 'JL. SIMPANG GUSTI VI NO. 47 RT. 031 RW. 003 KEL. ALALAK UTARA KEC. BANJARMASIN UTARA', 1, '6371040503710006', '406047332732000', '087746066752', '', '', '', '', '', '', 'T', '', 0),
(11801, '', 1, 'Wahidah', 'Jl.Pusaka RT.002 RW.001 Desa Kintap Kec Kintap Kab.Tanah Laut', 1, '6301075901920001', '', '085248060777', 'mimiarsila@gmail.com', '6301075901920001', 'Wahidah', 'Jl.Pusaka RT.002 RW.001 Desa Kintap Kec Kintap Kab.Tanah Laut', '085248060777', '', 'T', '', 2550),
(11802, '', 1, 'Okta viana ulandari', 'Jln raya kandangan baru Rt 08 ,Kec Panyipatan', 1, '6212015010960001', '', '083141335491', 'oktavianaulandari1996@gmai.com', '6212015010960001', 'Okta viana ulandari', 'Jln raya kandangan baru Rt 08 ,Kec Panyipatan', '083141335491', '', 'T', '', 1993),
(11803, '', 1, 'MUHAMMAD YUNUS', 'JL. BATU ANTING RT. 001 RW. 001 DESA KINTAP KECIL KEC. KINTAP', 1, '6301071604960005', '994571701732000', '082147555060', '', '', '', '', '', '', 'T', '', 0),
(11804, '', 1, 'NUR SETYA WISRI', 'KOMP. KIJANG MAS NO 27 RT.014 KEL.SARANG HALANG KEC.PELAIHARI KAB.TANAH LAUT', 1, '6301034509910001', '', '082153702447', 'setyawisri91@gmail.com', '6301034509910001', 'NUR SETYA WISRI', 'KOMP. KIJANG MAS NO 27 RT.014 KEL.SARANG HALANG KEC.PELAIHARI KAB.TANAH LAUT', '082153702447', '', 'T', '', 2540);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tblpemohon_migrasi`
--
ALTER TABLE `tblpemohon_migrasi`
  ADD PRIMARY KEY (`tblpemohon_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tblpemohon_migrasi`
--
ALTER TABLE `tblpemohon_migrasi`
  MODIFY `tblpemohon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11812;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
