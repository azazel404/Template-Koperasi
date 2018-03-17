-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2017 at 10:13 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `id_anggota` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmp_lahir` varchar(30) NOT NULL,
  `j_kel` varchar(5) NOT NULL,
  `status` varchar(20) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `ket` varchar(30) NOT NULL,
  PRIMARY KEY (`id_anggota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`, `alamat`, `tgl_lahir`, `tmp_lahir`, `j_kel`, `status`, `no_telp`, `ket`) VALUES
('010203', 'Hendra', 'Bengkong', '1998-04-21', 'Batam', 'Laki', 'siswa', '088277053962', 'siswa'),
('020304', 'gunawan', 'bengkong', '1998-04-22', 'batam', 'laki', 'siswa', '088277053962', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE IF NOT EXISTS `angsuran` (
  `id_angsuran` varchar(20) NOT NULL,
  `id_katagori` varchar(20) NOT NULL,
  `id_anggota` varchar(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `angsuran_ke` varchar(20) NOT NULL,
  `besar_angsuran` varchar(50) NOT NULL,
  `ket` varchar(30) NOT NULL,
  PRIMARY KEY (`id_angsuran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `id_katagori`, `id_anggota`, `tgl_pembayaran`, `angsuran_ke`, `besar_angsuran`, `ket`) VALUES
('0101010', '003', '010203', '2000-03-21', '2', '200.000', 'lunas'),
('123932', '123923', '0203040', '2011-12-12', '3', '300.000', 'kredit');

-- --------------------------------------------------------

--
-- Table structure for table `detail_angsuran`
--

CREATE TABLE IF NOT EXISTS `detail_angsuran` (
  `id_angsuran` varchar(20) NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `besar_angsuran` varchar(30) NOT NULL,
  `ket` varchar(30) NOT NULL,
  PRIMARY KEY (`id_angsuran`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_angsuran`
--

INSERT INTO `detail_angsuran` (`id_angsuran`, `tgl_jatuh_tempo`, `besar_angsuran`, `ket`) VALUES
('12034', '2001-03-11', '300.000', 'cicil'),
('123123', '2001-11-11', '200.000', 'cicil');

-- --------------------------------------------------------

--
-- Table structure for table `katagori_pinjaman`
--

CREATE TABLE IF NOT EXISTS `katagori_pinjaman` (
  `id_katagori_pinjaman` varchar(30) NOT NULL,
  `nama_pinjaman` varchar(30) NOT NULL,
  PRIMARY KEY (`id_katagori_pinjaman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `katagori_pinjaman`
--

INSERT INTO `katagori_pinjaman` (`id_katagori_pinjaman`, `nama_pinjaman`) VALUES
('030303', 'uang tunai'),
('040404', 'uang tunai');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `Email`) VALUES
('hendra', 'hendra', ''),
('asdf', 'asdf', ''),
('asd', 'asd', 'asd'),
('gunawan', 'gunawan', 'siswa'),
('hendra123', 'hendra123', 'siswa'),
('kalo', 'kalo', 'kalo'),
('tole', 'tole', 'tole@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `petugas_koperasi`
--

CREATE TABLE IF NOT EXISTS `petugas_koperasi` (
  `id_petugas` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  PRIMARY KEY (`id_petugas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas_koperasi`
--

INSERT INTO `petugas_koperasi` (`id_petugas`, `nama`, `alamat`, `ket`) VALUES
('03043241', 'zaid', 'taman rayan', 'penjaga'),
('12394', 'erik', 'bunga raya', 'penjaga 2');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `id_pinjaman` int(20) NOT NULL,
  `nama_pinjaman` varchar(20) NOT NULL,
  `id_anggota` int(20) NOT NULL,
  `besar_pinjaman` int(30) NOT NULL,
  `tgl_pengajuan_pinjaman` date NOT NULL,
  `tgl_acc_peminjam` date NOT NULL,
  `tgl_pinjaman` date NOT NULL,
  `tgl_pelunasan` int(30) NOT NULL,
  `id_angsuran` int(30) NOT NULL,
  `ket` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pinjaman`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `nama_pinjaman`, `id_anggota`, `besar_pinjaman`, `tgl_pengajuan_pinjaman`, `tgl_acc_peminjam`, `tgl_pinjaman`, `tgl_pelunasan`, `id_angsuran`, `ket`) VALUES
(30303, 'hendra', 10203, 300, '2011-12-12', '2011-12-13', '2011-12-10', 2012, 101010, 'nihil'),
(12313, 'gunawan', 40404, 300, '2011-12-12', '2011-12-13', '2011-12-10', 2012, 1023213, 'nihil');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE IF NOT EXISTS `simpanan` (
  `id_simpanan` varchar(20) NOT NULL,
  `nm_simpanan` varchar(30) NOT NULL,
  `id_anggota` varchar(30) NOT NULL,
  `tgl_simpanan` date NOT NULL,
  `besar_simpanan` varchar(30) NOT NULL,
  `ket` varchar(50) NOT NULL,
  PRIMARY KEY (`id_simpanan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id_simpanan`, `nm_simpanan`, `id_anggota`, `tgl_simpanan`, `besar_simpanan`, `ket`) VALUES
('23819038', 'uang', '010203', '2003-12-12', '300.000', 'nihil'),
('0123123', 'uang', '030405', '2005-12-12', '500.000', 'nihil');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
