-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 12:32 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_students`
--

CREATE TABLE `attendance_students` (
  `FORM_ID` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `no_of_students` int(255) NOT NULL,
  `lecture_engaged` int(255) NOT NULL,
  `student_present` int(255) NOT NULL,
  `percent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_students`
--

INSERT INTO `attendance_students` (`FORM_ID`, `id`, `class`, `sub`, `no_of_students`, `lecture_engaged`, `student_present`, `percent`) VALUES
(342, 4, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(342, 5, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(342, 6, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(343, 7, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(343, 8, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(343, 9, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(344, 10, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(344, 11, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(344, 12, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(347, 13, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(347, 14, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(347, 15, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(348, 16, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(348, 17, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(348, 18, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(349, 19, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(349, 20, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(349, 21, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(350, 22, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(350, 23, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(350, 24, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(351, 25, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(351, 26, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(351, 27, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(352, 28, 'SE 5 ', 'dbms', 100, 15, 75, '75.00'),
(352, 29, 'SE 5 ', 'PYTHON', 100, 15, 75, '75.00'),
(352, 30, 'SE 5 ', 'JAVA', 100, 15, 75, '75.00'),
(353, 31, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(353, 32, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(353, 33, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(354, 34, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(354, 35, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(354, 36, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(355, 37, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(355, 38, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(355, 39, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(356, 40, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(356, 41, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(356, 42, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(357, 43, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(357, 44, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(357, 45, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(358, 46, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(358, 47, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(358, 48, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(359, 49, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(359, 50, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(359, 51, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(360, 52, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(360, 53, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(360, 54, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(361, 55, 'SE 5 ', 'dbms', 50, 23, 45, '90.00'),
(361, 56, 'SE 5 ', 'PYTHON', 50, 23, 45, '90.00'),
(361, 57, 'SE 5 ', 'JAVA', 65, 24, 45, '69.23'),
(362, 58, 'SE 5 ', 'dbms', 50, 23, 45, '90.00');

-- --------------------------------------------------------

--
-- Table structure for table `engaging_lectures`
--

CREATE TABLE `engaging_lectures` (
  `FORM_ID` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `lectures_targeted` int(255) NOT NULL,
  `lectures_engaged` int(255) NOT NULL,
  `percent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `engaging_lectures`
--

INSERT INTO `engaging_lectures` (`FORM_ID`, `id`, `class`, `sub`, `lectures_targeted`, `lectures_engaged`, `percent`) VALUES
(342, 22, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(342, 23, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(342, 24, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(343, 25, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(343, 26, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(343, 27, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(344, 28, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(344, 29, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(344, 30, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(347, 31, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(347, 32, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(347, 33, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(348, 34, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(348, 35, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(348, 36, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(349, 37, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(349, 38, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(349, 39, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(350, 40, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(350, 41, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(350, 42, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(351, 43, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(351, 44, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(351, 45, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(352, 46, 'SE 5 ', 'dbms', 20, 15, '75.00'),
(352, 47, 'SE 5 ', 'PYTHON', 20, 15, '75.00'),
(352, 48, 'SE 5 ', 'JAVA', 20, 15, '75.00'),
(353, 49, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(353, 50, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(353, 51, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(354, 52, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(354, 53, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(354, 54, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(355, 55, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(355, 56, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(355, 57, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(356, 58, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(356, 59, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(356, 60, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(357, 61, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(357, 62, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(357, 63, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(358, 64, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(358, 65, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(358, 66, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(359, 67, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(359, 68, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(359, 69, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(360, 70, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(360, 71, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(360, 72, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(361, 73, 'SE 5 ', 'dbms', 25, 23, '92.00'),
(361, 74, 'SE 5 ', 'PYTHON', 25, 23, '92.00'),
(361, 75, 'SE 5 ', 'JAVA', 25, 24, '96.00'),
(362, 76, 'SE 5 ', 'dbms', 25, 23, '92.00');

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE `mcq` (
  `FORM_ID` int(10) NOT NULL,
  `mcq1` float NOT NULL,
  `mcq2` float NOT NULL,
  `mcq3` float NOT NULL,
  `mcq4` float NOT NULL,
  `mcq5` float NOT NULL,
  `mcq6` float NOT NULL,
  `mcq7` float NOT NULL,
  `mcq8` float NOT NULL,
  `mcq9` float NOT NULL,
  `mcq10` float NOT NULL,
  `mcq11` float NOT NULL,
  `mcq12` float NOT NULL,
  `mcq13` float NOT NULL,
  `mcq14` float NOT NULL,
  `mcq15` float NOT NULL,
  `mcq16` float NOT NULL,
  `mcq17` float NOT NULL,
  `mcq18` float NOT NULL,
  `mcq19` float NOT NULL,
  `mcq20` float NOT NULL,
  `mcq21` float NOT NULL,
  `mcq22` float NOT NULL,
  `mcq23` float NOT NULL,
  `mcq24` float NOT NULL,
  `mcq25` float NOT NULL,
  `mcq26` float NOT NULL,
  `mcq27` float NOT NULL,
  `mcq28` float NOT NULL,
  `mcq29` float NOT NULL,
  `mcq30` float NOT NULL,
  `mcq31` float NOT NULL,
  `mcq32` float NOT NULL,
  `mcq33` float NOT NULL,
  `mcq34` float NOT NULL,
  `mcq35` float NOT NULL,
  `mcq36` float NOT NULL,
  `mcq37` float NOT NULL,
  `mcq38` float NOT NULL,
  `mcq39` float NOT NULL,
  `mcq40` float NOT NULL,
  `decide` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mcq`
--

INSERT INTO `mcq` (`FORM_ID`, `mcq1`, `mcq2`, `mcq3`, `mcq4`, `mcq5`, `mcq6`, `mcq7`, `mcq8`, `mcq9`, `mcq10`, `mcq11`, `mcq12`, `mcq13`, `mcq14`, `mcq15`, `mcq16`, `mcq17`, `mcq18`, `mcq19`, `mcq20`, `mcq21`, `mcq22`, `mcq23`, `mcq24`, `mcq25`, `mcq26`, `mcq27`, `mcq28`, `mcq29`, `mcq30`, `mcq31`, `mcq32`, `mcq33`, `mcq34`, `mcq35`, `mcq36`, `mcq37`, `mcq38`, `mcq39`, `mcq40`, `decide`) VALUES
(358, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1),
(359, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(360, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 1),
(361, 2, 2, 2, 2, 2, 2, 2, 1, 1.4, 1.4, 1, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1, 1.4, 1.4, 1.4, 1, 1.4, 1.4, 1.4, 1.4, 1, 1.4, 1.4, 1, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1, 2, 1),
(362, 2, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1, 1.4, 1, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1, 1.4, 1.4, 2, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 1.4, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mt_appraisal`
--

CREATE TABLE `mt_appraisal` (
  `FORM_ID` int(255) NOT NULL,
  `EMP_NO` varchar(255) NOT NULL,
  `APPLIED_ON` date NOT NULL,
  `HOD_APPROVED` varchar(255) NOT NULL,
  `HOD_APPROVED_DATE` datetime(6) NOT NULL,
  `HOD_REMARKS` varchar(255) NOT NULL,
  `HOD_APP_ID` varchar(255) NOT NULL,
  `PRINCIPAL_APPROVED` varchar(255) NOT NULL,
  `PRINCIPAL_APPROVED_DATE` datetime(6) NOT NULL,
  `PRINCIPAL_REMARKS` varchar(255) NOT NULL,
  `PR_APP_ID` varchar(255) NOT NULL,
  `Rating` varchar(255) NOT NULL,
  `Cancel_Flg` char(255) NOT NULL,
  `TRN_DATE` datetime(6) NOT NULL,
  `avg_1` varchar(255) NOT NULL,
  `avg_2` varchar(255) NOT NULL,
  `avg_3` varchar(255) NOT NULL,
  `t1` varchar(255) NOT NULL,
  `t2` varchar(255) NOT NULL,
  `t3` varchar(255) NOT NULL,
  `tt` varchar(255) NOT NULL,
  `fmcq` varchar(255) NOT NULL,
  `sw` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_appraisal`
--

INSERT INTO `mt_appraisal` (`FORM_ID`, `EMP_NO`, `APPLIED_ON`, `HOD_APPROVED`, `HOD_APPROVED_DATE`, `HOD_REMARKS`, `HOD_APP_ID`, `PRINCIPAL_APPROVED`, `PRINCIPAL_APPROVED_DATE`, `PRINCIPAL_REMARKS`, `PR_APP_ID`, `Rating`, `Cancel_Flg`, `TRN_DATE`, `avg_1`, `avg_2`, `avg_3`, `t1`, `t2`, `t3`, `tt`, `fmcq`, `sw`, `reason`, `total`, `grade`) VALUES
(358, '101', '2020-07-14', 'Pending', '2020-07-18 00:00:00.000000', 'special weightage', '123', 'Pending', '0000-00-00 00:00:00.000000', '', '', '', '', '0000-00-00 00:00:00.000000', '93.33', '83.08', '91.55', '5.00', '5.00', '5.00', '15.00', '56', '5', 'very', '76.00', 'Very Good'),
(359, '101', '2020-07-14', 'Pending', '2020-07-14 00:00:00.000000', 'hey good performance', '123', 'Pending', '0000-00-00 00:00:00.000000', '', '', '', '', '0000-00-00 00:00:00.000000', '93.33', '83.08', '91.55', '5.00', '5.00', '5.00', '15.00', '40', '4', 'GOOD', '59.00', 'Good'),
(360, '101', '2020-07-14', 'Approved', '2020-07-14 00:00:00.000000', 'k', '123', 'Pending', '2020-07-18 00:00:00.000000', '', '13652', '', '', '0000-00-00 00:00:00.000000', '93.33', '83.08', '91.55', '5.00', '5.00', '5.00', '15.00', '80', '5', 'OUTSTANDING', '100.00', 'Outstanding'),
(361, '101', '2020-07-18', 'Pending', '0000-00-00 00:00:00.000000', 'k', '', 'Pending', '0000-00-00 00:00:00.000000', '', '', '', '', '0000-00-00 00:00:00.000000', '93.33', '83.08', '91.55', '5.00', '5.00', '5.00', '15.00', '58', '5', 'dkfbhisf', '78.00', 'Very Good'),
(362, 'N101', '2020-07-21', 'Pending', '0000-00-00 00:00:00.000000', '', '', 'Pending', '0000-00-00 00:00:00.000000', '', '', '', '', '0000-00-00 00:00:00.000000', '92.00', '90.00', '91.55', '5.00', '5.00', '5.00', '15.00', '56.8', '5', 'vcduwf', '76.80', 'Very Good');

-- --------------------------------------------------------

--
-- Table structure for table `mt_dept_mst`
--

CREATE TABLE `mt_dept_mst` (
  `dept_id` int(255) NOT NULL,
  `dept_nm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_dept_mst`
--

INSERT INTO `mt_dept_mst` (`dept_id`, `dept_nm`) VALUES
(1, 'ADMINISTRATION'),
(2, 'NON-TEACHING'),
(3, 'CONSTRUCTION'),
(4, 'COMPUTER'),
(5, 'ELECTRONICS'),
(6, 'HUMANITIES S.S.'),
(7, 'MECHANICALS'),
(8, 'INFORMATION TECHNOLOGY'),
(9, 'OTHERS'),
(10, 'MATHS'),
(11, 'LIBRARY'),
(12, 'COMMUNICATION SKILLS'),
(13, 'PHYSICS'),
(14, 'CHEMISTRY'),
(15, 'ENGINEERING SCIENCE'),
(16, 'ELECTRONICS & TELECOMMUNICATION');

-- --------------------------------------------------------

--
-- Table structure for table `mt_emp`
--

CREATE TABLE `mt_emp` (
  `EMP_NO` varchar(500) NOT NULL,
  `F_NAME` varchar(500) NOT NULL,
  `M_NAME` varchar(500) NOT NULL,
  `L_NAME` varchar(500) NOT NULL,
  `MOTHER_NAME` varchar(500) NOT NULL,
  `EMP_NM` varchar(500) NOT NULL,
  `EDN_QUALIFICATIONS` varchar(500) NOT NULL,
  `ADDRESS` varchar(500) NOT NULL,
  `PHONE` varchar(500) NOT NULL,
  `MOBILE_NO` varchar(500) NOT NULL,
  `EMAIL_ID` varchar(500) NOT NULL,
  `PASSWORD` varchar(500) NOT NULL,
  `DOB` datetime(6) NOT NULL,
  `PAN_NO` varchar(500) NOT NULL,
  `AADHAR_CARD_NO` varchar(500) NOT NULL,
  `DEPT_ID` int(255) NOT NULL,
  `PAYTP_ID` int(255) NOT NULL,
  `GRADE_ID` int(255) NOT NULL,
  `EMP_TYPE` char(255) NOT NULL,
  `M_F` char(255) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL,
  `DEPARTMENT` text NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_emp`
--

INSERT INTO `mt_emp` (`EMP_NO`, `F_NAME`, `M_NAME`, `L_NAME`, `MOTHER_NAME`, `EMP_NM`, `EDN_QUALIFICATIONS`, `ADDRESS`, `PHONE`, `MOBILE_NO`, `EMAIL_ID`, `PASSWORD`, `DOB`, `PAN_NO`, `AADHAR_CARD_NO`, `DEPT_ID`, `PAYTP_ID`, `GRADE_ID`, `EMP_TYPE`, `M_F`, `DESIGNATION`, `DEPARTMENT`, `pic`) VALUES
('101', 'neel', 's', 'patel', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '', '', 'nikhil.jakharia@sakec.ac.in', '122', '0000-00-00 00:00:00.000000', '101', '12121212121212', 8, 54, 5, 'g', 'm', 'employee', 'INFORMATION TECHNOLOGY', 'profiles/sonic.jfif'),
('102', 'yash', 's', 'badra', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '', '', '', '102', '0000-00-00 00:00:00.000000', '102', '12121212121212', 5, 54, 5, 'g', 'm', 'employee', 'COMPUTER', 'profiles/sonic1.jfif'),
('103', 'yash', 's', 'badra', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '', '', '', '103', '0000-00-00 00:00:00.000000', '103', '12121212121212', 8, 54, 5, 'g', 'm', 'employee', 'INFORMATION TECHNOLOGY', 'profiles/sonic1.jfif'),
('123', 'nikhil', 'ss', 'jhakaria', 'dfj', 'jdsf', 'dfff', 'fdfdf', '', '', '', 'sdfdddddd', '0000-00-00 00:00:00.000000', '123hod', 'errrrr', 8, 123, 5, 'G', 'f', 'hod', 'INFORMATION TECHNOLOGY', 'profiles/sonic2.jfif'),
('136', 'admin', 'shankar', 'admin', 'jaguruti', 'yash', 'b.e', 'ghatkopar', '', '', '', 'djfhj', '0000-00-00 00:00:00.000000', 'abcd13652', '123456789102', 8, 13652, 5, 'G', 'abc', 'admin', 'INFORMATION TECHNOLOGY', 'profiles/sonic3.jfif'),
('13652', 'yash', 'shankar', 'patel', 'jaguruti', 'yash', 'b.e', 'ghatkopar', '', '', '', 'djfhj', '0000-00-00 00:00:00.000000', 'abcd13652', '123456789102', 8, 13652, 5, 'G', 'abc', 'principal', 'INFORMATION TECHNOLOGY', 'profiles/sonic3.jfif'),
('13652yash', 'yash23', 'shankar', 'patel', 'jaguruti', 'yash', 'b.e', 'ghatkopar', '', '', '', 'djfhj', '0000-00-00 00:00:00.000000', 'abcd13652', '123456789102', 8, 13652, 5, 'G', 'abc', 'principal', 'INFORMATION TECHNOLOGY', 'profiles/sonic3.jfif'),
('N101', 'nitesh', 's', 'patel', 'jagruti', 'neel', 'b.tech', 'ghatkopar', '', '', '', '122', '0000-00-00 00:00:00.000000', '101', '12121212121212', 8, 54, 5, 'g', 'm', 'employee', 'INFORMATION TECHNOLOGY', 'profiles/sonic.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `mt_grade_mst`
--

CREATE TABLE `mt_grade_mst` (
  `ID` int(255) NOT NULL,
  `GRADE_ID` int(255) NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mt_grade_mst`
--

INSERT INTO `mt_grade_mst` (`ID`, `GRADE_ID`, `DESIGNATION`) VALUES
(25, 1, 'Lecturer'),
(24, 2, 'Sr. Lecture'),
(25, 3, 'Assistant Professor (V)'),
(26, 4, 'Professor'),
(27, 5, 'Vice Principal	'),
(28, 6, 'Principal(V)'),
(30, 7, 'Lecturer (Sr. Scale)'),
(30, 8, 'Asst. Professor(V)'),
(19, 9, 'Lecturer (Sr. Scale)'),
(22, 10, 'Professor(Adhoc)');

-- --------------------------------------------------------

--
-- Table structure for table `result_of_students`
--

CREATE TABLE `result_of_students` (
  `FORM_ID` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `sub` varchar(255) NOT NULL,
  `avg_three_yrs` varchar(255) NOT NULL,
  `pecent_greater_avg` varchar(255) NOT NULL,
  `percent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_of_students`
--

INSERT INTO `result_of_students` (`FORM_ID`, `id`, `class`, `sub`, `avg_three_yrs`, `pecent_greater_avg`, `percent`) VALUES
(342, 1, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(342, 2, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(342, 3, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(343, 4, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(343, 5, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(343, 6, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(344, 7, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(344, 8, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(344, 9, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(347, 10, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(347, 11, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(347, 12, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(348, 13, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(348, 14, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(348, 15, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(349, 16, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(349, 17, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(349, 18, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(350, 19, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(350, 20, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(350, 21, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(351, 22, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(351, 23, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(351, 24, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(352, 25, 'SE 5 ', 'dbms', '85.00', '90.00', '105.88'),
(352, 26, 'SE 5 ', 'PYTHON', '85.00', '90.00', '105.88'),
(352, 27, 'SE 5 ', 'JAVA', '85.00', '90.00', '105.88'),
(353, 28, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(353, 29, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(353, 30, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(354, 31, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(354, 32, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(354, 33, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(355, 34, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(355, 35, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(355, 36, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(356, 37, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(356, 38, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(356, 39, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(357, 40, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(357, 41, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(357, 42, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(358, 43, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(358, 44, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(358, 45, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(359, 46, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(359, 47, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(359, 48, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(360, 49, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(360, 50, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(360, 51, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(361, 52, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55'),
(361, 53, 'SE 5 ', 'PYTHON', '71.00', '65.00', '91.55'),
(361, 54, 'SE 5 ', 'JAVA', '71.00', '65.00', '91.55'),
(362, 55, 'SE 5 ', 'dbms', '71.00', '65.00', '91.55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_students`
--
ALTER TABLE `attendance_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FORM_ID` (`FORM_ID`);

--
-- Indexes for table `engaging_lectures`
--
ALTER TABLE `engaging_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FORM_ID` (`FORM_ID`);

--
-- Indexes for table `mcq`
--
ALTER TABLE `mcq`
  ADD PRIMARY KEY (`FORM_ID`);

--
-- Indexes for table `mt_appraisal`
--
ALTER TABLE `mt_appraisal`
  ADD PRIMARY KEY (`FORM_ID`);

--
-- Indexes for table `mt_dept_mst`
--
ALTER TABLE `mt_dept_mst`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `mt_emp`
--
ALTER TABLE `mt_emp`
  ADD PRIMARY KEY (`EMP_NO`);

--
-- Indexes for table `mt_grade_mst`
--
ALTER TABLE `mt_grade_mst`
  ADD PRIMARY KEY (`GRADE_ID`);

--
-- Indexes for table `result_of_students`
--
ALTER TABLE `result_of_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FORM_ID` (`FORM_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_students`
--
ALTER TABLE `attendance_students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `engaging_lectures`
--
ALTER TABLE `engaging_lectures`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `mt_appraisal`
--
ALTER TABLE `mt_appraisal`
  MODIFY `FORM_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `result_of_students`
--
ALTER TABLE `result_of_students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_students`
--
ALTER TABLE `attendance_students`
  ADD CONSTRAINT `attendance_students_ibfk_1` FOREIGN KEY (`FORM_ID`) REFERENCES `mt_appraisal` (`FORM_ID`);

--
-- Constraints for table `engaging_lectures`
--
ALTER TABLE `engaging_lectures`
  ADD CONSTRAINT `engaging_lectures_ibfk_1` FOREIGN KEY (`FORM_ID`) REFERENCES `mt_appraisal` (`FORM_ID`);

--
-- Constraints for table `result_of_students`
--
ALTER TABLE `result_of_students`
  ADD CONSTRAINT `result_of_students_ibfk_1` FOREIGN KEY (`FORM_ID`) REFERENCES `mt_appraisal` (`FORM_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
