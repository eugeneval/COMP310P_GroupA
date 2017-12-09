<?php

require 'functions.php';
$username = checkCurrentUser();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = test_input($_POST['event_name']);
    $description = test_input($_POST['description']);
    $start_date_time = test_input($_POST['start_date_time']);
    $end_date_time = test_input($_POST["end_date_time"]);
    $url = test_input($_POST["url"]);
    // $location = test_input($_POST["location"]);
    // TODO: location is chosen from exisitng venues
    $ticket_type = test_input($_POST["ticket_type"]);
    $ticket_name = test_input($_POST["ticket_name"]);
    $ticket_start_date_time = test_input($_POST["ticket_start_date_time"]);
    $ticket_end_date_time = test_input($_POST["ticket_end_date_time"]);
    $ticket_price = test_input($_POST["ticket_price"]);
    $ticket_quantity = test_input($_POST["ticket_quantity"]);

    $conn = db_connect();
    $sql = "INSERT INTO `event` (`Name`, `Description`, `Start_DateTime`, `End_DateTime`, `Total_Tickets`, `Ticket_Sale_Start_DateTime`. `Ticket_Sale_End_DateTime`, `Ticket_Price`)
    VALUES (`$event_name`. `$description`, `$start_date_time`, `$end_date_time`, `$ticket_quantity`, `$ticket_start_date_time`. `$ticket_end_date_time`, `$ticket_price`)";
    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        $eventCreation = "New user succesfully created!";
        setcookie("event", $event_name, date() + 10);
    }
    elseif ($result == false) {
        $eventCreation = "SQL query error: ".mysqli_error($conn);
    }
    else {
        $eventCreation = "Unknow Error";
    }
    mysqli_close($conn);
}

$event_ID = $_COOKIE["event"];
setcookie("event", "", time()-1);
$conn = db_connect();
$sql = "SELECT * FROM events WHERE Event_ID = '$event_ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 0) {
    $eventCreation = "This event doesn't exist!";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - <?php echo $event_name; ?></title>
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
        <?php echo $row['Name']; ?>
    </body>
</html>
