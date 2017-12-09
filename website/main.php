<?php

require 'functions.php';
$username = checkCurrentUser();

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


$sql = "SELECT *
FROM events";
$result = mysqli_query($conn, $sql);


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
        </div>
        <div class="eventsList">
            <?php
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

    </body>
    <script src="javascript/login.js"></script>
    <script src="javascript/navigation.js"></script>
</html>
