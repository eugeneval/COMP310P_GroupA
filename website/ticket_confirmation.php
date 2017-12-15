<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/

require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE["user_ID"];

$event_ID = $_COOKIE["event"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST["quantity"];

/*Query to add the users purchased ticket to the db*/
    $conn = db_connect();
    $sql = "INSERT INTO `tickets` (`User_ID`, `Event_ID`, `Ticket_Type_ID`)
            VALUES ($user_ID, $event_ID, 1);";
            for ($i=0; $i < $quantity; $i++) {
                $result = mysqli_query($conn, $sql);
                $newTicket[$i] = mysqli_insert_id($conn);
                if (!$result || $result == false) {
                    die(mysqli_error($conn));
                }
    }

} else {
    header('Location: main.php');
}
?>
<!--Allows user to view and print their unique ticket -->
 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - Ticket Confirmation</title>
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
         <p>Congratulations, your purchase was successful.</p>
         <table>
             <thead>
                 <th>Event</th>
                 <th>Starts at</th>
                 <th>Price</th>
                 <th>Ticket</th>
             </thead>
             <tbody>
                 <?php
                 foreach ($newTicket as $ticket_ID) {
                     $sql = "SELECT e.Name, e.Ticket_Price, e.Start_DateTime FROM tickets t
                             JOIN events e ON t.Event_ID = e.Event_ID
                             WHERE t.Ticket_ID = $ticket_ID ;";
                     $result = mysqli_query($conn, $sql);
                     if (!$result || $result == false) {
                         die(mysqli_error($conn));
                     }
                     $row = mysqli_fetch_assoc($result);
                     echo "<tr><td>".$row['Name']."</td><td>".$row['Start_DateTime']."</td><td>".$row['Ticket_Price']."</td><td><form target=\"_blank\" action=\"print_ticket.php\" method=\"post\" onsubmit=\"return ticketCookie(".$ticket_ID.")\"><input type=\"submit\" value=\"Print Ticket\" /></form></td></tr>";
                 }
                 mysqli_close($conn);

                 ?>
             </tbody>
         </table>
     </body>
     <script src="libraries/js.cookie.js"></script>
     <script src="javascript/navigation.js"></script>
 </html>
