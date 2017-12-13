<?php

require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE["user_ID"];

$event_ID = $_COOKIE["event"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST["quantity"];

    $conn = db_connect();
    $sql = "INSERT INTO `tickets` (`User_ID`, `Event_ID`, `Ticket_Type_ID`)
    VALUES ($user_ID, $event_ID, 1);";
    for ($i=0; $i < $quantity; $i++) {
        $result = mysqli_query($conn, $sql);
        $newTicket[$i] = mysqli_insert_id($conn);
        if (!$result || $result == false) {
            // $errorMessage = "Sorry, there was an error processing your tickets. Please try again or contact support.";
            die(mysqli_error($conn));
        }
    }

} else {
    header('Location: main.php');
}

?>

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
         <p><?php if ($errorMessage) {echo $errorMessage;} ?></p>
         <p>Congratulations, your purchase was successful.</p>
         <table>
             <thead>
                 <th>Event</th>
                 <th>Price</th>
                 <th>Ticket</th>
             </thead>
             <tbody>
                 <?php
                 foreach ($newTicket as $ticket_ID) {
                     $sql = "SELECT e.Name, e.Ticket_Price FROM tickets t
                     JOIN events e ON t.Event_ID = e.Event_ID
                     WHERE t.Ticket_ID = $ticket_ID ;";
                     $result = mysqli_query($conn, $sql);
                     if (!$result || $result == false) {
                         die(mysqli_error($conn));
                     }
                     $row = mysqli_fetch_assoc($result);
                     echo "<tr><td>".$row['Name']."</td><td>".$row['Ticket_Price']."</td><td></td></tr>";
                 }

                 mysqli_close($conn);

                 ?>
             </tbody>
         </table>
     </body>
 </html>
