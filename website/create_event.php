<?php
////SETUP////////////////////////////////
require 'functions.php';
$username = checkCurrentUser();
$conn = db_connect();
$sql = "SELECT * FROM venue;";
$result = mysqli_query($conn, $sql);
/////////////////////////////////////////
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
            <a href="main.php"><img src="resources/Logo.png" style="width:302px;height:86px;"/></a>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
            <ul>
                <li class="menubar">Logged in as: <?php echo $username; ?></li>
                <li class="menubar"><a href="login.php">Logout</a></li>
            </ul>
        </header>
        <form action="event_details.php" method="POST">
            <fieldset>
                <legend>Event Details</legend>
                <p>Event Name</p> <input type="text" name="event_name" required>
                <p>Description</p><textarea name="description" rows="8" cols="29" required></textarea>
                <p>Start Date/Time</p> <input type="datetime-local" name="start_date_time" required>
                <p>End Date/Time</p> <input type="datetime-local" name="end_date_time" required>
                <!-- TODO: add default times? current year, etc. -->
                <p>Video URL</p> <input type="url" name="video_url" pattern="https?://.+" />
            </fieldset>
            <br />
            <fieldset>
                <legend>Location</legend>
                <p>Select a location:</p>
                <select name="venue" id='venue' size="1" onchange="newVenue()">
                    <option selected="true" disabled="disabled"></option>
                    <option value="new_venue">Create new venue</option>
                    <?php while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=\"".$row['Venue_ID']."\">".$row['Name']."</option>";
                    } ?>
                </select>
                <div id='new_venue' style="display:none;">
                <p>Venue Name</p> <input type="text" name="venue_name" />
                <p>Address</p> <input type="text" name="venue_address" />
                <p>Postcode</p> <input type="text" name="venue_postcode" />
                <p>City</p> <input type="text" name="venue_city"  />
                <p>Phone Number</p> <input type="tel" name="venue_phone" />
                </div>
            </fieldset>
            <br />
            <fieldset>
                <legend>Ticket Information</legend>

                <p>Types of Tickets</p>
                <select name="ticket_type" size="1" onchange="newVenue()">
                    <option value="1">1</option>
                </select>
                <p>Ticket Name</p> <input type="text" name="ticket_name">
                <p>Ticket Price</p> <input type="number" name="ticket_price" min="0.00" max="100.00" step="0.01" />
                <p>Ticket Start Date/Time</p> <input type="datetime-local" name="ticket_start_date_time">
                <p>Ticket End Date/Time</p> <input type="datetime-local" name="ticket_end_date_time">
                <!-- TODO: JS to prevent end date being before end date -->
                <p>Quantity</p> <input type="number" name="ticket_quantity" min="1" max="500">
                <br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Categorisation</legend>
                <p>Interests</p>
                <select name="category" size="1">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"".$row['Category_ID']."\">".$row['Name']."</option>";
                        }
                     ?>
                </select>
                <br />
                <!-- IDEA: Tags implemented as checkboxes maybe? -->
                <p>Tags <br /><small>use ctrl or cmd to select multiple tags</small></p>
                <select multiple name="tags[]" size="10">
                    <option selected="true" disabled="disabled"></option>
                    <?php
                        $sql = "SELECT * FROM tag";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"".$row['Tag_ID']."\">".$row['Name']."</option>";
                        }
                        mysqli_close($conn);
                     ?>
                </select>
                <br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Upload Event Image</legend>
                <input type='file' />
                <br><img id="myImg" src="#"  />
            </fieldset>
            <br />
            <input type="submit" value="Save"><n/>
            <input type="reset" value="Clear">
            <script src="create_event.js"></script>
        </form>

    <script src="javascript/event_creation.js"></script>
    </body>
</html>
