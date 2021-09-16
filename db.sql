-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2021 at 03:00 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmscek`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `ArticleID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Text` text NOT NULL,
  `Category` int(11) DEFAULT NULL,
  `summary` text NOT NULL,
  `post_date` varchar(100) DEFAULT '',
  `revision_count` int(11) DEFAULT 0,
  `article_password` varchar(100) DEFAULT '',
  `status` int(11) DEFAULT 1,
  `token` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(3, 'Tech'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `pub_stat`
--

CREATE TABLE `pub_stat` (
  `status` int(11) NOT NULL,
  `statusName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pub_stat`
--

INSERT INTO `pub_stat` (`status`, `statusName`) VALUES
(1, 'Publish'),
(2, 'Draft'),
(3, 'Protected'),
(4, 'Private');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `temp_article`
--

CREATE TABLE `temp_article` (
  `ArticleID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Text` text NOT NULL,
  `Category` int(11) DEFAULT NULL,
  `summary` text NOT NULL,
  `post_date` varchar(100) DEFAULT '',
  `revision_count` int(11) DEFAULT 0,
  `article_password` varchar(100) DEFAULT '',
  `status` int(11) DEFAULT 1,
  `token` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `role`) VALUES
(1, 'admin', 'e5c2c41f3a568106e6a387ad28a0261e783a7aa2db7343ac438bb6bda9a70f5f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `versionlist`
--

CREATE TABLE `versionlist` (
  `versionId` varchar(10) NOT NULL,
  `versionDetail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ArticleID`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `pub_stat`
--
ALTER TABLE `pub_stat`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `temp_article`
--
ALTER TABLE `temp_article`
  ADD PRIMARY KEY (`ArticleID`),
  ADD KEY `Category` (`Category`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `versionlist`
--
ALTER TABLE `versionlist`
  ADD PRIMARY KEY (`versionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `ArticleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_article`
--
ALTER TABLE `temp_article`
  MODIFY `ArticleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `category` (`CategoryID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`RoleID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
