-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23 Jul 2018 pada 04.53
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_admin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(4) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nama_pengguna` varchar(20) NOT NULL,
  `sandi` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki') DEFAULT NULL,
  `tgl_lahir` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama_lengkap`, `email`, `nama_pengguna`, `sandi`, `photo`, `jenis_kelamin`, `tgl_lahir`) VALUES
(12, 'nomer sekawan', 'admin@email.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'f229ab06c72149ebd75113884fa1058e.jpg', 'laki-laki', '2000-01-17'),
(13, 'pertama ', 'pertama@email.com', 'pertama', '8cb2237d0679ca88db6464eac60da96345513964', '547d603eb495feb38be430e1c8df53da.jpg', 'perempuan', '2005-02-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
