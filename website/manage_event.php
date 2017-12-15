<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/

require 'functions.php';
$username = checkCurrentUser();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Manage Events</title>
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
        $row_count = 0;
        $conn = db_connect();
        $sql = "SELECT e.Name, e.Total_Tickets, e.Ticket_Price, e.Num_Thumbs_Up, e.Event_ID FROM events e
          JOIN user u ON e.Organiser_User_ID = u.User_ID WHERE u.Username = '$username';";
        $result = mysqli_query($conn, $sql);

        if($result){
        echo '<table style="width:100%">
                <tr>
                  <th>Event Name</th>
                  <th>Tickets Available</th>
                  <th>Ticket Price</th>
                  <th>Likes</th>
                  <th>Participants</th>
                  <th>Edit</th>
                </tr>';
        while($row = mysqli_fetch_array($result)){
          echo '<tr>
                  <td>'.$row['Name'].'</td>
                  <td>'.$row['Total_Tickets'].'</td>
                  <td>'.$row['Ticket_Price'].'</td>
                  <td>'.$row['Num_Thumbs_Up'].'</td>
                  <td><form action=\'participants_list.php\' onsubmit="return eventCookie('.$row['Event_ID'].')">
                  <input type="submit" value="Participants" />
                  </form> </td>
                  <td><form action=\'edit_event.php\' onsubmit="return eventCookie('.$row['Event_ID'].')">
                  <input type="submit" value="Edit" />
                  </form> </td>';
          echo '</tr>';
          $row_count = $row_count + 1;
          ${'file' . $row_count} = $row['Total_Tickets'];
         }
         echo '</table>';
       }
       else{
         echo "Database not found";
         echo mysqli_error($conn);
       }
       mysqli_close();
       //TODO create correct SQL statement
      ?>
      </body>
      <script src="libraries/js.cookie.js"></script>
      <script src="javascript/login.js"></script>
      <script src="javascript/navigation.js"></script>
        <script>
                for (i = 0; i < <?php echo $row_count?>; i++) {
                var xLabel = [];
                xLabel[i] = i;
              }
              var trace1 = {
              x: ['1','2','3'],
              y: [1, 1, 1],
              type: 'bar'
              };
              for (i = 0; i < xLabel.length; i++){
                trace1.x[i] = 'Event'+" "+(i+1);
              }
              trace1.y[0] = <?php echo $file1;?>;
              trace1.y[1] = <?php echo $file2;?>;
              trace1.y[2] = <?php echo $file3;?>;
              var data = [trace1];
        Plotly.newPlot('myDiv', data);
    </script>

</html>
