<?php
$dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form

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

$_SESSION["user_id"] = "";

// $sql = "SELECT * FROM prizes".$dataID;
// $result = $conn->query($sql);
// $prizes = [];

// if ($result->num_rows > 0) {
// 	$prizes = $result->fetch_all(MYSQLI_ASSOC);
//   } else {
// 	echo "0 results";
//   }
//   $conn->close();
//   echo json_encode($prizes);

  $sql = "SELECT * FROM prizes".$dataID;
$result = $conn->query($sql);
$prizes = [];

if ($result->num_rows > 0) {
	$prizes = $result->fetch_all(MYSQLI_ASSOC);
  } else {
	echo "0 results";
  }
  $conn->close();
  echo json_encode($prizes);
?>