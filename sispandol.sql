-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: localhost
-- Waktu pembuatan: 19 Jun 2019 pada 16.04
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `sispandol`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin Adriano', 'adminweb', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `id_bank` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(100) NOT NULL,
  `nama_pemilik` varchar(250) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id_bank`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`, `nama_pemilik`, `no_rekening`, `gambar`) VALUES
(1, 'BCA', 'Muhamad Rezki', '64534242342', 'aa9d3ec4243250956a314578ff477f1b.png'),
(2, 'Mandiri', 'Muhamad Rezki', '24523523523', 'ef548aea6b56db9a723f9c7ac91d46da.png'),
(3, 'BRI', 'Muhamad Rezki', '345353453234', '778473b7e82f9e47ba2c284eb60a6dfb.png'),
(4, 'BRI Syariah', 'Muhamad Rezki', '9823745235224', 'b8a5a05025b265f80b85ec7f2494e367.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pesanan`
--

CREATE TABLE IF NOT EXISTS `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesanan` varchar(20) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `jenis_pesanan` varchar(20) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `biaya` double NOT NULL,
  `pesan` text NOT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `kode_pesanan`, `id_toko`, `jenis_pesanan`, `ukuran`, `biaya`, `pesan`) VALUES
(5, 'PSN00001', 14, 'Spanduk', '3x2', 30000, 'tes pesan'),
(6, 'PSN00002', 13, 'Spanduk', '3x2', 33000, 'tes pesan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toko`
--

CREATE TABLE IF NOT EXISTS `tbl_toko` (
  `id_toko` int(11) NOT NULL AUTO_INCREMENT,
  `kode_toko` varchar(20) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `harga` bigint(15) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  PRIMARY KEY (`id_toko`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `tbl_toko`
--

INSERT INTO `tbl_toko` (`id_toko`, `kode_toko`, `nama_toko`, `harga`, `gambar`) VALUES
(10, 'BMW00003', 'Aturae', 6500, '2fe209c8765643a57b7deee713566981.png'),
(11, 'BMW00004', 'CMYK Printing', 6500, '62c9dfddb4c81af2efdf9015babadffa.jpg'),
(12, 'BMW00005', 'Puri Printing', 6000, 'fae0ac406967038476a93c87ed271686.jpg'),
(13, 'BMW00006', 'Nissa Grafika Offset', 5500, 'fd17d6fead48e6e4009a0682ffc3fe70.png'),
(14, 'BMW00007', 'Grintara', 5000, '57a98c35a2d3ca82054ad0b7a3a254f7.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_users` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(25) NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `username`, `email`, `password`, `nama_users`, `phone`, `alamat`, `provinsi`, `kota`) VALUES
(7, 'rororoy21', 'muhamad.rezki@students.uin-suska.ac.id', '0de26253504e26205a09f7965614ed29', 'Muhamad Rezki', '085263014676', 'JL. MERPATI SAKTI', 'Riau', 'Pekanbaru'),
(10, 'manyu', 'manyu@gmail.com', '8d1060a3ed4aaa3f7c8c3e6ed0716f89', 'Manyu', '08526301947', 'JL JL', 'Riau', 'Pekanbaru');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
