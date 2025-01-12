<?php 
// include ('./php/db.php');
// header("Location: ./index.php");
// 	die();

define('LOCALHOST','192.82.60.214');
define('DB_USERNAME','myecdc_test');
define('DB_PASSWORD','hH66)QxbmI)4');
define('DB_NAME','myecdc_bat_spin');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
if(mysqli_connect_error()) {
	die("connection failed!" .mysqli_connect_error());
}

session_start();

$user_id = $_SESSION["user_id"];
// echo $user_id;
// $user_id = $_COOKIE['user_id'];
$query = "SELECT * FROM users_wheel WHERE id= '$user_id'"; //ORDER BY voucherID desc limit 1
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$total_spins = $row['total_spins'];
$db_spins = $row['spins'];

if ($db_spins <= 0) {
	
	header("Location: ./term.php");
	die();
}
// echo $lastId ;
// if($lastId == "") {
//     $voucherID = "V1001";
// } else {
//     $voucherID = substr($lastId, 1);
//     $voucherID = intval($voucherID);
//     $voucherID = "V".($voucherID + 1);
// }

	# code...


?>
<!-- window.location.href = "./start_wheel_"+response+".php"; -->

<!-- <script>window.location.href("/index.php");</script>  -->
<script>
	// window.open("./index.php", "_self");
	// break;

	
</script>

<!DOCTYPE html>
<html lang="en" manifest="cache.manifest">
<!-- <html lang="en"> -->
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

<!-- iOS related -->
<!-- <link rel="apple-touch-icon" sizes="180x180" href="http://14.102.150.59/~kent/html5Games/spin2win/app-logo.png"> -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Spin & Win">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- end iOS related -->

<title>C06 Total BAT Program</title>

<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" />
<!-- <link rel="stylesheet" href="libs/toastr/toastr.min.css" /> -->
<link rel="stylesheet" href="css/style.css">

<!-- wheel -->
<script src="libs/TweenLite.min.js"></script>
<script src="libs/plugins/CSSPlugin.min.js"></script>

<script src="libs/EasePack.min.js"></script>
<script src="libs/Stats.js"></script>
<script src="libs/utils.js"></script>
<script src="libs/formatDate.js"></script>
<script src="libs/jquery-2.2.0.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script src="libs/toastr/toastr.min.js"></script>
<script src="libs/inobounce.js"></script>
<script src="libs/Draggable-latest-beta.js"></script>

<script src="js/MainGame.js"></script>
<script id="helper" data-id="1" src="js/Module_db.js"></script>
<script src="js/Main.js"></script>

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
  <style>
	/* .custom-select {
		display: block;
		margin: 0 auto;
		width: 300px;
		height: 50px;
		font-size: 20px;
		border-radius: 35px;
		text-align: center;
	}

	.form-control {
		display: block;
		margin: 0 auto;
		width: 200px;
		height: 50px;
		font-size: 20px;
		border-radius: 35px;
		text-align: center;
	} */
/* 
	.mt-3 {
	margin-top: 0.5rem !important;
	}

	.mt-5 {
		margin-top: 3rem !important;
	} */

	.row {
  --bs-gutter-x: 1.5rem;
  --bs-gutter-y: 0;
  display: flex;
  flex-wrap: wrap;
  margin-top: calc(-1 * var(--bs-gutter-y));
  margin-right: calc(-0.5 * var(--bs-gutter-x));
  margin-left: calc(-0.5 * var(--bs-gutter-x));
}

	/* .col-6 {
  flex: 0 0 auto;
  width: 50%;
}

.col-auto {
  flex: 0 0 auto;
  width: auto;
} */

/* .row-cols-6 > * {
  flex: 0 0 auto;
  width: 16.6666666667%;
} */

.card-con {
	/* margin-top: 20px; */
    /* background-color: bisque; */
    /* border-radius: 20px; */
    /* padding: 30px 20px; */
    /* padding: 2px 50px; */
    margin-left: 18px;
    margin-right: 18px;
    margin-top: 20px;
    /* margin-bottom: 6px; */
    color: white;
    width: 315px;
}

.left-remain{
	margin-left: 10px;
}

.numberSpin {
	/* float: right; */
    /* text-align: right; */
    width: 10px;
    /* padding: 10px; */
    /* margin: 0 auto; */
}

.spin-btn-back {
    /* background-color: #5f40a3; */
    background: rgba(105, 171, 84, 1) !important;
    padding-top: 15px;
    padding-right: 30px;
    padding-bottom: 15px;
    padding-left: 30px;
    border-radius: 50px;
    width: 152px;
    display: block;
    color: white;
    text-align: center;
    margin: 0 auto;
    font-size: 18px;
}

.modal-footer .modal-btn-back{
	background: rgba(105, 171, 84, 1) !important;
    padding-top: 15px;
    padding-right: 30px;
    padding-bottom: 15px;
    padding-left: 30px;
    border-radius: 50px;
    width: 101px;
    display: block;
    color: white;
    text-align: center;
    margin: 0 auto;
	font-size: 18px;
}




.spin_container {
    text-align: center;
    margin: 0 auto;
    display: table;
	color: rgba(255, 255, 255, 1);
}


.spin_container .noSpins{
	font-size: 36px;
}

.spin_container .total-spins{
	font-size: 36px;
}

.mainwrapper .main-wrapper .btn-spin{
	background-color: rgba(105, 171, 84, 1);
    border-radius: 50px;
    width: 141px;
    font-size: 16px;
    padding-top: 15px;
    padding-right: 30px;
    padding-bottom: 15px;
    padding-left: 30px;
    color: white;
    text-align: center;
    margin: 0 auto;
    display: block;
}


.title {
    font-size: 30px;
    /* text-align: center; */
    /* font-family: sans-serif; */
    color: white;
    margin: 0 auto;
    padding: 20px 0px;
    width: 100%;
    height: 39px;
    font-weight: 700px;
	margin-bottom: 60px;
}

.numberSpins {
    font-size: 16px;
    text-align: center;
    font-weight: 700px;
    color: rgba(255, 255, 255, 1);
	margin-top: 30px;
}

.modal-content {
    background-color: transparent;
}

.modal-body {
	position: relative;
    /* padding: 15px; */
    background: rgba(105, 171, 84, 1);
    border-radius: 10px;
    padding-top: 30px;
    padding-right: 20px;
    padding-bottom: 30px;
    padding-left: 20px;
    width: 100%;
}

.card .card-body {
	/* margin-top: 20px; */
    background-color: #E1EEDD;
    border-radius: 10px;
    /* padding: 30px 20px; */
    /* padding: 2px 50px; */
    margin-left: 18px;
    margin-right: 18px;
    border-color: white;
    border-style: solid;
    margin-top: 6px;
    margin-bottom: 6px;
}


.modal-content {
    border: none;
}
  </style>

</head>

<body ontouchstart="">
	<div class="mainwrapper">
		<div class="main-wrapper">

			<p class="title text-center">C06 TOTAL BAT PROGRAM</p>
			
			<br><!-- <div id="logo"></div> -->

			<div class="wheel-wrapper">
				<canvas class="canvas" id="mainCanvas"></canvas>
				<canvas class="canvas" id="wheelCanvas"></canvas>
			</div>

			<p style="color:white;" class="numberSpins">Number of Spins</p>
			<div class="spin_container">

				<div class="row">
					<?php 
					if ($db_spins > 0) {
					?>
					<div class="col">
						<p class="noSpins" id="spincount"></p>
					</div>
					<div class="col">
						<p class="total-spins"> /<?php echo $total_spins ?></p>
					</div>
					<?php
					}?>
				</div>
			</div>

			<input type="hidden" value="<?php echo $user_id; ?>" id="spinsid">
			<input type="hidden" value="<?php echo $db_spins; ?>" id="db_spins">

			<?php 
			if ($db_spins > 0) {
			?>
			<a class="btn-spin" onclick="luckyDraw()" id="luckyDraw">Spin Now</a>
			<!-- <a class="btn btn-settings" onclick="settings()">Settings</a> -->
			<?php
			}else {	
			?>
			<!-- for window displaying purpose-->
			<div class="spin_container">
				<div class="row">
					<div class="col">
						<p style="font-size: 36px;">0</p>
					</div>
					<div class="col">
						<p class="total-spins"> /<?php echo $total_spins ?></p>
					</div>
				</div>
			</div>

			<a class='btn-spin' href='./term.php'>Next</a> 
			<?php 
			}?>

			<div id="settingsTab">
				<div class="settings-header">
					<a class="btn btn-close" onclick="exitSettings()">Close</a>
					<h1 class="text-center">Settings</h1>
				</div>
				<div class="segment-selector">
					
				</div>
				<div class="segment-settings">
					
				</div>
				<div class="checksum-wrapper"></div>
				<a class="btn btn-save" onclick="saveSettings()">Save</a>
			</div>
		</div>

		<!-- modal -->
		<div class="modal fade" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
		    	<div class="modal-content text-center">
		    		<div class="modal-body">
		    			<div id="lose">
		    				<h1>Thank you</h1>
		    				<h4>for your participation.</h4>
		    			</div>
		    			<div id="win">
		    				<h2 class="mt-3">You've won</h2>
		    				<!-- <h2>Congratulations!<br>You have won a</h2> -->
		    				<div class="prize-detail-wrapper">

								<div class="card">
									<div class="card-body">
										<!-- <div class="row">
											<div class="col"> -->
												<div id="prizeDetail">
												
												</div>
											<!-- </div>
											<div class="col">
												<h3 style="text-align: right; width: 300px;">Cashback</h3>
											</div>
										</div> -->
									</div>
								</div>

								<div class="card-con">

								
								<div class="row">
									<div class="col">
										<p class="left-remain">Number of spins remaining:</p>
									</div>

									<div class="col">
										<?php 
											// if ($lastId > 0) {
											// 	$lastId = $lastId - 1;
											
										?>
										<p class="numberSpin">  </p>

										<?php 
										// }else {
										// 	$lastId = 0;
										
										?>
										<h4> <?php 
										// echo $lastId ?> </h4>
										<?php 
										// }
										?>
									</div>
								</div>
								</div>
							</div>
		    			</div>
		    			<!-- <div class="flare-bg-wrapper">
		    				<div class="flare-bg"></div>
		    			</div> -->
		    		</div>

					<?php if ($db_spins > 0 ) { ?>
						<!-- <div class="modal-footer text-center">
			    			<a style="background-color:#a71c20;border:#270106;border:#7d0211;" class="btn btn-back" onclick="closePrizeModal()">Back to home</a>
			    		</div> -->
			    		
						<div class="modal-footer text-center">
			    			<a style="background-color:#a71c20;border:#270106;border:#7d0211;" class="spin-btn-back" onclick="closePrizeModal()" id='nextpage'>Spin Again</a>
			    		</div>
					<?php  }else { ?>
						<div class="modal-footer text-center">

							<a style='background-color:#a71c20;border:#270106;border:#7d0211;' class='modal-btn-back' href='./term.php'>Next</a> 
							<!-- $prodID -->
			    			<!-- <a style="background-color:#a71c20;border:#270106;border:#7d0211;" class="btn btn-back" id="nextpage">Next</a> -->
			    		</div>
					<?php } ?>
			    </div>
					<!-- </div> -->
			</div>
		</div>
	</div>
	<?php 

include "footer.php";
?>
</body>
</html>



<script>
	$(document).ready(function() {
		// umberspins = function(){
			// var dataID = 7;
			var dataID = document.getElementById('spinsid').value;
			// var spinsnum = document.getElementById('spinsnum').value;
			// var spinsnums = document.getElementById('spinsnum').value;
			console.log('id',dataID);
			// console.log('spinsnums',spinsnums);
			// var mySpinCount = -1;

			var spincount = parseInt($('#spincount').html())
			console.log('spin count int',spincount);
			
			var db_spins = document.getElementById('db_spins').value;
			console.log('db_spins', db_spins);
		$.ajax({
			type: "GET",
			url: "./php/get.php",
			data: {dataID:dataID},
			// dataType: "dataType",
			success: function (response) {
				var html = '';
				var modalspin = '';

				// $(".noSpins").val(response);
				console.log('get response', response);
				// html += `<h1 style="color:white;" class="noSpins">(${response})</h1>`
				// html += ` <label for="" class="noSpins">${response}</label> `
				// if (db_spins > 0 ) {
					html += ` ${response}`
					$(".noSpins").html(html);
				// } else {
				// 	$(".noSpins").html(0);
				// }
				modalspin += ` ${response}`
				
				$(".numberSpin").html(modalspin);
				// $("#spinsnum").val(response);
				var spincount = document.getElementsByClassName('noSpins');
				console.log('spin count',spincount[0]);
				
				// console.log('spinsnum', spinsnum);
			}
		});

		if (db_spins < 0 ) {
			$(".noSpins").html(0);
		}

		// $("#luckyDraw").click(function(e) {
		// 	e.preventDefault();
			
		// 	// var spinsnums = document.getElementById('spinsnum').value;
		// 	// console.log('spinsnum when click', spinsnums);
			
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "./php/updatespin.php",
		// 		data: {dataID:dataID, spinsnum:spinsnums},
		// 		// dataType: "dataType",
		// 		success: function (response) {
		// 			console.log('spins in update', response);
		// 		}
		// 	});
		// })
	// };
	})

</script>
