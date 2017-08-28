-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2017 at 12:02 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`username`, `password`, `name`, `gender`, `DOB`, `address`, `contact_no`, `email_id`, `resume`) VALUES
('john', 'john', 'John Smith', '', '1980-10-10', 'london', '9178372465', 'john@gmail.com', 'uploads/Minor Project or Case Study Asignment.pdf');

--
-- Triggers `applicant`
--
DELIMITER $$
CREATE TRIGGER `after` AFTER DELETE ON `applicant` FOR EACH ROW DELETE FROM applies_for
    WHERE applies_for.username = old.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applies_for`
--

CREATE TABLE `applies_for` (
  `notification_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applies_for`
--

INSERT INTO `applies_for` (`notification_id`, `username`) VALUES
(13, 'john'),
(14, 'john'),
(15, 'john');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `contact_no` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`username`, `name`, `password`, `address`, `email_id`, `contact_no`) VALUES
('oracle', 'oracle', 'oracle', 'california', 'www.oracle.com', 2147483647),
('teradata', 'Teradata', 'teradata', 'Ohio', 'www.teradata.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `job_description`, `start_date`, `end_date`) VALUES
(13, 'looking for managers', '2016-11-17', '2016-11-20'),
(14, 'searching for engineers', '2016-11-17', '2016-11-20'),
(15, 'searching for vinit', '2016-11-18', '2016-09-09');

--
-- Triggers `notification`
--
DELIMITER $$
CREATE TRIGGER `after_notification_delete` AFTER DELETE ON `notification` FOR EACH ROW DELETE FROM posts
    WHERE posts.notification_id = old.notification_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `username` varchar(30) NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`username`, `notification_id`) VALUES
('oracle', 14),
('oracle', 15),
('teradata', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `applies_for`
--
ALTER TABLE `applies_for`
  ADD PRIMARY KEY (`notification_id`,`username`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`username`,`notification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
