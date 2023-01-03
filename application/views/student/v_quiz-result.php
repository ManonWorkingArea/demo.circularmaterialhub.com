<section class="inner-header bg-holder bg-overlay-black-90" style="background-image: url('<?php engine::html('img','images/bg/03.jpg');?>');">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
        <h1 class="breadcrumb-title mb-0 text-white">ผลการทำแบบทดสอบ</h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb d-flex justify-content-center justify-content-md-end ml-auto">
          <li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home mr-1"></i>Home</a></li>
          <li class="breadcrumb-item active"><span>Membership Levels</span></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="space-ptb">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="section-title text-center">
          <h2>คุณได้คะแนน <?php echo $data["Score"]['score_number'];?> คะแนน</h2>
          <p>ส่งคะแนนเมื่อ <?php echo engine::thaidate($data["Score"]['score_adddate']);?></p>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="space-pb">
  <div class="container">

    <div class="row justify-content-center mb-4">
      <div class="col-md-8 mb-4 mb-md-0">
        <div class="p-4 p-sm-5 text-center rounded-sm border">
          <h3 class="mb-4"><?php echo $data["Contest"]['contest_name']?></h3>
          <p class="mb-4"><?php echo $data["Contest"]['contest_detail']?></p>
          <a href="student/course/<?php echo $data["Lesson"]['lesson_code'];?>" class="btn btn-primary mt-2">กลับสู่บทเรียน</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8 col-offset-md-6 mb-4 mb-md-0">
        <div class="border mb-4">
          <h6 class="text-dark px-4 py-2 bg-light mb-0">ข้อมูลการทำแบบทดสอบของคุณ</h6>
          <div class="p-4 border-top">

            <?php

            $order = 0;
            $arrayLength = count($data["SystemQuiz"]);

            //print_r($data["SystemQuiz"]);
            foreach ($data["SystemQuiz"] as $Quiz)
            {
              $order++;

              $question = strip_tags($Quiz['quiz_content']);
              echo
              "<span class='lead text-dark fw-6'>คำถามข้อที่ {$order} จาก {$arrayLength}</span>
              <p>{$question}</p>
              <ul class='list-unstyled mt-3'>";

              $item = 0;
              foreach ($Quiz["answer"] as $Answer)
              {
                  $item++;

                  if($Answer['answer_id'] == $data["UserQuiz"][$Quiz['quiz_id']]['answer'])
                  {
                    $itemAnswer =
                    "<li class='d-sm-flex align-items-center border-bottom pb-3 mb-3'>
                      <i class='fa fa-check fa-sm mr-2 text-primary'></i>
                      <span class='mr-4'>{$item}:</span>
                      <span>{$Answer['answer_name']}</span>
                    </li>";
                  }
                  else
                  {
                    $itemAnswer =
                    "<li class='d-sm-flex align-items-center border-bottom pb-3 mb-3'>
                      <i class='flaticon-list-1 fa-sm mr-2 text-primary'></i>
                      <span class='mr-4'>{$item}:</span>
                      <span>{$Answer['answer_name']}</span>
                    </li>";
                  }
                  echo $itemAnswer;
                }

              echo "</ul>";

            }

            ?>

          </div>
        </div>
      </div>

    </div>

  </div>
</section>
