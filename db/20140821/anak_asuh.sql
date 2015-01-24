-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2014 at 09:03 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anak_asuh`
--

-- --------------------------------------------------------

--
-- Table structure for table `dberita`
--

CREATE TABLE IF NOT EXISTS `dberita` (
  `id_dberita` int(11) NOT NULL AUTO_INCREMENT,
  `Judul` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_madmin` int(11) NOT NULL,
  PRIMARY KEY (`id_dberita`),
  KEY `id_madmin` (`id_madmin`),
  KEY `id_madmin_2` (`id_madmin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ddonatur`
--

CREATE TABLE IF NOT EXISTS `ddonatur` (
  `id_ddonatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_mdonatur` int(11) NOT NULL,
  `id_dkatdonatur` int(11) NOT NULL,
  `id_malamat` int(11) NOT NULL,
  `tgl_ambil` enum('1-10','11-20','21-30') NOT NULL,
  `nom_awal` int(11) NOT NULL,
  `isActive` enum('n','y') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id_ddonatur`),
  KEY `id_dkatdonatur` (`id_dkatdonatur`),
  KEY `id_mdonatur` (`id_mdonatur`),
  KEY `id_mdonatur_2` (`id_mdonatur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `ddonatur`
--

INSERT INTO `ddonatur` (`id_ddonatur`, `id_mdonatur`, `id_dkatdonatur`, `id_malamat`, `tgl_ambil`, `nom_awal`, `isActive`) VALUES
(8, 1, 5, 0, '11-20', 0, 'n'),
(9, 1, 5, 0, '11-20', 0, 'n'),
(10, 1, 5, 0, '11-20', 0, 'n'),
(11, 1, 5, 0, '11-20', 0, 'n'),
(12, 1, 5, 0, '11-20', 0, 'n'),
(13, 1, 5, 0, '11-20', 0, 'n'),
(14, 1, 5, 0, '11-20', 0, 'n'),
(15, 1, 5, 0, '11-20', 0, 'n'),
(38, 1, 5, 55, '11-20', 950000, 'n'),
(42, 1, 5, 59, '11-20', 250000, 'n'),
(43, 1, 5, 60, '1-10', 10000, 'y'),
(48, 1, 3, 0, '1-10', 0, 'n'),
(49, 1, 4, 0, '1-10', 0, 'n'),
(50, 1, 2, 0, '1-10', 0, 'n'),
(51, 1, 2, 0, '1-10', 0, 'n'),
(52, 14, 5, 192, '1-10', 200000, 'y'),
(53, 1, 4, 0, '1-10', 0, 'n'),
(54, 1, 4, 0, '1-10', 0, 'n'),
(55, 1, 1, 0, '1-10', 0, 'n'),
(56, 1, 1, 0, '1-10', 0, 'n'),
(57, 1, 2, 0, '1-10', 0, 'n'),
(58, 1, 2, 0, '1-10', 0, 'n'),
(59, 1, 2, 0, '1-10', 0, 'n'),
(60, 1, 3, 0, '1-10', 0, 'n'),
(61, 1, 2, 0, '1-10', 0, 'n'),
(62, 1, 2, 0, '1-10', 0, 'n'),
(63, 1, 2, 0, '1-10', 0, 'n'),
(64, 1, 3, 0, '1-10', 0, 'n'),
(65, 1, 3, 0, '1-10', 0, 'n'),
(66, 1, 2, 0, '1-10', 0, 'n'),
(67, 1, 1, 0, '1-10', 0, 'n'),
(68, 1, 2, 0, '1-10', 0, 'n'),
(69, 1, 1, 0, '1-10', 0, 'n'),
(70, 1, 2, 0, '1-10', 0, 'n'),
(71, 1, 3, 0, '1-10', 0, 'n'),
(72, 1, 1, 0, '1-10', 0, 'n'),
(73, 1, 2, 0, '1-10', 0, 'n'),
(74, 1, 2, 0, '1-10', 0, 'n'),
(75, 1, 3, 0, '1-10', 0, 'n'),
(76, 1, 2, 0, '1-10', 0, 'n'),
(77, 1, 3, 0, '1-10', 0, 'n'),
(78, 1, 4, 0, '1-10', 0, 'n'),
(79, 1, 4, 0, '1-10', 0, 'n'),
(80, 1, 2, 0, '1-10', 0, 'n'),
(81, 1, 3, 0, '1-10', 0, 'n'),
(82, 1, 1, 0, '1-10', 0, 'n'),
(83, 1, 1, 0, '1-10', 0, 'n'),
(84, 1, 3, 0, '1-10', 0, 'n'),
(85, 1, 1, 0, '1-10', 0, 'n'),
(86, 1, 2, 0, '1-10', 0, 'n'),
(87, 1, 1, 0, '1-10', 0, 'n'),
(88, 1, 4, 0, '1-10', 0, 'n'),
(89, 1, 3, 0, '1-10', 0, 'n'),
(90, 1, 3, 0, '1-10', 0, 'n'),
(91, 1, 2, 0, '1-10', 0, 'n'),
(92, 1, 1, 0, '1-10', 0, 'n');

-- --------------------------------------------------------

--
-- Table structure for table `dkatdonatur`
--

CREATE TABLE IF NOT EXISTS `dkatdonatur` (
  `id_dkatdonatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_mkatdonatur` int(11) NOT NULL,
  `id_dtipebayar` int(11) NOT NULL,
  PRIMARY KEY (`id_dkatdonatur`),
  KEY `id_mkatdonatur` (`id_mkatdonatur`),
  KEY `id_dtipebayar` (`id_dtipebayar`),
  KEY `id_mkatdonatur_2` (`id_mkatdonatur`,`id_dtipebayar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `dkatdonatur`
--

INSERT INTO `dkatdonatur` (`id_dkatdonatur`, `id_mkatdonatur`, `id_dtipebayar`) VALUES
(3, 1, 4),
(2, 1, 5),
(4, 1, 6),
(1, 1, 26),
(5, 2, 28);

-- --------------------------------------------------------

--
-- Table structure for table `dkatpenerima`
--

CREATE TABLE IF NOT EXISTS `dkatpenerima` (
  `id_dkatpenerima` int(11) NOT NULL AUTO_INCREMENT,
  `id_mkatpenerima` int(11) NOT NULL,
  `id_mjenjang` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('aktif','non') NOT NULL DEFAULT 'aktif',
  PRIMARY KEY (`id_dkatpenerima`),
  KEY `id_mjenjang` (`id_mjenjang`),
  KEY `id_mkatpenerima` (`id_mkatpenerima`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `dkatpenerima`
--

INSERT INTO `dkatpenerima` (`id_dkatpenerima`, `id_mkatpenerima`, `id_mjenjang`, `nominal`, `status`) VALUES
(1, 1, 1, 25000, 'aktif'),
(2, 2, 2, 300000, 'aktif'),
(3, 2, 3, 370000, 'aktif'),
(6, 3, 4, 1500000, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `dmarketer`
--

CREATE TABLE IF NOT EXISTS `dmarketer` (
  `id_dmarketer` int(11) NOT NULL AUTO_INCREMENT,
  `id_mmarketer` int(11) NOT NULL,
  `id_mkecamatan` int(11) NOT NULL,
  PRIMARY KEY (`id_dmarketer`),
  KEY `id_mmarketer` (`id_mmarketer`),
  KEY `id_mkecamatan` (`id_mkecamatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `dmarketer`
--

INSERT INTO `dmarketer` (`id_dmarketer`, `id_mmarketer`, `id_mkecamatan`) VALUES
(10, 14, 6),
(13, 1, 3),
(14, 3, 6),
(16, 14, 3),
(17, 1, 4),
(18, 3, 5),
(19, 3, 1),
(20, 15, 4),
(21, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `dpenerima`
--

CREATE TABLE IF NOT EXISTS `dpenerima` (
  `id_dpenerima` int(11) NOT NULL AUTO_INCREMENT,
  `id_mpenerima` int(11) NOT NULL,
  `id_msekolah` int(11) NOT NULL,
  `id_mlembaga` int(11) NOT NULL DEFAULT '0',
  `isActive` enum('y','n') NOT NULL,
  PRIMARY KEY (`id_dpenerima`),
  KEY `id_mpenerima` (`id_mpenerima`),
  KEY `id_msekolah` (`id_msekolah`),
  KEY `id_mlembaga` (`id_mlembaga`),
  KEY `id_mpenerima_2` (`id_mpenerima`),
  KEY `id_msekolah_2` (`id_msekolah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `dpenerima`
--

INSERT INTO `dpenerima` (`id_dpenerima`, `id_mpenerima`, `id_msekolah`, `id_mlembaga`, `isActive`) VALUES
(26, 42, 6, 7, 'y'),
(28, 42, 5, 7, 'n'),
(33, 41, 5, 7, 'n'),
(34, 41, 6, 7, 'n'),
(35, 41, 2, 7, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `dprestasi`
--

CREATE TABLE IF NOT EXISTS `dprestasi` (
  `id_dprestasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_mpenerima` int(11) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `kompetisi` varchar(60) NOT NULL,
  `tingkat` varchar(60) NOT NULL,
  `juara` varchar(50) NOT NULL,
  `tahun` int(4) NOT NULL,
  `katpres` enum('akademik','non') NOT NULL,
  PRIMARY KEY (`id_dprestasi`),
  KEY `id_maa` (`id_mpenerima`),
  KEY `id_maa_2` (`id_mpenerima`),
  KEY `id_mpenerima` (`id_mpenerima`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dprestasi`
--

INSERT INTO `dprestasi` (`id_dprestasi`, `id_mpenerima`, `instansi`, `kompetisi`, `tingkat`, `juara`, `tahun`, `katpres`) VALUES
(12, 41, 'pt.torabika', 'lomba prestasi', 'kabupaten', '2', 2005, 'akademik');

-- --------------------------------------------------------

--
-- Table structure for table `dtipebayar`
--

CREATE TABLE IF NOT EXISTS `dtipebayar` (
  `id_dtipebayar` int(11) NOT NULL AUTO_INCREMENT,
  `id_mtipebayar` int(11) NOT NULL,
  `dtipebayar` varchar(50) NOT NULL DEFAULT '',
  `no_rek` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dtipebayar`),
  KEY `id_mtipebayar` (`id_mtipebayar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `dtipebayar`
--

INSERT INTO `dtipebayar` (`id_dtipebayar`, `id_mtipebayar`, `dtipebayar`, `no_rek`) VALUES
(4, 3, 'BRI', '612736182736'),
(5, 3, 'BNI', '999999'),
(6, 3, 'Muamalat', '7777777'),
(26, 3, 'BCA', '666666'),
(28, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `madmin`
--

CREATE TABLE IF NOT EXISTS `madmin` (
  `id_madmin` int(11) NOT NULL AUTO_INCREMENT,
  `id_mlogin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_madmin`),
  KEY `id_mlogin` (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `madmin`
--

INSERT INTO `madmin` (`id_madmin`, `id_mlogin`, `nama`, `no_telp`) VALUES
(1, 3, 'epi 8', '9999'),
(5, 12, 'admin2', '47298'),
(6, 13, 'admin1', '77777'),
(7, 30, 'admin3', '2374928374928'),
(8, 36, 'ok', '0867687');

-- --------------------------------------------------------

--
-- Table structure for table `malamat`
--

CREATE TABLE IF NOT EXISTS `malamat` (
  `id_malamat` int(11) NOT NULL AUTO_INCREMENT,
  `pre_malamat` varchar(50) DEFAULT NULL,
  `malamat` text NOT NULL,
  `id_mkecamatan` int(11) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  `tipe` enum('rumah','kantor') NOT NULL DEFAULT 'rumah',
  PRIMARY KEY (`id_malamat`),
  KEY `id_mkecamatan` (`id_mkecamatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

--
-- Dumping data for table `malamat`
--

INSERT INTO `malamat` (`id_malamat`, `pre_malamat`, `malamat`, `id_mkecamatan`, `kode_pos`, `tipe`) VALUES
(1, 'PT abadi jaya sentosa', 'JL. ketintang baru 8', 6, 60273, 'rumah'),
(6, 'hartawan halal', 'L', 5, 9999, 'rumah'),
(8, 'hanafi', 'L', 5, 61381, 'rumah'),
(9, '', 'jl moker no 99', 5, 283647, ''),
(15, '', '2', 5, 3, 'rumah'),
(16, '', '2', 5, 3, 'rumah'),
(17, '', '3', 5, 4, 'rumah'),
(18, '', '3', 5, 4, 'rumah'),
(19, '', 'jl jalan aja', 5, 92749823, 'rumah'),
(20, '', 'jl moker jaya 77', 5, 3459, 'rumah'),
(21, '', 'jl moker jaya 77', 5, 3459, 'rumah'),
(22, '', 'jl moker jaya 779', 6, 34599999, 'rumah'),
(23, 'jklj', '9', 6, 8, 'rumah'),
(24, 'jklj', '9', 6, 8, 'rumah'),
(25, 'jklj', '9', 6, 8, 'rumah'),
(26, 'jklj', '9', 6, 8, 'rumah'),
(27, '', 'jl manyar baru utara komppek 77 ', 6, 99, 'rumah'),
(28, '8', '8', 6, 8, 'rumah'),
(29, '8', '8', 6, 8, 'rumah'),
(30, NULL, 'jl ngapung no 99', 6, 9999, 'rumah'),
(31, '', 'JL. Jagir Wonokromo 99', 6, 998888, 'rumah'),
(32, '', 'jl bajul ijo 99', 3, 987987, 'rumah'),
(33, '', 'jl bajul ijo 99', 3, 987987, 'rumah'),
(34, '', 'jl aja 99', 3, 8678, 'rumah'),
(35, '', 'jl aja 99', 3, 8678, 'rumah'),
(36, '', 'jl aja 99', 3, 8678, 'rumah'),
(37, '', 'jl aja 99', 3, 8678, 'rumah'),
(38, '', 'jl aja 99', 3, 8678, 'rumah'),
(39, 'pt', 'jl ok', 3, 99, 'kantor'),
(40, 'pt', 'jl ok', 3, 99, 'kantor'),
(41, '', 'jl okoko 99', 4, 857687, 'rumah'),
(42, '', 'jlan ok ', 4, 99999, 'rumah'),
(43, 'ok', 'kokok', 4, 88, 'kantor'),
(44, '', 'jalaan ', 4, 99, 'rumah'),
(45, '', 'okoko', 3, 999, 'rumah'),
(46, 'PT ok sejaktera', 'okok', 5, 33, 'kantor'),
(47, '', 'jalan aja', 4, -1, 'rumah'),
(48, 'PT OK sejahtera', 'komplek TNI AL BR 339', 1, 2323, 'kantor'),
(49, '', 'maaaaaaaaak', 4, 222, 'rumah'),
(50, 'mbuh Ltd.', 'sip', 4, 33333333, 'kantor'),
(51, '', '89', 4, 99, 'rumah'),
(52, 'PT ABC OK', '9999', 4, -1, 'kantor'),
(53, 'd', 'd', 4, 0, 'kantor'),
(54, '', 'jl okoko', 6, 60273, 'rumah'),
(55, '', 'Jl. anggrek utara', 6, 78888, 'kantor'),
(56, '', 'jl juju', 4, 78000, 'rumah'),
(57, '', 'jl juju', 6, 0, 'rumah'),
(58, '', 'jl juju', 6, 0, 'rumah'),
(59, 'sumur waktu ', 'komplek wringin anom 78', 5, 89939, 'kantor'),
(60, '', 'jl okoko 999anom 78', 4, 33777, 'rumah'),
(61, 'PT muliah sehat', 'jl ahmad yani 33', 4, 78999, 'kantor'),
(62, '', 'jl dlanggu', 5, 78349, 'rumah'),
(63, '', 'jaln aja gak ujungnya', 4, 23441, 'rumah'),
(64, NULL, '8', 4, 0, 'rumah'),
(65, NULL, '55', 4, 44, 'rumah'),
(66, NULL, '55', 4, 44, 'rumah'),
(67, NULL, '55', 4, 44, 'rumah'),
(68, NULL, '55', 4, 44, 'rumah'),
(69, NULL, '', 4, 0, 'rumah'),
(70, NULL, '', 4, 0, 'rumah'),
(72, NULL, '', 4, 0, 'rumah'),
(73, NULL, '', 4, 0, 'rumah'),
(75, NULL, '', 4, 0, 'rumah'),
(76, NULL, '', 4, 0, 'rumah'),
(78, NULL, '', 4, 0, 'rumah'),
(79, NULL, '', 4, 0, 'rumah'),
(81, NULL, '', 4, 0, 'rumah'),
(82, NULL, '', 4, 0, 'rumah'),
(84, NULL, '', 4, 0, 'rumah'),
(85, NULL, '', 4, 0, 'rumah'),
(87, NULL, '', 4, 0, 'rumah'),
(88, NULL, '', 4, 0, 'rumah'),
(90, NULL, '', 4, 0, 'rumah'),
(91, NULL, '', 4, 0, 'rumah'),
(92, NULL, '', 4, 0, 'rumah'),
(93, NULL, '2', 4, 0, 'rumah'),
(94, NULL, '', 4, 0, 'rumah'),
(95, NULL, '', 4, 0, 'rumah'),
(96, NULL, '2', 4, 33, 'rumah'),
(97, NULL, '', 4, 33, 'rumah'),
(98, NULL, '332', 6, 33, 'rumah'),
(99, NULL, '2', 4, 2, 'rumah'),
(100, NULL, '22', 4, 2, 'rumah'),
(101, NULL, '3', 4, 3, 'rumah'),
(102, NULL, '2', 4, 2, 'rumah'),
(103, NULL, '22', 4, 2, 'rumah'),
(104, NULL, '3', 4, 3, 'rumah'),
(105, NULL, '2', 4, 2, 'rumah'),
(106, NULL, '22', 4, 2, 'rumah'),
(107, NULL, '3', 4, 3, 'rumah'),
(108, NULL, '2', 4, 2, 'rumah'),
(109, NULL, '22', 4, 2, 'rumah'),
(110, NULL, '3', 4, 3, 'rumah'),
(111, NULL, '2', 4, 2, 'rumah'),
(112, NULL, '2', 4, 2, 'rumah'),
(113, NULL, '3', 4, 2, 'rumah'),
(114, NULL, '3', 4, 2, 'rumah'),
(115, NULL, '2', 4, 2, 'rumah'),
(116, NULL, '32', 4, 2, 'rumah'),
(117, NULL, '3', 4, 2, 'rumah'),
(118, NULL, '2', 4, 2, 'rumah'),
(119, NULL, '32', 4, 2, 'rumah'),
(120, NULL, '8', 5, 0, 'rumah'),
(121, NULL, 'y', 5, 0, 'rumah'),
(123, NULL, '8', 5, 0, 'rumah'),
(124, NULL, 'y', 5, 0, 'rumah'),
(125, NULL, '5', 4, 22, 'rumah'),
(126, NULL, '33', 4, 22, 'rumah'),
(128, NULL, '5', 4, 22, 'rumah'),
(129, NULL, '33', 4, 22, 'rumah'),
(131, NULL, '5', 4, 22, 'rumah'),
(132, NULL, '33', 4, 22, 'rumah'),
(134, NULL, '5', 4, 22, 'rumah'),
(135, NULL, '33', 4, 22, 'rumah'),
(137, NULL, '2', 5, 3, 'rumah'),
(138, NULL, '4', 5, 3, 'rumah'),
(140, NULL, '2', 5, 3, 'rumah'),
(141, NULL, '4', 5, 3, 'rumah'),
(143, NULL, '2', 5, 3, 'rumah'),
(144, NULL, '4', 5, 3, 'rumah'),
(145, NULL, '2', 5, 3, 'rumah'),
(146, NULL, '4', 5, 3, 'rumah'),
(147, NULL, '2', 5, 3, 'rumah'),
(148, NULL, '4', 5, 3, 'rumah'),
(149, NULL, '2', 5, 3, 'rumah'),
(150, NULL, '4', 5, 3, 'rumah'),
(151, NULL, '2', 5, 3, 'rumah'),
(152, NULL, '4', 5, 3, 'rumah'),
(153, NULL, '2', 5, 3, 'rumah'),
(154, NULL, '4', 5, 3, 'rumah'),
(155, NULL, '3', 4, 6, 'rumah'),
(156, NULL, '5', 4, 6, 'rumah'),
(157, NULL, '3', 4, 6, 'rumah'),
(158, NULL, '5', 4, 6, 'rumah'),
(159, NULL, '2', 4, 3, 'rumah'),
(160, NULL, '3', 4, 3, 'rumah'),
(161, NULL, '2', 4, 3, 'rumah'),
(162, NULL, '3', 4, 3, 'rumah'),
(163, NULL, '2', 4, 3, 'rumah'),
(164, NULL, '3', 4, 3, 'rumah'),
(165, NULL, '3', 4, 0, 'rumah'),
(166, NULL, 'E', 4, 0, 'rumah'),
(167, NULL, '3', 4, 0, 'rumah'),
(168, NULL, 'E', 4, 0, 'rumah'),
(169, NULL, '3', 4, 0, 'rumah'),
(170, NULL, 'E', 4, 0, 'rumah'),
(171, NULL, '3', 4, 0, 'rumah'),
(172, NULL, 'E', 4, 0, 'rumah'),
(173, NULL, '3', 4, 0, 'rumah'),
(174, NULL, 'E', 4, 0, 'rumah'),
(175, NULL, '3', 4, 0, 'rumah'),
(176, NULL, 'E', 4, 0, 'rumah'),
(177, NULL, '3', 4, 0, 'rumah'),
(178, NULL, 'E', 4, 0, 'rumah'),
(179, NULL, '3', 4, 0, 'rumah'),
(180, NULL, 'E', 4, 0, 'rumah'),
(181, NULL, '3', 4, 0, 'rumah'),
(182, NULL, 'E', 4, 0, 'rumah'),
(183, NULL, '3', 4, 0, 'rumah'),
(184, NULL, 'E', 4, 0, 'rumah'),
(185, NULL, '3', 4, 0, 'rumah'),
(186, NULL, 'E', 4, 0, 'rumah'),
(187, NULL, '3', 4, 0, 'rumah'),
(188, NULL, 'E', 4, 0, 'rumah'),
(189, NULL, 'ketintang barat', 3, 0, 'rumah'),
(190, NULL, 'ketintang', 3, 0, 'rumah'),
(191, NULL, 'ketintang barat', 6, 61428, 'rumah'),
(192, '', 'ketintang barat', 6, 61234, 'rumah'),
(193, NULL, 'ds.telasih, dsn.babatan', 5, 0, 'rumah'),
(194, NULL, 'ds.telasih, dsn.babatan', 5, 0, 'rumah'),
(195, NULL, 'dsn.mejero ', 5, 61372, 'rumah');

-- --------------------------------------------------------

--
-- Table structure for table `mdonatur`
--

CREATE TABLE IF NOT EXISTS `mdonatur` (
  `id_mdonatur` int(11) NOT NULL AUTO_INCREMENT,
  `id_mlogin` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `j_kelamin` enum('L','P') NOT NULL,
  `id_malamat` int(11) DEFAULT NULL,
  `telp` varchar(15) DEFAULT '',
  `hp` varchar(15) DEFAULT '',
  PRIMARY KEY (`id_mdonatur`),
  KEY `id_mlogin` (`id_mlogin`),
  KEY `id_malamat` (`id_malamat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mdonatur`
--

INSERT INTO `mdonatur` (`id_mdonatur`, `id_mlogin`, `nama`, `j_kelamin`, `id_malamat`, `telp`, `hp`) VALUES
(1, 4, 'Soleh Elfrianto H', 'L', 1, '08565500949', '03192839'),
(5, NULL, 'hartawan halal', 'L', 6, '085656', '06576'),
(7, 3, 'hanafi', 'L', 8, '031563765', '085648676513'),
(13, 7, 'farkhul hasan hanafi', 'P', 22, '289348999', '999999'),
(14, 35, 'bayu saputra', 'L', 191, '', '08178689981');

-- --------------------------------------------------------

--
-- Table structure for table `mjenjang`
--

CREATE TABLE IF NOT EXISTS `mjenjang` (
  `id_mjenjang` int(11) NOT NULL AUTO_INCREMENT,
  `mjenjang` varchar(20) NOT NULL,
  `jumkelas` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mjenjang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mjenjang`
--

INSERT INTO `mjenjang` (`id_mjenjang`, `mjenjang`, `jumkelas`) VALUES
(1, 'SD', 6),
(2, 'SMP', 3),
(3, 'SMA', 3),
(4, 'D1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `mkatdonatur`
--

CREATE TABLE IF NOT EXISTS `mkatdonatur` (
  `id_mkatdonatur` int(11) NOT NULL AUTO_INCREMENT,
  `mkatdonatur` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_mkatdonatur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mkatdonatur`
--

INSERT INTO `mkatdonatur` (`id_mkatdonatur`, `mkatdonatur`) VALUES
(1, 'Insidentil'),
(2, 'Rutin');

-- --------------------------------------------------------

--
-- Table structure for table `mkatpenerima`
--

CREATE TABLE IF NOT EXISTS `mkatpenerima` (
  `id_mkatpenerima` int(11) NOT NULL AUTO_INCREMENT,
  `katpenerima` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mkatpenerima`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mkatpenerima`
--

INSERT INTO `mkatpenerima` (`id_mkatpenerima`, `katpenerima`) VALUES
(1, 'BESTARI'),
(2, 'ICMBS'),
(3, 'MEC');

-- --------------------------------------------------------

--
-- Table structure for table `mkecamatan`
--

CREATE TABLE IF NOT EXISTS `mkecamatan` (
  `id_mkecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_mkota` int(11) NOT NULL,
  `mkecamatan` varchar(60) NOT NULL,
  PRIMARY KEY (`id_mkecamatan`),
  KEY `id_mkota` (`id_mkota`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mkecamatan`
--

INSERT INTO `mkecamatan` (`id_mkecamatan`, `id_mkota`, `mkecamatan`) VALUES
(1, 28, 'puri'),
(3, 31, 'Darmo'),
(4, 34, 'bogor'),
(5, 28, 'bangsal'),
(6, 31, 'wonokromo');

-- --------------------------------------------------------

--
-- Table structure for table `mkota`
--

CREATE TABLE IF NOT EXISTS `mkota` (
  `id_mkota` int(11) NOT NULL AUTO_INCREMENT,
  `id_mpropinsi` int(11) NOT NULL,
  `mkota` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mkota`),
  KEY `id_mpropinsi` (`id_mpropinsi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `mkota`
--

INSERT INTO `mkota` (`id_mkota`, `id_mpropinsi`, `mkota`) VALUES
(28, 5, 'mojokerto'),
(31, 5, 'surabaya'),
(34, 6, 'bandung'),
(35, 5, 'sidoarjo'),
(36, 8, 'semarang');

-- --------------------------------------------------------

--
-- Table structure for table `mlembaga`
--

CREATE TABLE IF NOT EXISTS `mlembaga` (
  `id_mlembaga` int(11) NOT NULL AUTO_INCREMENT,
  `mlembaga` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_mkecamatan` int(11) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `koordinator` varchar(50) NOT NULL,
  `no_telpkoord` varchar(15) NOT NULL,
  PRIMARY KEY (`id_mlembaga`),
  KEY `id_mkecamatan` (`id_mkecamatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `mlembaga`
--

INSERT INTO `mlembaga` (`id_mlembaga`, `mlembaga`, `alamat`, `id_mkecamatan`, `no_telp`, `koordinator`, `no_telpkoord`) VALUES
(6, 'Yayasan Al Ikhlas', 'jl daerah bandurng raya sari 66', 6, '082387', 'pak anjar', '9034890234'),
(7, 'Panti Asuhan Siti Maryam', 'Jl. merdeka selatan no 55', 4, '31', 'H. slamet bin sueb', '083434544');

-- --------------------------------------------------------

--
-- Table structure for table `mlogin`
--

CREATE TABLE IF NOT EXISTS `mlogin` (
  `id_mlogin` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('admin','marketer','donatur') NOT NULL DEFAULT 'donatur',
  `isActive` enum('n','y') NOT NULL DEFAULT 'n',
  `acak` varchar(255) NOT NULL,
  PRIMARY KEY (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `mlogin`
--

INSERT INTO `mlogin` (`id_mlogin`, `password`, `email`, `level`, `isActive`, `acak`) VALUES
(3, '443099d7d69bb4a92aa9db7547c216dd', 'lfree_style@yahoo.co.id', 'admin', 'y', 'confirmed'),
(4, '443099d7d69bb4a92aa9db7547c216dd', 'gue.elfrianto@gmail.com', 'donatur', 'y', 'RbaJkesrYEqk9V8BG0cY'),
(6, '443099d7d69bb4a92aa9db7547c216dd', 'marketing@gmail.com', 'marketer', 'y', 'cGSKxedw5f8YXYu2K8Cc'),
(7, '443099d7d69bb4a92aa9db7547c216dd', 'farkhul@hasan.hanafi', 'donatur', 'y', '670b14728ad9902aecba32e22fa4f6bd'),
(9, 'lali', 'tes@admin.com', 'admin', 'y', ''),
(10, 'lali', 'a@a.a', 'admin', 'y', ''),
(11, '06b15d3af713e318d123274a98d70bc9', 'sip', 'admin', 'y', ''),
(12, '444bcb3a3fcf8389296c49467f27e1d6', 'admin2@admin2.com', 'admin', 'y', 'b2tAb2sub2s='),
(13, '7fa3b767c460b54a2be4d49030b349c7', 'admin1@admin1.com', 'admin', 'y', 'bkBuLm4='),
(14, 'mark', 'mark@mark.mark', 'marketer', 'y', ''),
(15, 'ea82410c7a9991816b5eeeebe195e20a', 'mark@mark.mark', 'marketer', 'y', 'confirmed'),
(16, '5ef035d11d74713fcb36f2df26aa7c3d', 'baru@baru.baru', 'marketer', 'y', ''),
(17, 'd41d8cd98f00b204e9800998ecf8427e', '', 'marketer', 'y', 'confirmed'),
(26, 'f4d2682de01b7a3995b91491c019afb8', 'marku@m.m', 'marketer', 'n', ''),
(30, '21232f297a57a5a743894a0e4a801fc3', 'admin3@admin3.com', 'admin', 'y', 'confirmed'),
(31, '5563b5672f414f189ad93c3bd385d5a0', 'hana@market.com', 'marketer', 'y', 'confirmed'),
(32, 'd0f92a90d5500f1d5c4136966c5c7e63', 'epi@epi.com', 'donatur', 'y', 'zQNiFp7XaTHcbwp1i1AR'),
(33, 'eb153d152a1ff57dbea1be9b5f3ec15d', 'rovihosting@gmail.com', 'donatur', 'n', 'Wqqv8c5bOf21sHvQ37c0'),
(34, '17c664d0a1fba0739f91ed2a00951b15', '4rmyhosting@gmail.com', 'donatur', 'y', 'confirmed'),
(35, '443099d7d69bb4a92aa9db7547c216dd', 'bayu@gmail.com', 'donatur', 'y', 'd41d8cd98f00b204e9800998ecf8427e'),
(36, 'ok', 'ok@ok.com', 'admin', 'y', '');

-- --------------------------------------------------------

--
-- Table structure for table `mmarketer`
--

CREATE TABLE IF NOT EXISTS `mmarketer` (
  `id_mmarketer` int(11) NOT NULL AUTO_INCREMENT,
  `id_mlogin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  PRIMARY KEY (`id_mmarketer`),
  KEY `id_mlogin` (`id_mlogin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `mmarketer`
--

INSERT INTO `mmarketer` (`id_mmarketer`, `id_mlogin`, `nama`, `no_telp`) VALUES
(1, 6, 'marketing 1', '0856552288998'),
(3, 15, 'mark', '02938413122'),
(14, 26, 'markus', '209850492840'),
(15, 31, 'hanafichan', '085667567567');

-- --------------------------------------------------------

--
-- Table structure for table `mortupenerima`
--

CREATE TABLE IF NOT EXISTS `mortupenerima` (
  `id_mortupenerima` int(11) NOT NULL AUTO_INCREMENT,
  `id_mpenerima` int(11) NOT NULL,
  `nm_ibu` varchar(60) NOT NULL DEFAULT '',
  `nm_ayah` varchar(60) NOT NULL DEFAULT '',
  `job_ibu` varchar(50) NOT NULL,
  `job_ayah` varchar(50) NOT NULL,
  `id_malamato` int(11) NOT NULL,
  `gaji_ibu` decimal(10,0) NOT NULL,
  `gaji_ayah` decimal(10,0) NOT NULL,
  `nm_wali` varchar(20) NOT NULL,
  `job_wali` varchar(60) NOT NULL,
  `gaji_wali` decimal(10,0) NOT NULL,
  `id_malamatw` int(11) DEFAULT NULL,
  `stat_ayah` enum('hidup','meninggal') NOT NULL DEFAULT 'hidup',
  `stat_ibu` enum('hidup','meninggal') NOT NULL DEFAULT 'hidup',
  PRIMARY KEY (`id_mortupenerima`),
  KEY `id_maa` (`id_mpenerima`),
  KEY `id_mpenerima` (`id_mpenerima`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `mortupenerima`
--

INSERT INTO `mortupenerima` (`id_mortupenerima`, `id_mpenerima`, `nm_ibu`, `nm_ayah`, `job_ibu`, `job_ayah`, `id_malamato`, `gaji_ibu`, `gaji_ayah`, `nm_wali`, `job_wali`, `gaji_wali`, `id_malamatw`, `stat_ayah`, `stat_ibu`) VALUES
(13, 41, 'siti maimunah', 'bagus budi', 'ibu rumah tangga', 'wiraswasta', 190, '0', '1500000', '', '', '0', NULL, 'hidup', 'meninggal'),
(14, 42, 'suparni', 'sukirman', 'tidak bekerja', 'swasta', 194, '0', '900000', 'pak suparto', 'wira swasta', '1500000', 195, 'meninggal', 'meninggal');

-- --------------------------------------------------------

--
-- Table structure for table `mpenerima`
--

CREATE TABLE IF NOT EXISTS `mpenerima` (
  `id_mpenerima` int(11) NOT NULL AUTO_INCREMENT,
  `nm_lengkap` varchar(60) NOT NULL DEFAULT '',
  `nm_panggilan` varchar(10) NOT NULL DEFAULT '',
  `anak_ke` int(11) NOT NULL,
  `jml_sdr` int(11) NOT NULL,
  `j_kelamin` enum('L','P') NOT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `id_malamat` int(11) NOT NULL,
  `agama` enum('Islam','Protestan','Katholik','Hindu','Budha','Konghucu') NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `asrama` enum('n','y') NOT NULL DEFAULT 'n',
  `status_sos` enum('yatim','piatu','yatim piatu','fakir miskin') NOT NULL,
  `isActive` enum('n','y') NOT NULL DEFAULT 'n',
  `rekomendator` enum('donatur','marketer') DEFAULT 'marketer',
  PRIMARY KEY (`id_mpenerima`),
  KEY `id_mkecamatan` (`id_malamat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `mpenerima`
--

INSERT INTO `mpenerima` (`id_mpenerima`, `nm_lengkap`, `nm_panggilan`, `anak_ke`, `jml_sdr`, `j_kelamin`, `tmp_lahir`, `tgl_lahir`, `id_malamat`, `agama`, `no_telp`, `email`, `asrama`, `status_sos`, `isActive`, `rekomendator`) VALUES
(41, 'sulistyowati', 'sulis', 2, 2, 'P', 'surabaya', '0000-00-00', 189, 'Islam', '031567876', 'sulis@gmail.com', 'y', 'yatim', 'y', 'marketer'),
(42, 'iwan ksrisna', 'iwan', 1, 3, 'L', 'mojokerto', '0000-00-00', 193, 'Islam', '0314332', 'marketing@gmail.com', 'y', 'yatim piatu', 'y', 'marketer');

-- --------------------------------------------------------

--
-- Table structure for table `mperiode`
--

CREATE TABLE IF NOT EXISTS `mperiode` (
  `id_mperiode` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` int(4) NOT NULL,
  `semester` enum('ganjil','genap') NOT NULL,
  PRIMARY KEY (`id_mperiode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `mperiode`
--

INSERT INTO `mperiode` (`id_mperiode`, `tahun`, `semester`) VALUES
(4, 2008, 'ganjil'),
(5, 2014, 'genap'),
(7, 2013, 'ganjil'),
(8, 2011, 'ganjil'),
(9, 2014, 'ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `mpropinsi`
--

CREATE TABLE IF NOT EXISTS `mpropinsi` (
  `id_mpropinsi` int(11) NOT NULL AUTO_INCREMENT,
  `mpropinsi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_mpropinsi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mpropinsi`
--

INSERT INTO `mpropinsi` (`id_mpropinsi`, `mpropinsi`) VALUES
(5, 'Jawa Timur'),
(6, 'Jawa Barat'),
(8, 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `msekolah`
--

CREATE TABLE IF NOT EXISTS `msekolah` (
  `id_msekolah` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_mkecamatan` int(11) NOT NULL,
  `id_mjenjang` int(11) NOT NULL,
  PRIMARY KEY (`id_msekolah`),
  KEY `id_mkecamatan` (`id_mkecamatan`),
  KEY `id_mkecamatan_2` (`id_mkecamatan`),
  KEY `id_mjenjang` (`id_mjenjang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `msekolah`
--

INSERT INTO `msekolah` (`id_msekolah`, `nama`, `alamat`, `id_mkecamatan`, `id_mjenjang`) VALUES
(2, 'SMAN 19', 'brebek', 3, 3),
(5, 'SMPN 9', 'ok', 4, 1),
(6, 'SDN KEDINDING V', 'jl. ci ampelas 99 ', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mtipebayar`
--

CREATE TABLE IF NOT EXISTS `mtipebayar` (
  `id_mtipebayar` int(11) NOT NULL AUTO_INCREMENT,
  `mtipebayar` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_mtipebayar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mtipebayar`
--

INSERT INTO `mtipebayar` (`id_mtipebayar`, `mtipebayar`) VALUES
(1, 'Tunai'),
(3, 'Transfer ATM');

-- --------------------------------------------------------

--
-- Table structure for table `tdonasi`
--

CREATE TABLE IF NOT EXISTS `tdonasi` (
  `id_tdonasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_ddonatur` int(11) NOT NULL,
  `nom_akhir` int(11) NOT NULL,
  `isLunas` enum('n','o','y') NOT NULL DEFAULT 'n',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `tgl_lunas` date NOT NULL,
  `bukti` text NOT NULL,
  PRIMARY KEY (`id_tdonasi`),
  KEY `id_ddnoatur` (`id_ddonatur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tdonasi`
--

INSERT INTO `tdonasi` (`id_tdonasi`, `id_ddonatur`, `nom_akhir`, `isLunas`, `tgl`, `tgl_lunas`, `bukti`) VALUES
(41, 87, 150000, 'y', '2014-08-20', '2014-08-20', '4_dc20134b17.jpeg'),
(42, 88, 50000, 'y', '2014-08-20', '2014-08-20', '4_c95c5a6e60.jpeg'),
(43, 89, 250000, 'o', '2014-08-20', '0000-00-00', '4_01ce45ee2e.jpeg'),
(44, 90, 780000, 'o', '2014-08-20', '0000-00-00', '4_4d23fbf8c9.jpeg'),
(45, 91, 1200000, 'y', '2014-08-20', '2014-08-20', '4_d5764a0c18.jpeg'),
(46, 92, 6500000, 'o', '2014-08-20', '0000-00-00', '4_82e10470d9.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tpenyaluran`
--

CREATE TABLE IF NOT EXISTS `tpenyaluran` (
  `id_tpenyaluran` int(11) NOT NULL,
  `id_dpenerima` int(11) NOT NULL,
  `id_mperiode` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `nilai` varchar(5) NOT NULL,
  PRIMARY KEY (`id_tpenyaluran`),
  KEY `id_dpenerima` (`id_dpenerima`),
  KEY `id_mperiode` (`id_mperiode`),
  KEY `id_mperiode_2` (`id_mperiode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tpenyaluran`
--

INSERT INTO `tpenyaluran` (`id_tpenyaluran`, `id_dpenerima`, `id_mperiode`, `kelas`, `nilai`) VALUES
(1, 26, 4, 0, '9');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dberita`
--
ALTER TABLE `dberita`
  ADD CONSTRAINT `dberita_ibfk_1` FOREIGN KEY (`id_madmin`) REFERENCES `madmin` (`id_madmin`);

--
-- Constraints for table `ddonatur`
--
ALTER TABLE `ddonatur`
  ADD CONSTRAINT `ddonatur_ibfk_1` FOREIGN KEY (`id_mdonatur`) REFERENCES `mdonatur` (`id_mdonatur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ddonatur_ibfk_2` FOREIGN KEY (`id_dkatdonatur`) REFERENCES `dkatdonatur` (`id_dkatdonatur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dkatdonatur`
--
ALTER TABLE `dkatdonatur`
  ADD CONSTRAINT `dkatdonatur_ibfk_1` FOREIGN KEY (`id_mkatdonatur`) REFERENCES `mkatdonatur` (`id_mkatdonatur`),
  ADD CONSTRAINT `dkatdonatur_ibfk_2` FOREIGN KEY (`id_dtipebayar`) REFERENCES `dtipebayar` (`id_dtipebayar`);

--
-- Constraints for table `dkatpenerima`
--
ALTER TABLE `dkatpenerima`
  ADD CONSTRAINT `dkatpenerima_ibfk_1` FOREIGN KEY (`id_mkatpenerima`) REFERENCES `mkatpenerima` (`id_mkatpenerima`),
  ADD CONSTRAINT `dkatpenerima_ibfk_2` FOREIGN KEY (`id_mjenjang`) REFERENCES `mjenjang` (`id_mjenjang`);

--
-- Constraints for table `dmarketer`
--
ALTER TABLE `dmarketer`
  ADD CONSTRAINT `dmarketer_ibfk_1` FOREIGN KEY (`id_mmarketer`) REFERENCES `mmarketer` (`id_mmarketer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dmarketer_ibfk_2` FOREIGN KEY (`id_mkecamatan`) REFERENCES `mkecamatan` (`id_mkecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dpenerima`
--
ALTER TABLE `dpenerima`
  ADD CONSTRAINT `dpenerima_ibfk_5` FOREIGN KEY (`id_mlembaga`) REFERENCES `mlembaga` (`id_mlembaga`),
  ADD CONSTRAINT `dpenerima_ibfk_6` FOREIGN KEY (`id_mpenerima`) REFERENCES `mpenerima` (`id_mpenerima`) ON DELETE CASCADE,
  ADD CONSTRAINT `dpenerima_ibfk_7` FOREIGN KEY (`id_msekolah`) REFERENCES `msekolah` (`id_msekolah`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dprestasi`
--
ALTER TABLE `dprestasi`
  ADD CONSTRAINT `dprestasi_ibfk_1` FOREIGN KEY (`id_mpenerima`) REFERENCES `mpenerima` (`id_mpenerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dtipebayar`
--
ALTER TABLE `dtipebayar`
  ADD CONSTRAINT `dtipebayar_ibfk_1` FOREIGN KEY (`id_mtipebayar`) REFERENCES `mtipebayar` (`id_mtipebayar`);

--
-- Constraints for table `madmin`
--
ALTER TABLE `madmin`
  ADD CONSTRAINT `madmin_ibfk_1` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `malamat`
--
ALTER TABLE `malamat`
  ADD CONSTRAINT `malamat_ibfk_2` FOREIGN KEY (`id_mkecamatan`) REFERENCES `mkecamatan` (`id_mkecamatan`);

--
-- Constraints for table `mdonatur`
--
ALTER TABLE `mdonatur`
  ADD CONSTRAINT `mdonatur_ibfk_1` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mdonatur_ibfk_2` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`);

--
-- Constraints for table `mkecamatan`
--
ALTER TABLE `mkecamatan`
  ADD CONSTRAINT `mkecamatan_ibfk_1` FOREIGN KEY (`id_mkota`) REFERENCES `mkota` (`id_mkota`);

--
-- Constraints for table `mkota`
--
ALTER TABLE `mkota`
  ADD CONSTRAINT `mkota_ibfk_1` FOREIGN KEY (`id_mpropinsi`) REFERENCES `mpropinsi` (`id_mpropinsi`);

--
-- Constraints for table `mlembaga`
--
ALTER TABLE `mlembaga`
  ADD CONSTRAINT `mlembaga_ibfk_1` FOREIGN KEY (`id_mkecamatan`) REFERENCES `mkecamatan` (`id_mkecamatan`);

--
-- Constraints for table `mmarketer`
--
ALTER TABLE `mmarketer`
  ADD CONSTRAINT `mmarketer_ibfk_1` FOREIGN KEY (`id_mlogin`) REFERENCES `mlogin` (`id_mlogin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mortupenerima`
--
ALTER TABLE `mortupenerima`
  ADD CONSTRAINT `mortupenerima_ibfk_1` FOREIGN KEY (`id_mpenerima`) REFERENCES `mpenerima` (`id_mpenerima`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mpenerima`
--
ALTER TABLE `mpenerima`
  ADD CONSTRAINT `mpenerima_ibfk_1` FOREIGN KEY (`id_malamat`) REFERENCES `malamat` (`id_malamat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `msekolah`
--
ALTER TABLE `msekolah`
  ADD CONSTRAINT `msekolah_ibfk_1` FOREIGN KEY (`id_mkecamatan`) REFERENCES `mkecamatan` (`id_mkecamatan`),
  ADD CONSTRAINT `msekolah_ibfk_2` FOREIGN KEY (`id_mjenjang`) REFERENCES `mjenjang` (`id_mjenjang`);

--
-- Constraints for table `tdonasi`
--
ALTER TABLE `tdonasi`
  ADD CONSTRAINT `tdonasi_ibfk_1` FOREIGN KEY (`id_ddonatur`) REFERENCES `ddonatur` (`id_ddonatur`);

--
-- Constraints for table `tpenyaluran`
--
ALTER TABLE `tpenyaluran`
  ADD CONSTRAINT `tpenyaluran_ibfk_1` FOREIGN KEY (`id_dpenerima`) REFERENCES `dpenerima` (`id_dpenerima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tpenyaluran_ibfk_2` FOREIGN KEY (`id_mperiode`) REFERENCES `mperiode` (`id_mperiode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
