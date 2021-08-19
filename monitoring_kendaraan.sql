-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 02:25 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_pemesanan`
--

CREATE TABLE `histori_pemesanan` (
  `id_histori` int(11) NOT NULL,
  `id_pemesanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_pemesanan`
--

INSERT INTO `histori_pemesanan` (`id_histori`, `id_pemesanan`) VALUES
(2, 6),
(4, 9),
(5, 10),
(6, 11),
(7, 12);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `no_pol` varchar(20) NOT NULL,
  `jenis_kendaraan` tinyint(3) NOT NULL COMMENT '1=Angkutan orang, 2=Angkutan barang',
  `is_ready` tinyint(3) NOT NULL COMMENT '0=Terpakai, 1=Ready, 2=Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `nama_kendaraan`, `no_pol`, `jenis_kendaraan`, `is_ready`) VALUES
(1, 'Honda Civic Turbo', 'S 1704 YAN', 1, 1),
(2, 'Toyota GT 86', 'D 14 N', 1, 1),
(3, 'Truck Fuso FE 73', 'N 413 I', 2, 1),
(6, 'Suzuki Carry Pickup', 'S 1872 ID', 2, 1),
(8, 'BMW M2', 'Y 4 N', 1, 1),
(9, 'Truck Fuso FE 71', 'N 8191 UL', 2, 1),
(10, 'Mercedes Benz SLS AMG', 'W 00 W', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `waktu_pemesanan` time NOT NULL,
  `lama_pemesanan` double NOT NULL,
  `nama_driver` varchar(100) NOT NULL,
  `penyetuju` int(11) NOT NULL,
  `verifikasi` tinyint(2) NOT NULL COMMENT '0=Ditolak, 1=Disetujui, 2=Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_kendaraan`, `tgl_pemesanan`, `waktu_pemesanan`, `lama_pemesanan`, `nama_driver`, `penyetuju`, `verifikasi`) VALUES
(6, 1, '2021-08-20', '06:30:00', 28, 'Four', 4, 1),
(7, 8, '2021-08-31', '20:00:00', 12, 'Daniel', 4, 0),
(9, 1, '2021-08-14', '18:57:00', 12, 'Umar', 4, 1),
(10, 1, '2021-09-16', '13:55:00', 65, 'Fuad', 3, 1),
(11, 6, '2021-11-17', '03:56:00', 4, 'Aris', 3, 1),
(12, 10, '2021-10-07', '10:15:00', 7, 'Syarif', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_user` tinyint(3) NOT NULL COMMENT '1=Admin, 2=Atasan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level_user`) VALUES
(1, 'Dian F. Arif', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'Muhammad Middin', 'atasan', '221ef2597affd3f083ac94af9e1b1e7f', 2),
(3, 'M. Nanda Alifa Al-Khulaifi', 'nanda', '859a37720c27b9f70e11b79bab9318fe', 2),
(4, 'M. Azka Linnajah', 'azka', 'cac4ad62a53731fc058f16a244d5a3cb', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_pemesanan`
--
ALTER TABLE `histori_pemesanan`
  ADD PRIMARY KEY (`id_histori`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `penyetuju` (`penyetuju`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_pemesanan`
--
ALTER TABLE `histori_pemesanan`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori_pemesanan`
--
ALTER TABLE `histori_pemesanan`
  ADD CONSTRAINT `histori_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`),
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`penyetuju`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
