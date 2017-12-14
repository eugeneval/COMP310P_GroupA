<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *                                                       *
* Authors: Syed Ismail Ahmad - Eugene Valetsky - George Imafidon               *                              *
*******************************************************************************/

/////COMMENTS////////////////////////////////
//Email is sent when the emailcheck function is called.
//This can be embedded into the login and main page of
//Eventi so that when anyone logs in or loads the event
//page the system will send the corresponding email.
//However, this means the system will only work with a
//large enough user base.
/////////////////////////////////////////////

$email = emailCheck();
sendEmail($email);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function login($conn, $username, $password) {

    $sql = "SELECT Password, Admin_Priveleges, User_ID FROM user WHERE username = ?;";
    if (!($stmt = mysqli_prepare($conn, $sql))) {
        die("Event SQL query preparation error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_bind_param($stmt, "s", $username))) {
        die("Event SQL query binding error: ".mysqli_error($conn));
    } else if (!(mysqli_stmt_execute($stmt))) {
        die("Event SQL query execution error: ".mysqli_error($conn));
    } else {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $passwordFromSQL = $row['Password'];
        mysqli_stmt_close($stmt);
    }

    if (mysqli_num_rows($result) == 0) {
        return "That username does not exist!";
    }
    elseif ($passwordFromSQL != $password) {
        return "That password is incorrect!";
    }
    elseif ($passwordFromSQL == $password) {
        if ($row['Admin_Priveleges'] == 1) {
            $admin = True;
        } else {
            $admin = False;
        }
        setUserCookie($username, $row['User_ID'], $admin);
        header('Location: main.php');
        exit();
    }
    elseif ($result == false) {
        return "SQL query error: ".mysqli_error($conn);
    }
    else {
        return "Unknown Error";
    }
}

function checkCurrentUser() {

    if (isset($_COOKIE["username"]) && isset($_COOKIE["user_ID"])) {
        setUserCookie($_COOKIE["username"], $_COOKIE["user_ID"], isset($_COOKIE["adminPriveleges"])); # reset expiry timer
        return $_COOKIE["username"];
    } else {
        setcookie("loggedout", True, time() + 10);
        header('Location: login.php');
        exit();
    }

}

function setUserCookie($username, $user_ID, $admin) {
    $expireTime = time() + 60*15; # 15 minutes before relogin is required
    setcookie("username", $username, $expireTime);
    setcookie("user_ID", $user_ID, $expireTime);
    if ($admin) {
        setcookie("adminPriveleges", True, $expireTime);
    }
}


function db_connect() {

    //SQL server connection details
    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "root";
    $dbname = "event manager";

    //Connect to server
    //todo change mysqli_connect to @mysqli_connect
    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;

}

function emailCheck() {
      $conn = db_connect();
      $sql = "SELECT DISTINCT u.Email, e.Start_DateTime, t.User_ID
              FROM events e
              JOIN tickets t ON t.Event_ID = e.Event_ID
              JOIN user u ON u.User_ID = t.User_ID
              WHERE t.Sent_Email = 0";

      $result = mysqli_query($conn, $sql);

      while($row = mysqli_fetch_array($result)){

        $event_time = $row['Start_DateTime'];
        $int_event_time = strtotime($event_time);
        $User_ID = $row['User_ID'];
        $email = $row['Email'];

        if (time() - $int_event_time <= 86400) {
          sendEmail($email);
          $sql = "UPDATE tickets
                  SET Sent_Email = 1
                  WHERE User_ID = $User_ID;";
        }
    }
    return $email;
}

// Placeholder function for sending a reminder email
function sendEmail($email) {
  // $msg = "Please have a look at Eventi, you have an event coming up";
  // $msg = wordwrap($msg,70);
  // mail($email,"Event Notification",$msg);
}

?>
