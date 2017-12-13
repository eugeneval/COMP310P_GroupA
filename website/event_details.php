<?php
// Google Map API Key = AIzaSyBHaMCaAdIAJ7IGoxz5TrpkyS-3l1mYIP4
// TODO: leave reviews

require 'functions.php';
$username = checkCurrentUser();

$event_ID = $_COOKIE["event"];
setcookie("event", "", time()-1);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['thumbs_up'])) {
        $conn = db_connect();
        $sql = "UPDATE events SET Num_Thumbs_Up = Num_Thumbs_Up + 1 WHERE Event_ID = $event_ID";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    // IDEA: cannot vote multiple times on the same event
    // IDEA: can only vote after event conplete?
}

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
            $eventCreation .= "New venue succesfully created!\n";
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
    $tags = $_POST["tags"];

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

    if ($tags) {
        $tag_ID;
        $sql = "INSERT INTO `event_tag` (`Event_ID`, `Tag_ID`) VALUES (?, ?)";
        if (!($stmt = mysqli_prepare($conn, $sql))) {
            die("Tags SQL query preparation error: ".mysqli_error($conn));
        } else if (!(mysqli_stmt_bind_param($stmt, "ii", $event_ID, $tag_ID))) {
            die("Tags SQL query binding error: ".mysqli_error($conn));
        }
        foreach ($tags as $tag_ID) {
            if (!(mysqli_stmt_execute($stmt))) {
               die("Tags SQL query execution error: ".mysqli_error($conn));
           }

        }
        mysqli_stmt_close($stmt);

    }
    mysqli_close($conn);
}

if (!$event_ID) {
    header('Location: main.php');
    exit();
}

$conn = db_connect();
$sql = "SELECT e.Name, v.Name AS 'Venue_Name', v.Address AS 'Venue_Address', v.Postcode AS 'Venue_Postcode', e.Description, e.Start_DateTime, e.End_DateTime, e.Num_Thumbs_Up, e.Total_Tickets, COUNT(t.Ticket_ID) AS 'Tickets_Sold'
FROM events e
JOIN venue v ON v.Venue_ID = e.Venue_ID
JOIN tickets t ON t.Event_ID = e.Event_ID
WHERE e.Event_ID = '$event_ID'";
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
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <style>
          #map {
            height: 500px;
            width: 100%;

          }
          html, body {
            height: 500px;
            margin: 0;
            padding: 0;
          }
        </style>
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
        <form action='event_details.php' method="get" onsubmit="return eventCookie(<?php echo $event_ID; ?>)">
            <!-- FIXME eventCookie doesn't work -->
            <button type="submit" name="thumbs_up"><img src="resources/Thumbs_Up.png" class="form_icons" /><?php echo $row['Num_Thumbs_Up']?></button>
        </form>
        <div id = event_details_d>
            </br><h3><?php echo $row['Description'];?></h3>
        </div>
        <div id = event_details_t>
            </br><h3>Starting at:</h3>
            <h3 style="color: #4CAF50;"><?php echo $row['Start_DateTime'];?></h3>
            <h3>Finishes at:</h3>
            <h3 style="color: #4CAF50;"><?php echo $row['End_DateTime'];?></h3>
        </div>
        <form action="buy_tickets.php" onsubmit="return checkTickets(<?php echo $row['Tickets_Sold'] ?>, <?php echo $row['Total_Tickets']?>, <?php echo $event_ID; ?>)">
            <h3>Tickets remaining:</h3>
            <h3 style="color: #4CAF50;"><?php echo ($row['Total_Tickets'] - $row['Tickets_Sold']);?></h3>
            <input type="submit" value="Buy Tickets" /><br>
        </form>
        <div id="map"></div>
        <script>
            function initMap() {
              var uluru = {lat: 51.523569, lng: -0.132424};
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: uluru
              });
              var marker = new google.maps.Marker({
                position: uluru,
                map: map
              });
            }
          </script>
          <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHaMCaAdIAJ7IGoxz5TrpkyS-3l1mYIP4&callback=initMap">
          </script>
        </body>
      </html>
    </body>
    <script>
    function checkTickets(sold, total, event_ID) {
        if (sold < total) {
            eventCookie(event_ID);
            return true;
        } else {
            alert("Sorry, this event is sold out!");
            return false;
        }

    }
    </script>
    <script src="libraries/js.cookie.js"></script>
    <script src="javascript/navigation.js"></script>
</html>
