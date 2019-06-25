-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2019 at 11:45 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_intan`
--
DROP DATABASE IF EXISTS `db_spk_intan`;
CREATE DATABASE IF NOT EXISTS `db_spk_intan` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `db_spk_intan`;

-- --------------------------------------------------------

--
-- Table structure for table `alternatives`
--

DROP TABLE IF EXISTS `alternatives`;
CREATE TABLE `alternatives` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `alternative_values`
--

DROP TABLE IF EXISTS `alternative_values`;
CREATE TABLE `alternative_values` (
  `id` int(10) NOT NULL,
  `alternative_id` int(10) DEFAULT NULL,
  `criteria_id` int(10) DEFAULT NULL,
  `criteria_option_id` int(10) DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

DROP TABLE IF EXISTS `criterias`;
CREATE TABLE `criterias` (
  `id` int(10) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `attribute` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `weight` decimal(7,2) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `name`, `attribute`, `weight`, `type`, `created_at`, `updated_at`) VALUES
(2, 'Harga', 'cost', '1.00', 'option', '2019-06-25 02:15:06', '2019-06-25 03:28:36'),
(3, 'RAM', 'benefit', '0.00', 'option', '2019-06-25 02:31:34', NULL),
(4, 'Memory Internal', 'benefit', '0.00', 'option', '2019-06-25 02:33:05', NULL),
(5, 'Processor', 'benefit', '0.00', 'option', '2019-06-25 02:33:41', NULL),
(6, 'Camera', 'benefit', '0.00', 'option', '2019-06-25 02:34:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_options`
--

DROP TABLE IF EXISTS `criteria_options`;
CREATE TABLE `criteria_options` (
  `id` int(10) NOT NULL,
  `criteria_id` int(10) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `value` decimal(7,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `criteria_options`
--

INSERT INTO `criteria_options` (`id`, `criteria_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(18, 3, '0 - 1 Gb', '1.00', '2019-06-25 02:31:34', NULL),
(19, 3, '2 Gb', '2.00', '2019-06-25 02:31:34', NULL),
(20, 3, '3 Gb', '3.00', '2019-06-25 02:31:34', NULL),
(21, 3, '4 Gb', '4.00', '2019-06-25 02:31:34', NULL),
(22, 3, '> 4 Gb', '5.00', '2019-06-25 02:31:34', NULL),
(23, 4, '0 - 4 Gb', '1.00', '2019-06-25 02:33:05', NULL),
(24, 4, '8 Gb', '2.00', '2019-06-25 02:33:05', NULL),
(25, 4, '16 Gb', '3.00', '2019-06-25 02:33:05', NULL),
(26, 4, '32 Gb', '4.00', '2019-06-25 02:33:05', NULL),
(27, 4, '> 32 Gb', '5.00', '2019-06-25 02:33:06', NULL),
(28, 5, 'Octa Core', '5.00', '2019-06-25 02:33:41', NULL),
(29, 5, 'Quad Core', '3.00', '2019-06-25 02:33:41', NULL),
(30, 5, 'Dual Core', '1.00', '2019-06-25 02:33:41', NULL),
(31, 6, '> 13 MP', '5.00', '2019-06-25 02:34:16', NULL),
(32, 6, '8 - 13 MP', '3.00', '2019-06-25 02:34:16', NULL),
(33, 6, '0 - 5 MP', '1.00', '2019-06-25 02:34:16', NULL),
(34, 2, '< 1 Juta', '0.75', '2019-06-25 03:28:36', NULL),
(35, 2, '1 - 3 Juta', '4.00', '2019-06-25 03:28:36', NULL),
(36, 2, '3 - 4 Juta', '3.00', '2019-06-25 03:28:36', NULL),
(37, 2, '4 - 5 Juta', '2.00', '2019-06-25 03:28:36', NULL),
(38, 2, '> 5 juta', '1.00', '2019-06-25 03:28:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_img` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `user_img`, `created_at`, `updated_at`) VALUES
(1, 'user_test', '$2y$12$T4w8xYDvZApZHt48mv9JdOs2avq7twAVxuuNkZRFx20qu8L9NgBVq', 'John Doe 123', 'john@email.com', NULL, '2019-06-16 06:28:57', '2019-06-18 03:39:17'),
(2, 'test_lagi', '$2y$12$FaWu.1kJ0hHPOve5K1djUe3H7PpMcsXS4kttqGOinmqDQsyWaMRm2', 'ini Hanya User Test Â©', 'test@email.com', 'IMG_20190617_181048.jpg', '2019-06-18 03:49:20', '2019-06-18 07:05:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alternative_values`
--
ALTER TABLE `alternative_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_options`
--
ALTER TABLE `criteria_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alternative_values`
--
ALTER TABLE `alternative_values`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `criteria_options`
--
ALTER TABLE `criteria_options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
