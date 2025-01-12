<?php
// $dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form

$dataID = $_GET["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form


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


$check_total = "SELECT total_spins FROM users_wheel WHERE id= '$dataID' ";
$CheckResult = mysqli_query($conn, $check_total);
$totalRow = mysqli_fetch_array($CheckResult);
$check_spins = $totalRow['total_spins'];

$sql = "SELECT spins FROM users_wheel where id='$dataID' LIMIT $check_spins";
$result = $conn->query($sql);
// $prizes = $result->fetch_assoc();
// $prizes = [];

if ($result->num_rows > 0) {
	$prizes = $result->fetch_assoc();
  $spins = $prizes['spins'];
  
  if ($spins > 0) {
    $spins = $prizes['spins'];
  }elseif ($spins == 0) {
    $spins = "0";
  }else {
    $spins = "0";
  }

  if ($spins > $check_spins) {
    $spins = "0";
  }elseif ($spins == "-1") {
    $spins = "0";
  }
}
  // } elseif ($result->num_rows == 0) {
  //   echo "0";
  // } else {
	//   echo "0";
  // }
  $conn->close();
  echo $spins;
//   echo json_encode($spins);
?>

