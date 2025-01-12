<?php
// $request = $_POST["myData"]; //a PHP Super Global variable which used to collect data after submitting it from the form
$dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form
// $spinsnum = $_POST["spinsnum"]; 
// echo $spinsnum;


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

$check_total = "SELECT spins FROM users_wheel WHERE id= '$dataID' ";
$CheckResult = mysqli_query($conn, $check_total);
$totalRow = mysqli_fetch_array($CheckResult);
$check_spins = $totalRow['spins'];

if ($check_spins >= 0) {

    $check = "SELECT spins FROM users_wheel where id=".$dataID;
    // $sql->spins
    $result = $conn->query($check);
    $prizes = $result->fetch_assoc();
    $check_spins = $prizes['spins'];
    
    $update_spins = $conn->query("UPDATE users_wheel SET spins = spins-1 WHERE id = '$dataID'");
    if($update_spins) {
        // echo "success".$dataID;
        $sql = "SELECT spins FROM users_wheel where id=".$dataID;
        $result = $conn->query($sql);
        $prizes = $result->fetch_assoc();
        $spins = $prizes['spins'];
    
        // if ($spins < 0 ) {
    
        // }
    } else {
        // echo "false";
        $spins = 0;
        
    }
}else {
    // echo "false";
    $conn->close();
    $spins = 0;
}

// }else {
//     $update_spins = $conn->query("UPDATE users_wheel SET spins = spins WHERE id = '$dataID'");
//     if($update_spins) {
//         $sql = "SELECT spins FROM users_wheel where id=".$dataID;
//         $result = $conn->query($sql);
//         $prizes = $result->fetch_assoc();
//         $spins = $prizes['spins'];
//     }
// }



$conn->close();

echo $spins;

// $sql = "DELETE FROM prizes".$dataID;
// $conn->query($sql);

// $sql = "ALTER TABLE prizes".$dataID." AUTO_INCREMENT = 1";

// if ($conn->query($sql) === TRUE) {
//   $prizes = [];

//   foreach ($request as $key => $value) {
//     $sql = "INSERT INTO prizes".$dataID." (name, quantity, rate_min, rate_max, is_gameover, created) VALUES ('".$value['name']."', '".$value['quantity']."', '".$value['rate_min']."', '".$value['rate_max']."', '".$value['is_gameover']."', '".$value['created']."') ";
//     if ($conn->query($sql) === TRUE) {
//       $prizes[] = $value;
//       // echo "Record updated successfully";
//     } else {
//       echo "Error updating record: " . $conn->error;
//     }
//   }
// } else {
//   echo "Error deleting record: " . $conn->error;
// }

//   $conn->close();
//   echo json_encode($prizes);
?>