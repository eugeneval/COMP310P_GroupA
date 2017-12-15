<?php
/*******************************************************************************
* Eventi                                                                       *
*                                                                              *
* Version: 1.0                                                                 *
* Authors: Eugene Valetsky - George Imafidon - Syed Ismail Ahmad               *
*******************************************************************************/
require 'functions.php';
$username = checkCurrentUser();
$conn = db_connect();
$sql = "";
$result = mysqli_query($conn, $sql);
?>

 <!DOCTYPE html>
 <!--Allows user to skip or select interests (or categories) they are interested
 in for the machine learning neural network to recommend events-->
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
             <fieldset>
                 <legend>Categorisation</legend>
                 <p>Select all of your interests for Eventi<br /><br /><small>use ctrl or cmd to select multiple tags</small></p>
                 <select multiple name="category" size="10">
                     <option selected="true" disabled="disabled"></option>
                     <?php

                         $sql = "SELECT * FROM category";
                         $result = mysqli_query($conn, $sql);
                         while ($row = mysqli_fetch_assoc($result)) {
                             echo "<option value=\"".$row['Category_ID']."\">".$row['Name']."</option>";
                         }
                         mysqli_close($conn);
                      ?>
                 </select>
                 <br />
             </fieldset>
             <p><input type="submit" value="Submit" enabled></p>
             <input type="submit" value="Skip choosing interests" />
             <input type="hidden" name="skippedInterests" value=1 />
         </form>

     </body>
 </html>
