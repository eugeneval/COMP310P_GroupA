<?php
//todo add my sql permissions GRANT INSERT.....
require 'functions.php';

$loginError = "";
$password = "";
$usernameNew = "";
setcookie("username", "", time()-1);
setcookie("user_ID", "", time()-1);
setcookie("adminPriveleges", "", time()-1);

if (isset($_COOKIE["loggedout"])) {
    $loginError = "Sorry, you have been logged out due to inactivity.";
}

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

    //Connect to server
    $conn = db_connect();

    //Existing user validation
    if ($username != "") {
        $loginError = login($conn, $username, $password);
    }
    //New user creation
    else if ($usernameNew != "") {
        $sql = "INSERT INTO `user` (`Name`, `Username`, `Password`, `Email`, `Address`, `Company`, `Phone_Number`, `Paypal_Address`, `Admin_Priveleges`)
        VALUES ('$name', '$usernameNew', '$password', '$email', '$address', '$company', '$phone', '$paypal', $adminPriveleges);";
        // TODO: change to prepared statement

        // NOTE: password confirmation is also done on creation pages, this is a backup
        if ($password != $passwordConfirm){
            $loginError = "Passwords do not match!";
        }
        else {
            $result = mysqli_query($conn, $sql);

            if ($result == true) {
                $loginError = "New user succesfully created!";
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

 ?>

<!DOCTYPE html>
<html>
    <head>
        <link href="styling.css" rel="stylesheet">
        <title>Eventi - Login</title>
    </head>
    <body>
        <header>
            <a href="main.php"><img src="resources/Logo.png" style="width:302px;height:86px;"/></a>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
        </header>
        <p>
            <?php
                echo $loginError;
             ?>
        </p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3>Please enter your details:</h3>
            <input type="text" placeholder="Username" name="username" value="<?php echo $usernameNew;?>" required/>
            <input type="password" placeholder="Password" name="password" value="<?php echo $password;?>" required/>
            <input type="submit" />
        </form>
        <h3>Or, create an account:</h3>
        <form action="create_new_user.php">
            <input type="submit" value="Join Eventi as a User" />
        </form>
        <form action="create_new_organiser.php">
            <input type="submit" value="Join Eventi as an Organiser" />
        </form>



    </body>
</html>
