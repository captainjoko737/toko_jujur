-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2019 at 04:52 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_jujur`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kedatangan` time DEFAULT NULL,
  `masa_aktif` datetime DEFAULT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `id_user`, `kedatangan`, `masa_aktif`, `active`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, '20:49:59', '2019-04-27 02:49:59', 'Y', '2019-04-26', '2019-04-26 13:49:59', '2019-04-26 13:49:59'),
(2, 1, '20:50:18', '2019-04-27 02:50:18', 'Y', '2019-04-26', '2019-04-26 13:50:18', '2019-04-26 13:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode` text NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `harga` int(6) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `berat` varchar(50) DEFAULT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode`, `nama`, `harga`, `stok`, `berat`, `active`, `created_at`, `updated_at`) VALUES
(1, '78321789123', 'Magnum Filter', 18000, 12, '4 KG', 'Y', '2019-04-26 14:23:42', '2019-04-26 14:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `quantity` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saldo_user`
--

CREATE TABLE `saldo_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo_user`
--

INSERT INTO `saldo_user` (`id`, `id_user`, `saldo`, `created_at`, `updated_at`) VALUES
(1, 1, 400000, '2019-04-26 13:58:02', '2019-04-26 13:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int(11) DEFAULT NULL,
  `active` enum('Y','N') DEFAULT 'Y',
  `quantity` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_voucher`
--

CREATE TABLE `transaksi_voucher` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_voucher` varchar(30) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `username` varchar(150) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jenis_kelamin` enum('P','W') NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `access` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `nama`, `alamat`, `jenis_kelamin`, `active`, `access`, `created_at`, `updated_at`) VALUES
(1, 'sikunyuk@gmail.com', '$2y$10$0Ep1QVWD/l.jGRIJA1e01ebTK/opVFOcu4LHwpVWz5Nc/rq68mNw.', 'sikunyuk', 'M Fathurohman', 'Jalan Panyileukan 1 No 11', 'P', 'Y', 0, '2019-04-26 12:33:57', '2019-04-26 12:33:57'),
(2, 'user2@gmail.com', '$2y$10$WRxGz3JyjhT39BnAr6eoK.UMuF.0Bjz0eLsgPl.nIT8uU6afwTqfS', 'user2', 'user dua', 'pondok kacang', 'P', 'Y', 0, '2019-04-26 06:14:11', '2019-04-26 06:14:11'),
(3, 'user3@gmail.com', '$2y$10$a2CQBOFFcXjT8dZyyMccs.4o3LwE3yltWXlmmLZN/uhtHFNiyp6a2', 'user3', 'user tiga', 'pondok kacang', 'P', 'Y', 0, '2019-04-26 06:16:34', '2019-04-26 06:16:34'),
(4, 'user4@gmail.com', '$2y$10$lAX..ap.YZeGp/3RJk1Iqe9saTyERHxRl9hZ21RqvxWuSBUFbQtIi', 'user4', 'user empat', 'pondok kacang', 'P', 'Y', 0, '2019-04-26 13:18:38', '2019-04-26 13:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` varchar(30) NOT NULL,
  `value` int(6) NOT NULL,
  `active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_antrian_user` (`id_user`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_keranjang_user` (`id_user`),
  ADD KEY `FK_keranjang_barang` (`id_barang`);

--
-- Indexes for table `saldo_user`
--
ALTER TABLE `saldo_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_saldo_user_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transaksi_user` (`id_user`),
  ADD KEY `FK_transaksi_barang` (`id_barang`);

--
-- Indexes for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_transaksi_voucher_user` (`id_user`),
  ADD KEY `FK_transaksi_voucher_voucher` (`id_voucher`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saldo_user`
--
ALTER TABLE `saldo_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `FK_antrian_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_keranjang_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `saldo_user`
--
ALTER TABLE `saldo_user`
  ADD CONSTRAINT `FK_saldo_user_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_transaksi_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`);

--
-- Constraints for table `transaksi_voucher`
--
ALTER TABLE `transaksi_voucher`
  ADD CONSTRAINT `FK_transaksi_voucher_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_transaksi_voucher_voucher` FOREIGN KEY (`id_voucher`) REFERENCES `voucher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
