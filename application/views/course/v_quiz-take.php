<!-- ================================
    START QUIZ AREA
================================= -->
<section class="quiz-wrap">
    <div class="quiz-content-wrap bg-black padding-top-20px padding-bottom-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-content padding-top-10px">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2 class="section__title text-white">โจทย์ <?php echo $_SESSION["Quiz"]['current_question']?> / <?php echo $_SESSION["Quiz"]['total_question']?></h2>
                            <p class="lead text-white font-size-25 font-weight-medium mb-0" id="timer-count"><span id="minutes">00</span>:<span id="seconds">00</span></p>
                        </div>
                        <p class="section__desc quiz-desc text-color-rgba mb-0 pt-3">
                          <?php echo preg_replace('~<p[^>]*>~', '', $_SESSION["Quiz"]['question'][$_SESSION["Quiz"]['current_index']]['quiz_content']);?>
                        </p>
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
                            <li><i class="fa fa-suitcase font-size-20 mr-2"></i><strong><?php echo $data["Lesson"]['lesson_name']?></strong> / <?php echo $data["Quiz"]['contest_name']?></li>
                        </ul>
                        <div class="quiz-nav-btns">
                            <a href="course/detail/<?php echo $data["Lesson"]['lesson_code']?>" class="theme-btn theme-btn-light mr-2">กลับหน้าหลักสูตร</a>
                            <?php echo $_SESSION["Quiz"]['prev'];?>
                            <?php echo $_SESSION["Quiz"]['next'];?>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-action-nav -->
     <div class="quiz-ans-wrap padding-top-20px padding-bottom-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-ans-content">
                        <h3 class="widget-title">คำตอบ:</h3>

                        <ul class="py-3">

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
                          "<li>
                              <div class='custom-radio'>
                              <input id='answer_id_{$Answer['answer_id']}' name='answer' type='radio' class='custom-control-input' value='{$Answer['answer_id']}' {$check}>
                              <label for='answer_id_{$Answer['answer_id']}' class='custom-control-label'>{$Answer['answer_name']}</label>
                              </div>
                          </li>";
                        }

                        ?>

                        </ul>
                        <p class="font-size-15"><strong class="primary-color">คำแนะนำ :</strong> เลือกคำตอบที่คุณต้องการแล้วกด ข้อถัดไป.</p>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end quiz-ans-wrap -->
</section><!-- end quiz-wrap -->
<!-- ================================
    END QUIZ AREA
================================= -->
