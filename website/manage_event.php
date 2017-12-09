<?php

require 'functions.php';
$username = checkCurrentUser();

$conn = db_connect();
$sql = "SELECT Password, Admin_Priveleges FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Manage Event</title>
        <!-- TODO: make title reflect currently selected event -->
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

        <table style="width:100%">
        <tr>
          <th>Event Name</th>
          <th>Tickets Available</th>
          <th>Tickets Sold</th>
          <th>Sub-Total</th>
        </tr>
        <tr>
          <td>????</td>
          <td>????</td>
          <td>????</td>
          <td>????</td>
        </tr>
      </table>

    </body>
</html>
