<?php

require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE["user_ID"];

$conn = db_connect();
$sql = "SELECT e.Name, e.Ticket_Price, t.Ticket_ID, e.Start_DateTime FROM tickets t
JOIN events e ON t.Event_ID = e.Event_ID
WHERE t.User_ID = $user_ID AND e.End_DateTime > CURRENT_TIMESTAMP;";
$result = mysqli_query($conn, $sql);


?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - <?php echo $username; ?>'s Tickets</title>
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
         <table>
             <thead>
                 <th>Event</th>
                 <th>Starts at</th>
                 <th>Price</th>
                 <th>Ticket</th>
             </thead>
             <tbody>
                 <?php
                 while ($row = mysqli_fetch_assoc($result)) {
                     echo "<tr><td>".$row['Name']."</td><td>".$row['Start_DateTime']."</td><td>".$row['Ticket_Price']."</td><td><form target=\"_blank\" action=\"print_ticket.php\" method=\"post\" onsubmit=\"return ticketCookie(".$row['Ticket_ID'].")\"><input type=\"submit\" value=\"Print Ticket\" /></form></td></tr>";
                 }
                 ?>
             </tbody>
         </table>
     </body>
 </html>
