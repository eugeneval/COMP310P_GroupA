<?php

require 'functions.php';
$username = checkCurrentUser();

$event_ID = $_COOKIE["event"];
setcookie("event", "", time()-1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["venue"] == "new_venue") {
        $venue_name = test_input($_POST["venue_name"]);
        $venue_address = test_input($_POST["venue_address"]);
        $venue_postcode = test_input($_POST["venue_postcode"]);
        $venue_city = test_input($_POST["venue_city"]);
        $venue_phone = test_input($_POST["venue_phone"]);

        $conn = db_connect();
        $sql = "INSERT INTO `venue`(`Name`, `Address`, `Postcode`, `City`, `Phone_Number`, `Created_By_User_ID`)
        VALUES (?, ?, ?, ?, ?, ?);";
        if (!($stmt = mysqli_prepare($conn, $sql))) {
            die("Venue SQL query preparation error: ".mysqli_error($conn));
        } else if (!(mysqli_stmt_bind_param($stmt, "ssssss", $venue_name, $venue_address, $venue_postcode, $venue_city, $venue_phone, $_COOKIE["user_ID"] ))) {
            die("Venue SQL query binding error: ".mysqli_error($conn));
        } else if (!(mysqli_stmt_execute($stmt))) {
            die("Venue SQL query execution error: ".mysqli_error($conn));
        } else {
            $eventCreation .= "New venue succesfully created!";
            $venue_ID = mysqli_insert_id($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } else {
        $venue_ID = $_POST["venue"];
    }

    $event_name = test_input($_POST['event_name']);
    $description = test_input($_POST['description']);
    $start_date_time = test_input($_POST['start_date_time']);
    $end_date_time = test_input($_POST["end_date_time"]);
    $url = test_input($_POST["url"]);
    $ticket_type = test_input($_POST["ticket_type"]);
    $ticket_name = test_input($_POST["ticket_name"]);
    $ticket_start_date_time = test_input($_POST["ticket_start_date_time"]);
    $ticket_end_date_time = test_input($_POST["ticket_end_date_time"]);
    $ticket_price = test_input($_POST["ticket_price"]);
    $ticket_quantity = test_input($_POST["ticket_quantity"]);
    $category_ID = test_input($_POST["category"]);
    // TODO: tags!

    $conn = db_connect();
    $sql = "INSERT INTO `events` (`Name`, `Description`, `Start_DateTime`, `End_DateTime`, `Total_Tickets`, `Ticket_Sale_Start_DateTime`, `Ticket_Sale_End_DateTime`, `Ticket_Price`, `Category_ID`, `Organiser_User_ID`, `Venue_ID`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    if (!($stmt = mysqli_prepare($conn, $sql))) {
        die("Event SQL query preparation error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_bind_param($stmt, "sssssssssss", $event_name, $description, $start_date_time, $end_date_time, $ticket_quantity, $ticket_start_date_time, $ticket_end_date_time, $ticket_price, $category_ID, $_COOKIE["user_ID"],$venue_ID))) {
        die("Event SQL query binding error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_execute($stmt))) {
        die("Event SQL query execution error: ".mysqli_error($conn));
    } else {
        $eventCreation .= "New event succesfully created!";
        $event_ID = mysqli_insert_id($conn);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

if (!$event_ID) {
    header('Location: main.php');
    exit();
}

$conn = db_connect();
$sql = "SELECT e.Name, v.Name AS 'Venue_Name', v.Address AS 'Venue_Address', v.Postcode AS 'Venue_Postcode', e.Description, e.Start_DateTime, e.End_DateTime FROM events e JOIN venue v ON v.Venue_ID = e.Venue_ID WHERE e.Event_ID = '$event_ID'";
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
        <div id = event_details_nv style="color: #4CAF50;">
            </br><h2><?php echo $row['Name'];?></h2>
            <h3>At</h3>
            <h3><?php echo $row['Venue_Name'];?></h3>
            <h4><?php echo $row['Venue_Address'];?></h4>
            <h4><?php echo $row['Venue_Postcode'];?></h4>
        </div>
        <div id = event_details_d>
            </br><h3><?php echo $row['Description'];?></h3>
        </div>
        <div id = event_details_t>
            </br><h3>Starting at:</h3>
            <h3 style="color: #4CAF50;"><?php echo $row['Start_DateTime'];?></h3>
            <h3>Finishes at:</h3>
            <h3 style="color: #4CAF50;"><?php echo $row['End_DateTime'];?></h3>
        </div>
        <form action="buy_tickets.php" onsubmit="return eventCookie(<?php echo $row['Event_ID']; ?>)">
            <input type="submit" value="Buy Tickets" ><br>
        </form>

    </body>
</html>
