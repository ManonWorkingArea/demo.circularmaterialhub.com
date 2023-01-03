<?php

$mode     = "lesson";
$id       = $data["Lesson"]['lesson_id'];
$student  = engine::student("id");

if($mode == "lesson")
{
  $url = 'course/' . $id . "/" . $student;

  //---------------- get data -----------------//
  $course = engine::api("get", $url);

  $data["Course"]	          = $course['course']['table'];
  $data["Course-complete"]	= $course['course']['complete'];
  $data["Course-count"]	    = $course['course']['count'];
  $data["Document"]	        = $course['course']['document'];
  $data["Quiz"]	            = $course['course']['quiz'];
  $data["Permission"]	      = $course['course']['permission'];
  $data["PlayerCounter"]	  = $course['course']['player_counter'];

  $url2 = 'skipcourse/' . $id;
  //---------------- get data -----------------//

  $skip = engine::api("get", $url2);
  $data["CourseSkip"]	= $skip;
  $skipped 	= array();

  foreach ($data["CourseSkip"] as $CourseSkip)
  {
    array_push($skipped, $CourseSkip['course_sub']);
  }

  $class = "treetable";
  $first = "course-hr";
}
else if($mode == "course")
{
  //Course
  $url = 'subcourse/' . $id;
  //---------------- get data -----------------//
  $course = engine::api("get", $url);
  $data["Course"]	= $course;

  $class = "";
  $first = "";
}

$main = 0;

$active_array = array();

foreach ($data["Course"] as $Course)
{
  foreach ($Course['topic'] as $Topic)
  {
    $key = array_search($Topic['topic_id'], array_column($Course['topic'], 'topic_id'));

    if($key!="0")
    {
      $before               = $key-1;
      $before_stage         = "topic";
      $before_stage_id      = $Course['topic'][$before]['topic_id'];
      $before_stage_player  = $Course['topic'][$before]['topic_player_finish'];
    }
    else
    {
      $course_key = array_search($Course['course_id'], array_column($data["Course"], 'course_id'));

      if($course_key!="0")
      {
        $before               = $course_key-1;
        $before_stage         = "course";
        $before_stage_id      = $Course['topic'][$before]['topic_id'];
        $before_stage_player  = $data["Course"][$before]['player_complete'];
      }
      else
      {
        $before_stage         = "first";
        $before_stage_id      = "";
        $before_stage_player  = "1";
      }
    }

    if($before_stage=="first")
    {
      if($Topic['topic_player_finish'] =="0")
      {
        array_push($active_array, $Course['course_id']);
      }
      else if($Topic['topic_player_finish'] =="1")
      {
        array_push($active_array, $Course['course_id']);
      }
      else
      {

      }
    }
    else if($before_stage=="topic")
    {
      if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
      {
        array_push($active_array, $Course['course_id']);
      }
      else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
      {
        array_push($active_array, $Course['course_id']);
      }
      else
      {
      }
    }
    else if($before_stage=="course")
    {
      if($before_stage_player=="1" && $Course['player_complete'] =="0")
      {
        array_push($active_array, $Course['course_id']);
      }
      else if($before_stage_player=="1" && $Course['player_complete'] =="1")
      {
        array_push($active_array, $Course['course_id']);
      }
      else
      {
      }
    }
  }
}

$active_array = array_unique($active_array);
//print_r($active_array);
//echo $data["Course-complete"] . "/" . $data["Course-count"];
$total    = 100/$data["Course-count"];
$percent  = $data["Course-complete"]*$total;
//echo "total : " . $total . "</br>";
//echo "Percent : " . $percent . "%";
//echo
$percent = intval( $percent * 100 ) / 100;
$course_status_complete['total']    = $data["Course-count"];
$course_status_complete['current']  = $data["Course-complete"];
$course_status_complete['percent']  = $percent;

?>

<link rel="stylesheet" type="text/css"  href="theme/guruma/assets/core/player/_v8/start/content/global.css"/>
<script type="text/javascript" src="theme/guruma/assets/core/player/_v8/start/java/FWDUVPlayer.js"></script>
<script type="text/javascript">

	FWDUVPUtils.onReady(function()
  {
		new FWDUVPlayer(
    {
			//main settings
			useYoutube:"no",
			useVimeo:"no",
			instanceName:"player1",
			parentId:"avplayer",
			playlistsId:"playlists",
			mainFolderPath:"theme/guruma/assets/core/player/_v8/start/content",
			skinPath:"minimal_skin_dark",
			displayType:"responsive",
			fillEntireVideoScreen:"yes",
			useHEXColorsForSkin:"yes",
			normalHEXButtonsColor:"#FF0000",
			selectedHEXButtonsColor:"#00FF00",
			fillEntireVideoScreen:"no",
			useHEXColorsForSkin:"no",
			normalHEXButtonsColor:"#FF0000",
			selectedHEXButtonsColor:"#000000",
			useDeepLinking:"no",
			rightClickContextMenu:"default",
			addKeyboardSupport:"no",
			autoScale:"yes",
			showButtonsToolTip:"yes",
			stopVideoWhenPlayComplete:"no",
			autoPlay:"yes",
			loop:"no",
			shuffle:"no",
			maxHeight:640,
			maxWidth:1140,
			buttonsToolTipHideDelay:1.5,
			volume:0.5,
			backgroundColor:"#000000",
			videoBackgroundColor:"#000000",
			posterBackgroundColor:"#000000",
			buttonsToolTipFontColor:"#5a5a5a",
			//logo settings
			showLogo:"yes",
			hideLogoWithController:"yes",
			logoPosition:"topRight",
			logoLink:"<?php echo $GLOBALS["School"]['website'];?>",
			logoPath:"https://fti.academy/theme/guruma/assets/images/player-logo.png",
			logoMargins:5,
			//playlists/categories settings
			showPlaylistsButtonAndPlaylists:"no",
			showPlaylistsByDefault:"no",
			thumbnailSelectedType:"opacity",
			startAtPlaylist:0,
			buttonsMargins:0,
			thumbnailMaxWidth:350,
			thumbnailMaxHeight:350,
			horizontalSpaceBetweenThumbnails:8,
			verticalSpaceBetweenThumbnails:8,
			//playlist settings
			showPlaylistButtonAndPlaylist:"no",
			playlistPosition:"right",
			showPlaylistByDefault:"no",
			showPlaylistName:"yes",
			showSearchInput:"yes",
			showLoopButton:"yes",
			showShuffleButton:"yes",
			showNextAndPrevButtons:"yes",
			forceDisableDownloadButtonForFolder:"yes",
			addMouseWheelSupport:"yes",
			startAtRandomVideo:"no",
			folderVideoLabel:"VIDEO ",
			playlistRightWidth:310,
			playlistBottomHeight:599,
			startAtVideo:0,
			maxPlaylistItems:50,
			thumbnailWidth:70,
			thumbnailHeight:70,
			spaceBetweenControllerAndPlaylist:2,
			spaceBetweenThumbnails:2,
			scrollbarOffestWidth:8,
			scollbarSpeedSensitivity:.5,
			playlistBackgroundColor:"#000000",
			playlistNameColor:"#FFFFFF",
			thumbnailNormalBackgroundColor:"#1b1b1b",
			thumbnailHoverBackgroundColor:"#313131",
			thumbnailDisabledBackgroundColor:"#272727",
			searchInputBackgroundColor:"#000000",
			searchInputColor:"#999999",
			youtubeAndFolderVideoTitleColor:"#FFFFFF",
			youtubeOwnerColor:"#999999",
			youtubeDescriptionColor:"#999999",
			//controller settings
			showController:"yes",
			showControllerWhenVideoIsStopped:"yes",
			showNextAndPrevButtonsInController:"no",
			showVolumeButton:"yes",
			showTime:"yes",
			showQualityButton:"yes",
			showSubtitleButton:"yes",
			showInfoButton:"no",
			showDownloadButton:"no",
			showShareButton:"no",
			showEmbedButton:"no",
			showFullScreenButton:"yes",
			disableVideoScrubber:"no",
			repeatBackground:"yes",
			controllerHeight:37,
			controllerHideDelay:3,
			startSpaceBetweenButtons:7,
			spaceBetweenButtons:8,
			scrubbersOffsetWidth:2,
			mainScrubberOffestTop:14,
			timeOffsetLeftWidth:5,
			timeOffsetRightWidth:3,
			timeOffsetTop:0,
			volumeScrubberHeight:80,
			volumeScrubberOfsetHeight:12,
			timeColor:"#888888",
			youtubeQualityButtonNormalColor:"#888888",
			youtubeQualityButtonSelectedColor:"#FFFFFF",
			//subtitle
			showSubtitileByDefault:"yes",
			subtitlesOffLabel:"Subtitle off",
			//popup add windows
			showPopupAdsCloseButton:"yes",
			//embed window and info window
			embedAndInfoWindowCloseButtonMargins:0,
			borderColor:"#333333",
			mainLabelsColor:"#FFFFFF",
			secondaryLabelsColor:"#a1a1a1",
			shareAndEmbedTextColor:"#5a5a5a",
			inputBackgroundColor:"#000000",
			inputColor:"#FFFFFF",
			//annotations
			showAnnotationsPositionTool:"no",
			//ads
			openNewPageAtTheEndOfTheAds:"no",
			playAdsOnlyOnce:"no",
			adsButtonsPosition:"left",
			skipToVideoText:"คุณจะสามารถข้ามโฆษณาได้ใน : ",
			skipToVideoButtonText:"ข้ามโฆษณานี้",
			adsTextNormalColor:"#888888",
			adsTextSelectedColor:"#FFFFFF",
			adsBorderNormalColor:"#666666",
			adsBorderSelectedColor:"#FFFFFF"
		});

		registerAPI();
	});

	//Register API (an setInterval is required because the player is not available until the youtube API is loaded).
	var timer = 0
	var count = 36000000

	var registerAPIInterval;
	function registerAPI()
	{
		clearInterval(registerAPIInterval);
		if(window.player1)
		{
			player1.addListener(FWDUVPlayer.READY, readyHandler);
			player1.addListener(FWDUVPlayer.ERROR, errorHandler);
			player1.addListener(FWDUVPlayer.PLAY, playHandler);
			player1.addListener(FWDUVPlayer.PAUSE, pauseHandler);
			player1.addListener(FWDUVPlayer.STOP, stopHandler);
			player1.addListener(FWDUVPlayer.UPDATE, updateHandler);
			player1.addListener(FWDUVPlayer.UPDATE_TIME, updateTimeHandler);
			player1.addListener(FWDUVPlayer.UPDATE_TIME, getCurrentTimer);
			player1.addListener(FWDUVPlayer.UPDATE_VIDEO_SOURCE, updateVideoSourceHandler);
			player1.addListener(FWDUVPlayer.UPDATE_POSTER_SOURCE, updatePosterSourceHandler);
			player1.addListener(FWDUVPlayer.START_TO_LOAD_PLAYLIST, startToLoadPlaylistHandler);
			player1.addListener(FWDUVPlayer.LOAD_PLAYLIST_COMPLETE, loadPlaylistCompleteHandler);
			player1.addListener(FWDUVPlayer.PLAY_COMPLETE, playCompleteHandler);
		}else{
			registerAPIInterval = setInterval(registerAPI, 100);
		}
	};

	//API event listeners examples
	function readyHandler(e)
	{
		//console.log("API -- ready to use");
		playResume();
	}

	function errorHandler(e){
		//console.log(e.error);
	}

	function playHandler(e){
		//console.log("API -- play");
	}

	function pauseHandler(e){
		//console.log("API -- pause");
	}

	function stopHandler(e){
		//console.log("API -- stop");
    $.ajax(
		{
			type : "POST",
			url : "player/action/stop",
			dataType : "json",
			success : function(response)
			{
				status 	= response.status
        msg 	  = response.return
				//--------------------------------------
				if(status==="true")
				{
          $.prompt(msg,
  				{
  					title		: "แจ้งเตือนการเรียน",
  					buttons	: {"ตกลง":true},
  					submit	: function(e,v,m,f)
  					{
              //console.log("Back");
              page("student/course/<?php echo $data["Lesson"]['lesson_code']?>");
  					}
  				});
				}
			}
		});
	}

	function updateHandler(e)
	{
		//console.log("API -- update video, percent played: " + e.percent);
		//count -= 5000
		//console.log(millisecondsToTime(count))
		//$('.number').html(millisecondsToTime(count));

	}

	function getCurrentTimer(e)
	{
		//console.log("API -- stop");
		return e.currentTime;
	}

	function updateTimeHandler(e)
	{
		//console.log("API -- update time: " + e.currentTime + "/" + e.totalTime);

		if(timer<2)
		{
			timer++
		}
		else
		{
			timer=0
		}
		if(timer==2)
		{
			count -= 1000
			updatetimer(e.currentTime);
		}
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

	function playVideo(videoId){
		player1.playVideo(videoId);
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

	function playResume()
	{
		time = $('#topiclastplay').val();

		//console.log("Resume : " + time);
		player1.scrubbAtTime(time);
	}

	function playMessage(time)
	{
		player1.scrubbAtTime(time);
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

	function showCategories(){
		player1.showCategories();
	}

	function loadPlaylist(playlistId){
		player1.loadPlaylist(playlistId);
	}

	function updatetimer(time)
	{
		//console.log("time " + time);
		$.ajax(
		{
			type : "POST",
			url : "player/action/timer",
			data : {'time':time},
			dataType : "json",
			success : function(response)
			{
				status 	= response.status
				time 		= response.time
				//--------------------------------------
				$('.number').html(time);
				if(status=="false")
				{
					player1.stop();
				}
			}
		});
	}
</script>



<input type="hidden" id="topiccode" value="<?php echo $data["Player"]['player_code'];?>">
<input type="hidden" id="topiclastplay" value="<?php

$myArray = explode(':', $data["Player"]['player_current']);

$m = $myArray[0];
$s = $myArray[1];

$second = ($m*60) + $s;

echo $second;

//echo strtotime($data["Player"]['player_current']) - strtotime('TODAY');

?>">


<section class="inner-header bg-holder bg-overlay-black-90" style="background-image: url('<?php engine::html('img','images/bg/03.jpg');?>');">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
        <h1 class="breadcrumb-title mb-0 text-white"><?php echo $data["Topic"]['topic_name'];?></h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb d-flex justify-content-center justify-content-md-end ml-auto">
          <li class="breadcrumb-item"><a href="student"><i class="fas fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
          <li class="breadcrumb-item active"><span><a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>"><?php echo $data["Lesson"]['lesson_name'];?></a></span></li>
          <li class="breadcrumb-item active"><span>เนื้อหา</span></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="space-pb teacher-detail">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xl-12 position-relative z-index-1 mt-n5">
          <div class="js-player bg-primary embed-responsive embed-responsive-16by9 mb-32pt">
              <div class="player embed-responsive-item">
                <div id="avplayer"></div>
                <ul id="playlists" style="display:none;">
                  <li data-source           = "demoPlayer"
                      data-playlist-name    = "Demo Topic Content"
                      data-thumbnail-path   = "content/thumbnails/large1.jpg">
                  </li>
                </ul>
                <ul id="demoPlayer" style="display:none;">
                <li data-thumb-source     	= "https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url'];?>/<?php echo $data["Lesson"]['lesson_cover'];?>"
                      data-video-source     = "[{source:'https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url'];?>/<?php echo $data['Topic']['topic_video'];?>', label:'small version'}]"
                      data-start-at-video   = "0"
                      data-poster-source    = "<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $data["Topic"]['topic_poster'];?>"
                      data-subtitle-soruce  = "[{source:'<?php echo $GLOBALS["School"]['website'];?>course/action/subtitle.txt', label:'คำอธิบาย'}]"
                      data-start-at-subtitle= "0"
                      data-downloadable     = "no"
                      data-scrub-at-time-at-first-play = "none">
                  </li>
              </div>
          </div>
        </div>

        <div class="col-md-12 col-xl-12 space-sm-pt">

          <ul class="list-unstyled d-flex flex-wrap mb-4">
					<li class="course-d-Teacher mr-3 mr-lg-5 mb-2 mb-lg-0">
						<div class="d-flex">
              <i class="flaticon-user fa-3x mt-2 mr-2 mr-lg-3 text-primary"></i>
							<div class="d-block">
								<p class="mb-0">วิทยากร/ผู้สอน</p>
								<span class="lead fw-6 text-dark"><?php echo $data["Teacher"]['teacher_name']?></span>
							</div>
						</div>
					</li>
					<li class="mr-3 mr-lg-5 mb-2 mb-lg-0">
						<div class="d-flex">
							<i class="flaticon-bookmark fa-3x mt-2 mr-2 mr-lg-3 text-primary"></i>
							<div class="d-block">
								<p class="mb-0">หมวดหมู่</p>
                <?php

                foreach ($data["Lesson"]['department'] as $Department)
                {
                  echo "<span class='lead fw-6 text-dark'>{$Department['department_name']}</span>";
                }

                ?>

							</div>
						</div>
					</li>
          <li class="mr-3 mr-lg-5 mb-2 mb-lg-0">
						<div class="d-flex">
							<i class="flaticon-student fa-3x mt-2 mr-2 mr-lg-3 text-primary"></i>
							<div class="d-block">
								<p class="mb-0">กลับสู่เนื้อหาหลักสูตร</p>
								<span class="lead fw-6 text-dark"><a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>"><?php echo $data["Lesson"]['lesson_name'];?></a></span>
							</div>
						</div>
					</li>
					<!-- <li>
						<div class="d-flex">
							<i class="flaticon-student fa-3x mt-2 mr-2 mr-lg-3 text-primary"></i>
							<div class="d-block">
								<p class="mb-0">Students</p>
								<span class="lead fw-6 text-dark">157 (Registered)</span>
							</div>
						</div>
					</li> -->
				</ul>

          <!-- <div class="border mb-4">
        		<h6 class="text-dark px-4 py-2 bg-light mb-0">Listing 5 Reviews For PMP Exam Prep Seminar - PMBOK Guide 6 </h6>
        		<div class="p-4 border-top">
        			<div class="mb-4 d-xl-inline-flex">
        				<img class="mr-3 media-img" src="theme/guruma/assets/images/avatar/06.jpg?1600118449" alt="">
        				<div class="media-body">
        					<div class="px-xl-4 mt-3 mt-xl-0">
        						<div class="d-flex align-items-center">
        							<h6 class="mt-0">Felica Queen </h6>
        							<div class="d-flex ml-auto mb-3">
        								<span class="px-2 border text-success rounded-sm d-inline-block mr-2">4.0</span>
        								<ul class="list-unstyled d-flex mb-0">
        									<li><i class="fas fa-star text-warning"></i></li>
        									<li><i class="fas fa-star text-warning"></i></li>
        									<li><i class="fas fa-star text-warning"></i></li>
        									<li><i class="fas fa-star text-warning"></i></li>
        									<li><i class="far fa-star text-warning"></i></li>
        								</ul>
        							</div>
        						</div>
        						<p>Then work backwards to develop the plan. What steps are required to get you to the goals? Make the plan as detailed as possible. Try to visualize and then plan.</p>
        						<div class="d-sm-flex">
        							<a class="bg-light text-dark rounded-sm px-3 py-1 mr-2 mr-xl-4 font-sm d-inline-block mb-2 mb-sm-0" href="#"> <i class="fas fa-reply pr-1"></i> Reply Review </a>
        							<a class="bg-success-soft text-success rounded-sm px-3 py-1 mr-2 mr-xl-4 font-sm d-inline-block" href="#"> <i class="far fa-thumbs-up pr-1"></i> 56 Votes</a>
        							<a class="bg-danger-soft text-danger rounded-sm px-3 py-1 font-sm d-inline-block" href="#"> <i class="far fa-thumbs-down pr-1"></i> 06</a>
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div> -->

          <!-- <div class="border">
        		<h6 class="text-dark px-4 py-2 bg-light mb-0">เพิ่มความคิดเห็น</h6>
        		<div class="p-4 border-top">
        			<form class="form-flat-style">
        				<div class="form-row">
        					<div class="form-group col-md-12">
        						<div class="ratings">
        							<input type="radio" id="star5" name="ratings" value="5"><label class="full" for="star5" title="Awesome - 5 stars"></label>
        							<input type="radio" id="star4half" name="ratings" value="4 and a half"><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
        							<input type="radio" id="star4" name="ratings" value="4"><label class="full" for="star4" title="Pretty good - 4 stars"></label>
        							<input type="radio" id="star3half" name="ratings" value="3 and a half"><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
        							<input type="radio" id="star3" name="ratings" value="3"><label class="full" for="star3" title="Meh - 3 stars"></label>
        							<input type="radio" id="star2half" name="ratings" value="2 and a half"><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
        							<input type="radio" id="star2" name="ratings" value="2"><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
        							<input type="radio" id="star1half" name="ratings" value="1 and a half"><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
        							<input type="radio" id="star1" name="ratings" value="1"><label class="full" for="star1" title="Sucks big time - 1 star"></label>
        							<input type="radio" id="starhalf" name="ratings" value="half"><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
        						</div>
        					</div>
        					<div class="form-group col-lg-4">
        						<label>ชื่อของคุณ</label>
        						<input type="text" class="form-control" placeholder="ชื่อของคุณ">
        					</div>
        					<div class="form-group col-lg-4">
        						<label>อีเมล์ของคุณ</label>
        						<input type="email" class="form-control" placeholder="อีเมล์ของคุณ">
        					</div>
        					<div class="form-group col-lg-4">
        						<label>หัวข้อ</label>
        						<input type="text" class="form-control" id="phone" placeholder="หัวข้อ">
        					</div>
        					<div class="form-group col-lg-12">
        						<label>ความคิดเห็นของคุณ</label>
        						<textarea class="form-control" rows="4" placeholder="ความคิดเห็นของคุณ"></textarea>
        					</div>
        					<div class="col-md-12">
        						<a class="btn btn-primary" href="#">ส่งความเห็น</a>
        					</div>
        				</div>
        			</form>
        		</div>
        	</div> -->

      </div>
    </div>
  </div>
</section>
