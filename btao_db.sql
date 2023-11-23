-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 12:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btao.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Id` tinyint(11) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `firstName` varchar(150) DEFAULT NULL,
  `lastName` varchar(150) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Inactive',
  `role` varchar(20) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Id`, `username`, `password`, `firstName`, `lastName`, `status`, `role`, `dateAdded`) VALUES
(3, 'admin', '12', 'Admin', 'ADmin', 'Active', 'Admin', NULL),
(4, 'officer', '655440', 'John', 'Doe', 'Inactive', 'Officer', NULL),
(5, 'mike', '339882', 'mikel', 'soms', 'Inactive', 'Staff', NULL),
(6, 'john', '123', 'nny', 'somss', 'Active', 'Staff', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Id`, `firstName`, `lastName`, `age`) VALUES
(1, 'Mike', 'Soms', 35),
(2, 'Ken', 'Est', 16),
(3, 'john', 'sub', 24);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `Id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `middleInitial` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `licenseNumber` varchar(255) DEFAULT NULL,
  `plateNumber` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`Id`, `firstName`, `lastName`, `middleInitial`, `address`, `birthday`, `licenseNumber`, `plateNumber`, `color`, `brand`, `model`) VALUES
(2, 'f', 'k', 'k', 'k', '2023-12-31', 'kjj', 'jj', 'jj', 'jj', 'jjjhhs'),
(3, 'kenneth', 'estander', 'd', 'ca', '2023-11-02', '123123', '123123', 'b', 'b', 'c'),
(4, 'mike', 'jor', 'f', 'gumamela', '1000-10-10', '1231', '123123', '3', 'd', 'a'),
(5, 'huy', 'huy', 'h', 'hauy', '1231-12-17', '12', '123123', 'b', 'b', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `driver_penalty`
--

CREATE TABLE `driver_penalty` (
  `Id` int(11) NOT NULL,
  `dateAdded` varchar(255) DEFAULT NULL,
  `officerId` int(11) DEFAULT NULL,
  `driverId` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `driver_penalty`
--

INSERT INTO `driver_penalty` (`Id`, `dateAdded`, `officerId`, `driverId`, `status`) VALUES
(5, '2023-11-16 18:17:18', 3, 2, 'Paid'),
(6, '2023-11-16 18:40:25', 3, 4, 'Pending'),
(7, '2023-11-16 18:43:17', 6, 5, 'Pending'),
(8, '2023-11-16 18:43:53', 6, 5, 'Pending'),
(9, '2023-11-16 18:58:28', 3, 2, 'Pending'),
(10, '2023-11-16 18:59:27', 3, 2, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `penalty_item`
--

CREATE TABLE `penalty_item` (
  `Id` int(11) NOT NULL,
  `violationId` int(11) DEFAULT NULL,
  `driverPenaltyId` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penalty_item`
--

INSERT INTO `penalty_item` (`Id`, `violationId`, `driverPenaltyId`, `amount`) VALUES
(1, 2, 5, NULL),
(2, 4, 5, NULL),
(3, 2, 6, NULL),
(4, 2, 7, NULL),
(5, 8, 8, NULL),
(6, 6, 9, NULL),
(7, 7, 9, NULL),
(8, 2, 10, NULL),
(9, 4, 10, NULL),
(10, 6, 10, NULL),
(11, 8, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `violation`
--

CREATE TABLE `violation` (
  `Id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `violation`
--

INSERT INTO `violation` (`Id`, `name`, `amount`) VALUES
(2, 'Illegal Parking', 1000),
(3, 'no helmet', 200),
(4, 'obstruction', 300),
(5, 'reckless', 300),
(6, 'no seatbelt', 300),
(7, 'no license', 1500),
(8, 'improper attire', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `driver_penalty`
--
ALTER TABLE `driver_penalty`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `penalty_item`
--
ALTER TABLE `penalty_item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `violation`
--
ALTER TABLE `violation`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `Id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `driver_penalty`
--
ALTER TABLE `driver_penalty`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penalty_item`
--
ALTER TABLE `penalty_item`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `violation`
--
ALTER TABLE `violation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
