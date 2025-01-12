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
<link rel="stylesheet" href="css/style.css">

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
</head>
<body ontouchstart="">
	<div class="mainwrapper">
		<div class="main-wrapper">
			<div id="logo"></div>

			<canvas class="canvas" id="mainCanvas"></canvas>
			<canvas class="canvas" id="wheelCanvas"></canvas>
			<h1 style="color:white;">KVVUSE01</h1>

			<a style="background-color:#5f40a3;" class="btn btn-start" onclick="luckyDraw()">Spin Now</a>
			<!-- <a class="btn btn-settings" onclick="settings()">Settings</a> -->

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