<?php

require 'functions.php';
$username = checkCurrentUser();
$user_ID = $_COOKIE['user_ID'];
$event_ID = $_COOKIE['event'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST["rating"];
    $review = test_input($_POST["review"]);

    $conn = db_connect();
    $sql = "INSERT INTO `review` (`Event_ID`, `User_ID`, `Rating`, `Review`)
    VALUES ($event_ID, $user_ID, ?, ?);";
    if (!($stmt = mysqli_prepare($conn, $sql))) {
        die("Venue SQL query preparation error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_bind_param($stmt, "ss", $rating, $review ))) {
        die("Venue SQL query binding error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_execute($stmt))) {
        die("Venue SQL query execution error: ".mysqli_error($conn));
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
}


$conn = db_connect();
$sql = "SELECT Name FROM events WHERE Event_ID = $event_ID";
$result = mysqli_query($conn, $sql);
if (!$result || $result == false) {
    die(mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$event_name = $row['Name'];

$sql = "SELECT u.Name, r.Rating, r.Review
FROM review r
JOIN user u ON u.User_ID = r.User_ID
JOIN events e ON e.Event_ID = r.Event_ID
WHERE r.Event_ID = $event_ID";
$result = mysqli_query($conn, $sql);
if (!$result || $result == false) {
    die(mysqli_error($conn));
}

mysqli_close($conn);

?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - Reviews</title>
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
         <h3>Reviews for <?php echo $event_name ?></h3>
         <?php
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<p>".$row['Rating']."/5<br /><small>".$row['Review']."</small><br />".$row['Name']."</p>";
         }
          ?>
          <h3>Leave a review:</h3>
          <form action="event_reviews.php" method="post" onsubmit="return eventCookie(<?php echo $event_ID ?>)">
              Rating out of 5:
              <input type="number" name="rating" min="0" max="5" required /><br />
              <input type="text" name="review" placeholder="Review" required  /><br />
              <input type="submit"  />
          </form>
     </body>
     <script src="libraries/js.cookie.js"></script>
     <script src="javascript/navigation.js"></script>
 </html>
