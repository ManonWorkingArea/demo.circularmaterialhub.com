<link rel="stylesheet" type="text/css"  href="theme/demo/assets/core/player/js/plugin/ultimateplayer/start/content/global.css"/>
<script type="text/javascript" src="theme/demo/assets/core/player/js/plugin/ultimateplayer/start/java/FWDUVPlayer.js"></script>

<?php //engine::html("theme","js","js/player/js/FWDPlayer.js");?>

<!-- Setup video player-->
<script type="text/javascript">

	//FWDConsole.setPrototype();
	//var logger =  new FWDConsole();

	FWDUVPUtils.onReady(function(){

		new FWDUVPlayer({
			//main settings
			useYoutube:"no",
			useVimeo:"no",
			instanceName:"player1",
			parentId:"avplayer",
			playlistsId:"playlists",
			mainFolderPath:"theme/demo/assets/core/player/js/plugin/ultimateplayer/start/content",
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
			autoPlay:"no",
			loop:"no",
			shuffle:"no",
			maxHeight:600,
			maxWidth:1067,
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
			logoPath:"<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=CDN1/academy/graphic/player-logo.png&wt=false",
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
			showSubtitleButton:"no",
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
			showSubtitileByDefault:"no",
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
		console.log(e.error);
	}

	function playHandler(e){
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

		console.log("Resume : " + time);
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
		topic= $('#topiccode').val();
		//console.log("time " + time);
		$.ajax(
		{
			type : "POST",
			url : "player/action/timer",
			data : {'time':time,'topic':topic},
			dataType : "json",
			success : function(response)
			{
				//console.log(response)
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

<!-- PAGE WRAP -->
<div id="page-wrap">

    <div class="top-nav">

        <h4 class="sm black">
			<img src="<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $_SESSION["School"]['logo'];?>&wt=false" alt="Image" class="img-logo-course">

			<span class="bold">ชื่อคอร์ส : </span><?php echo $data["Lesson"]['lesson_name'];?>

			<input type="hidden" id="topiccode" value="<?php echo $data["FirstTopic"]['playercode'];?>">
			<input type="hidden" id="topiclastplay" value="<?php echo $data["FirstTopic"]['playerresume'];?>">

		</h4>

        <ul class="top-nav-list">
			<li class="prev-course">
				<div class="timer">
					<span class="clock"><img src="theme/demo/assets/core/player/images/clock.gif"></span>
					<span class="number"><?php echo engine::permission("timer");?></span>
				</div>
			</li>
            <li class="prev-course"><a href="javascript:void(0);"><i class="icon md-angle-left"></i><span class="tooltip">ก่อนหน้า</span></a></li>
            <li class="next-course"><a href="javascript:void(0);"><i class="icon md-angle-right"></i><span class="tooltip">ถัดไป</span></a></li>
            <li class="outline-learn active">
                <a href="#"><i class="icon md-list"></i></a>
                <div class="list-item-body outline-learn-body">

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> บทเรียนทั้งหมด</h5>

						<div class="treeview-search">
							<input type="text" class="form-control" id="plugins4_q" name="plugins4_q" placeholder="ค้นหาบทเรียน">

							<div class="treeview-tool">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default" onclick="$('#coursetree').jstree('close_all');"><i class="fa fa-minus-square" aria-hidden="true"></i> ย่อรายการ</button>
									<button type="button" class="btn btn-sm btn-default" onclick="$('#coursetree').jstree('open_all');"><i class="fa fa-plus-square" aria-hidden="true"></i> ขยายรายการ</button>
								</div>
							</div>

						</div>

						<div id="coursetree">
						<?php echo engine::createCourseTreeview($data["Lesson"]['lesson_id'],"lesson");?>
						</div>

						<div id="event_result" style="margin-top:10px; margin-bottom:10px; text-align:center;"><strong>คุณเลือก : </strong><?php echo $data["FirstTopic"]['topic_name'];?></div>

                    </div>

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-check-square-o" aria-hidden="true"></i> แบบทดสอบทั้งหมด</h5>
						<div class="sidebar-content-area">

							<table class="table table-condensed">
								<tbody>

								<?php

								$order_contest = "0";

								foreach ($data["Contest"] as $Contest)
								{
									$order_contest++;
									$score = $Contest['score_number'];

									if($score==NULL || $score == "")
									{
										$score = "0";
									}
									else
									{
										$score = $score;
									}

									echo
									"<tr>
										<td width='55%'>
											<div class='overflow-tip'>
												<span>
													<a href='player/quiz/{$data["Lesson"]['lesson_code']}/{$Contest['contest_code']}'>
														{$order_contest}.{$Contest['contest_name']}
													</a>
												</span>
											</div>
										</td>
										<td width='15%'><strong>{$Contest['contest_choice']}</strong> ข้อ</td>
										<td width='15%'><i class='fa fa-clock'></i> <strong>{$Contest['contest_time']}</strong> นาที</td>
										<td width='15%'><i class='fa fa-clock'></i> <strong>{$score}</strong> คะแนน</td>
									</tr>";
								}

								?>

							</tbody>
						</table>
					</div>
                    </div>

					<div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-download" aria-hidden="true"></i> เอกสารประกอบการเรียน</h5>

						<div class="sidebar-content-area">
							<table class="table table-condensed">
								<tbody>

								<?php
								$order_doc = "0";
								foreach ($data["Document"] as $Document)
								{
									$order_doc++;
									$type = $Document['document_type'];
									switch ($type)
									{
										case "PDF":
											$type = "<i class='fa fa-file-pdf-o' aria-hidden='true'></i> PDF";
										break;

										case "DOCX":
											$type = "<i class='fa fa-file-word-o' aria-hidden='true'></i> DOCX";
										break;

										case "DOC":
											$type = "<i class='fa fa-file-word-o' aria-hidden='true'></i> DOC";
										break;

										case "JPG":
											$type = "<i class='fa fa-file-photo-o' aria-hidden='true'></i> JPG";
										break;
									}

									echo
									"<tr>
										<td width='40%'>
											<div class='overflow-tip'>
												<span>
													<a href='{$GLOBALS["School"]['cdn']}doc.php?file={$Document['document_link']}'>
														{$order_doc}.{$Document['document_name']}
													</a>
												</span>
											</div>
										</td>
										<td width='20%'><span class='label label-danger'>{$type}</span></td>
										<td width='20%'><i class='fa fa-clock'></i> {$Document['document_size']}</td>
										<td width='10%'><a href='{$GLOBALS["School"]['cdn']}doc.php?file={$Document['document_link']}'><i class='fa fa-download' aria-hidden='true'></i></a></td>
									</tr>";
								}
								?>

								</tbody>
							</table>
						</div>

                    </div>
                </div>
            </li>

            <!-- DISCUSSION -->
            <li class="discussion-learn">
                <a href="javascript:void(0);"><i class="icon md-comments"></i></a>
                <div class="list-item-body discussion-learn-body">
                    <div class="inner">
                        <div class="form-discussion">
                            <form>
                                <div class="text-title">
                                    <input type="text" name="subject" id="subject" placeholder="ระบุหัวข้อ">
                                </div>
                                <div class="post-editor text-form-editor">
                                    <textarea id="message" name="message" placeholder="พิมพ์คำถาม"></textarea>
                                </div>
                                <div class="form-submit">
									<button type="button" class="btn btn-sm btn-primary" onclick="sendMessage()"><i class="fa fa-send" aria-hidden="true"></i> ส่งคำถาม</button>
                                </div>
                                <h5 class="messagecount">0 หัวข้อ</h5>
                            </form>
                        </div>

                        <ul class="list-discussion">

                            <!-- LIST ITEM -->
                            <!-- END / LIST ITEM -->

                        </ul>
                    </div>
                </div>
            </li>

            <!-- NOTE LEARN -->
            <li class="note-learn">
                <a href="javascript:void(0);"><i class="icon md-file"></i></a>
                <div class="list-item-body note-learn-body">
                    <div class="note-title">
                        <h5>บันทึกช่วยจำ</h5>
                        <a href="javascript:void(0);"><i class="fa fa-send"></i></a>
                    </div>

					<input type='hidden' id="player_code" class='form-control' />

                    <div contenteditable="true" class="note-body">
                       พิมพ์ข้อความของคุณ
                    </div>
                </div>
            </li>
            <li class="backpage">
                <a href="player/show/<?php echo engine::permission("code");?>"><i class="icon fa fa-home homeicon"></i></a>
            </li>
        </ul>

    </div>


    <section id="learning-section" class="learning-section learn-section">
        <div class="container">
            <div class="title-ct">
                <h3><strong>ชื่อบทเรียน : </strong><span class="topic-title"><?php echo $data["FirstTopic"]['topic_name'];?></span></h3>
                <div class="tt-right">

					<button type="button" class="btn btn-sm btn-primary" onclick="playResume()"><i class="fa fa-play" aria-hidden="true"></i> เล่นต่อจาก <span class="topiclastplay"><?php echo $data["FirstTopic"]['playerresume'];?></span></button>

                    <input type="checkbox" id="markaslearned">
                    <label for="markaslearned"> เรียนจบแล้ว <i class="icon md-check-2"></i></label>

                </div>
            </div>
            <div class="abc">
            <div align="center">
                <div id="avplayer"></div>
				<!--  Playlists -->
				<ul id="playlists" style="display:none;">
					<li data-source="playlist1" data-playlist-name="MY HTML PLAYLIST 1" data-thumbnail-path="content/thumbnails/large1.jpg">
						<p class="minimalDarkCategoriesTitle"><span class="minimialDarkBold">ชื่อบทเรียน : </span><?php echo $data["Lesson"]['lesson_name'];?></p>
						<p class="minimalDarkCategoriesType"><span class="minimialDarkBold">ประเภทบทเรียน : </span><?php echo $data["Lesson"]['lesson_mode_name'];?></p>
						<p class="minimalDarkCategoriesDescription"><span class="minimialDarkBold">รายละเอียด : </span><?php echo $data["Lesson"]['lesson_detail'];?></p>
					</li>
				</ul>

				<?php //print_r($data["FirstTopic"]);?>

				<!--  HTML playlist -->
				<ul id="playlist1" style="display:none;">

					<li id="videoplayer"

						data-thumb-source=""
						data-video-source="[{source:'{$GLOBALS["School"]['cdn']}player.php?video=<?php echo $data["FirstTopic"]['playercode'];?>', label:'<?php echo $data["FirstTopic"]['topic_code'];?>'}]"
						data-start-at-video="0"
						data-start-at-video="0"
						data-poster-source="{$GLOBALS["School"]['cdn']}img.php?file=<?php

						if($data["FirstTopic"]['topic_poster']=="" || $data["FirstTopic"]['topic_poster'] ==NULL)
						{
							echo $data["Lesson"]['lesson_cover'];
						}
						else
						{
							echo $data["FirstTopic"]['topic_poster'];
						}


						?>"

						data-start-at-subtitle="0"
						data-downloadable="yes"
						data-scrub-at-time-at-first-play="none"
					>

					<!--data-subtitle-soruce="[{source:'https://www.me-rean.com/course/action/subtitle.txt', label:'คำอธิบาย'}]"  -->


						<div data-video-short-description="">
							<div>
								<p class="minimalDarkThumbnailTitle"><?php echo $data["Lesson"]['lesson_name'];?></p>
								<p class="minimalDarkThumbnailDesc"><?php echo $data["Lesson"]['lesson_detail'];?></p>
							</div>
						</div>

						<!--<ul data-ads="">
							<li data-source="https://cdn.ecobz.training/player.php?video=me-rean/Video/ad.mp4"  data-time-start="00:00:05"  data-time-to-hold-ads=10  data-thumbnail-source="https://cdn.ecobz.training/img.php?file=<?php echo $data["Lesson"]['lesson_cover'];?>"  data-link="https://www.me-rean.com"  data-target="_blank"></li>
						</ul>-->

						<ul data-annotations="">
							<li data-start-time="00:00:01" data-end-time="00:01:00" data-left="10" data-top="500" data-show-close-button="yes" data-normal-state-class="UVPAnnotationLinkNormal">
								<div><span style="font-weight:bold; text-decoration: underline;">ข้อความ</span> ข้อความในวีดีโอ</div>
							</li>

							<li data-start-time="00:00:02" data-end-time="00:01:00" data-left="735" data-top="500" data-show-close-button="yes" data-click-source="https://www.me-rean.com" data-click-source-target="_blank" data-normal-state-class="UVPAnnotationLinkNormal" data-selected-state-class="UVPAnnotationLinkSelected">
								<div><span style="font-weight:bold; text-decoration: underline;">คำอธิบาย</span> ใช้สำหรับอธิบายเนื้อหา</div>
							</li>

							<li data-start-time="00:00:03" data-end-time="00:01:00" data-left="370" data-top="500" data-show-close-button="yes" data-click-source="alert('This is a javascript function called using the annotations feature of Ultimate Video Player!');" data-click-source-target="_blank" data-normal-state-class="UVPAnnotationJavascriptNormal" data-selected-state-class="UVPAnnotationJavascriptSelected">
								<div><span <span style="font-weight:bold; text-decoration: underline;">โฆษณา</span> ใช้สำหรับโฆษณาในวีดีโอ</div>
							</li>

							<li data-start-time="00:00:04" data-end-time="00:10:20" data-left="5" data-top="5" data-normal-state-class="UVPAnnotationCSSNormal">
								<div>
									<p><?php echo engine::student("code");?></p>
								</div>
							</li>

						</ul>
					</li>

				</ul>
            </div>
            </div>
        </div>
    </section>

</div>
<!-- END / PAGE WRAP -->
