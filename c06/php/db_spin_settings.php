<?php
$dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form

// $servername = "localhost";
// $username = "myecdc_spin2win";
// $dbname = "myecdc_spin2win";
// $password = "WQG-}fXO+[?;";

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

$sql = "SELECT * FROM spin_settings where wheel_id=".$dataID;
$result = $conn->query($sql);
$prizes = [];

if ($result->num_rows > 0) {
	$prizes = $result->fetch_assoc();
  } else {
	echo "0 results";
  }
  $conn->close();
  echo json_encode($prizes);
?>