<?php
require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE["user_ID"];
$event_ID = $_COOKIE["event"];
?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - List of Participants</title>
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

         <?php
         $conn = db_connect();

         $sql = "SELECT DISTINCT u.Name
                 FROM User u
                 JOIN Tickets t ON u.User_ID = t.User_ID
                 JOIN Events e ON e.Event_ID = t.Event_ID
                 WHERE e.Event_ID = '$event_ID';";
         $result = mysqli_query($conn, $sql);

         if($result){
         echo '<table>
                 <tr>
                   <th>Name</th>
                 </tr>';
         while($row = mysqli_fetch_array($result)){
           echo '<tr>
                   <td>'.$row['Name'].'</td>';
           echo '</tr>';
          }
          echo '</table>';
        }
        else{
          echo "Database not found";
          echo mysqli_error($conn);
        }
        mysqli_close($conn);
          ?>

     </body>
     <script src="libraries/js.cookie.js"></script>
     <script src="javascript/navigation.js"></script>
 </html>
