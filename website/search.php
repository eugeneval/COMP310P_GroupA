<?php

require 'functions.php';
$username = checkCurrentUser();

$conn = db_connect();
$output = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchq = test_input($_POST["searchq"]);
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $query = mysqli_query($conn, "SELECT * FROM events WHERE Name LIKE '%$searchq%';");
        $count = mysqli_num_rows($query);
        if($count == 0) {
            $output = 'No Results';
        }
        else{
          while($row = mysqli_fetch_array($query)) {
            $name = $row['Name'];

            $output .= '<div>'.$name.' </div>';
          }
        }
  }

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
            <input type="submit" value="Search" />

          <?php
              echo $output;

          ?>

        </form>
    </body>
</html>
