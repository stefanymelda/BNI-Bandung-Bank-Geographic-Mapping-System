-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 03:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namabank` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jam_operasional` varchar(100) NOT NULL,
  `call_center` varchar(100) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `namabank`, `alamat`, `jam_operasional`, `call_center`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(23, 'Bank BNI Jenderal Sudirmann', 'Jl. Jend. Sudirman No.331', '08.00 - 15.00', '(022) 6032078', '-6.919343883364483', '107.59261136715261', '2023-10-27 00:39:44', '2024-02-01 18:26:48'),
(24, 'Bank BNI Setiabudhi', 'Jl. Dr. Setiabudi No.188A', '08.00 - 15.00', '0896-2601-7335', '-6.869013462877962', '107.59364593122292', '2023-10-27 00:51:16', '2024-01-11 07:06:54'),
(28, 'BNI Dago', 'Jl. Ir. H. Juanda No.43', '08.00 - 15.00', '(022) 4261121', '-6.903298420953362', '107.61091539413803', '2024-01-11 07:05:06', '2024-01-11 07:05:06'),
(29, 'Bank BNI Setrasari', 'Jl. Surya Sumantri No.9, Sukawarna', '08.00 - 16.00', '1 500 046', '-6.8813500075288045', '107.58129960948055', '2024-02-01 18:29:51', '2024-02-01 18:29:51'),
(30, 'BNI Ujung Berung', 'Jl. A.H. Nasution No.89-91', '08.00 - 15.00', '(022) 4261121', '-6.913618857006256', '107.69580793847781', '2024-02-02 00:39:59', '2024-02-02 00:39:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
