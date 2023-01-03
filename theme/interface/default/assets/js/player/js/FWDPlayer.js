//API event listeners examples
function readyHandler(e)
{
	//console.log("API -- ready to use");
}

function errorHandler(e)
{
	console.log(e.error);
}

function playHandler(e)
{
	console.log("API -- play");
}

function pauseHandler(e){
	//console.log("API -- pause");
}

function stopHandler(e){
	//console.log("API -- stop");
}

function updateHandler(e)
{
	console.log("API -- update video, percent played: " + e.percent);
}

function updateTimeHandler(e){
	//console.log("API -- update time: " + e.currentTime + "/" + e.totalTime);
}

function updateVideoSourceHandler(e){
	//console.log("API -- video source update: " + player1.getVideoSource());
}

function updatePosterSourceHandler(e){
	//console.log("API -- video source update: " + player1.getPosterSource());
}

function startToLoadPlaylistHandler(e){
	//console.log("API -- start to load playlist: " + player1.getCurCatId());
}

function loadPlaylistCompleteHandler(e){
	//console.log("API -- playlist load complete: " + player1.getCurCatId());
}

function playCompleteHandler(e){
	//console.log("API -- play complete");
}


//API methods examples
function play(){
	player1.play();
}

function playNext(){
	player1.playNext();
}

function playPrev(){
	player1.playPrev();
}

function playShuffle(){
	player1.playShuffle();
}

function pause(){
	player1.pause();
}

function stop(){
	player1.stop();
}

function scrub(percent){
	player1.scrub(percent);
}

function setVolume(percent){
	player1.setVolume(percent);
}

function share(){
	player1.share();
}

function download(){
	player1.downloadVideo();
}

function goFullScreen(){
	player1.goFullScreen();
}

function loadPlaylist(playlistId){
	player1.loadPlaylist(playlistId);
}

function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function changeCanvasColors(){
	var randomColor = getRandomColor();
	player1.updateHEXColors(randomColor, "#FFFFFF");
	//$('.minimalDarkThumbnailTitle').css('color',randomColor);
	
	$("head").append('<style type="text/css"></style>');
	var new_stylesheet = $("head").children(':last');
	new_stylesheet.html('.minimalDarkThumbnailTitle, .minimialDarkBold, .fwdChangeColor{color:' + randomColor + ';}');
	
	$(".ytbChangeColor").css("color", randomColor);
}
