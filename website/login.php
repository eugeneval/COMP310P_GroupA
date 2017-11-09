<?php

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
    //New user creation
    else if ($usernameNew != "") {
        $sql = "INSERT INTO `user` (`Name`, `Username`, `Password`, `Email`, `Address`, `Company`, `Phone_Number`, `Paypal_Address`)
        VALUES ('$name', '$usernameNew', '$password', '$email', '$address', '$company', '$phone', '$paypal');";

        if ($password != $passwordConfirm){
            $loginError = "Passwords do not match!";
        }
        else {
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $loginError = "User created!";
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
            <input type="text" placeholder="Username" name="username" required/>
            <input type="password" placeholder="Password" name="password" required/>
            <input type="submit" />
        </form>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3>Or create a new account:</h3>
            <input type="text" placeholder="Your Name" maxlength="40" required name="name"/>
            <br />
            <input type="text" placeholder="Your Chosen Username" maxlength="20" required name="usernameNew"/>
            <br />
            <input type="password" placeholder="Your Password" maxlength="20" required name="password"/>
            <br />
            <input type="password" placeholder="Confirm Password" maxlength="20" required name="passwordConfirm"/>
            <br />
            <input type="email" placeholder="Your Email" maxlength="20" required name="email"/>
            <br />
            <input type="text" placeholder="Your Address" required name="address"/>
            <br />
            <input type="text" placeholder="Your Company" maxlength="20" required name="company"/>
            <br />
            <input type="tel" placeholder="Your Phone Number" maxlength="12" required name="phone"/>
            <br />
            <input type="text" placeholder="Paypal" name="paypal"/>
            <br />
            <input type="submit" />
        </form>

    </body>
</html>
