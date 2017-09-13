-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2015 at 06:02 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=647 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(630, 1341152340, '127.0.0.1', 'QK98gMzp'),
(629, 1341152338, '127.0.0.1', 'petef3gu'),
(628, 1341152337, '127.0.0.1', 'wiKhhSr7'),
(627, 1341152336, '127.0.0.1', '05cFN3Ez'),
(626, 1341152335, '127.0.0.1', 'PQTsUEi5'),
(625, 1341152332, '127.0.0.1', 'Lm2yfsI1'),
(624, 1341152329, '127.0.0.1', 'DfWH1MTW'),
(623, 1341152323, '127.0.0.1', 'HSCKInhh'),
(622, 1341152284, '127.0.0.1', 'uTdF22CQ'),
(621, 1341152263, '127.0.0.1', 'pq884mft'),
(618, 1341151696, '127.0.0.1', 'Clye9Vpx'),
(615, 1340376724, '127.0.0.1', 'TkFXKyAc'),
(616, 1340377208, '127.0.0.1', '6bDHnu6O'),
(617, 1340379516, '127.0.0.1', 'DxalGNhO'),
(620, 1341152246, '127.0.0.1', '3puz5tKS'),
(619, 1341152058, '127.0.0.1', 'xQipGKX2'),
(610, 1339945029, '127.0.0.1', 'BlrZfi6G'),
(614, 1340376179, '127.0.0.1', 'PlR10bV8'),
(613, 1340375992, '127.0.0.1', 'mJ9gp8oj'),
(612, 1340365494, '127.0.0.1', 'G1chyfoI'),
(611, 1340179821, '127.0.0.1', 'l00E9xAQ'),
(605, 1338796882, '127.0.0.1', 'LCipU8NQ'),
(604, 1338791044, '127.0.0.1', 'jqAvFJZ1'),
(609, 1339771023, '127.0.0.1', '9lETnku3'),
(608, 1339254396, '127.0.0.1', 'Bhlsmg2r'),
(607, 1339118884, '127.0.0.1', 'lI9eVTmA'),
(606, 1338796892, '127.0.0.1', 'PdFTtx2V'),
(631, 1341152341, '127.0.0.1', 'jQ6eSqNn'),
(632, 1341152342, '127.0.0.1', 'Kd1OnB8H'),
(633, 1341152343, '127.0.0.1', 'ZW1Z39Dn'),
(634, 1341152344, '127.0.0.1', 'Aw8gLWqu'),
(635, 1341152345, '127.0.0.1', 'Ocy9GWG0'),
(636, 1341152349, '127.0.0.1', 'rEfDmchi'),
(637, 1341152351, '127.0.0.1', 'fuYDrI9w'),
(638, 1341152352, '127.0.0.1', 'DPgUaUPi'),
(639, 1341152353, '127.0.0.1', 'aqx8j3S0'),
(640, 1341152354, '127.0.0.1', 'C29Ca99B'),
(641, 1341152355, '127.0.0.1', '4IdFmjoK'),
(642, 1341152359, '127.0.0.1', '1e8z555B'),
(643, 1341152360, '127.0.0.1', 'T7Vic6u8'),
(644, 1341152362, '127.0.0.1', 'WPEVJUns'),
(645, 1341152363, '127.0.0.1', 'U7YE141e'),
(646, 1341152365, '127.0.0.1', 'VV6iT5UO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses`
--

CREATE TABLE IF NOT EXISTS `tbl_akses` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `tbl_akses`
--

INSERT INTO `tbl_akses` (`id_user`, `nip`, `nama_user`, `jabatan`, `jenis_kelamin`, `status`, `username`, `password`) VALUES
(1, '-', 'Ardiansyah', 'Admin', 'Laki-laki', 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, '19910617 198510 1 001', 'didi', 'Kapala Puskesmas', 'Laki-laki', 'Pimpinan', 'wawan', '0a000f688d85de79e3761dec6816b2a5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori` (
  `id_kategori` int(4) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'TABLET KERAS'),
(2, 'SYRUP BEBAS'),
(5, 'KOSMETIK'),
(6, 'GENERIK'),
(7, 'SACHET BEBAS'),
(8, 'OBAT KUMUR'),
(9, 'ANASTETIK'),
(10, 'DIURETIK'),
(11, 'Antiparkinson');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE IF NOT EXISTS `tbl_obat` (
  `id_obat` int(3) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(3) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `produsen` varchar(50) NOT NULL,
  `distributor` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_beli` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `stok` int(5) NOT NULL,
  `expired` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_edit` date NOT NULL,
  `counter` int(5) NOT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`id_obat`, `id_kategori`, `nama_obat`, `kode_obat`, `produsen`, `distributor`, `satuan`, `harga_beli`, `harga`, `stok`, `expired`, `tgl_masuk`, `tgl_edit`, `counter`) VALUES
(1, 10, 'ABATE 1G', 'ABAT-1G', 'BASF INDONESIA', 'PT.KF', 'Botol', '2727', '5000', 12, '0000-00-00', '2015-11-29', '0000-00-00', 26),
(2, 9, '3TC-HBV TM', '3TC-HBV', 'GLAXO', 'STOK AWAL', 'PCS', '33482', '41853', 25, '0000-00-00', '2015-11-29', '0000-00-00', 38),
(3, 1, 'ABDELYN DROP 10ML', 'ABD', 'CORONET', 'PT.BANYUMAS', 'PCS', '16500', '18150', 10, '0000-00-00', '2015-10-01', '0000-00-00', 13),
(4, 7, 'ABSOLUTE FEMININE 60ML', '8,99342E+12', 'KINOCARE ERA', 'PT.SSI', 'PCS', '12272', '13500', 11, '0000-00-00', '2015-12-01', '2015-12-01', 35),
(5, 11, 'Relaxa', 'K00E', 'PT.GIGI', 'PT.Pepsodent', 'Botol', '15000', '17000', 20, '0000-00-00', '2015-12-01', '2015-12-01', 8),
(6, 1, 'ACRAN 150', 'ACR-150', 'SANBE', 'PT.BSP', 'PCS', '7500', '8700', 22, '0000-00-00', '2015-12-01', '2015-12-01', 10),
(12, 10, 'Suplmen', '09K001', 'PT.GIGI', 'PT.BSP', 'PCS', '15000', '17000', 30, '0000-00-00', '2015-12-05', '2015-12-05', 0),
(13, 10, 'Adem Sari', 'AS-001', 'PT.GIGI', 'PT.BSP', 'Botol', '15000', '17000', 30, '2015-12-05', '2015-12-05', '2015-12-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub`
--

CREATE TABLE IF NOT EXISTS `tbl_sub` (
  `id_sub` int(4) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(4) NOT NULL,
  `nama_sub` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_sub`
--

INSERT INTO `tbl_sub` (`id_sub`, `id_kategori`, `nama_sub`) VALUES
(1, 7, 'Panasilin'),
(2, 8, 'Betadin'),
(3, 8, 'Acetosal'),
(4, 8, 'Tramadol'),
(5, 8, 'Parasetamol'),
(6, 9, 'Cetrizin'),
(7, 9, 'Deksametason'),
(8, 9, 'Dipenhidramin'),
(9, 9, 'Klorpheniramin'),
(10, 10, 'Furosemida'),
(11, 10, 'HCT'),
(12, 10, 'Manitol'),
(13, 10, 'Spironolakton');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE IF NOT EXISTS `tbl_transaksi` (
  `id_transaksi` int(20) NOT NULL AUTO_INCREMENT,
  `id_obat` int(4) NOT NULL,
  `id_kategori` int(4) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(5) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_obat`, `id_kategori`, `nama`, `jenis_kelamin`, `tanggal`, `jumlah`) VALUES
(39, 1, 10, 'budi', '', '2015-11-30', 5),
(37, 1, 10, 'Muhammad Iksan', '', '2015-10-26', 6),
(38, 1, 10, 'Wawan', '', '2015-11-30', 3),
(36, 4, 7, 'Mardiana', '', '2015-11-28', 5),
(35, 1, 10, 'Wanda', '', '2015-11-28', 4),
(34, 4, 7, 'Suhardi', '', '2015-11-27', 5),
(33, 1, 10, 'Rahmad Kurniawan', '', '2015-11-28', 3),
(32, 1, 10, 'Firman', '', '2015-11-28', 5),
(40, 2, 9, 'Daud Harahap', '', '2015-12-01', 3),
(42, 2, 9, 'Ranga', '', '2015-12-01', 2),
(43, 5, 11, 'Bogah', '', '2015-12-01', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
