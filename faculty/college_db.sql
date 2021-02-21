-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 12:31 PM
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
-- Database: `college_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `division_details`
--

CREATE TABLE `division_details` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL COMMENT 'References student_table (std_id)',
  `sem_id` int(5) NOT NULL COMMENT 'References intake (sem_id)',
  `std_roll_no` int(2) NOT NULL,
  `batch` varchar(2) NOT NULL,
  `year` int(5) NOT NULL,
  `db_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intake`
--

CREATE TABLE `intake` (
  `program_id` int(11) NOT NULL,
  `program` varchar(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `year` varchar(11) NOT NULL,
  `div_id` int(11) NOT NULL,
  `division` varchar(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intake`
--

INSERT INTO `intake` (`program_id`, `program`, `year_id`, `year`, `div_id`, `division`, `sem_id`, `semester`) VALUES
(1, 'ETRX', 11, 'FIRST', 111, 'FE1', 1111, 1),
(1, 'ETRX', 11, 'FIRST', 111, 'FE1', 1112, 2),
(1, 'ETRX', 11, 'FIRST', 112, 'FE2', 1121, 1),
(1, 'ETRX', 11, 'FIRST', 112, 'FE2', 1122, 2),
(1, 'ETRX', 12, 'SECOND', 121, 'SE1', 1213, 3),
(1, 'ETRX', 12, 'SECOND', 121, 'SE1', 1214, 4),
(1, 'ETRX', 12, 'SECOND', 122, 'SE2', 1223, 3),
(1, 'ETRX', 12, 'SECOND', 122, 'SE2', 1224, 4),
(1, 'ETRX', 13, 'THIRD', 131, 'TE1', 1315, 5),
(1, 'ETRX', 13, 'THIRD', 131, 'TE1', 1316, 6),
(1, 'ETRX', 13, 'THIRD', 132, 'TE2', 1325, 5),
(1, 'ETRX', 13, 'THIRD', 132, 'TE2', 1326, 6),
(1, 'ETRX', 14, 'FINAL', 141, 'BE1', 1417, 7),
(1, 'ETRX', 14, 'FINAL', 141, 'BE1', 1418, 8),
(1, 'ETRX', 14, 'FINAL', 142, 'BE2', 1427, 7),
(1, 'ETRX', 14, 'FINAL', 142, 'BE2', 1428, 8),
(2, 'COMPUTER', 21, 'FIRST', 213, 'FE3', 2131, 1),
(2, 'COMPUTER', 21, 'FIRST', 213, 'FE3', 2132, 2),
(2, 'COMPUTER', 21, 'FIRST', 214, 'FE4', 2141, 1),
(2, 'COMPUTER', 21, 'FIRST', 214, 'FE4', 2142, 2),
(2, 'COMPUTER', 22, 'SECOND', 223, 'SE3', 2233, 3),
(2, 'COMPUTER', 22, 'SECOND', 223, 'SE3', 2234, 4),
(2, 'COMPUTER', 22, 'SECOND', 224, 'SE4', 2243, 3),
(2, 'COMPUTER', 22, 'SECOND', 224, 'SE4', 2244, 4),
(2, 'COMPUTER', 22, 'SECOND', 229, 'SED', 2293, 3),
(2, 'COMPUTER', 22, 'SECOND', 229, 'SED', 2294, 4),
(2, 'COMPUTER', 23, 'THIRD', 233, 'TE3', 2335, 5),
(2, 'COMPUTER', 23, 'THIRD', 233, 'TE3', 2336, 6),
(2, 'COMPUTER', 23, 'THIRD', 234, 'TE4', 2345, 5),
(2, 'COMPUTER', 23, 'THIRD', 234, 'TE4', 2346, 6),
(2, 'COMPUTER', 23, 'THIRD', 239, 'TED', 2395, 5),
(2, 'COMPUTER', 23, 'THIRD', 239, 'TED', 2396, 6),
(2, 'COMPUTER', 24, 'FINAL', 243, 'BE3', 2437, 7),
(2, 'COMPUTER', 24, 'FINAL', 243, 'BE3', 2438, 8),
(2, 'COMPUTER', 24, 'FINAL', 244, 'BE4', 2447, 7),
(2, 'COMPUTER', 24, 'FINAL', 244, 'BE4', 2448, 8),
(2, 'COMPUTER', 24, 'FINAL', 249, 'BED', 2497, 7),
(2, 'COMPUTER', 24, 'FINAL', 249, 'BED', 2498, 8),
(3, 'I.T.', 31, 'FIRST', 315, 'FE5', 3151, 1),
(3, 'I.T.', 31, 'FIRST', 315, 'FE5', 3152, 2),
(3, 'I.T.', 31, 'FIRST', 316, 'FE6', 3161, 1),
(3, 'I.T.', 31, 'FIRST', 316, 'FE6', 3162, 2),
(3, 'I.T.', 32, 'SECOND', 325, 'SE5', 3253, 3),
(3, 'I.T.', 32, 'SECOND', 325, 'SE5', 3254, 4),
(3, 'I.T.', 32, 'SECOND', 326, 'SE6', 3263, 3),
(3, 'I.T.', 32, 'SECOND', 326, 'SE6', 3264, 4),
(3, 'I.T.', 33, 'THIRD', 335, 'TE5', 3355, 5),
(3, 'I.T.', 33, 'THIRD', 335, 'TE5', 3356, 6),
(3, 'I.T.', 33, 'THIRD', 336, 'TE6', 3365, 5),
(3, 'I.T.', 33, 'THIRD', 336, 'TE6', 3366, 6),
(3, 'I.T.', 34, 'FINAL', 345, 'BE5', 3457, 7),
(3, 'I.T.', 34, 'FINAL', 345, 'BE5', 3458, 8),
(3, 'I.T.', 34, 'FINAL', 346, 'BE6', 3467, 7),
(3, 'I.T.', 34, 'FINAL', 346, 'BE6', 3468, 8),
(4, 'EXTC', 41, 'FIRST', 417, 'FE7', 4171, 1),
(4, 'EXTC', 41, 'FIRST', 417, 'FE7', 4172, 2),
(4, 'EXTC', 41, 'FIRST', 418, 'FE8', 4181, 1),
(4, 'EXTC', 41, 'FIRST', 418, 'FE8', 4182, 2),
(4, 'EXTC', 42, 'SECOND', 427, 'SE7', 4273, 3),
(4, 'EXTC', 42, 'SECOND', 427, 'SE7', 4274, 4),
(4, 'EXTC', 42, 'SECOND', 428, 'SE8', 4283, 3),
(4, 'EXTC', 42, 'SECOND', 428, 'SE8', 4284, 4),
(4, 'EXTC', 43, 'THIRD', 437, 'TE7', 4375, 5),
(4, 'EXTC', 43, 'THIRD', 437, 'TE7', 4376, 6),
(4, 'EXTC', 43, 'THIRD', 438, 'TE8', 4385, 5),
(4, 'EXTC', 43, 'THIRD', 438, 'TE8', 4386, 6),
(4, 'EXTC', 44, 'FINAL', 447, 'BE7', 4477, 7),
(4, 'EXTC', 44, 'FINAL', 447, 'BE7', 4478, 8),
(4, 'EXTC', 44, 'FINAL', 448, 'BE8', 4487, 7),
(4, 'EXTC', 44, 'FINAL', 448, 'BE8', 4488, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_table2`
--

CREATE TABLE `student_table2` (
  `std_id` int(5) NOT NULL,
  `student_name` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `s_phone` varchar(32) NOT NULL,
  `p_phone` varchar(32) NOT NULL,
  `mentor` varchar(32) NOT NULL,
  `smart_card_no` varchar(10) DEFAULT NULL,
  `admission_year` int(5) DEFAULT NULL,
  `program` varchar(10) NOT NULL,
  `admission_type` varchar(10) NOT NULL,
  `registration_no` int(11) NOT NULL
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
-- Dumping data for table `subject_table`
--

INSERT INTO `subject_table` (`subject_no`, `subject_name`, `teacher1_name`, `teacher1_id`, `teacher2_id`, `teacher2_name`, `teacher3_id`, `teacher3_name`, `program_id`, `program`, `year_id`, `year`, `div_id`, `division`, `sem_id`, `semester`, `examiner_id`, `examiner_name`) VALUES
('1', 'dbms', 'kranti mam', 'N101', '123', 'jalpa mam', NULL, '', 2, 'IT', 0, '', 0, '5', 0, '3', NULL, ''),
('2', 'PYTHON', 'kranti mam', 'N101', '123', 'jalpa mam', NULL, '', 2, 'IT', 0, '', 0, '5', 0, '3', NULL, ''),
('3', 'JAVA', 'kranti mam', 'N101', '123', 'jalpa mam', NULL, '', 2, 'IT', 0, '', 0, '5', 0, '3', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `md5_id` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `full_name` varchar(35) COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `user_email` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT 1,
  `pwd` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tel` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `users_ip` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `approved` int(1) NOT NULL DEFAULT 0,
  `program` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `activation_code` int(10) NOT NULL DEFAULT 0,
  `banned` int(1) NOT NULL DEFAULT 0,
  `ckey` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ctime` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `md5_id`, `full_name`, `user_name`, `user_email`, `user_level`, `pwd`, `tel`, `date`, `users_ip`, `approved`, `program`, `activation_code`, `banned`, `ckey`, `ctime`) VALUES
(101, '', 'kranti mam', 'kranti mam', '', 1, '', '', '0000-00-00', '', 0, '', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `usershort`
--

CREATE TABLE `usershort` (
  `id` bigint(20) NOT NULL,
  `full_name` varchar(35) COLLATE latin1_general_ci NOT NULL COMMENT 'References users(full_name)',
  `short` varchar(11) COLLATE latin1_general_ci DEFAULT NULL,
  `user_name` varchar(200) COLLATE latin1_general_ci NOT NULL COMMENT 'References users(user__name)',
  `program` varchar(32) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `division_details`
--
ALTER TABLE `division_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intake`
--
ALTER TABLE `intake`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `student_table2`
--
ALTER TABLE `student_table2`
  ADD PRIMARY KEY (`std_id`),
  ADD UNIQUE KEY `std_id` (`std_id`),
  ADD UNIQUE KEY `std_id_2` (`std_id`),
  ADD UNIQUE KEY `student_name` (`student_name`,`mentor`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_no`,`division`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
ALTER TABLE `users` ADD FULLTEXT KEY `idx_search` (`full_name`,`user_email`,`user_name`);

--
-- Indexes for table `usershort`
--
ALTER TABLE `usershort`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `usershort` ADD FULLTEXT KEY `idx_search` (`full_name`,`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `division_details`
--
ALTER TABLE `division_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2079;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `usershort`
--
ALTER TABLE `usershort`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
