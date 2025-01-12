<?php
$request = $_POST["myData"]; //a PHP Super Global variable which used to collect data after submitting it from the form
$dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form
$user_id = $_POST["user_id"];

// echo "<pre>";
// print_r($request);
// echo "</pre>";
// die();

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
foreach ($request as $key => $value) {
  $sql = "INSERT INTO games (wheel_result, starttime, endtime, created, prizes_id, user_id) VALUES (".$value['wheelResult'].", '".$value['starttimeRef']."', '".$value['endtimeRef']."', '".$value['createdRef']."', ".$value['wheelResult'].", ".$user_id.") ";

  if ($conn->query($sql) === TRUE) {
    $prizes = [];
    
      if($value['isGameover'] == 'false'){
        $sql = "UPDATE prizes".$dataID." SET quantity = ".$value['newQuantity']." where id =".$value['wheelResult'];
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
}

  $conn->close();
  echo json_encode($prizes);
?>