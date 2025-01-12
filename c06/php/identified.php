<?php
// $dataID = $_POST["dataID"]; //a PHP Super Global variable which used to collect data after submitting it from the form


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

session_start();

// $batch = $_GET['batch'];
$region = $_GET['region'];
$ase = $_GET['ase'];
$outlet_id = $_GET['outlet_id'];
$outlet_name = $_GET['outlet_name'];


$check = $conn->query("SELECT id FROM users_wheel WHERE outlet_id= '$outlet_id' AND outlet_name='$outlet_name' ");
if ($check->num_rows == 1) {
    $check_row =  mysqli_fetch_assoc($check);
    $user_id = $check_row['id'];
    $_SESSION["user_id"] = $user_id;
}



$user_id = $_SESSION['user_id'];


// if ($region != "" || $ase != "" ||  $outlet_id != "" ||  $outlet_name != "") {
//     # code...
// }



if (empty($region) || empty($ase) || empty($outlet_id) || empty($outlet_name) ) {
    echo "empty";
} else {
    $sql = $conn->query("SELECT * FROM users_wheel WHERE id = '$user_id' ");
    if($sql->num_rows == 1) {
        $row = mysqli_fetch_assoc($sql);
        $batch =  $row['batch']; 
        echo $batch;
        // if($row['batch'] == "1A") {
        //     // setcookie("id", $row['userId'], time()+60*60*24*30, "/", NULL);
        //     // setcookie("email", $row['email'], time()+60*60*24*30, "/", NULL);
        //     // $_SESSION['email'] = $row['email'];
        //     // echo '1A'; 
           
        // } else {
        //     setcookie("id", $row['userId'], time()+60*60*24*30, "/", NULL);
        //     setcookie("email", $row['email'], time()+60*60*24*30, "/", NULL);
        //     $_SESSION['email'] = $row['email'];
        //     echo 'user';
        // }
    } else {
        echo "invalid";
    }
}

// $sql = "SELECT spins FROM users_wheel where id='$batch'";
// $result = $conn->query($sql);
// // $prizes = $result->fetch_assoc();
// // $prizes = [];

// if ($result->num_rows > 0) {
// 	$prizes = $result->fetch_assoc();
//     $spins = $prizes['spins'];
//     // <?php echo $data['prodImg']; 
//   } else {
// 	echo "0 results";
//   }
//   $conn->close();
//   echo $spins;
//   echo json_encode($spins);
$conn->close();
?>

