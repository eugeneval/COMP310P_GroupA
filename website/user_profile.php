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
        <h4><u>Edit Interests</u></h4>
        <?php

        $conn = db_connect();

        //!!!!!!!!!!!!!!!!!!!!!!!!!SQL Query Not Working!!!!!!!!
        $sql = "SELECT  c.Name FROM Category c JOIN user u ON u.User_ID = Created_By_User_ID.User_ID
        JOIN user_category uc ON uc.User_ID = u.User_ID WHERE u.username = '$username';";
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

        <h4><u>Attending</u></h4>

        <?php
        $conn = db_connect();
          $sql = "SELECT DISTINCT e.Name, e.Start_DateTime
          FROM events e
          JOIN tickets t on t.Event_ID = e.Event_ID
          JOIN user u ON u.User_ID = t.User_ID
          WHERE u.username = '$username';";
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

        <h4><u>Email Notifications</u></h4>
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
