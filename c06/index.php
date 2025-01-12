<?php 
// include ('./php/db.php');

define('LOCALHOST','192.82.60.214');
define('DB_USERNAME','myecdc_test');
define('DB_PASSWORD','hH66)QxbmI)4');
define('DB_NAME','myecdc_bat_spin');

$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME); 
if(mysqli_connect_error()) {
	die("connection failed!" .mysqli_connect_error());
}

session_start();

// if (isset($_SESSION["user_id"])) {
	// $user_id = $_SESSION["user_id"];
	
// }
// $query = "SELECT * FROM users_wheel"; //ORDER BY voucherID desc limit 1
// $result = mysqli_query($conn, $query);
// $row = mysqli_fetch_array($result);
// $total_spins = $row['total_spins'];
// $db_spins = $row['spins'];

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

<!-- <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" /> -->
<!-- <link rel="stylesheet" href="libs/toastr/toastr.min.css" /> -->
<link rel="stylesheet" href="css/style.css">

<!-- <script src="libs/TweenLite.min.js"></script>
<script src="libs/plugins/CSSPlugin.min.js"></script>
<script src="libs/EasePack.min.js"></script>
<script src="libs/Stats.js"></script>
<script src="libs/utils.js"></script>
<script src="libs/formatDate.js"></script> -->
<script src="libs/jquery-2.2.0.min.js"></script>
<!-- <script src="libs/bootstrap/js/bootstrap.min.js"></script> -->
<!-- <script src="libs/toastr/toastr.min.js"></script>
<script src="libs/inobounce.js"></script> -->


<!-- <script src="js/MainGame.js"></script>
<script id="helper" data-id="1" src="js/Module_db.js"></script>
<script src="js/Main.js"></script> -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 
<!-- selection search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
	/* body{
		background: url("../assets/background.jpg") center top no-repeat;
	} */
	::placeholder {
		color: white;
		/* padding-left: 10px; */
	}

	.form-select {
		display: block;
		margin: 0 auto;
		width: 100%;
		height: 50px;
		font-size: 16px;
		border-radius: 6px;
		/* text-align: center; */
		margin-bottom: 20px;
		background-color: transparent;
    	color: white;
		background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
	}
	
	/* for window user */
	select option {
		background-color: rgba(0, 14, 42, 1);
	}

	.form-input{
		display: block;
		margin: 0 auto;
		width: 100%;
		height: 50px;
		font-size: 16px;
		border-radius: 6px;
		/* text-align: center; */
		margin-bottom: 20px;
		background-color: transparent;
		color: white;
		border: 1px solid #ced4da;
		padding-left: 10px;
	}
	
	.select2-container {
		/* box-sizing: border-box;
		display: inline-block;
		margin: 0;
		position: relative;
		vertical-align: middle; */
		margin-bottom: 20px;
		/* height: 50px; */
		/* font-size: 16px; */
		/* border-radius: 6px; */
	}

	.select2-container--default .select2-selection--single {
		background-color: transparent;
		border-radius: 6px;
		border: 1px solid #ced4da;
		/* color: white; */
	}

	.select2-container .select2-selection--single {
		height: 50px;
		/* font-size: 16px; */
		padding-top: 10px;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: white;
	}

	.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
		width: 100%;
	}

	.btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
		color: #ffff;
		/* background-color: #e6e6e6; */
		border-color: #adadad;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 50px;
		right: 10px;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow b {
		position: absolute;
		top: 37%;
		border: solid white;
		border-width: 0 1.5px 1.5px 0;
		display: inline-block;
		padding: 3px;
		transform: rotate(45deg);
		-webkit-transform: rotate(45deg);
		right: 80%;
	}

	.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
		border-color: transparent transparent white transparent;
		position: absolute;
		top: 45%;
		border: solid white;
		border-width: 1.5px 0 0 1.5px;
		display: inline-block;
		padding: 3px;
		transform: rotate(45deg);
		-webkit-transform: rotate(45deg);
		right: 80%;
	}


	.select2-dropdown {
		background-color: rgba(0, 14, 42, 1) !important;
		color: white !important;
		/* opacity: 90%; */
	}


	.form-control {
		display: block;
		margin: 0 auto;
		width: 200px;
		height: 50px;
		font-size: 20px;
		border-radius: 35px;
		text-align: center;
	}

	.mt-3 {
	margin-top: 0.5rem !important;
	}

	.mt-5 {
		margin-top: 3rem !important;
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

	/* .row-cols-6 > * {
	flex: 0 0 auto;
	width: 16.6666666667%;
	} */

	.startpage .group a.button {
		background-color: #69AB54;
		/* border: none; */
		color: white;
		/* padding: 15px 32px; */
		text-align: center;
		text-decoration: none;
		display: block;
		/* font-size: 16px; */
		margin: 0 auto;
		/* cursor: pointer; */
		border-radius: 50px;
		margin-top: 30px;
		/* height: 43px; */
		width: 331px;
		padding-top: 15px;
		padding-right: 30px;
		padding-bottom: 15px;
		padding-left: 30px;
	}

	.startpage .group .button {
		background-color: #69AB54;
		/* border: none; */
		color: white;
		/* padding: 15px 32px; */
		text-align: center;
		text-decoration: none;
		display: block;
		/* font-size: 16px; */
		margin: 0 auto;
		/* cursor: pointer; */
		border-radius: 50px;
		margin-top: 30px;
		/* height: 43px; */
		width: 331px;
		padding-top: 15px;
		padding-right: 30px;
		padding-bottom: 15px;
		padding-left: 30px;
		border: 1px solid transparent;
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

	.startpage {
		background: rgba(0, 14, 42, 0.5);
		/* opacity: 50%; */
		border-radius: 30px;
		/* margin-left: 21px; */
		width: 388px;
		/* height: 389px; */
		/* margin-top: 215px; */
		padding: 40px 30px;
	}

	.group{
		/* margin-left: 50px; */
		width: 331px;
		/* height: 244px; */
		/* margin-top: 50%; */
		
	}
</style>

</head>

<body>
	<div class="mainwrapper">
		<div class="main-wrapper">
		<!-- <h1 style="color:white;">C05 TOTAL BAT PROGRAM</h1> -->
		<p class="title text-center">C06 Total BAT Program</p>

		<div class="startpage container-fluid">
			<!-- <form id="myForm" action="" onsubmit="return checkInputAndRedirect()"> -->
				<div class="group">
			
					<select class="form-select" aria-label="Default select example" name="region" onchange="aselist()" id="region" required>
						<option disabled selected hidden>REGION</option>
						
						<?php $get_region = $conn->query("SELECT DISTINCT region FROM users_wheel"); 
						while($region_row = $get_region->fetch_assoc()): ?>
						<option value="<?php echo $region_row['region']; ?>"><?php echo $region_row['region']; ?></option>
						<?php endwhile; ?>
					</select>

					
					<select class="select2 form-select " aria-label="ASE ID" onchange="outletlist()" id="ase" required>
						<option disabled selected hidden>ASE ID</option>
					</select>
				
					<select class="select2 form-select" aria-label="OUTLET NAME" onchange="updateName()" id="outlet_name" aria-required="true" required>
						<option disabled selected hidden>OUTLET NAME</option>
						<!-- <option >Burger, Shake and a Smile</option> -->
					</select>
					
					<input type="text" class="form-input" placeholder="OUTLET ID" id="outlet_id" value="" readonly required>
					<!-- <input type="text" class="form-input" placeholder="OUTLET NAME" id="outlet_name" value="" readonly required> -->
					
					<!-- <select class="form-select" aria-label="OUTLET ID" id="outlet_id" required>
						<option disabled selected hidden>OUTLET ID</option>
					</select> -->

					<!-- <a href="#" id="startbtn" class="button">Start</a> -->
					<button id="startbtn" type="submit" class="button" onclick="return checkInputAndRedirect()">Start</button>
					<!-- <input class="btn btn-success w-100 mt-2" id="btnReset" type="button" onclick="return checkInputAndRedirect()">start -->

				</div>
			<!-- </form> -->
		</div>
		</div>
	</div>
</body>
</html>

<?php 

include "footer.php";
?>

<script>
	
	function checkInputAndRedirect() {
		var region = document.getElementById('region').value;
		// console.log('region', region);
		var ase = document.getElementById('ase').value;
		// console.log('ase', ase);
		var outlet_id = document.getElementById('outlet_id').value;
		// console.log('outlet_id', outlet_id);
		var outlet_name = document.getElementById('outlet_name').value;

		if (region === "" || ase === "" || outlet_id === "" || outlet_name === "") {
			alert("Please fill in all the fields.");
			return false;
		} else {
			// alert("detected.");
			$.ajax({
				type: "GET",
				url: "./php/identified.php",
				// url: "./php/identified.php?region=" + region + "?ase=" + ase + "?outlet_id=" + outlet_id + "?outlet_name=" + outlet_name,
				data: "&region=" + region + "&ase=" + ase + "&outlet_id=" + outlet_id + "&outlet_name=" + outlet_name,
				// dataType: "dataType",
				success: function (response) {
					// console.log('batch',response);
					window.location.href = "./start_wheel_"+response+".php";
				}
			});

		}
		return false;
	}

	function updateName() {
		var selectedName = document.getElementById('outlet_name').value;
		var ase = document.getElementById('ase').value;
		// console.log(selectedName);
		// console.log('ase', ase);
		$.ajax({
			type: "GET",
			// url: "./php/get_names.php?name=" + encodeURIComponent(selectedName),
			url: "./php/get_names.php?name=" + encodeURIComponent(selectedName) + "&ase=" + ase,
			// data: "&name=" + encodeURIComponent(selectedName) + "&ase=" + ase,
			// data: {name:encodeURIComponent(selectedName), ase:ase},
			// dataType: "dataType",
			success: function (response) {
				$("#outlet_id").val(response);
				// document.getElementById('outlet_name').value = response;
				// console.log(response);
			}
		});
		
		// outlet id change to optional
		// var xhttp = new XMLHttpRequest();
		// xhttp.onreadystatechange = function() {
		// 	if (this.readyState == 4 && this.status == 200) {
		// 		document.getElementById('outlet_id').innerHTML = this.responseText;
		// 		// document.getElementById('outlet_id').innerHTML = this.responseText;
		// 	}
		// };
		// xhttp.open("GET", "./php/get_names.php?name=" + encodeURIComponent(selectedName) + "&ase=" + ase, true);
		// xhttp.send();


	}

	function aselist() { 
		var region = document.getElementById('region').value;
		// console.log(region);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('ase').innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "./php/get_list.php?region=" + region, true);
		xhttp.send();
	}

	function outletlist() {
		var ase = document.getElementById('ase').value;
		// console.log(ase);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('outlet_name').innerHTML = this.responseText;
				// document.getElementById('outlet_id').innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "./php/get_outlet.php?ase=" + ase, true);
		xhttp.send();
	}

	$('#outlet_name').select2();
	
	$('#ase').select2({
		dropdownParent: $('.mainwrapper')
	});

</script>