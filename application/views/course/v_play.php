<?php

require_once "plugin/aws/aws-autoloader.php";
//AWS S3
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

$s3 = new S3Client
([
  'version'     => 'latest',
  'region'      => 'ap-southeast-1',
  'use_path_style_endpoint' => true,
  'endpoint'    => "https://content.fti.academy/",
  'credentials' =>
  [
    'key'       => "ecobz",
    'secret'    => "8hFhpndtuP6PabA"
  ]
]);

$s3->registerStreamWrapper();

$dev             = false;
$player_mode     = $data["Lesson"]['lesson_player_mode']; // all | step | single
$mode            = "lesson";
$id              = $data["Lesson"]['lesson_id'];
$student         = engine::student("id");
$current_course  = $data["Lesson"]['lesson_code'];

if($mode == "lesson")
{
  $url = 'lesson/course/' . $id . "/" . $student;
  //---------------- get data -----------------//
  $course = engine::api("GET", $url);

  $data["Course"]	          = $course['course']['table'];
  $data["Course-complete"]	= $course['course']['complete'];
  $data["Course-count"]	    = $course['course']['count'];
  $data["Document"]	        = $course['course']['document'];
  $data["Quiz"]	            = $course['course']['quiz'];
  $data["Quiz_status"]	    = $course['course']['quiz_status'];
  $data["Permission"]	      = $course['course']['permission'];
  $data["PlayerCounter"]	  = $course['course']['player_counter'];

  $url2 = 'lesson/skipcourse/' . $id;
  //---------------- get data -----------------//
  $skip = engine::api("GET", $url2);
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
  $url = 'lesson/subcourse/' . $id;
  //---------------- get data -----------------//
  $course = engine::api("GET", $url);
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
$percent = intval( $percent * 100 ) / 100;
$course_status_complete['total']    = $data["Course-count"];
$course_status_complete['current']  = $data["Course-complete"];
$course_status_complete['percent']  = $percent;
//print_r($data["Quiz_status"]);

// Player Time
$myArray        = explode(':', $data["Player"]['player_current']);
$m              = $myArray[0];
$s              = $myArray[1];
$second         = ($m*60) + $s;

// Resume Time
$H              = floor($second / 3600);
$i              = ($second / 60) % 60;
$s              = $second % 60;
$resumeTime     = sprintf("%02d:%02d:%02d", $H, $i, $s);

// Data Course inc
$course_count   = count($data["Course"]);
$current        = $data["Topic"]['course_id'];
//$current        = "13";
$key            = array_search($current, array_column($data["Course"], 'course_id'));
$next           = $data["Course"][($key+1)]['course_id'];
$state          = (($key+1) == $course_count) ? "last" : "inner";
$area           = ($key == ""|| $key == NULL) ? "outside" : "inside";
$first          = $data["Course"][($key+1)]['topic'][0]['topic_id'];

$first_token    = $data["Course"][($key+1)]['topic'][0]['topic_code'];
$first_player   = $data["Course"][($key+1)]['topic'][0]['topic_player_finish'];
$prev           = $data["Course"][($key-1)]['course_id'];

$count_current_topic    = count($data["Course"][$key]['topic']);
$count_prev_topic       = count($data["Course"][($key-1)]['topic']);

//print_r($data["Course"][($key-1)]['topic']);

$first_current      = $data["Course"][$key]['topic'][0]['topic_id'];
$last_current       = $data["Course"][$key]['topic'][($count_current_topic-1)]['topic_id'];
$last_prev          = $data["Course"][($key-1)]['topic'][($count_prev_topic-1)]['topic_id'];
$last_prev_token    = $data["Course"][($key-1)]['topic'][($count_prev_topic-1)]['topic_code'];
$last_prev_player   = $data["Course"][($key-1)]['topic'][($count_prev_topic-1)]['topic_player_finish'];

//echo "First Topic</br>";
//print_r($data["Course"][($key+1)]['topic'][0]);

// Data Topic inc
$topic_count        = count($data["Course"][$key]['topic']);
$topic_current      = $data["Topic"]['topic_id'];
$topic_key          = array_search($topic_current, array_column($data["Course"][$key]['topic'], 'topic_id'));
$topic_next         = $data["Course"][$key]['topic'][($topic_key+1)]['topic_id'];

$topic_next_token   = $data["Course"][$key]['topic'][($topic_key+1)]['topic_code'];
$topic_next_player  = $data["Course"][$key]['topic'][($topic_key+1)]['topic_player_finish'];
$topic_state        = (($topic_key+1) == $topic_count) ? "last" : "inner";
$topic_area         = ($topic_key == ""|| $topic_key == NULL) ? "outside" : "inside";

$topic_prev         = $data["Course"][$key]['topic'][($topic_key-1)]['topic_id'];
$topic_prev_token   = $data["Course"][$key]['topic'][($topic_key-1)]['topic_code'];
$topic_prev_status  = $data["Course"][$key]['topic'][($topic_key-1)]['topic_player_finish'];
$topic_prev_check   = ($topic_prev == ""|| $topic_prev == NULL) ? "outside" : "inside";

if($topic_prev_check=="outside" && $prev=="")
{
  $prev_course        = "first";
  $prev_topic         = $first_current;
  $isPlay             = "1";
}
if($topic_prev_check=="outside" && $prev!="")
{
  $prev_course        = $prev;
  $prev_topic         = $last_prev;
  $prev_topic_token   = $last_prev_token;
  $isPlay             = $last_prev_player;
  $prev_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course . "/" . $prev_topic_token;
}
else if($topic_prev_check=="inside")
{
  $prev_course        = $current;
  $prev_topic         = $topic_prev;
  $prev_topic_token   = $topic_prev_token;
  $isPlay             = $topic_prev_status;
  $prev_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course . "/" . $prev_topic_token;
}

// Data Next Topic inc
if($state=="inner" && $topic_state=="inner")
{
  $next_course        = $current;
  $next_topic         = $topic_next;
  $next_topic_token   = $topic_next_token;
  $next_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course . "/" . $next_topic_token;
}
else if($state=="inner" && $topic_state=="last")
{
  $next_course        = $next;
  $next_topic         = $first;
  $next_topic_token   = $first_token;
  $next_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course . "/" . $next_topic_token;
}
else if($state=="last" && $topic_state=="last")
{
  $next_course        = "Final";
  $next_topic         = "Final";
  $next_topic_token   = "Final";
  $next_url           = $GLOBALS["School"]['website'] . "course/detail/" . $current_course;
}

if($player_mode=="step")
{
  // Media Source
  if($isPlay=="1")
  {
    if($data["Topic"]['topic_id'] == "41")
    {
      $media_source   = $data["Topic"]['topic_video'];
    }
    else
    {
      $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
    }

    //$poster_source  = $course['course']['endpoint'] . $data["Topic"]['topic_poster'];
    $poster_source  = $course['course']['endpoint'] . $data["Lesson"]['lesson_cover'];
  }
  else
  {
    $media_source   = "";
    $poster_source  = "";
  }
}
else if($player_mode=="all")
{
  if($data["Topic"]['topic_id'] == "41")
  {
    $media_source   = $data["Topic"]['topic_video'];
  }
  else
  {
    $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
  }
  //$poster_source  = $course['course']['endpoint'] . $data["Topic"]['topic_poster'];
  $poster_source  = $course['course']['endpoint'] . $data["Lesson"]['lesson_cover'];
}
$home_url = "course/detail/" . $data["Lesson"]['lesson_code'];

// Message Data
$message_count = count($data["Topic"]['message']);


// **********************************************
// CERTIFICATE

$cert_complete  = $course_status_complete['percent'];
$cert_type      = $data["Lesson"]['lesson_cert_type'];
$cert_mode      = $data["Lesson"]['lesson_cert_mode'];
$cert_price     = $data["Lesson"]['lesson_cert_price'];

if($cert_type=="none")
{
  $cert_status_text = "หลักสูตรนี้ไม่มีใบรับรอง";
  $cert_status      = "hidden";
  $cert_link        = "page('none');";
}
else if($cert_type=="end")
{
  if($cert_complete=="100")
  {
    if($cert_mode=="free")
    {
      $cert_status_text = "สามารถรับใบรับรองได้ฟรีไม่มีค่าใช้จ่าย";
      $cert_cover       = "https://fti-central.s3.ap-southeast-1.amazonaws.com/16056234521974775930.jpg";
      $cert_status      = "active";
      if($data["Certification"]['stu_cert_id']==""||$data["Certification"]['stu_cert_id']==NULL)
      {
        $cert_link = "genetareCert('{$data["Lesson"]['lesson_token']}');";
      }
      else
      {
        $cert_link = "page('certification/show/{$data["Certification"]['stu_cert_token']}','new');";
      }
    }
    else if($cert_mode=="paid")
    {
      $cert_status_text = "สามารถรับใบรับรองได้ ในราคา {$cert_price} บาท";
      $cert_cover       = "https://fti-central.s3.ap-southeast-1.amazonaws.com/16056234521974775930.jpg";
      $cert_status      = "active";
      $cert_link        = "paidCert('{$data["Lesson"]['lesson_token']}');";
    }
  }
  else
  {
    $cert_status_text   = "หลักสูตรนี้ต้องเรียนจบก่อนถึงรับใบรับรองได้";
    $cert_status        = "unactive";
    $cert_link          = "page('none');";
  }
}
else if($cert_type=="open")
{
  $cert_status_text = "หลักสูตรนี้สามารถรับใบรับรองได้ตลอดเวลา";
  $cert_status      = "active";
  if($data["Certification"]['stu_cert_id']==""||$data["Certification"]['stu_cert_id']==NULL)
  {
    $cert_link = "genetareCert('{$data["Lesson"]['lesson_token']}');";
  }
  else
  {
    $cert_link = "page('certification/show/{$data["Certification"]['stu_cert_token']}','new');";
  }
}

// **********************************************
// CERTIFICATE


// Echo Data
if($dev)
{
  echo "<pre>";

  echo "----------- <strong>เนื้อหา</strong> ----------- </br>";
  echo "Count : " . $course_count . "</br>";
  echo "Next Course id : " . $next . "</br>";
  echo "Prev Course id : " . $prev . "</br>";
  echo "Current Course id : " . $current . "</br>";
  echo "Course id index : " . $key . "</br>";
  echo "Course id Next : " . ($key+1) . "</br>";
  echo "Array State : " . $state . "</br>";
  echo "Array Area : " . $area . "</br>";
  echo "Next First Topic : " . $first . "</br>";
  echo "Next First Topic Token : " . $first_token . "</br>";
  echo "Next First Topic Player : " . $first_player . "</br>";
  echo "Last Topic : " . $last_current . "</br>";

  echo "----------- <strong>บทเรียน</strong> ----------- </br>";
  echo "Topic Count : " . $topic_count . "</br>";
  echo "Current Topic : " . $topic_current . "</br>";
  echo "Current Topic Index : " . $topic_key . "</br>";
  echo "Topic Next : " . $topic_next . "</br>";
  echo "Topic Prev : " . $topic_prev . "</br>";
  echo "Topic Prev Check : " . $topic_prev_check . "</br>";
  echo "Topic Prev Status : " . $topic_prev_status . "</br>";
  echo "Topic Array State : " . $topic_state . "</br>";
  echo "Topic Array Area : " . $topic_area . "</br>";

  echo "----------- <strong>บทเรียนก่อนหน้า</strong> ----------- </br>";
  echo "Prev Course : " . $prev_course . "</br>";
  echo "Prev Topic : " . $prev_topic . "</br>";
  echo "Prev URL : <a href='" . $prev_url . "'>บทเรียนก่อนหน้า</a></br>";
  echo "Topic Can Play : " . $isPlay . "</br>";

  echo "----------- <strong>บทเรียนถัดไป</strong> ----------- </br>";
  echo "Next Stage : " . $state . "-" . $current_course . "</br>";
  echo "Next Course : " . $next_course . "</br>";
  echo "Next Course Code : " . $next_course . "</br>";
  echo "Next Topic : " . $next_topic . "</br>";
  echo "Next Topic Token : " . $next_topic_token . "</br>";
  echo "Next URL : <a href='" . $next_url . "'>บทเรียนต่อไป</a></br>";

  // Media Source
  echo "Media URL : " . $media_source . "</br>";
  echo "Poster URL : " . $poster_source . "</br>";

  //echo "Topic</br>";
  //print_r($data["Course"][$key]['topic']);

  // print_r();
  //print_r($data["Course"]);

  print_r($data["Topic"]);
  print_r($data["Permission"]);
  print_r($data["PlayerCounter"]);
  print_r($data["Lesson"]['player']);

  echo "----------- <strong>TOPIC STEP</strong> ----------- </br>";
  echo "Key Before : " . $key2 . "</br>";
  echo "Before : " . $before . "</br>";
  echo "Before Stage : " . $before_stage . "</br>";
  echo "Before Stage ID : " . $before_stage_id . "</br>";
  echo "Before Stage Player : " . $before_stage_player . "</br>";

  echo "</pre>";

}

?>

<!--===================================== START HEADER AREA ======================================-->

<input type="hidden" id="topiccode" value="<?php echo $data["Player"]['player_code'];?>">
<input type="hidden" id="topiclastplay" value="<?php echo $second;?>">

<section class="header-menu-area course-dashboard-header">
    <div class="header-menu-fluid">
        <div class="header-menu-content course-dashboard-menu-content">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="logo-box">
                        <a href="home" class="logo" title="Aduca"><img src="theme/interface/aduca/assets/images/logo-player.png" alt="logo"></a>
                    </div>
                    <div class="course-dashboard-title">
                        <a href="course/detail/<?php echo $data["Lesson"]['lesson_code'];?>">คอร์ส <?php echo $data["Lesson"]['lesson_name'];?></a>
                      </br><span class="text-warning"><i>เรื่อง : <?php echo $data["Topic"]['topic_name'];?> <small>(<?php echo $resumeTime;?>)</small></i></span>
                    </div>
                    <div class="menu-wrapper">
                        <div class="logo-right-button">
                            <ul class="d-flex align-items-center">
                                <li><a href="course/detail/<?php echo $data["Lesson"]['lesson_code'];?>" class="theme-btn theme-btn-light"><i class="la la-home mr-1"></i>ย้อนกลับ</a></li>
                                <li><a href="#" class="theme-btn theme-btn-light" data-toggle="modal" data-target=".rating-modal-form"><i class="la la-star mr-1"></i>ให้คะแนน</a></li>
                                <!-- <li><a href="#" class="theme-btn theme-btn-light" data-toggle="modal" data-target=".share-modal-form"><i class="la la-share mr-1"></i>บทเรียน</a></li> -->
                                <!-- <li>
                                    <div class="msg-action-dot">
                                        <div class="dropdown">
                                            <a class="action-dot" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="la la-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li><a class="dropdown-item" href="#">ถูกใจหลักสูตรนี้</a></li>
                                                    <li><a class="dropdown-item" href="#">เรียนหลักสูตรนี้จบแล้ว</a></li>
                                                    <li><a class="dropdown-item" href="#">ส่งหลักสูตรนี้ให่เพื่อน</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->
                            </ul>
                        </div><!-- end logo-right-button -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </div><!-- end header-menu-fluid -->
</section><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->

<!--======================================
        START COURSE-DASHBOARD
======================================-->
<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column">
                <div class="lecture-viewer-container">
                    <div class="lecture-video-item">

                      <!-- Player -->
                      <?php engine::html("theme","css","player/start/content/global.css");?>
                      <?php engine::html("theme","js","player/start/java/FWDEVPlayer.js");?>

                      <!-- Setup EVP -->
                  		<script type="text/javascript">

                  			FWDEVPUtils.onReady(function()
                        {
                  				FWDEVPlayer.videoStartBehaviour = "play";
                  				new FWDEVPlayer(
                          {
                  					//main settings
                  					instanceName:"mplayer",
                  					parentId:"avPlayer",
                  					mainFolderPath:"theme/interface/aduca/assets/player/start/content",
                  					initializeOnlyWhenVisible:"no",
                  					skinPath:"minimal_skin_dark",
                  					displayType:"responsive",
                  					fillEntireVideoScreen:"no",
                  					playsinline:"yes",
                  					useWithoutVideoScreen:"no",
                  					autoScale:"yes",
                  					openDownloadLinkOnMobile:"no",
                  					useVectorIcons:"no",
                  					useResumeOnPlay:"no",
                  					goFullScreenOnButtonPlay:"no",
                  					useHEXColorsForSkin:"no",
                  					normalHEXButtonsColor:"#FF0000",
                  					privateVideoPassword:"428c841430ea18a70f7b06525d4b748a",
                  					startAtTime:"",
                  					stopAtTime:"",
                  					startAtVideoSource:1,
                  					videoSource:[{source:"<?php echo $media_source;?>", label:"HD"}],
                  					posterPath:"<?php echo $poster_source;?>",
                  					showErrorInfo:"yes",
                  					fillEntireScreenWithPoster:"yes",
                  					disableDoubleClickFullscreen:"no",
                  					addKeyboardSupport:"no",
                  					useChromeless:"no",
                  					showPreloader:"yes",
                  					preloaderColors:["#2e3092", "#ed1c24"],
                  					autoPlay:"no",
                  					autoPlayText:"Click to Unmute",
                  					loop:"no",
                  					scrubAtTimeAtFirstPlay:"00:00:00",
                  					maxWidth:1440,
                  					maxHeight:800,
                  					volume:100,
                  					greenScreenTolerance:200,
                  					backgroundColor:"#000000",
                  					posterBackgroundColor:"#000000",
                  					//lightbox settings
                  					closeLightBoxWhenPlayComplete:"no",
                  					lightBoxBackgroundOpacity:.6,
                  					lightBoxBackgroundColor:"#000000",
                  					//logo settings
                  					showLogo:"yes",
                  					hideLogoWithController:"yes",
                  					logoPosition:"bottomRight",
                            logoLink:"<?php echo $GLOBALS["School"]['website'];?>",
                      			logoPath:"theme/interface/aduca/assets/player/player-logo.png",
                  					logoMargins:50,
                  					//controller settings
                  					showController:"yes",
                  					showDefaultControllerForVimeo:"no",
                  					showScrubberWhenControllerIsHidden:"yes",
                  					showControllerWhenVideoIsStopped:"yes",
                  					showVolumeScrubber:"yes",
                  					showVolumeButton:"yes",
                  					showTime:"yes",
                  					showRewindButton:"no",
                  					showQualityButton:"no",
                  					showShareButton:"no",
                            showEmbedButton:"no",
                  					showDownloadButton:"no",
                  					showMainScrubberToolTipLabel:"yes",
                  					showChromecastButton:"no",
                  					showFullScreenButton:"yes",
                  					repeatBackground:"yes",
                  					controllerHeight:41,
                  					controllerHideDelay:3,
                  					startSpaceBetweenButtons:7,
                  					spaceBetweenButtons:9,
                  					mainScrubberOffestTop:14,
                  					scrubbersOffsetWidth:4,
                  					timeOffsetLeftWidth:5,
                  					timeOffsetRightWidth:3,
                  					volumeScrubberWidth:80,
                  					volumeScrubberOffsetRightWidth:0,
                  					timeColor:"#777777",
                  					youtubeQualityButtonNormalColor:"#777777",
                  					youtubeQualityButtonSelectedColor:"#FFFFFF",
                  					scrubbersToolTipLabelBackgroundColor:"#FFFFFF",
                  					scrubbersToolTipLabelFontColor:"#5a5a5a",
                  					//redirect at video end
                  					redirectURL:"",
                  					redirectTarget:"_self",
                  					//cuepoints
                  					executeCuepointsOnlyOnce:"no",
                  					cuepoints:[],
                  					//annotations
                  					annotiationsListId:"none",
                  					showAnnotationsPositionTool:"no",

                  					//audio visualizer
                  					audioVisualizerLinesColor:"#0099FF",
                  					audioVisualizerCircleColor:"#FFFFFF",
                  					//advertisement on pause window
                  					aopwTitle:"Advertisement",
                  					aopwSource:"",
                  					aopwWidth:400,
                  					aopwHeight:240,
                  					aopwBorderSize:6,
                  					aopwTitleColor:"#FFFFFF",
                  					//playback rate / speed
                  					showPlaybackRateButton:"yes",
                  					defaultPlaybackRate:"1", //0.25, 0.5, 1, 1.25, 1.5, 2
                  					//sticky on scroll
                  					stickyOnScroll:"yes",
                  					stickyOnScrollShowOpener:"yes",
                  					stickyOnScrollWidth:"450",
                  					stickyOnScrollHeight:"250",
                  					//sticky display settings
                  					showOpener:"yes",
                  					showOpenerPlayPauseButton:"yes",
                  					verticalPosition:"bottom",
                  					horizontalPosition:"center",
                  					showPlayerByDefault:"yes",
                  					animatePlayer:"yes",
                  					openerAlignment:"right",
                  					mainBackgroundImagePath:"theme/aduca/assets/player/start/content/minimal_skin_dark/main-background.png",
                  					openerEqulizerOffsetTop:-1,
                  					openerEqulizerOffsetLeft:3,
                  					offsetX:0,
                  					offsetY:0,
                  					//embed window
                  					embedWindowCloseButtonMargins:15,
                  					borderColor:"#333333",
                  					mainLabelsColor:"#FFFFFF",
                  					secondaryLabelsColor:"#a1a1a1",
                  					shareAndEmbedTextColor:"#5a5a5a",
                  					inputBackgroundColor:"#000000",
                  					inputColor:"#FFFFFF",
                  					//ads
                  					openNewPageAtTheEndOfTheAds:"no",
                  					adsSource:[],
                  					adsButtonsPosition:"right",
                  					skipToVideoText:"You can skip to video in: ",
                  					skipToVideoButtonText:"Skip Ad",
                  					timeToHoldAds:4,
                  					adsTextNormalColor:"#999999",
                  					adsTextSelectedColor:"#FFFFFF",
                  					adsBorderNormalColor:"#666666",
                  					adsBorderSelectedColor:"#FFFFFF",
                  					//a to b loop
                  					useAToB:"no",
                  					atbTimeBackgroundColor:"transparent",
                  					atbTimeTextColorNormal:"#888888",
                  					atbTimeTextColorSelected:"#FFFFFF",
                  					atbButtonTextNormalColor:"#888888",
                  					atbButtonTextSelectedColor:"#FFFFFF",
                  					atbButtonBackgroundNormalColor:"#FFFFFF",
                  					atbButtonBackgroundSelectedColor:"#000000",
                  					//thumbnails preview
                  					thumbnailsPreview:"auto",
                  					thumbnailsPreviewWidth:196,
                  					thumbnailsPreviewHeight:110,
                  					thumbnailsPreviewBackgroundColor:"#000000",
                  					thumbnailsPreviewBorderColor:"#666",
                  					thumbnailsPreviewLabelBackgroundColor:"#666",
                  					thumbnailsPreviewLabelFontColor:"#FFF",
                            // context menu
                  					contextMenuType:'none',
                  					showScriptDeveloper:"no",
                  					contextMenuBackgroundColor:"#1f1f1f",
                  					contextMenuBorderColor:"#1f1f1f",
                  					contextMenuSpacerColor:"#333",
                  					contextMenuItemNormalColor:"#888888",
                  					contextMenuItemSelectedColor:"#FFFFFF",
                  					contextMenuItemDisabledColor:"#444",
                            //annotations
                  					annotiationsListId:"fwdAnnotations",
                            showAnnotationsPositionTool:"no",
                  				});
                          registerAPI();
                  			});

                        //Register API (an setInterval is required because the player is not available until the youtube API is loaded).
                        var timer = 0;
                      	var count = 36000000
                  			var registerAPIInterval;

                  			function registerAPI()
                        {
                  				clearInterval(registerAPIInterval);
                  				if(window.mplayer)
                          {
                  					mplayer.addListener(FWDEVPlayer.READY, readyHandler);
                  					mplayer.addListener(FWDEVPlayer.PLAY, playHandler);
                  					mplayer.addListener(FWDEVPlayer.PAUSE, pauseHandler);
                  					mplayer.addListener(FWDEVPlayer.STOP, stopHandler);
                            mplayer.addListener(FWDEVPlayer.UPDATE_TIME, updateTimeHandler);
                            mplayer.addListener(FWDEVPlayer.UPDATE_TIME, getCurrentTimer);
                  					//mplayer.addListener(FWDEVPlayer.UPDATE_VIDEO_SOURCE, updateVideoSourceHandler);
                  					//mplayer.addListener(FWDEVPlayer.UPDATE_POSTER_SOURCE, updatePosterSourceHandler);
                  				}
                          else
                          {
                  					registerAPIInterval = setInterval(registerAPI, 100);
                  				}
                  			};

                  			//API event listeners examples
                  			function readyHandler(e)
                        {
                  				console.log("API -- ready to use");
                          playResume();
                  			}

                  			function playHandler(e)
                        {
                  				console.log("API -- play");
                  			}

                  			function pauseHandler(e)
                        {
                  				console.log("API -- pause");
                  			}

                  			function stopHandler(e)
                        {
                  				console.log("API -- stop");

                          $.ajax(
                      		{
                      			type : "POST",
                      			url : "player/action/stop",
                      			dataType : "json",
                      			success : function(response)
                      			{
                      				status 	= response.status
                              msg 	  = response.return
                      				//-----------------------
                      				if(status==="true")
                      				{
                                $.prompt(msg, {
                                	title: "แจ้งเตือนการเรียน",
                                	buttons: { "บทเรียนถัดไป": "next", "ประเมินผู้สอน": "rating", "ย้อนกลับ": "back" },
                                	submit: function(e,v,m,f)
                                  {
                                		// use e.preventDefault() to prevent closing when needed or return false.
                                		// e.preventDefault();
                                    if(v==="next")
                                    {
                                      location.href='<?php echo $next_url;?>';
                                    }
                                    else if(v==="rating")
                                    {
                                      ratingVideo();
                                    }
                                    else if(v==="back")
                                    {
                                      location.href='<?php echo $home_url;?>';
                                    }
                                		console.log("Value clicked was: "+ v);
                                	}
                                });

                                /*
                                $.prompt(msg,
                        				{
                        					title		: "แจ้งเตือนการเรียน",
                        					buttons	: {"ตกลง":true},
                        					submit	: function(e,v,m,f)
                        					{
                                    console.log("Back");
                                    location.href='<?php echo $next_url;?>';
                        					}
                        				});
                                */

                      				}
                      			}
                      		});
                  			}

                  			function updateVideoSourceHandler(e)
                        {
                  				console.log("API -- video source update: " + mplayer.getVideoSource());
                  			}

                  			function updatePosterSourceHandler(e)
                        {
                  				console.log("API -- video source update: " + mplayer.getPosterSource());
                  			}

                  			//API methods examples
                  			function play()
                        {
                  				mplayer.play();
                  			}

                  			function pause()
                        {
                  				mplayer.pause();
                  			}

                  			function stop()
                        {
                  				mplayer.stop();
                  			}

                  			function scrub(percent)
                        {
                  				mplayer.scrub(percent);
                  			}

                  			function setVolume(percent)
                        {
                  				mplayer.setVolume(percent);
                  			}

                  			function goFullScreen()
                        {
                  				mplayer.goFullScreen();
                  			}

                        function getCurrentTimer(e)
                      	{
                      		return e.currentTime;
                          console.log("API -- stop");
                      	}

                        function updateTimeHandler(e)
                      	{
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
                            $('#post_topic_timer').val(e.currentTime);
                      		}
                          console.log("API -- update time: " + e.currentTime + "/" + e.totalTime);
                      	}

                        function playResume()
                      	{
                      		time = $('#topiclastplay').val();
                      		mplayer.scrubbAtTime(time);
                          mplayer.play();
                          console.log("Resume : " + time);
                      	}

                        function updatetimer(time)
                      	{
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
                              console.log(status);
                      				$('.number').html(time);
                      				if(status==="false")
                      				{
                      					//mplayer.stop();
                      				}
                              else
                              {
                                //mplayer.play();
                              }
                      			}
                      		});
                          console.log("time " + time);
                      	}

                        $(window).bind('beforeunload', function()
                        {
                          mplayer.pause();
                        });


                        function ratingVideo(video,v_name)
                        {
                          $('.rating-modal-form').modal('show');
                          $('.rating-modal-form').on('hidden.bs.modal', function ()
                          {
                            $.prompt("ให้คะแนนเสร็จแล้ว คุณต้องการที่จะทำอะไรต่อ ?", {
                              title: "แจ้งเตือนการเรียน",
                              buttons: { "บทเรียนถัดไป": "next", "ย้อนกลับ": "back" },
                              submit: function(e,v,m,f)
                              {
                                // use e.preventDefault() to prevent closing when needed or return false.
                                // e.preventDefault();
                                if(v==="next")
                                {
                                  location.href='<?php echo $next_url;?>';
                                }
                                else if(v==="back")
                                {
                                  location.href='<?php echo $home_url;?>';
                                }
                              }
                            });
                          })

                          $('.rating-modal-form').on('shown.bs.modal', function ()
                          {
                          })

                        }

                  		</script>

                      <div id="avPlayer"></div>

                      <?php

                      //print_r($data["Lesson"]['player']['player_total']);

                      $seconds   = $data["Lesson"]['player']['player_total'];
                      $section   = $seconds/4;
                      $delay     = "15";
                      $section_1 = "0";
                      $section_2 = $section;
                      $section_3 = $section_2+$section;
                      $section_4 = $section_3+$section;

                      //echo $section . "</br>";
                      //echo $section_1 . "</br>";
                      //echo $section_2 . "</br>";
                      //echo $section_3 . "</br>";
                      //echo $section_4 . "</br>";

                      $s0_timeFormat = "00:00:00";
                      $s0_timeFormat_end = sprintf('%02d:%02d:%02d', floor($seconds / 3600), floor($seconds / 60 % 60), floor($seconds % 60));

                      $s1_timeFormat = sprintf('%02d:%02d:%02d', floor($section_1 / 3600), floor($section_1 / 60 % 60), floor($section_1 % 60));
                      $s1_timeFormat_end = sprintf('%02d:%02d:%02d', floor(($section_1+$delay) / 3600), floor(($section_1+$delay) / 60 % 60), floor(($section_1+$delay) % 60));

                      $s2_timeFormat = sprintf('%02d:%02d:%02d', floor($section_2 / 3600), floor($section_2 / 60 % 60), floor($section_2 % 60));
                      $s2_timeFormat_end = sprintf('%02d:%02d:%02d', floor(($section_2+$delay) / 3600), floor(($section_2+$delay) / 60 % 60), floor(($section_2+$delay) % 60));

                      $s3_timeFormat = sprintf('%02d:%02d:%02d', floor($section_3 / 3600), floor($section_3 / 60 % 60), floor($section_3 % 60));
                      $s3_timeFormat_end = sprintf('%02d:%02d:%02d', floor(($section_3+$delay) / 3600), floor(($section_3+$delay) / 60 % 60), floor(($section_3+$delay) % 60));

                      $s4_timeFormat = sprintf('%02d:%02d:%02d', floor($section_4 / 3600), floor($section_4 / 60 % 60), floor($section_4 % 60));
                      $s4_timeFormat_end = sprintf('%02d:%02d:%02d', floor(($section_4+$delay) / 3600), floor(($section_4+$delay) / 60 % 60), floor(($section_4+$delay) % 60));

                      //echo $s1_timeFormat . "</br>";
                      //echo $s1_timeFormat_end . "</br>";

                      //echo $s2_timeFormat . "</br>";
                      //echo $s2_timeFormat_end . "</br>";

                      //echo $s3_timeFormat . "</br>";
                      //echo $s3_timeFormat_end . "</br>";

                      //echo $s4_timeFormat . "</br>";
                      //echo $s4_timeFormat_end . "</br>";

                      ?>

                      <?php if($data["Lesson"]['lesson_watermark']!="none"): ?>

                        <ul id="fwdAnnotations" style="display:none">
                          <?php if($data["Lesson"]['lesson_watermark']=="full"): ?>

                          <li data-start-time="<?php echo $s0_timeFormat;?>" data-end-time="<?php echo $s0_timeFormat_end;?>" data-left="0" data-top="0" data-show-close-button="no" data-click-source="" data-click-source-target="" data-normal-state-class="fwdevp-annotation-js-normal-edit" data-selected-state-class="fwdevp-annotation-js-selected">
                            <div><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://waterfootprint.fti.or.th/course/detail/<?php echo $data["Lesson"]['lesson_code'];?>?lesson_token=<?php echo $data["Lesson"]['player']['player_code'];?>" title="Course Detail" style="width: 90px; height: 90px; margin: 0px;"/></div>
                          </li>

                          <?php else: ?>

                          <li data-start-time="<?php echo $s1_timeFormat;?>" data-end-time="<?php echo $s1_timeFormat_end;?>" data-left="0" data-top="0" data-show-close-button="no" data-click-source="" data-click-source-target="" data-normal-state-class="fwdevp-annotation-js-normal-edit" data-selected-state-class="fwdevp-annotation-js-selected">
                            <div><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://waterfootprint.fti.or.th/course/detail/<?php echo $data["Lesson"]['lesson_code'];?>?lesson_token=<?php echo $data["Lesson"]['player']['player_code'];?>" title="Course Detail" style="width: 90px; height: 90px; margin: 0px;"/></div>
                          </li>

                          <li data-start-time="<?php echo $s2_timeFormat;?>" data-end-time="<?php echo $s2_timeFormat_end;?>" data-left="1200" data-top="0" data-show-close-button="no" data-click-source="" data-click-source-target="" data-normal-state-class="fwdevp-annotation-js-normal-edit" data-selected-state-class="fwdevp-annotation-js-selected">
                            <div><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://waterfootprint.fti.or.th/course/detail/<?php echo $data["Lesson"]['lesson_code'];?>?lesson_token=<?php echo $data["Lesson"]['player']['player_code'];?>" title="Course Detail" style="width: 90px; height: 90px; margin: 0px;"/></div>
                          </li>

                          <li data-start-time="<?php echo $s3_timeFormat;?>" data-end-time="<?php echo $s3_timeFormat_end;?>" data-left="0" data-top="700" data-show-close-button="no" data-click-source="" data-click-source-target="" data-normal-state-class="fwdevp-annotation-js-normal-edit" data-selected-state-class="fwdevp-annotation-js-selected">
                            <div><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://waterfootprint.fti.or.th/course/detail/<?php echo $data["Lesson"]['lesson_code'];?>?lesson_token=<?php echo $data["Lesson"]['player']['player_code'];?>" title="Course Detail" style="width: 90px; height: 90px; margin: 0px;"/></div>
                          </li>

                          <li data-start-time="<?php echo $s4_timeFormat;?>" data-end-time="<?php echo $s4_timeFormat_end;?>" data-left="1200" data-top="700" data-show-close-button="no" data-click-source="" data-click-source-target="" data-normal-state-class="fwdevp-annotation-js-normal-edit" data-selected-state-class="fwdevp-annotation-js-selected">
                            <div><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://waterfootprint.fti.or.th/course/detail/<?php echo $data["Lesson"]['lesson_code'];?>?lesson_token=<?php echo $data["Lesson"]['player']['player_code'];?>" title="Course Detail" style="width: 90px; height: 90px; margin: 0px;"/></div>
                          </li>

                          <?php endif; ?>
                        </ul>

                      <?php endif; ?>

                    </div>

                </div><!-- end lecture-viewer-container -->
                <div class="lecture-video-detail">
                    <div class="lecture-tab-body">
                        <div class="section-tab section-tab-2">
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <a href="javascript:void(0)" class="search-form-btn">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>
                                <li role="presentation" class="mobile-course-tab-2">
                                    <a href="course/play/<?php echo $data["Lesson"]['lesson_code'];?>/<?php echo $data["Topic"]['topic_code'];?>/course" aria-selected="false" class="<?php echo ($data["Pager"]['active_tab'] == "course") ? "active" : "";?>">
                                        เนื้อหาในหลักสูตร
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="course/play/<?php echo $data["Lesson"]['lesson_code'];?>/<?php echo $data["Topic"]['topic_code'];?>/detail" aria-selected="true" class="<?php echo ($data["Pager"]['active_tab'] == "detail") ? "active" : "";?>">
                                        คำอธิบายรายวิขา
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="course/play/<?php echo $data["Lesson"]['lesson_code'];?>/<?php echo $data["Topic"]['topic_code'];?>/message" aria-selected="false" class="<?php echo ($data["Pager"]['active_tab'] == "message") ? "active" : "";?>">
                                        ถาม-ตอบ <span class="badge badge-danger"><?php echo $message_count;?></span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="course/play/<?php echo $data["Lesson"]['lesson_code'];?>/<?php echo $data["Topic"]['topic_code'];?>/announce"  aria-selected="false" class="<?php echo ($data["Pager"]['active_tab'] == "announce") ? "active" : "";?>">
                                        ประกาศ
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="search-course-form">
                            <div class="contact-form-action">
                                <form action="post">
                                    <div class="form-group mb-0">
                                        <span class="la la-search input-icon"></span>
                                        <input class="form-control" type="text" name="search" placeholder="ค้นหาเนื้อหาหลักสูตร">
                                        <span class="la la-times search-close-icon"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="lecture-video-detail-body">
                        <div class="tab-content">
                            <div role="tabpanel" id="course-content" class="<?php echo ($data["Pager"]['active_tab'] == "course") ? "tab-pane fade active show" : "tab-pane fade";?>">
                                <div class="mobile-course-content-wrap">
                                    <div class="mobile-course-menu">
                                        <div class="course-dashboard-side-content">
                                            <div class="accordion course-item-list-accordion" id="mobileCourseMenu">

                                                <?php

                                                foreach ($data["Course"] as $Course)
                                                {
                                                  $show_bg    = ($data["Topic"]['course_id']==$Course['course_id']) ? "bg-lastplay" : "";
                                                  $show_arrow = ($data["Topic"]['course_id']==$Course['course_id']) ? "true" : "false";
                                                  $show       = ($data["Topic"]['course_id']==$Course['course_id']) ? "show" : "";
                                                  $main ++;

                                                  echo
                                                  "<div class='card'>
                                                        <div class='card-header {$show_bg}' id='mobile-course-menu-{$Course['course_id']}'>
                                                            <h2 class='mb-0'>
                                                                <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#mobile-topic-table-{$Course['course_id']}' aria-expanded='{$show_arrow}' aria-controls='mobile-topic-table-{$Course['course_id']}'>
                                                                    <span class='widget-title font-size-15 font-weight-semi-bold'>{$Course['course_name']}</span>
                                                                    <div class='course-duration'>
                                                                        <span>{$Course['topic_count']} ตอน</span>
                                                                        <span>{$Course['topic_duration']} ชม.</span>
                                                                    </div>
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id='mobile-topic-table-{$Course['course_id']}' class='collapse {$show}' aria-labelledby='mobile-course-menu-{$Course['course_id']}' data-parent='#mobileCourseMenu'>
                                                            <div class='card-body'>
                                                                <div class='course-content-list'>
                                                                    <ul class='course-list'>";

                                                                $sub = "1";

                                                                foreach ($Course['topic'] as $Topic)
                                                                {

                                                                  if($player_mode=="all")
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
                                                                      //echo $Course['course_id'] . "</br>";
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
                                                                      //echo $before_stage_id . "</br>";
                                                                    }

                                                                    if($before_stage=="first")
                                                                    {
                                                                      // Check Quiz before Exitst
                                                                      if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                                                                      {
                                                                        // Check Quiz before Status
                                                                        if($data["Quiz_status"]['before']['status']=="false")
                                                                        {
                                                                          $topic_icon     = "play-circle";
                                                                          $topic_text     = "bold";
                                                                          $topic_color    = "text-primary";
                                                                          $topic_percent  = "50";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                          $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                        else
                                                                        {
                                                                          if($Topic['topic_player_finish'] =="0")
                                                                          {
                                                                            $topic_icon     = "play-circle";
                                                                            $topic_text     = "bold";
                                                                            $topic_color    = "text-primary";
                                                                            $topic_percent  = "50";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                            $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                            $topic_option   = "topic-option-active";
                                                                          }
                                                                          else if($Topic['topic_player_finish'] =="1")
                                                                          {
                                                                            $topic_icon     = "check-circle";
                                                                            $topic_text     = "normal";
                                                                            $topic_color    = "text-success";
                                                                            $topic_percent  = "100";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                            $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                            $topic_option   = "topic-option-active";
                                                                          }
                                                                          else
                                                                          {
                                                                            $topic_icon     = "play-circle";
                                                                            $topic_text     = "bold";
                                                                            $topic_color    = "text-primary";
                                                                            $topic_percent  = "50";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                            $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                            $topic_option   = "topic-option-active";
                                                                          }
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        if($Topic['topic_player_finish'] =="0")
                                                                        {
                                                                          $topic_icon     = "play-circle";
                                                                          $topic_text     = "bold";
                                                                          $topic_color    = "text-primary";
                                                                          $topic_percent  = "50";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                          $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                        else if($Topic['topic_player_finish'] =="1")
                                                                        {
                                                                          $topic_icon     = "check-circle";
                                                                          $topic_text     = "normal";
                                                                          $topic_color    = "text-success";
                                                                          $topic_percent  = "100";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                          $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_icon     = "play-circle";
                                                                          $topic_text     = "bold";
                                                                          $topic_color    = "text-primary";
                                                                          $topic_percent  = "50";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                          $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                      }
                                                                    }
                                                                    else if($before_stage=="topic")
                                                                    {
                                                                      if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_option   = "topic-option-active";
                                                                        //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        if($Topic['topic_type']=="7")
                                                                        {
                                                                          $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_url  = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        }
                                                                      }
                                                                      else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                                                                      {
                                                                        $topic_icon     = "check-circle";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-success";
                                                                        $topic_percent  = "100";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                        $topic_option   = "topic-option-active";
                                                                        //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        if($Topic['topic_type']=="7")
                                                                        {
                                                                          $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_url  = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                    }
                                                                    else if($before_stage=="course")
                                                                    {
                                                                      if($before_stage_player=="1" && $Course['player_complete'] =="0")
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                      else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                                                                      {
                                                                        $topic_icon     = "check-circle";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-success";
                                                                        $topic_percent  = "100";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                        $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                      else
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                    }

                                                                    $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                                                                    if($total_player_time>"100")
                                                                    {
                                                                      $total_player_time ="100";
                                                                    }

                                                                    if($Topic['topic_type']=="7")
                                                                    {
                                                                      $topic_title  = "
                                                                      <div class='course-item-content'>
                                                                          <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['contest']['contest_name']}</h4>
                                                                          <div class='courser-item-meta-wrap'>
                                                                              <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['contest']['contest_choice']} ข้อ</p>
                                                                          </div>
                                                                      </div>
                                                                      ";
                                                                    }
                                                                    else
                                                                    {
                                                                      $topic_title  = "
                                                                      <div class='course-item-content'>
                                                                          <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['topic_name']}</h4>
                                                                          <div class='courser-item-meta-wrap'>
                                                                              <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['topic_duration']}</p>
                                                                          </div>
                                                                      </div>
                                                                      ";
                                                                    }
                                                                  }
                                                                  else if($player_mode=="step")
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
                                                                      //echo $Course['course_id'] . "</br>";
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
                                                                      //echo $before_stage_id . "</br>";
                                                                    }

                                                                    if($before_stage=="first")
                                                                    {
                                                                      // Check Quiz before Exitst
                                                                      if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                                                                      {
                                                                        // Check Quiz before Status
                                                                        if($data["Quiz_status"]['before']['status']=="false")
                                                                        {
                                                                          $topic_icon     = "lock";
                                                                          $topic_text     = "normal";
                                                                          $topic_color    = "text-mute";
                                                                          $topic_percent  = "0";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                                          $topic_url      = "none";
                                                                          $topic_option   = "topic-option-unactive";
                                                                        }
                                                                        else
                                                                        {
                                                                          if($Topic['topic_player_finish'] =="0")
                                                                          {
                                                                            $topic_icon     = "play-circle";
                                                                            $topic_text     = "bold";
                                                                            $topic_color    = "text-primary";
                                                                            $topic_percent  = "50";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                            $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                            $topic_option   = "topic-option-active";
                                                                          }
                                                                          else if($Topic['topic_player_finish'] =="1")
                                                                          {
                                                                            $topic_icon     = "check-circle";
                                                                            $topic_text     = "normal";
                                                                            $topic_color    = "text-success";
                                                                            $topic_percent  = "100";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                            $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                            $topic_option   = "topic-option-active";
                                                                          }
                                                                          else
                                                                          {
                                                                            $topic_icon     = "lock";
                                                                            $topic_text     = "normal";
                                                                            $topic_color    = "text-mute";
                                                                            $topic_percent  = "0";
                                                                            $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                                            $topic_url      = "none";
                                                                            $topic_option   = "topic-option-unactive";
                                                                          }
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        if($Topic['topic_player_finish'] =="0")
                                                                        {
                                                                          $topic_icon     = "play-circle";
                                                                          $topic_text     = "bold";
                                                                          $topic_color    = "text-primary";
                                                                          $topic_percent  = "50";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                          $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                        else if($Topic['topic_player_finish'] =="1")
                                                                        {
                                                                          $topic_icon     = "check-circle";
                                                                          $topic_text     = "normal";
                                                                          $topic_color    = "text-success";
                                                                          $topic_percent  = "100";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                          $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                          $topic_option   = "topic-option-active";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_icon     = "lock";
                                                                          $topic_text     = "normal";
                                                                          $topic_color    = "text-mute";
                                                                          $topic_percent  = "0";
                                                                          $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                                          $topic_url      = "none";
                                                                          $topic_option   = "topic-option-unactive";
                                                                        }
                                                                      }
                                                                    }
                                                                    else if($before_stage=="topic")
                                                                    {
                                                                      if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_option   = "topic-option-active";
                                                                        //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        if($Topic['topic_type']=="7")
                                                                        {
                                                                          $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_url  = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        }
                                                                      }
                                                                      else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                                                                      {
                                                                        $topic_icon     = "check-circle";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-success";
                                                                        $topic_percent  = "100";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                        $topic_option   = "topic-option-active";
                                                                        //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        if($Topic['topic_type']=="7")
                                                                        {
                                                                          $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                                        }
                                                                        else
                                                                        {
                                                                          $topic_url  = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        $topic_icon     = "lock";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-mute";
                                                                        $topic_percent  = "0";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                                        $topic_url      = "none";
                                                                        $topic_option   = "topic-option-unactive";
                                                                      }
                                                                    }
                                                                    else if($before_stage=="course")
                                                                    {
                                                                      if($before_stage_player=="1" && $Course['player_complete'] =="0")
                                                                      {
                                                                        $topic_icon     = "play-circle";
                                                                        $topic_text     = "bold";
                                                                        $topic_color    = "text-primary";
                                                                        $topic_percent  = "50";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                                        $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                      else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                                                                      {
                                                                        $topic_icon     = "check-circle";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-success";
                                                                        $topic_percent  = "100";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                                        $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                                        $topic_option   = "topic-option-active";
                                                                      }
                                                                      else
                                                                      {
                                                                        $topic_icon     = "lock";
                                                                        $topic_text     = "normal";
                                                                        $topic_color    = "text-mute";
                                                                        $topic_percent  = "0";
                                                                        $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                                        $topic_url      = "none";
                                                                        $topic_option   = "topic-option-unactive";
                                                                      }
                                                                    }

                                                                    $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                                                                    if($total_player_time>"100")
                                                                    {
                                                                      $total_player_time ="100";
                                                                    }

                                                                    if($Topic['topic_type']=="7")
                                                                    {
                                                                      $topic_title  =
                                                                      "<div class='course-item-content'>
                                                                          <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['contest']['contest_name']}</h4>
                                                                          <div class='courser-item-meta-wrap'>
                                                                              <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['contest']['contest_choice']} ข้อ</p>
                                                                          </div>
                                                                      </div>";
                                                                    }
                                                                    else
                                                                    {
                                                                      $topic_title  =
                                                                      "<div class='course-item-content'>
                                                                          <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['topic_name']} ({$total_player_time}%)</h4>
                                                                          <div class='courser-item-meta-wrap'>
                                                                              <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['topic_duration']}</p>
                                                                          </div>
                                                                      </div>";
                                                                    }
                                                                  }

                                                                  $mobile_active = ($data["Topic"]['topic_id'] == $Topic['topic_id']) ? "active" : "";

                                                                  echo
                                                                  "<li class='course-item-link {$mobile_active}'>
                                                                      <div class='course-item-content-wrap' onclick='page(\"{$topic_url}\");'>
                                                                          {$topic_title}
                                                                      </div>
                                                                  </li>";

                                                                  $sub++;
                                                                }

                                                                echo
                                                                "</ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                                }

                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" id="overview" class="<?php echo ($data["Pager"]['active_tab'] == "detail") ? "tab-pane fade active show" : "tab-pane fade";?>">
                                <div class="lecture-overview-wrap">
                                    <div class="lecture-overview-item">
                                        <div class="lecture-heading">
                                            <h3 class="widget-title pb-2">คำอธิบายรายวิชา</h3>
                                            <p><?php echo $data["Lesson"]['lesson_detail'];?></p>

                                            <?php //print_r($_SESSION["School"]);?>
                                        </div>
                                    </div><!-- end lecture-overview-item -->

                                    <div class="section-block"></div>

                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="widget-title font-size-16">ใบรับรองการเรียน</h3>
                                            </div>
                                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                <ul class="list-items">
                                                    <li><?php echo $cert_status_text; ?></li>
                                                    <li><button class="theme-btn theme-btn-light mt-3 cert-<?php echo $cert_status;?>" onclick="<?php echo $cert_link;?>"><i class="fa fa-trophy"></i> F.T.I. Academy Certificate</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- end lecture-overview-item -->

                                    <div class="section-block"></div>

                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap d-flex ">
                                            <div class="lecture-overview-stats-item">
                                                <h3 class="widget-title font-size-16">วิทยากร</h3>
                                            </div>
                                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                <div class="lecture-owner-wrap d-flex align-items-center">
                                                    <!-- <div class="lecture-owner-avatar">
                                                        <img src="theme/aduca/assets/images/team9.jpg" alt="">
                                                    </div> -->
                                                    <div class="lecture-owner-title-wrap">
                                                        <!-- <h3 class="widget-title pb-1 font-size-18"><a href="instructor/detail/<?php echo $data["Teacher"]['teacher_code']?>" class="primary-color"><?php echo $data["Teacher"]['teacher_name']?></a></h3> -->
                                                        <h3 class="widget-title pb-1 font-size-18"><?php echo $data["Teacher"]['teacher_name']?></h3>
                                                        <p class="font-size-15"><?php echo $data["Teacher"]['teacher_detail']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end lecture-overview-item -->
                                </div><!-- end lecture-overview-wrap -->
                            </div><!-- end tab-pane -->

                            <div role="tabpanel" id="quest-and-ans" class="<?php echo ($data["Pager"]['active_tab'] == "message") ? "tab-pane fade active show" : "tab-pane fade";?>">
                                <div class="lecture-overview-wrap lecture-quest-wrap">

                                    <div class="new-question-wrap">
                                        <button class="theme-btn theme-btn-light back-to-question-btn"><i class="la la-reply mr-1"></i>ย้อนกลับ</button>
                                        <div class="new-question-body">
                                          <div class="question-replay-input-wrap">
                                              <div class="question-replay-body">
                                                  <div class="contact-form-action pt-4">

                                                      <form method="post" id="frm-add-message">

                                                          <input class="form-control" type="hidden" id="post_lesson" name="post_lesson" value="<?php echo $data["Lesson"]['lesson_id'];?>">
                                                          <input class="form-control" type="hidden" id="post_topic" name="post_topic" value="<?php echo $data["Topic"]['topic_id'];?>">
                                                          <input class="form-control" type="hidden" id="post_topic_timer" name="post_topic_timer" value="">

                                                          <div class="input-box">
                                                              <div class="replay-action-bar">
                                                                  <div class="btn-group">
                                                                      <button class="btn" type="button" data-toggle="modal" data-target=".insert-link-modal-form" title="Insert link"><i class="la la-link"></i></button>
                                                                      <button class="btn" type="button" data-toggle="modal" data-target=".upload-photo-modal-form" title="Upload an image"><i class="la la-photo"></i></button>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group">
                                                                  <span class="la la-pencil input-icon"></span>
                                                                  <textarea class="message-control form-control" name="post_message" id="post_message" placeholder="พิมพ์ข้อความของคุณ..."></textarea>
                                                              </div>
                                                              <div class="btn-box">
                                                                  <button type="button" class="theme-btn" onclick="addMessage();">ส่งคำถาม</button>
                                                              </div>
                                                          </div>
                                                      </form>

                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                    </div>


                                    <?php

                                    $i = 0;
                                    foreach ($data["Topic"]['message'] as $message)
                                    {
                                      $reply_count = count($data["Topic"]['message'][$i]['reply']);
                                      $ago         = engine::ago($message['message_date']);
                                      $thai_date   = engine::thaidate($message['message_date']);

                                      $avatar     = engine::student("avatar");

                                      echo "
                                      <div class='replay-question-wrap replay-question-{$message['message_id']}'>
                                          <button class='theme-btn theme-btn-light back-to-question-btn'><i class='la la-reply mr-1'></i>ย้อนกลับ</button>
                                          <div class='replay-question-body padding-top-30px'>
                                              <div class='question-list-item'>
                                                  <ul class='comments-list'>
                                                      <li>
                                                          <div class='comment'>
                                                              <div class='comment-avatar'>
                                                                  <img class='avatar__img' alt='' src='{$avatar}'>
                                                              </div>
                                                              <div class='comment-body'>
                                                                  <div class='meta-data d-flex align-items-center justify-content-between'>
                                                                      <div class='question-meta-content'>
                                                                          <h3 class='comment__author'>{$message['owner']['name']}</h3>
                                                                          <p class='comment__meta'>
                                                                              <span><strong>{$ago}</strong> {$thai_date}</span>
                                                                          </p>
                                                                          <p class='comment-content'>{$message['message_body']}</p>
                                                                      </div>
                                                                      <div class='question-upvote-action'>
                                                                          <div class='number-upvotes pb-2 d-flex align-items-center'>

                                                                              <div class='msg-action-dot'>
                                                                                  <div class='dropdown'>
                                                                                      <a class='action-dot' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                                          <i class='la la-ellipsis-v'></i>
                                                                                      </a>
                                                                                      <div class='dropdown-menu'>
                                                                                          <a class='dropdown-item' href='javascript:void(0)' data-toggle='modal' data-target='.report-modal-form'>
                                                                                             <i class='la la-flag'></i> รายงานการละเมิด
                                                                                          </a>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                          <div class='question-replay-separator-wrap d-flex align-items-center justify-content-between pb-3'>
                                                              <span class='widget-title font-size-16 primary-color'> {$reply_count} ตอบกลับ</span>
                                                          </div>

                                                          <div class='section-block'></div>
                                                          <div class='question-answer-wrap'>";

                                                          foreach ($data["Topic"]['message'][$i]['reply'] as $reply)
                                                          {
                                                            if($reply['sender']=="student")
                                                            {
                                                              $author         = "ผู้เรียน";
                                                              $comment        = "";
                                                              $comment_icon   = "";
                                                              $comment_name   = "";
                                                              $comment_badge  = "badge-dark";
                                                            }
                                                            else if($reply['sender']=="instructor")
                                                            {
                                                              $author         = "ผู้สอน";
                                                              $comment        = "";
                                                              $comment_icon   = "";
                                                              $comment_name   = "";
                                                              $comment_badge  = "badge-dark";
                                                            }
                                                            else if($reply['sender']=="admin")
                                                            {
                                                              $author         = "ผู้ดูแลระบบ";
                                                              $comment        = "comment-admin";
                                                              $comment_icon   = "<i class='fa fa-reply fa-rotate-180 comment-admin-icon'></i>";
                                                              $comment_name   = "comment__author_admin";
                                                              $comment_badge  = "badge-danger";
                                                            }

                                                            $reply_ago        = engine::ago($reply['message_date']);
                                                            $reply_thaidate   = engine::thaidate($reply['message_date']);
                                                            $avatar           = engine::student("avatar");

                                                            echo
                                                            "<div class='comment {$comment}'>
                                                                {$comment_icon}
                                                                <div class='comment-avatar'>
                                                                    <img class='avatar__img' alt='' src='{$avatar}'>
                                                                </div>
                                                                <div class='comment-body'>
                                                                    <div class='meta-data d-flex align-items-center justify-content-between'>
                                                                        <div class='question-meta-content'>
                                                                            <h3 class='comment__author {$comment_name}'><a href='#' class='d-inline-block'>{$reply['owner']['name']}</a> - <small class='badge {$comment_badge}'>{$author}</small></h3>
                                                                            <p class='comment__meta'>
                                                                                <span><strong>{$reply_ago}</strong> {$reply_thaidate}</span>
                                                                            </p>
                                                                            <p class='comment-content'>{$reply['message_body']}</p>
                                                                        </div>
                                                                        <div class='question-upvote-action'>
                                                                            <div class='number-upvotes pb-2 d-flex align-items-center'>
                                                                                <div class='msg-action-dot'>
                                                                                    <div class='dropdown'>
                                                                                        <a class='action-dot' href='#' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                                            <i class='la la-ellipsis-v'></i>
                                                                                        </a>
                                                                                        <div class='dropdown-menu'>
                                                                                            <a class='dropdown-item' href='javascript:void(0)' data-toggle='modal' data-target='.report-modal-form'>
                                                                                                <i class='la la-flag'></i> รายงานการละเมิด
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                          }

                                                          echo
                                                          "<div class='section-block'></div>
                                                              <div class='question-replay-input-wrap padding-top-35px'>
                                                                  <div class='question-replay-body'>
                                                                      <h3 class='widget-title font-size-16'>ตอบกลับ</h3>
                                                                      <div class='contact-form-action pt-4'>
                                                                          <form id='frm-add-reply-{$message['message_id']}'>
                                                                              <input class='form-control' type='hidden' id='reply_lesson' name='reply_lesson' value='{$data["Lesson"]['lesson_id']}'>
                                                                              <input class='form-control' type='hidden' id='reply_topic' name='reply_topic' value='{$data["Topic"]['topic_id']}'>
                                                                              <input class='form-control' type='hidden' id='reply_message_id' name='reply_message_id' value='{$message['message_id']}'>
                                                                              <div class='input-box'>
                                                                                  <div class='replay-action-bar'>
                                                                                      <div class='btn-group'>
                                                                                          <button class='btn' type='button' data-toggle='modal' data-target='.insert-link-modal-form' title='Insert link'><i class='la la-link'></i></button>
                                                                                          <button class='btn' type='button' data-toggle='modal' data-target='.upload-photo-modal-form' title='Upload an image'><i class='la la-photo'></i></button>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class='form-group'>
                                                                                      <span class='la la-pencil input-icon'></span>
                                                                                      <textarea class='message-control form-control' name='reply_message' id='reply_message' placeholder='พิมพ์ข้อความของคุณ...'></textarea>
                                                                                  </div>
                                                                                  <div class='btn-box'>
                                                                                      <button type='button' class='theme-btn' onclick='addReply({$message['message_id']});'>ส่งข้อความ</button>
                                                                                  </div>
                                                                              </div>
                                                                          </form>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </li>

                                                  </ul>
                                              </div>
                                          </div>
                                      </div>";

                                      $i++;
                                    }

                                    ?>

                                    <div class="question-overview-result-wrap">
                                        <div class="lecture-overview-item mb-0">
                                            <div class="question-overview-result-header d-flex align-items-center justify-content-between pb-3">
                                                <div class="question-result-item">
                                                    <h3 class="widget-title font-size-17"><?php echo $message_count;?> คำถามในบทเรียนนี้</h3>
                                                </div>
                                                <div class="question-result-item">
                                                    <button class="btn ask-new-question-btn">ถามคำถามใหม่</button>
                                                </div>
                                            </div>
                                            <div class="section-block"></div>
                                        </div>
                                         <div class="lecture-overview-item mt-0">
                                            <div class="question-list-container">
                                                <div class="question-list-item">
                                                    <ul class="comments-list" id="comments-list">

                                                      <?php

                                                      $i = 0;
                                                      foreach ($data["Topic"]['message'] as $message)
                                                      {
                                                        $reply_count = count($data["Topic"]['message'][$i]['reply']);
                                                        $ago         = engine::ago($message['message_date']);
                                                        $thai_date   = engine::thaidate($message['message_date']);

                                                        $avatar     = engine::student("avatar");

                                                        echo
                                                        "<li>
                                                            <div class='comment'>
                                                                <div class='comment-avatar'>
                                                                    <img class='avatar__img' alt='' src='{$avatar}'>
                                                                </div>
                                                                <div class='comment-body message-body' onclick='showReply(\"{$message['message_id']}\");'>
                                                                    <div class='meta-data d-flex align-items-center justify-content-between'>
                                                                        <div class='question-meta-content'>
                                                                            <a href='javascript:void(0)'>
                                                                                <h3 class='comment__author'>{$message['owner']['name']}</h3>
                                                                                <p class='comment-content'>{$message['message_body']}</p>
                                                                            </a>
                                                                        </div>
                                                                        <div class='question-upvote-action'>
                                                                             <div class='number-upvotes question-response d-flex align-items-center'>
                                                                                <span>{$reply_count}</span>
                                                                                <button type='button' class='question-replay-btn'><i class='fa fa-comments'></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p class='comment__meta'>
                                                                        <span><strong>{$ago}</strong></span>
                                                                        <span>{$thai_date}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>";
                                                        $i++;
                                                      }

                                                      ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div role="tabpanel" id="announcements" class="<?php echo ($data["Pager"]['active_tab'] == "announce") ? "tab-pane fade active show" : "tab-pane fade";?>">
                                <div class="lecture-overview-wrap lecture-announcement-wrap">
                                    <div class="lecture-overview-item">
                                        <div class="lecture-overview-stats-wrap">
                                            <div class="lecture-overview-stats-item">
                                                <div class="lecture-owner-wrap d-flex align-items-center">
                                                    <div class="lecture-owner-avatar">
                                                        <img src="theme/aduca/assets/images/team9.jpg" alt="">
                                                    </div>
                                                    <div class="lecture-owner-title-wrap">
                                                        <h3 class="widget-title pb-1 font-size-18"><a href="instructor/detail/<?php echo $data["Teacher"]['teacher_code']?>" class="primary-color"><?php echo $data["Teacher"]['teacher_name']?></a></h3>
                                                        <div class="posted-announcement d-flex align-items-center">
                                                            <p class="font-size-14">Posted an announcement · a year ago ·</p>
                                                            <div class="msg-action-dot ml-1">
                                                                <div class="dropdown">
                                                                    <a class="action-dot mr-1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Report abuse">
                                                                        <i class="la la-flag"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu border">
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target=".report-modal-form">
                                                                            <i class="la la-flag"></i> Report abuse
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="lecture-owner-decription pt-4">
                                                    <h3 class="widget-title font-size-19 pb-3">Important Q&A support</h3>
                                                    <p>Happy 2019 to everyone, thank you for being a student and all of your support.</p>
                                                    <p><strong>Great job on enrolling and your current course progress.  I encourage you keep in pursuit of your dreams :)</strong></p>
                                                    <p>The whole lot. In my course After Effects Complete Course packed with all Techniques and Methods (No Tricks and gimmicks).</p>
                                                    <p class="font-italic"><strong>Unfortunately this will result in delayed responses by me in the Q&A section and to direct messages.  This is only for the next week  and once back I will be back to 100% .</strong></p>
                                                    <p>I will continue to do my best to respond to as many questions as possible but only one person, regularly I spend 4-5 hours daily on this and with over 440000 students as you can image that its a lot of work.</p>
                                                    <p class="font-italic">Thank you once again for your understanding and for all of the wonderful students who I have had an opportunity to communicate with regularly and all of your encouragement.</p>
                                                    <p>Have an awesome day</p>
                                                    <p>Alex</p>
                                                </div>
                                                <div class="lecture-announcement-form d-flex align-items-center pt-4">
                                                    <div class="lecture-owner-avatar">
                                                        <img src="theme/aduca/assets/images/team8.jpg" alt="">
                                                    </div>
                                                    <div class="contact-form-action">
                                                        <form action="post">
                                                            <div class="form-group mb-0">
                                                                <input class="form-control" type="text" name="search" placeholder="Enter your comment">
                                                                <button class="submit-btn" type="button"><i class="la la-arrow-right"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end lecture-overview-item -->
                                </div>
                            </div><!-- end tab-pane -->
                        </div>
                    </div><!-- end lecture-video-detail-body -->
                </div><!-- end lecture-video-detail -->
                <div class="subscriber-area call-to-action padding-top-40px padding-bottom-40px">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="call-to-action-heading d-flex align-items-center">
                                    <div class="call-to-action-icon">
                                        <svg viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg"><path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"/><path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"/><path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"/><path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"/><path d="m152 288h16v80h-16zm0 0"/><path d="m120 288h16v80h-16zm0 0"/><path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"/></svg>
                                    </div>
                                    <div class="section-heading">
                                        <h2 class="section__title font-size-20 pb-1">เข้าร่วมเป็นวิทยากร เพื่อแบ่งปันความรู้ของคุณ</h2>
                                        <p class="section__desc mb-0">สร้างหลักสูตรวิดีโอออนไลน์เข้าถึงนักเรียนทั่วโลกและสร้างรายได้</p>
                                    </div><!-- end section-heading -->
                                </div>
                            </div><!-- end col-lg-7 -->
                            <div class="col-lg-5">
                                <div class="btn-box text-right">
                                    <a href="#" class="theme-btn">สมัครวิทยากร</a>
                                </div><!-- end btn-box-->
                            </div><!-- end col-lg-5 -->
                        </div><!-- end row -->
                    </div><!-- end container-fluid -->
                </div><!-- end subscriber-area -->
                <div class="section-block"></div>
                <div class="footer-area section-bg padding-top-40px padding-bottom-40px">
                    <div class="container-fluid">
                        <div class="copyright-content copyright-content-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 column-lmd-half column-td-full">
                                    <div class="copyright-content-inner">
                                        <a href="index.html">
                                            <img src="theme/interface/aduca/assets/images/logo.png" alt="footer logo" class="footer__logo">
                                        </a>
                                        <p class="copy__desc">Copyright &copy; 2020 WEIS</p>
                                    </div>
                                </div><!-- end col-lg-4 -->
                                <div class="col-lg-6 column-lmd-half column-td-full">
                                    <ul class="list-items">
                                        <li><a href="#">Terms</a></li>
                                        <li><a href="#">Privacy policy and cookie policy</a></li>
                                        <li><a href="#">Help and Support</a></li>
                                    </ul>
                                </div>
                                <div class="col-lg-2 column-lmd-half column-td-full">
                                    <div class="sort-ordering">
                                        <select class="sort-ordering-select">
                                            <option value="1">English</option>
                                            <option value="2">Deutsch</option>
                                            <option value="3">Español</option>
                                            <option value="4">Français</option>
                                            <option value="5">Bahasa Indonesia</option>
                                            <option value="6">Bangla</option>
                                            <option value="7">日本語</option>
                                            <option value="8">한국어</option>
                                            <option value="9">Nederlands</option>
                                            <option value="10">Polski</option>
                                            <option value="11">Português</option>
                                            <option value="12">Română</option>
                                            <option value="13">Русский</option>
                                            <option value="14">ภาษาไทย</option>
                                            <option value="15">Türkçe</option>
                                            <option value="16">中文(简体)</option>
                                            <option value="17">中文(繁體)</option>
                                            <option value="17">Hindi</option>
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end copyright-content -->
                    </div><!-- end container-fluid -->
                </div><!-- end footer-area -->
            </div><!-- end course-dashboard-column -->
            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> เนื้อหาในหลักสูตร</button>
                <div class="course-dashboard-sidebar-wrap">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="widget-title font-size-20">เนื้อหาในหลักสูตร</h3>
                        <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                    </div><!-- end course-dashboard-side-heading -->
                    <div class="course-dashboard-side-content">
                        <div class="accordion course-item-list-accordion" id="accordionCourseMenu">

                          <?php

                          foreach ($data["Course"] as $Course)
                          {
                            $show_bg    = ($data["Topic"]['course_id']==$Course['course_id']) ? "bg-lastplay" : "";
                            $show_arrow = ($data["Topic"]['course_id']==$Course['course_id']) ? "true" : "false";
                            $show       = ($data["Topic"]['course_id']==$Course['course_id']) ? "show" : "";
                            $main ++;

                            echo
                            "<div class='card'>
                                  <div class='card-header {$show_bg}' id='course-menu-{$Course['course_id']}'>
                                      <h2 class='mb-0'>
                                          <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#topic-table-{$Course['course_id']}' aria-expanded='{$show_arrow}' aria-controls='topic-table-{$Course['course_id']}'>
                                              <span class='widget-title font-size-15 font-weight-semi-bold'>{$Course['course_name']}</span>
                                              <div class='course-duration'>
                                                  <span>{$Course['topic_count']} ตอน</span>
                                                  <span>{$Course['topic_duration']} ชม.</span>
                                              </div>
                                          </button>
                                      </h2>
                                  </div>

                                  <div id='topic-table-{$Course['course_id']}' class='collapse {$show}' aria-labelledby='course-menu-{$Course['course_id']}' data-parent='#accordionCourseMenu'>
                                      <div class='card-body'>
                                          <div class='course-content-list'>
                                              <ul class='course-list'>";

                                          $sub = "1";

                                          foreach ($Course['topic'] as $Topic)
                                          {

                                            if($player_mode=="all")
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
                                                //echo $Course['course_id'] . "</br>";
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
                                                //echo $before_stage_id . "</br>";
                                              }

                                              if($before_stage=="first")
                                              {
                                                // Check Quiz before Exitst
                                                if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                                                {
                                                  // Check Quiz before Status
                                                  if($data["Quiz_status"]['before']['status']=="false")
                                                  {
                                                    $topic_icon     = "play-circle";
                                                    $topic_text     = "bold";
                                                    $topic_color    = "text-primary";
                                                    $topic_percent  = "50";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                    $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                  else
                                                  {
                                                    if($Topic['topic_player_finish'] =="0")
                                                    {
                                                      $topic_icon     = "play-circle";
                                                      $topic_text     = "bold";
                                                      $topic_color    = "text-primary";
                                                      $topic_percent  = "50";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                      $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                      $topic_option   = "topic-option-active";
                                                    }
                                                    else if($Topic['topic_player_finish'] =="1")
                                                    {
                                                      $topic_icon     = "check-circle";
                                                      $topic_text     = "normal";
                                                      $topic_color    = "text-success";
                                                      $topic_percent  = "100";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                      $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                      $topic_option   = "topic-option-active";
                                                    }
                                                    else
                                                    {
                                                      $topic_icon     = "play-circle";
                                                      $topic_text     = "bold";
                                                      $topic_color    = "text-primary";
                                                      $topic_percent  = "50";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                      $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                      $topic_option   = "topic-option-active";
                                                    }
                                                  }
                                                }
                                                else
                                                {
                                                  if($Topic['topic_player_finish'] =="0")
                                                  {
                                                    $topic_icon     = "play-circle";
                                                    $topic_text     = "bold";
                                                    $topic_color    = "text-primary";
                                                    $topic_percent  = "50";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                    $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                  else if($Topic['topic_player_finish'] =="1")
                                                  {
                                                    $topic_icon     = "check-circle";
                                                    $topic_text     = "normal";
                                                    $topic_color    = "text-success";
                                                    $topic_percent  = "100";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                    $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                  else
                                                  {
                                                    $topic_icon     = "play-circle";
                                                    $topic_text     = "bold";
                                                    $topic_color    = "text-primary";
                                                    $topic_percent  = "50";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                    $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                }
                                              }
                                              else if($before_stage=="topic")
                                              {
                                                if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_option   = "topic-option-active";
                                                  //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  if($Topic['topic_type']=="7")
                                                  {
                                                    $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                  }
                                                  else
                                                  {
                                                    $topic_url  = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  }
                                                }
                                                else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                                                {
                                                  $topic_icon     = "check-circle";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-success";
                                                  $topic_percent  = "100";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                  $topic_option   = "topic-option-active";
                                                  //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  if($Topic['topic_type']=="7")
                                                  {
                                                    $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                  }
                                                  else
                                                  {
                                                    $topic_url  = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  }
                                                }
                                                else
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                              }
                                              else if($before_stage=="course")
                                              {
                                                if($before_stage_player=="1" && $Course['player_complete'] =="0")
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                                else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                                                {
                                                  $topic_icon     = "check-circle";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-success";
                                                  $topic_percent  = "100";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                  $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                                else
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                              }

                                              $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                                              if($total_player_time>"100")
                                              {
                                                $total_player_time ="100";
                                              }

                                              if($Topic['topic_type']=="7")
                                              {
                                                $topic_title  = "
                                                <div class='course-item-content'>
                                                    <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['contest']['contest_name']}</h4>
                                                    <div class='courser-item-meta-wrap'>
                                                        <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['contest']['contest_choice']} ข้อ</p>
                                                    </div>
                                                </div>
                                                ";
                                              }
                                              else
                                              {
                                                $topic_title  = "
                                                <div class='course-item-content'>
                                                    <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['topic_name']}</h4>
                                                    <div class='courser-item-meta-wrap'>
                                                        <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['topic_duration']}</p>
                                                    </div>
                                                </div>
                                                ";
                                              }
                                            }
                                            else if($player_mode=="step")
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
                                                //echo $Course['course_id'] . "</br>";
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
                                                //echo $before_stage_id . "</br>";
                                              }

                                              if($before_stage=="first")
                                              {
                                                // Check Quiz before Exitst
                                                if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                                                {
                                                  // Check Quiz before Status
                                                  if($data["Quiz_status"]['before']['status']=="false")
                                                  {
                                                    $topic_icon     = "lock";
                                                    $topic_text     = "normal";
                                                    $topic_color    = "text-mute";
                                                    $topic_percent  = "0";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                    $topic_url      = "none";
                                                    $topic_option   = "topic-option-unactive";
                                                  }
                                                  else
                                                  {
                                                    if($Topic['topic_player_finish'] =="0")
                                                    {
                                                      $topic_icon     = "play-circle";
                                                      $topic_text     = "bold";
                                                      $topic_color    = "text-primary";
                                                      $topic_percent  = "50";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                      $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                      $topic_option   = "topic-option-active";
                                                    }
                                                    else if($Topic['topic_player_finish'] =="1")
                                                    {
                                                      $topic_icon     = "check-circle";
                                                      $topic_text     = "normal";
                                                      $topic_color    = "text-success";
                                                      $topic_percent  = "100";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                      $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                      $topic_option   = "topic-option-active";
                                                    }
                                                    else
                                                    {
                                                      $topic_icon     = "lock";
                                                      $topic_text     = "normal";
                                                      $topic_color    = "text-mute";
                                                      $topic_percent  = "0";
                                                      $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                      $topic_url      = "none";
                                                      $topic_option   = "topic-option-unactive";
                                                    }
                                                  }
                                                }
                                                else
                                                {
                                                  if($Topic['topic_player_finish'] =="0")
                                                  {
                                                    $topic_icon     = "play-circle";
                                                    $topic_text     = "bold";
                                                    $topic_color    = "text-primary";
                                                    $topic_percent  = "50";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                    $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                  else if($Topic['topic_player_finish'] =="1")
                                                  {
                                                    $topic_icon     = "check-circle";
                                                    $topic_text     = "normal";
                                                    $topic_color    = "text-success";
                                                    $topic_percent  = "100";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                    $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                    $topic_option   = "topic-option-active";
                                                  }
                                                  else
                                                  {
                                                    $topic_icon     = "lock";
                                                    $topic_text     = "normal";
                                                    $topic_color    = "text-mute";
                                                    $topic_percent  = "0";
                                                    $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                    $topic_url      = "none";
                                                    $topic_option   = "topic-option-unactive";
                                                  }
                                                }
                                              }
                                              else if($before_stage=="topic")
                                              {
                                                if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_option   = "topic-option-active";
                                                  //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  if($Topic['topic_type']=="7")
                                                  {
                                                    $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                  }
                                                  else
                                                  {
                                                    $topic_url  = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  }
                                                }
                                                else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                                                {
                                                  $topic_icon     = "check-circle";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-success";
                                                  $topic_percent  = "100";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                  $topic_option   = "topic-option-active";
                                                  //$topic_url      = "course/detail/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  if($Topic['topic_type']=="7")
                                                  {
                                                    $topic_url  = "course/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                                  }
                                                  else
                                                  {
                                                    $topic_url  = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  }
                                                }
                                                else
                                                {
                                                  $topic_icon     = "lock";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-mute";
                                                  $topic_percent  = "0";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                  $topic_url      = "none";
                                                  $topic_option   = "topic-option-unactive";
                                                }
                                              }
                                              else if($before_stage=="course")
                                              {
                                                if($before_stage_player=="1" && $Course['player_complete'] =="0")
                                                {
                                                  $topic_icon     = "play-circle";
                                                  $topic_text     = "bold";
                                                  $topic_color    = "text-primary";
                                                  $topic_percent  = "50";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                                  $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                                else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                                                {
                                                  $topic_icon     = "check-circle";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-success";
                                                  $topic_percent  = "100";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                                                  $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                                  $topic_option   = "topic-option-active";
                                                }
                                                else
                                                {
                                                  $topic_icon     = "lock";
                                                  $topic_text     = "normal";
                                                  $topic_color    = "text-mute";
                                                  $topic_percent  = "0";
                                                  $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                                                  $topic_url      = "none";
                                                  $topic_option   = "topic-option-unactive";
                                                }
                                              }

                                              $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                                              if($total_player_time>"100")
                                              {
                                                $total_player_time ="100";
                                              }

                                              if($Topic['topic_type']=="7")
                                              {
                                                $topic_title  =
                                                "<div class='course-item-content'>
                                                    <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['contest']['contest_name']}</h4>
                                                    <div class='courser-item-meta-wrap'>
                                                        <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['contest']['contest_choice']} ข้อ</p>
                                                    </div>
                                                </div>";
                                              }
                                              else
                                              {
                                                $topic_title  =
                                                "<div class='course-item-content'>
                                                    <h4 class='widget-title font-size-15 font-weight-medium {$topic_color}'>{$Topic['topic_name']} ({$total_player_time}%)</h4>
                                                    <div class='courser-item-meta-wrap'>
                                                        <p class='course-item-meta'><i class='fa fa-{$topic_icon}'></i> {$Topic['topic_duration']}</p>
                                                    </div>
                                                </div>";
                                              }
                                            }

                                            $active = ($data["Topic"]['topic_id'] == $Topic['topic_id']) ? "active" : "";

                                            echo
                                            "<li class='course-item-link {$active}'>
                                                <div class='course-item-content-wrap' onclick='page(\"{$topic_url}\");'>
                                                    {$topic_title}
                                                </div>
                                            </li>";

                                            $sub++;
                                          }

                                          echo
                                          "</ul>
                                      </div>
                                  </div>
                              </div>
                          </div>";
                          }

                          ?>


                        </div>
                    </div>
                </div>
            </div><!-- end course-dashboard-sidebar-column -->
        </div><!-- end course-dashboard-container -->
    </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
<!--======================================
        END COURSE-DASHBOARD
======================================-->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade rating-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">คุณพึงพอใจหลักสูตรนี้มากแค่ไหน ?</h4>
                </div>
                <div class="course-rating-wrap p-4 text-center">
                    <h3 class="widget-title padding-bottom-30px font-size-18">เลือกคะแนน</h3>
                    <div class="rating-shared rating-shared-2">
                        <fieldset>
                            <input type="radio" id="star5" name="rating" value="5"><label for="star5" data-toggle="tooltip" data-placement="top" title="Amazing, above expectations!"></label>
                            <input type="radio" id="star4" name="rating" value="4"><label for="star4" data-toggle="tooltip" data-placement="top" title="Good, what i expected"></label>
                            <input type="radio" id="star3" name="rating" value="3"><label for="star3" data-toggle="tooltip" data-placement="top" title="Average, could be better"></label>
                            <input type="radio" id="star2" name="rating" value="2"><label for="star2" data-toggle="tooltip" data-placement="top" title="Poor, pretty disappointed"></label>
                            <input type="radio" id="star1" name="rating" value="1"><label for="star1" data-toggle="tooltip" data-placement="top" title="Awful, not what i expected at all"></label>
                        </fieldset>
                    </div>
                </div><!-- end course-rating-wrap -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->


<div class="modal-form copy-to-clipboard-modal">
    <div class="modal fade share-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">แชร์หลักสูตรนี้</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <div class="copy-to-clipboard mb-3">
                        <div class="contact-form-action d-flex align-items-center">
                            <span class="success-message">คัดลอก!</span>
                            <input type="text" class="form-control copy-input" value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
                            <div class="copy-tooltip">
                                <button class="theme-btn theme-btn-light copy-text">Copy</button>
                            </div>
                        </div>
                    </div><!-- end copy-to-clipboard -->
                    <ul class="social-profile">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade report-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <div>
                        <h4 class="modal-title widget-title font-size-20"><span class="la la-flag-o mr-1"></span>Report Abuse</h4>
                        <p class="mt-2 font-size-15 line-height-26">
                            Flagged content is reviewed by Aduca staff to determine whether it violates Terms of Service or Community Guidelines.
                            If you have a question or technical issue, please contact our <a href="#" class="primary-color-2">Support team here</a>.
                        </p>
                    </div>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                </div>
                <div class="contact-form-action">
                    <form method="post">
                        <div class="input-box">
                            <label class="label-text">Select Report Type</label>
                            <div class="form-group">
                                <div class="sort-ordering user-form-short">
                                    <select class="sort-ordering-select">
                                        <option value>-- Select One --</option>
                                        <option value="1">Inappropriate Course Content</option>
                                        <option value="2">Inappropriate Behavior</option>
                                        <option value="3">Aduca Policy Violation</option>
                                        <option value="4">Spammy Content</option>
                                        <option value="5">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Write Message<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <i class="la la-pencil input-icon"></i>
                                <textarea class="message-control form-control" name="message" placeholder="Provide additional details here..." required></textarea>
                            </div>
                        </div>
                        <div class="btn-box text-right">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="theme-btn" >Submit</button>
                        </div>
                    </form>
                </div><!-- end contact-form-action -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->
<!-- end modal-shared -->

<div class="modal-form">
    <div class="modal fade insert-link-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Insert link</h4>
                </div>
                <div class="contact-form-action">
                    <form action="post">
                        <div class="input-box">
                            <label class="label-text">URL<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="text" placeholder="Url">
                                <i class="la la-link input-icon"></i>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Text<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="text" placeholder="Text">
                                <i class="la la-pencil input-icon"></i>
                            </div>
                        </div>
                        <div class="btn-box text-right">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="theme-btn" >Insert</button>
                        </div>
                    </form>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<div class="modal-form">
    <div class="modal fade upload-photo-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Upload an Image</h4>
                </div>
                <div class="upload-image-box text-center p-3">
                    <i class="la la-photo"></i>
                    <div class="upload-btn-box">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <input type="file" name="files[]" class="filer_input" multiple="multiple">
                        </form>
                    </div>
                    <div class="btn-box text-right">
                        <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="theme-btn">Submit</button>
                    </div>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<script>
/*==== When ask-new-question-btn will click then this action will work =====*/
$(document).on('click', '.ask-new-question-btn', function () {
    $('.new-question-wrap, .question-overview-result-wrap').addClass('active');
});

/*==== When question-meta-content or question-replay-btn will click then this action will work =====*/
$(document).on('click', '.back-to-question-btn', function () {
    $('.new-question-wrap, .question-overview-result-wrap, .replay-question-wrap').removeClass('active');
});
</script>
