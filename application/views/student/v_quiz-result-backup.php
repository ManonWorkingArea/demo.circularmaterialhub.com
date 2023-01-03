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
  //print_r($data["SystemQuiz"]);
  //print_r($data["UserQuiz"]);
  //echo "total question : " . $data["Quiz"]['total_question'] . "</br>";
  //echo "current question : " . $data["Quiz"]['current_question'] . "</br>";
  //echo "question stage : " . $data["Quiz"]['question_stage'] . "</br>";
  //echo "question next : " . $data["Quiz"]['next'] . "</br>";
  //echo "question prev : " . $data["Quiz"]['prev'] . "</br>";

  //print_r($_SESSION["Quiz"]);
  //print_r($_SESSION["QuizProgress"]);
?>

<div class="bg-primary py-64pt text-center text-sm-left">
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <h3 class="text-white mb-24pt"><?php echo $data["Contest"]['contest_name'];?></h3>
        <p class="lead text-white-50 measure-lead-max mb-0">ส่งคะแนนเมื่อ <?php echo engine::thaidate($data["Score"]['score_adddate']);?></p>
        <h1 class="text-white mb-24pt">คะแนนของคุณ : <?php echo $data["Score"]['score_number'];?> <small>50%</small></h1>
        <a href="student/quiz/<?php echo $data["Lesson"]['lesson_code']?>/<?php echo $data["Contest"]['contest_token'];?>" class="btn btn-outline-white">ทำข้อสอบใหม่</a>
    </div>
</div>

<div class="navbar navbar-expand-sm navbar-light navbar-submenu navbar-list p-0 m-0 align-items-center">
    <div class="container page__container">
        <ul class="nav navbar-nav flex align-items-sm-center">
            <li class="nav-item navbar-list__item"><?php echo $data["Score"]['score_number'];?>/<?php echo $data["Contest"]['contest_choice'];?> คะแนน</li>
            <li class="nav-item navbar-list__item">
                <i class="material-icons text-muted icon--left">schedule</i>
                <?php echo gmdate("H:i:s", $data["Score"]['score_timer']);?>
            </li>
            <li class="nav-item navbar-list__item">
                <i class="material-icons text-muted icon--left">assessment</i>
                <?php echo $data["Contest"]['contest_name'];?>
            </li>
        </ul>
    </div>
</div>

<div class="container page__container">
    <div class="border-left-2 page-section pl-32pt">

        <?php

        $order = 0;
        $arrayLength = count($data["SystemQuiz"]);
        foreach ($data["SystemQuiz"] as $Quiz)
        {
          $order++;

          $question = strip_tags($Quiz['quiz_content']);
          echo
          "<div class='d-flex align-items-center page-num-container mb-16pt'>
              <div class='page-num'>{$order}</div>
              <h4>คำถามข้อที่ {$order} จาก {$arrayLength}</h4>
          </div>

          <p class='text-70 measure-lead question-text'>{$question}</p>

          <ul class='list-quiz'>";

            $item = 0;
            foreach ($Quiz["answer"] as $Answer)
            {
              $item++;

              if($Answer['answer_id'] == $data["UserQuiz"][$Quiz['quiz_id']]['answer'])
              {
                $itemAnswer =
                "<li class='list-quiz-item active'>
                    <span class='list-quiz-badge bg-primary text-white'><i class='material-icons'>check</i></span>
                    <span class='list-quiz-text'>{$Answer['answer_name']}</span>
                </li>";
              }
              else
              {
                $itemAnswer =
                "<li class='list-quiz-item {$active}'>
                    <span class='list-quiz-badge'>{$item}</span>
                    <span class='list-quiz-text'>{$Answer['answer_name']}</span>
                </li>";
              }
              echo $itemAnswer;
            }

          echo "</ul>";
        }

        ?>

    </div>
</div>
