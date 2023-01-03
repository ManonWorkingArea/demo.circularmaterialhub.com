

<!-- ================================
    START QUIZ AREA
================================= -->
<section class="quiz-wrap">
    <div class="breadcrumb-nav bg-white border-top py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="quiz-nav d-flex align-items-center">
                        <li><a href="course/detail/<?php echo $data["Lesson"]['lesson_code'];?>"><i class="la la-arrow-left mr-2"></i>ย้อนกลับ</a></li>
                        <li>
                            <div class="d-flex align-items-center">
                                <p>
                                    <a href="course/detail/<?php echo $data["Lesson"]['lesson_code'];?>"><?php echo $data["Lesson"]['lesson_name'];?></a><span class="d-block font-size-13"><?php echo $data["Teacher"]['teacher_name']?></span>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end breadcrumb-nav -->
    <div class="quiz-content-wrap bg-black padding-top-60px padding-bottom-60px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-content text-center">
                        <p class="lead font-weight-regular font-size-18 text-color-rgba mb-0 pb-2">ส่งคะแนนเมื่อ <?php echo engine::thaidate($data["Score"]['score_adddate']);?></p>
                        <h2 class="section__title text-white padding-bottom-30px">คุณได้คะแนน <?php echo $data["Score"]['score_number'];?> คะแนน</h2>
                        <div class="btn-box">
                            <a href="javascript:void(0);" class="theme-btn theme-btn-light mr-2 disable">ทำแบบทดสอบใหม่</a>
                            <a href="course/detail/<?php echo $data["Lesson"]['lesson_code'];?>" class="theme-btn theme-btn-light">กลับหน้าหลักสูตร</a>
                        </div>
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
                            <li><i class="la la-check-circle font-size-20 mr-2"></i><?php echo $data["Contest"]['contest_choice'];?> ข้อ</li>
                            <li><i class="la la-clock-o font-size-20 mr-2"></i><?php echo $data["Contest"]['contest_time'];?> นาที</li>
                            <li><i class="la la-bar-chart font-size-20 mr-2"></i><?php echo $data["Contest"]['contest_name'];?></li>
                        </ul>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
    <div class="quiz-ans-wrap padding-top-80px padding-bottom-80px">
        <div class="container">
            <div class="row">

              <?php

              $order = 0;
              $arrayLength = count($data["SystemQuiz"]);

              //print_r($data["SystemQuiz"]);
              foreach ($data["SystemQuiz"] as $Quiz)
              {
                $order++;

                $question = strip_tags($Quiz['quiz_content']);
                echo
                "<div class='col-lg-12'>
                    <div class='quiz-ans-content'>
                        <div class='d-flex align-items-center'>
                            <span class='quiz-count icon-element icon--element bg-color-1 text-white mr-2'>{$order}</span>
                            <h3 class='widget-title font-weight-semi-bold'>โจทย์ {$order} of {$arrayLength}</h3>
                        </div>
                        <p class='pt-3'>{$question}</p>
                        <ul class='quiz-result-list pt-4 pl-3 pb-5'>";

                        $item = 0;
                        foreach ($Quiz["answer"] as $Answer)
                        {
                            $item++;

                            if($Answer['answer_id'] == $data["UserQuiz"][$Quiz['quiz_id']]['answer'])
                            {
                              $itemAnswer =
                              "
                              <li class='primary-color mb-2'>
                                  <span class='icon-element icon--element icon-success mr-2'>
                                      <i class='la la-check'></i>
                                  </span>
                                  {$Answer['answer_name']}
                              </li>";
                            }
                            else
                            {
                              $itemAnswer =
                              "
                              <li class='primary-color mb-2'>
                                  <span class='icon-element icon--element mr-2'>{$item}:</span>
                                  {$Answer['answer_name']}
                              </li>";
                            }
                            echo $itemAnswer;
                          }
                        echo "</ul>
                    </div>
                </div>";
              }

              ?>
            <!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-ans-wrap -->
</section><!-- end quiz-wrap -->
<!-- ================================
    END QUIZ AREA
================================= -->
