-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2017 at 03:15 PM
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
  `Name` varchar(20) NOT NULL,
  `Created_By_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE `Events` (
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Description` text NOT NULL,
  `Organiser_User_ID` int(5) UNSIGNED NOT NULL,
  `Start_DateTime` datetime NOT NULL,
  `End_DateTime` datetime NOT NULL,
  `Venue_ID` int(5) UNSIGNED NOT NULL,
  `Total_Tickets` int(5) UNSIGNED NOT NULL,
  `Ticket_Price` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `Is_Active` tinyint(1) NOT NULL,
  `Media_File_Path` text NOT NULL,
  `Media_File_Type` varchar(5) NOT NULL,
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Num_Thumbs_Up` int(5) UNSIGNED NOT NULL,
  `Num_Thumbs_Down` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Event_Tag`
--

CREATE TABLE `Event_Tag` (
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `Tag_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

CREATE TABLE `Review` (
  `Review_ID` int(5) UNSIGNED NOT NULL,
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Rating` int(1) UNSIGNED NOT NULL,
  `Review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE `Tag` (
  `Tag_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Created_by_User_ID` int(5) UNSIGNED NOT NULL
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
  `Name` varchar(30) NOT NULL,
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
  `Password` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `Company` varchar(20) NOT NULL,
  `Phone_Number` varchar(12) NOT NULL,
  `Paypal_Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User_Tag`
--

CREATE TABLE `User_Tag` (
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Tag_ID` int(5) UNSIGNED NOT NULL
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
  `City` varchar(12) NOT NULL,
  `Phone_Number` varchar(12) NOT NULL,
  `Created_By_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Category_ID`),
  ADD KEY `Created_By_User_ID` (`Created_By_User_ID`);

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `events_category_id` (`Category_ID`),
  ADD KEY `Created_By_User_ID` (`Organiser_User_ID`),
  ADD KEY `Venue_ID` (`Venue_ID`);

--
-- Indexes for table `Event_Tag`
--
ALTER TABLE `Event_Tag`
  ADD KEY `Event_ID` (`Event_ID`),
  ADD KEY `Tag_ID` (`Tag_ID`);

--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `review_user_id` (`User_ID`),
  ADD KEY `Event_ID` (`Event_ID`);

--
-- Indexes for table `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`Tag_ID`),
  ADD KEY `Created_by_User_ID` (`Created_by_User_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`Ticket_ID`),
  ADD KEY `tickets_event_id` (`Event_ID`),
  ADD KEY `tickets_use_id` (`User_ID`),
  ADD KEY `Ticket_Type_ID` (`Ticket_Type_ID`);

--
-- Indexes for table `Ticket_Type`
--
ALTER TABLE `Ticket_Type`
  ADD PRIMARY KEY (`Ticket_Type_ID`),
  ADD KEY `ticket_type_creator_id` (`Created_by_User_ID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `User_Tag`
--
ALTER TABLE `User_Tag`
  ADD KEY `Tag_ID` (`Tag_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `Venue`
--
ALTER TABLE `Venue`
  ADD PRIMARY KEY (`Venue_ID`),
  ADD KEY `Created_By_User_ID` (`Created_By_User_ID`);

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
-- AUTO_INCREMENT for table `Review`
--
ALTER TABLE `Review`
  MODIFY `Review_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tag`
--
ALTER TABLE `Tag`
  MODIFY `Tag_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `Category`
--
ALTER TABLE `Category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Created_By_User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Events`
--
ALTER TABLE `Events`
  ADD CONSTRAINT `events_category_id` FOREIGN KEY (`Category_ID`) REFERENCES `Category` (`Category_ID`),
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Organiser_User_ID`) REFERENCES `User` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`Venue_ID`) REFERENCES `Venue` (`Venue_ID`);

--
-- Constraints for table `Event_Tag`
--
ALTER TABLE `Event_Tag`
  ADD CONSTRAINT `event_tag_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `Events` (`Event_ID`),
  ADD CONSTRAINT `event_tag_ibfk_2` FOREIGN KEY (`Tag_ID`) REFERENCES `Tag` (`Tag_ID`);

--
-- Constraints for table `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `Events` (`Event_ID`),
  ADD CONSTRAINT `review_user_id` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Tag`
--
ALTER TABLE `Tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`Created_by_User_ID`) REFERENCES `User` (`User_ID`),
  ADD CONSTRAINT `tag_ibfk_2` FOREIGN KEY (`Category_ID`) REFERENCES `Category` (`Category_ID`);

--
-- Constraints for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `tickets_event_id` FOREIGN KEY (`Event_ID`) REFERENCES `Events` (`Event_ID`),
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`Ticket_Type_ID`) REFERENCES `Ticket_Type` (`Ticket_Type_ID`),
  ADD CONSTRAINT `tickets_use_id` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Ticket_Type`
--
ALTER TABLE `Ticket_Type`
  ADD CONSTRAINT `ticket_type_creator_id` FOREIGN KEY (`Created_by_User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `User_Tag`
--
ALTER TABLE `User_Tag`
  ADD CONSTRAINT `user_tag_ibfk_1` FOREIGN KEY (`Tag_ID`) REFERENCES `Tag` (`Tag_ID`),
  ADD CONSTRAINT `user_tag_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `User` (`User_ID`);

--
-- Constraints for table `Venue`
--
ALTER TABLE `Venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`Created_By_User_ID`) REFERENCES `User` (`User_ID`);
