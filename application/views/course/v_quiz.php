
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-nav bg-white border-top py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="quiz-nav d-flex align-items-center">
                    <li><a href="course-details.html"><i class="la la-arrow-left mr-2"></i>Back to Path</a></li>
                    <li>
                        <div class="d-flex align-items-center">
                            <a href="course-details.html">
                                <img src="images/angular.png" alt="">
                            </a>
                            <p>
                                <a href="course-details.html">Learn Angular 2</a><span class="d-block font-size-13">20 Courses</span>
                            </p>
                        </div>
                    </li>
                </ul>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-nav -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START QUIZ AREA
================================= -->
<section class="quiz-wrap">
    <div class="quiz-content-wrap bg-black padding-top-60px padding-bottom-60px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-content text-center">
                        <h2 class="section__title text-white">Skill Assessment</h2>
                        <p class="section__desc text-color-rgba mb-0 pt-2">Measure your skill to find out where to start.</p>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-content-wrap -->
    <div class="quiz-action-nav bg-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-action-content d-flex align-items-center justify-content-between">
                        <ul class="quiz-nav d-flex align-items-center">
                            <li><i class="la la-question-circle font-size-20 mr-2"></i>20 Questions</li>
                            <li><i class="la la-clock-o font-size-20 mr-2"></i>1m 20s</li>
                        </ul>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
    <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="quiz-ans-content">
                        <div class="d-flex align-items-center">
                            <span class="quiz-count icon-element icon--element bg-color-1 text-white mr-2">2</span>
                            <h3 class="widget-title font-weight-semi-bold">Question 2 of 20</h3>
                        </div>
                        <p class="pt-3 pb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam debitis dolorem enim eos esse et fuga, iusto labore saepe ut. A aut consequatur delectus error illum impedit maiores nam, numquam pariatur perferendis possimus provident</p>
                        <div class="btn-box">
                            <a href="#" class="theme-btn theme-btn-light mr-2">Previous Question</a>
                            <a href="#" class="theme-btn theme-btn-light bg-color-1 text-white">Next Question</a>
                        </div>
                    </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="quiz-ans-content">
                        <h3 class="widget-title">Your Answer:</h3>
                        <ul class="py-3">
                            <li>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="chb1">
                                    <label for="chb1">Ability to use newer syntax and offers reliability</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="chb2" checked="checked">
                                    <label for="chb2">Compatibility</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="chb3">
                                    <label for="chb3">Usage of missing features</label>
                                </div>
                            </li>
                        </ul>
                        <p class="font-size-15"><strong class="primary-color">Note:</strong> There can be multiple correct answers to this question.</p>
                    </div>
                </div><!-- end col-lg-6 -->

            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-ans-wrap -->
</section><!-- end quiz-wrap -->
<!-- ================================
    END QUIZ AREA
================================= -->





<section class="inner-header bg-holder bg-overlay-black-90" style="background-image: url('<?php engine::html('img','images/bg/03.jpg');?>');">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
        <h1 class="breadcrumb-title mb-0 text-white"><?php echo $data["Quiz"]['contest_name']?></h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb d-flex justify-content-center justify-content-md-end ml-auto">
          <li class="breadcrumb-item"><a href="student"><i class="fas fa-user mr-1"></i>ข้อมูลส่วนตัว</a></li>
          <li class="breadcrumb-item active"><span><?php echo $data["Lesson"]['lesson_name']?></span></li>
          <li class="breadcrumb-item active"><span>แบบทดสอบ</span></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="space-pb">
  <div class="container">
    <div class="row">
      <div class="col-md-5 col-xl-4 position-relative z-index-1 mt-n5">
        <div class="course-sidebar">
          <img class="img-fluid" src="https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url']?>/<?php echo $data["Lesson"]['lesson_cover']?>" alt="">
          <div class="border border-top-0">
            <ul class="pl-0 pt-3 mb-0">
              <li class="border-bottom py-2 px-4 d-flex align-items-center">
                <span class="lead mr-auto text-dark font-weight-bold">ข้อที่ :</span>
                <span><?php echo $_SESSION["Quiz"]['current_question']?></span>
              </li>
              <li class="border-bottom py-2 px-4 d-flex align-items-center">
                <span class="lead mr-auto text-dark font-weight-bold">ทั้งหมด :</span>
                <span><?php echo $_SESSION["Quiz"]['total_question']?></span>
              </li>
              <li class="border-bottom py-2 px-4 d-flex align-items-center">
                <a class="btn btn-sm btn-block btn-primary" href="student/course/<?php echo $data["Lesson"]['lesson_code']?>">กลับสู่บทเรียน</a>
              </li>
            </ul>
            <!-- <a class="btn btn-md btn-primary mx-4 my-4 d-block" href="#">Buy ticket</a> -->
          </div>

          <div class="course-countdown" id="timer-count">
            <div class="countdown">
              <h4 class="hours-">21</h4>
              <p class="hours_ref- text-primary mb-0">คะแนนเก่า</p>
            </div>
            <div class="countdown">
              <h4 class="minutes-"><span id="minutes">00</span></h4>
              <p class="minutes_ref- text-primary mb-0">นาที</p>
            </div>
            <div class="countdown">
              <h4 class="seconds-"><span id="seconds">00</span></h4>
              <p class="seconds_ref- text-primary mb-0">วินาที</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-xl-8 space-sm-pt">

        <!--

        <ul class="meta-course">
          <li><i class="far fa-calendar"></i>September 27, 2021</li>
          <li><i class="fas fa-map-marker-alt"></i>6580 Allison Turnpike Creminfort, AL 32808-4509</li>
        </ul>

        -->

        <h4 class="mb-4">โจทย์ :</h4>
        <p class="mb-4 mb-sm-5"><?php echo preg_replace('~<p[^>]*>~', '', $_SESSION["Quiz"]['question'][$_SESSION["Quiz"]['current_index']]['quiz_content']);?></p>
        <h4 class="mb-4">คำตอบ :</h4>
        <div class="row mb-3">

          <?php

          foreach ($_SESSION["Quiz"]['question'][$_SESSION["Quiz"]['current_index']]['answer'] as $Answer)
          {
            $contest_code = $_SESSION["Quiz"]['token'];
            $quiz_id      = $_SESSION["Quiz"]['question'][$_SESSION["Quiz"]['current_index']]['quiz_id'];
            $user_answer  = $_SESSION["QuizProgress"]["{$contest_code}"]["{$quiz_id}"]['answer'];

            if($user_answer==$Answer['answer_id'])
            {
              $check = "checked";
            }
            else
            {
              $check = "";
            }

            echo
            "<div class='col-xl-6 mb-4'>
              <div class='border p-4 rounded-sm h-100 answer-block'>

                <div class='form-group'>
                    <div class='custom-control custom-radio'>
                        <input id='answer_id_{$Answer['answer_id']}' name='answer' type='radio' class='custom-control-input' value='{$Answer['answer_id']}' {$check}>
                        <label for='answer_id_{$Answer['answer_id']}' class='custom-control-label'>{$Answer['answer_name']}</label>
                    </div>
                </div>

              </div>
            </div>";
          }

          ?>

        </div>

        <div class="mb-2 mb-sm-3">
          <nav class="navigation post-navigation">
            <div class="nav-links">
                <div class="nav-previous">
                  <?php echo $_SESSION["Quiz"]['prev'];?>
                </div>
                <div class="nav-next">
                  <?php echo $_SESSION["Quiz"]['next'];?>
                </div>
              </div>
            </nav>
          </div>

      </div>
    </div>
  </div>
</section>
