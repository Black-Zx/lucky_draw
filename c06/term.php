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
// $user_id = $_COOKIE['user_id'];

$query = "SELECT * FROM users_wheel WHERE id= '$user_id' "; //ORDER BY voucherID desc limit 1
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$total_spins = $row['total_spins'];
$db_spins = $row['spins'];
$region =  $row['region'];
$ASE_id =  $row['ASE_id'];
$outlet_id =  $row['outlet_id'];
$outlet_name =  $row['outlet_name'];
// echo $db_spins ;


// echo $lastId ;
// if($lastId == "") {
//     $voucherID = "V1001";
// } else {
//     $voucherID = substr($lastId, 1);
//     $voucherID = intval($voucherID);
//     $voucherID = "V".($voucherID + 1);
// }
?>

<!DOCTYPE html>
<html lang="en" manifest="cache.manifest">
<!-- <html lang="en"> -->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

	<!-- iOS related -->
	<!-- <link rel="apple-touch-icon" sizes="180x180" href="http://14.102.150.59/~kent/html5Games/spin2win/app-logo.png"> -->
	<!-- <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="apple-mobile-web-app-title" content="Spin & Win">
	<meta name="apple-mobile-web-app-capable" content="yes"> -->
	<!-- end iOS related -->

	<title>C06 Total BAT Program</title>

	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="libs/toastr/toastr.min.css" />
	<link rel="stylesheet" href="css/style.css">

	<!-- <script src="libs/TweenLite.min.js"></script>
	<script src="libs/plugins/CSSPlugin.min.js"></script> -->
	<script src="libs/EasePack.min.js"></script>
	<!-- <script src="libs/Stats.js"></script> -->
	<!-- use in Draggable -->
	<!-- <script src="libs/utils.js"></script> -->
	<!-- <script src="libs/formatDate.js"></script> -->
	
	<script src="libs/jquery-2.2.0.min.js"></script>
	<script src="libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="libs/toastr/toastr.min.js"></script>
	<!-- <script src="libs/inobounce.js"></script> -->
	<!-- <script src="libs/Draggable-latest-beta.js"></script> -->
	
	<style>
		.custom-select {
			display: block;
			margin: 0 auto;
			width: 300px;
			height: 50px;
			font-size: 20px;
			border-radius: 35px;
			text-align: center;
		}

		.form-control {
			width: 100%;
			height: 50px;
			font-size: 20px;
			border-radius: 10px;
			margin-top: 10px;
			background-color: transparent;
			color: white;
		}

		.row {
			--bs-gutter-x: 1.5rem;
			--bs-gutter-y: 0;
			display: flex;
			flex-wrap: wrap;
			margin-top: calc(-1 * var(--bs-gutter-y));
			margin-right: calc(-0.5 * var(--bs-gutter-x));
			margin-left: calc(-0.5 * var(--bs-gutter-x));
		}

		.col-6 {
	flex: 0 0 auto;
	width: 50%;
	}

	.col-auto {
	flex: 0 0 auto;
	width: auto;
	}


	.container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
		width: 100%;
		/* padding-left: 1rem; */
		/* padding-right: 1rem; */
		/* margin-left: auto; */
		/* margin-right: auto; */
		border-radius: 30px;
		padding: 30px;
		background: rgba(0, 14, 42, 0.5);
		margin-bottom: 15px;
	}
	h3{
		text-align: center;
	}

	label{
		color: white;
		font-size: 20px;
	}

	.userleft{
		text-align: left;
		width: 300px;
		/* padding: 10px;
		margin-left: 30px; */
	}

	.user-row{
		margin-bottom: 11px;
	}

	.userdetails {
		/* float: right; */
		text-align: right;
		width: 423px;
		/* padding: 10px; */
		/* margin-left: 80px; */
	}

	.details{
		/* float: right; */
		text-align: right;
	width: 300px;
	padding: 10px;
	}

	.leftInfo{
		text-align: left;
		width: 300px;
	padding: 10px;
	}



	.card .card {
	box-shadow: none !important;
	}

	.card .card-body{
		background-color: rgba(225, 238, 221, 1);
		border-radius: 10px;
		padding-top: 6px;
		padding-right: 19px;
		padding-bottom: 6px;
		padding-left: 19px;
		border-style: solid;
		border-color: white;
		margin-bottom: 10px;
	}

	.received-value{
		text-align: center;
		font-size: 26px;
		color: rgba(105, 171, 84, 1);
	}

	.received-num{
		font-size: 26px;
		margin: 0;
	}

	.amount{
		margin-top: 20px;
		font-size: 16px;
	}

	.price{
		font-size: 26px;
	}
	.card .card-container{
		margin-top:20px;
		background-color: bisque;
		border-radius: 20px;
		/* padding:30px 20px; */
		padding: 2px 50px;
		margin-left: 30px;
		margin-right: 30px;
	}

	.card .card-tnc{
		color: rgba(255, 255, 255, 1);
		font-size: 12px;
	}

	.sign-container{
		width: 100%;
		border-radius: 30px;
		padding: 30px;
		/* background: rgba(0, 14, 42, 0.5); */
		margin-bottom: 15px;
		margin-top: 35px;
	}

	/* .pad-top10{
		padding-top: 10px;
	} */

	.form-check {
	position: relative;
	display: block;
	padding-left: 1.25rem; }

	.text-left {
	text-align: left !important; }


	.form-check-input {
	/* position: absolute; */
	margin-top: 0.3rem;
	margin-left: -1.25rem; }

	.form-check-input[disabled] ~ .form-check-label,
	.form-check-input:disabled ~ .form-check-label {
	color: #b9b9c3; }

	.form-check-label {
	margin-bottom: 0; 
	margin-left: 10px;
	}

	.form-check-inline {
	display: inline-flex;
	align-items: center;
	padding-left: 0;
	margin-right: 0.75rem; }

	.form-check-inline .form-check-input {
	position: static;
	margin-top: 0;
	margin-right: 0.3125rem;
	margin-left: 0; }

	.form-check-input{
		background-color: #006b35;
		color:#ffffff;
	}

	.form-check-input:checked{
		background-color: #006b35;
		border-color: #006b35;
	}  

	.termsncondition{
		font-family: "Montserrat", sans-serif;
		font-size:14px;
		/* font-style:italic; */
		font-weight: 500;
		line-height: 20px;
	}

	.main-wrapper .button {
		background-color: rgba(105, 171, 84, 1);
		color: white;
		text-align: center;
		text-decoration: none;
		display: table;
		font-size: 16px;
		margin: 0 auto;
		/* cursor: pointer; */
		border-radius: 50px;
		margin-top: 40px;
		padding-top: 15px;
		padding-right: 30px;
		padding-bottom: 15px;
		padding-left: 30px;
		width: 123px;
		font-size: 18px;
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
		margin-bottom: 40px;
	}

	.con-title{
		font-size: 20px;
		color: rgba(255, 255, 255, 1);
		text-align: center;
		margin-bottom: 20px;
	}


	.user-row .col {
		width: 50%;
	}
	label.userleft,
	label.userdetails {
		width: 100%;
	}
	.form-check {
		padding-left: 30px;
		margin-bottom: 20px;
	}
	.form-check input[type=checkbox] {
		float: left;
		margin-left: -22px;
	}
	.button.clear-btn {
		width: auto;
		margin-top: 10px;
	}

	.submit-modal{
		background: transparent;
		color: white;
		border: none;
	}

	.modal-body{
		background: rgba(105, 171, 84, 1);
	}
	.back-home-btn {
		/* background-color: #5f40a3; */
		background: rgba(105, 171, 84, 1) !important;
		padding-top: 15px;
		padding-right: 30px;
		padding-bottom: 15px;
		padding-left: 30px;
		border-radius: 3px;
		width: 152px;
		display: ruby;
		color: white;
		text-align: center;
		margin: 0 auto;
		font-size: 18px;
		border: 1px solid #fff;
	}
	</style>

</head>

<body>
	<div class="mainwrapper">
		<div class="main-wrapper">

			<p class="title text-center">C06 TOTAL BAT PROGRAM</p>

			
			<br><!-- <div id="logo"></div> -->

			<div class="container-fluid">
				<p class="con-title">User Details</p>
				<!-- <div class="card">
					<div class="card-container"> -->
				<!-- <div class="user-group"> -->
					<div class="row user-row">
						<div class="col">
							<label for="" class="userleft">REGION</label>
						</div>
						<div class="col">
							<label for="" class="userdetails"><?php echo $region; ?></label> 
						</div>
					</div>
					<div class="row user-row">
						<div class="col">
							<label for="" class="userleft">ASE ID</label>
						</div>
						<div class="col">
							<label for="" class="userdetails"><?php echo $ASE_id; ?></label> 
						</div>
					</div>
					<div class="row user-row">
						<div class="col">
							<label for="" class="userleft">CUSTOMER CODE</label>
						</div>
						<div class="col">
							<label for="" class="userdetails"><?php echo $outlet_id; ?></label> 
						</div>
					</div>
					<div class="row user-row">
						<div class="col">
							<label for="" class="userleft">OUTLET</label>
						</div>
						<div class="col">
							<label for="" class="userdetails"><?php echo $outlet_name; ?></label> 
						</div>
					</div>
				<!-- </div> -->

				
				<!-- </div>
				</div> -->
			</div>

			<div class="container-fluid">
				<!-- <h3 style="color:white;">Prizes Received</h3> -->
				<p class="con-title">Draw Value Received</p>

				<div class="card">
						<?php 
						$checking = "SELECT total_spins FROM users_wheel WHERE id= '$user_id' ";
						$CheckResult = mysqli_query($conn, $checking);
						$checkRow = mysqli_fetch_array($CheckResult);
						$check_spins = $checkRow['total_spins'];

						$game = "SELECT prizes_id FROM games WHERE user_id= '$user_id' ORDER BY id ASC LIMIT $check_spins";
						$gameResult = mysqli_query($conn, $game);
						while($gameRow = mysqli_fetch_array($gameResult)){
							$prizes_id = $gameRow['prizes_id'];

							$prizetbl = "SELECT name FROM prizes1 WHERE id= '$prizes_id' ";
							$pzResult = mysqli_query($conn, $prizetbl);
							$pzRow = mysqli_fetch_array($pzResult);

							// $prize = $gameRow['id'];
							// echo $prize.'\n' ;
						
						?>
					<div class="card-body">
						<div class="received-value text-uppercase">

							<p class="received-num"><?php echo $pzRow['name']; ?></p>
						</div>
					</div>
					<?php 
						}
						?>
				</div>
				<?php 
						$game = "SELECT prizes_id FROM games WHERE user_id= '$user_id' ORDER BY id ASC LIMIT $check_spins";
						$gameResult = mysqli_query($conn, $game);
						$calculation = 0;

						while($gameRow = mysqli_fetch_array($gameResult)){
							$prizes_id = $gameRow['prizes_id'];

							$prizetbl = "SELECT name FROM prizes1 WHERE id= '$prizes_id' ";
							$pzResult = mysqli_query($conn, $prizetbl);
							$pzRow = mysqli_fetch_array($pzResult);
							// echo $pzRow['name'];
							/*
							if ($pzRow['name'] == 'RM 8') {
								$num = 8;
							};
							*/
							$num = intval(substr($pzRow['name'], 3));
							// echo $num ;
							$calculation += $num;
							// $prize = $gameRow['id'];
							// echo $prize.'\n' ;
						
						?>
						<?php 
						}
						?>
				<h4 style="color:white;" class="amount text-center">Total Amount</h4>
				<h4 style="color:white;" class="price text-center">RM <?php echo $calculation; ?></h4>
				
			</div>

			<div class="container-fluid">
				<!-- <h3 style="color:white;">Terms & Conditions</h3> -->
				<p class="con-title" style="margin-bottom: 10px;">Terms & Conditions</p>

				<!-- <div class="row">
					<div class="col">
						<div id="prizeDetail">
						
						</div>
					</div>
					<div class="col">
					<label for="" class="details">Cashback</label>
					</div>
				</div> -->
				<div class="card">
					<div class="card-tnc">
						<p>1. This Acknowledgement Form confirms the prizes you have received during the Spin-the-Wheel game.</p>
						<!-- <p>2. Based on the details provided, the cashback amount will be credited to you during your next visit to the shop.</p> -->
						<!-- <p>3. This cashback is non-transferable and must be redeemed by the individual who participated in the game.</p> -->
						<p>2. Please ensure all details are accurate to facilitate the smooth processing of your cashback.</p>
						<p>3. British-American Tobacco (BAT) reserves the right to modify or terminate the promotion at any time without prior notice.</p>
					</div>
				</div>
			</div>

			<form id="myForm" action="">

				<div class="container-fluid">
					<!-- <h3 style="color:white;">Contact Details</h3> -->
					<p class="con-title">Contact Details</p>
					
					<div class="card">
						<div class="card-tnc">
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required> 
							<input type="text" class="form-control" id="contact" name="contact" placeholder="Contact No." required> 
						</div>
					</div>
				</div>
			

				<div class="sign-container">
					<!-- <h3 style="color:white;">Contact Details</h3> -->
					<p class="con-title">Signature</p>
					<div id="canvasDiv"></div>
					<a class="button clear-btn">Clear Signature</a>
				</div>

				<div class="form-check text-left mt-5">
					<input class="form-check-input" type="checkbox" value="1" id="tnc" name=tnc required>
					<label class="form-check-label" for="tnc">
						<span class="termsncondition text-uppercase">By signing this form, you acknowledge that the information provided is correct and 
							agree to the abovementioned terms and conditions.</span>
					</label>
				</div>

				<div class="form-check text-left">
					<input class="form-check-input" type="checkbox" value="1" id="tnc2" name="tnc2" required>
					<label class="form-check-label" for="tnc2">
						<span class="termsncondition text-uppercase">We have read and understood the abovementioned terms and conditions.</span>
					</label>
				</div>
				<!-- <form class="col-md-12 row g-2" action="" id="formVoucher"> -->

				<input type="hidden" value="<?php echo $user_id; ?>" id="user_id">

				<div id="success_info"></div>
				<a style="margin-bottom: 100px;" class="button mt-5" id="submit_contact">Submit</a>
			</form>
		</div>

		<!-- success modal -->
		<div class="modal fade" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
		    	<div class="submit-modal modal-content text-center">
		    		<div class="modal-body">
						<h2 class="mt-3">Thank you!</h2>
						<h3>Your details have been submitted.</h3>
		    		</div>
					<div class="modal-footer text-center">
						<a class="back-home-btn" href="./index.php">OK</a>
					</div>
		    	</div>
			</div>
		</div>

	</div>

</body>
</html>

<?php 

include "footer.php";
?>

<script>
$(document).ready(function() {
	var clickOnce = true;
	var formData;
	var target_Width = 600;
	var target_Height = 300;
	var tempWidth = $('#canvasDiv').width();
	var tempHeight = tempWidth*target_Height/target_Width;
	var isPaint = false;
	var mode = 'brush';
	var lastLine;
	var lineList = [];
	var isSigned = false;

    $("#contact").on('input', function (e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

	// Create the stage and a layer to draw on.
    stage = new Konva.Stage({
        container: 'canvasDiv', // 'canvas-container',
        width: tempWidth,
        height: tempHeight
    });
    // console.log('stage');
    // console.log(stage);

    layer = new Konva.Layer();
    stage.add(layer);
    stage.draw();

    // mouse circle
    mouseWhiteCircle = new Konva.Circle({
        stroke: '#c0c0c0',
        strokeWidth: 1, //0.5,
        radius: 2.5,
        position: {x: -100, y: -100}
    });
    layer.add(mouseWhiteCircle);

    // white background
    whiteBG = new Konva.Rect({
        x: 0,
        y: 0,
        width: tempWidth,
        height: tempHeight,
        fill: 'white'
    });
    // add the shape to the layer
    layer.add(whiteBG);

    whiteBG.moveToBottom();
    mouseWhiteCircle.moveToTop();
    layer.batchDraw();

    stage.on('mousemove touchmove', (e) => {
        stageMouseMove(e, stage);
    });

    stage.on('mouseleave touchend', (e) => {
        // reset circle position
        mouseWhiteCircle.absolutePosition({x: -100, y: -100});

        layer.draw();
    });

    const stageMouseMove = (e, newStage) => {
        // console.log(e);
        // console.log(newStage);
        // console.log(newStage.getPointerPosition());

        mouseWhiteCircle.absolutePosition(newStage.getPointerPosition());

        layer.draw();
    };

    // drawing canvas
    canvas = document.createElement('canvas');
    drawingCanvas = new Konva.Image({
        image: canvas,
        draggable: false,
    });
    layer.add(drawingCanvas);
    drawingCanvas.moveToTop();
    layer.batchDraw();
    // console.log(drawingCanvas);

    stage.on('mousedown touchstart', function (e) {
        isPaint = true;
        var pos = stage.getPointerPosition();

        var thisLine = new Konva.Line({
            stroke: '#0e2b63',
            strokeWidth: 4,
            globalCompositeOperation: mode === 'brush' ? 'source-over' : 'destination-out',
            // round cap for smoother lines
            lineCap: 'round',
            lineJoin: 'round',
            // add point twice, so we have some drawings even on a simple click
            points: [pos.x, pos.y, pos.x, pos.y],
        });
        layer.add(thisLine);

        lineList.push(thisLine);
        lastLine = thisLine;
    });

    stage.on('mouseup touchend', function () {
        isPaint = false;
    });

    // and core function - drawing
    stage.on('mousemove touchmove', function (e) {
        if (!isPaint) {
            return;
        }

        // prevent scrolling on touch devices
        e.evt.preventDefault();

        isSigned = true;

        const pos = stage.getPointerPosition();
        var newPoints = lastLine.points().concat([pos.x, pos.y]);
        lastLine.points(newPoints);
    });

    $('.clear-btn').click(function(e){
    	for(var i=0; i<lineList.length; i++){
    		lineList[i].destroy();
    	};
    	layer.batchDraw();
    	lineList.length = 0;
    	isSigned = false;
    });

    clickOnce = true;
	
		
	
    var submitForm = function() {
		if (clickOnce) {
			clickOnce = false;
			valid = true;

			// console.log("submit form!");
			var formData = getFormData($('#myForm'));
			var user_id = document.getElementById('user_id').value;
			var dataURL = stage.toDataURL();
			formData['image'] = dataURL;
			formData.user_id = user_id;
			// console.log('temp hardcode user_id as 1');
			// console.log(formData);

			if(formData.name.trim() == ''){
				clickOnce = true;
				toastr.warning('Please fill in your name', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			};

			var mobileReg = /^(\01[0-9]{1})?[0-9]{10,11}$/;
			if(formData.contact == '') {
				clickOnce = true;
				toastr.warning('Please fill in your contact number', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			} else if(isNaN(formData.contact)) {
				clickOnce = true;
				toastr.warning('Please check your contact number format', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			} else if(!mobileReg.test(formData.contact)) {
				clickOnce = true;
				toastr.warning('Please check your contact number format', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			};

			if(!isSigned){
				// user did not sign
				clickOnce = true;

				toastr.warning('Digital signature is required', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			};

			if (!formData.tnc) {
				// must agree to tnc !!! 
				clickOnce = true;

				toastr.warning('You must agree to all the T&Cs to proceed', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			};

			if (!formData.tnc2) {
				// must agree to tnc !!! 
				clickOnce = true;

				toastr.warning('You must agree to all the T&Cs to proceed', '', {
					positionClass: "toast-bottom-center"
				});

				return;
			};

			if (valid) {
				formData.insertContact = true;

				$.ajax({
					url: "./term-details.php",
					data: formData,
					type: 'POST',
					success: function(response) {
						clickOnce = true;

						// var result = JSON.parse(response);
						// console.log('submit callback!');
						// console.log(response);

						if(response == "correct") {
							// clickOnce = true;
							// $("#success_info").html('<div class="alert alert-success"><strong>Success</strong> Details has been inserted.</div>');
							// document.getElementById('formVoucher').reset();
							
							// toastr.success('Thank You! Your details have been submitted.', '', {
							//     positionClass: "toast-bottom-center"
							// });

							$('.modal').modal({backdrop: 'static', keyboard: false});
							// $('.modal').one('hidden.bs.modal', modalHideCallback); // only called once
						} else if(response == "empty") {
							// clickOnce = true;
							// $("#success_info").html('<div class="alert alert-danger"><strong>Error</strong> Please fill in all fields.</div>');
							toastr.warning('Please fill in all fields.', '', {
								positionClass: "toast-bottom-center"
							});
						} else {
							// clickOnce = true;
							// $("#success_info").html('<div class="alert alert-danger"><strong>Error</strong> processing request. Please try again.</div>');
							toastr.warning('processing request. Please try again.', '', {
								positionClass: "toast-bottom-center"
							});
						}
					},
					error: function(err) {
						console.log('error');
						console.log(err);

						clickOnce = true;
					}
				});
			};
		}
    };

    $("#myForm").submit(function(e) {
        e.preventDefault();
        submitForm();
    });
    $('#submit_contact').click(function(e){
        e.preventDefault();
        submitForm();
    });

    /*
    $('#submit_contact').click(function() {
		name = $('#name').val();
		contact = $('#contact').val();

		$.ajax({
			type: "POST",
			url: "./term-details.php",
			enctype: 'multipart/form-data',
			data: "insertContact" + "&name=" + name + "&contact=" + contact, 
			success: function(response) {
				if(response == "correct") {
					$("#success_info").html('<div class="alert alert-success"><strong>Success</strong> Details has been inserted.</div>');
					// document.getElementById('formVoucher').reset();
				} else if(response == "empty") {
					$("#success_info").html('<div class="alert alert-danger"><strong>Error</strong> Please fill in all fields.</div>');
				} else {
					$("#success_info").html('<div class="alert alert-danger"><strong>Error</strong> processing request. Please try again.</div>');
				}
			}
		});
	});
    */

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
});
</script>
<script src="./js/konva/konva.min.js"></script>
