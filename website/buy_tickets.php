<?php
// TODO: php/sql to actually buy tickets

require 'functions.php';
$username = checkCurrentUser();

$event_ID = $_COOKIE["event"];

if (!$event_ID) {
    header('Location: main.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - Tickets</title>
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
        <?php echo $event_ID; ?>
    </body>
</html>
