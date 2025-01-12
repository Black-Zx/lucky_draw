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



$region =$_GET['region'];

$sql = "SELECT DISTINCT ASE_id FROM users_wheel WHERE region = '$region'";

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
        echo "<option value='".$row["ASE_id"]."'>".$row["ASE_id"]."</option>";
    }
} else {
    echo "<option value=''>Region Found</option>";
}



$conn->close();
?>
