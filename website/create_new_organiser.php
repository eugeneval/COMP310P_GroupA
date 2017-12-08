<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eventi - New Organiser</title>
        <link href="styling.css" rel="stylesheet">
        <style>
        /**/ NOTE: for some reason this stops working if you move it to styling.css.
        /**/ TODO: figure out why.
        img.form_icons {
            height: 1em;
        }
        </style>
    </head>
    <body>
        <header>
            <img src="resources/Logo.png" style="width:302px;height:86px;"/>
            <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
        </header>
        <form method="post" action="login.php">
            <h3>Create a new account:</h3>
            <img src="resources/form_icons/Name.png" class="form_icons"/>
            <input type="text" placeholder="Full Name" maxlength="40" required name="name"/>
            <br />
            <img src="resources/form_icons/Username.png" class="form_icons"/>
            <input type="text" placeholder="Chosen Username" maxlength="20" required name="usernameNew"/>
            <br />
            <img src="resources/form_icons/Password.png" class="form_icons"/>
            <input type="password" placeholder="Password" maxlength="20" required name="password" id="password" onchange='check_pass();'/>
            <br />
            <img src="resources/form_icons/Password.png" class="form_icons"/>
            <input type="password" placeholder="Confirm Password" maxlength="20" required name="passwordConfirm" id="confirm_password" onchange='check_pass();'/>
            <br />
            <img src="resources/form_icons/Email.png" class="form_icons"/>
            <input type="email" placeholder="Email Address" maxlength="20" required name="email"/>
            <br />
            <img src="resources/form_icons/Address.png" class="form_icons"/>
            <input type="text" placeholder="Company Address" required name="address"/>
            <br />
            <img src="resources/form_icons/Work.png" class="form_icons"/>
            <input type="text" placeholder="Company Name" maxlength="20" required name="company"/>
            <br />
            <img src="resources/form_icons/Phone.png" class="form_icons"/>
            <input type="tel" placeholder="Phone Number" maxlength="12" required name="phone"/>
            <br />
            <img src="resources/form_icons/Paypal.png" class="form_icons"/>
            <input type="text" placeholder="Paypal" name="paypal"/>
            <br />
            <input type="submit" id="submit" disabled/>
            <input type="hidden" name="adminPrivelges" value=1 />
        </form>
        <p id="passwordMatch"></p>
    </body>
    <script src="javascript/login.js"></script>
</html>
