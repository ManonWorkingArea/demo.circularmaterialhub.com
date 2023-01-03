
<!-- ================================ END BREADCRUMB AREA ================================= -->

<!--====================================== START COURSE DETAIL ======================================-->


                    <?php

                    if($data["enroll"]=="yes")
                    {
                      if($data["player"]['topic_code']=="")
                      {
                        $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เริ่มเรียน</a>";
                      }
                      else
                      {
                        $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เรียนต่อ</a>";
                      }
                    }
                    else if($data["enroll"]=="no")
                    {
                      $enrollBtn = "<a href='javascript:void(0);' class='theme-btn w-100 mb-3' onclick='assignCourse(\"{$data["Lesson"]['lesson_token']}\");'>ลงทะเบียนคอร์สนี้</a>";
                    }

                    ?>


                    <?php if($data["enroll"]=="yes"): ?>



				<?php

        $lesson_code     = $data["Lesson"]['lesson_code'];
        $topic_code      = $data["Lesson"]['first']['topic_code'];
        $student         = engine::student("id");

        //รายละเอียดคอร์ส
        //---------------- get data -----------------//
    		$url    = 'lesson/player/' . $lesson_code . "/" . $topic_code . "/" . $student;
    		$lesson = engine::api("GET", $url);
    		$data["Lesson"]					      = $lesson;
    		$data["Lesson"]['additional']	= $lesson['additional'];
        $data["Course"]					      = $lesson['course'];
        $data["Topic"]					      = $lesson['topic'];
        $data["Player"]					      = $lesson['player'];
        // Player
        $_SESSION["Player"]           = $lesson['player'];

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
          $data["Certification"]	  = $course['certification'];

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

        if($percent<="0")
        {
          $label = "ยังไม่ได้เริ่มเรียน";
        }
        else if($percent<"100")
        {
          $label = "กำลังเรียน";
        }
        else if($percent>="100")
        {
          $label = "เรียนจบแล้ว";
        }

        $course_status_complete['total']    = $data["Course-count"];
        $course_status_complete['current']  = $data["Course-complete"];
        $course_status_complete['percent']  = $percent;
        $course_status_complete['label']    = $label;

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
          $next_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course;
        }

        if($player_mode=="step")
        {
          // Media Source
          if($isPlay=="1")
          {
            $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
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
          $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
          //$poster_source  = $course['course']['endpoint'] . $data["Topic"]['topic_poster'];
          $poster_source  = $course['course']['endpoint'] . $data["Lesson"]['lesson_cover'];
        }

        //********************************************** CERTIFICATE

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

        //********************************************** CERTIFICATE


        if($data["enroll"]=="yes")
        {
          if($data["player"]['topic_code']=="")
          {
            if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
            {
              $enrollBtn      = "<a href='course/quiz/{$current_course}/{$data["Quiz"]['before']['contest_token']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> ทำแบบทดสอบก่อนเรียน</span> <span class='continue_name_btn'>{$data["Quiz"]['before']['contest_name']} ({$data["Quiz"]['before']['contest_choice']} ข้อ)</span></a>";
              $currentCourse  = $data["Lesson"]['first']['course_id'];
            }
            else
            {
              $enrollBtn      = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='btn w-100 btn-primary'>เริ่มเรียน</a>";
              $currentCourse  = $data["Lesson"]['first']['course_id'];
            }
          }
          else
          {
            if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
            {
              $enrollBtn      = "<a href='course/quiz/{$current_course}/{$data["Quiz"]['before']['contest_token']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> ทำแบบทดสอบก่อนเรียน</span> <span class='continue_name_btn'>{$data["Quiz"]['before']['contest_name']} ({$data["Quiz"]['before']['contest_choice']} ข้อ)</span></a>";
              $currentCourse  = $data["player"]['course_id'];
            }
            else
            {
              $enrollBtn      = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> เรียนต่อ</span> <span class='continue_name_btn'>เนื้อหา : {$data["player"]['topic_name']} ({$data["player"]['player_current']})</span></a>";
              $currentCourse  = $data["player"]['course_id'];
            }
          }
        }
        else if($data["enroll"]=="no")
        {
          $enrollBtn = "<a href='#' class='theme-btn w-100 mb-3'>ลงทะเบียนคอร์สนี้</a>";
        }


        if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
        {

        }
        else if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="true")
        {

        }

        //print_r($data["Course"]);
        foreach ($data["Course"] as $Course)
        {

          if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="true")
          {
            $show       = ($currentCourse==$Course['course_id']) ? "show" : "";
            $show_arrow = ($currentCourse==$Course['course_id']) ? "true" : "false";
            $show_bg    = ($currentCourse==$Course['course_id']) ? "bg-lastplay" : "";
          }
          else
          {
            $show       = ($currentCourse==$Course['course_id']) ? "show" : "";
            $show_arrow = ($currentCourse==$Course['course_id']) ? "true" : "false";
            $show_bg    = ($currentCourse==$Course['course_id']) ? "bg-lastplay" : "";
          }

          $main ++;


          $sub = "1";

          foreach ($Course['topic'] as $Topic)
          {
            //******************************* OPEN LESSON
            //
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
                if($data["Quiz"]['before']['contest_id']!=""||$data["Quiz"]['before']['contest_id']!=NULL)
                {
                  // Check Quiz before Status
                  if($data["Quiz_status"]['before']['status']=="false")
                  {
                    $topic_icon     = "play-circle";
                    $topic_text     = "bold";
                    $topic_color    = "text-primary";
                    $topic_percent  = "50";
                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                    $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                      $topic_icon     = "play-circle";
                      $topic_text     = "bold";
                      $topic_color    = "text-primary";
                      $topic_percent  = "50";
                      $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                      $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                    $topic_icon     = "play-circle";
                    $topic_text     = "bold";
                    $topic_color    = "text-primary";
                    $topic_percent  = "50";
                    $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                    $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  $topic_icon     = "play-circle";
                  $topic_text     = "bold";
                  $topic_color    = "text-primary";
                  $topic_percent  = "50";
                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                  $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  $topic_icon     = "play-circle";
                  $topic_text     = "bold";
                  $topic_color    = "text-primary";
                  $topic_percent  = "50";
                  $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                  $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                $topic_title  =
                "<a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                    <span class='course-title col-md-8'><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['contest']['contest_name']} {$topic_msg}</span>
                    <span class='course-percent col-md-2'>

                    <div class='progress'>
                        <div class='progress-bar bg-success' style='width: {$total_player_time}%'>
                            <span class='progress-label'>เรียนแล้ว {$total_player_time}%</span>
                        </div>
                    </div>
                    </span>
                    <span class='course-duration col-md-2'>{$Topic['contest']['contest_choice']} ข้อ</span>
                </a>
                ";
              }
              else
              {
                $topic_title  =
                "<a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                    <span><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['topic_name']} {$topic_msg}</span>
                    <span class='course-duration'>{$Topic['topic_duration']}</span>
                </a>";
              }
            }
            else if($player_mode=="step") //******************************* STEP LESSON TYPE
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
                if($data["Quiz"]['before']['contest_id']!=""||$data["Quiz"]['before']['contest_id']!=NULL)
                {
                  // Check Quiz before Status
                  if($data["Quiz_status"]['before']['status']=="false")
                  {
                    $topic_icon     = "lock";
                    $topic_text     = "normal";
                    $topic_color    = "text-mute";
                    $topic_percent  = "0";
                    $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ทำแบบทดสอบก่อนเรียน..</span>";
                    $topic_url      = "none";
                    $topic_option   = "topic-option-unactive";
                    $course_active  = "course-inactive";
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
                      $course_active  = "";
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
                      $course_active  = "";
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
                      $course_active  = "course-inactive";
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
                    $course_active  = "";
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
                    $course_active  = "";
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
                    $course_active  = "course-inactive";
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
                  //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                  $course_active  = "course-inactive";
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
                  $course_active  = "";
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
                  $course_active  = "";
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
                  $course_active  = "course-inactive";
                }
              }

              $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

              if($total_player_time>"100")
              {
                $total_player_time ="100";
              }

              if($Topic['topic_type']=="7")
              {
              }
              else
              {
              }
            }

            $active = ($data["Topic"]['topic_id'] == $Topic['topic_id']) ? "active" : "";

            $sub++;
          }

}
?>

<?php else: ?>


				<?php

        if($data["enroll"]=="yes")
        {
          if($data["player"]['topic_code']=="")
          {
            $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เริ่มเรียน</a>";
          }
          else
          {
            $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เรียนต่อ</a>";
          }
        }
        else if($data["enroll"]=="no")
        {
          $enrollBtn = "<a href='javascript:void(0);' class='theme-btn w-100 mb-3' onclick='assignCourse(\"{$data["Lesson"]['lesson_token']}\");'>ลงทะเบียนคอร์สนี้</a>";
        }

        $corder = "1";

				foreach ($data["Lesson"]['course'] as $Course)
				{
					if($corder=="1")
					{
						$show = "show";
					}
					else
					{
						$show = "";
					}
                  $torder = "1";

                  foreach ($Course['topic'] as $Topic)
                  {
                    if($Topic['topic_type']=="2") // บทเรียน
                    {
                      if($Topic['topic_demo']=="1")
                      {

                      }
                      else
                      {

                      }
                      $torder++;
                    }
                    else if($Topic['topic_type']=="7") // แบบทดสอบ
                    {

                    }
                  }

					$corder++;
				}
				?>

<?php endif; ?>



<!-- ================================ START BREADCRUMB AREA ================================= -->
<section class="breadcrumb-area breadcrumb-area-course breadcrumb-detail-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content breadcrumb-detail-content">
                    <div class="section-heading">
                        <span class="badge-label">คอร์สขายดี</span>
                        <h2 class="section__title mt-1"><?php echo $data["Lesson"]['lesson_name'];?></h2>
                        <h4 class="widget-title mt-2"><?php echo $data["Lesson"]['lesson_short_detail'];?></h4>
                    </div>
                    <ul class="breadcrumb__list mt-2">
                        <li>วิทยากร<?php echo $data["Teacher"]['teacher_name']?></li>
                        <!-- <li>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star-half-o"></i>
                            0 (0 ความนิยม)
                        </li>
                        <li>0 นักเรียนที่ลงทะเบียน</li> -->
                        <li><i class="la la-globe"></i> <?php echo $data["Lesson"]['department'][0]['department_name'];?></li>
                        <li>อัพเดตล่าสุดเมื่อ <?php echo engine::thaidate($data["Lesson"]['lesson_adddate']);?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================ END BREADCRUMB AREA ================================= -->

<!--====================================== START COURSE DETAIL ======================================-->

<section class="course-detail margin-bottom-20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 order-sm-1">
                <div class="course-detail-content-wrap margin-top-40px">

                    <div class="description-wrap margin-bottom-40px">
                        <h3 class="widget-title">คำอธิบายรายวิชา</h3>
                        <?php echo $data["Lesson"]['lesson_detail'];?>
                    </div><!-- end description-wrap -->

                    <!--======================================
                                STUDENT ENROLL CHECK || IS ENROLL
                    ======================================-->
                    <?php

                    if($data["enroll"]=="yes")
                    {
                      if($data["player"]['topic_code']=="")
                      {
                        $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เริ่มเรียน</a>";
                      }
                      else
                      {
                        $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เรียนต่อ</a>";
                      }
                    }
                    else if($data["enroll"]=="no")
                    {
                      $enrollBtn = "<a href='javascript:void(0);' class='theme-btn w-100 mb-3' onclick='assignCourse(\"{$data["Lesson"]['lesson_token']}\");'>ลงทะเบียนคอร์สนี้</a>";
                    }

                    ?>
                    <!--======================================
                                STUDENT ENROLL CHECK
                    ======================================-->
                </div><!-- end course-detail-content-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4 order-sm-12">
                <div class="sidebar-component">
                    <div class="sidebar">
                        <div class="sidebar-widget sidebar-preview">
                           <div class="sidebar-preview-titles">
                               <h3 class="widget-title"><i class="fa fa-home"></i> Course</h3>
                           </div>
                            <div class="preview-video-and-details">

                                <div class="preview-course-video">
                                    <a href="javascript:void(0)">
                                      <?php $cover = "https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$data["Lesson"]['lesson_cover']}";?>
                                      <img src="<?php echo $cover;?>" alt="course-img">
                                    </a>
                                </div>

                                <div class="preview-course-content">

                                    <?php if($data["enroll"]=="yes"): ?>

                                    <div class="progress">
                                        <div class="progress-bar bg-primary" style="width: <?php echo $course_status_complete['percent'];?>%"></div>
                                    </div>
                                    <div class="preview-course__step">
                                        <span class="step-text">ความคืบหน้าในการเรียน<small><?php echo $course_status_complete['label']?></small></span>
                                        <span class="step-percent"><?php echo $course_status_complete['percent']?>%</span>
                                    </div>

                                    <div class="buy-course-btn mb-3 text-center">
                                        <?php echo $enrollBtn;?>
                                    </div>

                                    <div class="buy-course-btn mb-3 text-center">
                                        <a href="javascript:void(0);" onclick="<?php echo $cert_link;?>" class="btn w-100 btn-warning continue_btn cert-<?php echo $cert_status;?>">
                                          <span class="continue_title_btn"><i class="fa fa-trophy"></i> ใบรับรองการเรียน</span>
                                          <span class="certified_name_btn"><?php echo $cert_status_text; ?></span>
                                        </a>
                                    </div>

                                  <?php else: ?>

                                    <p class="preview-course__price d-flex align-items-center">
                                      <span class="price-current">
                                      <?php
                                      $price = ($data["Lesson"]['lesson_sale_price']=="0") ? "เรียนฟรี" : engine::baht($data["Lesson"]['lesson_sale_price']) . " <small>บาท</small>";
                                      echo $price;
                      								?>
                                      </span>

                                      <span class="price-discount">100% off</span>
                                    </p>
                                    <p class="preview-price-discount__text">
                                      <span class="discount-left__text-text">โปรโมชั่นเรียนฟรี</span> ทุกคอร์ส ทุกหลักสูตร
                                    </p>

                                    <div class="buy-course-btn mb-3 text-center">
                                        <?php echo $enrollBtn;?>
                                    </div>

                                  <?php endif; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====================================== END COURSE DETAIL ======================================-->

<!--====================================== START COURSE DETAIL ====================================-->

<section class="course-detail margin-bottom-110px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-sm-1">
                <div class="course-detail-content-wrap">
                    <!--======================================
                                STUDENT ENROLL CHECK || IS ENROLL
                    ======================================-->
                    <?php if($data["enroll"]=="yes"): ?>

                      <div class="curriculum-wrap margin-bottom-60px">
                          <div class="curriculum-header d-flex align-items-center justify-content-between">
                              <div class="curriculum-header-left">
                                  <h3 class="widget-title">เนื้อหาหลักสูตรที่ลงทะเบียน</h3>
                              </div>
                              <div class="curriculum-header-right">
                                  <span class="curriculum-total__text"><strong>ทั้งหมด:</strong> <?php echo $data["Lesson"]['count_course']?> บทเรียน</span>
                                  <span class="curriculum-total__hours"><strong>เวลาเรียน:</strong> <?php echo $data["Lesson"]['duration_course']?> ชม.</span>
                              </div>
                          </div><!-- end curriculum-header -->


                          <div class="container">
                              <div class="row">

  															<?php

                                $lesson_code     = $data["Lesson"]['lesson_code'];
                                $topic_code      = $data["Lesson"]['first']['topic_code'];
                                $student         = engine::student("id");

                                //รายละเอียดคอร์ส
                                //---------------- get data -----------------//
                            		$url    = 'lesson/player/' . $lesson_code . "/" . $topic_code . "/" . $student;
                            		$lesson = engine::api("GET", $url);
                            		$data["Lesson"]					      = $lesson;
                            		$data["Lesson"]['additional']	= $lesson['additional'];
                                $data["Course"]					      = $lesson['course'];
                                $data["Topic"]					      = $lesson['topic'];
                                $data["Player"]					      = $lesson['player'];
                                // Player
                                $_SESSION["Player"]           = $lesson['player'];

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
                                  $data["Certification"]	  = $course['certification'];

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

                                if($percent<="0")
                                {
                                  $label = "ยังไม่ได้เริ่มเรียน";
                                }
                                else if($percent<"100")
                                {
                                  $label = "กำลังเรียน";
                                }
                                else if($percent>="100")
                                {
                                  $label = "เรียนจบแล้ว";
                                }

                                $course_status_complete['total']    = $data["Course-count"];
                                $course_status_complete['current']  = $data["Course-complete"];
                                $course_status_complete['percent']  = $percent;
                                $course_status_complete['label']    = $label;

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
                                  $next_url           = $GLOBALS["School"]['website'] . "course/play/" . $current_course;
                                }

                                if($player_mode=="step")
                                {
                                  // Media Source
                                  if($isPlay=="1")
                                  {
                                    $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
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
                                  $media_source   = $course['course']['endpoint'] . $data["Topic"]['topic_video'];
                                  //$poster_source  = $course['course']['endpoint'] . $data["Topic"]['topic_poster'];
                                  $poster_source  = $course['course']['endpoint'] . $data["Lesson"]['lesson_cover'];
                                }

                                //********************************************** CERTIFICATE

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

                                //********************************************** CERTIFICATE

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

                                  echo "</pre>";
                                }

                                if($data["enroll"]=="yes")
                                {
                                  if($data["player"]['topic_code']=="")
                                  {
                                    if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
                                    {
                                      $enrollBtn      = "<a href='course/quiz/{$current_course}/{$data["Quiz"]['before']['contest_token']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> ทำแบบทดสอบก่อนเรียน</span> <span class='continue_name_btn'>{$data["Quiz"]['before']['contest_name']} ({$data["Quiz"]['before']['contest_choice']} ข้อ)</span></a>";
                                      $currentCourse  = $data["Lesson"]['first']['course_id'];
                                    }
                                    else
                                    {
                                      $enrollBtn      = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='btn w-100 btn-primary'>เริ่มเรียน</a>";
                                      $currentCourse  = $data["Lesson"]['first']['course_id'];
                                    }
                                  }
                                  else
                                  {
                                    if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
                                    {
                                      $enrollBtn      = "<a href='course/quiz/{$current_course}/{$data["Quiz"]['before']['contest_token']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> ทำแบบทดสอบก่อนเรียน</span> <span class='continue_name_btn'>{$data["Quiz"]['before']['contest_name']} ({$data["Quiz"]['before']['contest_choice']} ข้อ)</span></a>";
                                      $currentCourse  = $data["player"]['course_id'];
                                    }
                                    else
                                    {
                                      $enrollBtn      = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> เรียนต่อ</span> <span class='continue_name_btn'>เนื้อหา : {$data["player"]['topic_name']} ({$data["player"]['player_current']})</span></a>";
                                      $currentCourse  = $data["player"]['course_id'];
                                    }
                                  }
                                }
                                else if($data["enroll"]=="no")
                                {
                                  $enrollBtn = "<a href='#' class='theme-btn w-100 mb-3'>ลงทะเบียนคอร์สนี้</a>";
                                }


                                if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="false")
                                {
                                  echo "
                                  <div class='card'>
                                    <div class='card-header bg-lastplay' id='before-contest'>
                                        <h2 class='mb-0'>
                                            <button class='btn btn-link btn-quiz d-flex align-items-center justify-content-between' type='button' onclick='page(\"course/quiz/{$current_course}/{$data["Quiz"]['before']['contest_token']}\");'>
                                                <i class='fa fa-mortar-board'></i> {$data["Quiz"]['before']['contest_name']}
                                                <span class='badge badge-topic'>{$data["Quiz"]['before']['contest_choice']} ข้อ</span>
                                            </button>
                                        </h2>
                                    </div>
                                  </div>
                                  ";
                                }
                                else if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="true")
                                {
                                  echo "
                                  <div class='card'>
                                    <div class='card-header' id='before-contest'>
                                        <h2 class='mb-0'>
                                            <button class='btn btn-link btn-quiz d-flex align-items-center justify-content-between' type='button' onclick='page(\"course/result/{$data["Quiz"]['before']['contest_token']}\");'>
                                                <i class='fa fa-mortar-board'></i> {$data["Quiz"]['before']['contest_name']} <span class='badge badge-success text-white'>{$data["Quiz_status"]['before']['score_number']}/{$data["Quiz"]['before']['contest_choice']} คะแนน</span>
                                                <span class='badge badge-topic'>{$data["Quiz"]['before']['contest_choice']} ข้อ</span>
                                            </button>
                                        </h2>
                                    </div>
                                  </div>
                                  ";
                                }

                                //print_r($data["Course"]);
                                foreach ($data["Course"] as $Course)
                                {

                                  if($data["Quiz"]['before']['contest_id']!="" && $data["Quiz_status"]['before']['status']=="true")
                                  {
                                    $show       = ($currentCourse==$Course['course_id']) ? "show" : "";
                                    $show_arrow = ($currentCourse==$Course['course_id']) ? "true" : "false";
                                    $show_bg    = ($currentCourse==$Course['course_id']) ? "bg-lastplay" : "";
                                  }
                                  else
                                  {
                                    $show       = ($currentCourse==$Course['course_id']) ? "show" : "";
                                    $show_arrow = ($currentCourse==$Course['course_id']) ? "true" : "false";
                                    $show_bg    = ($currentCourse==$Course['course_id']) ? "bg-lastplay" : "";
                                  }

                                  $main ++;


                                  $sub = "1";

                                  foreach ($Course['topic'] as $Topic)
                                  {
                                    //******************************* OPEN LESSON
                                    //
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
                                        if($data["Quiz"]['before']['contest_id']!=""||$data["Quiz"]['before']['contest_id']!=NULL)
                                        {
                                          // Check Quiz before Status
                                          if($data["Quiz_status"]['before']['status']=="false")
                                          {
                                            $topic_icon     = "play-circle";
                                            $topic_text     = "bold";
                                            $topic_color    = "text-primary";
                                            $topic_percent  = "50";
                                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                            $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                              $topic_icon     = "play-circle";
                                              $topic_text     = "bold";
                                              $topic_color    = "text-primary";
                                              $topic_percent  = "50";
                                              $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                              $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                            $topic_icon     = "play-circle";
                                            $topic_text     = "bold";
                                            $topic_color    = "text-primary";
                                            $topic_percent  = "50";
                                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                            $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          $topic_icon     = "play-circle";
                                          $topic_text     = "bold";
                                          $topic_color    = "text-primary";
                                          $topic_percent  = "50";
                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                          $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          $topic_icon     = "play-circle";
                                          $topic_text     = "bold";
                                          $topic_color    = "text-primary";
                                          $topic_percent  = "50";
                                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                                          $topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                        $topic_title  =
                                        "<a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                                            <span class='course-title col-md-8'><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['contest']['contest_name']} {$topic_msg}</span>
                                            <span class='course-percent col-md-2'>

                                            <div class='progress'>
                                                <div class='progress-bar bg-success' style='width: {$total_player_time}%'>
                                                    <span class='progress-label'>เรียนแล้ว {$total_player_time}%</span>
                                                </div>
                                            </div>
                                            </span>
                                            <span class='course-duration col-md-2'>{$Topic['contest']['contest_choice']} ข้อ</span>
                                        </a>
                                        ";
                                      }
                                      else
                                      {
                                        $topic_title  =
                                        "<a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                                            <span><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['topic_name']} {$topic_msg}</span>
                                            <span class='course-duration'>{$Topic['topic_duration']}</span>
                                        </a>";
                                      }
                                    }
                                    else if($player_mode=="step") //******************************* STEP LESSON TYPE
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
                                        if($data["Quiz"]['before']['contest_id']!=""||$data["Quiz"]['before']['contest_id']!=NULL)
                                        {
                                          // Check Quiz before Status
                                          if($data["Quiz_status"]['before']['status']=="false")
                                          {
                                            $topic_icon     = "lock";
                                            $topic_text     = "normal";
                                            $topic_color    = "text-mute";
                                            $topic_percent  = "0";
                                            $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ทำแบบทดสอบก่อนเรียน..</span>";
                                            $topic_url      = "none";
                                            $topic_option   = "topic-option-unactive";
                                            $course_active  = "course-inactive";
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
                                              $course_active  = "";
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
                                              $course_active  = "";
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
                                              $course_active  = "course-inactive";
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
                                            $course_active  = "";
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
                                            $course_active  = "";
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
                                            $course_active  = "course-inactive";
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
                                          //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          //$topic_url      = "course/play/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                                          $course_active  = "course-inactive";
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
                                          $course_active  = "";
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
                                          $course_active  = "";
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
                                          $course_active  = "course-inactive";
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
                                        "<div class='{$course_active}'>
                                            <a href='javascript:void(0)' class='primary-color-2' onclick='previewVideo(\"https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_video']}\",\"{$Topic['topic_name']}\");'>
                                              <span class='cover-thumbnail'>
                                                <span class='status-label status-label-demo'><span>{$Course['course_name']}</span></span>
                                                <img src='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_poster']}' class='w-100'>
                                              </span>
                                              <span class='cover-title cover-demo'><i class='fa fa-play-circle mr-2'></i>{$torder} : {$Topic['topic_name']} </span>
                                              <span class='cover-duration'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>
                                            </a>
                                        </div>

                                        <a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                                            <span class='course-title col-md-8'><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['contest']['contest_name']} {$topic_msg}</span>
                                            <span class='course-percent col-md-2'>

                                            <div class='progress'>
                                                <div class='progress-bar bg-success' style='width: {$total_player_time}%'>
                                                    <span class='progress-label'>เรียนแล้ว {$total_player_time}%</span>
                                                </div>
                                            </div>
                                            </span>
                                            <span class='course-duration col-md-2'>{$Topic['contest']['contest_choice']} ข้อ</span>
                                        </a>
                                        ";
                                      }
                                      else
                                      {
                                        $topic_title  =
                                        "
                                        <div class='col-md-3'>
                                            <div class='card-body'>
                                                <div class='list-items'>

                                                <div class='{$course_active}'>
                                                  <a href='javascript:void(0)' class='primary-color-2' onclick='page(\"{$topic_url}\");'>
                                                    <div class='cover-thumbnail'>
                                                      <div class='progress-label'>เรียนแล้ว {$total_player_time}%</div>
                                                      <div class='procress-label'>{$topic_msg}</div>
                                                      <!--<div class='status-label status-label-demo'><span>{$Course['course_name']}</span></div>-->
                                                      <img src='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_poster']}' class='w-100'>
                                                      <div class='progress'>
                                                          <div class='progress-bar bg-danger' style='width: {$total_player_time}%;'></div>
                                                      </div>
                                                    </div>
                                                    <div class='cover-title {$topic_color}'><i class='fa fa-{$topic_icon} mr-2'></i></i>{$Topic['topic_name']}</div>
                                                    <div class='cover-duration'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</div>
                                                  </a>
                                              </div>

                                              </div>
                                            </div>
                                        </div>

                                        <!--<a href='javascript:void(0)' class='{$topic_color} d-flex align-items-center justify-content-between' onclick='page(\"{$topic_url}\");'>
                                            <span class='course-title col-md-8'><i class='fa fa-{$topic_icon} mr-2'></i>{$Topic['topic_name']} {$topic_msg}</span>
                                            <span class='course-percent col-md-2'>

                                            <div class='progress'>
                                                <div class='progress-bar bg-success' style='width: {$total_player_time}%'>
                                                    <span class='progress-label'>เรียนแล้ว {$total_player_time}%</span>
                                                </div>
                                            </div>
                                            </span>
                                            <span class='course-duration col-md-2'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>
                                        </a>-->

                                        ";
                                      }
                                    }

                                    $active = ($data["Topic"]['topic_id'] == $Topic['topic_id']) ? "active" : "";
                                    $topic_item .= $topic_title;
                                    $sub++;
                                  }
                                }
                              echo $topic_item;
                          ?>

                              </div>
                          </div>
                      </div>

                    <!--======================================
                                STUDENT ENROLL CHECK || NOT ENROLL
                    ======================================-->
                    <?php else: ?>

                      <div class="curriculum-wrap margin-bottom-60px">
                          <div class="curriculum-header d-flex align-items-center justify-content-between">
                              <div class="curriculum-header-left">
                                  <h3 class="widget-title">เนื้อหาหลักสูตร</h3>
                              </div>
                              <div class="curriculum-header-right">
                                  <span class="curriculum-total__text"><strong>ทั้งหมด:</strong> <?php echo $data["Lesson"]['count_course']?> บทเรียน</span>
                                  <span class="curriculum-total__hours"><strong>เวลาเรียน:</strong> <?php echo $data["Lesson"]['duration_course']?> ชม.</span>
                              </div>
                          </div><!-- end curriculum-header -->

                          <div class="container">
                              <div class="row">

  															<?php

                                if($data["enroll"]=="yes")
                                {
                                  if($data["player"]['topic_code']=="")
                                  {
                                    $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["Lesson"]['first']['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เริ่มเรียน</a>";
                                  }
                                  else
                                  {
                                    $enrollBtn = "<a href='course/play/{$data["Lesson"]['lesson_code']}/{$data["player"]['topic_code']}' class='theme-btn w-100 theme-btn-dark'>เรียนต่อ</a>";
                                  }
                                }
                                else if($data["enroll"]=="no")
                                {
                                  $enrollBtn = "<a href='javascript:void(0);' class='theme-btn w-100 mb-3' onclick='assignCourse(\"{$data["Lesson"]['lesson_token']}\");'>ลงทะเบียนคอร์สนี้</a>";
                                }

                                $corder = "1";

  															foreach ($data["Lesson"]['course'] as $Course)
  															{
  																if($corder=="1")
  																{
  																	$show = "show";
  																}
  																else
  																{
  																	$show = "";
  																}

  																$topic_item .=
  																"";

                                          $torder = "1";

                                          foreach ($Course['topic'] as $Topic)
                                          {
                                            if($Topic['topic_type']=="2") // บทเรียน
                                            {
                                              if($Topic['topic_demo']=="1")
                                              {
                                                $topic_item .=
                                                "<div class='col-md-3'>
                                                  <div class='card-body'>
                                                    <div class='list-items'>
                                                      <div>
                                                          <a href='javascript:void(0)' class='primary-color-2' onclick='previewVideo(\"https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_video']}\",\"{$Topic['topic_name']}\");'>
                                                            <span class='cover-thumbnail'>
                                                              <span class='status-label status-label-demo'><span>{$Course['course_name']}</span></span>
                                                              <img src='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_poster']}' class='w-100'>
                                                            </span>
                                                            <span class='cover-title cover-demo'><i class='fa fa-play-circle mr-2'></i>{$Topic['topic_name']} </span>
                                                            <span class='cover-duration'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>
                                                          </a>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>";
                                              }
                                              else
                                              {
                                                $topic_item .=
                                                "<div class='col-md-3'>
                                                  <div class='card-body'>
                                                    <div class='list-items'>
                                                      <div>
                                                        <a href='javascript:void(0)' class=''>
                                                        <span class='cover-thumbnail'>
                                                        <span class='status-label'><span>{$Course['course_name']}</span></span>
                                                        <img src='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_poster']}' class='w-100'>
                                                        </span>
                                                        <span class='cover-title'><i class='fa fa-lock mr-2'></i>{$Topic['topic_name']} </span>
                                                        <span class='cover-duration'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>
                                                        </a>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>";
                                              }
                                              $torder++;
                                            }
                                            else if($Topic['topic_type']=="7") // แบบทดสอบ
                                            {
                                              $topic_item .=
                                              "<div>
                                                  <a href='javascript:void(0)' class=''>
                                                      <span><i class='fa fa-bolt mr-2'></i>{$Topic['contest']['contest_name']}</span>
                                                      <span class='cover-duration'><i class='fa fa-clock'></i> {$Topic['contest']['contest_time']} นาที / {$Topic['contest']['contest_choice']} ข้อ</span>
                                                  </a>
                                              </div>";
                                            }
                                          }


  																$corder++;
  															}

                                echo $topic_item;
  															?>
                              </div>
                          </div>
                      </div>

                    <?php endif; ?>
                    <!--======================================
                                STUDENT ENROLL CHECK
                    ======================================-->
                    <div class="section-block"></div>

                    <!-- <div class="instructor-wrap padding-top-50px padding-bottom-45px">
                        <h3 class="widget-title">เกี่ยวกับวิทยากร</h3>
                        <div class="instructor-content margin-top-30px d-flex">
                            <div class="instructor-img">

                                <ul class="list-items">
                                    <li><span class="la la-star"></span> 0 คะแนนความนิยม</li>
                                    <li><span class="la la-play-circle-o"></span> 2 หลักสูตร</li>
                                </ul>
                            </div>
                            <div class="instructor-details">
                                <div class="instructor-titles">
                                    <h3 class="widget-title"><?php echo $data["Teacher"]['teacher_name']?></h3>
                                    <p class="instructor__subtitle">เข้าร่วมเมื่อ 1 ปีที่ผ่านมา</p>
                                    <p class="instructor__meta"><?php echo $data["Teacher"]['teacher_detail']?></p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="review-wrap">
                        <!-- <h3 class="widget-title">คำติชมจากผู้เรียน</h3>
                        <div class="review-content margin-top-40px margin-bottom-50px d-flex"> -->

                            <!-- <div class="review-rating-summary">
                                <div class="review-rating-summary-inner d-flex align-items-end">
                                    <div class="stats-average__count">
                                        <span class="stats-average__count-count">0</span>
                                    </div>
                                    <div class="stats-average__rating d-flex">
                                        <ul class="review-stars d-flex">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">(0)</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="course-rating-text">
                                    <p class="course-rating-text__text">ความนิยมของหลักสูตร</p>
                                </div>
                            </div> -->

                            <!-- <div class="review-rating-widget">
                                <div class="review-rating-rate">
                                    <ul>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">5 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">0 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">4 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">0 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">3 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">0 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">2 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">0 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">1 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">0 %</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                        <div class="section-block"></div>
                        <!-- <div class="comments-wrapper margin-top-50px">
                            <h3 class="widget-title"> คำติชม</h3>
                            <ul class="comments-list padding-top-30px">
                                <li>
                                    <div class="comment">

                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <h3 class="comment__author">adam smith</h3>
                                                <p class="comment__date">17 Dec, 2018 - 4:00 pm</p>
                                                <ul class="review-stars review-stars1">
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                </ul>
                                            </div>
                                            <p class="comment-content">
                                                เนื้อหาดี สอนเข้าใจง่าย เรียนสนุก มีประโยชน์มาก
                                            </p>
                                            <div class="comment-reply">
                                                <a class="theme-btn" href="#" data-toggle="modal" data-target=".modal-action-form">
                                                    <span class="la la-mail-reply"></span> ตอบกลับ
                                                </a>
                                                <div class="helpful__action d-flex align-items-center">
                                                    <span class="helpful__action-text">บทวิจารณ์นี้มีประโยชน์หรือไม่?</span>
                                                    <button class="btn">ใช่</button>
                                                    <button class="btn">ไม่ใช่</button>
                                                    <div class="msg-action-dot">
                                                        <div class="dropdown">
                                                            <a class="action-dot" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu border" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target=".report-modal-form"><i class="la la-flag mr-2"></i>รายงานการละเมิด</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> -->

                    </div><!-- end review-wrap -->

                    <!-- <div class="report-modal-box">
                        <button type="button" class="theme-btn theme-btn-light" data-toggle="modal" data-target=".report-modal-form">
                            <i class="la la-flag font-size-18 mr-1"></i>รายงานการละเมิด

                        </button>
                    </div> -->



                </div>
            </div>
        </div>
    </div>
</section>
<!--======================================
        END COURSE DETAIL
======================================-->

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade report-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <div>
                        <h4 class="modal-title widget-title font-size-20"><span class="la la-flag mr-1"></span>Report Abuse</h4>
                        <p class="mt-2 font-size-15 line-height-26">
                            Flagged content is reviewed by FTI Academy staff to determine whether it violates Terms of Service or Community Guidelines.
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
                                        <option value="3">FTI Academy Policy Violation</option>
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

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade modal-action-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <h4 class="modal-title widget-title font-size-20">Reply to review</h4>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                </div>
                <div class="contact-form-action">
                    <form method="post">
                        <div class="input-box">
                            <div class="form-group">
                                <i class="la la-pencil input-icon"></i>
                                <textarea class="message-control form-control" name="message" placeholder="Write message here..." required></textarea>
                            </div>
                        </div>
                        <div class="btn-box text-right">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="theme-btn" >reply</button>
                        </div>
                    </form>
                </div><!-- end contact-form-action -->
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
                    <h4 class="modal-title widget-title font-size-20">Share this course</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <div class="copy-to-clipboard mb-3">
                        <div class="contact-form-action d-flex align-items-center">
                            <span class="success-message">Copied!</span>
                            <input type="text" class="form-control copy-input" value="https://www.fti.academy/share/101WxMB0oac1hVQQ==/">
                            <div class="copy-tooltip">
                                <button class="theme-btn theme-btn-light copy-text">Copy</button>
                            </div>
                        </div>
                    </div>
                    <ul class="social-profile">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Player -->
<?php engine::html("theme","css","player/start/content/global.css");?>
<?php engine::html("theme","js","player/start/java/FWDEVPlayer.js");?>


<!-- Setup EVP -->
<script type="text/javascript">

  FWDEVPUtils.onReady(function()
  {
    FWDEVPlayer.videoStartBehaviour = "pause";
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
      videoSource:[{source:"https://content.fti.academy/fti-weis/16074945192106155542/1607494538809604095/16074946591360337336/16074947011317283164.mp4", label:"Original"}],
      posterPath:"<?php echo $poster_source;?>",
      showErrorInfo:"no",
      fillEntireScreenWithPoster:"yes",
      disableDoubleClickFullscreen:"no",
      addKeyboardSupport:"yes",
      useChromeless:"no",
      showPreloader:"yes",
      preloaderColors:["#999999", "#FFFFFF"],
      autoPlay:"no",
      autoPlayText:"Click to Unmute",
      loop:"no",
      scrubAtTimeAtFirstPlay:"00:00:00",
      maxWidth:538,
      maxHeight:303,
      volume:.8,
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
      logoPosition:"topRight",
      logoLink:"<?php echo $GLOBALS["School"]['website'];?>",
      logoPath:"https://fti.academy/theme/interface/guruma/assets/images/player-logo.png",
      logoMargins:5,
      //controller settings
      showController:"yes",
      showDefaultControllerForVimeo:"no",
      showScrubberWhenControllerIsHidden:"yes",
      showControllerWhenVideoIsStopped:"yes",
      showVolumeScrubber:"no",
      showVolumeButton:"no",
      showTime:"no",
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
      showPlaybackRateButton:"no",
      defaultPlaybackRate:"1", //0.25, 0.5, 1, 1.25, 1.5, 2
      //sticky on scroll
      stickyOnScroll:"no",
      stickyOnScrollShowOpener:"yes",
      stickyOnScrollWidth:"450",
      stickyOnScrollHeight:"250",
      //sticky display settings
      showOpener:"no",
      showOpenerPlayPauseButton:"yes",
      verticalPosition:"bottom",
      horizontalPosition:"center",
      showPlayerByDefault:"yes",
      animatePlayer:"yes",
      openerAlignment:"right",
      mainBackgroundImagePath:"theme/interface/aduca/assets/player/start/content/minimal_skin_dark/main-background.png",
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
      thumbnailsPreview:"",
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

  function previewVideo(video,v_name)
  {

    mplayer.setVideoSource(video);
    window.dispatchEvent(new Event('resize'));
    $('#preview_video_title').text(v_name);
    $('#preview_video').modal('show');

    $('#preview_video').on('hidden.bs.modal', function ()
    {
      mplayer.stop();
      mplayer.setVideoSource("");
    })

    $('#preview_video').on('shown.bs.modal', function ()
    {
      mplayer.play();
    })

  }

</script>

<div class="modal-form">
    <div class="modal fade preview-modal-form" tabindex="-1" role="dialog" id="preview_video">
        <div class="modal-dialog modal-dialog-video modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <h5 class="modal-title">ตัวอย่างเนื้อหา : <span id="preview_video_title"></span></h5>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12">
                        <div id="avPlayer" style="margin:auto;"></div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div><!-- end modal -->
</div>

<style>
  .widget-title {
    min-height: 20px;
  }
</style>