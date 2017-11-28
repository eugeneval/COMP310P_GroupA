<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function login($conn, $username, $password) {

    $sql = "SELECT Password FROM user WHERE username = '$username'";
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
        #$loginError = "Successful login!";
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

function db_connect() {

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
    return $conn;

}

?>
