/*global $*/

var leftArrowDown = false;
var rightArrowDown = false;
var upArrowDown = false;
var gameTimer;
var level = 0;

var lifebar;
var numLives = 0;

const GRAVITY = 1;
var fallSpeed = 0;

function init() {
	$("#output").innerHTML = level;
	
	for(var i=0; i<3; i++) addLife();
	
	$('#pc').css({'background-color':'transparent','background-repeat':'no-repeat','background-image':'url(catpc.png)', 'width': '40px', 'height': '40px'});
	
	$('#npc').css({'background-color':'transparent','background-repeat':'no-repeat','background-image':'url(catfood.png)','width': '40px','height': '30px'});
	
	nextLevel();
}

function addLife() {
	numLives++;
	var life = document.createElement('IMG');
	life.src = 'life.png';
	$("#lifebar").append(life);
}

function removeLife() {
	if(numLives>0) {
		numLives--;
		$("#lifebar").children("img:first").remove();
	} else {
		gameWindow.innerHTML = '<br><br>You lose!';
		gameWindow.className = 'msgGameOver';
	}
}

function nextLevel() {
	$('#btnContinue').hide();
	
	level++;
	$("#output").innerHTML = level;
	
	fallSpeed = 0;
	leftArrowDown = false;
	rightArrowDown = false;
	upArrowDown = false;
	
	$('#pc').css({'left':'190px','top':'50px'});
	
	$(".platform").each(function () {
		$(this).remove();
	})
	
	if(level==1) {
		$('#npc').css({'left':'2000px','top':'350px'});
		
		addPlatform(0, 380, 500, 20);
		addPlatform(150,300,100,20);
		addPlatform(550, 380, 400, 20);
		addPlatform(400, 300, 100, 100);
		addPlatform(900, 200, 100, 20);
		addPlatform(800, 300, 100, 20);
		addPlatform(1180, 300, 200, 20);
		addPlatform(1480, 200, 200, 20);
		addPlatform(1780, 250, 100, 20);
		addPlatform(1980, 380, 300, 20);
	}
	else if(level==2) {
		$('#npc').css({'left':'2000px','top':'240px'});
		
		addPlatform(0, 380, 350, 20);
		addPlatform(450,270,100,20);
		addPlatform(650, 380, 200, 100);
		addPlatform(900, 150, 100, 100);
		addPlatform(960, 380, 100, 20);
		addPlatform(1125, 270, 200, 20);
		addPlatform(1450, 200, 100, 20);
		addPlatform(1600, 380, 200, 20);
		addPlatform(1950, 270, 200, 20);
	}
	else if(level==3) {
		$('#npc').css({'left':'2050px','top':'350px'});

		addPlatform(0, 380, 350, 20);
		addPlatform(470,300,300,20);
		addPlatform(700, 220, 75, 20);
		addPlatform(800, 150, 100, 200);
		addPlatform(900, 75, 50, 20);
		addPlatform(1100, 250, 15, 20);
		addPlatform(1300, 380, 30, 20);
		addPlatform(1500, 380, 200, 20);
		addPlatform(1800, 270, 320, 20);
		addPlatform(2000, 380, 110, 20);
	}
	
	gameTimer = setInterval(gameloop, 50);
}

function addPlatform(x, y, w, h) {
	var p = $("<div class='platform'></div>");
	p.css({
		'left'   : x + 'px',
		'top'    : y + 'px',
		'width'  : w + 'px',
		'height' : h + 'px'
	});
	$('#gameWindow').append(p);
}

function gameloop(){
	// HORIZONTAL MOVEMENT
	if(leftArrowDown){
		$("#pc").css({"left" : (parseInt($("#pc").css("left")) - 7 + 'px')});
		
		var sideHit = false;
		$(".platform").each(function () {
			if(hittest($("#pc"), $(this))) sideHit = true;
		})
		$("#pc").css({"left" : (parseInt($("#pc").css("left")) + 7 + 'px')});
		
		if(!sideHit) {
			$(".platform").each(function () {
				 $(this).css({"left" : (parseInt($(this).css("left")) + 7 + 'px')});
			})
			$("#npc").css({"left" : parseInt($("#npc").css("left")) + 7 + 'px'});
		}
	}
	if(rightArrowDown){
		$("#pc").css({"left" : (parseInt($("#pc").css("left")) + 7 + 'px')});
		
		var sideHit = false;
		$(".platform").each(function () {
			if(hittest($("#pc"), $(this))) sideHit = true;
		})
		$("#pc").css({"left" : (parseInt($("#pc").css("left")) - 7 + 'px')});
		
			if(!sideHit) {
			$(".platform").each(function () {
				 $(this).css({"left" : parseInt($(this).css("left")) - 7 + 'px'});
			})
			$("#npc").css({"left" : parseInt($("#npc").css("left")) - 7 + 'px'});
		}
	}

	// VERTICAL MOVEMENT
	fallSpeed += GRAVITY;
	$("#pc").css({"top" : (parseInt($("#pc").css("top")) + fallSpeed + 'px')});
	$(".platform").each(function () {
		if(hittest($("#pc"), $(this))) {
			if(fallSpeed < 0) {
				$("#pc").css({"top" : (parseInt($("#pc").css("top")) + parseInt($("#pc").css("height")) + 'px')});
				fallSpeed *= -1;
			} else {
				$("#pc").css({"top" : (parseInt($(this).css("top")) - parseInt($("#pc").css("height")) + 'px')});
			
				if(upArrowDown) fallSpeed = -16;
				else {
					fallSpeed = 0;
				}
			}
		}
	});
	if(hittest($("#pc"), $("#npc"))) {
		clearInterval(gameTimer);
		alert('You completed the level!');
		if(level == 3) {
			gameWindow.innerHTML = '<br><br>You win!';
			gameWindow.className = 'msgGameOver';
		}
		else{
			$('#btnContinue').show();
			$('#btnContinue').css({'display': 'block'});
		}
	}
	else if (parseInt($("#pc").css("top")) > 400) {
		clearInterval(gameTimer);
		alert('You failed to complete the level!');
		
		removeLife();
		
		level--;
		if(numLives >= 0) {
		   nextLevel();
		}
	}
}

function hittest(a, b){
	var aX1 = parseInt(a.css("left"));
	var aY1 = parseInt(a.css("top"));
	var aX2 = aX1 + parseInt(a.css("width"))-1;
	var aY2 = aY1;
	var aX3 = aX1;
	var aY3 = aY1 + parseInt(a.css("height"))-1;
	var aX4 = aX2;
	var aY4 = aY3;
	var bX1 = parseInt(b.css("left"));
	var bY1 = parseInt(b.css("top"));
	var bX2 = bX1 + parseInt(b.css("width"))-1;
	var bY2 = bY1;
	var bX3 = bX1;
	var bY3 = bY1 + parseInt(b.css("height"))-1;
	var bX4 = bX2;
	var bY4 = bY3;

	var hOverlap = true;
	if(aX1<bX1 && aX2<bX1) hOverlap = false;
	if(aX1>bX2 && aX2>bX2) hOverlap = false;

	var vOverlap = true;
	if(aY1<bY1 && aY3<bY1) vOverlap = false;
	if(aY1>bY3 && aY3>bY3) vOverlap = false;

	if(hOverlap && vOverlap) return true;
	return false;
}

document.addEventListener('keydown', function(event){
	if(event.keyCode==37) leftArrowDown = true;
	if(event.keyCode==39) rightArrowDown = true;
	if(event.keyCode==38) upArrowDown = true;
});

document.addEventListener('keyup', function(event){
	if(event.keyCode==37) leftArrowDown = false;
	if(event.keyCode==39) rightArrowDown = false;
	if(event.keyCode==38) upArrowDown = false;
});
