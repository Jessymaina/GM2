-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 10:24 PM
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
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MESSAGE` varchar(200) NOT NULL,
  `STATUS` int(5) NOT NULL,
  `REPLY` varchar(200) NOT NULL,
  `COUNT` int(10) NOT NULL,
  `REPLIEDBY` varchar(50) NOT NULL,
  `DATECREATED` varchar(50) NOT NULL,
  `DATEREPLIED` varchar(10) NOT NULL,
  `Action` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`NAME`, `EMAIL`, `MESSAGE`, `STATUS`, `REPLY`, `COUNT`, `REPLIEDBY`, `DATECREATED`, `DATEREPLIED`, `Action`) VALUES
('jey', 'maina@gmail.com', 'jeytech', 1, '', 6, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 7, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 8, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 9, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 10, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 11, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 12, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 13, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 14, '', '2024-02-07', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 15, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 16, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 17, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 18, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 19, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 20, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 21, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 22, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 23, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 24, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 25, '', '2024-02-08', '', ''),
('jey', 'maina@gmail.com', 'jeytech', 1, '', 26, '', '2024-02-08', '', ''),
('jecinta', 'codjecinta@gmail.com', 'i want help please', 1, '', 27, '', '2024-02-12', '', ''),
('nn', 'sef@gmail.com', 'jjj', 1, '', 28, '', '2024-02-12', '', ''),
('nn', 'sef@gmail.com', 'jjj', 1, '', 29, '', '2024-02-12', '', ''),
('nn', 'sef@gmail.com', 'jjj', 1, '', 30, '', '2024-02-12', '', ''),
('jecinta', 'codjecinta@gmail.com', 'eeed', 1, '', 31, '', '2024-02-14', '', ''),
('jecinta', 'sef@gmail.com', 'hello', 1, '', 32, '', '2024-02-14', '', ''),
('jecinta', 'sef@gmail.com', 'hello', 1, '', 33, '', '2024-02-14', '', ''),
('jecinta', 'sef@gmail.com', 'hello', 1, '', 34, '', '2024-02-14', '', ''),
('jecinta', 'sef@gmail.com', 'hello', 1, '', 35, '', '2024-02-14', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productcode` varchar(10) NOT NULL,
  `productname` varchar(200) NOT NULL,
  `productquantity` varchar(200) NOT NULL,
  `productdescription` varchar(200) NOT NULL,
  `productstatus` int(10) NOT NULL,
  `productprice` int(6) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productcode`, `productname`, `productquantity`, `productdescription`, `productstatus`, `productprice`, `file`) VALUES
('0002', 'onion', '7', 'fresh onions', 0, 10, 'assets/onion.jpg'),
('0003', 'banana', '14', 'fresh bananas', 0, 10, 'assets/banana.png'),
('0005', 'apple', '4', 'fresh apples', 0, 30, 'assets/apple.png');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `datecreated` date NOT NULL,
  `idnumber` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`fullname`, `email`, `phonenumber`, `datecreated`, `idnumber`) VALUES
('jecinta maina', 'mainajecintanyambura01@gmail.com', 790876810, '2024-02-01', 12345678),
('sef', 'sef@gmail.com', 786432390, '2024-02-12', 13245785),
('james maina', 'mainajames@gmail.com', 716543232, '2024-02-05', 23456778);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `userpassword` varchar(100) NOT NULL,
  `priviledge` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `userpassword`, `priviledge`) VALUES
('jj@gmail.com', '912ec803b2ce49e4a541068d495ab570', 'user'),
('mainajames@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc', 'user'),
('mainajecinta81@gmail.com', 'c3981fa8d26e95d911fe8eaeb6570f2f', 'user'),
('mainajecintanyambura01@gmail.com', '5e8667a439c68f5145dd2fcbecf02209', 'user'),
('sef@gmail.com', '9be00b007ef836db60e642b9e812ab12', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`COUNT`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productcode`),
  ADD UNIQUE KEY `file` (`file`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`idnumber`),
  ADD UNIQUE KEY `phonenumber` (`phonenumber`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `COUNT` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
