/*1) Users can register with the system and create accounts.*/

--Creates a new user.
INSERT INTO `user` (`User_ID`, `Admin_Priveleges`, `Name`, `Username`, `Password`, `Email`, `Address`, `Company`, `Phone_Number`, `Paypal_Address`) VALUES
(1, 1, 'George', 'George', 'George', 'gimafidon@live.co.uk', 'Gower Street', 'Motivez', '07943497163', 'gimafidon@live.co.uk');

/*2) A user may create an event, setting suitable conditions and features of the event including the description, location, date, categorisation, number of tickets available and end date.*/

--Creates an event.
INSERT INTO `events` (`Event_ID`, `Name`, `Description`, `Organiser_User_ID`, `Start_DateTime`, `End_DateTime`, `Venue_ID`, `Total_Tickets`, `Ticket_Price`, `Is_Active`, `Media_File_Path`, `Media_File_Type`, `Category_ID`, `Num_Thumbs_Up`, `Num_Thumbs_Down`) VALUES
(1, 'Hackstart 2017', 'What\'s the plan for Saturday?\r\nCheck out:\r\n\r\n\"Hackstart\"\r\n\r\nAre you a beginner or advanced in coding? Well, this one\'s for all students interested in tech.\r\n\r\nHackstart is an 8 hour event designed for 14-19 year olds who are hoping to explore the field of Computer Science. \r\nWorkshops and tech talks, with topics ranging from machine learning to game development , will be run throughout the day by students at UCL.\r\n\r\nGet your hands on some coding tasks, learn some theoretical computer science, and speak to our current students about Computer Science and UCL.\r\n\r\nIt\'s a win-win! See you there!', 1, '2017-10-25 11:30:00', '2017-10-25 13:00:00', 1, 2, 0.00, 1, 'C:\\Users\\gimaf\\Documents\\UCL\\Motivez\\Images\\Hackstart2017', 'JPEG', 9, 1, 0);


/*3) A user can search the system for categories of events and can browse events within certain categories or timeframes.*/

--This query will return Technology events happening in a specific week.
SELECT e.Name, e.Description
FROM events e
JOIN category c ON e.Category_ID = c.Category_ID
WHERE c.Name = 'Technology'
AND e.Start_DateTime < '2017-10-30 00:00:00'
AND e.Start_DateTime > '2017-10-23 00:00:00';

/*4) A user can book a ticket for an event. The system will manage the ticket sales until the set end time. No further ticket sales will be permitted if the event is full or if the end time for ticket sales of that event has been reached.*/

--Returns the end of ticket sale time for a specific event so that the system can compare it with the current time
SELECT Ticket_Sale_End_DateTime
FROM events
WHERE Event_ID = 1;

--Returns the total number of tickets for an event and how many have been sold so far
SELECT e.Name, e.Total_Tickets, COUNT(t.Ticket_ID) AS "Tickets Sold"
FROM events e
JOIN tickets t ON t.Event_ID = e.Event_ID
GROUP BY e.Event_ID;

/*5) Participants can view a list of events they are attending and receive emailed updates on events that are imminent.*/

--Returns the names and start times of all the events a user has tickets for.
SELECT DISTINCT e.Name, e.Start_DateTime
FROM events e
JOIN tickets t on t.Event_ID = e.Event_ID
JOIN user u ON u.User_ID = t.User_ID
WHERE u.User_ID = 1;

/*6) Users hosting events can view the progress of ticket sales and generate a list of participants for an event.*/

--Returns the names of all people who have tickets for an event.
SELECT DISTINCT u.Name
FROM User u
JOIN Tickets t ON u.User_ID = t.USER_ID
JOIN Events e ON e.Event_ID = t.Event_ID
WHERE e.Event_ID = 1;

/*7) Participants can give feedback and ratings on events after they have happened. Ratings and feedback are visible to other users.*/

--Returns all the reviews for a given event.
SELECT r.Rating, r.Review
FROM review r
JOIN events e ON e.Event_ID = r.Event_ID
WHERE e.Event_ID = 1;
