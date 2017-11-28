<?php

$loginError = "";
$formPassword = "";
$formUsername = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = test_input($_POST["name"]);
    $username = test_input($_POST["username"]);
    $usernameNew = test_input($_POST["usernameNew"]);
    $password = test_input($_POST["password"]);
    $passwordConfirm = test_input($_POST["passwordConfirm"]);
    $email = test_input($_POST["email"]);
    $address = test_input($_POST["address"]);
    $company = test_input($_POST["company"]);
    $phone = test_input($_POST["phone"]);
    $paypal = test_input($_POST["paypal"]);
    $adminPriveleges = $_POST["adminPrivelges"];

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

    //Existing user validation
    if ($username != "") {
        login($conn, $username, $password);
    }
    //New user creation
    else if ($usernameNew != "") {
        $sql = "INSERT INTO `user` (`Name`, `Username`, `Password`, `Email`, `Address`, `Company`, `Phone_Number`, `Paypal_Address`, `Admin_Priveleges`)
        VALUES ('$name', '$usernameNew', '$password', '$email', '$address', '$company', '$phone', '$paypal', $adminPriveleges);";

        if ($password != $passwordConfirm){
            $loginError = "Passwords do not match!";
        }
        else {
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $loginError = "New user succesfully created!";
                $formUsername = $usernameNew;
                $formPassword = $password;
            }
            elseif ($result == false) {
                $loginError = "SQL query error: ".mysqli_error($conn);
            }
            else {
                $loginError = "Unknow Error";
            }
        }

    }

    mysqli_close($conn);

}

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
        $loginError = "That username does not exist!";
    }
    elseif ($passwordFromSQL != $password) {
        $loginError = "That password is incorrect!";
    }
    elseif ($passwordFromSQL == $password) {
        #$loginError = "Successful login!";
        header('Location: main.php');
        exit();
    }
    elseif ($result == false) {
        $loginError = "SQL query error: ".mysqli_error($conn);
    }
    else {
        $loginError = "Unknown Error";
    }

}
 ?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styling.css" rel="stylesheet">
        <title>Eventi - Login</title>
    </head>
    <body>
        <header>
            <img src="resources/Logo.png" style="width:302px;height:86px;"/>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
        </header>
        <p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $loginError;
            }
             ?>
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3>Please enter your details:</h3>
            <input type="text" placeholder="Username" name="username" value="<?php echo $formUsername;?>" required/>
            <input type="password" placeholder="Password" name="password" value="<?php echo $formPassword;?>" required/>
            <input type="submit" />
        </form>
        <h3>Or, create an account:</h3>
        <form action="create_new_user.php">
            <input type="submit" value="Join Eventi as a User" />
        </form>
        <form action="create_new_organiser.php">
            <button>Join Eventi as an Organiser</button>
        </form>



    </body>
</html>
