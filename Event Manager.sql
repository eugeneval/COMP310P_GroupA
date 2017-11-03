-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 03, 2017 at 01:10 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `event manager`
--
CREATE DATABASE IF NOT EXISTS `event manager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `event manager`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Created_By_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Name`, `Created_By_User_ID`) VALUES
(1, 'Arts', 1),
(2, 'Business', 1),
(3, 'Entrepreneurship', 1),
(4, 'Finance', 1),
(5, 'Marketing', 1),
(6, 'Networking', 1),
(7, 'Performance', 1),
(8, 'Personal Development', 1),
(9, 'Technology', 1),
(10, 'Workshops', 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Description` text NOT NULL,
  `Organiser_User_ID` int(5) UNSIGNED NOT NULL,
  `Start_DateTime` datetime NOT NULL,
  `End_DateTime` datetime NOT NULL,
  `Venue_ID` int(5) UNSIGNED NOT NULL,
  `Total_Tickets` int(5) UNSIGNED NOT NULL,
  `Ticket_Sale_Start_DateTime` datetime NOT NULL,
  `Ticket_Sale_End_DateTime` datetime NOT NULL,
  `Ticket_Price` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `Is_Active` tinyint(1) NOT NULL,
  `Media_File_Path` text NOT NULL,
  `Media_File_Type` varchar(5) NOT NULL,
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Num_Thumbs_Up` int(5) UNSIGNED NOT NULL,
  `Num_Thumbs_Down` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`Event_ID`, `Name`, `Description`, `Organiser_User_ID`, `Start_DateTime`, `End_DateTime`, `Venue_ID`, `Total_Tickets`, `Ticket_Sale_Start_DateTime`, `Ticket_Sale_End_DateTime`, `Ticket_Price`, `Is_Active`, `Media_File_Path`, `Media_File_Type`, `Category_ID`, `Num_Thumbs_Up`, `Num_Thumbs_Down`) VALUES
(1, 'Hackstart 2017', 'What\'s the plan for Saturday?\r\nCheck out:\r\n\r\n\"Hackstart\"\r\n\r\nAre you a beginner or advanced in coding? Well, this one\'s for all students interested in tech.\r\n\r\nHackstart is an 8 hour event designed for 14-19 year olds who are hoping to explore the field of Computer Science. \r\nWorkshops and tech talks, with topics ranging from machine learning to game development , will be run throughout the day by students at UCL.\r\n\r\nGet your hands on some coding tasks, learn some theoretical computer science, and speak to our current students about Computer Science and UCL.\r\n\r\nIt\'s a win-win! See you there!', 1, '2017-10-25 11:30:00', '2017-10-25 13:00:00', 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.00', 1, 'C:\\Users\\gimaf\\Documents\\UCL\\Motivez\\Images\\Hackstart2017', 'JPEG', 9, 1, 0),
(2, 'Commerzbank Internship Talk', 'What\'s the plan for Monday?\r\n\r\nCheck out: Commerzbank Internship Talk\r\n\r\nFind out what a career in finance looks like!\r\n\r\nWe will be interviewing a senior director of Commerzbank about what work is really like in a bank\r\n\r\nThere will be a 30-minute networking session afterwards with free drinks. You can get a potential internship from this', 1, '2017-10-25 13:00:00', '2017-10-25 18:00:00', 2, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.00', 1, 'C:\\Users\\gimaf\\Documents\\UCL\\Motivez\\Images\\Commerzbank', 'PNG', 4, 2, 1),
(3, 'Black in Engineering', 'What\'s the plan for Thursday?\r\n\r\nCheck out: Black in Engineering, Redressing the balance of ethnic minority students\r\n\r\nEngineering has a conversion problem. Why is only 7% of the workforce from Black and Minority Ethnic (BME) backgrounds, yet around 23% of UK engineering students are from a BME background? Research from the Royal Academy of Engineering [1] shows stark differences in employment outcomes between engineering graduates of white and minority ethnic origin. There was a 20 percentage point difference between the proportion of white engineering graduates entering full-time employment (71%) and their black and minority ethnic (BME) counterparts (51%) after 6 months.\r\n\r\nThere is evidence to suggest that students from BME backgrounds may not always have as much social capital to draw on as their white counterparts. Also, current student recruitment is often targeted at universities with lower proportions of BME students.\r\nYou are invited to join EqualEngineers, in partnership with UCL, to explore some questions around barriers within education attainment and barriers at the transition from education to employment. A panel of leading experts in engineering education, industry and diversity and inclusion advocacy will share their thoughts and opinions on the barriers facing students. Audience participation will be sought for sharing ideas and insights into possible solutions people can do at both the individual and organisational levels to help redress the balance.\r\n[1] “Employment outcomes of engineering graduates: key factors and diversity characteristics”, Royal Academy of Engineering, November 2016 http://www.raeng.org.uk/publications/reports/employment-outcomes-of-engineering-graduates-key-f\r\nPanel:\r\nDr Mark McBride-Wright CEng MIChemE, Founder & Managing Director of EqualEngineers\r\nDr Michael Sulu, Research Associate, Advanced Centre for Biochemical Engineering, UCL\r\nDr Nike Folayan, Chair of the Association for Black & Minority Ethnic Engineers (AFBE-UK)\r\nVivienne Aiyela CIPD, Senior Diversity & Inclusion Consultant\r\nDr Victor Olisa QPM, Visiting Fellow at London School of Economics and Political Science\r\n\r\nSchedule:\r\n6:00pm Guests arrive and network.\r\n6:30pm Panel discussion starts\r\n7:15pm Q&A / Audience input for solutions\r\n7:45pm Networking till close\r\n8:30pm Event close', 1, '2017-10-24 21:00:00', '2017-10-24 22:00:00', 2, 100, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5.00', 0, 'C:\\Users\\gimaf\\Documents\\UCL\\Motivez\\Images\\Blackinengineering', 'JPEG', 10, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_tag`
--

CREATE TABLE `event_tag` (
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `Tag_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_tag`
--

INSERT INTO `event_tag` (`Event_ID`, `Tag_ID`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Review_ID` int(5) UNSIGNED NOT NULL,
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Rating` int(1) UNSIGNED NOT NULL,
  `Review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Review_ID`, `Event_ID`, `User_ID`, `Rating`, `Review`) VALUES
(1, 1, 1, 5, 'The event was amazing last year! I\'m definitely looking forward to this :)'),
(2, 2, 1, 3, 'After attending this event last month, I secured a competitive internship at Commerzbank. This is a great opportunity!'),
(3, 3, 1, 4, 'This will be perfect for those interested in learning about the diversity in engineering. Particularly, the contributions of the black community in the engineering industry to celebrate Black History Month.');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `Tag_ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Category_ID` int(5) UNSIGNED NOT NULL,
  `Created_by_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`Tag_ID`, `Name`, `Category_ID`, `Created_by_User_ID`) VALUES
(1, 'Photography', 1, 1),
(2, 'Painting', 1, 1),
(3, 'Architecture', 1, 1),
(4, 'Accounting', 2, 1),
(5, 'Tax', 2, 1),
(6, 'Management', 2, 1),
(7, 'MVP', 3, 1),
(8, 'Pivot', 3, 1),
(9, 'Founder', 3, 1),
(10, 'Programming', 9, 1),
(11, 'Internships', 4, 1),
(12, 'Diversity', 9, 1),
(13, 'Marketing Hacks', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `Ticket_ID` int(5) UNSIGNED NOT NULL,
  `Event_ID` int(5) UNSIGNED NOT NULL,
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Ticket_Type_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`Ticket_ID`, `Event_ID`, `User_ID`, `Ticket_Type_ID`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 2),
(3, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE `ticket_type` (
  `Ticket_Type_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Created_by_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`Ticket_Type_ID`, `Name`, `Created_by_User_ID`) VALUES
(1, 'Early Bird', 1),
(2, 'Standard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Admin_Priveleges` tinyint(1) NOT NULL DEFAULT '0',
  `Name` varchar(40) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `Company` varchar(20) NOT NULL,
  `Phone_Number` varchar(12) NOT NULL,
  `Paypal_Address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `Admin_Priveleges`, `Name`, `Username`, `Password`, `Email`, `Address`, `Company`, `Phone_Number`, `Paypal_Address`) VALUES
(1, 1, 'George', 'George', 'George', 'gimafidon@live.co.uk', 'Gower Street', 'Motivez', '07943497163', 'gimafidon@live.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `user_tag`
--

CREATE TABLE `user_tag` (
  `User_ID` int(5) UNSIGNED NOT NULL,
  `Tag_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_tag`
--

INSERT INTO `user_tag` (`User_ID`, `Tag_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `Venue_ID` int(5) UNSIGNED NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Address` text NOT NULL,
  `Postcode` varchar(8) NOT NULL,
  `City` varchar(12) NOT NULL,
  `Phone_Number` varchar(12) NOT NULL,
  `Created_By_User_ID` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`Venue_ID`, `Name`, `Address`, `Postcode`, `City`, `Phone_Number`, `Created_By_User_ID`) VALUES
(1, 'UCL Roberts Building', 'Malet Place Engineering Building', 'WC1E 7JG', 'London', '02076797062', 1),
(2, 'UCL Foster Court', 'Foster Court B28 - Public Cluster \r\nGower St, Bloomsbury', 'WC1E 6BT', 'London', '02076797062', 1),
(3, 'UCL Cruciform', 'Cruciform\r\nGower St, Bloomsbury', 'WC1E 6BT', 'London', '02076797039', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`),
  ADD KEY `Created_By_User_ID` (`Created_By_User_ID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`Event_ID`),
  ADD KEY `events_category_id` (`Category_ID`),
  ADD KEY `Created_By_User_ID` (`Organiser_User_ID`),
  ADD KEY `Venue_ID` (`Venue_ID`);

--
-- Indexes for table `event_tag`
--
ALTER TABLE `event_tag`
  ADD KEY `Event_ID` (`Event_ID`),
  ADD KEY `Tag_ID` (`Tag_ID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `review_user_id` (`User_ID`),
  ADD KEY `Event_ID` (`Event_ID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`Tag_ID`),
  ADD KEY `Created_by_User_ID` (`Created_by_User_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`Ticket_ID`),
  ADD KEY `tickets_event_id` (`Event_ID`),
  ADD KEY `tickets_use_id` (`User_ID`),
  ADD KEY `Ticket_Type_ID` (`Ticket_Type_ID`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD PRIMARY KEY (`Ticket_Type_ID`),
  ADD KEY `ticket_type_creator_id` (`Created_by_User_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD KEY `Tag_ID` (`Tag_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`Venue_ID`),
  ADD KEY `Created_By_User_ID` (`Created_By_User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `Event_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Review_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `Tag_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `Ticket_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
  MODIFY `Ticket_Type_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `Venue_ID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Created_By_User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Organiser_User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`Venue_ID`) REFERENCES `venue` (`Venue_ID`);

--
-- Constraints for table `event_tag`
--
ALTER TABLE `event_tag`
  ADD CONSTRAINT `event_tag_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  ADD CONSTRAINT `event_tag_ibfk_2` FOREIGN KEY (`Tag_ID`) REFERENCES `tag` (`Tag_ID`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  ADD CONSTRAINT `review_user_id` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`Created_by_User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `tag_ibfk_2` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id` FOREIGN KEY (`Event_ID`) REFERENCES `events` (`Event_ID`),
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`Ticket_Type_ID`) REFERENCES `ticket_type` (`Ticket_Type_ID`),
  ADD CONSTRAINT `tickets_use_id` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `ticket_type`
--
ALTER TABLE `ticket_type`
  ADD CONSTRAINT `ticket_type_creator_id` FOREIGN KEY (`Created_by_User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `user_tag`
--
ALTER TABLE `user_tag`
  ADD CONSTRAINT `user_tag_ibfk_1` FOREIGN KEY (`Tag_ID`) REFERENCES `tag` (`Tag_ID`),
  ADD CONSTRAINT `user_tag_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`Created_By_User_ID`) REFERENCES `user` (`User_ID`);
