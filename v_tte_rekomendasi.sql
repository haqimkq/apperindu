-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Nov 2023 pada 01.21
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
-- Struktur untuk view `v_tte_rekomendasi`
--
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tte_rekomendasi`  AS SELECT `a`.`id` AS `id`, `a`.`nik` AS `nik`, `a`.`nama` AS `nama`, `a`.`pangkat` AS `pangkat`, `a`.`nip` AS `nip`, `a`.`tblkendalibloksistem_id` AS `tblkendalibloksistem_id`, `b`.`tblkendalibloksistem_nama` AS `tblkendalibloksistem_nama` FROM (`tte_rekomendasi` `a` join `tblkendalibloksistem` `b` on(`a`.`tblkendalibloksistem_id` = `b`.`tblkendalibloksistem_id`))  ;


--
-- VIEW `v_tte_rekomendasi`
-- Data: Tidak ada
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
