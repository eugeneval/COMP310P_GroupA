<?php
/*******************************************************************************
* NEURAL NETWORK WITH SQL INTEGRATION IN PHP                                   *
*                                                                              *
* Version: 1.01                                                                *                                                       *
* Authors: Syed Ismail Ahmad - Eugene Valetsky - George Imafidon               *                              *
*******************************************************************************/

/////COMMENTS////////////////////////////
//This neural network classifier is used to recommend events to Eventi's
//user base. It works by taking six inputs such as age/gender/Interests
//and from that optimising a neural network tailored to each event. It is
//a simple multi-layer perceptron based network based on the sign activation
//function. It has a tuneable training rate which will be optimised once we
//have tested different configurations. It integrates with the ml_w SQL table
//in which weights are stored and updated.
/////////////////////////////////////////

/*
  CREATE TABLE ml_w (
    id int NOT NULL AUTO_INCREMENT,
    oneonel1 DECIMAL,
    oneonel2 DECIMAL,
    oneonel3 DECIMAL,
    oneonel4 DECIMAL,
    oneonel5 DECIMAL,
    oneonel6 DECIMAL,
    onetwol1 DECIMAL,
    onetwol2 DECIMAL,
    onetwol3 DECIMAL,
    onetwol4 DECIMAL,
    onetwol5 DECIMAL,
    onetwol6 DECIMAL,
    twoonel1 DECIMAL,
    twotwol1 DECIMAL,
    PRIMARY KEY (id));

//////////////////////////////////////////
   *INPUT LAYER* ////////////////////////////////////////
                           //////////////////////////////////////////
     -----0-----
                   *HIDDEN LAYER*
     -----0-----
                    -----0-----
     -----0-----                  *OUTPUT LAYER*
                                   -----0------  *MAGIC*
     -----0-----
                    -----0-----
     -----0-----

     -----0-----           //////////////////////////////////////////
              //////////////////////////////////////////
//////////////////////////////////////////

*******************************************************************************/

////SETUP/////////////////////////////////
//require 'functions.php';
//$inputs = array(-1,-1,-1,0,0,0); ----- Create array with required inputs;
//////////////////////////////////////////

////FEED FORWARD//////////////////////////
//$output = perceptron($inputs);
//$final_output = $output[4];
//////////////////////////////////////////

////TRAIN NETWORK/////////////////////////
//$train_array = perceptron($inputs);
//$perceptron_train = perceptron_train($inputs, 1, $train_array[0], $train_array[1], $train_array[2], $train_array[3]);
//////////////////////////////////////////
?>

<?php
function perceptron($inputs){

////SQL CONNECTION////////////////////////
$conn = db_connect();
$sql = "SELECT * FROM ml_w WHERE id=1";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$weights1l = array($row['oneonel1'], $row['oneonel2'], $row['oneonel3'],
                   $row['oneonel4'], $row['oneonel5'], $row['oneonel6']);

$weights2l = array($row['onetwol1'], $row['onetwol2'], $row['onetwol3'],
                   $row['onetwol4'], $row['onetwol5'], $row['onetwol6']);

$twoonel1 = $row['twoonel1'];
$twotwol1 = $row['twotwol1'];

mysqli_close($conn);
}
//////////////////////////////////////////

////PERCEPTRON CALC///////////////////////
$perceptron1val = perceptron_feedforward($inputs, $weights1l);
$perceptron1out = activate($perceptron1val);

$perceptron2val = perceptron_feedforward($inputs, $weights2l);
$perceptron2out = activate($perceptron2val);

$perceptron3val = ($perceptron1out*$twoonel1)+($perceptron2out*$twotwol1);
$perceptron3out = activate($perceptron3val);

$perceptron_array = array($weights1l, $weights2l, $perceptron1out, $perceptron2out, $perceptron3out);
return $perceptron_array;
}
//////////////////////////////////////////
?>

<?php
function activate($sum) {
  if ($sum >= 0) {
    return 1;
  }
  else {
    return -1;
  }
}
?>

<?php
function perceptron_feedforward($inputs, $weights) {
  $sum = 0;
  $count = count($inputs);
  for ($i = 0; $i <= $count; $i++) {
      $sum += $inputs[$i]*$weights[$i];
  }
  return $sum;
}
?>

<?php
function perceptron_train($inputs, $desired_output, $weights1l, $weights2l, $twoonel1, $twotwol1) {
  $learning_rate = 0.02;
  $perceptron_array = perceptron($inputs);
  $guess = $perceptron_array[4];
  $error = $desired_output - $guess;

  $count = count($weights1l);

  for ($i = 0; $i <= $count; $i++) {
      $weights1l[$i] += $learning_rate*$error*$inputs[$i];
  }

  //$weight1l = $mysqli->real_escape_string($weight1l);

  $conn = db_connect();
  $sql = "UPDATE ml_w
          SET oneonel1 = $weights1l[0], oneonel2 = $weights1l[1], oneonel3 = $weights1l[2],
              oneonel4 = $weights1l[3], oneonel5 = $weights1l[4], oneonel6 = $weights1l[5]
          WHERE id=1;";
  $result = mysqli_query($conn, $sql);

  //var_dump($mysqli->real_escape_string($sql));

  if ($result) {
        echo "Record Updated";
    }
  else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  //$result = mysqli_query($conn, $sql);

  $count = count($weights2l);
  for ($i = 0; $i <= $count; $i++) {
      $weights2l[$i] += $learning_rate*$error*$inputs[$i];
  }

  //$weight2l = $mysqli->real_escape_string($weight2l);

  $sql = "UPDATE ml_w
          SET onetwol1 = $weights2l[0], onetwol2 = $weights2l[1], onetwol3 = $weights2l[2],
              onetwol4 = $weights2l[3], onetwol5 = $weights2l[4], onetwol6 = $weights2l[5]
          WHERE id=1;";

  $result = mysqli_query($conn, $sql);

  $twoonel1 += $learning_rate*$error*$perceptron1out;
  $twotwol1 += $learning_rate*$error*$perceptron2out;

  //$twotwol1 = $mysqli->real_escape_string($twotwol1);

  $sql = "UPDATE ml_w
          SET twoonel1 = $twoonel1, twotwol1 = $twotwol1;
          WHERE id=1;";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
}
?>
