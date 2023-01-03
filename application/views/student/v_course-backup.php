<div class="pt-32pt">
    <div class="container page__container d-flex flex-column flex-md-row align-items-center text-center text-sm-left">
        <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">

            <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                <h3 class="mb-2"><i class="material-icons">local_library</i> หลักสูตรของฉัน</h2>

                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="home">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="student">ข้อมูลผู้เรียน</a></li>
                    <li class="breadcrumb-item active">
                        หลักสูตรที่เรียนล่าสุด
                    </li>
                </ol>
            </div>
        </div>

        <div class="row" role="tablist">
            <div class="col-auto">
                <a href="student" class="btn btn-primary btn-icons"><i class="material-icons text-white icon--left">recent_actors</i> ข้อมูลผู้เรียน</a>
            </div>
        </div>

    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <?php

        $lesson_id  = $data["Lesson"]['Lastplay']['lesson_id'];
        $student    = engine::student("id");
        $url        = 'course/' . $lesson_id . "/" . $student;
        //---------------- get data -----------------//
        $course     = engine::api("get", $url);

        $data["Course-complete"]	= $course['course']['complete'];
        $data["Course-count"]	    = $course['course']['count'];

        $total    = 100/$data["Course-count"];
        $percent  = $data["Course-complete"]*$total;
        $percent = intval( $percent * 100 ) / 100;
        $course_status_complete['total']    = $data["Course-count"];
        $course_status_complete['current']  = $data["Course-complete"];
        $course_status_complete['percent']  = $percent;

        //print_r($data["Lesson"]['Lastplay']);?>

        <div class="card">
            <img src="https://<?php echo $data["Lesson"]['Lastplay']['school_s3_bucket'];?>.<?php echo $data["Lesson"]['Lastplay']['school_s3_url']?>/<?php echo $data["Lesson"]['Lastplay']['lesson_cover']?>" alt="TypeScript" class="card-img" style="max-width: 100%; width: initial;">
            <div class="fullbleed bg-primary" style="opacity: .5;"></div>
            <img src="https://<?php echo $data["Lesson"]['Lastplay']['school_s3_bucket'];?>.<?php echo $data["Lesson"]['Lastplay']['school_s3_url']?>/<?php echo $data["Lesson"]['Lastplay']['template_logo']?>" width="64" alt="Instruduction to TypeScript" class="rounded position-absolute" style="right: 1rem; top: 1rem;">
            <div class="card-body d-flex align-items-center justify-content-center fullbleed">
                <div>
                    <h2 class="text-white mb-16pt">หัวข้อ : <?php echo $data["Lesson"]['Lastplay']['topic_name']?></h2>
                    <div class="d-flex align-items-center mb-16pt justify-content-center">
                        <div class="d-flex align-items-center mr-16pt">
                            <span class="material-icons icon-16pt text-white-50 mr-4pt">access_time</span>
                            <p class="flex text-white-50 lh-1 mb-0">เล่นค้างนาทีที่ <?php echo $data["Lesson"]['Lastplay']['player_current']?></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-white-50 mr-4pt">play_circle_outline</span>
                            <p class="flex text-white-50 lh-1 mb-0">เวลาเรียน <?php echo $data["Lesson"]['Lastplay']['lesson_hour']?> ชั่วโมง</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="student/course/<?php echo $data["Lesson"]['Lastplay']['lesson_code']?>/<?php echo $data["Lesson"]['Lastplay']['topic_code']?>" class="btn btn-white mr-8pt">เรียนต่อ</a>
                        <a href="student/course/<?php echo $data["Lesson"]['Lastplay']['lesson_code']?>" class="btn btn-outline-white ml-0">เริ่มต้นใหม่</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-start">

            <div class="d-flex align-items-center mr-24pt">
                <a href="student/course/<?php echo $data["Lesson"]['Lastplay']['lesson_code']?>" class="mr-12pt">
                    <img src="https://<?php echo $data["Lesson"]['Lastplay']['school_s3_bucket'];?>.<?php echo $data["Lesson"]['Lastplay']['school_s3_url']?>/<?php echo $data["Lesson"]['Lastplay']['template_logo']?>" width="40" alt="Angular" class="rounded">
                </a>
                <div class="flex">
                    <a class="card-title" href="student/course/<?php echo $data["Lesson"]['Lastplay']['lesson_code']?>"><?php echo $data["Lesson"]['Lastplay']['lesson_name']?></a>
                    <p class="lh-1 mb-0">
                        <span class="text-50 small">สอนโดย</span>
                        <span class="text-50 small"><?php echo $data["Lesson"]['Lastplay']['teacher_name']?></span>
                    </p>
                </div>
            </div>

            <div class="d-flex align-items-center py-4pt" style="white-space: nowrap;">
              <small class="text-50 mr-8pt">ความคืบหน้า</small>
              <div class="rating mr-8pt">
                <span class="survey-progress">
                  <span class="survey-progress-bg">
                    <span class="survey-progress-fg" style="width: <?php echo $course_status_complete['percent'];?>%;"></span>
                  </span>
                </span>
              </div>
              <small class="text-50"><?php echo $course_status_complete['percent'];?>%</small>
            </div>

        </div>
    </div>
</div>

<div class="container page__container">
    <div class="page-section">

      <!--
        <div class="page-separator">
            <div class="page-separator__text">สถาบัน</div>
        </div>
        <div class="row card-group-row mb-lg-8pt">

            <?php

            foreach ($data["Lesson"]['instructor'] as $Instructor)
            {
              $detail 	= engine::shorttext($Lesson['post_detail'], 100);
              $date 	= engine::thaidate($Lesson['post_adddate']);
              echo
              "<div class='col-sm-4 card-group-row__col'>
                  <div class='card js-overlay card-sm stack--1 card-group-row__card' data-toggle='popover' data-trigger='click'>
                      <div class='card-body d-flex flex-column'>
                          <div class='d-flex align-items-center'>
                              <div class='flex'>
                                  <div class='d-flex align-items-center'>
                                      <div class='rounded mr-12pt z-0 o-hidden'>
                                          <div class=''>

                                              <img src='https://{$data["$Instructor"]['school_s3_bucket']}.{$data["$Instructor"]['school_s3_url']}/{$Instructor['template_logo']}' width='40' height='40' alt='{$Instructor['school_name']}' class='rounded'>
                                              <span class='overlay__content overlay__content-transparent'>
                                                  <span class='overlay__action d-flex flex-column text-center lh-1'>
                                                      <small class='h6 small text-white mb-0' style='font-weight: 500;'>80%</small>
                                                  </span>
                                              </span>
                                          </div>
                                      </div>
                                      <div class='flex'>
                                          <div class='card-title'>{$Instructor['school_name']}</div>
                                          <p class='flex text-black-50 lh-1 mb-0'><small>{$Instructor['count']} บทเรียน</small></p>
                                      </div>
                                  </div>
                              </div>
                              <a href='undefinedstudent-path.html' class='ml-4pt btn btn-sm btn-link text-secondary border-1 border-secondary'>เรียนต่อ</a>
                          </div>
                      </div>
                  </div>

                  <div class='popoverContainer d-none'>
                      <div class='media'>
                          <div class='media-left mr-12pt'>
                              <img src='https://{$data["$Instructor"]['school_s3_bucket']}.{$data["$Instructor"]['school_s3_url']}/{$Instructor['template_logo']}' width='40' height='40' alt='{$Instructor['school_name']}' class='rounded'>
                          </div>
                          <div class='media-body'>
                              <div class='card-title'>React Native</div>
                              <p class='text-black-50 d-flex lh-1 mb-0 small'>{$Instructor['count']} บทเรียน</p>
                          </div>
                      </div>
                      <p class='mt-16pt text-black-70'>Learn the fundamentals of working with React Native and how to create basic applications.</p>
                      <div class='my-32pt'>
                          <div class='d-flex align-items-center mb-8pt justify-content-center'>
                              <div class='d-flex align-items-center mr-8pt'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>50 minutes left</small></p>
                              </div>
                              <div class='d-flex align-items-center'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>play_circle_outline</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>12 lessons</small></p>
                              </div>
                          </div>
                          <div class='d-flex align-items-center justify-content-center'>
                              <a href='compact-student-path.html' class='btn btn-primary mr-8pt'>Resume</a>
                              <a href='compact-student-path.html' class='btn btn-outline-secondary ml-0'>Start over</a>
                          </div>
                      </div>
                      <div class='d-flex align-items-center'>
                          <small class='text-black-50 mr-8pt'>Your rating</small>
                          <div class='rating mr-8pt'>
                              <span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
                              <span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
                              <span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>
                          </div>
                          <small class='text-black-50'>4/5</small>
                      </div>
                  </div>
              </div>";
            }
            ?>
        </div>

        <div class="mb-32pt">
            <ul class="pagination justify-content-start pagination-xsm m-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                        <span>ก่อนหน้า</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 1">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 2">
                        <span>2</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span>ถัดไป</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>

        </div>

        -->

        <div class="page-separator">
            <div class="page-separator__text">หลักสูตรที่เพิมใหม่</div>
        </div>

        <div class="row card-group-row">

            <?php

            //echo "--</br>";
            //print_r($data["Lesson"]['list']);
            //echo "--</br>";

      			foreach ($data["Lesson"]['list'] as $Lesson)
      			{
      				$detail 	= engine::shorttext($Lesson['post_detail'], 100);
      				$date 	  = engine::thaidate($Lesson['post_adddate']);


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

      				echo
      				"<div class='col-lg-3 col-md-6 card-group-row__col'>
                  <div class='card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card'>
                      <a href='student/course/{$Lesson['lesson_code']}' class='card-img-top js-image' data-position='' data-height='140'>
                          <img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['lesson_cover']}' alt='course'>
                          <span class='overlay__content'>
                              <span class='overlay__action d-flex flex-column text-center'>
                                  <i class='material-icons icon-32pt'>play_circle_outline</i>
                                  <span class='card-title text-white'>เรียนต่อ</span>
                              </span>
                          </span>
                      </a>
                      <span class='corner-ribbon corner-ribbon--default-right-top corner-ribbon--shadow bg-accent text-white'>NEW</span>
                      <div class='card-body flex'>
                          <div class='d-flex'>
                              <div class='flex'>
                                  <a class='card-title' href='student/course/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                                  <small class='text-50 font-weight-bold mb-4pt'>{$Lesson['teacher_name']}</small>
                              </div>
                              <a href='student-take-course.html' data-toggle='tooltip' data-title='Add Favorite' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
                          </div>
                          <div class='d-flex'>
                              <div class='rating flex'>
                                <span class='rating__item'><span class='material-icons'>star</span></span>
                                <span class='rating__item'><span class='material-icons'>star</span></span>
                                <span class='rating__item rating__item__unactive'><span class='material-icons'>star_outline</span></span>
                              </div>
                          </div>
                      </div>
                      <div class='card-footer footer_line'>
                          <div class='row justify-content-between bottom__line'>
                              <div class='col-auto d-flex align-items-center'>
                                <span class='survey-progress'>
                                  <span class='survey-progress-bg'>
                                    <span class='survey-progress-fg' style='width: {$course_status_complete['percent']}%;'></span>
                                  </span>
                                </span>
                              </div>
                              <div class='col-auto d-flex align-items-center'>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>{$course_status_complete['percent']}%</small></p>
                              </div>
                          </div>
                          <div class='row justify-content-between'>
                              <div class='col-auto d-flex align-items-center'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['duration']} ชม.</small></p>
                              </div>
                              <div class='col-auto d-flex align-items-center'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>play_circle_outline</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['count_course']} บท</small></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>";
      			}

          	?>

        </div>

        <div class="mb-32pt">

            <ul class="pagination justify-content-start pagination-xsm m-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                        <span>ก่อนหน้า</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 1">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 2">
                        <span>2</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span>ถัดไป</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>

        </div>

        <!--

        <div class="page-separator">
            <div class="page-separator__text">การเงิน/การบัญชี</div>
        </div>



        <div class="row card-group-row">

            <div class="col-lg-3 col-md-6 card-group-row__col">

                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-overlay-onload-show data-popover-onload-show data-toggle="popover" data-trigger="click">

                    <a href="student-take-course.html" class="card-img-top js-image" data-position="" data-height="140">
                        <img src="theme/luma/assets/images/paths/sketch_430x168.png" alt="course">
                        <span class="overlay__content">
                            <span class="overlay__action d-flex flex-column text-center">
                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                <span class="card-title text-white">เรียนต่อ</span>
                            </span>
                        </span>
                    </a>

                    <div class="card-body flex">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title" href="student-take-course.html">Learn Sketch</a>
                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                            </div>
                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                        </div>
                        <div class="d-flex">
                            <div class="rating flex">
                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer footer_line">

                        <div class="row justify-content-between bottom__line">
                            <div class="col-auto d-flex align-items-center">
                              <span class="survey-progress">
                                <span class="survey-progress-bg">
                                  <span class="survey-progress-fg" style="width: 100%;"></span>
                                </span>
                              </span>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <p class="flex text-black-50 lh-1 mb-0"><small>100%</small></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>6 ชั่วโมง</small></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="theme/luma/assets/images/paths/sketch_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0">Learn Sketch</div>
                            <p class="lh-1 mb-0">
                                <span class="text-black-50 small">with</span>
                                <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                            </p>
                        </div>
                    </div>

                    <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                    <div class="mb-16pt">
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                        </div>
                    </div>




                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                            <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                        <div class="rating mr-8pt">
                          <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                          <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                          <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                        </div>
                        <small class="text-black-50">4/5</small>
                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 card-group-row__col">

                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">

                    <a href="student-take-course.html" class="card-img-top js-image" data-position="" data-height="140">
                        <img src="theme/luma/assets/images/paths/flinto_430x168.png" alt="course">
                        <span class="overlay__content">
                            <span class="overlay__action d-flex flex-column text-center">
                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                <span class="card-title text-white">เรียนต่อ</span>
                            </span>
                        </span>
                    </a>

                    <div class="card-body flex">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title" href="student-take-course.html">Learn Flinto</a>
                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                            </div>
                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                        </div>
                        <div class="d-flex">
                            <div class="rating flex">
                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer footer_line">

                        <div class="row justify-content-between bottom__line">
                            <div class="col-auto d-flex align-items-center">
                              <span class="survey-progress">
                                <span class="survey-progress-bg">
                                  <span class="survey-progress-fg" style="width: 90%;"></span>
                                </span>
                              </span>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <p class="flex text-black-50 lh-1 mb-0"><small>90%</small></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>6 ชั่วโมง</small></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="theme/luma/assets/images/paths/flinto_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0">Learn Flinto</div>
                            <p class="lh-1 mb-0">
                                <span class="text-black-50 small">with</span>
                                <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                            </p>
                        </div>
                    </div>

                    <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                    <div class="mb-16pt">
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                        </div>
                    </div>




                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                            <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                        <div class="rating mr-8pt">
                          <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                          <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                          <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                        </div>
                        <small class="text-black-50">4/5</small>
                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 card-group-row__col">
                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">
                    <a href="student-take-course.html" class="card-img-top js-image" data-position="" data-height="140">
                        <img src="theme/luma/assets/images/paths/photoshop_430x168.png" alt="course">
                        <span class="overlay__content">
                            <span class="overlay__action d-flex flex-column text-center">
                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                <span class="card-title text-white">เรียนต่อ</span>
                            </span>
                        </span>
                    </a>

                    <div class="card-body flex">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title" href="student-take-course.html">Learn Photoshop</a>
                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                            </div>
                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                        </div>
                        <div class="d-flex">
                            <div class="rating flex">
                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer footer_line">

                        <div class="row justify-content-between bottom__line">
                            <div class="col-auto d-flex align-items-center">
                              <span class="survey-progress">
                                <span class="survey-progress-bg">
                                  <span class="survey-progress-fg" style="width: 36%;"></span>
                                </span>
                              </span>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <p class="flex text-black-50 lh-1 mb-0"><small>36%</small></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>6 ชั่วโมง</small></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="theme/luma/assets/images/paths/photoshop_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0">Learn Photoshop</div>
                            <p class="lh-1 mb-0">
                                <span class="text-black-50 small">with</span>
                                <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                            </p>
                        </div>
                    </div>

                    <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                    <div class="mb-16pt">
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                        </div>
                    </div>

                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                            <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                        <div class="rating mr-8pt">
                          <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                          <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                          <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                        </div>
                        <small class="text-black-50">4/5</small>
                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 card-group-row__col">

                <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">

                    <a href="student-take-course.html" class="card-img-top js-image" data-position="" data-height="140">
                        <img src="theme/luma/assets/images/paths/mailchimp_430x168.png" alt="course">
                        <span class="overlay__content">
                            <span class="overlay__action d-flex flex-column text-center">
                                <i class="material-icons icon-32pt">play_circle_outline</i>
                                <span class="card-title text-white">เรียนต่อ</span>
                            </span>
                        </span>
                    </a>

                    <div class="card-body flex">
                        <div class="d-flex">
                            <div class="flex">
                                <a class="card-title" href="student-take-course.html">Newsletter Design</a>
                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                            </div>
                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                        </div>
                        <div class="d-flex">
                            <div class="rating flex">
                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer footer_line">

                        <div class="row justify-content-between bottom__line">
                            <div class="col-auto d-flex align-items-center">
                              <span class="survey-progress">
                                <span class="survey-progress-bg">
                                  <span class="survey-progress-fg" style="width: 25%;"></span>
                                </span>
                              </span>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <p class="flex text-black-50 lh-1 mb-0"><small>25%</small></p>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>6 ชั่วโมง</small></p>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popoverContainer d-none">
                    <div class="media">
                        <div class="media-left mr-12pt">
                            <img src="theme/luma/assets/images/paths/mailchimp_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                        </div>
                        <div class="media-body">
                            <div class="card-title mb-0">Newsletter Design</div>
                            <p class="lh-1 mb-0">
                                <span class="text-black-50 small">with</span>
                                <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                            </p>
                        </div>
                    </div>

                    <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                    <div class="mb-16pt">
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                            <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                        </div>
                    </div>




                    <div class="my-32pt">
                        <div class="d-flex align-items-center mb-8pt justify-content-center">
                            <div class="d-flex align-items-center mr-8pt">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                            <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                        <div class="rating mr-8pt">
                          <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                          <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                          <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                        </div>
                        <small class="text-black-50">4/5</small>
                    </div>

                </div>

            </div>

        </div>

        <div class="mb-32pt">

            <ul class="pagination justify-content-start pagination-xsm m-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true" class="material-icons">chevron_left</span>
                        <span>ก่อนหน้า</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 1">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Page 2">
                        <span>2</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span>ถัดไป</span>
                        <span aria-hidden="true" class="material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>

        </div> -->

        <!-- <div class="page-separator">
            <div class="page-separator__text">บทเรียนล่าสุด</div>
        </div>

        <div class="mb-lg-8pt">

            <div class="position-relative carousel-card">
                <div class="js-mdk-carousel row d-block" id="carousel-courses1">

                    <a class="carousel-control-next js-mdk-carousel-control mt-n24pt" href="#carousel-courses1" role="button" data-slide="next">
                        <span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="mdk-carousel__content">

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal " data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="student-take-course.html" class="js-image" data-position="left">
                                    <img src="theme/luma/assets/images/paths/angular_testing_430x168.png" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">เรียนต่อ</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="student-take-course.html">Angular Unit Testing</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                            </div>
                                            <small class="text-50">6 ชั่วโมง</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="theme/luma/assets/images/paths/angular_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Angular Unit Testing</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">with</span>
                                            <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="my-32pt">
                                    <div class="d-flex align-items-center mb-8pt justify-content-center">
                                        <div class="d-flex align-items-center mr-8pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                                        <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                                    <div class="rating mr-8pt">
                                      <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                      <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                      <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                    </div>
                                    <small class="text-black-50">4/5</small>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal " data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="student-take-course.html" class="js-image" data-position="left">
                                    <img src="theme/luma/assets/images/paths/angular_routing_430x168.png" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">เรียนต่อ</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="student-take-course.html">Angular Routing In-Depth</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                            </div>
                                            <small class="text-50">6 ชั่วโมง</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="theme/luma/assets/images/paths/angular_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Angular Routing In-Depth</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">with</span>
                                            <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="my-32pt">
                                    <div class="d-flex align-items-center mb-8pt justify-content-center">
                                        <div class="d-flex align-items-center mr-8pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                                        <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                                    <div class="rating mr-8pt">
                                      <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                      <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                      <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                    </div>
                                    <small class="text-black-50">4/5</small>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal " data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="student-take-course.html" class="js-image" data-position="left">
                                    <img src="theme/luma/assets/images/paths/angular_services_430x168.png" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">เรียนต่อ</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="student-take-course.html">Angular Services</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                            </div>
                                            <small class="text-50">6 ชั่วโมง</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="theme/luma/assets/images/paths/angular_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Angular Services</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">with</span>
                                            <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="my-32pt">
                                    <div class="d-flex align-items-center mb-8pt justify-content-center">
                                        <div class="d-flex align-items-center mr-8pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                                        <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                                    <div class="rating mr-8pt">
                                      <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                      <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                      <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                    </div>
                                    <small class="text-black-50">4/5</small>
                                </div>


                            </div>

                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">

                            <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay mdk-reveal js-mdk-reveal " data-partial-height="44" data-toggle="popover" data-trigger="click">

                                <a href="student-take-course.html" class="js-image" data-position="">
                                    <img src="theme/luma/assets/images/paths/angular_patterns_430x168.png" alt="course">
                                    <span class="overlay__content align-items-start justify-content-start">
                                        <span class="overlay__action card-body d-flex align-items-center">
                                            <i class="material-icons mr-4pt">play_circle_outline</i>
                                            <span class="card-title text-white">เรียนต่อ</span>
                                        </span>
                                    </span>
                                </a>

                                <div class="mdk-reveal__content">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex">
                                                <a class="card-title" href="student-take-course.html">Angular Patterns</a>
                                                <small class="text-50 font-weight-bold mb-4pt">Elijah Murray</small>
                                            </div>
                                            <a href="student-take-course.html" data-toggle="tooltip" data-title="Add Favorite" data-placement="top" data-boundary="window" class="ml-4pt material-icons text-20 card-course__icon-favorite">favorite_border</a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="rating flex">
                                              <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                              <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                              <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                            </div>
                                            <small class="text-50">6 ชั่วโมง</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popoverContainer d-none">
                                <div class="media">
                                    <div class="media-left mr-12pt">
                                        <img src="theme/luma/assets/images/paths/angular_40x40@2x.png" width="40" height="40" alt="Angular" class="rounded">
                                    </div>
                                    <div class="media-body">
                                        <div class="card-title mb-0">Angular Patterns</div>
                                        <p class="lh-1 mb-0">
                                            <span class="text-black-50 small">with</span>
                                            <span class="text-black-50 small font-weight-bold">Elijah Murray</span>
                                        </p>
                                    </div>
                                </div>

                                <p class="my-16pt text-black-70">Learn the fundamentals of working with Angular and how to create basic applications.</p>

                                <div class="mb-16pt">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Fundamentals of working with Angular</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Create complete Angular applications</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Working with the Angular CLI</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Understanding Dependency Injection</small></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons icon-16pt text-black-50 mr-8pt">check</span>
                                        <p class="flex text-black-50 lh-1 mb-0"><small>Testing with Angular</small></p>
                                    </div>
                                </div>

                                <div class="my-32pt">
                                    <div class="d-flex align-items-center mb-8pt justify-content-center">
                                        <div class="d-flex align-items-center mr-8pt">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">access_time</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>50 นาที คงเหลือ</small></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="material-icons icon-16pt text-black-50 mr-4pt">play_circle_outline</span>
                                            <p class="flex text-black-50 lh-1 mb-0"><small>12 บทเรียน</small></p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="student-take-lesson.html" class="btn btn-primary mr-8pt">เรียนต่อ</a>
                                        <a href="student-take-course.html" class="btn btn-outline-secondary ml-0">เริ่มต้นใหม่</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <small class="text-black-50 mr-8pt">คะแนนจากคุณ</small>
                                    <div class="rating mr-8pt">
                                      <span class="rating__item"><span class="material-icons">sentiment_very_dissatisfied</span></span>
                                      <span class="rating__item"><span class="material-icons">sentiment_neutral</span></span>
                                      <span class="rating__item rating__item__unactive"><span class="material-icons">sentiment_very_satisfied</span></span>
                                    </div>
                                    <small class="text-black-50">4/5</small>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div> -->

        <div class="page-separator">
            <div class="page-separator__text">ประกาศนียบัตร / ใบรับรอง</div>
        </div>

        <!-- <div class="page-heading">
        <h4>Achievements</h4>
        <a
        href=""
        class="text-underline ml-sm-auto">My achievements</a>
        </div> -->

        <div class="position-relative carousel-card">
            <div class="js-mdk-carousel row d-block" id="carousel-achievements">

                <a class="carousel-control-next js-mdk-carousel-control" href="#carousel-achievements" role="button" data-slide="next">
                    <span class="carousel-control-icon material-icons" aria-hidden="true">keyboard_arrow_right</span>
                    <span class="sr-only">Next</span>
                </a>

                <div class="mdk-carousel__content">

                    <div class="col-12 col-sm-6">

                        <a class="card border-0 mb-0" href="certified/display/ICA031824512A002">
                            <img src="theme/luma/assets/images/achievements/flinto.png" alt="Flinto" class="card-img" style="max-height: 100%; width: initial;">
                            <div class="fullbleed bg-primary" style="opacity: .5;"></div>
                            <span class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                <span class="row flex-nowrap">
                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                        <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block">ใบประกาศนียบัตร</span>
                                        <span class="text-white-60 d-block mb-24pt">Jun 5, 2018</span>
                                    </span>
                                    <span class="col d-flex flex-column">
                                        <span class="text-right flex mb-16pt">
                                            <img src="theme/luma/assets/images/paths/flinto_40x40@2x.png" width="64" alt="Flinto" class="rounded">
                                        </span>
                                    </span>
                                </span>
                                <span class="row flex-nowrap">
                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                        <img src="theme/luma/assets/images/illustration/achievement/128/white.png" width="64" alt="achievement">
                                    </span>
                                    <span class="col d-flex flex-column">
                                        <span>
                                            <span class="card-title text-white mb-4pt d-block">Flinto</span>
                                            <span class="text-white-60">Introduction to The App Design Application</span>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </a>

                    </div>

                    <div class="col-12 col-sm-6">

                        <a class="card border-0 mb-0" href="certified/display/ICA031824512A002">
                            <img src="theme/luma/assets/images/achievements/angular.png" alt="Angular fundamentals" class="card-img" style="max-height: 100%; width: initial;">
                            <div class="fullbleed bg-primary" style="opacity: .5;"></div>
                            <span class="card-body d-flex flex-column align-items-center justify-content-center fullbleed">
                                <span class="row flex-nowrap">
                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                        <span class="h5 text-white text-uppercase font-weight-normal m-0 d-block">ใบรับรอง</span>
                                        <span class="text-white-60 d-block mb-24pt">Jun 5, 2018</span>
                                    </span>
                                    <span class="col d-flex flex-column">
                                        <span class="text-right flex mb-16pt">
                                            <img src="theme/luma/assets/images/paths/angular_64x64.png" width="64" alt="Angular fundamentals" class="rounded">
                                        </span>
                                    </span>
                                </span>
                                <span class="row flex-nowrap">
                                    <span class="col-auto text-center d-flex flex-column justify-content-center align-items-center">
                                        <img src="theme/luma/assets/images/illustration/achievement/128/white.png" width="64" alt="achievement">
                                    </span>
                                    <span class="col d-flex flex-column">
                                        <span>
                                            <span class="card-title text-white mb-4pt d-block">Angular fundamentals</span>
                                            <span class="text-white-60">Creating and Communicating Between Angular Components</span>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </a>

                    </div>

                </div>
            </div>
        </div>


    </div>
</div>