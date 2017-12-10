<?php

require 'functions.php';
$username = checkCurrentUser();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Search Events</title>
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
        <form action="search.php" method="POST">
            <input type="text" name="keywords" placeholder="Search for Event.." autocomplete="off" />
            <input type="submit" value="search" />

          <?php
          $conn = db_connect();

          if(isset($_POST['search'])) {
            $searchq = $_POST['search'];
            $sql = "SELECT * FROM events WHERE Name LIKE '%$searchq%'

            "
          }
          ?>



          <div class="searchEventsList">
              <?php
                  $conn = db_connect();
                  $sql = "SELECT *
                  FROM events";
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
                  mysqli_close();
               ?>
          </div>
        </form>
    </body>
</html>
