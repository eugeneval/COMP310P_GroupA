<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function login($conn, $username, $password) {

    $sql = "SELECT Password, Admin_Priveleges FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
    $passwordFromSQL = $row['Password'];

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
        setUserCookie($username, $admin);
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

    if (isset($_COOKIE["username"])) {
        setUserCookie($_COOKIE["username"], isset($_COOKIE["adminPriveleges"])); # reset expiry timer
        return $_COOKIE["username"];
    } else {
        setcookie("loggedout", True, time() + 10);
        header('Location: login.php');
        exit();
    }

}

function setUserCookie($username, $admin) {
    $expireTime = time() + 60*15; # 15 minutes before relogin is required
    setcookie("username", $username, $expireTime);
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

?>
