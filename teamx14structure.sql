-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2015 at 04:11 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: 'teamx14'
--

-- --------------------------------------------------------

--
-- Table structure for table 'room'
--

CREATE TABLE IF NOT EXISTS room (
  building varchar(255) NOT NULL,
  room varchar(255) NOT NULL,
  staffid varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'staff'
--

CREATE TABLE IF NOT EXISTS staff (
  staffid varchar(8) NOT NULL,
  forename varchar(255) NOT NULL,
  surname varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'student'
--

CREATE TABLE IF NOT EXISTS student (
id int(11) NOT NULL,
  guid varchar(8) DEFAULT NULL,
  forename varchar(255) NOT NULL,
  surname varchar(255) NOT NULL,
  email varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table 'timeslot'
--

CREATE TABLE IF NOT EXISTS timeslot (
id int(11) NOT NULL,
  starttime time NOT NULL,
  endtime time NOT NULL,
  `date` date NOT NULL,
  staffid varchar(8) NOT NULL,
  studentid int(11) DEFAULT NULL,
  purpose int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table room
--
ALTER TABLE room
 ADD PRIMARY KEY (building,room), ADD KEY staffid (staffid);

--
-- Indexes for table staff
--
ALTER TABLE staff
 ADD PRIMARY KEY (staffid);

--
-- Indexes for table student
--
ALTER TABLE student
 ADD PRIMARY KEY (id), ADD UNIQUE KEY `guid/email_unique` (guid,email), ADD UNIQUE KEY guid_unique (guid), ADD UNIQUE KEY email_unique (email);

--
-- Indexes for table timeslot
--
ALTER TABLE timeslot
 ADD PRIMARY KEY (id), ADD KEY staffid (staffid), ADD KEY `date` (`date`), ADD KEY studentid_fk (studentid);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table student
--
ALTER TABLE student
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table timeslot
--
ALTER TABLE timeslot
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table room
--
ALTER TABLE room
ADD CONSTRAINT staffid_fk FOREIGN KEY (staffid) REFERENCES staff (staffid) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table timeslot
--
ALTER TABLE timeslot
ADD CONSTRAINT staffid_fke FOREIGN KEY (staffid) REFERENCES staff (staffid) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT studentid_fk FOREIGN KEY (studentid) REFERENCES student (id) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
