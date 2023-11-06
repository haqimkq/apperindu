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
-- Struktur untuk view `v_template_rekomendasi`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_template_rekomendasi`  AS SELECT `a`.`tblskizin_tabelvariabel_id` AS `tblskizin_tabelvariabel_id`, `a`.`tblskizin_tabelsk` AS `tblskizin_tabelsk`, `b`.`tblskizin_id` AS `tblskizin_id`, `a`.`tblskizin_tabelvariabel_isrekom` AS `tblskizin_tabelvariabel_isrekom`, `b`.`tblskizin_rekomtemplate` AS `tblskizin_rekomtemplate`, `b`.`tblskizin_tabelvariabel_idrekom` AS `tblskizin_tabelvariabel_idrekom`, `c`.`tblizin_nama` AS `tblizin_nama`, `c`.`tblizinpermohonan_nama` AS `tblizinpermohonan_nama`, `c`.`tblizin_id` AS `tblizin_id`, `c`.`tblizinpermohonan_id` AS `tblizinpermohonan_id`, `c`.`tblizin_isaktif` AS `tblizin_isaktif` FROM ((`tblskizin_tabelvariabel` `a` join `tblskizin_beta` `b` on(`a`.`tblskizin_tabelvariabel_id` = `b`.`tblskizin_tabelvariabel_idrekom`)) join `v_izinpermohonan` `c` on(`b`.`tblizinpermohonan_id` = `c`.`tblizinpermohonan_id`)) WHERE `b`.`tblskizin_tabelvariabel_idrekom` is not nullnot null  ;

--
-- VIEW `v_template_rekomendasi`
-- Data: Tidak ada
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
