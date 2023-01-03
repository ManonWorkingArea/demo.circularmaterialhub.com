<div class="navbar navbar-list navbar-light border-bottom navbar-expand-sm" style="white-space: nowrap;">
    <div class="container page__container">
        <nav class="nav navbar-nav">
            <div class="nav-item navbar-list__item">
                <a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>" class="nav-link h-auto"><i class="material-icons icon--left">keyboard_backspace</i> ย้อนกลับหลักสูตร</a>
            </div>
            <div class="nav-item navbar-list__item">
                <div class="d-flex align-items-center flex-nowrap">
                    <div class="mr-16pt">
                        <a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>"><img src="theme/luma/assets/images/paths/angular_64x64.png" width="40" alt="Angular" class="rounded"></a>
                    </div>
                    <div class="flex">
                        <a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>" class="card-title text-body mb-0"><?php echo $data["Lesson"]['lesson_name'];?></a>
                        <p class="lh-1 d-flex align-items-center mb-0">
                            <span class="text-50 small font-weight-bold mr-8pt"><?php echo $data["Teacher"]['teacher_name']?></span>
                            <span class="text-50 small"><?php echo $data["Lesson"]['department_name']?></span>
                        </p>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<?php
  //print_r($data["Player"]);
  //echo "total question : " . $data["Quiz"]['total_question'] . "</br>";
  //echo "current question : " . $data["Quiz"]['current_question'] . "</br>";
  //echo "question stage : " . $data["Quiz"]['question_stage'] . "</br>";
  //echo "question next : " . $data["Quiz"]['next'] . "</br>";
  //echo "question prev : " . $data["Quiz"]['prev'] . "</br>";

  //print_r($_SESSION["Quiz"]);
  //print_r($_SESSION["QuizProgress"]);
?>

<div class="bg-primary pb-lg-64pt py-32pt">
    <div class="container page__container">

        <div class="d-flex flex-wrap align-items-end justify-content-end mb-16pt">
            <h3 class="text-white flex m-0">แบบทดสอบข้อที่ <?php echo $_SESSION["Quiz"]['current_question']?> จาก <?php echo $_SESSION["Quiz"]['total_question']?></h3>
            <p class="h1 text-white-50 font-weight-light m-0" id="timer-count"><span id="minutes">00</span><span class="timeout-second">:<span id="seconds">00</span></span></p>
        </div>

        <p class="hero__lead measure-hero-lead text-white">
        <?php echo preg_replace('~<p[^>]*>~', '', $_SESSION["Quiz"]['question'][$_SESSION["Quiz"]['current_index']]['quiz_content']);?>
        </p>
    </div>
</div>

<div class="navbar navbar-expand-md navbar-list navbar-light bg-white border-bottom-2 " style="white-space: nowrap;">
    <div class="container page__container">
        <ul class="nav navbar-nav flex navbar-list__item">
            <li class="nav-item">
                <i class="material-icons text-50 mr-8pt">tune</i> เลือกคำตอบที่ถูกต้องด้านล่าง :
            </li>
        </ul>
        <div class="nav navbar-nav ml-sm-auto navbar-list__item">
            <div class="nav-item d-flex flex-column flex-sm-row ml-sm-16pt">
                <a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>" class="btn justify-content-center btn-outline-secondary w-100 w-sm-auto mb-16pt mb-sm-0">ข้ามแบบทดสอบนี้</a>
                <?php echo $_SESSION["Quiz"]['prev'];?>
                <?php echo $_SESSION["Quiz"]['next'];?>
            </div>
        </div>
    </div>
</div>

<div class="container page__container">
    <div class="page-section">
        <div class="page-separator">
            <div class="page-separator__text">คำตอบของคุณ</div>
        </div>

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
          "<div class='form-group'>
              <div class='custom-control custom-radio'>
                  <input id='answer_id_{$Answer['answer_id']}' name='answer' type='radio' class='custom-control-input' value='{$Answer['answer_id']}' {$check}>
                  <label for='answer_id_{$Answer['answer_id']}' class='custom-control-label'>{$Answer['answer_name']}</label>
              </div>
          </div>";
        }

        ?>


        <p class="text-50 mb-0">Note: There can be multiple correct answers to this question.</p>
    </div>
</div>
