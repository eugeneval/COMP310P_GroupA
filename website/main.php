<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/

require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE["user_ID"];

$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["skippedInterests"] == 1) {
        setcookie("skippedInterests", True, time() + 60*60*24);
    }

}

// Redirect to selecting interests page if the user doesn't have any once every 24 hours.
if (!isset($_COOKIE["skippedInterests"])) {
    $sql = "SELECT * FROM user u
    JOIN user_tag ut ON u.User_ID = ut.User_ID
    WHERE u.Username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header('Location: select_interests.php');
        exit();
    }
}


 ?>

<!DOCTYPE html>
<html>
    <head>
      <title>Eventi</title>
      <link href="styling.css" rel="stylesheet">
      <script src="libraries/p5.min.js"></script>
      <script src="libraries/js.cookie.js"></script>
    </head>
    <body>
        <header>
          <header>
            <a href="main.php"><img src="resources/Logo.png" style="width:302px;height:86px;"/></a>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
            <ul>
                <li class="menubar">Logged in as: <?php echo $username; ?></li>
                <li class="menubar"><a href="login.php">Logout</a></li>
            </ul>
        </header>
        <div class="sidebar">
            <form action='create_event.php' onsubmit="return check_admin()">
                <input type="submit" value="Create New Event" id="newEvent"/>
            </form>
            <form action='user_profile.php'>
                <input type="submit" value="User Profile" />
            </form>
            <form action='tickets.php'>
                <input type="submit" value="Your Tickets" />
            </form>
            <form action='search.php'>
                <input type="submit" value="Search" />
            </form>
        </div>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'past_events')">Past Events</button>
            <button class="tablinks" onclick="openTab(event, 'this_week')">This Week</button>
            <button class="tablinks" onclick="openTab(event, 'next_week')">Next Week</button>
            <button class="tablinks" onclick="openTab(event, 'upcoming')">Upcoming</button>
            <button class="tablinks" onclick="openTab(event, 'recommended')">Recommended</button>
        </div>
        <div class="eventsList" id="past_events">
            <?php
            $sql = "SELECT Event_ID, Name, Description
            FROM events
            WHERE CAST(Start_DateTime AS DATE) <= CURRENT_DATE
            ORDER BY Start_DateTime ASC";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                        echo "<form action='event_details.php' onclick=\"return  eventCookie(".$row['Event_ID'].")\">
                        <input type=\"submit\" value=\"Event Details\" />
                        </form>";
                    }
                }
                else {
                    echo "0 results";
                }

             ?>
        </div>
        <div class="eventsList" id="this_week">
            <?php
            $sql = "SELECT Event_ID, Name, Description
            FROM events
            WHERE CAST(Start_DateTime AS DATE) >= CURRENT_DATE
            AND CAST(Start_DateTime AS DATE) <= DATE_ADD(CURRENT_DATE, INTERVAL +1 WEEK)
            ORDER BY Start_DateTime ASC";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                        echo "<form action='event_details.php' onclick=\"return  eventCookie(".$row['Event_ID'].")\">
                        <input type=\"submit\" value=\"Event Details\" />
                        </form>";
                    }
                }
                else {
                    echo "0 results";
                }

             ?>
        </div>
        <div class="eventsList" id="next_week">
            <?php
            $sql = "SELECT Event_ID, Name, Description
            FROM events
            WHERE CAST(Start_DateTime AS DATE) >= DATE_ADD(CURRENT_DATE, INTERVAL +1 WEEK)
            AND CAST(Start_DateTime AS DATE) <= DATE_ADD(CURRENT_DATE, INTERVAL +2 WEEK)
            ORDER BY Start_DateTime ASC";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                        echo "<form action='event_details.php' onclick=\"return  eventCookie(".$row['Event_ID'].")\">
                        <input type=\"submit\" value=\"Event Details\" />
                        </form>";
                    }
                }
                else {
                    echo "0 results";
                }

             ?>
        </div>
        <div class="eventsList" id="upcoming">
            <?php
            $sql = "SELECT Event_ID, Name, Description
            FROM events
            WHERE CAST(Start_DateTime AS DATE) >= DATE_ADD(CURRENT_DATE, INTERVAL +1 WEEK)
            ORDER BY Start_DateTime ASC";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                        echo "<form action='event_details.php' onclick=\"return  eventCookie(".$row['Event_ID'].")\">
                        <input type=\"submit\" value=\"Event Details\" />
                        </form>";
                    }
                }
                else {
                    echo "0 results";
                }

             ?>
        </div>
        <div class="eventsList" id="recommended">
            <?php
            $sql = "SELECT e.Event_ID, e.Name, e.Description
            FROM events e
            JOIN category c ON e.Category_ID = c.Category_ID
            JOIN user_category uc ON ec.Category_ID = c.Category_ID
            WHERE uc.User_ID = $user_ID
            ORDER BY Start_DateTime ASC";
            $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                        echo "<form action='event_details.php' onclick=\"return  eventCookie(".$row['Event_ID'].")\">
                        <input type=\"submit\" value=\"Event Details\" />
                        </form>";
                    }
                }
                else {
                    echo "0 results";
                }

             ?>
        </div>

        <?php mysqli_close($conn) ?>

    </body>
    <script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("eventsList");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("eventsList");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>
    <script src="javascript/login.js"></script>
    <script src="javascript/navigation.js"></script>
</html>
