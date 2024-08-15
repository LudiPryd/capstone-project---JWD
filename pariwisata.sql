-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 04:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pariwisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `durasi` int(30) NOT NULL,
  `wisata` varchar(100) NOT NULL,
  `layanan_penginapan` tinyint(1) NOT NULL,
  `layanan_transportasi` tinyint(1) NOT NULL,
  `layanan_makanan` tinyint(1) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `tagihan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `nama`, `no_hp`, `tgl_mulai`, `tgl_pemesanan`, `durasi`, `wisata`, `layanan_penginapan`, `layanan_transportasi`, `layanan_makanan`, `jumlah`, `harga`, `tagihan`) VALUES
(14, 'cantiqa', '123123', '2024-08-15', '0000-00-00 00:00:00', 4, 'Pesona Sampalan Indah Citalutug', 0, 0, 1, 3, 510000, 1530000),
(16, 'ludi', '0891231', '2024-08-15', '0000-00-00 00:00:00', 2, 'Glamping Mini Citalutug', 0, 0, 0, 2, 125000, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$spUyrxbdDR7esaz/A696YuU0klTeMeeVGTiyD2cOk9GQUhKxSw9ra', 'admin'),
(2, 'user', '$2y$10$VvG6f8iW9m58CYfWKX5Uq.3yTz3.MQFHa.lRn0OPjMbH38gGZGEh.', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
