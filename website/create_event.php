<?php

require 'functions.php';
$username = checkCurrentUser();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Create Event</title>
        <link href="styling.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <img src="resources/Logo.png" style="width:302px;height:86px;"/>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
            <ul>
                <li class="menubar">Logged in as: <?php echo $username; ?></li>
                <li class="menubar"><a href="login.php">Logout</a></li>
            </ul>
        </header>
        <form action="user_profile.php" method="POST">
            <fieldset>
                <legend>Event Description</legend>
                <p>Description</p><textarea name="message" rows="8" cols="29"></textarea><br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Event Details</legend>
                <p>Event Name</p> <input type="text" name="event_name">
                <p>Start Date/Time</p> <input type="datetime-local" name="start_date_time">
                <p>End Date/Time</p> <input type="datetime-local" name="end_date_time">
                <p>Video URL</p> <input type="text" name="video_url">
                <p>Location</p> <input type="text" name="location">
            </fieldset>
            <br />
            <fieldset>
                <legend>Ticket Information</legend>

                <p>Types of Tickets</p>
                <select name="ticket_type" size="1">
                    <option value="1">1</option>
                </select>
                <p>Ticket Name</p> <input type="text" name="ticket_name">
                <p>Ticket Start Date/Time</p> <input type="datetime-local" name="ticket_date_time">
                <p>Ticket End Date/Time</p> <input type="datetime-local" name="ticket_date_time">
                <p>Quantity</p> <input type="number" name="ticket_quantity" min="1" max="500">
                <br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Contact Information</legend>
                <p>Organiser Name</p> <input type="text" name="organiser_name">
                <p>Organiser Email</p> <input type="text" name="organiser_email">
                <p>Organiser Phone</p> <input type="text" name="organiser_phone">
            </fieldset>
            <br />
            <fieldset>
                <legend>Categorisation</legend>

                <p>Interests</p>
                <select name="interests" size="1">
                    <option value="Arts">Arts</option>
                    <option value="Business">Business</option>
                    <option value="Entrepreneurship">Entrepreneurship</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Networking">Networking</option>
                    <option value="Performance">Performance</option>
                    <option value="Personal Development">Personal Development</option>
                    <option value="Technology">Technology</option>
                    <option value="Workshops">Workshops</option>
                </select>
                <br />

                <p>Tags</p>
                <select name="tags" size="1">
                    <option value="Meetup">Meetup</option>
                    <option value="Artificial Intelligence">Artificial Intelligence</option>
                    <option value="WorkHardPlayHard">WorkHardPlayHard</option>

                </select>
                <br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Upload Event Image</legend>
                <input type="button" name="image" value="Choose Image" disabled>
            </fieldset>
            <input type="submit" value="Save"><input type="reset" value="Clear">
        </form>


    </body>
</html>
