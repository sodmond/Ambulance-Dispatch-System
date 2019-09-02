-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2015 at 08:34 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ambulance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE IF NOT EXISTS `admin_info` (
  `Admin_id` varchar(7) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Othernames` varchar(100) NOT NULL,
  `Date_of_Birth` varchar(10) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Phone` bigint(20) NOT NULL,
  `Qualification` varchar(50) NOT NULL,
  PRIMARY KEY (`Admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`Admin_id`, `Lastname`, `Othernames`, `Date_of_Birth`, `Gender`, `Address`, `Email`, `Phone`, `Qualification`) VALUES
('adm4312', 'Owolabi', 'Sodik Olanrewaju', '1997-01-21', 'Male', '117, Ogunlana Drive, Surulere, Lagos', 'sodmond@outlook.com', 8093373463, 'MSc');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_details`
--

CREATE TABLE IF NOT EXISTS `admin_login_details` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Admin_id` varchar(7) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Rank` varchar(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_login_details`
--

INSERT INTO `admin_login_details` (`ID`, `Admin_id`, `Password`, `Rank`) VALUES
(1, 'adm4312', 'owolabi001', 'global');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance_info`
--

CREATE TABLE IF NOT EXISTS `ambulance_info` (
  `Amb_id` varchar(10) NOT NULL,
  `Amb_model` varchar(35) NOT NULL,
  `Manufacture_date` date NOT NULL,
  `Engine_num` varchar(32) NOT NULL,
  `Driver_id` varchar(7) DEFAULT NULL,
  `Purchase_date` date NOT NULL,
  PRIMARY KEY (`Amb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambulance_info`
--

INSERT INTO `ambulance_info` (`Amb_id`, `Amb_model`, `Manufacture_date`, `Engine_num`, `Driver_id`, `Purchase_date`) VALUES
('amb5701', 'Toyota', '2013-03-01', '464547574433sda', 'drv9140', '2015-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `dispatch_status`
--

CREATE TABLE IF NOT EXISTS `dispatch_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Driver_id` varchar(10) NOT NULL,
  `Admin_id` varchar(7) NOT NULL,
  `Req_id` varchar(7) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `dispatch_status`
--

INSERT INTO `dispatch_status` (`ID`, `Driver_id`, `Admin_id`, `Req_id`, `Status`, `Date`) VALUES
(1, 'drv1095', 'adm4312', 'req8632', 'Active', '2015-03-15 12:29:24'),
(2, 'drv1095', 'adm4312', 'req8632', 'Inactive', '2015-03-15 12:51:34'),
(3, 'drv1095', 'adm4312', 'req1075', 'Active', '2015-03-15 12:55:06'),
(4, 'drv1095', 'adm4312', 'req1075', 'Inactive', '2015-03-15 12:55:37'),
(5, 'drv1095', 'adm4312', 'req2193', 'Active', '2015-03-16 12:15:16'),
(6, 'drv1095', 'adm4312', 'req2193', 'Inactive', '2015-03-16 12:16:29'),
(7, 'drv8013', 'adm4312', 'req6743', 'Active', '2015-03-16 21:37:30'),
(8, 'drv1095', 'adm4312', 'req3879', 'Active', '2015-03-16 21:58:34'),
(9, 'drv8013', 'adm4312', 'req6743', 'Inactive', '2015-03-16 22:03:39'),
(10, 'drv8102', 'adm4312', 'req8694', 'Active', '2015-03-20 15:27:22'),
(11, 'drv9140', 'adm4312', 'req1065', 'Active', '2015-03-20 15:29:10'),
(12, 'drv8102', 'adm4312', 'req8694', 'Inactive', '2015-03-20 15:29:35'),
(13, 'drv9140', 'adm4312', 'req1065', 'Inactive', '2015-03-20 15:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `drivers_info`
--

CREATE TABLE IF NOT EXISTS `drivers_info` (
  `Driver_id` varchar(7) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `Othernames` varchar(100) NOT NULL,
  `Date_of_Birth` varchar(10) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Phone` bigint(20) NOT NULL,
  `Qualification` varchar(50) NOT NULL,
  `Route` varchar(50) NOT NULL,
  PRIMARY KEY (`Driver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers_info`
--

INSERT INTO `drivers_info` (`Driver_id`, `Lastname`, `Othernames`, `Date_of_Birth`, `Gender`, `Address`, `Email`, `Phone`, `Qualification`, `Route`) VALUES
('drv9140', 'Odumedu', 'Kelvin Dozie', '1988-07-21', 'Male', '7b, da silva, off ilasamaja rd, Ilasamaja, Mushin', 'k_dozzy@ymail.com', 8036751904, 'Bsc Auto Mechanic', 'Lagos Island'),
('drv8102', 'Zukerberg', 'Michael Eichen', '1985-10-07', 'Male', '27, Broad street, Marina, Lagos', 'micheal_zuk@yahoo.com', 8057890576, 'Diploma in Hardware Engineering', 'Oshodi-Isolo');

-- --------------------------------------------------------

--
-- Table structure for table `drivers_status`
--

CREATE TABLE IF NOT EXISTS `drivers_status` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Driver_id` varchar(7) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `drivers_status`
--

INSERT INTO `drivers_status` (`ID`, `Driver_id`, `Status`) VALUES
(7, 'drv8102', 'Inactive'),
(6, 'drv9140', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `e_request`
--

CREATE TABLE IF NOT EXISTS `e_request` (
  `Req_id` varchar(7) NOT NULL,
  `Names` varchar(50) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `rMethod` varchar(7) NOT NULL,
  `Message` varchar(160) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Location` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Req_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_request`
--

INSERT INTO `e_request` (`Req_id`, `Names`, `Mobile`, `rMethod`, `Message`, `Date`, `Location`) VALUES
('req8632', 'Damilola Adekoya', 7019949201, 'Call', 'I urkjsndkmd  cvdndjf d dd sjd sf ss fsj sfs ', '2015-03-15 12:29:16', 'Yaba'),
('req1075', 'Dare George', 8024152245, 'Call', 'A car crash at lekki epe express way', '2015-03-15 12:55:01', 'Ikoyi'),
('req2193', 'Efiong Nnamdi', 9069870777, 'Call', 'bcsjdfnjfvnsk jf cjdnskjds sjsncskms', '2015-03-16 12:14:43', 'Lagos Island'),
('req8302', 'Funmilayo Jimoh', 8102341141, 'Message', 'ahbahja wd wd wjd wd wd wd wjdwhdwd wd wjdbwjd', '2015-03-16 16:55:35', 'Isolo'),
('req4106', 'Wale Eliot', 7033890416, 'Message', 'jmwnd wd wf w wqkdnwkdnw wd kw dwk wkdwkdjwknw wfd wknwkdw wd wkdn w', '2015-03-16 21:35:49', 'Ikoyi'),
('req6743', 'Hamzat Danjuma', 8134458056, 'Call', 'ahbad d jqdbwjdnj w wjdbwdkwndn w djwbdwkdnwkdw dwjdwkdwk', '2015-03-16 21:37:24', 'Palmgroove'),
('req3879', 'Onawale Azeez', 7067234532, 'Message', 'kdnjwkdnw wkndwkfw wkdbwfkwf wfwkfhwidkbqq qkqhqbjdbd wdkhwihfwn', '2015-03-16 21:39:05', 'Shomolu'),
('req8694', 'jane', 9099867231, 'Call', 'received a call from surulere', '2015-03-20 15:27:08', ''),
('req1065', 'ken', 9099867231, 'Message', 'recieved a call', '2015-03-20 15:28:31', 'Yaba');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`ID`, `Name`) VALUES
(1, 'Mushin'),
(2, 'Surulere'),
(3, 'Ojuelegba/Yaba'),
(4, 'Lagos Island'),
(5, 'Ikeja'),
(6, 'Shomolu-Bariga'),
(7, 'Oshodi-Isolo'),
(8, 'Ikotun-Egbe'),
(9, 'Ejigbo'),
(10, 'Ikorodu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
