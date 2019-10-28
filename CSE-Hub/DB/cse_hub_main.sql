-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2019 at 09:43 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cse_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `username` varchar(10) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `display_email` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`username`, `email`, `name`, `display_email`) VALUES
('super', 'super@user.com', 'Thomas William', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `all_contest_details`
--

CREATE TABLE `all_contest_details` (
  `contest_ID` varchar(10) NOT NULL,
  `contest_name` varchar(30) NOT NULL,
  `admin` varchar(10) NOT NULL,
  `date_created` date NOT NULL,
  `contest_length` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authenticate`
--

CREATE TABLE `authenticate` (
  `username` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `isAdmin` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authenticate`
--

INSERT INTO `authenticate` (`username`, `password`, `isAdmin`) VALUES
('super', 'super', b'1'),
('user', 'user', b'0'),
('user2', 'user2', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `practice_questions_info`
--

CREATE TABLE `practice_questions_info` (
  `ques_ID` varchar(10) NOT NULL,
  `date_created` date DEFAULT NULL,
  `successful_submissions` int(6) DEFAULT '0',
  `total_submissions` int(6) DEFAULT '0',
  `admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `practice_questions_info`
--

INSERT INTO `practice_questions_info` (`ques_ID`, `date_created`, `successful_submissions`, `total_submissions`, `admin`) VALUES
('q1', '2019-10-26', 0, 0, 'super');

-- --------------------------------------------------------

--
-- Table structure for table `q1`
--

CREATE TABLE `q1` (
  `username` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `time_taken` float DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ques_id` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `time_taken` float DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ques_id`, `status`, `time_taken`, `link`) VALUES
('q1', 'AC', 1, 'vvvbb');

-- --------------------------------------------------------

--
-- Table structure for table `user2`
--

CREATE TABLE `user2` (
  `ques_id` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `time_taken` float DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(10) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `display_email` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `email`, `name`, `display_email`) VALUES
('user', 'yy@iitdh.ac', 'user', b'1'),
('user2', 'bb@yy.t', 'user2', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `authenticate`
--
ALTER TABLE `authenticate`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `practice_questions_info`
--
ALTER TABLE `practice_questions_info`
  ADD PRIMARY KEY (`ques_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
