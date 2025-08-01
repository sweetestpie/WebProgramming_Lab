-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2025 at 08:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(11) NOT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Customer_Lastname` varchar(100) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Age` int(11) NOT NULL,
  `Birthdate` varchar(10) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Province` varchar(50) NOT NULL,
  `Zipcode` varchar(5) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Customer_Description` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Customer_Name`, `Customer_Lastname`, `Gender`, `Age`, `Birthdate`, `Address`, `Province`, `Zipcode`, `Telephone`, `Customer_Description`, `username`, `password`) VALUES
(1, 'test', 'testest', 'ชาย', 12, '10/02/2003', '200/2000', 'เชียงใหม่', '50100', '0910789898', 'ไยย', '8', '8'),
(2, 'พานพลอย', 'รักปัญญา', 'ชาย', 0, '2006-01-16', '499', 'เชียงใหม่', '50100', '0910789898', '1111111', 'ploy', '$2y$10$tTQRh/tmyQJATrnocWcK..QOBP.382gZ4xt70vacPFSZXkNbkq/nG'),
(3, 'Panploy', 'Rakpanya', 'หญิง', 0, '2015-06-09', '499/190', 'แม่ฮ่องสอน', '50100', '0910780000', 'ทดลองแก้ไข', 'ploy', '$2y$10$YSKEsgon7ou8CxFxRNMMAuYo3e.GcLE53wAUISkFNeNsraR2BGpwO'),
(6, 'Panploy', 'Rakpanya', 'หญิง', 0, '2025-02-26', '499', 'เชียงใหม่', 'd', '0910780000', 'พิมพ์ข้อความ12121211212', 'ploy', '$2y$10$NOJDSDskq31o/xtSlo4cMuWXMEzFw1kFsTqEZ9vOaDihAPIMMyMq6'),
(10, 'สหชา', 'อินทร์ไชย', 'ชาย', 0, '2025-02-25', 'บ้านดู่', 'เชียงราย', '50210', '0954587459', 'งับ', 'wei', '$2y$10$1V9MMd.WtnHJFGZilkT6..yKQ4xaTVEclrlYlpxn6F09cE0zNzyOO'),
(11, 'Panployddd', 'Rakpanyaddd', '', 0, '2018-01-02', 'dsafdsafsad', 'เชียงใหม่', 'ddsaf', 'sdfsadfg', 'พิมพ์ข้อความwwwww', 'wong', 'wong'),
(12, 'สมหญิง', 'สิงหยม', 'ชาย', 0, '1994-10-01', 'บ้านแด่', 'น่าน', '10000', '1234567890', 'ทดสอบ', 'root', '1234'),
(19, '0000', '1111', 'หญิง', 0, '2025-03-05', 'บ้านดู่', 'เชียงใหม่', '50100', '00000', 'พิมพ์ข้อความ', 'ploy', '0'),
(20, '00', '1111', 'หญิง', 0, '2025-03-11', 'บ้านดู่', 'เชียงใหม่', '50100', '00000', 'พิมพ์ข้อความ', 'ploy', '0'),
(21, '00', '1111', 'ชาย', 0, '2025-03-11', 'บ้านดู่', 'เชียงใหม่', '50100', '00000', 'พิมพ์ข้อความ', 'ploy', '0'),
(24, 'pam', 'Rakpanya', 'ชาย', 0, '2025-03-04', 'บ้านดู่', 'เชียงใหม่', '10020', '1234567890', 'Panploy_edit', 'ploy01', '123456789'),
(25, 'Panploy_edit', 'Rakpanya', 'หญิง', 0, '2025-02-23', 'บ้านดู่', 'เชียงใหม่', '10020', '1234567890', 'พิมพ์ข้อความ', 'ploy02', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `emp_name`, `emp_lastname`, `username`, `password`) VALUES
(1, 'Wei', 'Wong', 'root', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
