-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2015 at 09:17 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `campuschat_contacts`
--

CREATE TABLE IF NOT EXISTS `campuschat_contacts` (
  `user_sender` int(50) NOT NULL,
  `user_receiver` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuschat_contacts`
--

INSERT INTO `campuschat_contacts` (`user_sender`, `user_receiver`) VALUES
(1, 2),
(2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuschat_messages`
--

INSERT INTO `campuschat_messages` (`msg_id`, `msg_text`, `msg_sender`, `msg_receiver`, `msg_type`, `timestamp`) VALUES
(1, 'Hello Micheal this is prototype text.', 1, 2, 'TEXT', '2015-04-25 18:49:04'),
(2, 'Hi Fredrick got your prototype text.', 2, 1, 'TEXT', '2015-04-25 18:49:04'),
(3, 'Fred I did not get the prototype message.', 3, 1, 'TEXT', '2015-04-25 19:16:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campuschat_users`
--

INSERT INTO `campuschat_users` (`user_id`, `username`, `password`, `profile_pic`, `status`) VALUES
(1, 'fredrick.abayie', '1abc7eda679aa56fa6d9b65ad978dc4a', '', 'ONLINE'),
(2, 'micheal.annor', '061f107403560b468376f8cb1c9589ec', '', 'ONLINE'),
(3, 'kenneth.mensah', '19f3158fc4c6850f1c24ff13d485e6e9', '', 'ONLINE');

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
MODIFY `msg_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campuschat_users`
--
ALTER TABLE `campuschat_users`
MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
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
