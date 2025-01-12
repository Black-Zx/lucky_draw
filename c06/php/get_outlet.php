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



$ase =$_GET['ase'];

// $sql = "SELECT outlet_id FROM users_wheel WHERE ASE_id = '$ase'";
$sql = "SELECT outlet_name FROM users_wheel WHERE ASE_id = '$ase'";

$result = $conn->query($sql);


// $sql = $conn->query("SELECT * FROM users_wheel WHERE region = '$region'");
// if($sql->num_rows == 1) {
//     $row = mysqli_fetch_assoc($sql);
//     if($row['role'] == "Admin") {
//         setcookie("id", $row['userId'], time()+60*60*24*30, "/", NULL);

// Output options for the name dropdown
if ($result->num_rows > 0) {
    echo "<option value=''></option>";
    while($row = $result->fetch_assoc()) {
        echo "<option value=\"".$row["outlet_name"]."\">".$row["outlet_name"]."</option>";
        // echo "<option value='".$row["outlet_id"]."'>".$row["outlet_id"]."</option>";
    }
} else {
    echo "<option value=''>Region Found</option>";
}



$conn->close();
?>
