<?php

require 'functions.php';
$username = checkCurrentUser();


?>

 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Eventi - Select Interests</title>
         <link href="styling.css" rel="stylesheet">
     </head>
     <body>
         <header>
             <a href="main.php"><img src="resources/Logo.png" style="width:302px;height:86px;"/></a>
             <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
             <ul>
                 <li class="menubar">Logged in as: <?php echo $username; ?></li>
                 <li class="menubar"><a href="login.php">Logout</a></li>
             </ul>
         </header>
         <p>Select all of your interests for Eventi: </p>
         <form method="post" action='main.php'>
              Arts <input type="checkbox" name="Arts" value="Arts"><br />
              Business <input type="checkbox" name="Business" value="Business"><br />
              Entrepreneurship <input type="checkbox" name="Entrepreneurship" value="Entrepreneurship"><br />
              Finance <input type="checkbox" name="Finance" value="Finance"><br />
              Marketing <input type="checkbox" name="Marketing" value="Marketing"><br />
              Networking <input type="checkbox" name="Networking" value="Networking"><br />
              Performance <input type="checkbox" name="Performance" value="Performance"><br />
              Personal Development <input type="checkbox" name="Personal Development" value="Personal Development"><br / />
              Technology <input type="checkbox" name="Technology" value="Arts"><br />
              Workshops <input type="checkbox" name="Workshops" value="Workshops"><br />
              <p><input type="submit" value="Submit" disabled></p>
              <input type="submit" value="Skip choosing interests" />
              <input type="hidden" name="skippedInterests" value=1 />
         </form>
     </body>
 </html>
