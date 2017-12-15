<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/

require 'functions.php';
$username = checkCurrentUser();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = test_input($_POST["search"]);
    $startTime = $_POST["startDate"];
    $endTime = $_POST["endDate"];
//$search is the value inputed in the search field by the user
    $search = "%".$search."%";

    if (!$startTime) {
        $startTime = "2000-01-01";
    }
    if (!$endTime) {
        $endTime = "2050-01-01";
    }

    $conn = db_connect();

// Query for selecting the event ID, name, description, times, category and venue
    $sql = "SELECT e.Event_ID, e.Name, e.Description, e.Start_DateTime, e.End_DateTime, v.Name AS 'Venue', c.Name AS 'Category'
            FROM events e
            JOIN category c ON e.Category_ID = c.Category_ID
            JOIN venue v ON e.Venue_ID = v.Venue_ID
            WHERE CAST(e.Start_DateTime AS DATE) >= CAST(? AS DATE)
            AND CAST(e.Start_DateTime AS DATE) <= CAST(? AS DATE)
            AND (e.Name LIKE ? OR e.Description LIKE ?  OR v.Name LIKE ?  OR c.Name LIKE ? )";

//Error handling
    if (!($stmt = mysqli_prepare($conn, $sql))) {
        die("Event SQL query preparation error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_bind_param($stmt, "ssssss", $startTime, $endTime, $search, $search, $search, $search))) {
        die("Event SQL query binding error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_execute($stmt))) {
        die("Event SQL query execution error: ".mysqli_error($conn));
    } else {
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

?>

<!--Search allows the user to refine the search by date. time and category-->
 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - Search</title>
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
         <form action='search.php' method='post'>
             <div class="searchinput">
                 Search for events are happening between
                 <input type="date" id="startDate" name="startDate" />
                 and
                 <input type="date" id="endDate" name="endDate" />
                 <br />
                And are about: <small>The name of the event, category, whatever!</small><br />
                 <input id="search" type="text" placeholder="Enter event info to filter" name="search"/>
                 <input type="submit" s="Search" name="searchsubmit"/>
             </div>
         </form>
         <table>
             <thead>
                 <th>Event</th>
                 <th>Start Time</th>
                 <th>End Time</th>
                 <th>Venue</th>
                 <th>Category</th>
                 <th>Details</th>
             </thead>
             <tbody>
                 <?php
//Inputs the data below the respective table header respectively
                     while ($row = mysqli_fetch_assoc($result)) {
                         echo "<tr><td>".$row['Name']."</td><td>
                         ".$row['Start_DateTime']."</td><td>".$row['End_DateTime']."</td><td>".$row['Venue']."</td><td>".$row['Category']."</td><td><form action='event_details.php' onsubmit=\"return eventCookie(".$row['Event_ID'].")\"><input type=\"submit\" value=\"Details\" /></form></td></tr>";
                     }
                  ?>
             </tbody>
         </table>

     </body>
     <script src="libraries/js.cookie.js"></script>
     <script src="javascript/navigation.js"></script>
 </html>
