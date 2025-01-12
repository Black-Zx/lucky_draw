<?php
$myData = $_POST["myData"]; //a PHP Super Global variable which used to collect data after submitting it from the form

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

$sql = "SELECT code FROM secret";
$result = $conn->query($sql);
$isMatch = 'false';

$prizes = [];
if ($result->num_rows > 0) {
	$prizes = $result->fetch_all(MYSQLI_ASSOC);
    if ($myData == $prizes[0]['code']) {
      $isMatch = 'true';
      $cookie_name = "isMatch";
      $cookie_value = "true";
      setcookie($cookie_name, $cookie_value, time() + (18000), "/");
    }
  } else {
    $cookie_name = "isMatch";
    $cookie_value = "false";
    setcookie($cookie_name, $cookie_value, time() + (18000), "/");
    $isMatch = 'false';
  }
  $conn->close();
  echo json_encode($isMatch);
?>