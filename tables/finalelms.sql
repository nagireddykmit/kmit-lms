-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2020 at 12:25 PM
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
-- Database: `finalelms`
--

-- --------------------------------------------------------

--
-- Table structure for table `addlates`
--

CREATE TABLE `addlates` (
  `sno` int(100) NOT NULL,
  `empid` int(100) NOT NULL,
  `empname` varchar(100) NOT NULL,
  `lates` decimal(10,1) NOT NULL DEFAULT 0.0,
  `monthname` varchar(100) NOT NULL,
  `dates` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `addlop`
--

CREATE TABLE `addlop` (
  `sno` int(100) NOT NULL,
  `emid` varchar(100) NOT NULL,
  `empname` varchar(100) NOT NULL,
  `lopdate` date NOT NULL,
  `monthname` varchar(100) NOT NULL,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '3727adb5fb5f3d52eaa100ccb4d7a099', '2020-10-12 05:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `adminaddcclleavecount`
--

CREATE TABLE `adminaddcclleavecount` (
  `sno` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `employees` varchar(100) NOT NULL,
  `leavetype` varchar(10) NOT NULL,
  `monthname` varchar(150) NOT NULL,
  `ccldate` varchar(100) NOT NULL,
  `cclcount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adminaddclcount`
--

CREATE TABLE `adminaddclcount` (
  `sno` int(100) NOT NULL,
  `eid` int(100) NOT NULL,
  `employees` varchar(100) NOT NULL,
  `leavetype` varchar(10) NOT NULL,
  `monthname` varchar(150) NOT NULL,
  `cldate` varchar(100) NOT NULL,
  `clcount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `april`
--

CREATE TABLE `april` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `august`
--

CREATE TABLE `august` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classadjustments`
--

CREATE TABLE `classadjustments` (
  `leaveid` int(11) NOT NULL,
  `empid` varchar(10) NOT NULL,
  `empname` varchar(100) NOT NULL,
  `adjustedfrom` varchar(100) NOT NULL,
  `department` varchar(250) NOT NULL,
  `Year` varchar(100) NOT NULL,
  `Section` varchar(100) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Timings` varchar(255) NOT NULL,
  `classdate` date NOT NULL,
  `actionstatus` int(10) NOT NULL DEFAULT 0,
  `adjempid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `december`
--

CREATE TABLE `december` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `february`
--

CREATE TABLE `february` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `id` int(10) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `department` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`id`, `UserName`, `Password`, `updationDate`, `department`) VALUES
(1, 'ithod', '1baf2797ac4371b8e4b7d9d02e8992da', '2020-07-28 04:29:47', 'INFORMATION TECHNOLOGY'),
(2, 'csehod', 'c70c6d465783c543746e454db97dad79', '2020-07-28 04:30:36', 'COMPUTER SCIENCE AND ENGINEERING'),
(3, 'ecehod', '099db951d9a576f48e1f666b5afcf24c', '2020-09-23 01:40:07', 'ELECTRONICS AND COMMUNICATION ENGINEERING'),
(4, 'eiehod', '86ec5555576b6bda16abad97f5c87f0c', '2020-09-23 01:48:21', 'ELECTRONICS INSTRUMENTATION ENGINEERING'),
(6, 'aimlhod', 'cf65016f3acea04fbc15fddb8a5c0584', '2020-09-23 01:55:37', 'ARTIFICIAL INTELLIGENCE AND MACHINE LEARNING'),
(7, 'dshod', '1526275fc6f98b7718edcda8eedc974e', '2020-09-23 01:57:56', 'DATA SCIENCE'),
(8, 'hshod', 'db4cea49b0ed1d16c56ac819c6d4c572', '2020-09-24 04:50:47', 'HUMANITIES AND SCIENCES');

-- --------------------------------------------------------

--
-- Table structure for table `holidaystable`
--

CREATE TABLE `holidaystable` (
  `sno` int(11) NOT NULL,
  `occasion` varchar(255) NOT NULL,
  `hdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holidaystable`
--

INSERT INTO `holidaystable` (`sno`, `occasion`, `hdate`) VALUES
(1, 'NEW YEAR DAY', '2020-01-01'),
(2, 'BHOGI', '2020-01-14'),
(3, 'PONGAL', '2020-01-15'),
(4, 'MAHA SHIVARATHRI', '2020-02-21'),
(5, 'HOLI', '2020-03-09'),
(6, 'UGADI', '2020-03-25'),
(7, 'SRI RAMA NAVAMI', '2020-04-02'),
(8, 'GOOD FRIDAY', '2020-04-10'),
(9, 'DR B R AMBEDKAR JAYANTHI', '2020-04-14'),
(10, 'EIDUL FITAR (RAMZAN)', '2020-05-25'),
(11, 'FOLLOWING DAY OF RAMZAN', '2020-05-26'),
(12, 'BONALU', '2020-07-20'),
(13, 'EIDUL AZHA (BAKRID)', '2020-08-01'),
(14, 'SRI KRISHNA ASTAMI', '2020-08-11'),
(15, 'INDEPENDENCE DAY', '2020-08-15'),
(16, 'VINAYAKA CHAVITHI', '2020-08-22'),
(17, 'MAHATHMA GANDHI JAYANTHI', '2020-10-02'),
(18, 'BATHUKAMMA STARTING DAY', '2020-10-17'),
(19, 'DURGASTAMI', '2020-10-24'),
(20, 'EID MILADUN NABI', '2020-10-30'),
(21, 'KARTHIKA PURNIMA / GURU NANAK BIRTHDAY', '2020-11-30'),
(22, 'CHRISTMAS', '2020-12-25'),
(23, 'BOXING DAY', '2020-12-26'),
(24, 'REPUBLIC DAY', '2020-01-26'),
(25, 'BASS JAGJIVAN RAMS BIRTHDAY', '2020-04-05'),
(26, 'SHAHADAT IMAM  HUSSAIN (RA) 10th MOHARAM', '2020-08-30'),
(27, 'VIJAYA DASAMI', '2020-10-25'),
(28, 'DEEPAVALI', '2020-11-14'),
(29, 'SECOND SATURDAY', '2020-05-09'),
(30, 'SECOND SATURDAY', '2020-06-13'),
(31, 'SECOND SATURDAY', '2020-07-11'),
(32, 'SECOND SATURDAY', '2020-08-08'),
(33, 'SECOND SATURDAY', '2020-09-12'),
(34, 'SECOND SATURDAY', '2020-10-10'),
(35, 'SECOND SATURDAY', '2020-11-14'),
(36, 'SECOND SATURDAY', '2020-12-12'),
(39, 'Dussera Holiday', '2020-10-23');

-- --------------------------------------------------------

--
-- Table structure for table `january`
--

CREATE TABLE `january` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `july`
--

CREATE TABLE `july` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `june`
--

CREATE TABLE `june` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `march`
--

CREATE TABLE `march` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `may`
--

CREATE TABLE `may` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `november`
--

CREATE TABLE `november` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(11) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `october`
--

CREATE TABLE `october` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(20) NOT NULL,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `sno` int(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `updatation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`sno`, `username`, `password`, `updatation`) VALUES
(1, 'principal', 'b59033d26f01897a0fb2073e3c114d9a', '2020-09-23 08:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `september`
--

CREATE TABLE `september` (
  `empid` int(11) NOT NULL,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(11,0) NOT NULL DEFAULT 0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0,
  `avail` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lop` decimal(10,1) NOT NULL DEFAULT 0.0,
  `lates` int(10) NOT NULL DEFAULT 0,
  `icl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `iccl` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblavailable`
--

CREATE TABLE `tblavailable` (
  `empid` int(11) NOT NULL,
  `q1` int(11) NOT NULL DEFAULT 4,
  `q2` int(11) NOT NULL DEFAULT 4,
  `q3` int(11) NOT NULL DEFAULT 4,
  `q4` int(11) NOT NULL DEFAULT 3,
  `cl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `ccl` decimal(10,1) NOT NULL DEFAULT 0.0,
  `od` decimal(10,1) NOT NULL DEFAULT 0.0,
  `al` decimal(10,1) NOT NULL DEFAULT 0.0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'COMPUTER SCIENCE AND ENGINEERING', 'CSE', '05', '2020-06-25 06:10:05'),
(2, 'INFORMATION TECHNOLOGY', 'IT', '12', '2020-06-25 06:10:55'),
(3, 'ELECTRONICS AND COMMUNICATION ENGINEERING', 'ECE', '04', '2020-06-25 06:12:50'),
(4, 'ELECTRONICS INSTRUMENTATION ENGINEERING', 'EIE', '10', '2020-08-17 09:14:40'),
(5, 'HUMANITIES AND SCIENCES', 'H & S', '00', '2020-09-24 04:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `EmpId` varchar(10) NOT NULL,
  `FirstName` varchar(200) NOT NULL,
  `LastName` varchar(200) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Gender` varchar(150) NOT NULL,
  `Dob` varchar(200) NOT NULL,
  `Department` varchar(150) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phonenumber` char(20) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `doj` date NOT NULL,
  `adharno` bigint(12) NOT NULL,
  `pancardno` varchar(100) NOT NULL,
  `jntu_uid` varchar(100) NOT NULL,
  `aicteid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `tblemployees`
--
DELIMITER $$
CREATE TRIGGER `insertempid` AFTER INSERT ON `tblemployees` FOR EACH ROW BEGIN 
INSERT into january(EmpId) VALUES (new.EmpId);
INSERT into february(EmpId) VALUES (new.EmpId);
INSERT into march(EmpId) VALUES (new.EmpId);
INSERT into april(EmpId) VALUES (new.EmpId);
INSERT into may(EmpId) VALUES (new.EmpId);
INSERT into june(EmpId) VALUES (new.EmpId);
INSERT into july(EmpId) VALUES (new.EmpId);
INSERT into august(EmpId) VALUES (new.EmpId);
INSERT into september(EmpId) VALUES (new.EmpId);
INSERT into october(EmpId) VALUES (new.EmpId);
INSERT into november(EmpId) VALUES (new.EmpId);
INSERT into december(EmpId) VALUES (new.EmpId);
INSERT into tblavailable(empid) VALUES (new.EmpId);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblleaves`
--

CREATE TABLE `tblleaves` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) NOT NULL,
  `CL` int(4) NOT NULL,
  `CCL` int(4) NOT NULL,
  `Medical Leave` int(4) NOT NULL,
  `OD` int(4) NOT NULL,
  `Summer vacation` int(4) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `noofdays` int(4) NOT NULL,
  `Description` mediumtext NOT NULL,
  `Reason` varchar(200) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `odupload` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'CL', 'Casual Leave', '2020-07-11 10:11:40'),
(2, 'AL', 'Academic Leave', '2020-07-11 10:12:39'),
(3, 'OD', 'On Duty', '2020-07-11 10:12:51'),
(4, 'FN', 'Half Day(FN)', '2020-09-22 15:19:38'),
(5, 'AN', 'Half Day (AN)', '2020-09-04 10:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `updatemonthlyleave`
--

CREATE TABLE `updatemonthlyleave` (
  `sno` int(20) NOT NULL,
  `monthname` varchar(250) NOT NULL,
  `isupdated` int(10) DEFAULT 0,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updatemonthlyleave`
--

INSERT INTO `updatemonthlyleave` (`sno`, `monthname`, `isupdated`, `updatedDate`) VALUES
(1, 'january', 1, '0000-00-00 00:00:00'),
(2, 'february', 1, '0000-00-00 00:00:00'),
(3, 'march', 1, '0000-00-00 00:00:00'),
(4, 'april', 1, '0000-00-00 00:00:00'),
(5, 'may', 1, '0000-00-00 00:00:00'),
(6, 'june', 1, '0000-00-00 00:00:00'),
(7, 'july', 1, '0000-00-00 00:00:00'),
(8, 'august', 1, '0000-00-00 00:00:00'),
(9, 'september', 1, '0000-00-00 00:00:00'),
(10, 'october', 0, '2020-10-12 01:42:18'),
(11, 'november', 0, '0000-00-00 00:00:00'),
(12, 'december', 0, '0000-00-00 00:00:00'),
(13, 'januaryyear', 0, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addlates`
--
ALTER TABLE `addlates`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `addlop`
--
ALTER TABLE `addlop`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminaddcclleavecount`
--
ALTER TABLE `adminaddcclleavecount`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `adminaddclcount`
--
ALTER TABLE `adminaddclcount`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `april`
--
ALTER TABLE `april`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `august`
--
ALTER TABLE `august`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `december`
--
ALTER TABLE `december`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `february`
--
ALTER TABLE `february`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidaystable`
--
ALTER TABLE `holidaystable`
  ADD UNIQUE KEY `sno` (`sno`);

--
-- Indexes for table `january`
--
ALTER TABLE `january`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `july`
--
ALTER TABLE `july`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `june`
--
ALTER TABLE `june`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `march`
--
ALTER TABLE `march`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `may`
--
ALTER TABLE `may`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `november`
--
ALTER TABLE `november`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `october`
--
ALTER TABLE `october`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `september`
--
ALTER TABLE `september`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `tblavailable`
--
ALTER TABLE `tblavailable`
  ADD UNIQUE KEY `empid` (`empid`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EmpId` (`EmpId`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `updatemonthlyleave`
--
ALTER TABLE `updatemonthlyleave`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addlates`
--
ALTER TABLE `addlates`
  MODIFY `sno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addlop`
--
ALTER TABLE `addlop`
  MODIFY `sno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminaddcclleavecount`
--
ALTER TABLE `adminaddcclleavecount`
  MODIFY `sno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminaddclcount`
--
ALTER TABLE `adminaddclcount`
  MODIFY `sno` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `holidaystable`
--
ALTER TABLE `holidaystable`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `sno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `updatemonthlyleave`
--
ALTER TABLE `updatemonthlyleave`
  MODIFY `sno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
