-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2015 at 12:24 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sensuspenduduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama`, `alamat`, `telepon`, `jenis_kelamin`, `email`, `username`, `password`) VALUES
('Reja Abdillah', 'Bandung', '0226641494', 'Laki - lak', 'reja.abdillah@gmail.com', 'abdillah', '1123109');

-- --------------------------------------------------------

--
-- Table structure for table `grafik_sensus`
--

CREATE TABLE IF NOT EXISTS `grafik_sensus` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `sensus` varchar(255) NOT NULL,
  `keluarga` int(11) NOT NULL,
  `penduduk` int(11) NOT NULL,
  `Penduduk_lahir` int(11) NOT NULL,
  `Penduduk_meninggal` int(11) NOT NULL,
  `Penduduk_pendatang` int(11) NOT NULL,
  `Penduduk_pindah` int(11) NOT NULL,
  PRIMARY KEY (`nomor`),
  KEY `bagian` (`sensus`,`keluarga`,`penduduk`,`Penduduk_lahir`,`Penduduk_meninggal`,`Penduduk_pendatang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `grafik_sensus`
--

INSERT INTO `grafik_sensus` (`nomor`, `sensus`, `keluarga`, `penduduk`, `Penduduk_lahir`, `Penduduk_meninggal`, `Penduduk_pendatang`, `Penduduk_pindah`) VALUES
(2, 'Keluarga', 1, 0, 0, 0, 0, 0),
(7, 'Penduduk', 0, 1, 0, 0, 0, 0),
(8, 'Penduduk lahir', 0, 0, 0, 0, 0, 0),
(9, 'Penduduk meninggal', 0, 0, 0, 0, 0, 0),
(10, 'Penduduk pendatang', 0, 0, 0, 0, 0, 0),
(11, 'Penduduk pindah', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelahiranpenduduk`
--

CREATE TABLE IF NOT EXISTS `kelahiranpenduduk` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NSKL` int(30) NOT NULL,
  `NKK` int(30) NOT NULL,
  `alamat` text NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `waktu_lahir` time NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `agama` varchar(15) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE IF NOT EXISTS `keluarga` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NKK` int(30) NOT NULL,
  `NIK` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(15) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `status_perkawinan` varchar(15) NOT NULL,
  `hubungan_keluarga` varchar(25) NOT NULL,
  `kewarganegaraan` varchar(25) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kematianpenduduk`
--

CREATE TABLE IF NOT EXISTS `kematianpenduduk` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NSKM` int(30) NOT NULL,
  `NKK` int(30) NOT NULL,
  `alamat` text NOT NULL,
  `NIK` int(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tempat_meninggal` varchar(20) NOT NULL,
  `tanggal_meninggal` date NOT NULL,
  `waktu_meninggal` time NOT NULL,
  `sebab_meninggal` varchar(100) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pkp`
--

CREATE TABLE IF NOT EXISTS `laporan_pkp` (
  `nomor_laporan` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_penduduk` int(15) NOT NULL,
  `jumlah_pkp` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_ppp`
--

CREATE TABLE IF NOT EXISTS `laporan_ppp` (
  `nomor_laporan` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_penduduk` int(15) NOT NULL,
  `jumlah_pp` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pppa`
--

CREATE TABLE IF NOT EXISTS `laporan_pppa` (
  `nomor_laporan` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_penduduk` int(15) NOT NULL,
  `jumlah_PPPA` int(15) NOT NULL,
  `Keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pppt`
--

CREATE TABLE IF NOT EXISTS `laporan_pppt` (
  `nomor_laporan` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_penduduk` int(15) NOT NULL,
  `jumlah_ppt` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pprp`
--

CREATE TABLE IF NOT EXISTS `laporan_pprp` (
  `nomor_laporan` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_penduduk` int(15) NOT NULL,
  `jumlah_prp` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE IF NOT EXISTS `penduduk` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tempat_lahir` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal_lahir` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `jenis_kelamin` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `agama` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `status_perkawinan` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `pekerjaan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kewarganegaraan` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=65 ;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nomor`, `NIK`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `agama`, `status_perkawinan`, `pekerjaan`, `kewarganegaraan`, `foto`) VALUES
(64, '3303', 'erwin', 'Bandung', '2015-08-07', 'Laki - laki', 'Cijerokaso', 'Islam', 'Belum kawin', 'Mahasiswa', 'WNI', '9pPIWQuJ1r.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pendudukdatang`
--

CREATE TABLE IF NOT EXISTS `pendudukdatang` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NSKD` int(30) NOT NULL,
  `NKK` int(30) NOT NULL,
  `alamat` text NOT NULL,
  `NIK` int(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `hubungan_keluarga` varchar(25) NOT NULL,
  `alasan_datang` varchar(50) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `tanggal_datang` date NOT NULL,
  `klasifikasi_pindah` varchar(15) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pendudukpindah`
--

CREATE TABLE IF NOT EXISTS `pendudukpindah` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `NSKP` int(30) NOT NULL,
  `NKK` int(30) NOT NULL,
  `NIK` int(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `hubungan_keluarga` varchar(25) NOT NULL,
  `alasan_pindah` varchar(50) NOT NULL,
  `alamat_pindah` text NOT NULL,
  `tanggal_pindah` date NOT NULL,
  `klasifikasi_pindah` varchar(15) NOT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE IF NOT EXISTS `penyewa` (
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`nama`, `alamat`, `telepon`, `jenis_kelamin`, `email`, `username`, `password`) VALUES
('Reja Abdillah', 'Bandung', '085700000000', 'pria', 'reja.abdillah@gmail.com', 'reja', '1123109');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `komentar` text NOT NULL,
  PRIMARY KEY (`id_komentar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_komentar`, `nama`, `email`, `komentar`) VALUES
(1, 'Danu', 'reja.abdillah@gmail.com', 'Bagus'),
(2, 'dani', 'reja.abdillah@gmail.com', 'Bagus'),
(3, 'Krisna', 'reja.abdillah@gmail.com', 'Sangat bagus'),
(4, 'Vina', 'reja.abdillah@gmail.com', 'Keren'),
(5, 'Alifa', 'reja.abdillah@gmail.com', 'A Reja ganteng');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
