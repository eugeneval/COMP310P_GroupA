<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - New Organiser</title>
        <link href="styling.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <img src="resources/Logo.png" style="width:302px;height:86px;"/>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
        </header>
        <form method="post" action="login.php">
            <h3>Or create a new account:</h3>
            <input type="text" placeholder="Your Name" maxlength="40" required name="name"/>
            <br />
            <input type="text" placeholder="Your Chosen Username" maxlength="20" required name="usernameNew"/>
            <br />
            <input type="password" placeholder="Your Password" maxlength="20" required name="password" id="password" onchange='check_pass();'/>
            <br />
            <input type="password" placeholder="Confirm Password" maxlength="20" required name="passwordConfirm" id="confirm_password" onchange='check_pass();'/>
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
            <input type="submit" id="submit" disabled/>
            <input type="hidden" name="adminPrivelges" value=1 />
        </form>
        <p id="passwordMatch"></p>
    </body>
    <script src="javascript/login.js"></script>
</html>