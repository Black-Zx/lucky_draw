window.onload = initWheel;
var stats;
var isMatch = document.getElementById("setting").getAttribute("data-id");

$(window).on('load', function() {
    $('#myModal').modal('show');

	if (isMatch == "false") {
		var secret = prompt("Enter in the password");

		$.ajax({
			type: "POST", //we are using POST method to submit the data to the server side
			url: './php/secret.php', // get the route value
			data: {myData: secret}, // our serialized array data for server side
			success: function (response) {//once the request successfully process to the server side it will return result here
				response = JSON.parse(response);
				if (response == "false") {
					window.location.href = "https://spin2win.myecdc.com";
				}
			}
		});
	}
	
});



function initWheel(){
	console.log('init wheel');
	mainCanvas = document.getElementById("mainCanvas");
	mainCanvas.width = gameWidth;
	mainCanvas.height = gameHeight;
	mainContext = mainCanvas.getContext("2d");
	// wheel canvas
	wheelCanvas = document.getElementById('wheelCanvas');
	wheelCanvas.width = (wheelRadius+5)*2;
	wheelCanvas.height = (wheelRadius+5)*2;
	wheelContext = wheelCanvas.getContext("2d");
	wheelCanvas.style.marginLeft = -wheelCanvas.width*0.5+"px";
	wheelCanvas.style.marginTop = -wheelCanvas.height*0.5+wheelOffsetY+"px";
	initWheelCanvasEvent();
	// wheel pin
	wheelPin = new Image();
	wheelPin.src = "./assets/wheel-pin.png";
	// wheel center
	wheelCenter = new Image();
	wheelCenter.src = "./assets/wheel-center.png";
	// wheel frame
	wheelFrame = new Image();
	wheelFrame.src = "./assets/wheel-frame.png";
	wheelFrame.onload = function() {
        // console.log('frame loaded');
        // window.alert('frame loaded');

        // retrieve list from DB
        // getPrizes();
        renderWheelFrame();
    };

    // for database callback
    mainCanvas.addEventListener('get prizes complete', function(e){
		// console.log('get prizes complete.');
		// console.log(e);
		prizesListReady();

		// init settings page
		initSettings();
	}, false);
	mainCanvas.addEventListener('update prizes complete', function(e){
		// console.log('update prizes complete.');
		toastr.success('Settings saved!', '', {positionClass: "toast-bottom-center"});

		getPrizes();
	}, false);

    // init database
    // init WebSQL DB
	// initDB();
	// retrieve list from DB
    getPrizes();
	// DBCallbackEvents();

	// show fps stats
    if(debug) {
    	stats = new Stats();
	    stats.domElement.style.position = 'absolute';
	    stats.domElement.style.left = '0px';
	    stats.domElement.style.bottom = '0px';
	    document.body.appendChild( stats.domElement );
    };

	then = Date.now();
	render();

	// debug
	// luckyDraw();
	// displayPrizeModal(2);
	// settings();
};

function prizesListReady(){
	// console.log('raw wheel data: ');
	// console.log(rawWheelData);

	// pump in or use dummy wheel data
	if(rawWheelData.length > 0){
		// pump in actual wheel data
		// construct wheelData
		var tempWheelData = [];
		var prevMax = 0;
		
		// update new segment count
		wheelSegment = rawWheelData.length; //tempSegment;

		// update pin
		segmentAngle = 360/wheelSegment;

		// reset for re-calculation
		wheelRange = 0;

		// wheel color pallete
		var color = constructWheelColor();

		for(var i=0; i<wheelSegment; i++){
			var startAngle = 2*Math.PI/wheelSegment*i;
			var angle = 2*Math.PI/wheelSegment*(i+1);
			var thisIndex = (i+1 < 10) ? '0'+(i+1) : i+1;
			var thisName = rawWheelData[i].name;
			var thisQuantity = rawWheelData[i].quantity;
			var thisGameOver = (rawWheelData[i].is_gameover == 1) ? true : false;
			var thisMin = rawWheelData[i].rate_min;
			var thisMax = rawWheelData[i].rate_max;

			// update prevMax
			prevMax = thisMax + 1;

			wheelRange += (thisMax - thisMin) + 1;
			tempWheelData.push({id:i, data: thisName, isLose: thisGameOver, startAngle:startAngle, angle: angle, color: color[i], prizeRate: {min: thisMin, max: thisMax}, quantity: thisQuantity});
		};

		// populate new wheelData
		// console.log(tempWheelData);
		wheelData = tempWheelData;
	} else {
		console.log('Wheel data from DB is empty, use dummy wheel data instead.');

		// dummy wheel data
		var color = ['#1d1d1d', '#000000'];
		var averageRate = Math.floor(100/wheelSegment);
		var offset = 100 - averageRate*wheelSegment;
		for(var i=0; i<wheelSegment; i++){
			var startAngle = 2*Math.PI/wheelSegment*i;
			var angle = 2*Math.PI/wheelSegment*(i+1);
			var thisMin = averageRate*i;
			var thisMax = averageRate*(i+1) - 1;

			wheelRange += (thisMax - thisMin) + 1;
			wheelData.push({id:i, data: 'wheel Data #'+i, isLose: false, startAngle:startAngle, angle: angle, color: color[i%2], prizeRate: {min: thisMin, max: thisMax}, quantity: 0});
		}
		// offset, if any
		wheelData[wheelData.length-1].prizeRate.max += offset;

		// debug
		wheelData[0].isLose = true;
		wheelData[0].quantity = 1;
	};

	console.log(wheelData);

	renderWheel();
    renderWheelFrame();
}

function renderWheel() {
	// clear canvas
	wheelContext.clearRect(0, 0, wheelCanvas.width, wheelCanvas.height);

	// index 0 on wheel pin
	wheelContext.save();
	wheelContext.translate(wheelCanvas.width*0.5, wheelCanvas.height*0.5);
	wheelContext.rotate(-(90+segmentAngle*0.5)*Math.PI/180);
	wheelContext.translate(-wheelCanvas.width*0.5, -wheelCanvas.height*0.5);
	// wheelCanvas
	for(var i=0; i<wheelData.length; i++){
		drawPieSlice(wheelContext, wheelCanvas.width*0.5, wheelCanvas.height*0.5, wheelRadius, wheelData[i].startAngle, wheelData[i].angle, wheelData[i].color, wheelData[i].data);
	};
	wheelContext.restore();
}

function renderWheelFrame(){
	// clear canvas
	mainContext.clearRect(0, 0, gameWidth, gameHeight);

	// draw the wheel frame
	mainContext.drawImage(wheelFrame, 0, 0, wheelFrame.width, wheelFrame.height, (mainCanvas.width-wheelFrame.width)*0.5, (mainCanvas.height-wheelFrame.height)*0.5+wheelOffsetY, wheelFrame.width, wheelFrame.height);

	// draw wheel center
	mainContext.drawImage(wheelCenter, 0, 0, wheelCenter.width, wheelCenter.height, (mainCanvas.width-wheelCenter.width)*0.5, (mainCanvas.height-wheelCenter.height)*0.5+wheelOffsetY, wheelCenter.width, wheelCenter.height);

	// draw wheel pin
	mainContext.drawImage(wheelPin, 0, 0, wheelPin.width, wheelPin.height, (mainCanvas.width-wheelPin.width)*0.5, (mainCanvas.height-wheelFrame.height-wheelPin.height)*0.5+10+wheelOffsetY, wheelPin.width, wheelPin.height);
}

function drawPieSlice(ctx, centerX, centerY, radius, startAngle, endAngle, color, data ){
    ctx.fillStyle = color;
    ctx.beginPath();
    ctx.moveTo(centerX,centerY);
    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    var centerAngle = (startAngle + endAngle)*0.5;
    // var labelX = (radius*0.5)*Math.cos(centerAngle);
    // var labelY = (radius*0.5)*Math.sin(centerAngle);
    ctx.save();
    ctx.strokeStyle = "#000000";
    ctx.lineWidth = 3;
    ctx.font = "bold 14px Arial";
    ctx.textAlign = 'center';
    ctx.textBaseline = "middle";
    ctx.fillStyle = "white";
	ctx.translate(wheelCanvas.width*0.5, wheelCanvas.height*0.5);
	ctx.rotate(centerAngle);
	ctx.strokeText(data, radius*0.6, 0);
    ctx.fillText(data, radius*0.6, 0); // ctx.fillText(data, labelX, labelY);
    ctx.translate(-wheelCanvas.width*0.5, -wheelCanvas.height*0.5);
    ctx.restore();
}

function DBCallbackEvents(){
	/*
	// for user registration complete
	topCanvas.addEventListener('registration complete', function(e){
		// console.log(e);
		// console.log(user_id);
		
		startCountdown();
	}, false);

	// leaderboard callback related
	topCanvas.addEventListener('get users complete', function(e){
		// console.log('get users complete.');
		// console.log(e);
		usersListReady();
	}, false);
	topCanvas.addEventListener('get games complete', function(e){
		// console.log('get games complete.');
		// console.log(e);
		gamesListReady();
	}, false);
	topCanvas.addEventListener('get leaderboard complete', function(e){
		// console.log('get leaderboard complete.');
		// console.log(e);
		leaderboardListReady();
	}, false);*/
};

//render canvas
function render() {
	requestAnimationFrame(render);
  
	// limit by allowed fps value
	var now = Date.now();
    var elapsed = now - then;
    // if enough time has elapsed, draw the next frame
    if (elapsed > fpsInterval) {
        // Get ready for next frame by setting then=now, but also adjust for your
        // specified fpsInterval not being a multiple of RAF's interval (16.7ms)
        then = now - (elapsed % fpsInterval);

        // Proceed render
        actualRender();
    }
};

function actualRender(){
	// canvas frames
	// mainContext.clearRect(0, 0, gameWidth, gameHeight);

	// rotate the wheel
	/*mainContext.save();
	mainContext.translate(mainCanvas.width*0.5, mainCanvas.height*0.5);
	mainContext.rotate(wheelRotation.rotation*Math.PI/180);
	mainContext.translate(-mainCanvas.width*0.5, -mainCanvas.height*0.5);
	// draw from wheelCanvas to wheelImage, then mainCanvas
	mainContext.drawImage(wheelCanvas, 0, 0, wheelCanvas.width, wheelCanvas.height, (mainCanvas.width-wheelCanvas.width)*0.5, (mainCanvas.height-wheelCanvas.height)*0.5, wheelCanvas.width, wheelCanvas.height);
	// restore the context
	mainContext.restore();*/

	// console.log(wheelRotation);

	if(spinStart){
		mainContext.clearRect(0, 0, gameWidth, gameHeight);
		
		// draw the wheel frame
		mainContext.drawImage(wheelFrame, 0, 0, wheelFrame.width, wheelFrame.height, (mainCanvas.width-wheelFrame.width)*0.5, (mainCanvas.height-wheelFrame.height)*0.5+wheelOffsetY, wheelFrame.width, wheelFrame.height);

		// draw wheel center
		mainContext.drawImage(wheelCenter, 0, 0, wheelCenter.width, wheelCenter.height, (mainCanvas.width-wheelCenter.width)*0.5, (mainCanvas.height-wheelCenter.height)*0.5+wheelOffsetY, wheelCenter.width, wheelCenter.height);

		wheelPinCheck();
	};

	if(debug) stats.update();
};

function luckyDraw() {
	if(clickOnce){
		clickOnce = false;
		$('#wheelCanvas').addClass('disable');

		// check total prize amount
		var prizeAvailable = 0;
		for(var i=0; i<wheelData.length; i++){
			if(wheelData[i].prizeRate.min >= 0){
				prizeAvailable += wheelData[i].quantity;
			};
		};

		if(prizeAvailable > 0){
			thisPrizeID = -1;
			do {
				var thisRate = Math.floor(Math.random() * wheelRange);
				var tempPrizeID;

				for(i=0; i<wheelData.length; i++){
					if(thisRate >= wheelData[i].prizeRate.min && thisRate <= wheelData[i].prizeRate.max){
						tempPrizeID = i;
					};
				};

				console.log('your rate: ' + thisRate + ', your tempPrizeID: ' + tempPrizeID)

				if(wheelData[tempPrizeID].quantity > 0){
					//prize available
					thisPrizeID = tempPrizeID;
					if(!wheelData[thisPrizeID].isLose) wheelData[thisPrizeID].quantity--;
					// console.log('prize is available!');
					// console.log(wheelData[thisPrizeID]);
				} else {
					//prize not available, do nothing, restart
					console.log('too bad, prize is no longer available. Auto redraw...');
				};
		    } while(thisPrizeID < 0);

		    wheelSpin();
		} else {
			// out of prizes!
			toastr.error('You had run out of prizes!', '', {positionClass: "toast-bottom-center"});
			clickOnce = true;
			$('#wheelCanvas').removeClass('disable');
		};

	    $('.btn-start').addClass('active');
	    setTimeout(function(){
	    	$('.btn-start').removeClass('active');
	    }, 300);
	};
}

function getRotation() {
	var spinCount = Math.floor(Math.random()*3)+4; // 4~6 spins
	// var segmentAngle = 360/wheelSegment;
	var rounding = -previousOffset; //Math.floor(currentIndex*segmentAngle - currentRotation);
	var multiplier = (Math.random() > 0.5) ? 1 : -1;
	var newOffset = Math.floor(Math.random()*wheelRotationOffsetRate*multiplier);
	var indexDistance = ((currentIndex - thisPrizeID) > 0) ? Math.abs(currentIndex - thisPrizeID) : wheelSegment - Math.abs(currentIndex - thisPrizeID);
	var distance = indexDistance*segmentAngle; //Math.floor(indexDistance*segmentAngle);
	var totalAngle = spinCount*360 + currentRotation + distance + rounding + newOffset;

	console.log("currentIndex: "+currentIndex+", thisPrizeID: "+thisPrizeID+", indexDistance: "+indexDistance+", currentRotation: "+currentRotation+", rounding: "+rounding+", newOffset: "+newOffset+", distance: "+distance+", totalAngle: "+totalAngle);

	previousOffset = newOffset;

	return totalAngle;
}

function wheelSpin() {
	// calculate rotation for wheelSpin
	wheelPoint = 0;
	currentRotation = currentRotation%360;
    destRotation = getRotation();
    wheelStartTime = new Date().formatDate("yyyy-MM-dd HH:mm:ss");

	TweenLite.fromTo(wheelCanvas, 8, {rotation: currentRotation}, {rotation: destRotation, ease: Power4.easeOut, onStart: wheelCanvasReset, onComplete: wheelSpinEnd});
}

function wheelSpinEnd(){
	spinStart = false;
	currentRotation = destRotation;
	currentIndex = thisPrizeID;
	wheelEndTime = new Date().formatDate("yyyy-MM-dd HH:mm:ss");

	setTimeout(function(e){
		displayPrizeModal(thisPrizeID);
		var created = new Date().formatDate("yyyy-MM-dd HH:mm:ss");

		// save into DB
	    saveGames((thisPrizeID+1), wheelData[thisPrizeID].quantity, wheelStartTime, wheelEndTime, created, wheelData[thisPrizeID].isLose);
	}, popupDisplayTime);
}

function wheelCanvasReset(){
	wheelPinCheck();
	spinStart = true;
}

function wheelPinCheck(){
	if(typeof wheelCanvas._gsTransform != 'undefined'){
		var thisRotation = wheelCanvas._gsTransform.rotation;
		var pointsPast = Math.floor((thisRotation-segmentAngle*0.5)/segmentAngle);
		var pinRotate = false;

		wheelRotation.current = thisRotation;
		// calculate wheelSpeed
		if(wheelRotation.prev != wheelRotation.current){
			wheelSpeed = wheelRotation.current - wheelRotation.prev;
			wheelRotation.prev = wheelRotation.current;

			// console.log("current rotation: "+wheelRotation.current+", prev rotation:"+wheelRotation.prev+", wheelSpeed: "+wheelSpeed);
		};

		if(wheelPoint < pointsPast){
			wheelPoint = pointsPast;
			if(spinStart) {
				// console.log("!!");

				pinRotate = true;

				// pin rotate animation & speed related
				var thisTime = 1/wheelSpeed;
				var multiplier = wheelSpeed/30;
				if(multiplier < 1){
					multiplier = 1;
				};
				if(thisTime > 0.20){
					thisTime = 0.20;
				};
				TweenLite.to(wheelPinRotation, thisTime, {rotation: 20*multiplier, ease: Power3.easeOut, onComplete: wheelPinFallback});

				// this is triggered manually thru user drag
				if(hasDrag){
					hasDragAnimation = true;
				};
			};
		};

		// if(pinRotate){
			// rotate for wheel pin
			mainContext.save();
			mainContext.translate(mainCanvas.width*0.5, (mainCanvas.height-wheelFrame.height-wheelPin.height)*0.5+10+wheelOffsetY);
			mainContext.rotate(-(wheelPinRotation.rotation)*Math.PI/180);
			// draw wheel pin
			mainContext.drawImage(wheelPin, 0, 0, wheelPin.width, wheelPin.height, -wheelPin.width*0.5, 0, wheelPin.width, wheelPin.height);
			// restore
			mainContext.restore();
		// } else {
			// default wheel pin
			// mainContext.drawImage(wheelPin, 0, 0, wheelPin.width, wheelPin.height, (mainCanvas.width-wheelPin.width)*0.5, (mainCanvas.height-wheelFrame.height-wheelPin.height)*0.5+10+wheelOffsetY, wheelPin.width, wheelPin.height);
		// };
	};
}

function wheelPinFallback(){
	var thisTime = 0.1;
	TweenLite.to(wheelPinRotation, thisTime, {rotation: 0, ease: Power1.easeIn});

	setTimeout(function(e){
		wheelPinFallbackEnd();
	}, 150);
}
function wheelPinFallbackEnd(){
	if(!hasDrag && hasDragAnimation){ // no longer dragging, but animation is not finish yet
		hasDragAnimation = false;
		spinStart = false;
		console.log('wheelPinFallbackEnd');
	};
}
/*
function handleMouseDown(e){
	console.log(e);
	mouseX = parseInt(e.originalEvent.touches[0].clientX-offsetX);
	mouseY = parseInt(e.originalEvent.touches[0].clientY-offsetY);
	// drawRotationHandle(false);
	isDown = true; //wheelContext.isPointInPath(mouseX,mouseY);
	// console.log(isDown);

	var dx = mouseX - cx;
	var dy = mouseY - cy;
	r = Math.atan2(dy, dx);
	originAngle = r;
}

function handleMouseUp(e){
	isDown = false;
}

function handleMouseOut(e){
	isDown = false;
}

function handleMouseMove(e){
	if(!isDown){return;}

	mouseX = parseInt(e.originalEvent.touches[0].clientX-offsetX);
	mouseY = parseInt(e.originalEvent.touches[0].clientY-offsetY);
	var dx = mouseX - cx;
	var dy = mouseY - cy;
	r = Math.atan2(dy, dx);
	console.log('r: '+r+', dx: '+dx+', dy: '+dy+', mouseX: '+mouseX+', mouseY: '+mouseY);
	// draw();

	currentRotation += r;
	// currentRotation += (r-originAngle);
	$('#wheelCanvas').rotate(currentRotation);
	// TweenLite.to(wheelCanvas, 0.1, {rotation: r, ease: Power4.easeOut});
}
*/
function initWheelCanvasEvent(){
	/*
	$('#wheelCanvas').bind('touchstart', function(e){
		handleMouseDown(e);
	});
	$('#wheelCanvas').bind('touchmove', function(e){
		handleMouseMove(e);
	});
	$('#wheelCanvas').bind('touchend', function(e){
		handleMouseUp(e);
	});
	$('#wheelCanvas').mouseout(function(e){
		handleMouseOut(e);
	});

	// init cx, cy
	cx = $('#wheelCanvas').position().left;
	cy = $('#wheelCanvas').position().top;
	*/
	Draggable.create("#wheelCanvas", {
		type: "rotation",
		throwProps: false,
		onDragStart: function() {
			hasDrag = true;
			spinStart = true;
			rotationStartTime = new Date();
			rotationStartDeg = this.rotation;
			// console.log(this.rotation);
		},
		onDrag: function() {
			// console.log(this.rotation)
		},
		onDragEnd: function(){
			hasDrag = false;
			if(hasDragAnimation){
				// has animation, do nothing here, ends after animation finish
			} else {
				// end instantly
				spinStart = false;
			};
			rotationEndTime = new Date();
			rotationEndDeg = this.rotation;

			var rotationTime = rotationEndTime - rotationStartTime;
			var rotationDeg = rotationEndDeg - rotationStartDeg;
			var rotationSpeed = rotationDeg/rotationTime;

			// console.log(rotationTime);
			// console.log(rotationDeg);
			// console.log(rotationSpeed);

			if(rotationSpeed > 0.35){
				slowCount = 0;
				hasDragAnimation = false;
				luckyDraw();
			} else {
				slowCount++;
				if(slowCount >= 3){
					slowCount = 0;
					toastr.success('You have to spin faster', '', {positionClass: "toast-bottom-center"});
				};
			};
		}
	});

	$('#mainCanvas').bind("touchstart", function(e){
		multiTouchHandler(e);
	});
}

function multiTouchHandler(event){
	console.log(event.touches);
    if(event.touches.length > 1){
        //the event is multi-touch
        //you can then prevent the behavior
        event.preventDefault()
    }
}


function displayPrizeModal(prizeID){
	if(wheelData[prizeID].isLose){
		// thank you for participation
		$('#lose').css({display: 'block'});
		$('#win').css({display: 'none'});
	} else {
		// pump in prize information
		$('#prizeDetail')[0].innerHTML = wheelData[prizeID].data;

		$('#lose').css({display: 'none'});
		$('#win').css({display: 'block'});
	};

	// display modal
	$('.modal').modal({backdrop: 'static', keyboard: false});
	$('.modal').one('hidden.bs.modal', modalHideCallback); // only called once

	// debug purpose
	/*console.log('On debug purpose, modal will auto close.');
	setTimeout(function(e){
		closePrizeModal();
	}, 5000);*/
}

function closePrizeModal(){
	$('.modal').modal('hide');
}

function modalHideCallback(evt) {
    // evt.data contains the data object passed in the button click event
    console.log('Modal closed.');

    // reset spin button status
    clickOnce = true;
    $('#wheelCanvas').removeClass('disable');

    // debug purpose
    /*console.log('On debug purpose, apps will auto spin again.');
	luckyDraw();*/
}

function initSettings(){
	var segmentSelectorElem = '<ul class="segment-list-wrapper">';

	// for(var i=2; i<=maxSegment; i++){
		// var thisIndex = (i < 10) ? '0'+i : i;
		segmentSelectorElem += '<li class="btn-segment-9"><a onclick="renderSegmentList(9)">9</a></li>';
	// };
	segmentSelectorElem += '</ul>';

	// $('.segment-selector')[0].innerHTML = segmentSelectorElem;
	
	// display current settings
	renderSegmentList(wheelSegment);
}

function renderSegmentList(count){
	var segmentSettingsElem = '<ul class="segment-settings-wrapper segment-settings-wrapper-setting"><li class="segment-settings-label"><div class="row"><div class="col-xs-1">#</div><div class="col-xs-5">Prize Name</div><div class="col-xs-2 text-center">Quantity</div><div class="col-xs-2 text-center">Chances</div></div></li>';
	var thisIndex = (count < 10) ? '0'+count : count;
	$('.segment-selector li').removeClass('active');
	$('.btn-segment-'+thisIndex).addClass('active');

	tempSegment = count;

	// console.log(count);
	// console.log(wheelData);

	var averageRate = Math.floor(100/count);
	var offset = 100 - averageRate*count;
	for(var i=1; i<=count; i++){
		var thisIndex = (i < 10) ? '0'+i : i;
		var thisName = '';
		var thisQuantity = 0;
		var thisChances = 0;
		var thisGameOver = '';

		if(wheelData.length > i-1){
			// console.log(wheelData[i-1].prizeRate);
			thisName = wheelData[i-1].data;
			thisQuantity = wheelData[i-1].quantity;
			thisChances = wheelData[i-1].prizeRate.max - wheelData[i-1].prizeRate.min + 1;
			// thisGameOver = (wheelData[i-1].isLose) ? 'checked' : '';
		};

		// 0 chance check
		if(wheelData.length > i-1 && wheelData[i-1].prizeRate.max == -1 && wheelData[i-1].prizeRate.min == -1){
			thisChances = 0;
		};

		// reset chances if segment is changing
		if(wheelData.length != count){
			thisChances = averageRate;
			if(i==count){
				// apply offset, if any
				thisChances += offset;
			};
		};

		segmentSettingsElem += '<li class="segment-settings-'+thisIndex+'"><div class="row"><div class="col-xs-1">'+thisIndex+'</div><div class="col-xs-5"><input type="text" class="segment-name" placeholder="Prize name" value="'+thisName+'"></div><div class="col-xs-2"><input type="number" class="segment-quantity text-center" placeholder="Qty" value="'+thisQuantity+'"></div><div class="col-xs-2"><input type="number" class="segment-rate segment-id-'+i+' text-center" placeholder="Chances" value="'+thisChances+'"></div></div></li>';
	};
	segmentSettingsElem += '</ul>';

	$('.segment-settings')[0].innerHTML = segmentSettingsElem;

	// event listener - Quantity
	$('.segment-quantity').change(function(event){
		changeHandler(event);
	});
	$('.segment-quantity').keydown(function(event){
		preventDecimal(event);
	});
	$('.segment-quantity').keyup(function(event){
		changeHandler(event);
	});
	// event listener - Chances
	$('.segment-rate').change(function(event){
		changeHandler(event);
	});
	$('.segment-rate').keydown(function(event){
		preventDecimal(event);
	});
	$('.segment-rate').keyup(function(event){
		changeHandler(event);
	});

	renderChecksum();
}

function preventDecimal(e){
	// console.log(e);
	var thisKey;
	if(e.key){
		thisKey = e.key;
	} else {
		thisKey = String.fromCharCode(e.keyCode);
	};
	// console.log(thisKey);
	// force remove decimal
	if(e.key.toLowerCase() == 'backspace'){
		// do nothing
	} else {
		var regex = /[0-9]/;
		// console.log(e.key);
		// console.log(regex.test(e.key));
		// if( !regex.test(e.key) ) {
		if( !regex.test(thisKey) ) {
			e.preventDefault();
		};
	};
}

function changeHandler(e){
	console.log(e);
	// value check and remove initial zero
	if(e.currentTarget.value.length > 1){
		// remove initial zero
		if(e.currentTarget.value.charAt(0) == '0'){
			e.currentTarget.value = e.currentTarget.value.slice(1);
		};

		// remove goddamn decimal
		if(e.currentTarget.value.charAt(e.currentTarget.value.length-1) == '.'){
			e.currentTarget.value = e.currentTarget.value.slice(0, e.currentTarget.value.length-1);
		};
	};

	// prevent null when no value
	if(e.currentTarget.value.length == 0){
		e.currentTarget.value = 0;
	}

	// force remvoe decimal
	// e.currentTarget.value = Math.floor(e.currentTarget.value);

	renderChecksum();
}

function renderChecksum() {
	var totalQuantity = 0;
	totalRate = 0;

	for(var i=0; i<tempSegment; i++){
		if(wheelData.length > 0){
			// console.log($('.segment-quantity')[i].value);
			totalQuantity += parseInt($('.segment-quantity')[i].value); //wheelData[i-1].quantity;
			totalRate += parseInt($('.segment-rate')[i].value); //wheelData[i-1].prizeRate.max - wheelData[i-1].prizeRate.min + 1;
		};
	};

	// checksum elements
	var thisHtml = '<div class="checksum row"><div class="col-xs-1"></div><div class="col-xs-5 text-center">Saving is only allowed when total chances equals to 100</div><div class="col-xs-2 total-quantity text-center">'+totalQuantity+'</div><div class="col-xs-2 total-rate text-center">'+totalRate+'</div></div>';
	
	$('.checksum-wrapper')[0].innerHTML = thisHtml;

	// if totalRate over 100
	if(totalRate != 100){
		$('.checksum .total-rate').addClass('danger');
	};
}

function settings() {
	// show settings page
	$('#settingsTab').css({display: 'block'});
	iNoBounce.disable();
	// $('body').addClass('settings');

	// init settings page
	initSettings();
}

function exitSettings(){
	$('#settingsTab').css({display: 'none'});
	iNoBounce.enable();
	// $('body').removeClass('settings');
}

function saveSettings(){
	if(totalRate != 100){
		toastr.error('Accumulated chances shall not bigger or less than 100!', '', {positionClass: "toast-bottom-center"});
	} else {
		var newPrizeList = [];
		var prevMax = 0;

		for(var i=0; i<tempSegment; i++){
			// var startAngle = 2*Math.PI/wheelSegment*i;
			// var angle = 2*Math.PI/wheelSegment*(i+1);
			var thisIndex = (i+1 < 10) ? '0'+(i+1) : i+1;
			var thisName = $('.segment-settings-'+thisIndex+' .segment-name')[0].value;
			var thisQuantity = $('.segment-settings-'+thisIndex+' .segment-quantity')[0].value;
			var thisChances = $('.segment-settings-'+thisIndex+' .segment-rate')[0].value;
			// var thisGameOver = $('.segment-settings-'+thisIndex+' .segment-gameover')[0].checked;
			var thisMin = prevMax; //0+10*i;
			var thisMax = prevMax + (thisChances - 1); //9+10*i;
			var thisCreated = new Date().formatDate("yyyy-MM-dd HH:mm:ss");

			// 0 chance check
			if(thisChances == 0){
				thisMin = -1;
				thisMax = -1;
			} else {
				// update prevMax
				prevMax = thisMax + 1;
			};

			// if(thisGameOver){
				// thisGameOver = 1;
			// } else {
				thisGameOver = 0;
			// };

			// wheelRange += (thisMax - thisMin) + 1;
			newPrizeList.push({name: thisName, quantity: parseInt(thisQuantity), rate_min: thisMin, rate_max: thisMax, is_gameover: thisGameOver, created: thisCreated});
		};

		// console.log(newPrizeList);

		// save into DB
		updatePrizes(newPrizeList);

		// button animation
		$('.btn-save').addClass('active');
	    setTimeout(function(){
	    	$('.btn-save').removeClass('active');
	    }, 300);
	};
}

function constructWheelColor(){
	var colorList = ['#1d1d1d', '#000000', '#121212'];
	var color = [];

	for(var i=0; i<wheelSegment; i++){
		color.push(colorList[i%2]);
	};

	if(wheelSegment%2 == 1){
		color[color.length-1] = colorList[2];
	};

	return color;
}

iNoBounce.enable();