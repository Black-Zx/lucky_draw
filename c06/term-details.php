<?php
// session_start();
// include "php/db.php";

session_start();

define('LOCALHOST','192.82.60.214');
define('DB_USERNAME','myecdc_test');
define('DB_PASSWORD','hH66)QxbmI)4');
define('DB_NAME','myecdc_bat_spin');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
if(mysqli_connect_error()) {
	die("connection failed!" .mysqli_connect_error());
}


// if($_SERVER['REQUEST_METHOD'] == "POST") {
if(isset($_POST['insertContact'])) {
    
    
    // $lastId = $row['deliveryId'];

    // if($lastId == null) {
    //     $deliveryId = "DEL1";
    // } else {
    //     $deliveryId = substr($lastId, 3);
    //     $deliveryId = intval($deliveryId);
    //     $deliveryId = "DEL".($deliveryId + 1);
    // }
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $user_id = $_POST['user_id'];
    $name = validate($_POST['name']);
    $conatct_no = validate($_POST['contact']);


    define('UPLOAD_DIR', 'uploads/');
    $image_parts = explode(";base64,", $_POST['image']);
    $file = base64_decode($image_parts[1]);
    $safeName = generateRandomString(32).'.'.'jpg';
    $success = file_put_contents(UPLOAD_DIR . $safeName, $file);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d H:i:s");
 
    
    $insert = $conn->query("INSERT INTO term_details(user_id, name, conatct_no, signature, created_at)"
            . "VALUES ('$user_id', '$name', '$conatct_no', '$safeName', '$date')");
    if($insert) {
        echo "correct";
    } else {
        echo "error";
    }
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// if(isset($_GET['take'])) {
//     $deliveryId = $_GET['take'];
    
//     $stmt = $conn->query("UPDATE delivery SET deliveryStatus = 'Delivering' WHERE deliveryId='$deliveryId' LIMIT 1");
//     if($stmt) {
//         header("Location: ../takeOrder.php?success=Meals is starting to deliver");
//         exit();
//     } else {
//         echo $deliveryId . ' error';
//     }
// }

// if(isset($_GET['delivery'])) {
//     $deliveryId = $_GET['delivery'];
    
//     $stmt = $conn->query("UPDATE delivery SET deliveryStatus = 'Done' WHERE deliveryId='$deliveryId' LIMIT 1");
//     if($stmt) {
//         header("Location: ../takeOrder.php?success=Meals is received by the customer.");
//         exit();
//     } else {
//         echo $deliveryId . ' error';
//     }
// }

setcookie('outlet_id', '', time()-60*60*24*30, '/');
setcookie('user_id', '', time()-60*60*24*30, '/');

session_unset();
session_destroy();
?>