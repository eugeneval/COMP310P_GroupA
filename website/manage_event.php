<?php

require 'functions.php';
$username = checkCurrentUser();

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

        <?php
        $conn = db_connect();
        $sql = "SELECT Name, Total_Tickets, Ticket_Price, Num_Thumbs_Up FROM events;";
        $result = mysqli_query($conn, $sql);

        if($result){
        echo '<table style="width:100%">
                <tr>
                  <th>Event Name</th>
                  <th>Tickets Available</th>
                  <th>Ticket Price</th>
                  <th>Thumbs Up</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
          echo'<tr>
                  <td>'.$row['Name'].'</td>
                  <td>'.$row['Total_Tickets'].'</td>
                  <td>'.$row['Ticket_Price'].'</td>
                  <td>'.$row['Num_Thumbs_Up'].'</td>';
          echo '</tr>';
         }
         echo '</table>';
       }
       else{
         echo "Database not found";
         echo mysqli_error($conn);
       }
       mysqli_close();
      ?>

    </body>
</html>
