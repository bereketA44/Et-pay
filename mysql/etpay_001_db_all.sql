-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2020 at 12:26 PM
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
-- Table structure for table `Etpay_01_all_users`
--

CREATE TABLE `Etpay_01_all_users` (
  `user_id` int(255) NOT NULL,
  `FirstName` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `FathersName` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `LastName` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `ATM_number` varchar(17) COLLATE utf8_unicode_520_ci NOT NULL,
  `ATM_PIN_Hashed` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `CVV` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `Exp_date` varchar(8) COLLATE utf8_unicode_520_ci NOT NULL,
  `Bank_Name` varchar(60) COLLATE utf8_unicode_520_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_520_ci NOT NULL,
  `City` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Subcity` varchar(30) COLLATE utf8_unicode_520_ci NOT NULL,
  `Woreda` int(4) NOT NULL,
  `Phone_number` varchar(14) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `Etpay_01_all_users`
--

INSERT INTO `Etpay_01_all_users` (`user_id`, `FirstName`, `FathersName`, `LastName`, `ATM_number`, `ATM_PIN_Hashed`, `CVV`, `Exp_date`, `Bank_Name`, `Email`, `City`, `Subcity`, `Woreda`, `Phone_number`) VALUES
(1, 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', '0', '0', '', '0000-00-', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 'AAdmin_ETPAY', 0, '0'),
(2, 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', '123', '1', '', '0000-00-', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2-01', 'AAdmin_ETPAY2', 'AAdmin_ETPAY2', 2, '1'),
(3, 'Admin', 'Admin', 'Admin', '0', '0', '', '0000-00-', 'Admin', 'Admin', 'Admin', 'Admin', 0, '0'),
(29, 'Bereket', 'bereket', 'bereket', '0111111111111111', '$argon2i$v=19$m=1024,t=2,p=2$WkEvZmxwbXNnVzVZcW5tLw$LV1Zda34Sk2SVKQ/VigNLSwckpgMyf2zzp2Zfue5nZs', '123', '13/12', 'Abay Bank', 'bereketababub@gmail.com', 'bereket', 'bereket', 13, '13');

-- --------------------------------------------------------

--
-- Table structure for table `Etpay_02_registered`
--

CREATE TABLE `Etpay_02_registered` (
  `Reg_id` int(255) NOT NULL,
  `User_id` int(255) NOT NULL,
  `User_name` varchar(15) COLLATE utf8_unicode_520_ci NOT NULL,
  `password_hashed` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `is_email_sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `Etpay_02_registered`
--

INSERT INTO `Etpay_02_registered` (`Reg_id`, `User_id`, `User_name`, `password_hashed`, `is_email_sent`) VALUES
(34, 29, 'berber-d188', '$argon2i$v=19$m=1024,t=2,p=2$YzdWYTZ4VWZNRjlmNy52VQ$Eq3NAFNo4fPLXeK397tIKI3PD7H+kW/x3F0Ed8TieCA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Etpay_03_sessions`
--

CREATE TABLE `Etpay_03_sessions` (
  `Sid` int(11) NOT NULL,
  `Uid` int(255) NOT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL,
  `Session_Value` varchar(255) COLLATE utf8_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_520_ci;

--
-- Dumping data for table `Etpay_03_sessions`
--

INSERT INTO `Etpay_03_sessions` (`Sid`, `Uid`, `session_id`, `Session_Value`) VALUES
(114, 29, '?##08-029_?(#002)00046?@12876*(10021)?0007258_0045', 'd677db70bc4eef4df9618a16d4ef96d0b633a44fa6cffcf64d9070083d2dc004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Etpay_01_all_users`
--
ALTER TABLE `Etpay_01_all_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `Etpay_02_registered`
--
ALTER TABLE `Etpay_02_registered`
  ADD PRIMARY KEY (`Reg_id`),
  ADD KEY `registered_fk_1` (`User_id`);

--
-- Indexes for table `Etpay_03_sessions`
--
ALTER TABLE `Etpay_03_sessions`
  ADD PRIMARY KEY (`Sid`),
  ADD UNIQUE KEY `Uid` (`Uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Etpay_01_all_users`
--
ALTER TABLE `Etpay_01_all_users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `Etpay_02_registered`
--
ALTER TABLE `Etpay_02_registered`
  MODIFY `Reg_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Etpay_03_sessions`
--
ALTER TABLE `Etpay_03_sessions`
  MODIFY `Sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Etpay_02_registered`
--
ALTER TABLE `Etpay_02_registered`
  ADD CONSTRAINT `registered_fk_1` FOREIGN KEY (`User_id`) REFERENCES `etpay_01_all_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Etpay_03_sessions`
--
ALTER TABLE `Etpay_03_sessions`
  ADD CONSTRAINT `session_fk_1` FOREIGN KEY (`Uid`) REFERENCES `Etpay_01_all_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
