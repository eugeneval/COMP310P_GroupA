<?php
// TODO: php/sql to actually buy tickets

require 'functions.php';
$username = checkCurrentUser();

$event_ID = $_COOKIE["event"];

if (!$event_ID) {
    header('Location: main.php');
    exit();
}

$conn = db_connect();
$sql = "SELECT e.Name, v.Name AS 'Venue_Name' FROM events e JOIN venue v ON v.Venue_ID = e.Venue_ID WHERE e.Event_ID = '$event_ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 0) {
    $eventCreation .= "This event doesn't exist!";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Tickets</title>
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
        <div id = event_details_nv style="color: #4CAF50;">
          </br><h2><?php echo $row['Name'];?></h2>
            <h3>At</h3>
          <h3><?php echo $row['Venue_Name'];?></h3>
        </div>
      </br>
    <h3>Ticket Type</h3>
      <form action="/action_page.php">
          <select name="Ticket Type">
              <option value="VIP">VIP</option>
                <option value="Standard">Standard</option>
                  <option value="Earlybird">Earlybird</option>
            </select>
          <br><br>
             <h3>Quantity</h3>
                <input type="number" name="quantity" min="1" max="5">
             <h3>Email</h3>
            <input type="email" name="email">
          <br><br>
                First name:<br>
            <input type="text" name="firstname" value="First Name">
          <br>
              Last name:<br>
            <input type="text" name="lastname" value="Last Name">
          <br><br>
        <input type="submit" value="Buy Tickets">
      </form>

    </body>
</html>
