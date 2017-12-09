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
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
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

        <?php
        $conn = db_connect();
        $sql = "SELECT e.Name, e.Total_Tickets, e.Ticket_Price, e.Num_Thumbs_Up FROM events e
          JOIN user u ON e.Organiser_User_ID = u.User_ID WHERE u.Username = '$username';";
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
       //todo create correct SQL statement
      ?>
    </body>
    <br/>
    <div id="myDiv"></div>
    <script>
        var trace1 = {
        x: [1, 2, 3, 4],
        y: [10, 15, 13, 17],
        type: 'scatter'
        };
        var data = [trace1];
        Plotly.newPlot('myDiv', data);
    </script>
</html>
