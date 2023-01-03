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
  $data["Quiz_status"]	    = $course['course']['quiz_status'];
  $data["Permission"]	      = $course['course']['permission'];
  $data["PlayerCounter"]	  = $course['course']['player_counter'];

  //print_r($data["Course"]);

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





//print_r($data["Quiz_status"]);

?>

<div class="mdk-box bg-primary mdk-box--bg-gradient-primary2 js-mdk-box mb-0" data-effects="blend-background">
    <div class="mdk-box__content">
        <div class="hero py-64pt text-center text-sm-left">
            <div class="container page__container">
                <h1 class="text-white"><?php echo $data["Lesson"]['lesson_name'];?></h1>
                <p class="lead text-white-50 measure-hero-lead mb-24pt"><?php echo $data["Lesson"]['lesson_short_detail'];?></p>
                <a href="student" class="btn btn-white btn-icons"><i class="material-icons text-muted icon--left">recent_actors</i> หน้าหลัก</a>
                <a href="student/course" class="btn btn-white btn-icons"><i class="material-icons text-muted icon--left">local_library</i> หลักสูตร</a>
                <a href="student/course/lesson-name/topic-name" class="btn btn-white btn-icons"><i class="material-icons text-danger icon--left">play_circle_filled</i> เรียนต่อ</a>
            </div>
        </div>
        <?php //print_r($data["Lesson"]);?>
        <div class="navbar navbar-expand-sm navbar-light bg-white border-bottom-2 navbar-list p-0 m-0 align-items-center">
            <div class="container page__container">
                <ul class="nav navbar-nav flex align-items-sm-center">
                  <li class="nav-item navbar-list__item">
                      <div class="media align-items-center">
                          <span class="media-left mr-16pt">
                              <img src="https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url']?>/<?php echo $data["Teacher"]['image_url']?>" width="40" alt="avatar" class="rounded-circle">
                          </span>
                          <div class="media-body">
                              <a class="card-title m-0" href="javascript:void(0);"> <?php echo $data["Teacher"]['teacher_name'];?></a>
                              <p class="text-50 lh-1 mb-0">วิทยากร/ผู้สอน</p>
                          </div>
                      </div>
                  </li>
                  <li class="nav-item navbar-list__item">
                      <div class="media align-items-center">
                          <div class="media-body">
                              <a class="card-title m-0" href="javascript:void(0);"><?php echo $data["Lesson"]['duration_course'];?> ชม.</a>
                              <p class="text-50 lh-1 mb-0">ความยาวเนื้อหา</p>
                          </div>
                      </div>
                  </li>
                  <li class="nav-item navbar-list__item">
                      <div class="media align-items-center">
                          <div class="media-body">
                              <a class="card-title m-0" href="javascript:void(0);"><?php echo $data["Lesson"]['lesson_days'];?> วัน</a>
                              <p class="text-50 lh-1 mb-0">จำนวนวันที่เรียนได้</p>
                          </div>
                      </div>
                  </li>
                  <li class="nav-item navbar-list__item">
                      <i class="material-icons text-muted icon--left">assessment</i>
                      <?php echo $data["Lesson"]['class_name'];?>
                  </li>
                    <li class="nav-item navbar-list__item">
                        <span class="pull-left icon--left">
                          <span class="survey-progress">
                            <span class="survey-progress-bg">
                              <span class="survey-progress-fg" style="width: <?php echo $course_status_complete['percent'];?>%;"></span>
                            </span>
                          </span>
                        </span>
                        <span class="pull-right"><?php echo $course_status_complete['percent'];?>%</span>
                    </li>
                    <li class="nav-item ml-sm-auto text-sm-center flex-column navbar-list__item">
                        <div class="rating rating-24">
                          <div class="rating__item"><i class="material-icons">star</i></div>
                          <div class="rating__item"><i class="material-icons">star</i></div>
                          <div class="rating__item rating__item__unactive"><i class="material-icons">star_outline</i></div>
                        </div>
                        <p class="lh-1 mb-0"><small class="text-muted">20 ความนิยม</small></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container page__container">
    <div class="row">
        <div class="col-lg-7">

          <?php

          //print_r($data["Course"]);
          echo "<div class='border-left-2 page-section pl-32pt'>";

          echo
          "<div class='d-flex align-items-center page-num-container'>
              <div class='page-num quiz-special'>A</div>
          </div>

          <div class='card mb-32pt mb-lg-32pt '>
              <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-a' data-domfactory-upgraded='accordion'>
                  <li class='accordion__item open'>
                      <a class='accordion__toggle' data-toggle='collapse' data-parent='#toc-a' href='#toc-content-a'>
                          <span class='flex course_title'>{$data["Quiz_status"]['before']['contest_name']}</span>
                          <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                      </a>
                      <div class='accordion__menu'>
                          <ul class='list-unstyled collapse show' id='toc-content-a'><li class='accordion__menu-link'>
                                  <span class='material-icons icon-16pt icon--left text-accent'>play_circle_outline</span>
                                  <a class='flex' href='student/quiz/{$data["Lesson"]['lesson_code']}/{$data["Quiz_status"]['before']['contest_token']}'>
                                  <span class='bold'>
                                  <span class='text-accent'>{$data["Quiz_status"]['before']['contest_name']}</span> <span class=''>({$data["Quiz_status"]['before']['contest_choice']} ข้อ)</span>
                                  </span>
                                  <!--Body Text.-->
                                  </a>
                                  <span class='text-muted text-time'><span class='badge badge-notifications badge-accent'>กำลังเรียน..</span></span>
                                  <span class='d-none d-sm-block'>
                                    <span class='survey-progress'>
                                      <span class='survey-progress-bg'>
                                        <span class='survey-progress-fg' style='width: 0%;'></span>
                                      </span>
                                    </span>
                                    <span class='text-muted text-percent'>0%</span>
                                  </span>
                              </li>
                            </ul>
                      </div>
                  </li>
              </ul>
          </div>";

          foreach ($data["Course"] as $Course)
          {
            $main ++;

            if(in_array($Course['course_id'],$active_array))
            {
              $open       = "open";
              $toggle     = "accordion__toggle";
              $expanded   = "true";
              $show       = "show";
              $display    = "";
            }
            else
            {
              $open       = "";
              $toggle     = "accordion__toggle collapsed";
              $expanded   = "false";
              $show       = "";
              $display    = "course_unactive";
            }

            echo
            "<div class='d-flex align-items-center page-num-container'>
                <div class='page-num'>{$main}</div>
            </div>
            <!--<p class='text-70 mb-24pt'>Body Text.</p>-->
            <div class='card mb-32pt mb-lg-32pt {$display}'>
                <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-{$main}'>
                    <li class='accordion__item {$open}'>
                        <a class='{$toggle}' data-toggle='collapse' data-parent='#toc-{$main}' href='#toc-content-{$main}'>
                            <span class='flex course_title'>{$Course['course_id']} - {$Course['course_name']}</span>
                            <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                        </a>
                        <div class='accordion__menu'>
                            <ul class='list-unstyled collapse {$show}' id='toc-content-{$main}'>";

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

                                  // Check Quiz before sattus
                                  //--------------------------------------------
                                  if($data["Quiz_status"]['before']['lesson_contest_id']=="" || $data["Quiz_status"]['before']['lesson_contest_id']==NULL)
                                  {

                                  }
                                  else
                                  {

                                  }

                                  if($Topic['topic_player_finish'] =="0")
                                  {
                                    $topic_icon     = "play_circle_outline";
                                    $topic_text     = "bold";
                                    $topic_color    = "text-primary";
                                    $topic_percent  = "50";
                                    $topic_msg      = "<span class='badge badge-notifications badge-primary'>กำลังเรียน..</span>";
                                    $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";

                                  }
                                  else if($Topic['topic_player_finish'] =="1")
                                  {
                                    $topic_icon     = "check_circle";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-success";
                                    $topic_percent  = "100";
                                    $topic_msg      = "<span class='badge badge-notifications badge-success'>เรียนจบแล้ว..</span>";
                                    $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                  }
                                  else
                                  {
                                    $topic_icon     = "lock";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-mute";
                                    $topic_percent  = "0";
                                    $topic_msg      = "<span class='badge badge-notifications badge-dark'>ยังไม่เปิด..</span>";
                                    $topic_url      = "javascript:void();";
                                  }
                                }
                                else if($before_stage=="topic")
                                {
                                  if($before_stage_player=="1" && $Topic['topic_player_finish'] =="0")
                                  {
                                    $topic_icon     = "play_circle_outline";
                                    $topic_text     = "bold";
                                    $topic_color    = "text-accent";
                                    $topic_percent  = "50";
                                    $topic_msg      = "<span class='badge badge-notifications badge-accent'>กำลังเรียน..</span>";
                                    //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";

                                    if($Topic['topic_type']=="7")
                                    {
                                      $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                    }
                                    else
                                    {
                                      $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                    }

                                  }
                                  else if($before_stage_player=="1" && $Topic['topic_player_finish'] =="1")
                                  {
                                    $topic_icon     = "check_circle";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-success";
                                    $topic_percent  = "100";
                                    $topic_msg      = "<span class='badge badge-notifications badge-success'>เรียนจบแล้ว..</span>";
                                    //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";

                                    if($Topic['topic_type']=="7")
                                    {
                                      $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                                    }
                                    else
                                    {
                                      $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                    }

                                  }
                                  else
                                  {
                                    $topic_icon     = "lock";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-mute";
                                    $topic_percent  = "0";
                                    $topic_msg      = "<span class='badge badge-notifications badge-dark'>ยังไม่เปิด..</span>";
                                    $topic_url  = "javascript:void();";

                                  }
                                }
                                else if($before_stage=="course")
                                {
                                  if($before_stage_player=="1" && $Course['player_complete'] =="0")
                                  {
                                    $topic_icon     = "play_circle_outline";
                                    $topic_text     = "bold";
                                    $topic_color    = "text-accent";
                                    $topic_percent  = "50";
                                    $topic_msg      = "<span class='badge badge-notifications badge-accent'>กำลังเรียน..</span>";
                                    $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                  }
                                  else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                                  {
                                    $topic_icon     = "check_circle";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-success";
                                    $topic_percent  = "100";
                                    $topic_msg      = "<span class='badge badge-notifications badge-success'>เรียนจบแล้ว..</span>";
                                    $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                                  }
                                  else
                                  {
                                    $topic_icon     = "lock";
                                    $topic_text     = "normal";
                                    $topic_color    = "text-mute";
                                    $topic_percent  = "0";
                                    $topic_msg      = "<span class='badge badge-notifications badge-dark'>ยังไม่เปิด..</span>";
                                    $topic_url      = "javascript:void();";
                                  }
                                }

                                $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                                if($total_player_time>"100")
                                {
                                  $total_player_time ="100";
                                }

                                if($Topic['topic_type']=="7")
                                {
                                  $topic_title  = "<span class='{$topic_color}'>{$Topic['contest']['contest_name']}</span> <span class=''>({$Topic['contest']['contest_choice']} ข้อ)</span>";
                                }
                                else
                                {
                                  $topic_title  = "<span class='{$topic_color}'>{$Topic['topic_name']}</span> <span class=''>({$Topic['topic_duration']})</span>";
                                }

                                echo
                                "<li class='accordion__menu-link'>
                                    <span class='material-icons icon-16pt icon--left {$topic_color}'>{$topic_icon}</span>
                                    <a class='flex' href='{$topic_url}'>

                                    <span class='{$topic_text}'>
                                    {$topic_title}
                                    </span>
                                    <!--Body Text.-->

                                    </a>
                                    <span class='text-muted text-time'>{$topic_msg}</span>
                                    <span class='d-none d-sm-block'>
                                      <span class='survey-progress'>
                                        <span class='survey-progress-bg'>
                                          <span class='survey-progress-fg' style='width: {$total_player_time}%;'></span>
                                        </span>
                                      </span>
                                      <span class='text-muted text-percent'>{$total_player_time}%</span>
                                    </span>
                                </li>";
                              }

                            echo
                            "</ul>
                        </div>
                    </li>
                </ul>
            </div>";
          }

          echo
          "<div class='d-flex align-items-center page-num-container'>
              <div class='page-num quiz-special'>B</div>
          </div>

          <div class='card mb-32pt mb-lg-32pt '>
              <ul class='accordion accordion--boxed js-accordion mb-0' id='toc-b' data-domfactory-upgraded='accordion'>
                  <li class='accordion__item'>
                      <a class='accordion__toggle' data-toggle='collapse' data-parent='#toc-b' href='#toc-content-b'>
                          <span class='flex course_title'>แบบทดสอบหลังเรียน</span>
                          <span class='accordion__toggle-icon material-icons'>keyboard_arrow_down</span>
                      </a>
                      <div class='accordion__menu'>
                          <ul class='list-unstyled collapse' id='toc-content-b'><li class='accordion__menu-link'>
                                  <span class='material-icons icon-16pt icon--left text-accent'>play_circle_outline</span>
                                  <a class='flex' href='student/quiz/{$data["Lesson"]['lesson_code']}/{$data["Quiz_status"]['after']['contest_token']}'>
                                  <span class='bold'>
                                  <span class='text-accent'>{$data["Quiz_status"]['after']['contest_name']}</span> <span class=''>({$data["Quiz_status"]['after']['contest_choice']} ข้อ)</span>
                                  </span>
                                  <!--Body Text.-->
                                  </a>
                                  <span class='text-muted text-time'><span class='badge badge-notifications badge-accent'>กำลังเรียน..</span></span>
                                  <span class='d-none d-sm-block'>
                                    <span class='survey-progress'>
                                      <span class='survey-progress-bg'>
                                        <span class='survey-progress-fg' style='width: 0%;'></span>
                                      </span>
                                    </span>
                                    <span class='text-muted text-percent'>0%</span>
                                  </span>
                              </li>
                            </ul>
                      </div>
                  </li>
              </ul>
          </div>";

          echo "</div>";




          ?>

          <!--
          <div class="border-left-2 page-section pl-32pt">
            <div class="d-flex align-items-center page-num-container">
                <div class="page-num">1</div>
                <h4>แบบทดสอบก่อนเรียน</h4>
            </div>
            <p class="text-70 mb-24pt">Good tools make application development quick*er and easier to maintain than* if you did everything by hand.</p>
            <div class="card mb-32pt mb-lg-64pt">
                <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-1">
                    <li class="accordion__item open">
                        <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-1" href="#toc-content-1">
                            <span class="flex">1 หน่วย</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu">
                            <ul class="list-unstyled collapse show" id="toc-content-1">
                              <li class="accordion__menu-link">
                                  <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                  <a class="flex" href="compact-student-take-quiz.html"><strong class="bold">แบบทดสอบ : </strong> Getting Started With Angular</a>
                                  <span class="text-muted text-time">10 คะแนน</span>
                                  <span class="d-none d-sm-block">
                                    <span class="survey-progress">
                                      <span class="survey-progress-bg">
                                        <span class="survey-progress-fg" style="width: 100%;"></span>
                                      </span>
                                    </span>
                                    <span class="text-muted text-percent">100%</span>
                                  </span>
                              </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center page-num-container">
                <div class="page-num">2</div>
                <h4>Creating and Communicating Between Angular</h4>
            </div>
            <p class="text-70 mb-24pt">Data sharing is an essential concept to understand before diving into your first Angular project.</p>
            <div class="card mb-32pt mb-lg-64pt">
                <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-2">
                    <li class="accordion__item open">
                        <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-2" href="#toc-content-2">
                            <span class="flex">6 หน่วย</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu">
                            <ul class="list-unstyled collapse show" id="toc-content-2">
                                <li class="accordion__menu-link">
                                    <span class="material-icons icon-16pt icon--left text-body">check_circle</span>
                                    <a class="flex" href="compact-student-take-lesson.html">Introduction</a>
                                    <span class="text-muted text-time d-none d-sm-block">8 นาที 42 วิ</span>
                                    <span>
                                      <span class="survey-progress">
                                        <span class="survey-progress-bg">
                                          <span class="survey-progress-fg" style="width: 100%;"></span>
                                        </span>
                                      </span>
                                      <span class="text-muted text-percent">100%</span>
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center page-num-container">
                <div class="page-num">3</div>
                <h4>Creating and Communicating Between Angular</h4>
            </div>
            <p class="text-70 mb-24pt">Data sharing is an essential concept to understand before diving into your first Angular project.</p>
            <div class="card mb-0">
                <ul class="accordion accordion--boxed js-accordion mb-0" id="toc-3">
                    <li class="accordion__item">
                        <a class="accordion__toggle" data-toggle="collapse" data-parent="#toc-3" href="#toc-content-3">
                            <span class="flex">6 หน่วย</span>
                            <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span>
                        </a>
                        <div class="accordion__menu">
                            <ul class="list-unstyled collapse" id="toc-content-3">
                                <li class="accordion__menu-link">
                                    <span class="material-icons icon-16pt icon--left text-50">hourglass_empty</span>
                                    <a class="flex" href="compact-student-take-lesson.html">Introduction</a>
                                    <span class="text-muted text-time d-none d-sm-block">8 นาที 42 วิ</span>
                                    <span>
                                      <span class="survey-progress">
                                        <span class="survey-progress-bg">
                                          <span class="survey-progress-fg" style="width: 0%;"></span>
                                        </span>
                                      </span>
                                      <span class="text-muted text-percent">0%</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        -->
        </div>
        <div class="col-lg-5 page-nav">
            <div class="page-section">
                <div class="page-nav__content">
                    <div class="page-separator">
                        <div class="page-separator__text">เนื้อหาของหลักสูตร</div>
                    </div>
                    <!-- <h4 class="mb-16pt">Table of contents</h4> -->
                </div>
                <nav class="nav page-nav__menu">
                    <a class="nav-link active" href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>">เนื้อหาหลักสูตร</a>
                    <a class="nav-link" href="student/quiz/<?php echo $data["Lesson"]['lesson_code'];?>">แบบทดสอบประเมินผล</a>
                    <a class="nav-link" href="student/document/<?php echo $data["Lesson"]['lesson_code'];?>">เอกสารประกอบการเรียน</a>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-section bg-white border-bottom-2">
		<div class="container page__container">
				<div class="row ">
						<div class="col-md-7">
								<div class="page-separator">
										<div class="page-separator__text">เกี่ยวกับคอร์สนี้</div>
								</div>
								<?php echo $data["Lesson"]['lesson_detail'];?>
						</div>
						<div class="col-md-5">
								<div class="page-separator">
										<div class="page-separator__text bg-white">สถานะการเรียน</div>
								</div>
								<ul class="list-unstyled">
										<li class="d-flex align-items-center">
												<span class="material-icons text-50 mr-8pt">check</span>
												<span class="text-70">วันที่ลงทะเบียน <span class="bold"><?php echo engine::thaidate($data["Permission"]['permission_adddate']);?></span></span>
										</li>
										<li class="d-flex align-items-center">
												<span class="material-icons text-50 mr-8pt">check</span>
												<span class="text-70">วันหมดอายุ <span class="bold"><?php echo engine::thaidate($data["Permission"]['permission_expire']);?></span></span>
										</li>
										<li class="d-flex align-items-center">
												<span class="material-icons text-50 mr-8pt">check</span>
												<span class="text-70">เวลาเรียนที่เหลือ <span class="bold"><?php echo sprintf( "%02.2d:%02.2d", floor( $data["Permission"]['permission_timer'] / 60 ), $data["Permission"]['permission_timer'] % 60 );?></span> นาที.</span>
										</li>
										<li class="d-flex align-items-center">
												<span class="material-icons text-50 mr-8pt">check</span>
												<span class="text-70">เรียนไปแล้ว <span class="bold"><?php echo sprintf( "%02.2d:%02.2d", floor( $data["PlayerCounter"] / 60 ), $data["PlayerCounter"] % 60 );?></span> นาที.</span>
										</li>
								</ul>
						</div>
				</div>
		</div>
</div>

<div class="page-section bg-white border-bottom-2">
		<div class="container">
				<div class="row">
						<div class="col-md-7 mb-24pt mb-md-0">
								<h4>เกี่ยวกับผู้สอน</h4>
								<p class="text-70 mb-24pt"><?php echo $data["Teacher"]['teacher_detail']?></p>
								<div class="page-separator">
										<div class="page-separator__text bg-white">บทเรียนอื่นๆ ของผู้สอน</div>
								</div>
								<?php
									foreach ($data["Lesson"]['additional'] as $Lesson)
									{
										$detail 	= engine::shorttext($Lesson['post_detail'], 100);
										$date 	  = engine::thaidate($Lesson['post_adddate']);
										echo
										"<div class='card card-sm mb-8pt'>
												<div class='card-body d-flex align-items-center'>
														<a href='course/detail/{$Lesson['lesson_code']}' class='avatar avatar-4by3 mr-12pt'>
																<img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['lesson_cover']}' alt='Angular Routing In-Depth' class='avatar-img rounded'>
														</a>
														<div class='flex'>
																<a class='card-title mb-4pt' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
																<div class='d-flex align-items-center'>
																		<div class='rating mr-8pt'>

																			<span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
																			<span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
																			<span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>

																		</div>
																		<small class='text-muted'>{$Lesson['duration']} ชม. / {$Lesson['count']} บท</small>
																</div>
														</div>
												</div>
										</div>";
									}
								?>
						</div>
						<div class="col-md-5 pt-sm-32pt pt-md-0 d-flex flex-column align-items-center justify-content-start">
								<div class="text-center">
										<p class="mb-16pt">
												<img src="https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url']?>/<?php echo $data["Teacher"]['image_url']?>" alt="guy-6" class="rounded-circle" width="64">
										</p>
										<h4 class="m-0"><?php echo $data["Teacher"]['teacher_name']?></h4>
										<p class="lh-1">
												<small class="text-muted">ผู้สอน <?php echo $data["Lesson"]['lesson_name']?></small>
										</p>
										<div class="d-flex flex-column flex-sm-row align-items-center justify-content-start">
												<a href="javascript:void(0);" class="btn btn-outline-primary mb-16pt mb-sm-0 mr-sm-16pt">ติดตาม</a>
												<a href="javascript:void(0);" class="btn btn-outline-secondary">ดูประวัติผู้สอน</a>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>

<div class="page-section border-bottom-2">
		<div class="container">
				<div class="page-headline text-center">
						<h2>รีวิวหลักสูตรจากผู้เรียน</h2>
						<p class="lead text-70 measure-lead mx-auto">What other students turned professionals have to say about us after learning with us and reaching their goals.</p>
				</div>
				<div class="position-relative carousel-card col-lg-8 p-0 mx-auto">
						<div class="row d-block js-mdk-carousel" id="carousel-feedback">
								<a class="carousel-control-next js-mdk-carousel-control mt-n24pt" href="#carousel-feedback" role="button" data-slide="next">
										<span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
										<span class="sr-only">Next</span>
								</a>
								<div class="mdk-carousel__content">
										<div class="col-12 col-md-6">
												<div class="card card-feedback card-body">
														<blockquote class="blockquote mb-0">
																<p class="text-70 small mb-0">อธิบายได้เข้าใจและเห็นภาพ</p>
														</blockquote>
												</div>
												<div class="media ml-12pt">
														<div class="media-left mr-12pt">
																<a href="javascript:void(0);" class="avatar avatar-sm">
																		<!-- <img src="theme/luma/assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
																		<span class="avatar-title rounded-circle">UK</span>
																</a>
														</div>
														<div class="media-body media-middle">
																<a href="javascript:void(0);" class="card-title">อภิวัฒน์ ส.</a>
																<div class="rating mt-4pt">
																	<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
																	<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
																	<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
																</div>
														</div>
												</div>
										</div>

										<div class="col-12 col-md-6">
												<div class="card card-feedback card-body">
														<blockquote class="blockquote mb-0">
																<p class="text-70 small mb-0">อาจารย์เยี่ยมมากครับ</p>
														</blockquote>
												</div>
												<div class="media ml-12pt">
														<div class="media-left mr-12pt">
																<a href="javascript:void(0);" class="avatar avatar-sm">
																		<!-- <img src="theme/luma/assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
																		<span class="avatar-title rounded-circle">UK</span>
																</a>
														</div>
														<div class="media-body media-middle">
																<a href="javascript:void(0);" class="card-title">รุจิรา ก.</a>
																<div class="rating mt-4pt">
																	<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
																	<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
																	<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
																</div>
														</div>
												</div>
										</div>

										<div class="col-12 col-md-6">
												<div class="card card-feedback card-body">
														<blockquote class="blockquote mb-0">
																<p class="text-70 small mb-0">เนื้อหาแน่น ถ่ายทอดดี</p>
														</blockquote>
												</div>
												<div class="media ml-12pt">
														<div class="media-left mr-12pt">
																<a href="javascript:void(0);" class="avatar avatar-sm">
																		<!-- <img src="theme/luma/assets/images/people/110/guy-.jpg" width="40" alt="avatar" class="rounded-circle"> -->
																		<span class="avatar-title rounded-circle">UK</span>
																</a>
														</div>
														<div class="media-body media-middle">
																<a href="javascript:void(0);" class="card-title">ชัยยศ ง.</a>
																<div class="rating mt-4pt">
																	<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
																	<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
																	<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
																</div>
														</div>
												</div>
										</div>
								</div>
						</div>
				</div>
		</div>
</div>

<div class="page-section bg-white border-bottom-2">
		<div class="container page__container">
				<div class="page-separator">
						<div class="page-separator__text">รีวิวหลักสูตรจากผู้เรียน</div>
				</div>
				<div class="row mb-32pt">
						<div class="col-md-3 mb-32pt mb-md-0">
								<div class="display-1">4.7</div>
								<div class="rating rating-24">
									<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
									<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
									<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
								</div>
								<p class="text-muted mb-0">20 คะแนน</p>
						</div>
						<div class="col-md-9">
								<div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="75% rated 5/5" data-placement="top">
										<div class="col-md col-sm-6">
												<div class="progress" style="height: 8px;">
														<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
										</div>
										<div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
												<div class="rating">
													<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
													<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
													<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
												</div>
										</div>
								</div>
								<div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="16% rated 4/5" data-placement="top">
										<div class="col-md col-sm-6">
												<div class="progress" style="height: 8px;">
														<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="16" style="width: 16%" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
										</div>
										<div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
												<div class="rating">
													<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
													<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
													<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
												</div>
										</div>
								</div>
								<div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="12% rated 3/5" data-placement="top">
										<div class="col-md col-sm-6">
												<div class="progress" style="height: 8px;">
														<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="12" style="width: 12%" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
										</div>
										<div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
												<div class="rating">
													<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
													<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
													<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
												</div>
										</div>
								</div>
								<div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="9% rated 2/5" data-placement="top">
										<div class="col-md col-sm-6">
												<div class="progress" style="height: 8px;">
														<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="9" style="width: 9%" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
										</div>
										<div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
												<div class="rating">
													<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
													<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
													<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
												</div>
										</div>
								</div>
								<div class="row align-items-center mb-8pt" data-toggle="tooltip" data-title="0% rated 0/5" data-placement="top">
										<div class="col-md col-sm-6">
												<div class="progress" style="height: 8px;">
														<div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
										</div>
										<div class="col-md-auto col-sm-6 d-none d-sm-flex align-items-center">
												<div class="rating">
													<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
													<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
													<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
												</div>
										</div>
								</div>
						</div>
				</div>

				<div class="pb-16pt mb-16pt border-bottom row">
						<div class="col-md-3 mb-16pt mb-md-0">
								<div class="d-flex">
										<a href="javascript:void(0);" class="avatar avatar-sm mr-12pt">
												<!-- <img src="LB" alt="avatar" class="avatar-img rounded-circle"> -->
												<span class="avatar-title rounded-circle">LB</span>
										</a>
										<div class="flex">
												<p class="small text-muted m-0">2 วันที่ผ่านมา</p>
												<a href="javascript:void(0);" class="card-title">นศ.วิมวลัย</a>
										</div>
								</div>
						</div>
						<div class="col-md-9">
								<div class="rating mb-8pt">
									<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
									<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
									<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
								</div>
								<p class="text-70 mb-0">เนื้อหาแน่น ถ่ายทอดดี</p>
						</div>
				</div>

				<div class="pb-16pt mb-16pt border-bottom row">
						<div class="col-md-3 mb-16pt mb-md-0">
								<div class="d-flex">
										<a href="javascript:void(0);" class="avatar avatar-sm mr-12pt">
												<!-- <img src="UK" alt="avatar" class="avatar-img rounded-circle"> -->
												<span class="avatar-title rounded-circle">UK</span>
										</a>
										<div class="flex">
												<p class="small text-muted m-0">2 วันที่ผ่านมา</p>
												<a href="javascript:void(0);" class="card-title">นายอครเดช</a>
										</div>
								</div>
						</div>
						<div class="col-md-9">
								<div class="rating mb-8pt">
									<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
									<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
									<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
								</div>
								<p class="text-70 mb-0">อาจารย์เยี่ยมมากครับ</p>
						</div>
				</div>

				<div class="pb-16pt mb-24pt row">
						<div class="col-md-3 mb-16pt mb-md-0">
								<div class="d-flex">
										<a href="javascript:void(0);" class="avatar avatar-sm mr-12pt">
												<!-- <img src="AD" alt="avatar" class="avatar-img rounded-circle"> -->
												<span class="avatar-title rounded-circle">AD</span>
										</a>
										<div class="flex">
												<p class="small text-muted m-0">2 วันที่ผ่านมา</p>
												<a href="javascript:void(0);" class="card-title">นส.นฤมล</a>
										</div>
								</div>
						</div>
						<div class="col-md-9">
								<div class="rating mb-8pt">
									<span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
									<span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
									<span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
								</div>
								<p class="text-70 mb-0">อธิบายได้เข้าใจและเห็นภาพ</p>
						</div>
				</div>
		</div>
</div>

<div class="page-section">
		<div class="container page__container">
				<div class="page-heading">
						<h4>Top Development Courses</h4>
						<a href="compact-library-development.html" class="ml-sm-auto text-underline">See Development Courses</a>
				</div>
				<div class="position-relative carousel-card">
						<div class="js-mdk-carousel row d-block" id="carousel-courses1">
								<a class="carousel-control-next js-mdk-carousel-control mt-n24pt" href="#carousel-courses1" role="button" data-slide="next">
										<span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
										<span class="sr-only">Next</span>
								</a>
								<div class="mdk-carousel__content">
									<?php
										foreach ($data["Lesson"]['random'] as $Lesson)
										{
											$detail 	= engine::shorttext($Lesson['post_detail'], 100);
											$date 	  = engine::thaidate($Lesson['post_adddate']);
											echo
											"<div class='col-md-6 col-lg-4 col-xl-3 card-group-row__col'>
		                      <div class='card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card'>
		                          <a href='course/detail/{$Lesson['lesson_code']}' class='card-img-top js-image' data-position='' data-height='140'>
		                              <img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['lesson_cover']}' alt='course'>
		                              <span class='overlay__content'>
		                                  <span class='overlay__action d-flex flex-column text-center'>
		                                      <i class='material-icons icon-32pt'>play_circle_outline</i>
		                                      <span class='card-title text-white'>ตัวอย่าง</span>
		                                  </span>
		                              </span>
		                          </a>
		                          <div class='card-body flex'>
		                              <div class='d-flex'>
		                                  <div class='flex'>
		                                      <a class='card-title' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
		                                      <small class='text-50 font-weight-bold mb-4pt'>{$Lesson['teacher_name']}</small>
		                                  </div>
		                                  <a href='course/detail/{$Lesson['lesson_code']}' data-toggle='tooltip' data-title='เพิ่มในถูกใจ' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
		                              </div>
		                              <div class='d-flex'>
		                                  <div class='rating flex'>
		                                    <span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
		                                    <span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
		                                    <span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>
		                                  </div>
		                              </div>
		                          </div>
		                          <div class='card-footer'>
		                              <div class='row justify-content-between'>
		                                  <div class='col-auto d-flex align-items-center'>
		                                      <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
		                                      <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['duration']} ชม.</small></p>
		                                  </div>
		                                  <div class='col-auto d-flex align-items-center'>
		                                      <span class='material-icons icon-16pt text-black-50 mr-4pt'>play_circle_outline</span>
		                                      <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['count']} บท</small></p>
		                                  </div>
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
