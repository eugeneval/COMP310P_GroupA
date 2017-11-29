<?php
//SQL server connection details
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "event manager";

//Connect to server
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Name, Description
FROM events";
$result = mysqli_query($conn, $sql);
 ?>

<!DOCTYPE html>
<html>
    <head>
      <title>Eventi</title>
      <style>
          body, html {
              height: 100%;
              margin: 0;
              text-align: center;

              /* The image used */
              background-image: url("/resources/Snow-mountains-background-1.jpg");

              /* Full height */
              height: 100%;

              /* Center and scale the image nicely */
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
          }
          head {
            text-align: center;

          }
          img {
            text-align: center;
          }
      </style>

        <img src="resources/Logo.png" style="width:302px;height:86px;"/>
          <!--<link href="styling.css" rel="stylesheet">-->
            <script src="libraries/p5.min.js"></script>

        <title>Eventi</title>
        <link href="styling.css" rel="stylesheet">
        <script src="libraries/p5.min.js"></script>

    </head>
    <body>
        <header>
            <h1>Eventi</h1>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
            <div class="menubar">
                <li><a href="login.php">Logout</a></li>
            </div>
        </header>
        <div class="sidebar">
            <li>One</li>
            <li>Two</li>
            <li>Three</li>
        </div>
        <div class="eventsList">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<p>".$row['Name']."<br /><small>".$row['Description']."</small></p>";
                    }
                }
                else {
                    echo "0 results";
                }
             ?>
        </div>
    </body>
</html>
