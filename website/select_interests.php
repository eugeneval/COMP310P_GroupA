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
             <img src="resources/Logo.png" style="width:302px;height:86px;"/>
             <h4>Welcome to Eventi, the intelligent assistant for young professionals!</h4>
             <ul>
                 <li class="menubar">Logged in as: <?php echo $username; ?></li>
                 <li class="menubar"><a href="login.php">Logout</a></li>
             </ul>
         </header>
         Select all of your interests for Eventi:
         <form method="post" action='main.php'>
                <p></p>
                <ul>
                    <li><input type="checkbox" name="Arts" value="Arts"> Arts</li>
                    <li><input type="checkbox" name="Business" value="Business"> Business</li>
                    <li><input type="checkbox" name="Entrepreneurship" value="Entrepreneurship"> Entrepreneurship</li>
                    <li><input type="checkbox" name="Finance" value="Finance"> Finance</li>
                    <li><input type="checkbox" name="Marketing" value="Marketing"> Marketing</li>
                    <li><input type="checkbox" name="Networking" value="Networking"> Networking</li>
                    <li><input type="checkbox" name="Performance" value="Performance"> Performance</li>
                    <li><input type="checkbox" name="Personal Development" value="Personal Development"> Arts</li>
                    <li><input type="checkbox" name="Technology" value="Arts"> Technology</li>
                    <li><input type="checkbox" name="Workshops" value="Workshops"> Arts</li>
                    <p><input type="submit" value="Submit" disabled></p>

             <input type="submit" value="Skip choosing interests" />
             <input type="hidden" name="skippedInterests" value=1 />
         </form>
     </body>
 </html>
