-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 02 Agu 2015 pada 11.25
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `ultra_cv`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id_blog` int(10) NOT NULL AUTO_INCREMENT,
  `id_category` int(10) NOT NULL,
  `judul` varchar(90) NOT NULL,
  `pengirim` varchar(20) NOT NULL,
  `img_blog` varchar(300) NOT NULL,
  `isi_blog` text NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`id_blog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`id_blog`, `id_category`, `judul`, `pengirim`, `img_blog`, `isi_blog`, `date`) VALUES
(63, 5, 'Aplikasi AR Verly Furniture', 'verlyananda', '1432651293689.jpg', 'Tugas akhir gw dulu waktu SMK, ceritanya terinspirasi dari game THE SIMS dan suka banget sama furniture2 nya THE SIMS, yaudah deh gw kepikiran bikin Augmented Reality Tentang Furniture wkwkwk', '2015-07-30 16:30:56'),
(64, 6, 'Galaxy Fit Auros Theme By Verly', 'verlyananda', '1432651301492.jpg', 'Screen shoot HP legend gw dulu dari galaxy fit ', '2015-07-30 16:32:38'),
(65, 5, 'Augmented Reality Eminem By Verly', 'verlyananda', '1432651303262.jpg', 'Projek dari mahasiswa TA suruh bikin Video Streaming tentang eminem kebetulan gw suka eminem wkwk', '2015-07-30 16:34:46'),
(66, 5, 'Augmented Reality VS Virtual Reality', 'verlyananda', '1431854973142.jpg', 'Menang mana ya gan? gak tau ane juga inimah ngetest ngetik aja sih wkwkwkwwkwkw', '2015-07-30 16:35:26'),
(67, 6, 'Android Gingberbread Is Legend', 'verlyananda', '1431163435383.jpg', 'Test aja gan,test test test test', '2015-07-31 03:50:02'),
(68, 4, 'Source Code Web Berita', 'verlyananda', 'ultraviolet_developer_web_musik.png', 'Web Berita By Ultraviolet Developer...', '2015-08-02 10:53:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(10) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(30) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(2, 'Web Design'),
(4, 'Web Development'),
(5, 'Augmented Reality'),
(6, 'Android Theme');

-- --------------------------------------------------------

--
-- Struktur dari tabel `frontend`
--

CREATE TABLE IF NOT EXISTS `frontend` (
  `id_frontend` int(30) NOT NULL AUTO_INCREMENT,
  `title_skill` varchar(60) NOT NULL,
  `link_fb` varchar(50) NOT NULL,
  `link_twit` varchar(40) NOT NULL,
  `link_google` varchar(30) NOT NULL,
  PRIMARY KEY (`id_frontend`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `frontend`
--

INSERT INTO `frontend` (`id_frontend`, `title_skill`, `link_fb`, `link_twit`, `link_google`) VALUES
(1, 'Web Developer & Augmented Reality Developer', 'www.facebook.com/v.attacx', '@verlyananda', 'verlyananda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `frontend_footer`
--

CREATE TABLE IF NOT EXISTS `frontend_footer` (
  `id_footer` int(10) NOT NULL AUTO_INCREMENT,
  `notelp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  PRIMARY KEY (`id_footer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `frontend_footer`
--

INSERT INTO `frontend_footer` (`id_footer`, `notelp`, `email`, `lokasi`, `copyright`) VALUES
(1, '089672377544 ', 'verlyananda@gmail.com', 'Cimahi,Jawa Barat', 'Copyright Ultra CV © 2015 ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `frontend_profile`
--

CREATE TABLE IF NOT EXISTS `frontend_profile` (
  `id_profile` int(20) NOT NULL AUTO_INCREMENT,
  `pengenalan` varchar(40) NOT NULL,
  `about` text NOT NULL,
  `nama` varchar(20) NOT NULL,
  `date` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `frontend_profile`
--

INSERT INTO `frontend_profile` (`id_profile`, `pengenalan`, `about`, `nama`, `date`, `alamat`, `phone`, `email`) VALUES
(1, 'Hello,Im Web Developer & AR Development', 'Perkenalkan nama saya Verly Ananda, saya tinggal di cimahi, Umur saya 18Thn baru Lulus tahun kmaren,sekarang lanjut kuliah di september 2015 ini, di universitas swasta gpp lah yg penting ngejar sarjananya hehe,hobbie saya kurang kerjaan bgt cuma ngoding2 gak bikin source code yg jelas tentunya buat portofolio nantinya, kalo ada kerjaan bikinin website /aplikasi AR orng lain, memang gak seberapa sih upahnya tp  ya gpp cari2 pengalaman dan setidaknya tidak memberatkan beban ortu, buat makan2 sendiri lah intinya ada lebihnya ya allhamduliah, gak tau mw cerita apa lagi mungkin segini aja ceritanya tentang saya, ini cuma ngetest nginput aja sih hehehe..', 'Verly Ananda', 'Bandung,Oktober 04, 1996', 'Cimahi', '089672377544 ', 'verlyananda@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE IF NOT EXISTS `portofolio` (
  `id_porto` int(10) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `completed` varchar(50) NOT NULL,
  `client` varchar(80) NOT NULL,
  `desc` text NOT NULL,
  `img_porto` varchar(400) NOT NULL,
  PRIMARY KEY (`id_porto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `portofolio`
--

INSERT INTO `portofolio` (`id_porto`, `judul`, `completed`, `client`, `desc`, `img_porto`) VALUES
(1, 'Ultraviolet Developer WEB', 'Desember 2014', 'EA GAMES', 'Ultraviolet Jasa pembuatan website dan aplikasi Augmented Reality termurah ', 'ultra.png'),
(2, 'Web Musik', 'October, 2014', 'Mahasiswa', 'tentunya buat spoiler tentang musik2 gan wkwkw', 'ultraviolet_developer_web_musik.png'),
(3, 'AR Promotion ', 'July, 28, 2015', 'Mahasiswa Univ Kristen Satya Wacana', 'Menampilan sebuah video tentang universitas tsb, melalui BROSS dan Gantungan Kunci, Diplay di Smartphone Android', 'VerlyAR.png'),
(4, 'Background Ultraviolet Iseng2 aja wkkw', 'Agustus,2015', 'Otak gw sendiri', 'gak tau ini iseng2 aja bikin backround dr photoshop wkwkwk', 'ultravioletdeveloper.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `avatar` varchar(20) NOT NULL,
  `aboutme` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `avatar`, `aboutme`) VALUES
(1, 'verlyananda', 'verlyananda', '1431163434523.jpg', 'nama gw verly ananda albalbalbalbalba');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
