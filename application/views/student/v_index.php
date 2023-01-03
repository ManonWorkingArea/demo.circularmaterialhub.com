
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area breadcrumb-area-member instructor-breadcrumb-area text-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                    <div class="bread-img-wrap flex-shrink-0">
                        <img src="<?php echo engine::student("avatar");?>" alt="">
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-40"><?php echo $data["Student"]['fullname']?></h2>
                        <p class="section__desc font-size-16 mb-1">โทร <?php echo $data["Student"]['phone']?> อีเมล์ <?php echo $data["Student"]['email']?></p>
                        <p class="section__desc font-size-16 mb-0">สมัครเมื่อ <?php echo engine::thaidate($data["Student"]['regdate'])?></p>
                    </div>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->

</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<div class="quiz-action-nav bg-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="quiz-action-content d-flex align-items-center justify-content-between">
                    <ul class="quiz-nav d-flex align-items-center">
                        <li><a href="student" class="active"><i class="fa fa-home"></i></a></li>
                        <li><a href="app"><span class="badge badge-dark"><?php echo $data["Overview"]['total']?></span> ใบสมัคร</a></li>
                        <li><a href="student/course"><span class="badge badge-dark"><?php echo $data["Overview"]['total']?></span> หลักสูตร</a></li>
                        <li><a href="student/certification"><span class="badge badge-dark"><?php echo $data["Overview"]['certification']?></span> ใบรับรองผล</a></li>
                        <li><a href="student/profile">ข้อมูลส่วนตัว</a></li>
                    </ul>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div>
<!--======================================
        START SPEAKER AREA
======================================-->
<section class="team-detail-area section-flat-padding">
    <div class="container">

      <div class="row mt-5">
              <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                  <div class="icon-box d-flex align-items-center">
                      <div class="icon-element icon-element-bg-1 flex-shrink-0">
                          <i class="la la-mouse-pointer"></i>
                      </div><!-- end icon-element-->
                      <div class="info-content">
                          <h4 class="info__title mb-2">คอร์สที่ลงทะเบียน</h4>
                          <span class="info__count"><?php echo $data["Overview"]['total']?></span>
                      </div><!-- end info-content -->
                  </div>
              </div><!-- end col-lg-4 -->
              <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                  <div class="icon-box d-flex align-items-center">
                      <div class="icon-element icon-element-bg-2 flex-shrink-0">
                          <i class="la la-file-text-o"></i>
                      </div><!-- end icon-element-->
                      <div class="info-content">
                          <h4 class="info__title mb-2">คอร์สที่เรียนอยู่</h4>
                          <span class="info__count"><?php echo $data["Overview"]['active']?></span>
                      </div><!-- end info-content -->
                  </div>
              </div><!-- end col-lg-4 -->
              <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                  <div class="icon-box d-flex align-items-center">
                      <div class="icon-element icon-element-bg-3 flex-shrink-0">
                          <i class="la la-graduation-cap"></i>
                      </div><!-- end icon-element-->
                      <div class="info-content">
                          <h4 class="info__title mb-2">คอร์สที่เรียนจบแล้ว</h4>
                          <span class="info__count"><?php echo $data["Overview"]['complete']?></span>
                      </div><!-- end info-content -->
                  </div>
              </div>
          </div>

          <div class="row padding-top-35px">
              <div class="col-lg-12">
                  <h3 class="widget-title pb-3">บทเรียนที่เข้าเรียนล่าสุด</h3>
                  <div class="section-block"></div>
              </div><!-- end col-lg-12 -->
          </div><!-- end row -->

        <div class="row padding-top-35px">

            <div class="col-lg-12">
              <div class="statement-table purchase-table table-responsive mb-5">
                  <table class="table">
                      <thead>
                      <tr>
                          <th scope="col" width="50%">ชื่อบทเรียน</th>
                          <th scope="col">หลักสูตร</th>
                          <th scope="col">เวลาที่บันทึก</th>
                      </tr>
                      </thead>
                      <tbody>

                        <?php

                        $order = "1";
                        foreach ($data["Lesson"]['player'] as $Player)
                        {
                          $date = engine::thaidate($Player['player_date']);

                          if($Player['player_status']=="2")
                          {
                            $status = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                          }
                          else
                          {
                            $status = "<span class='badge badge-notifications badge-primary'><i class='fa fa-play-circle'></i> กำลังเรียน..</span>";
                          }

                          if($Player['player_current']=="0")
                          {
                            $status = "<span class='badge badge-notifications badge-dark'><i class='fa fa-check-circle'></i> เริ่มต้นใหม่..</span>";
                          }
                          else
                          {
                            $current = $Player['player_current'];
                          }

                          echo
                          "<tr>
                              <th scope='row'>
                                  <div class='statement-info'>
                                      <ul class='list-items'>
                                          <li class='mb-1'>
                                              {$status}
                                              <span>{$date}</span>
                                          </li>
                                          <li class='mb-1'>
                                              <a href='student/course/{$Player['lesson_code']}/{$Player['topic_code']}' class='primary-color'>{$order}.{$Player['topic_name']}</a>
                                          </li>
                                      </ul>
                                  </div>
                              </th>
                              <td>
                                  <div class='statement-info'>
                                      <ul class='list-items'>
                                          <li>{$Player['lesson_name']}</li>
                                      </ul>
                                  </div>
                              </td>
                              <td>
                                  <div class='statement-info'>
                                      <ul class='list-items'>
                                          <li>{$current}</li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>

                          ";
                          $order++;
                        }

                        ?>


                      </tbody>
                  </table>
              </div>
            </div>
        </div>

        <div class="student-courses padding-top-20px">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="widget-title pb-3">คอร์สทั้งหมดที่ลงทะเบียนไว้</h3>
                    <div class="section-block"></div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            <div class="row mt-5">


              <?php

    						foreach ($data["Lesson"]['list'] as $Lesson)
    						{
    							$detail 	  = engine::shorttext($Lesson['post_detail'], 100);
    							$date 	    = engine::thaidate($Lesson['post_adddate']);

    							$lesson_id  = $Lesson['lesson_id'];
    							$student    = engine::student("id");
    							$url        = 'course/' . $lesson_id . "/" . $student;
    							//---------------- get data -----------------//
    							$course     = engine::api("get", $url);

    							$data["Course-complete"]	= $course['course']['complete'];
    							$data["Course-count"]	    = $course['course']['count'];

    							$total   = 100/$data["Course-count"];
    							$percent = $data["Course-complete"]*$total;
    							$percent = intval( $percent * 100 ) / 100;
    							$course_status_complete['total']    = $data["Course-count"];
    							$course_status_complete['current']  = $data["Course-complete"];
    							$course_status_complete['percent']  = $percent;

    							if($Lesson['lesson_counter']==""||$Lesson['lesson_counter']==NULL)
    							{
    								$visitor = "0";
    							}
    							else
    							{
    								$visitor = $Lesson['lesson_counter'];
    							}

                  //print_r($Lesson);

                  // Last Topic
                  if($Lesson["player"]['topic_code']=="")
                  {
                    if($Lesson["quiz"]['before']['contest_id']!="" && $Lesson["quiz_status"]['before']['status']=="false")
                    {
                      $enrollBtn      = "<a href='course/quiz/{$Lesson['lesson_code']}/{$Lesson["quiz"]['before']['contest_token']}' class='btn w-100 btn-primary continue_btn'><span class='continue_title_btn'><i class='fa fa-play-circle'></i> ทำแบบทดสอบก่อนเรียน</span> <span class='continue_name_btn'>{$Lesson["Quiz"]['before']['contest_name']} ({$Lesson["quiz"]['before']['contest_choice']} ข้อ)</span></a>";
                      $currentCourse  = $Lesson['first']['course_id'];
                    }
                    else
                    {
                      $enrollBtn      = "<a href='course/play/{$Lesson['lesson_code']}/{$Lesson['first']['topic_code']}' class='btn w-100 btn-primary'>เริ่มเรียน</a>";
                      $currentCourse  = $Lesson['first']['course_id'];
                    }
                  }
                  else
                  {
                    if($Lesson["quiz"]['before']['contest_id']!="" && $Lesson["quiz_status"]['before']['status']=="false")
                    {
                      $enrollBtn      = "
                      <a href='course/quiz/{$Lesson['lesson_code']}/{$Lesson["quiz"]['before']['contest_token']}' class='btn btn-block rating-btn'>
                        <i class='fa fa-play-circle mr-1'></i> {$Lesson["quiz"]['before']['contest_name']} ({$Lesson["quiz"]['before']['contest_choice']} ข้อ)
                      </a>
                      ";
                      $currentCourse  = $Lesson["player"]['course_id'];
                    }
                    else
                    {
                      $enrollBtn      = "
                      <a href='course/play/{$Lesson['lesson_code']}/{$Lesson["player"]['topic_code']}' class='btn btn-block rating-btn'>
                        <i class='fa fa-play-circle mr-1'></i> {$Lesson["player"]['topic_name']} ({$Lesson["player"]['player_current']})
                      </a>
                      ";
                      $currentCourse  = $Lesson["player"]['course_id'];
                    }
                  }

                  //print_r($currentCourse);

    							echo
    							"<div class='col-lg-4 column-td-half'>
                    <div class='card-item'>
                        <div class='card-image'>

                            <a href='course/detail/{$Lesson['lesson_code']}' class='card__img'>
                                <img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['lesson_cover']}' alt=''>
                                <div class='play-button'>
                                    <svg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' viewBox='-307.4 338.8 91.8 91.8' style=' enable-background:new -307.4 338.8 91.8 91.8;' xml:space='preserve'>
                                        <style type='text/css'>
                                            .st0{opacity:0.6;fill:#000000;border-radius: 100px;enable-background:new;}
                                            .st1{fill:#FFFFFF;}
                                        </style>
                                        <g>
                                        <circle class='st0' cx='-261.5' cy='384.7' r='45.9'></circle><path class='st1' d='M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z'></path>
                                        </g>
                                    </svg>
                                </div>
                            </a>
                        </div>

                        <div class='card-content p-4'>
                            <h3 class='card__title mt-0'>
                                <a href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                            </h3>
                            <p class='card__author'>
                                <span>เรียนจบแล้ว <strong>{$data["Course-complete"]}</strong> บท จากทั้งหมด <strong>{$data["Course-count"]}</strong> บทเรียน</span>
                            </p>
                            <div class='course-complete-bar-2 mt-2'>
                                <div class='progress-item mb-0'>
                                    <p class='skillbar-title'>ความคืบหน้า :</p>
                                    <div class='skillbar-box mt-1'>
                                        <div class='skillbar' data-percent='{$course_status_complete['percent']}%'>
                                            <div class='skillbar-bar skillbar-bar-1' style='width: {$course_status_complete['percent']}%;'></div>
                                        </div>
                                    </div>
                                    <div class='skill-bar-percent'>{$course_status_complete['percent']}%</div>
                                </div>
                            </div>
                            <div class='rating-wrap d-flex mt-3'>
                                {$enrollBtn}
                            </div>
                        </div>

                    </div>
                </div>";
    						}

    						?>


            </div>
        </div><!-- end student-courses -->

    </div><!-- end container -->
</section><!-- end team-detail-area -->
<!--======================================
        END SPEAKER AREA
======================================-->
