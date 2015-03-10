-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2015 at 07:59 AM
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
(1, '1234567a', 'John', 'Smith', 'john.smith@gmail.com', 'qwerty'),
(2, '2345678b', 'Luke', 'Skywalker', 'luke.skywalker@hotmail.com', 'mydadylovesme'),
(3, '3456789a', 'Jordan', 'Schlansky', 'jordan.schlansky@yahoo.com', 'italy'),
(4, '4567890s', 'Jim', 'Carrey', 'jimcarrey@yahoo.com', 'funnyjokes'),
(5, '6853794g', 'Han', 'Solo', 'han.solo@gmail.com', 'leia'),
(6, '9673284s', 'Jack', 'Sparrow', 'jack.sparrow@aol.com', 'rum');

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`id`, `starttime`, `endtime`, `date`, `staffid`, `studentid`, `purpose`, `comment`) VALUES
(5, '09:00:00', '09:15:00', '2015-01-19', '1001', NULL, NULL, NULL),
(12, '10:15:00', '10:45:00', '2015-01-19', '1001', NULL, NULL, NULL),
(13, '09:30:00', '10:00:00', '2015-01-19', '1001', NULL, NULL, NULL),
(14, '11:00:00', '11:15:00', '2015-01-19', '1001', NULL, NULL, NULL),
(15, '11:30:00', '11:45:00', '2015-01-19', '1001', NULL, NULL, NULL),
(16, '11:00:00', '11:15:00', '2015-01-20', '1001', NULL, NULL, NULL),
(17, '11:30:00', '12:00:00', '2015-01-20', '1001', NULL, NULL, NULL),
(18, '12:30:00', '13:00:00', '2015-01-20', '1001', 5, 1, 'Chewbacca ate my cookie');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
