<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/

////SETUP////////////////////////////////
require 'functions.php';
$username = checkCurrentUser();
$conn = db_connect();
$sql = "SELECT * FROM venue;";
$result_venues = mysqli_query($conn, $sql);
$event_ID = $_COOKIE["event"];
$sql = "SELECT * FROM events WHERE Event_ID = $event_ID";
$result_event = mysqli_query($conn, $sql);
$event = mysqli_fetch_assoc($result_event);
/////////////////////////////////////////
// TODO: existing values not showing up
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Edit Event</title>
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
        <form action="event_details.php" method="post" onsubmit="return eventEditCookie(<?php echo $event_ID ?>)">
            <fieldset>
                <legend>Event Details</legend>
                <p>Event Name</p> <input type="text" name="event_name" value="<?php echo $event['Name'] ?>" >
                <p>Description</p><textarea name="description" rows="8" cols="29" ><?php echo $event['Description'] ?></textarea>
                <p>Start Date/Time</p> <input type="datetime-local" name="start_date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['Start_DateTime'])) ?>" >
                <p>End Date/Time</p> <input type="datetime-local" name="end_date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['Start_DateTime'])) ?>" >
            </fieldset>
            <br />
            <fieldset>
                <legend>Location</legend>
                <p>Select a location:</p>
                <select name="venue" id='venue' size="1" onchange="newVenue()" >
                    <option selected="true" disabled="disabled"></option>
                    <option value="new_venue">Create new venue</option>
                    <?php while($row = mysqli_fetch_assoc($result_venues)) {
                        echo "<option value=\"".$row['Venue_ID']."\"";
                        if ($row['Venue_ID'] == $event['Venue_ID']) {
                            echo "selected=\"selected\"";
                        }
                        echo ">".$row['Name']."</option>";
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


                <p>Ticket Price</p> <input type="number" name="ticket_price" min="0.00" max="100.00" step="0.01" value="<?php echo $event['Ticket_Price'] ?>"/>
                <p>Ticket Start Date/Time</p> <input type="datetime-local" name="ticket_start_date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['Ticket_Sale_Start_DateTime'])) ?>">
                <p>Ticket End Date/Time</p> <input type="datetime-local" name="ticket_end_date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($event['Ticket_Sale_End_DateTime'])) ?>">
                <p>Quantity</p> <input type="number" name="ticket_quantity" min="1" max="500" value="<?php echo $event['Total_Tickets'] ?>">
                <br />
            </fieldset>
            <br />
            <fieldset>
                <legend>Categorisation</legend>
                <p>Interests</p>
                <select name="category" size="1" >
                    <option disabled="disabled"></option>
                    <?php
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"".$row['Category_ID']."\" ";
                            if ($row['Category_ID'] == $event['Category_ID']) {
                                echo "selected=\"selected\"";
                            }
                            echo " >".$row['Name']."</option>";
                        }
                     ?>
                </select>
                <br />
                <!-- IDEA: Tags implemented as checkboxes maybe? -->
                <!-- TODO: be able to add new tags -->
                <p>Tags <br /><small>use ctrl or cmd to select multiple tags<br />Note that you will have to select all tags again</small></p>
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
            <!-- <fieldset> TODO: implement
                <legend>Upload Event Image</legend>
                <input type='file' />
                <br><img id="myImg" src="#"  />
            </fieldset>
            <br /> -->
            <input type="submit" value="Save"><n/>
            <input type="reset" value="Clear">
            <script src="create_event.js"></script>
        </form>

    <script src="javascript/event_creation.js"></script>
    </body>
    <script src="libraries/js.cookie.js"></script>
    <script src="javascript/navigation.js"></script>
</html>
