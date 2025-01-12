var MainGame = MainGame || {
	REVISION : '1',
	AUTHOR : "kent1590"
};

var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/" + getUrl.pathname.split('/')[2]+"/" + getUrl.pathname.split('/')[3]+"/";
// console.log(baseUrl);

// insert link logo for ipad
var link = document.createElement('link');
link.rel = 'apple-touch-icon';
link.sizes = '180x180';
link.href = baseUrl+'app-logo.png?v1.2';
document.head.appendChild(link);

var systemDB;
var gameWidth = 768; //document.documentElement.clientWidth; //750;
var gameHeight = 1024; //document.documentElement.clientHeight; //500;
var fps = 30; //default should be 60
var fpsInterval = 1000 / fps;
var now, then, elapsed;
var animationMultiplier = 60/fps;
var popupDisplayTime = 0;

var maxSegment = 14;
var tempSegment = 0;

var mainCanvas;
var mainContext;
var wheelCanvas;
var wheelContext;
/*
var mouseX = 0;
var mouseY = 0;
var offsetX = 0;
var offsetY = 0;
var originX = 0, originY = 0, originAngle = 0;
var cx, cy, r, currentAngle;
var isDown = false;
*/
var rotationStartDeg = 0;
var rotationEndDeg = 0;
var rotationStartTime = 0;
var rotationEndTime = 0;
var slowCount = 0;
var hasDrag = false;
var hasDragAnimation = false;
// var wheelImage = new Image();

var spinSettings = [];
var rawWheelData = [];
var wheelData = [];
var wheelRadius = 320;
var wheelSegment = 14;
var wheelRange = 0;
var segmentAngle = 360/wheelSegment;
var wheelFrame;
var wheelPin;
var wheelCenter;
var wheelOffsetY = 25;
var currentIndex = 0;
var thisPrizeID = -1;
var currentRotation = 0;
var destRotation = 0;
var previousOffset = 0;
var wheelRotationOffsetRate = 10;
var wheelPoint = 0;
var spinStart = false;
var wheelSpeed = 0;
var wheelPinRotation = {rotation: 0};
var wheelRotation = {prev: 0, current: 0};
var clickOnce = true;
var wheelStartTime = '';
var wheelEndTime = '';
var totalRate = 0;

var debug = false;

jQuery.fn.rotate = function(degrees) {
    $(this).css({'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};