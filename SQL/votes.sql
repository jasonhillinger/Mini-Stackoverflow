-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.1.170
-- Generation Time: Nov 10, 2021 at 11:23 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soen341`
--

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `voterID` bigint(20) UNSIGNED NOT NULL,
  `questionID` bigint(10) UNSIGNED DEFAULT NULL,
  `answerID` bigint(10) UNSIGNED DEFAULT NULL,
  `hasVoted` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'BOOL',
  `upVote` tinyint(1) NOT NULL COMMENT 'BOOL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD KEY `user` (`voterID`),
  ADD KEY `questionVoted` (`questionID`),
  ADD KEY `answerVoted` (`answerID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `answerVoted` FOREIGN KEY (`answerID`) REFERENCES `answers` (`answerID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `questionVoted` FOREIGN KEY (`questionID`) REFERENCES `questions` (`questionID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `voter` FOREIGN KEY (`voterID`) REFERENCES `users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
