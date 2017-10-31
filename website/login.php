<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "root";
    $dbname = "event manager";

    $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

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
        $loginError = "SQL query error!";
    }
    else {
        $loginError = "Unknown error";
    }

    mysqli_close($conn);

}
 ?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styling.css" rel="stylesheet">
        <title>Login</title>
    </head>
    <body>
        <header>
            <h1></h1>
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
            <input type="text" placeholder="Username" name="username"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="submit" />
        </form>
        <form>
            <h3>Or create a new account:</h3>
            <input type="text" placeholder="Your Name" maxlength="40" required/>
            <br />
            <input type="text" placeholder="Your Chosen Username" maxlength="20" required/>
            <br />
            <input type="password" placeholder="Your Password" maxlength="20" required/>
            <br />
            <input type="password" placeholder="Confirm Password" maxlength="20" required/>
            <br />
            <input type="email" placeholder="Your Email" maxlength="20" required/>
            <br />
            <input type="text" placeholder="Your Address" required/>
            <br />
            <input type="text" placeholder="Your Company" maxlength="20" required/>
            <br />
            <input type="tel" placeholder="Your Phone Number" maxlength="12" required/>
            <br />
            <input type="text" placeholder="Paypal" />
            <br />
            <input type="submit" />

        </form>

    </body>
</html>
