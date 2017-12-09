<?php

require 'functions.php';
$username = checkCurrentUser();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - User Profile</title>
        <!-- TODO: make title reflect currentl user -->
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
        <h3>Profile</h3>
        <!--Store and Fetch Profile Picture in PHP and SQL-->
        <h4>Edit Interests</h4>
        <h4>Attending</h4>

        <h4>Email Notifications</h4>
        <label class="switch">
            <input type="checkbox" checked>
            <span class="slider round"></span>
        </label>
        <br /><br />
        <button onclick="location.href = 'manage_event.php';" id="button" >Manage Events</button>
        <button onclick="location.href = 'create_event.php';" id="button" >Create Events</button>
        <button onclick="location.href = 'login.php';"id="button" >Log Out</button>

    </body>
</html>
