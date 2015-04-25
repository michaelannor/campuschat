-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2015 at 07:37 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `campuschat`
--
CREATE DATABASE IF NOT EXISTS `campuschat` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `campuschat`;

-- --------------------------------------------------------

--
-- Table structure for table `campuschat_contacts`
--

CREATE TABLE IF NOT EXISTS `campuschat_contacts` (
  `user_sender` int(50) NOT NULL,
  `user_receiver` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campuschat_messages`
--

CREATE TABLE IF NOT EXISTS `campuschat_messages` (
`msg_id` int(50) NOT NULL,
  `msg_text` longtext NOT NULL,
  `msg_sender` int(50) NOT NULL,
  `msg_receiver` int(50) NOT NULL,
  `msg_type` enum('TEXT','PICTURE','VIDEO') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campuschat_users`
--

CREATE TABLE IF NOT EXISTS `campuschat_users` (
`user_id` int(50) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(35) NOT NULL,
  `profile_pic` text NOT NULL,
  `status` enum('ONLINE','OFFLINE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campuschat_contacts`
--
ALTER TABLE `campuschat_contacts`
 ADD KEY `user_sender` (`user_sender`,`user_receiver`), ADD KEY `user_receiver` (`user_receiver`);

--
-- Indexes for table `campuschat_messages`
--
ALTER TABLE `campuschat_messages`
 ADD PRIMARY KEY (`msg_id`), ADD KEY `msg_sender` (`msg_sender`,`msg_receiver`), ADD KEY `msg_receiver` (`msg_receiver`);

--
-- Indexes for table `campuschat_users`
--
ALTER TABLE `campuschat_users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campuschat_messages`
--
ALTER TABLE `campuschat_messages`
MODIFY `msg_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campuschat_users`
--
ALTER TABLE `campuschat_users`
MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `campuschat_contacts`
--
ALTER TABLE `campuschat_contacts`
ADD CONSTRAINT `campuschat_contacts_ibfk_1` FOREIGN KEY (`user_sender`) REFERENCES `campuschat_users` (`user_id`),
ADD CONSTRAINT `campuschat_contacts_ibfk_2` FOREIGN KEY (`user_receiver`) REFERENCES `campuschat_users` (`user_id`);

--
-- Constraints for table `campuschat_messages`
--
ALTER TABLE `campuschat_messages`
ADD CONSTRAINT `campuschat_messages_ibfk_1` FOREIGN KEY (`msg_sender`) REFERENCES `campuschat_users` (`user_id`),
ADD CONSTRAINT `campuschat_messages_ibfk_2` FOREIGN KEY (`msg_receiver`) REFERENCES `campuschat_users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
