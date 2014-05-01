-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2014 at 12:24 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `authors`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `title` varchar(255) NOT NULL,
  `author1` varchar(255) NOT NULL,
  `author2` varchar(255) NOT NULL,
  `author3` varchar(255) NOT NULL,
  `author4` varchar(255) NOT NULL,
  `author5` varchar(255) NOT NULL,
  `author6` varchar(255) NOT NULL,
  `author7` varchar(255) NOT NULL,
  `author8` varchar(255) NOT NULL,
  `author9` varchar(255) NOT NULL,
  `author10` varchar(255) NOT NULL,
  `author11` varchar(255) NOT NULL,
  `author12` varchar(255) NOT NULL,
  `author13` varchar(255) NOT NULL,
  `author14` varchar(255) NOT NULL,
  `author15` varchar(255) NOT NULL,
  `author16` varchar(255) NOT NULL,
  `author17` varchar(255) NOT NULL,
  `author18` varchar(255) NOT NULL,
  `author19` varchar(255) NOT NULL,
  `author20` varchar(255) NOT NULL,
  `author21` varchar(255) NOT NULL,
  `author22` varchar(255) NOT NULL,
  `author23` varchar(255) NOT NULL,
  `author24` varchar(255) NOT NULL,
  `author25` varchar(255) NOT NULL,
  `author26` varchar(255) NOT NULL,
  `author27` varchar(255) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authorlist`
--

CREATE TABLE IF NOT EXISTS `authorlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `edges`
--

CREATE TABLE IF NOT EXISTS `edges` (
  `source` int(255) NOT NULL,
  `target` int(255) NOT NULL,
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `weight` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
