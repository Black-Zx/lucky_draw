<?php
// Database connection
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


// Fetch names corresponding to the selected ID
// $id = $_GET['id'];
// $sql = "SELECT id, outlet_name FROM users_wheel WHERE outlet_id = $id";
$name = $_GET['name'];
$ase =$_GET['ase'];

$sql = "SELECT id, outlet_id FROM users_wheel WHERE outlet_name LIKE \"%$name%\" AND ASE_id ='$ase' ";

$result = $conn->query($sql);

// Output options for the name dropdown
if ($result->num_rows > 0) {
    if ($result->num_rows > 1) {
        $sql2 = "SELECT id, outlet_id FROM users_wheel WHERE outlet_name = '$name' AND ASE_id ='$ase' ";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {
                $outlet_id = $row2["outlet_id"];
                echo "$outlet_id";
                // echo "<option value=\"".$row2["outlet_id"]."\">".$row2["outlet_id"]."</option>";
                
                // outlet id change to optional
                // echo "<option value='".$outlet_id."'>".$outlet_id."</option>";
                $user_id = $row2["id"];
            }
        }
    }else {
        while($row = $result->fetch_assoc()) {
    
            $outlet_id = $row["outlet_id"];
            echo "$outlet_id";
            // echo "<option value=\"".$row["outlet_id"]."\">".$row["outlet_id"]."</option>";

            // outlet id change to optional
            // echo "<option value='".$outlet_id."'>".$outlet_id."</option>";
            $user_id = $row["id"];
        }
    }
   
    
} else {
    echo "<option value=''>No Names Found</option>";
}

// $sql = "SELECT outlet_id FROM users_wheel WHERE outlet_name LIKE '%$name%'";
// // $sql = "SELECT outlet_id FROM users_wheel WHERE outlet_name = '$name'";
// $result = $conn->query($sql);
// $row = $result->fetch_assoc();
// $outlet_id =$row["outlet_id"];



$conn->close();


// setcookie("outlet_id", $id, time()+60*60*24*30, "/", NULL);
// setcookie("user_id", $user_id, time()+60*60*24*30, "/", NULL);
// session_destroy();


$_SESSION['outlet_id'] = $outlet_id;
// $_SESSION['outlet_id'] = $id;
// echo  $_SESSION["outlet_id"];

// $_SESSION['ID'] = $_POST['ID'];
// $_SESSION["user_id"] = $user_id;
// echo  $_SESSION["user_id"];
// print_r($_SESSION);
?>
