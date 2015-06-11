-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 03:48 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `neighbors`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`grp_id` int(11) NOT NULL,
  `grp_name` varchar(100) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL,
  `grp_radius` double NOT NULL,
  `no_of_members` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`grp_id`, `grp_name`, `lat`, `long`, `grp_radius`, `no_of_members`) VALUES
(1, 'grp0', 7.25, 80.25, 150, 1),
(2, 'group_1', 7.145705475153275, 80.05490752316439, 200, 2),
(3, 'ddd', 7.143831850853671, 80.05593749336094, 200, 1),
(4, 'aaa', 7.14383853671, 80.055749336094, 200, 1),
(5, 'eeeeeeee', 8.32252365, 81.565756465, 100, 45),
(6, 'fffffffff', 7.145705475153275, 77.2658975, 400, 12),
(7, 'assssssss', 7.145705475153275, 80.05598754365879, 100, 7);

-- --------------------------------------------------------

--
-- Table structure for table `userlocation`
--

CREATE TABLE IF NOT EXISTS `userlocation` (
  `User_ID` int(11) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`User_ID` int(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Phone` int(20) NOT NULL,
  `pobox` varchar(10) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `lat` double NOT NULL,
  `long` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `fullname`, `Email`, `Password`, `Phone`, `pobox`, `street`, `city`, `lat`, `long`) VALUES
(1, 'Sachith Ranga', 'rangaranasingha@gmail.com', '5b0843f88a2527510aa4775dc29869e1', 332288812, '123', 'kalagedihena road', 'veyangoda', 7.1540552, 80.0593752),
(2, 'neighboursUser1', 'neighboursucsc@gmail.com', '7f6ffaa6bb0b408017b62254211691b5', 2147483647, '345', 'abc', 'colombo', 6.9241390472047, 79.864204158753),
(3, 'ddd', 'sac@kk.lk', '4eae35f1b35977a00ebd8086c259d4c9', 2147483647, '12', '555', 'galle', 6.0535185, 80.2209773),
(4, 'ddd', 'hgh@gf.lk', '77963b7a931377ad4ab5ad6a9cd718aa', 2147483647, '12', '555', 'veyangoda', 7.1540552, 80.0593752),
(5, 'dg', 'df@fgdg.kjjkjk', 'b3967a0e938dc2a6340e258630febd5a', 2147483647, 'jh', 'hjgh', 'negombo', 7.2060863, 79.8792899);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `userlocation`
--
ALTER TABLE `userlocation`
 ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`User_ID`), ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `grp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `User_ID` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `userlocation`
--
ALTER TABLE `userlocation`
ADD CONSTRAINT `userlocation_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
