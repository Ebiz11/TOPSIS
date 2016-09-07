-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2016 at 12:39 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_topsis`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_topsis`
--

CREATE TABLE `kriteria_topsis` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_topsis`
--

INSERT INTO `kriteria_topsis` (`id_kriteria`, `nama_kriteria`, `jenis`, `bobot`) VALUES
(1, 'Harga', 'cost', 4),
(2, 'Kwalitas', 'benefit', 5),
(3, 'Fitur', 'benefit', 4),
(4, 'Populer', 'benefit', 3),
(5, 'Purna Jual', 'benefit', 3),
(6, 'Keawetan', 'benefit', 2);

-- --------------------------------------------------------

--
-- Table structure for table `max_min_topsis`
--

CREATE TABLE `max_min_topsis` (
  `id_kriteria` int(11) NOT NULL,
  `nilai_max_min` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_topsis`
--

CREATE TABLE `nilai_topsis` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_topsis`
--

INSERT INTO `nilai_topsis` (`id_nilai`, `id_kriteria`, `id_produk`, `nilai`) VALUES
(1, 1, 1, 3500),
(2, 1, 2, 4500),
(3, 1, 3, 4000),
(4, 1, 4, 4000),
(6, 2, 1, 70),
(7, 2, 2, 90),
(8, 2, 3, 80),
(9, 2, 4, 70),
(11, 3, 1, 10),
(12, 3, 2, 10),
(13, 3, 3, 9),
(14, 3, 4, 8),
(16, 4, 1, 80),
(17, 4, 2, 60),
(18, 4, 3, 90),
(19, 4, 4, 50),
(21, 5, 1, 3000),
(22, 5, 2, 2500),
(23, 5, 3, 2000),
(24, 5, 4, 1500),
(26, 6, 1, 36),
(27, 6, 2, 48),
(28, 6, 3, 48),
(29, 6, 4, 60);

-- --------------------------------------------------------

--
-- Table structure for table `produk_topsis`
--

CREATE TABLE `produk_topsis` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(20) NOT NULL,
  `detail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_topsis`
--

INSERT INTO `produk_topsis` (`id_produk`, `nama_produk`, `detail`) VALUES
(1, 'Galaxy', 'Jakarta'),
(2, 'Iphone', 'Bandung'),
(3, 'BB', 'Kudus'),
(4, 'Lumia', 'Demak');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria_topsis`
--
ALTER TABLE `kriteria_topsis`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_topsis`
--
ALTER TABLE `nilai_topsis`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `produk_topsis`
--
ALTER TABLE `produk_topsis`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria_topsis`
--
ALTER TABLE `kriteria_topsis`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `nilai_topsis`
--
ALTER TABLE `nilai_topsis`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `produk_topsis`
--
ALTER TABLE `produk_topsis`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
