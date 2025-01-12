<?php
$request = $_POST["myData"]; //a PHP Super Global variable which used to collect data after submitting it from the form
$dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form

// $servername = "localhost";
// $username = "";
// $dbname = "";
// $password = "";

$servername = "192.82.60.214";
$username = "myecdc_test";
$dbname = "myecdc_bat_spin";
$password = "hH66)QxbmI)4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM prizes".$dataID;
$conn->query($sql);

$sql = "ALTER TABLE prizes".$dataID." AUTO_INCREMENT = 1";

if ($conn->query($sql) === TRUE) {
  $prizes = [];

  foreach ($request as $key => $value) {
    $sql = "INSERT INTO prizes".$dataID." (name, quantity, rate_min, rate_max, is_gameover, created) VALUES ('".$value['name']."', '".$value['quantity']."', '".$value['rate_min']."', '".$value['rate_max']."', '".$value['is_gameover']."', '".$value['created']."') ";
    if ($conn->query($sql) === TRUE) {
      $prizes[] = $value;
      // echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }
} else {
  echo "Error deleting record: " . $conn->error;
}

  $conn->close();
  echo json_encode($prizes);
?>