-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 02:29 PM
-- Server version: 10.1.36-MariaDB
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
-- Database: `etpay_001.db.all`
--

-- --------------------------------------------------------

--
-- Table structure for table `etpay_001_users_list`
--

CREATE TABLE `etpay_001_users_list` (
  `user_id` int(255) NOT NULL,
  `First Name` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Fathers Name` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Last Name` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `ATM_number` int(16) NOT NULL,
  `ATM_PIN_Hashed` int(255) NOT NULL,
  `Bank_Name` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `City` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Subcity` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Woreda` int(4) NOT NULL,
  `Phone_number` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `etpay_001_users_list`
--

INSERT INTO `etpay_001_users_list` (`user_id`, `First Name`, `Fathers Name`, `Last Name`, `ATM_number`, `ATM_PIN_Hashed`, `Bank_Name`, `Email`, `City`, `Subcity`, `Woreda`, `Phone_number`) VALUES
(1, 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 0, 0, 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 0, '0'),
(2, 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 1, 1, 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 2, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `etpay_001_users_list`
--
ALTER TABLE `etpay_001_users_list`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `etpay_001_users_list`
--
ALTER TABLE `etpay_001_users_list`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
