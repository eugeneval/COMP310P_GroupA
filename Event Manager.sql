-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2017 at 08:14 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Event Manager`
--
CREATE DATABASE IF NOT EXISTS `Event Manager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Event Manager`;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Description` text NOT NULL,
  `Date` date NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Venue_ID` int(5) NOT NULL,
  `Total_Tickets` int(5) UNSIGNED NOT NULL,
  `Ticket_Price` decimal(5,2) UNSIGNED NOT NULL,
  `Is_Active` tinyint(1) NOT NULL,
  `Media_File_Path` text NOT NULL,
  `Medi_File_Type` varchar(4) NOT NULL,
  `Category_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Interests`
--

CREATE TABLE `Interests` (
  `Intrest_ID` int(5) UNSIGNED NOT NULL,
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Tickets`
--

CREATE TABLE `Tickets` (
  `Ticket_ID` int(5) UNSIGNED NOT NULL,
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Ticket_Type_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Ticket_Type`
--

CREATE TABLE `Ticket_Type` (
  `Ticket_Type_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Created_by_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Admin_Priveleges` tinyint(1) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `Company` varchar(20) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Paypal_ID` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Venue`
--

CREATE TABLE `Venue` (
  `Venue_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Address` text NOT NULL,
  `Postcode` varchar(8) NOT NULL,
  `City` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Category_ID`),
  ADD UNIQUE KEY `Name` (`Name`),
  ADD UNIQUE KEY `Name_2` (`Name`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `events_category_id` (`Category_ID`);

--
-- Indexes for table `Interests`
--
ALTER TABLE `Interests`
  ADD PRIMARY KEY (`Intrest_ID`),
  ADD UNIQUE KEY `Interest Name` (`Name`),
  ADD KEY `interests_user_id` (`User_ID`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`Ticket_ID`),
  ADD KEY `tickets_event_id` (`Event_ID`),
  ADD KEY `tickets_use_id` (`User_ID`);

--
-- Indexes for table `Ticket_Type`
--
ALTER TABLE `Ticket_Type`
  ADD PRIMARY KEY (`Ticket_Type_ID`),
  ADD UNIQUE KEY `Ticket Type End` (`Name`),
  ADD KEY `ticket_type_creator_id` (`Created_by_User_ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `Venue`
--
ALTER TABLE `Venue`
  ADD PRIMARY KEY (`Venue_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `Category_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `Event_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Interests`
--
ALTER TABLE `Interests`
  MODIFY `Intrest_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `Ticket_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Ticket_Type`
--
ALTER TABLE `Ticket_Type`
  MODIFY `Ticket_Type_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Venue`
--
ALTER TABLE `Venue`
  MODIFY `Venue_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `events_category_id` FOREIGN KEY (`Category_ID`) REFERENCES `Category` (`Category_ID`);

--
-- Constraints for table `Interests`
--
ALTER TABLE `Interests`
  ADD CONSTRAINT `interests_user_id` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `tickets_event_id` FOREIGN KEY (`Event_ID`) REFERENCES `Events` (`Event_ID`),
  ADD CONSTRAINT `tickets_use_id` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Ticket_Type`
--
ALTER TABLE `Ticket_Type`
  ADD CONSTRAINT `ticket_type_creator_id` FOREIGN KEY (`Created_by_User_ID`) REFERENCES `User` (`User_ID`);
