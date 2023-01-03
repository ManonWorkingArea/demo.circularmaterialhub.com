










<div class="mdk-box mdk-box--bg-primary bg-dark js-mdk-box mb-0" data-effects="parallax-background blend-background">
    <div class="mdk-box__bg">
        <div class="mdk-box__bg-front" style="background-image: url(theme/luma/assets/images/photodune-4161018-group-of-students-m.jpg);"></div>
    </div>
    <div class="mdk-box__content justify-content-center">
        <div class="hero container page__container text-center py-112pt">
            <?php //echo $_SESSION["School"]['endpoint'];?>
            <h1 class="text-white text-shadow">แหล่งรวมความรู้ออนไลน์ สำหรับภาคอุตสาหกรรม</h1>
            <p class="lead measure-hero-lead mx-auto text-white text-shadow mb-48pt">เริ่มต้นเรียนรู้ไปพร้อมกับวิทยากรมืออาชีพ ที่พร้อมจะเพิ่มศักยภาพให้กับคุณ และองค์กรของคุณ เพื่อให้คุณได้เติมโตไปด้วยกัน อย่างยั่งยืน</p>
            <a href="course" class="btn btn-lg btn-white btn--raised mb-16pt">ค้นหาหลักสูตรที่เหมาะสมกับคุณ</a>
            <p class="mb-0"><a href="course" class="text-white text-shadow"><strong>ต้องการหลักสูตรสำหรับองค์กร ?</strong></a></p>
        </div>
    </div>
</div>

<?php //print_r($data["Home"]['instructor']);?>

<!-- <div class="bg-white border-bottom-2 py-16pt ">
    <div class="container page__container">
        <div class="row align-items-center">
            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">subscriptions</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt">500+ หลักสูตร</div>
                    <p class="card-subtitle text-black-70">ค้นหาและค้นพบคลังวคามรู้ ที่หลากหลาย เหมาะสมกับทักษัของคุณ</p>
                </div>
            </div>
            <div class="d-flex col-md align-items-center border-bottom border-md-0 mb-16pt mb-md-0 pb-16pt pb-md-0">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">verified_user</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt">จากหน่วยงานชั้นนำ</div>
                    <p class="card-subtitle text-black-70">หลักสูตรจากหน่วยงานและองค์กรชั้นนำ พร้อมเนื้อหาที่เข้มข้น</p>
                </div>
            </div>
            <div class="d-flex col-md align-items-center">
                <div class="rounded-circle bg-primary w-64 h-64 d-inline-flex align-items-center justify-content-center mr-16pt">
                    <i class="material-icons text-white">update</i>
                </div>
                <div class="flex">
                    <div class="card-title mb-4pt">ทีมวิทยากรมืออาชีพ</div>
                    <p class="card-subtitle text-black-70">วิทยากรมืออาชีพ พร้อมประสบการณ์และทักษาะในหลักสูตรนั้นแบบเต็ม 100</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="page-separator">
            <div class="page-separator__text">หลักสูตรใหม่ล่าสุด</div>
        </div>

        <div class="row card-group-row">

            <?php
      			foreach ($data["Home"]['central'] as $Lesson)
      			{
      				$detail 	= engine::shorttext($Lesson['post_detail'], 100);
      				$date 	  = engine::thaidate($Lesson['post_adddate']);
      				echo
      				"<div class='col-md-6 col-lg-4 card-group-row__col'>
                  <div class='card card--elevated posts-card-popular overlay card-group-row__card'>
                      <img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['lesson_cover']}' alt='' class='card-img'>
                      <div class='fullbleed bg-dark' style='opacity: .5'></div>
                      <div class='posts-card-popular__content'>
                          <div class='card-body d-flex align-items-center'>
                              <div class='avatar-group flex'>
                                  <div class='avatar avatar-xs' data-toggle='tooltip' data-placement='top' title='Janell D.'>
                                      <a href=''><img src='https://{$Lesson['school_s3_bucket']}.{$Lesson['school_s3_url']}/{$Lesson['template_logo']}' alt='Avatar' class='avatar-img rounded-circle'></a>
                                  </div>
                              </div>
                              <a style='text-decoration: none;' class='d-flex align-items-center' href=''><i class='material-icons mr-1' style='font-size: inherit;'>remove_red_eye</i> <small>327</small></a>
                          </div>
                          <div class='posts-card-popular__title card-body'>
                              <small class='text-muted text-uppercase'>{$Lesson['department_name']}</small>
                              <a class='card-title' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                          </div>
                      </div>
                  </div>
              </div>";
      			}
      			?>

        </div>

        <!-- <div class="posts-cards">

            <div class="card posts-card mb-0">
                <div class="posts-card__content d-flex align-items-center flex-wrap">
                    <div class="avatar avatar-lg mr-3">
                        <a href="compact-blog-post.html"><img src="theme/luma/assets/images/paths/invision_200x168.png" alt="avatar" class="avatar-img rounded"></a>
                    </div>
                    <div class="posts-card__title flex d-flex flex-column">
                        <a href="compact-blog-post.html" class="card-title mr-3">Design Systems Essentials</a>
                        <small class="text-50">35 views last week</small>
                    </div>
                    <div class="d-flex align-items-center flex-column flex-sm-row posts-card__meta">
                        <div class="mr-3 text-50 text-uppercase posts-card__tag d-flex align-items-center">
                            <i class="material-icons text-muted-light mr-1">folder_open</i> inVision
                        </div>
                        <div class="mr-3 text-50 posts-card__date">
                            <small>11 Nov, 2018 07:46 AM</small>
                        </div>
                        <div class="media ml-sm-auto align-items-center">
                            <div class="media-left mr-2 avatar-group">

                                <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="Janell D.">
                                    <img src="theme/luma/assets/images/256_rsz_1andy-lee-642320-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                </div>

                                <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="Janell D.">
                                    <img src="theme/luma/assets/images/256_michael-dam-258165-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                </div>

                                <div class="avatar avatar-xs" data-toggle="tooltip" data-placement="top" title="Janell D.">
                                    <img src="theme/luma/assets/images/256_luke-porter-261779-unsplash.jpg" alt="Avatar" class="avatar-img rounded-circle">
                                </div>

                            </div>
                            <div class="media-body">

                                <a href="">+2 more</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> -->

    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">สถาบันพันธมิตร</div>
        </div>

        <div class="row card-group-row">

            <?php
      			foreach ($data["Home"]['instructor'] as $Instructor)
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
                                              <img src='https://{$Instructor['school_s3_bucket']}.{$$Instructor['school_s3_url']}/{$Instructor['template_logo']}' width='40' height='40' alt='{$Instructor['school_name']}' class='rounded'>
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
                              <a href='compact-student-path.html' data-toggle='tooltip' data-title='เพิ่มคอร์สที่คุณชอบ' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
                          </div>
                      </div>
                  </div>

                  <!--<div class='popoverContainer d-none'>
                      <div class='media'>
                          <div class='media-left mr-12pt'>
                              <img src='{$_SESSION["School"]['endpoint']}/{$Instructor['template_logo']}' width='40' height='40' alt='{$Instructor['school_name']}' class='rounded'>
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
                  </div>-->
              </div>";
      			}
      			?>

        </div>

    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">หลักสูตรฟรียอดนิยม</div>
        </div>

        <div class="row card-group-row">

            <?php
      			foreach ($data["Home"]['public'] as $Lesson)
      			{
      				$detail = engine::shorttext($Lesson['post_detail'], 100);
      				$date 	= engine::thaidate($Lesson['post_adddate']);
      				echo
      				"<div class='col-md-6 col-lg-4 col-xl-3 card-group-row__col'>

                  <div class='card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card' data-toggle='popover' data-trigger='click'>

                      <a href='course/detail/{$Lesson['lesson_code']}' class='card-img-top js-image' data-position='' data-height='140'>
                          <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['lesson_cover']}' alt='course'>
                          <span class='overlay__content'>
                              <span class='overlay__action d-flex flex-column text-center'>
                                  <i class='material-icons icon-32pt'>play_circle_outline</i>
                                  <span class='card-title text-white'>ดูรายละเอียด</span>
                              </span>
                          </span>
                      </a>

                      <div class='card-body flex'>
                          <div class='d-flex'>
                              <div class='flex'>
                                  <a class='card-title' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                                  <small class='text-50 font-weight-bold mb-4pt'>{$Lesson['teacher_name']}</small>
                              </div>
                              <a href='course/detail/{$Lesson['lesson_code']}' data-toggle='tooltip' data-title='เพิ่มคอร์สที่คุณชอบ' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
                          </div>
                          <div class='d-flex'>
                              <div class='rating flex'>
                                <span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
                                <span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
                                <span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>
                              </div>
                              <!-- <small class='text-50'>6 hours</small> -->
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
                  <div class='popoverContainer d-none'>
                      <div class='media'>
                          <div class='media-left mr-12pt'>
                              <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['template_logo']}' width='40' height='40' alt='Angular' class='rounded'>
                          </div>
                          <div class='media-body'>
                              <div class='card-title mb-0'>{$Lesson['lesson_name']}</div>
                              <p class='lh-1 mb-0'>
                                  <span class='text-black-50 small'>โดย</span>
                                  <span class='text-black-50 small font-weight-bold'>{$Lesson['teacher_name']}</span>
                              </p>
                          </div>
                      </div>

                      <p class='my-16pt text-black-70'>{$Lesson['lesson_short_detail']}</p>

                      <div class='row align-items-center'>
                          <div class='col-auto'>
                              <div class='d-flex align-items-center mb-4pt'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['duration']} ชม.</small></p>
                              </div>

                              <div class='d-flex align-items-center'>
                                  <span class='material-icons icon-16pt text-black-50 mr-4pt'>assessment</span>
                                  <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['count']} บท</small></p>
                              </div>
                          </div>
                          <div class='col text-right'>
                              <a href='course/detail/{$Lesson['lesson_code']}' class='btn btn-primary'>ดูรายละเอียด</a>
                          </div>
                      </div>

                  </div>

              </div>";
      			}
      			?>

        </div>
    </div>
</div>


<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">หลักสูตรการลดต้นทุน/เพิ่มประสิทธิภาพการผลิต</div>
        </div>

        <div class="row card-group-row">


          <?php
          foreach ($data["Home"]['department']['cost_reduction'] as $Lesson)
          {
            $detail = engine::shorttext($Lesson['post_detail'], 100);
            $date 	= engine::thaidate($Lesson['post_adddate']);
            echo
            "<div class='col-md-6 col-lg-4 col-xl-3 card-group-row__col'>

                <div class='card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card' data-toggle='popover' data-trigger='click'>

                    <a href='course/detail/{$Lesson['lesson_code']}' class='card-img-top js-image' data-position='' data-height='140'>
                        <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['lesson_cover']}' alt='course'>
                        <span class='overlay__content'>
                            <span class='overlay__action d-flex flex-column text-center'>
                                <i class='material-icons icon-32pt'>play_circle_outline</i>
                                <span class='card-title text-white'>ดูรายละเอียด</span>
                            </span>
                        </span>
                    </a>

                    <div class='card-body flex'>
                        <div class='d-flex'>
                            <div class='flex'>
                                <a class='card-title' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                                <small class='text-50 font-weight-bold mb-4pt'>{$Lesson['teacher_name']}</small>
                            </div>
                            <a href='course/detail/{$Lesson['lesson_code']}' data-toggle='tooltip' data-title='เพิ่มคอร์สที่คุณชอบ' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
                        </div>
                        <div class='d-flex'>
                            <div class='rating flex'>
                              <span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
                              <span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
                              <span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>
                            </div>
                            <!-- <small class='text-50'>6 hours</small> -->
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
                <div class='popoverContainer d-none'>
                    <div class='media'>
                        <div class='media-left mr-12pt'>
                            <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['template_logo']}' width='40' height='40' alt='Angular' class='rounded'>
                        </div>
                        <div class='media-body'>
                            <div class='card-title mb-0'>{$Lesson['lesson_name']}</div>
                            <p class='lh-1 mb-0'>
                                <span class='text-black-50 small'>โดย</span>
                                <span class='text-black-50 small font-weight-bold'>{$Lesson['teacher_name']}</span>
                            </p>
                        </div>
                    </div>

                    <p class='my-16pt text-black-70'>{$Lesson['lesson_short_detail']}</p>

                    <div class='row align-items-center'>
                        <div class='col-auto'>
                          <div class='d-flex align-items-center mb-4pt'>
                              <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
                              <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['duration']} ชม.</small></p>
                          </div>

                          <div class='d-flex align-items-center'>
                              <span class='material-icons icon-16pt text-black-50 mr-4pt'>assessment</span>
                              <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['count']} บท</small></p>
                          </div>
                        </div>
                        <div class='col text-right'>
                            <a href='course/detail/{$Lesson['lesson_code']}' class='btn btn-primary'>ดูรายละเอียด</a>
                        </div>
                    </div>

                </div>

            </div>";
          }
          ?>

        </div>
    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">
        <div class="page-separator">
            <div class="page-separator__text">หลักสูตรทักษะความเข้าใจและใช้เทคโนโลยีดิจิทัล</div>
        </div>

        <div class="row card-group-row">

          <?php
          foreach ($data["Home"]['department']['digital_literacy'] as $Lesson)
          {
            $detail = engine::shorttext($Lesson['post_detail'], 100);
            $date 	= engine::thaidate($Lesson['post_adddate']);
            echo
            "<div class='col-md-6 col-lg-4 col-xl-3 card-group-row__col'>

                <div class='card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card' data-toggle='popover' data-trigger='click'>

                    <a href='course/detail/{$Lesson['lesson_code']}' class='card-img-top js-image' data-position='' data-height='140'>
                        <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['lesson_cover']}' alt='course'>
                        <span class='overlay__content'>
                            <span class='overlay__action d-flex flex-column text-center'>
                                <i class='material-icons icon-32pt'>play_circle_outline</i>
                                <span class='card-title text-white'>ดูรายละเอียด</span>
                            </span>
                        </span>
                    </a>

                    <div class='card-body flex'>
                        <div class='d-flex'>
                            <div class='flex'>
                                <a class='card-title' href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                                <small class='text-50 font-weight-bold mb-4pt'>{$Lesson['teacher_name']}</small>
                            </div>
                            <a href='course/detail/{$Lesson['lesson_code']}' data-toggle='tooltip' data-title='เพิ่มคอร์สที่คุณชอบ' data-placement='top' data-boundary='window' class='ml-4pt material-icons text-20 card-course__icon-favorite'>favorite_border</a>
                        </div>
                        <div class='d-flex'>
                            <div class='rating flex'>
                              <span class='rating__item'><span class='material-icons'>sentiment_very_dissatisfied</span></span>
                              <span class='rating__item'><span class='material-icons'>sentiment_neutral</span></span>
                              <span class='rating__item rating__item__unactive'><span class='material-icons'>sentiment_very_satisfied</span></span>
                            </div>
                            <!-- <small class='text-50'>6 hours</small> -->
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
                <div class='popoverContainer d-none'>
                    <div class='media'>
                        <div class='media-left mr-12pt'>
                            <img src='{$_SESSION["School"]['endpoint']}/{$Lesson['template_logo']}' width='40' height='40' alt='Angular' class='rounded'>
                        </div>
                        <div class='media-body'>
                            <div class='card-title mb-0'>{$Lesson['lesson_name']}</div>
                            <p class='lh-1 mb-0'>
                                <span class='text-black-50 small'>โดย</span>
                                <span class='text-black-50 small font-weight-bold'>{$Lesson['teacher_name']}</span>
                            </p>
                        </div>
                    </div>

                    <p class='my-16pt text-black-70'>{$Lesson['lesson_short_detail']}</p>

                    <div class='row align-items-center'>
                        <div class='col-auto'>
                          <div class='d-flex align-items-center mb-4pt'>
                              <span class='material-icons icon-16pt text-black-50 mr-4pt'>access_time</span>
                              <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['duration']} ชม.</small></p>
                          </div>

                          <div class='d-flex align-items-center'>
                              <span class='material-icons icon-16pt text-black-50 mr-4pt'>assessment</span>
                              <p class='flex text-black-50 lh-1 mb-0'><small>{$Lesson['count']} บท</small></p>
                          </div>
                        </div>
                        <div class='col text-right'>
                            <a href='course/detail/{$Lesson['lesson_code']}' class='btn btn-primary'>ดูรายละเอียด</a>
                        </div>
                    </div>

                </div>

            </div>";
          }
          ?>

        </div>
    </div>
</div>



<!-- <div class="page-section">
    <div class="container page__container">
        <div class="page-headline text-center">
            <h2>ผลตอบรับจากผู้เรียน</h2>
            <p class="lead measure-lead mx-auto text-black-70">What other students turned professionals have to say about us after learning with us and reaching their goals.</p>
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
                                <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                            </blockquote>
                        </div>
                        <div class="media ml-12pt">
                            <div class="media-left mr-12pt">
                                <a href="compact-student-profile.html" class="avatar avatar-sm">

                                    <span class="avatar-title rounded-circle">UK</span>
                                </a>
                            </div>
                            <div class="media-body media-middle">
                                <a href="compact-student-profile.html" class="card-title">Umberto Kass</a>
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
                                <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                            </blockquote>
                        </div>
                        <div class="media ml-12pt">
                            <div class="media-left mr-12pt">
                                <a href="compact-student-profile.html" class="avatar avatar-sm">

                                    <span class="avatar-title rounded-circle">UK</span>
                                </a>
                            </div>
                            <div class="media-body media-middle">
                                <a href="compact-student-profile.html" class="card-title">Umberto Kass</a>
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
                                <p class="text-70 small mb-0">A wonderful course on how to start. Eddie beautifully conveys all essentials of a becoming a good Angular developer. Very glad to have taken this course. Thank you Eddie Bryan.</p>
                            </blockquote>
                        </div>
                        <div class="media ml-12pt">
                            <div class="media-left mr-12pt">
                                <a href="compact-student-profile.html" class="avatar avatar-sm">
                                    <span class="avatar-title rounded-circle">UK</span>
                                </a>
                            </div>
                            <div class="media-body media-middle">
                                <a href="compact-student-profile.html" class="card-title">Umberto Kass</a>
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
</div> -->
