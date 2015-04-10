-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2015 at 11:53 PM
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
-- Dumping data for table `purpose`
--

INSERT INTO `purpose` (`staffid`, `for_id`, `for_name`) VALUES
(2, 1, 'General'),
(2, 2, 'Advisor'),
(2, 3, 'Studies'),
(2, NULL, '');

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`building`, `room`, `staffid`) VALUES
('Alwyn Williams Building', 'S104', NULL);

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `forename`, `surname`, `email`, `password`, `salt`) VALUES
(2, 'John', 'Smith', 'John.Smith@glasgow.ac.uk', '850e7cb9b406d254e7acdffde4ec65cfd45c44412c3bebbf684569fa361813420e2689ebac0556fc06e9fb7d5a1b076afc1d87a0a484f9d64ef89880f7817cc9', '6f884805492950fadc1a9f9195af720c75d8c98441f9d184f7cc96ac9118045bca7dce5e6af5a179bb2a3a47377071b0c13e5be8b2f60d4c12011d7d3bad7a46');

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `guid`, `forename`, `surname`, `email`, `password`) VALUES
(1, '1234567a', 'John', 'Smith', 'john.smith@gmail.com', 'qwerty'),
(2, '2345678b', 'Luke', 'Skywalker', 'luke.skywalker@hotmail.com', 'mydadylovesme'),
(3, '3456789a', 'Jordan', 'Schlansky', 'jordan.schlansky@yahoo.com', 'italy'),
(4, '4567890s', 'Jim', 'Carrey', 'jimcarrey@yahoo.com', 'funnyjokes'),
(5, '6853794g', 'Han', 'Solo', 'han.solo@gmail.com', 'leia'),
(6, '9673284s', 'Jack', 'Sparrow', 'jack.sparrow@aol.com', 'rum'),
(7, '1234', 'robert', 'cool', 'robert.cool@gmail.com', 'qwerty'),
(8, '1234567m', 'Michael', 'Smith', 'mic.smith@gmail.com', 'qwerty'),
(9, 'waefgf2', 'abc', 'def', 'fdsaf@gdsa.com', 'qwerty'),
(10, 'fdgsdfg', 'desgerg', 'dsf', 'dsfghdsfh@gmail.com', 'hesher'),
(11, '1234567f', 'Moist', 'Fanny', 'moist.fanny@hotmail.com', 'qwerty123'),
(12, '7654364n', 'Patrick', 'Numpty', 'pattyn@gmail.com', 'qwerty123'),
(13, NULL, 'hherhe', '', 'ghfd@gdsfgfd.com', 'qwfqwfqw'),
(14, '7459074c', 'Peter', 'Capaldi', 'peter.capaldi@gmail.com', 'qwerty123'),
(22, '9384058b', 'fsdf', 'fsfsdf', 'a.b@gmail.com', 'qwerty123');

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`id`, `starttime`, `endtime`, `date`, `staffid`, `studentid`, `purpose`, `comment`) VALUES
(33, '10:00:00', '10:25:00', '2015-03-09', 2, 5, 1, 'Need help with registration'),
(34, '11:00:00', '11:14:00', '2015-03-10', 2, 5, 1, 'help'),
(35, '14:00:00', '14:19:00', '2015-03-10', 2, NULL, NULL, NULL),
(36, '11:00:00', '11:30:00', '2015-03-11', 2, NULL, NULL, NULL),
(38, '12:30:00', '13:00:00', '2015-03-13', 2, 6, 2, 'ahoy'),
(41, '15:00:00', '15:30:00', '2015-03-09', 2, NULL, NULL, NULL),
(42, '09:00:00', '10:00:00', '2015-03-17', 2, NULL, NULL, NULL),
(43, '09:00:00', '09:30:00', '2015-03-24', 2, 7, 3, 'help with subjects'),
(45, '10:10:00', '10:20:00', '2015-03-17', 2, NULL, NULL, NULL),
(46, '10:00:00', '10:30:00', '2015-03-18', 2, NULL, NULL, NULL),
(47, '10:00:00', '10:30:00', '2015-03-21', 2, NULL, NULL, NULL),
(54, '12:00:00', '12:15:00', '2015-03-27', 2, 8, 1, 'help'),
(55, '10:00:00', '11:00:00', '2015-03-19', 2, NULL, NULL, NULL),
(56, '11:00:00', '12:00:00', '2015-03-19', 2, NULL, NULL, NULL),
(58, '11:00:00', '12:00:00', '2015-03-21', 2, NULL, NULL, NULL),
(60, '12:00:00', '12:15:00', '2015-03-21', 2, NULL, NULL, NULL),
(61, '10:00:00', '10:15:00', '2015-03-14', 2, NULL, NULL, NULL),
(62, '10:00:00', '10:15:00', '2015-03-05', 2, NULL, NULL, NULL),
(63, '10:00:00', '10:15:00', '2015-03-05', 2, NULL, NULL, NULL),
(64, '10:00:00', '10:15:00', '2015-03-04', 2, NULL, NULL, NULL),
(65, '10:00:00', '10:15:00', '2015-03-12', 2, NULL, NULL, NULL),
(67, '10:00:00', '10:15:00', '2015-03-15', 2, NULL, NULL, NULL),
(68, '10:00:00', '11:00:00', '2015-03-16', 2, NULL, NULL, NULL),
(69, '10:00:00', '11:00:00', '2015-03-09', 2, NULL, NULL, NULL),
(70, '10:00:00', '10:15:00', '2015-03-09', 2, NULL, NULL, NULL),
(71, '10:00:00', '10:15:00', '2015-03-23', 2, NULL, NULL, NULL),
(72, '10:00:00', '10:15:00', '2015-03-28', 2, NULL, NULL, NULL),
(74, '10:00:00', '10:15:00', '2015-04-22', 2, 5, 1, 'Help'),
(80, '09:00:00', '09:20:00', '2015-03-20', 2, NULL, NULL, NULL),
(84, '10:00:00', '10:15:00', '2014-01-01', 2, NULL, NULL, NULL),
(86, '10:00:00', '10:15:00', '2015-05-02', 2, NULL, NULL, NULL),
(87, '10:00:00', '10:15:00', '2015-05-05', 2, NULL, NULL, NULL),
(88, '10:00:00', '10:15:00', '2015-04-27', 2, NULL, NULL, NULL),
(89, '10:00:00', '10:30:00', '2015-04-02', 2, NULL, NULL, NULL),
(90, '10:00:00', '10:30:00', '2015-04-09', 2, 4, 3, 'There are two possibilities to include graphics in your document. Either create them with some special code, a topic which will be discussed in the Creating Graphics part, (see Introducing Procedural Graphics) or import productions from third party tools, which is what we will be discussing here.\r\n\r\nStrictly speaking, LaTeX cannot manage pictures directly: in order to introduce graphics within documents, LaTeX just creates a box with the same size as the image you want to include and embeds the picture, without any other processing. This means you will have to take care that the images you want to include are in the right format to be included. This is not such a hard task because LaTeX supports the most common picture formats around.\r\n\r\nThere are two possibilities to include graphics in your document. Either create them with some special code, a topic which will be discussed in the Creating Graphics part, (see Introducing Procedural Graphics) or import productions from third party tools, which is what we will be discussing here.\r\n\r\nStrictly speaking, LaTeX cannot manage pictures directly: in order to introduce graphics within documents, LaTeX just creates a box with the same size as the image you want to include and embeds the picture, without any other processing. This means you will have to take care that the images you want to include are in the right format to be included. This is not such a hard task because LaTeX supports the most common picture formats around.'),
(92, '10:00:00', '10:15:00', '2015-03-10', 2, NULL, NULL, NULL),
(96, '10:00:00', '10:15:00', '2015-05-12', 2, 14, 1, 'Many, if not all, of you have had to deal with creating a secure site login at some point in time. Although there are numerous articles written on the subject it is painstakingly difficult to find useful information from a single source. For this reason I will be discussing various techniques I have used or come across in the past for increasing session security to hinder both session hijacking and brute force password cracking using Rainbow tables or online tools such as GData. I use the word hinder due to the fact no foolproof methods exist for preventing session hijacking or brute force cracking, merely increasing degrees of difficulty. Choose a method wisely based on your sites current or anticipated traffic, security concerns, and intended site usage. The following examples have been coded using PHP and MySQL. I more than willingly accept comments, suggestions, critiques, and code samples from readers like you as they benefit the community on the whole.'),
(97, '10:00:00', '10:15:00', '2015-05-19', 2, NULL, NULL, NULL),
(99, '12:00:00', '12:30:00', '2015-05-07', 2, NULL, NULL, NULL),
(101, '12:00:00', '12:30:00', '2015-05-14', 2, NULL, NULL, NULL),
(103, '10:00:00', '10:15:00', '2015-06-10', 2, NULL, NULL, NULL),
(104, '10:00:00', '10:15:00', '2015-06-17', 2, NULL, NULL, NULL),
(114, '10:00:00', '10:15:00', '2015-03-24', 2, NULL, NULL, NULL),
(115, '10:00:00', '10:15:00', '2015-03-25', 2, NULL, NULL, NULL),
(118, '10:00:00', '10:15:00', '2015-04-13', 2, NULL, NULL, NULL),
(120, '10:00:00', '10:15:00', '2015-06-12', 2, NULL, NULL, NULL),
(121, '10:00:00', '10:15:00', '2015-06-19', 2, NULL, NULL, NULL),
(124, '10:00:00', '10:15:00', '2015-06-20', 2, NULL, NULL, NULL),
(126, '10:00:00', '00:00:00', '2015-03-11', 2, NULL, NULL, NULL),
(128, '10:15:00', '10:30:00', '2015-03-29', 2, 11, 2, 'Advise me'),
(129, '10:00:00', '10:15:00', '2015-03-30', 2, NULL, NULL, NULL),
(134, '10:00:00', '10:15:00', '2015-05-09', 2, NULL, NULL, NULL),
(137, '07:00:00', '07:10:00', '2015-04-07', 2, NULL, NULL, NULL),
(138, '11:00:00', '11:15:00', '2015-04-02', 2, 5, 2, 'hans note'),
(139, '10:00:00', '10:15:00', '2015-04-24', 2, NULL, NULL, NULL),
(140, '11:00:00', '11:30:00', '2015-04-09', 2, 5, 3, 'note note'),
(142, '11:00:00', '11:20:00', '2015-06-30', 2, NULL, NULL, NULL),
(143, '11:00:00', '11:20:00', '2015-07-02', 2, NULL, NULL, NULL),
(144, '11:00:00', '11:20:00', '2015-07-04', 2, NULL, NULL, NULL),
(145, '11:00:00', '11:20:00', '2015-07-06', 2, NULL, NULL, NULL),
(146, '11:00:00', '11:20:00', '2015-07-08', 2, NULL, NULL, NULL),
(147, '11:00:00', '11:20:00', '2015-07-10', 2, NULL, NULL, NULL),
(148, '11:00:00', '11:20:00', '2015-07-12', 2, NULL, NULL, NULL),
(149, '11:00:00', '11:20:00', '2015-07-14', 2, NULL, NULL, NULL),
(150, '11:00:00', '11:20:00', '2015-07-28', 2, NULL, NULL, NULL),
(151, '11:00:00', '11:20:00', '2015-07-16', 2, NULL, NULL, NULL),
(152, '11:00:00', '11:20:00', '2015-07-30', 2, NULL, NULL, NULL),
(153, '11:00:00', '11:20:00', '2015-07-18', 2, NULL, NULL, NULL),
(154, '11:00:00', '11:20:00', '2015-08-01', 2, NULL, NULL, NULL),
(155, '11:00:00', '11:20:00', '2015-07-20', 2, NULL, NULL, NULL),
(156, '11:00:00', '11:20:00', '2015-07-22', 2, NULL, NULL, NULL),
(157, '11:00:00', '11:20:00', '2015-07-24', 2, NULL, NULL, NULL),
(166, '11:00:00', '11:20:00', '2015-07-26', 2, NULL, NULL, NULL),
(167, '11:00:00', '11:20:00', '2015-08-03', 2, NULL, NULL, NULL),
(168, '11:00:00', '11:20:00', '2015-08-05', 2, NULL, NULL, NULL),
(169, '11:00:00', '11:20:00', '2015-08-07', 2, NULL, NULL, NULL),
(170, '11:00:00', '11:20:00', '2015-08-09', 2, NULL, NULL, NULL),
(193, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(194, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(195, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(196, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(197, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(198, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(199, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(200, '00:00:00', '00:00:00', '0000-00-00', 2, NULL, NULL, NULL),
(202, '10:00:00', '10:30:00', '2015-06-22', 2, NULL, NULL, NULL),
(203, '10:00:00', '10:30:00', '2015-06-23', 2, NULL, NULL, NULL),
(205, '10:00:00', '10:30:00', '2015-06-25', 2, NULL, NULL, NULL),
(206, '10:00:00', '10:30:00', '2015-06-26', 2, NULL, NULL, NULL),
(207, '10:00:00', '10:30:00', '2015-06-27', 2, NULL, NULL, NULL),
(208, '10:00:00', '10:30:00', '2015-06-28', 2, NULL, NULL, NULL),
(210, '11:00:00', '11:30:00', '2015-06-22', 2, NULL, NULL, NULL),
(211, '11:00:00', '11:30:00', '2015-06-23', 2, NULL, NULL, NULL),
(212, '11:00:00', '11:30:00', '2015-06-24', 2, NULL, NULL, NULL),
(213, '11:00:00', '11:30:00', '2015-06-25', 2, NULL, NULL, NULL),
(214, '11:00:00', '11:30:00', '2015-06-26', 2, NULL, NULL, NULL),
(215, '11:00:00', '11:30:00', '2015-06-27', 2, NULL, NULL, NULL),
(216, '11:00:00', '11:30:00', '2015-06-28', 2, NULL, NULL, NULL),
(217, '08:00:00', '08:20:00', '2015-04-07', 2, 22, 1, 'note '),
(218, '10:00:00', '10:30:00', '2015-04-16', 2, NULL, NULL, NULL),
(219, '10:00:00', '10:15:00', '2015-04-03', 2, NULL, NULL, NULL),
(220, '10:15:00', '10:30:00', '2015-04-03', 2, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
