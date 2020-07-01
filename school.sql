-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2020 at 06:57 PM
-- Server version: 5.7.30-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `session_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `admission` int(255) NOT NULL DEFAULT '0',
  `exam` int(255) NOT NULL DEFAULT '0',
  `computer` int(255) NOT NULL DEFAULT '0',
  `e_class` int(255) NOT NULL DEFAULT '0',
  `other` int(255) NOT NULL DEFAULT '0',
  `late` int(255) NOT NULL DEFAULT '0',
  `months` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `student_id`, `session_id`, `class_id`, `admission`, `exam`, `computer`, `e_class`, `other`, `late`, `months`) VALUES
(1, 6, 1, 1, 12600, 650, 900, 900, 300, 50, '8,5,6,4,5,4,5,4,5,4,5,4,5,1,2,3'),
(2, 7, 1, 1, 1800, 0, 1100, 100, 0, 0, '3,4,5'),
(3, 4, 1, 1, 0, 0, 900, 900, 300, 0, NULL),
(4, 5, 1, 1, 0, 0, 0, 900, 300, 0, NULL),
(5, 3, 1, 1, 0, 0, 900, 900, 300, 0, NULL),
(6, 2, 1, 1, 0, 0, 0, 900, 300, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `particulars`
--

CREATE TABLE `particulars` (
  `id` int(11) NOT NULL,
  `admission` int(11) NOT NULL DEFAULT '0',
  `exam` int(11) NOT NULL DEFAULT '0',
  `computer` int(11) NOT NULL DEFAULT '0',
  `e_class` int(11) NOT NULL DEFAULT '0',
  `other` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `particulars`
--

INSERT INTO `particulars` (`id`, `admission`, `exam`, `computer`, `e_class`, `other`, `session_id`) VALUES
(1, 7200, 650, 900, 900, 300, '1');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `total` int(255) NOT NULL DEFAULT '0',
  `admission` int(11) DEFAULT NULL,
  `exam` int(11) DEFAULT NULL,
  `computer` int(11) DEFAULT NULL,
  `e_class` int(11) DEFAULT NULL,
  `other` int(11) DEFAULT NULL,
  `late` int(11) DEFAULT NULL,
  `fromMonth` int(11) DEFAULT NULL,
  `toMonth` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `student_id`, `session_id`, `class_id`, `total`, `admission`, `exam`, `computer`, `e_class`, `other`, `late`, `fromMonth`, `toMonth`, `created`, `created_by`) VALUES
(1, 6, 1, 1, 0, 1200, 1, 1000, NULL, NULL, NULL, 4, 5, '2020-06-29 10:01:25', 2),
(2, 6, 1, 1, 2201, 1200, 1, 1000, NULL, NULL, NULL, 4, 5, '2020-06-29 10:02:10', 2),
(3, 7, 1, 1, 2900, 1800, NULL, 1100, NULL, NULL, NULL, 3, 5, '2020-06-29 10:02:56', 2),
(4, 7, 1, 1, 100, 0, NULL, NULL, 100, NULL, NULL, 0, 0, '2020-06-29 10:03:39', 2),
(5, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 10:24:33', 2),
(6, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 10:27:03', 2),
(7, 6, 1, 1, 900, 0, NULL, NULL, 900, NULL, NULL, 0, 0, '2020-06-29 10:29:44', 2),
(8, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 10:30:04', 2),
(9, 6, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 10:30:32', 2),
(10, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:25:59', 2),
(11, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:33:08', 2),
(12, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:40:26', 2),
(13, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:42:58', 2),
(14, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:53:00', 2),
(15, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 11:55:56', 2),
(16, 4, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 12:02:00', 2),
(17, 5, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 12:09:02', 2),
(18, 6, 1, 1, 300, 0, NULL, NULL, NULL, 300, NULL, 0, 0, '2020-06-29 12:09:30', 2),
(19, 4, 1, 1, 900, 0, NULL, NULL, 900, NULL, NULL, 0, 0, '2020-06-29 12:10:56', 2),
(20, 5, 1, 1, 1200, 0, NULL, NULL, 900, 300, NULL, 0, 0, '2020-06-29 12:11:53', 2),
(21, 4, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:19:20', 2),
(22, 4, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:19:48', 2),
(23, 4, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:23:51', 2),
(24, 4, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:28:15', 2),
(25, 3, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:33:10', 2),
(26, 3, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:35:19', 2),
(27, 3, 1, 1, 1200, 0, NULL, NULL, 900, 300, NULL, 0, 0, '2020-06-29 12:38:20', 2),
(28, 3, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-29 12:40:06', 2),
(29, 2, 1, 1, 1200, 0, NULL, NULL, 900, 300, NULL, 0, 0, '2020-06-29 12:42:43', 2),
(30, 3, 1, 1, 1800, 0, NULL, 900, 900, NULL, NULL, 0, 0, '2020-06-29 12:44:46', 2),
(31, 6, 1, 1, 900, 0, NULL, 900, NULL, NULL, NULL, 0, 0, '2020-06-30 12:57:19', NULL),
(32, 6, 1, 1, 2500, 1800, 650, NULL, NULL, NULL, 50, 1, 3, '2020-06-30 18:04:43', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `year`) VALUES
(1, '2020-2021');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `father_fname` varchar(255) DEFAULT NULL,
  `father_mname` varchar(255) DEFAULT NULL,
  `father_lname` varchar(255) DEFAULT NULL,
  `mother_fname` varchar(255) DEFAULT NULL,
  `mother_mname` varchar(255) DEFAULT NULL,
  `mother_lname` varchar(255) DEFAULT NULL,
  `session_id` int(255) NOT NULL,
  `class_id` int(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `mother_tongue` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `caste` varchar(255) DEFAULT NULL,
  `sub_caste` varchar(255) DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `per_address` text,
  `res_address` text,
  `photo` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `mname`, `lname`, `father_fname`, `father_mname`, `father_lname`, `mother_fname`, `mother_mname`, `mother_lname`, `session_id`, `class_id`, `gender`, `dob`, `birth_place`, `nationality`, `religion`, `mother_tongue`, `category`, `caste`, `sub_caste`, `aadhar`, `mobile1`, `mobile2`, `per_address`, `res_address`, `photo`, `created`, `modified`) VALUES
(1, 'bhushan', 'c', 'c', 'c', 'c', 'c', 'c', NULL, NULL, 1, 1, 'Female', '23-6-2020', 'c', 'c', 'c', 'c', 'OBC', 'c', 'c', '21474836471212', '1234567890', '1234567890', 'cccc', 'c', NULL, '2020-06-27 16:06:57', '2020-06-27 16:06:57'),
(2, 'c', 'c', 'c', 'c', 'c', 'c', 'c', NULL, NULL, 1, 1, 'female', 'null', 'c', 'c', 'c', 'c', 'OBC', 'c', 'c', '2147483647', '1234567890', '1234567890', 'cccc', 'c', NULL, '2020-06-27 16:07:38', '2020-06-27 16:07:38'),
(3, 'c', 'c', 'c', 'c', 'c', 'c', 'c', NULL, NULL, 1, 1, 'transgender', 'null', 'c', 'c', 'c', 'c', 'OBC', 'c', 'c', '2147483647', '1234567890', '1234567890', 'cccc', 'c', NULL, '2020-06-27 16:08:23', '2020-06-27 16:08:23'),
(4, 'c', 'c', 'c', 'c', 'c', 'c', 'c', NULL, NULL, 1, 1, 'male', 'null', 'c', 'c', 'c', 'c', 'OBC', 'c', 'c', '2147483647', '1234567890', '1234567890', 'cccc', 'c', NULL, '2020-06-27 16:08:30', '2020-06-27 16:08:30'),
(5, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 1, 1, 'male', 'null', 'c', 'c', 'c', 'c', 'OBC', 'c', 'c', '2147483647', '1234567890', '1234567890', 'cccc', 'c', NULL, '2020-06-27 16:24:49', '2020-06-27 16:24:49'),
(6, 'bhushan', 'shrihari', 'manusmare', 'shrihari', 'ramchandra', 'manusmare', 'nirmala', '', '', 1, 1, 'transgender', '6-5-2010', 'bhadrawati', 'indian', 'hindu', 'marathi', 'OBC', 'sutar', '', '123456789012', '1234567890', '', 'bhadrawati', '', '5361033353.jpeg', '2020-06-27 17:25:08', '2020-06-27 17:25:08'),
(7, 'bhushan', 'shrihari', 'manusmare', 'shrihari', 'ramchandra', 'manusmare', 'nirmala', 'null', 'null', 1, 1, 'female', '6-5-2010', 'bhadrawati', 'indian', 'hindu', 'marathi', 'OBC', 'sutar', 'null', '2147483647', '123456789', '0', 'bhadrawati', 'null', '1945686784sample.png', '2020-06-27 17:25:25', '2020-06-27 17:25:25'),
(8, 'bhushan', 'shrihari', 'manusmare', 'shrihari', 'ramchandra', 'manusmare', 'nirmala', 'null', 'null', 1, 1, 'male', '6-5-2010', 'bhadrawati', 'indian', 'hindu', 'marathi', 'OBC', 'sutar', 'null', '12345678901234', NULL, '0', 'bhadrawati', 'null', '690994421sample.png', '2020-06-27 17:30:31', '2020-06-27 17:30:31'),
(9, 'nkn', 'nk', 'n', 'nkn', 'nknk', 'nkn', 'kn', 'knk', 'nkn', 1, 3, 'Male', '27-6-2020', 'bnj', 'njn', 'jnj', 'nj', 'OBC', 'cd', 'dc', '12345678901234', '1234567890', '1234567890', 'dcsd', 'csdc', '17171027953.jpeg', '2020-06-27 23:25:30', '2020-06-27 23:25:30'),
(10, 'sv', 'jbj', 'bkj', 'kbkjb', 'kjb', 'bkj', 'bkj', 'bkjbkj', 'bk', 1, 5, 'Male', '11-6-2020', 'bkjb', 'bkbk', 'bkjb', 'kjbkj', 'OBC', 'nlk', 'nkln', '12345678901234', '1234567890', 'null', 'dscsd', 'sdsd', '1300826878images.jpeg', '2020-06-27 23:27:23', '2020-06-27 23:27:23'),
(11, 'bk', 'bkb', 'kjbkj', 'bkb', 'bk', 'bkjb', 'kkbk', 'bkjb', 'kjbkj', 1, 4, 'Male', '23-6-2020', 'dscsd', 'njn', 'jnk', 'nkjn', 'NT', 'dcsd', 'dsc', '10101010101010', '1010101010', NULL, 'dcds', 'dsc', '1424783819balls.jpg', '2020-06-29 14:30:50', '2020-06-29 14:30:50'),
(12, 'bk', 'bkjb', 'kbk', 'bkb', 'bkb', 'kj', 'bk', 'njkj', 'bkjbkj', 1, 5, 'Male', '16-6-2020', 'vvsd', 'bb', 'bjkbk', 'kbk', 'OBC', 'kjbkj', 'bkbkbk', '10101010101010', '1010101010', NULL, 'dcsd1', 'cd', '1325124952sample.png', '2020-06-29 14:36:10', '2020-06-29 14:36:10');

-- --------------------------------------------------------

--
-- Table structure for table `students1`
--

CREATE TABLE `students1` (
  `id` int(255) NOT NULL,
  `class_id` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `studname` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `father` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `pob` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `mothertongue` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `caste` varchar(255) NOT NULL,
  `subcaste` varchar(255) NOT NULL,
  `adhar` varchar(255) NOT NULL,
  `mobile1` varchar(255) NOT NULL,
  `mobile2` varchar(255) NOT NULL,
  `paddress` text NOT NULL,
  `raddress` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students1`
--

INSERT INTO `students1` (`id`, `class_id`, `photo`, `studname`, `mother`, `father`, `gender`, `dob`, `pob`, `nationality`, `religion`, `mothertongue`, `category`, `caste`, `subcaste`, `adhar`, `mobile1`, `mobile2`, `paddress`, `raddress`, `created`) VALUES
(1, '1', 'studentphoto/WIN_20200103_11_07_04_Pro.jpg', 'vaibhav manohar pimpalkar', 'vaishali', 'manohar', 'Male', '1993-04-16', 'bhadrawati', 'indian', 'hindu', 'marathi', 'O.B.C.', 'sutar', 'a', '994600212461', '8180908059', '8329643001', 'bhadrawati', 'bhadrawati', '2020-05-09 14:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `adminlog` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` text,
  `gender` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`adminlog`, `id`, `fname`, `lname`, `username`, `password`, `birthday`, `gender`) VALUES
('', 2, 'vaibhav', 'pimpalkar', 'abc@abc.com', '81dc9bdb52d04dc20036dbd8313ed055', '16/04/1993', 'male'),
('', 3, 'vaibhav', 'pimpalkar', 'vaiibaav@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '16/04/1993', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `particulars`
--
ALTER TABLE `particulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students1`
--
ALTER TABLE `students1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `particulars`
--
ALTER TABLE `particulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `students1`
--
ALTER TABLE `students1`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `students` ADD `admission_no` VARCHAR(255) NULL AFTER `class_id`, ADD `admission_date` DATE NULL AFTER `admission_no`, ADD UNIQUE (`admission_no`);
ALTER TABLE `students` CHANGE `dob` `dob` DATE NULL;