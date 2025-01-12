<?php 

if( isset($_GET['s'] )){
	$dataID = $_GET['s'];
}else{
	$dataID = 1;
}

if(!isset($_COOKIE['isMatch'])) {
	$isMatch = "false";
}else{
	if ($_COOKIE['isMatch'] == "true") {
		$isMatch = "true";
	}else{
		$isMatch = "false";
	}
}
?>
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

<title>Spin &amp; Win HTML5 Game</title>

<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="libs/toastr/toastr.min.css" />
<link rel="stylesheet" href="css/setting-style.css">

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
<script id="helper" data-id="<?php echo $dataID;?>" src="js/Module_db.js"></script>
<script id="setting" data-id="<?php echo $isMatch;?>" src="js/Setting.js"></script>
<style>
	.segment-settings-wrapper-setting input[type="text"],
	.segment-settings-wrapper-setting input[type="number"] {
		display: block;
		width: 100%;
		border-radius: 8px;
		padding: 1px 1px;
	}
</style>
</head>
<body ontouchstart="">
	<div class="mainwrapper">
		<div class="main-wrapper">
			<div id="logo"></div>

			<canvas style="display:none;" class="canvas" id="mainCanvas"></canvas>
			<canvas style="display:none;" class="canvas" id="wheelCanvas"></canvas>

			<!-- <a class="btn btn-start" onclick="luckyDraw()">Spin Now</a> -->
			<!-- <a class="btn btn-settings" onclick="settings()">Settings</a> -->

			<div>
				
				<div class="dropdown text-center">
						<button class="btn btn-warning dropdown-toggle btn-save" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Team0<?php echo $dataID;?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu text-center" aria-labelledby="dropdownMenu1">
							<li><a href="https://spin2win.myecdc.com/setting.php?s=1">KVVUSE01</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=2">KVVUSE02</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=3">KVVUSE03</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=4">KVVUSE04</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=5">KVVUSE05</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=6">KVVUSE06</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=7">KVVUSE07</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=8">KVVUSE08</a></li>
							<li><a href="https://spin2win.myecdc.com/setting.php?s=9">KVVUSE09</a></li>
						</ul>
					</div>
				<div class="segment-selector">
					
				</div>
				<div class="segment-settings" style="margin-top: 50px;">
					
				</div>
				<div class="checksum-wrapper"></div>
				<div class="text-center">
					<a class="save btn-save" onclick="saveSettings()">Save</a>
				</div>
				
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
		    				<h2>Congratulations!<br>You have won a</h2>
		    				<div class="prize-detail-wrapper">
								<div id="prizeDetail">
									
								</div>
							</div>
		    			</div>
		    			<div class="flare-bg-wrapper">
		    				<div class="flare-bg"></div>
		    			</div>
		    		</div>
		    		<div class="modal-footer text-center">
		    			<a class="btn btn-back" onclick="closePrizeModal()">Back to home</a>
		    		</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>