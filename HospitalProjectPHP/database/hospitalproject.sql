-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 09:18 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `cno` int(11) NOT NULL,
  `docno` int(11) NOT NULL,
  `patno` int(11) NOT NULL,
  `rno` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`cno`, `docno`, `patno`, `rno`, `date`) VALUES
(1, 4, 34, 3, '2021-10-27'),
(2, 5, 23, 12, '2021-07-28'),
(3, 4, 124, 12, '2021-10-26'),
(4, 5, 4493, 8, '12-02-2021'),
(5, 2, 4494, 8, '2021-11-17'),
(6, 5, 4495, 8, '2021-11-24'),
(7, 4, 4496, 8, '2021-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorno` int(11) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `special` varchar(255) NOT NULL,
  `qual` varchar(255) NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `log_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorno`, `dname`, `special`, `qual`, `experience`, `phone`, `room`, `log_id`) VALUES
(2, 'Simith Spencer', 'Allergy and Immunology', 'MBCS', 15000, 987345, 4, 4),
(3, 'John Cash', 'Urology', 'MBBS', 12000, 345267, 5, 5),
(4, 'Robert Nickson', 'Diagnostic Radiology', 'MBCS', 13500, 791382, 9, 6),
(5, 'Hans Muller', 'Family Medicine', 'MBBS', 11500, 356478, 8, 7),
(6, 'Marlon Brando', 'Family Doctor', 'MBBS', 3, 12345, 14, 17);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sellprice` int(11) NOT NULL,
  `buyprice` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `itemname`, `description`, `sellprice`, `buyprice`, `qty`) VALUES
(1, 'Aspirin', 'pain killer', 6, 4, 20),
(2, 'Viegra', 'adassd', 18, 12, 50),
(3, 'Tylenol', 'against Fever', 15, 12, 20),
(4, 'Acephen', 'Fever,Cough', 8, 5, 30),
(5, 'Peramivir', 'Flu', 4, 2, 50),
(6, 'Naproxen', 'Pain Killer', 8, 6, 50),
(7, 'Ibuprofen ', 'Pain Killer', 6, 4, 45);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientno`, `name`, `phone`, `address`) VALUES
(23, 'Brock Lesnar', 9999, 'Münich'),
(34, 'Mike Tyson', 123456789, 'California'),
(123, 'John Rambo', 543121, 'Los Angeles'),
(124, 'Ginger Stone', 3467, 'Lille'),
(4493, 'Lady Gaga', 123, 'Zurich'),
(4494, 'Tina Norman', 12345, 'Chicago'),
(4495, 'Peter Brush', 876234, 'Washington'),
(4496, 'Mattley Savage', 123567, 'Miami');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `pid` int(11) NOT NULL,
  `cno` int(11) NOT NULL,
  `dtype` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`pid`, `cno`, `dtype`, `des`, `datetime`) VALUES
(1, 1, 'Flu', 'catching cold,headache', '2021-10-30 13:37:50'),
(2, 1, 'Headache', 'Aspirin', '2021-10-30 13:37:50'),
(3, 1, 'Fever,Cough', 'Paracetamol', '2021-10-30 13:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `utype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `uname`, `password`, `utype`) VALUES
(1, 'Jim Jones', 'rec_jim', '123', 3),
(2, 'Edward Jeremy', 'dr_edward', '123', 2),
(3, 'Mike', 'phar_mike', 'abc', 1),
(4, 'Simith Spencer', 'dr_simith', 'aa23', 2),
(5, 'John Cash', 'Dr_John', '123', 2),
(6, 'Robert Nickson', 'dr_robert', '456', 2),
(7, 'Hans Muller', 'dr_muller', 'qwert', 2),
(8, 'Audrey Brown', 'phar_audrey', 'xcv', 3),
(16, 'John Rambo', 'jr_doc', '345', 2),
(17, 'Marlon Brando', 'dr_marlon', '111', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`cno`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorno`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientno`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4497;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
