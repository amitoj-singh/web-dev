-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2019 at 04:15 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `AmiDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `reg_users`
--

CREATE TABLE `reg_users` (
  `id` int(12) NOT NULL,
  `name` varchar(30) NOT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_number` bigint(20) DEFAULT NULL,
  `email` varchar(36) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `pincode` int(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `course` varchar(30) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_users`
--

INSERT INTO `reg_users` (`id`, `name`, `father_name`, `username`, `password`, `mobile_number`, `email`, `state`, `city`, `address`, `pincode`, `dob`, `course`, `gender`, `profile_pic`, `hobby`) VALUES
(56, 'test1', 'wwe', 'hjgjh', '202cb962ac59075b964b07152d234b70', 4567894521, 'fgd@ghjg.hg', 'Arunachal Pradesh', 'Chandigarh', '5456', 65465, '2009-09-22', 'B.Sc', 'Male', 'test1_1560409728.png', 'outdoor games, riding'),
(58, 'test3', 'wwe', 'dssf', '202cb962ac59075b964b07152d234b70', 4865975234, 'fgd@ghjg.hg', 'Arunachal Pradesh', 'Chandigarh', '5456', 65465, '2009-09-22', 'B.Sc', 'other', 'test3_1560409778.png', 'outdoor games, coding, Other'),
(62, 'dfwf', 'ewffe', 'ewfwe', '202cb962ac59075b964b07152d234b70', 5555555555, 'fwf@gmail.com', 'Arunachal Pradesh', 'Zirakpur', '545', 465845, '2004-05-16', 'M.Sc', 'Male', 'dfwf_1560415300.png', 'coding, riding'),
(63, 'vedikaa', 'adsa', 'sdsaa', '202cb962ac59075b964b07152d234b70', 4569852364, 'vaedika@gmail.coma', 'Arunachal Pradesh', 'Chandigarh', '45A', 546542, '2019-06-04', 'B.Sc', 'Female', 'vedika_1560757970.png', 'outdoor games, indoor games'),
(64, 'vedika', NULL, 'root', 'c4ca4238a0b923820dcc509a6f75849b', 4567891230, 'vedi12ka@gmail.com', 'Arunachal Pradesh', 'Chandigarh', '435C', NULL, NULL, 'M.Sc', 'Male', 'vedika_1560758748.png', 'outdoor games, indoor games'),
(65, 'wqewe', NULL, 'wqewqe', 'c4ca4238a0b923820dcc509a6f75849b', 1234667890, 'wqewqewqe@fdgdgfd.fsdf', 'Andhra Pradesh', 'Mohali', 'sd', NULL, NULL, 'M.Sc', 'Male', 'wqewe_1560759809.png', 'indoor games'),
(68, 'dfdf', NULL, 'faadf', 'c4ca4238a0b923820dcc509a6f75849b', 4658975231, 'asdsad@gmfk.com', 'Haryana', 'Panchkula', '1255 B block panchkula', NULL, NULL, 'M.Tech', 'Male', 'dfdf_1560765176.png', 'coding, riding'),
(69, 'vaibhav', NULL, 'vaibhav', '25d55ad283aa400af464c76d713c07ad', 8465233156, 'vaibhav.99@gmail.com', 'Punjab', 'Mohali', '34, sector 70', NULL, NULL, 'B.Tech', 'Male', 'vaibhav_1560919340.png', 'coding, riding'),
(70, 'mohit', NULL, 'mohit001', '25d55ad283aa400af464c76d713c07ad', 9655325222, 'mohit.001@gmail.com', 'Punjab', 'Zirakpur', '65, sector 20', NULL, NULL, 'M.Sc', 'Male', 'mohit_1560930365.png', 'indoor games, coding, Other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reg_users`
--
ALTER TABLE `reg_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reg_users`
--
ALTER TABLE `reg_users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
