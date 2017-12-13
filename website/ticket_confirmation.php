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
        if (!$result || $result == false) {
            // $errorMessage = "Sorry, there was an error processing your tickets. Please try again or contact support.";
            die(mysqli_error($conn));
        }
    }
    mysqli_close($conn);
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
         <p>
             <?php if ($errorMessage) {echo $errorMessage;} ?>
         </p>
     </body>
 </html>
