-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 10:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_kecamatan`
--

CREATE TABLE `m_kecamatan` (
  `id_polygon` int(11) NOT NULL,
  `MaDat` varchar(30) NOT NULL,
  `geojson_polygon` varchar(30) NOT NULL,
  `color` varchar(10) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `m_kecamatan`
--

INSERT INTO `m_kecamatan` (`id_polygon`, `MaDat`, `geojson_polygon`, `color`, `year`) VALUES
(1, 'CCC', 'CCC_2010.json', '#FFAAA0', '2010'),
(2, 'CLN', 'CLN_2010.json', '#FFD2A0', '2010'),
(3, 'CQP', 'CQP_2010.json', '#FF6450', '2010'),
(4, 'DBV', 'DBV_2010.json', '#FFAAA0', '2010'),
(5, 'DCH', 'DCH_2010.json', '#FFAAA0', '2010'),
(6, 'DCS', 'DCS_2010.json', '#FFFFFE', '2010'),
(7, 'DDT', 'DDT_2010.json', '#FFAAA0', '2010'),
(8, 'DGD', 'DGD_2010.json', '#FFAAA0', '2010'),
(9, 'DGT', 'DGT_2010.json', '#FFAA32', '2010'),
(10, 'DKH', 'DKH_2010.json', '#FFAAA0', '2010'),
(11, 'DNL', 'DNL_2010.json', '#FFAAA0', '2010'),
(12, 'DRA', 'DRA_2010.json', '#CDAACD', '2010'),
(13, 'DTL', 'DTL_2010.json', '#AAFFFF', '2010'),
(14, 'DTS', 'DTS_2010.json', '#FAAAA0', '2010'),
(15, 'DTT', 'DTT_2010.json', '#FFAAA0', '2010'),
(16, 'DVH', 'DVH_2010.json', '#FFAAA0', '2010'),
(17, 'DXH', 'DXH_2010.json', '#FFAAA0', '2010'),
(18, 'DYT', 'DYT_2010.json', '#FFAAA0', '2010'),
(19, 'HNK', 'HNK_2010.json', '#FFF0B4', '2010'),
(20, 'LMU', 'LMU_2010.json', '#000000', '2010'),
(21, 'LUA', 'LUA_2010.json', '#FFFC82', '2010'),
(22, 'LUC', 'LUC_2010.json', '#FFFC8C', '2010'),
(23, 'LUK', 'LUK_2010.json', '#FFFC96', '2010'),
(24, 'MNC', 'MNC_2010.json', '#B4FFFF', '2010'),
(25, 'NHK', 'NHK_2010.json', '#FF8CB4', '2010'),
(26, 'NKH', 'NKH_2010.json', '#F5FFB4', '2010'),
(27, 'NTD', 'NTD_2010.json', '#D2D2D2', '2010'),
(28, 'NTS', 'NTS_2010.json', '#AAFFFF', '2010'),
(29, 'Khong xac dinh', 'null_2010.json', '#FFFFFF', '2010'),
(30, 'SXN', 'SXN_2010.json', '#FFFC6E', '2010'),
(31, 'ONT', 'ONT_2010.json', '#FFD0FF', '2010'),
(32, 'PNK', 'PNK_2010.json', '#FFAAA0', '2010'),
(33, 'SKC', 'SKC_2010.json', '#FAAAA0', '2010'),
(34, 'SKK/SKT', 'SKK_SKT_2010.json', '#FAAAA0', '2010'),
(35, 'SKX', 'SKX_2010.json', '#CDAACD', '2010'),
(36, 'SON', 'SON_2010.json', '#A0FFFF', '2010'),
(37, 'TIN', 'TIN_2010.json', '#FFAAA0', '2010'),
(38, 'TON', 'TON_2010.json', '#FFAAA0', '2010'),
(39, 'TSC', 'TSC_2010.json', '#FFAAA0', '2010'),
(51, 'BCS', 'BCS_2015.json', '#FFFFFE', '2015'),
(58, 'BHK', 'BHK_2015.json', '#fff0b4', '2015'),
(60, 'CAN', 'CAN_2015.json', '#ff5046', '2015'),
(68, 'BHK', 'BHK_2010.json', '#fff0b4', '2010'),
(72, 'CAN', 'CAN_2010.json', '#ff5046', '2010'),
(73, 'ODT', 'ODT_2010.json', '#FFA0FF', '2010'),
(74, 'CCC', 'CCC_2015.json', '#FFAAA0', '2015'),
(75, 'CDG', 'CDG_2015.json', '#FFA0AA', '2015'),
(76, 'CLN', 'CLN_2015.json', '#FFD2A0', '2015'),
(79, 'CQP', 'CQP_2015.json', '#FF6450', '2015'),
(80, 'DBV', 'DBV_2015.json', '#FFAAA0', '2015'),
(81, 'DCH', 'DCH_2015.json', '#FFAAA0', '2015'),
(82, 'DCK', 'DCK_2015.json', '#FFAAA0', '2015'),
(83, 'DDL', 'DDL_2015.json', '#FFAAA0', '2015'),
(84, 'DDT', 'DDT_2015.json', '#FFAAA0', '2015'),
(85, 'DGD', 'DGD_2015.json', '#FFAAA0', '2015'),
(86, 'DGT', 'DGT_2015.json', '#FFAA32', '2015'),
(87, 'DKH', 'DKH_2015.json', '#FFAAA0', '2015'),
(88, 'DKV', 'DKV_2015.json', '#FFAAA0', '2015'),
(89, 'DNG', 'DNG_2015.json', '#FFAAA0', '2015'),
(90, 'DNL', 'DNL_2015.json', '#FFAAA0', '2015'),
(91, 'DRA', 'DRA_2015.json', '#CDAACD', '2015'),
(92, 'DSH', 'DSH_2015.json', '#FFAAA0', '2015'),
(93, 'DSK', 'DSK_2015.json', '#FFAAA0', '2015'),
(94, 'DSN', 'DSN_2015.json', '#FFA0AA', '2015'),
(95, 'DTL', 'DTL_2015.json', '#AAFFFF', '2015'),
(96, 'DTS', 'DTS_2015.json', '#FAAAA0', '2015'),
(97, 'DTT', 'DTT_2015.json', '#FFAAA0', '2015'),
(98, 'DVH', 'DVH_2015.json', '#FFAAA0', '2015'),
(99, 'DXH', 'DXH_2015.json', '#FFAAA0', '2015'),
(100, 'DYT', 'DYT_2015.json', '#FFAAA0', '2015'),
(101, 'HNK', 'HNK_2015.json', '#FFF0B4', '2015'),
(102, 'LUC', 'LUC_2015.json', '#FFFC8C', '2015'),
(103, 'LUK', 'LUK_2015.json', '#FFFC96', '2015'),
(104, 'LUN', 'LUN_2015.json', '#FFFCB4', '2015'),
(105, 'MNC', 'MNC_2015.json', '#B4FFFF', '2015'),
(106, 'NCS', 'NCS_2015.json', '#E6E6C8', '2015'),
(107, 'NHK', 'NHK_2015.json', '#FF8CB4', '2015'),
(108, 'NKH', 'NKH_2015.json', '#F5FFB4', '2015'),
(109, 'NTD', 'NTD_2015.json', '#D2D2D2', '2015'),
(110, 'NTS', 'NTS_2015.json', '#AAFFFF', '2015'),
(111, 'khong xac dinh', 'null_2015.json', '#FFFFFF', '2015'),
(112, 'ODT', 'ODT_2015.json', '#FFA0FF', '2015'),
(113, 'ONT', 'ONT_2015.json', '#FFD0FF', '2015'),
(114, 'PNK', 'PNK_2015.json', '#FFAAA0', '2015'),
(115, 'RDD_RDN_RDT_RDM', 'RDD_RDN_RDT_RDM_2015.json', '#6EFF64', '2015'),
(116, 'RPH_RPN_RPT_RPM', 'RPH_RPN_RPT_RPM_2015.json', '#BEFF1E', '2015'),
(117, 'RSX_RSN_RST_RSM', 'RSX_RSN_RST_RSM_2015.json', '#B4FFB4', '2015'),
(118, 'SKC', 'SKC_2015.json', '#FAAAA0', '2015'),
(119, 'SKK_SKT', 'SKK_SKT_2015.json', '#FAAAA0', '2015'),
(120, 'SKS', 'SKS_2015.json', '#CDAACD', '2015'),
(121, 'SKX', 'SKX_2015.json', '#CDAACD', '2015'),
(122, 'SON', 'SON_2015.json', '#A0FFFF', '2015'),
(123, 'TIN', 'TIN_2015.json', '#FFAAA0', '2015'),
(124, 'TMD', 'TMD_2015.json', '#FAAAA0', '2015'),
(125, 'TON', 'TON_2015.json', '#FFAAA0', '2015'),
(126, 'TSC', 'TSC_2015.json', '#FFAAA0', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_login` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_login`, `name`, `pass`, `level`) VALUES
(1, 'admin', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'Admin'),
(2, 'user', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  ADD PRIMARY KEY (`id_polygon`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_kecamatan`
--
ALTER TABLE `m_kecamatan`
  MODIFY `id_polygon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
