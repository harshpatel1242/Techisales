-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 12:33 PM
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
-- Database: `sh2019_attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_based_subject`
--

CREATE TABLE `attendance_based_subject` (
  `subject_no` varchar(255) NOT NULL,
  `EMP_NO` varchar(255) NOT NULL,
  `Lectures_targeted` int(255) NOT NULL,
  `Lectures_Enaged` int(255) NOT NULL,
  `No_of_Students` int(255) NOT NULL,
  `Students_Present` int(255) NOT NULL,
  `Avg_result` int(255) NOT NULL,
  `greater_than_avg` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_based_subject`
--

INSERT INTO `attendance_based_subject` (`subject_no`, `EMP_NO`, `Lectures_targeted`, `Lectures_Enaged`, `No_of_Students`, `Students_Present`, `Avg_result`, `greater_than_avg`) VALUES
('1', '101', 25, 23, 50, 45, 71, 65),
('1', '123', 20, 15, 100, 75, 85, 90),
('1', 'N101', 25, 23, 50, 45, 71, 65),
('2', '101', 25, 23, 50, 45, 71, 65),
('2', '123', 20, 15, 100, 75, 85, 90),
('3', '101', 25, 24, 65, 45, 71, 65),
('3', '123', 20, 15, 100, 75, 85, 90);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_be`
--

CREATE TABLE `attendance_be` (
  `attID` int(11) NOT NULL,
  `std_roll_no` int(11) NOT NULL COMMENT 'References student_table (std_roll_no)',
  `student_name` varchar(22) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `subject_no` varchar(22) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `attendance` varchar(11) NOT NULL,
  `ondate` date NOT NULL,
  `time` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_se`
--

CREATE TABLE `attendance_se` (
  `attID` int(11) NOT NULL,
  `std_roll_no` int(11) NOT NULL COMMENT 'References student_table (std_roll_no)',
  `student_name` varchar(22) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `subject_no` varchar(22) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `attendance` varchar(11) NOT NULL,
  `ondate` date NOT NULL,
  `time` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_te`
--

CREATE TABLE `attendance_te` (
  `attID` int(11) NOT NULL,
  `std_roll_no` int(11) NOT NULL COMMENT 'References student_table (std_roll_no)',
  `student_name` varchar(22) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `subject_no` varchar(22) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `attendance` varchar(11) NOT NULL,
  `ondate` date NOT NULL,
  `time` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_incharge`
--

CREATE TABLE `course_incharge` (
  `id` int(100) NOT NULL,
  `program_id` varchar(5) DEFAULT NULL,
  `program` varchar(50) DEFAULT NULL,
  `year_id` varchar(5) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `semester` varchar(3) DEFAULT NULL,
  `subject_no` varchar(12) DEFAULT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `lab_no` varchar(12) DEFAULT NULL,
  `lab_name` varchar(50) DEFAULT NULL,
  `incharge1_id` varchar(5) DEFAULT NULL,
  `incharge1_name` varchar(50) DEFAULT NULL,
  `incharge2_id` varchar(5) DEFAULT NULL,
  `incharge2_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `defaulter`
--

CREATE TABLE `defaulter` (
  `def_id` int(11) NOT NULL,
  `frdate` date NOT NULL,
  `todate` date NOT NULL,
  `def_list` varchar(22) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elective_subject`
--

CREATE TABLE `elective_subject` (
  `subject_no` varchar(20) NOT NULL COMMENT 'References subject_table (subject_no)',
  `subject_name` varchar(40) NOT NULL COMMENT 'References subject_table (subject_name)',
  `sem_id` int(11) NOT NULL DEFAULT 0 COMMENT 'References intake (sem_id)',
  `batch1` varchar(4) DEFAULT NULL,
  `batch2` varchar(4) DEFAULT NULL,
  `batch3` varchar(4) DEFAULT NULL,
  `batch4` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ia_quewisemarks`
--

CREATE TABLE `ia_quewisemarks` (
  `ia_id` int(10) NOT NULL,
  `user_name` varchar(40) NOT NULL COMMENT 'References users (full_name)',
  `sem_id` varchar(5) NOT NULL COMMENT 'References intake (sem_id)',
  `subject_no` varchar(10) NOT NULL COMMENT 'References subject_table (subject_no)',
  `ia_no` int(1) NOT NULL,
  `std_roll_no` int(3) NOT NULL COMMENT 'References student_table (std_roll_no)',
  `student_name` varchar(40) NOT NULL COMMENT 'References student_table (student_name)',
  `iaatt` int(2) NOT NULL,
  `q1a` varchar(3) DEFAULT NULL,
  `q1b` varchar(3) DEFAULT NULL,
  `q1c` varchar(3) DEFAULT NULL,
  `q1d` varchar(3) DEFAULT NULL,
  `q1e` varchar(3) DEFAULT NULL,
  `q1f` varchar(3) DEFAULT NULL,
  `q2a` varchar(3) DEFAULT NULL,
  `q2b` varchar(3) DEFAULT NULL,
  `q3a` varchar(3) DEFAULT NULL,
  `q3b` varchar(3) DEFAULT NULL,
  `q1` varchar(3) NOT NULL,
  `q2` varchar(3) NOT NULL,
  `q3` varchar(3) NOT NULL,
  `total` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iloc_subject`
--

CREATE TABLE `iloc_subject` (
  `subject_no` varchar(20) NOT NULL COMMENT 'References subject_table (subject_no)',
  `subject_name` varchar(40) NOT NULL COMMENT 'References subject_table (subject_name)',
  `sem_id` int(11) NOT NULL DEFAULT 0 COMMENT 'References intake (sem_id)',
  `std_roll_no` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `subject_no` varchar(32) NOT NULL,
  `subject_name` varchar(72) CHARACTER SET utf8 NOT NULL,
  `teacher1_name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `teacher1_id` varchar(11) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher2_id` varchar(11) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher2_name` varchar(64) NOT NULL,
  `teacher3_id` varchar(11) DEFAULT NULL COMMENT 'References users(user_name)',
  `teacher3_name` varchar(64) NOT NULL,
  `program_id` int(11) NOT NULL,
  `program` varchar(8) CHARACTER SET utf8 NOT NULL,
  `year_id` int(11) NOT NULL,
  `year` varchar(32) NOT NULL,
  `div_id` int(11) NOT NULL,
  `division` varchar(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `semester` varchar(32) CHARACTER SET utf8 NOT NULL,
  `examiner_id` varchar(11) DEFAULT NULL COMMENT 'References users(user_name)',
  `examiner_name` varchar(50) NOT NULL COMMENT 'References users(full_name)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_based_subject`
--
ALTER TABLE `attendance_based_subject`
  ADD PRIMARY KEY (`subject_no`,`EMP_NO`);

--
-- Indexes for table `attendance_be`
--
ALTER TABLE `attendance_be`
  ADD PRIMARY KEY (`attID`,`sem_id`,`subject_no`,`user_name`,`ondate`,`time`);

--
-- Indexes for table `attendance_se`
--
ALTER TABLE `attendance_se`
  ADD PRIMARY KEY (`attID`,`sem_id`,`subject_no`,`user_name`,`ondate`,`time`);

--
-- Indexes for table `attendance_te`
--
ALTER TABLE `attendance_te`
  ADD PRIMARY KEY (`attID`,`sem_id`,`subject_no`,`user_name`,`ondate`,`time`);

--
-- Indexes for table `course_incharge`
--
ALTER TABLE `course_incharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defaulter`
--
ALTER TABLE `defaulter`
  ADD PRIMARY KEY (`def_id`);

--
-- Indexes for table `elective_subject`
--
ALTER TABLE `elective_subject`
  ADD PRIMARY KEY (`subject_no`,`subject_name`,`sem_id`);

--
-- Indexes for table `ia_quewisemarks`
--
ALTER TABLE `ia_quewisemarks`
  ADD PRIMARY KEY (`ia_id`);

--
-- Indexes for table `iloc_subject`
--
ALTER TABLE `iloc_subject`
  ADD PRIMARY KEY (`sem_id`,`std_roll_no`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_no`,`division`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_incharge`
--
ALTER TABLE `course_incharge`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `defaulter`
--
ALTER TABLE `defaulter`
  MODIFY `def_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ia_quewisemarks`
--
ALTER TABLE `ia_quewisemarks`
  MODIFY `ia_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6017;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
