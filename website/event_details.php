<?php

require 'functions.php';
$username = checkCurrentUser();

$event_ID = $_COOKIE["event"];
setcookie("event", "", time()-1);

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
    $sql = "INSERT INTO `events` (`Name`, `Description`, `Start_DateTime`, `End_DateTime`, `Total_Tickets`, `Ticket_Sale_Start_DateTime`, `Ticket_Sale_End_DateTime`, `Ticket_Price`, `Category_ID`, `Organiser_User_ID`, `Venue_ID`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, '1', '1', '1');";
    if (!($stmt = mysqli_prepare($conn, $sql))) {
        $eventCreation = "SQL query preparation error: ".mysqli_error($conn);
    } else if (!(mysqli_stmt_bind_param($stmt, "ssssssss", $event_name, $description, $start_date_time, $end_date_time, $ticket_quantity, $ticket_start_date_time, $ticket_end_date_time, $ticket_price))) {
        $eventCreation = "SQL query binding error: ".mysqli_error($conn);
    } else if (!(mysqli_stmt_execute($stmt))) {
        $eventCreation = "SQL query execution error: ".mysqli_error($conn);
    } else {
        $eventCreation = "New event succesfully created!";
        $event_ID = mysqli_insert_id($conn);
        setcookie("event", $event_ID, date() + 10);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


$conn = db_connect();
$sql = "SELECT * FROM events WHERE Event_ID = '$event_ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 0) {
    $eventCreation .= "This event doesn't exist!";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - <?php echo $row['Name']; ?></title>
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
        <p><?php echo $eventCreation ?></p>
        <?php echo $row['Name']; ?>
    </body>
</html>
