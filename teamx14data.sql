-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2015 at 04:15 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teamx14`
--

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`building`, `room`, `staffid`) VALUES
('Alwyn Williams Building', 'S205', NULL),
('Alwyn Williams Building', 'S104', '1001');

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `forename`, `surname`) VALUES
('1001', 'Helen', 'Purchase');

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `guid`, `forename`, `surname`, `email`, `password`) VALUES
(3, '1106611k', 'Daniel', 'Kasprowicz', 'danielkpl2@gmail.com', 'qwerty'),
(4, 'gsdgsa', 'Daniel', '', 'qwerty', 'fsadg'),
(5, 'jordy', 'Jordan', 'Schlansky', 'jordan.schlansky@gmail.com', 'wqetgehsd'),
(13, NULL, 'rege', 'gdfsg', 'greyseghw', 'gdsw'),
(29, NULL, 'gdhd', 'ggsd', 'shdsyer', 'dfshd'),
(30, 'gdfgd', 'fgsadg', 'sdgsg', 'gdfshfd', 'gsdgs');

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`id`, `starttime`, `endtime`, `date`, `staffid`, `studentid`, `purpose`, `comment`) VALUES
(4, '13:30:00', '14:00:00', '2014-12-10', '1001', NULL, NULL, NULL),
(5, '19:00:00', '19:15:00', '2015-01-09', '1001', NULL, NULL, NULL),
(6, '19:15:00', '19:30:00', '2015-01-09', '1001', 3, 1, 'hfthfhf'),
(7, '19:45:00', '20:00:00', '2015-01-09', '1001', 3, 1, 'fghrhr'),
(8, '10:00:00', '10:20:00', '2015-01-10', '1001', NULL, NULL, NULL),
(9, '10:20:00', '10:40:00', '2015-01-10', '1001', NULL, NULL, NULL),
(10, '11:00:00', '11:30:00', '2015-01-10', '1001', NULL, NULL, NULL),
(11, '10:00:00', '10:20:00', '2015-01-13', '1001', 5, 1, 'Discuss various things');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
