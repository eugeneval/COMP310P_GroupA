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
        <title>Eventi - <?php echo $username; ?></title>
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
        <h3>Profile</h3>
<!--Store and Fetch Profile Picture in PHP and SQL-->

        <img class="user_image" src="https://i.pinimg.com/736x/5b/9d/50/5b9d5065b8b90cf44433ae5d1e4db0b7.jpg"
        alt "My Profile Image" width "150" height ="150">
        <br />
<!--Allows the user to manage or create an event if they're a admin and log out-->
        <form action='manage_event.php' onsubmit="return check_admin()">
            <input type="submit" value="Manage Events" id="newEvent"/>
        </form>
        <form action='create_event.php' onsubmit="return check_admin()">
            <input type="submit" value="Create New Event" id="newEvent"/>
        </form>
        <input type=submit value='Log Out' onclick="location.href = 'login.php';"id="button" >
        <div id="profile">
            <h4><u>Edit Interests</u></h4>
            <?php

            $conn = db_connect();

/*Query to find the users interests (chosen categories) and list them alphabetically*/
            $sql = "SELECT  c.Name
                    FROM Category c
                    JOIN user_category uc ON uc.Category_ID = c.Category_ID
                    JOIN user u ON u.User_ID = uc.User_ID
                    WHERE u.username = '$username'
                    ORDER BY c.Name;";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo '<table style="width:100%">
                      <tr>
                          <th>Interests</th>
                      </tr>';
            while($row = mysqli_fetch_array($result)){
                echo'<tr>
                          <td>'.$row['Name'].'</td>';
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
          <br />
      </div>

      <div id="profile">
          <h4><u>Booked Events</u></h4>

          <?php
/*Query to find the users booked event(s) and list them uniquely by start date and time*/
              $conn = db_connect();
              $sql = "SELECT DISTINCT e.Name, e.Start_DateTime
                      FROM events e
                      JOIN tickets t ON t.Event_ID = e.Event_ID
                      JOIN user u ON u.User_ID = t.User_ID
                      WHERE u.username = '$username'
                      ORDER BY e.Start_DateTime;";
              $result = mysqli_query($conn, $sql);

              if($result){
                  echo '<table style="width:100%">
                            <tr>
                                <th>Event Name</th>
                            </tr>';
                  while($row = mysqli_fetch_array($result)){
                    echo'<tr>
                              <td>'.$row['Name'].'</td>';
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
         <br />
      </div>

       <div id="profile">
<!--Allows user to enable or disable email notifications 24hours before an event-->
            <h4><u>Email Notifications</u></h4>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>
            <br /><br />
        </div>
        <br /><br />
    </body>
    <script src="libraries/js.cookie.js"></script>
    <script src="libraries/p5.min.js"></script>
</html>
