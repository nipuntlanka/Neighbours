-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2015 at 12:02 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neighbours`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `fullname` varchar(30) NOT NULL,
  `User_ID` int(255) NOT NULL AUTO_INCREMENT,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone` int(20) NOT NULL,
  `pobox` varchar(10) NOT NULL,
  `street` varchar(20) NOT NULL,
  `city` varchar(10) NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fullname`, `User_ID`, `Password`, `Email`, `Phone`, `pobox`, `street`, `city`) VALUES
('nayana', 1, '1234', 'n.bhashitha@yahoo.co', 8543474, '', '', ''),
('nayana', 3, '123', 'n.bhashitha@yahoo.co', 98654, '', '', ''),
('asfsadff', 4, '123', 'afasdf', 0, 'sadfas', 'asdfsaf', 'asdfdsaf'),
('eqwewe', 5, '123', 'wwerwqer', 0, 'wqrwerwe', 'rwrwer', 'werwer'),
('Akila', 6, '1234', 'akila@gmail.com', 0, '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
