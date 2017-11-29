<?php

require 'functions.php';

$loginError = "";
$password = "";
$usernameNew = "";

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
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
<style>
body {font-family: "Raleway", Arial, sans-serif}
.w3-row img {margin-bottom: -8px}
</style>
<body>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">

  <!-- Header -->
  <header class="w3-container w3-xlarge w3-padding-24">
    <a href="#" class="w3-left w3-button w3-white">Eventi</a>
    <a href="#about" class="w3-right w3-button w3-white">About</a>
  </header>


<!-- End Page Content -->
</div>

<!-- Footer / About Section -->
<footer class="w3-light-grey w3-padding-64 w3-center" id="about">
  <h2>About</h2>
  <form style="margin:auto;width:60%" action="/action_page.php" target="_blank">
    <p class="w3-large w3-text-pink">Welcome to Eventi, the intelligent assistant for young professionals!</p>
    <br/>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="w3-section">
        <label><b>Username</b></label>
        <input class="w3-input w3-border" type="text" name="Username" value="<?php echo $usernameNew;?>" required/>
      </div>
      <div class="w3-section">
        <label><b>Password</b></label>
        <input class="w3-input w3-border" type="text" required name="Password" value="<?php echo $password;?>" required/>
      </div>
      <button type="submit" class="w3-button w3-block w3-dark-grey">Send</button>

    </form>

  </form>
  <br>


</body>
</html>
