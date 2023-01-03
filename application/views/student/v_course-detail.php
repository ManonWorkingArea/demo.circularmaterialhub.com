<?php
$demo     = "all"; // all | step | single
$mode     = "lesson";
$id       = $data["Lesson"]['lesson_id'];
$student  = engine::student("id");

if($mode == "lesson")
{
  $url = 'course/' . $id . "/" . $student;
  //---------------- get data -----------------//
  $course = engine::api("get", $url);

  $data["Course"]	          = $course['course']['table'];
  $data["Course-complete"]	= $course['course']['complete'];
  $data["Course-count"]	    = $course['course']['count'];
  $data["Document"]	        = $course['course']['document'];
  $data["Quiz"]	            = $course['course']['quiz'];
  $data["Quiz_status"]	    = $course['course']['quiz_status'];
  $data["Permission"]	      = $course['course']['permission'];
  $data["PlayerCounter"]	  = $course['course']['player_counter'];
  //print_r($data["Course"]);
  $url2 = 'skipcourse/' . $id;
  //---------------- get data -----------------//
  $skip = engine::api("get", $url2);
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
  $url = 'subcourse/' . $id;
  //---------------- get data -----------------//
  $course = engine::api("get", $url);
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
$course_status_complete['total']    = $data["Course-count"];
$course_status_complete['current']  = $data["Course-complete"];
$course_status_complete['percent']  = $percent;
//print_r($data["Quiz_status"]);
?>






<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area breadcrumb-detail-area">
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
                        <li>สอนโดย <a href="instructor/detail/<?php echo $data["Teacher"]['teacher_code']?>"><?php echo $data["Teacher"]['teacher_name']?></a></li>
                        <li>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star"></i>
                            <i class="la la-star-half-o"></i>
                            4.5 (173,750 ความนิยม)
                        </li>
                        <li>739,333 นักเรียนที่ลงทะเบียน</li>
                        <li><i class="la la-globe"></i> <?php echo $data["Lesson"]['department'][0]['department_name'];?></li>
                        <li>อัพเดตล่าสุดเมื่อ 2 July, 2019</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE DETAIL
======================================-->
<section class="course-detail margin-bottom-110px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-detail-content-wrap margin-top-40px">

                    <div class="description-wrap margin-bottom-40px">
                        <h3 class="widget-title">คำอธิบายรายวิชา</h3>
                        <?php echo $data["Lesson"]['lesson_detail'];?>
                    </div><!-- end description-wrap -->

                    <div class="curriculum-wrap margin-bottom-60px">
                        <div class="curriculum-header d-flex align-items-center justify-content-between">
                            <div class="curriculum-header-left">
                                <h3 class="widget-title">เนื้อหาหลักสูตร</h3>
                            </div>
                            <div class="curriculum-header-right">
                                <span class="curriculum-total__text"><strong>ทั้งหมด:</strong> 17 บทเรียน</span>
                                <span class="curriculum-total__hours"><strong>จำนวนชั่วโมง:</strong> 02:35:47</span>
                            </div>
                        </div><!-- end curriculum-header -->
                        <div class="curriculum-content">
                            <div class="accordion accordion-shared" id="accordionExample">

															<?php

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

																echo
																"<div class='card'>
                                    <div class='card-header' id='courseMenu-{$Course['course_id']}'>
                                        <h2 class='mb-0'>
                                            <button class='btn btn-link d-flex align-items-center justify-content-between' type='button' data-toggle='collapse' data-target='#collapse-{$Course['course_id']}' aria-expanded='true' aria-controls='collapse-{$Course['course_id']}'>
                                                <i class='fa fa-angle-up'></i>
                                                <i class='fa fa-angle-down'></i>
                                                {$Course['course_name']}
                                                <span>5 lectures</span>
                                            </button>
                                        </h2>
                                    </div>
																		<div id='collapse-{$Course['course_id']}' class='collapse {$show}' aria-labelledby='courseMenu-{$Course['course_id']}' data-parent='#accordionExample'>
                                        <div class='card-body'>
                                            <ul class='list-items'>";

																						$torder = "1";

																						foreach ($Course['topic'] as $Topic)
																						{
																							if($Topic['topic_type']=="2") // บทเรียน
																							{
																								echo
																								"<li>
																										<a href='javascript:void(0)' class='primary-color-2 d-flex align-items-center justify-content-between' data-toggle='modal' data-target='.preview-modal-form'>
																												<span><i class='fa fa-play-circle mr-2'></i>{$torder} : {$Topic['topic_name']} <span class='badge-label'>Preview</span></span>
																												<span class='course-duration'>{$Topic['topic_duration']}</span>
																										</a>
																								</li>";

																								$torder++;
																							}
																							else if($Topic['topic_type']=="7") // แบบทดสอบ
																							{
																								echo
																								"<li>
																										<a href='javascript:void(0)' class='d-flex align-items-center justify-content-between'>
																												<span><i class='fa fa-bolt mr-2'></i>{$Topic['contest']['contest_name']}</span>
																												<span class='course-duration'>{$Topic['contest']['contest_time']} นาที / {$Topic['contest']['contest_choice']} ข้อ</span>
																										</a>
																								</li>";
																							}
																						}
																						echo "</ul>
																					</div>
																			</div>
																		</div>";
																$corder++;
															}
															?>
                            </div>
                        </div>
                    </div>

                    <div class="section-block"></div>

                    <div class="section-block"></div>
                    <div class="instructor-wrap padding-top-50px padding-bottom-45px">
                        <h3 class="widget-title">เกี่ยวกับวิทยากร</h3>
                        <div class="instructor-content margin-top-30px d-flex">
                            <div class="instructor-img">
                                <a href="teacher-detail.html" class="instructor__avatar">
                                    <img src="theme/aduca/assets/images/team7.jpg" alt="">
                                </a>
                                <ul class="list-items">
                                    <li><span class="la la-star"></span> 4.6 คะแนนความนิยม</li>
                                    <li><span class="la la-play-circle-o"></span> 24 หลักสูตร</li>
                                    <li><span class="la la-eye"></span><a href="teacher-detail.html"> ดูหลักสูตรทั้งหมด</a></li>
                                </ul>
                            </div><!-- end instructor-img -->
                            <div class="instructor-details">
                                <div class="instructor-titles">
                                    <h3 class="widget-title"><a href="instructor/detail/<?php echo $data["Teacher"]['teacher_code']?>"><?php echo $data["Teacher"]['teacher_name']?></a></h3>
                                    <p class="instructor__subtitle">เข้าร่วมเมื่อ 1 ปีที่ผ่านมา</p>
                                    <p class="instructor__meta">Digital marketer and writer. Lover of details.</p>
                                </div><!-- end instructor-titles -->
                                <div class="instructor-desc">
                                    <?php echo $data["Teacher"]['teacher_detail']?>
                                    <div class="collapse" id="show-more-content">
                                        <p> <strong>01: Finance</strong> - It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <p> <strong>01: Data science</strong> - It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <p> <strong>01: Entrepreneurship</strong> - It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <p> <strong>01: Blockchain for Business</strong> - It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <p>By choosing 365 Careers, you make sure you will learn from proven experts, who have a passion for teaching, and can take you from beginner to pro in the shortest possible amount of time.  </p>
                                        <p>If you want to become a financial analyst, a finance manager, an FP&A analyst, an investment banker, a business executive, an entrepreneur, a business intelligence analyst, a data analyst, or a data scientist, <strong>Mark Hardson's courses are the perfect course to start.</strong> </p>
                                    </div>
                                    <div class="btn-box pt-2 d-inline-block">
                                        <a class="collapsed link-collapsed" data-toggle="collapse" href="#show-more-content" role="button" aria-expanded="false" aria-controls="show-more-content">
                                            <span class="link-collapse-read-more">อ่านต่อ</span>
                                            <span class="link-collapse-active">Read less</span>
                                            <div class="ml-1">
                                                <i class="la la-plus"></i>
                                                <i class="la la-minus"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div><!-- end instructor-desc -->
                            </div><!-- end instructor-details -->
                        </div><!-- end instructor-content -->
                    </div><!-- end instructor-wrap -->
                    <div class="review-wrap">
                        <h3 class="widget-title">คำติชมจากผู้เรียน</h3>
                        <div class="review-content margin-top-40px margin-bottom-50px d-flex">
                            <div class="review-rating-summary">
                                <div class="review-rating-summary-inner d-flex align-items-end">
                                    <div class="stats-average__count">
                                        <span class="stats-average__count-count">4.6</span>
                                    </div><!-- end stats-average__count -->
                                    <div class="stats-average__rating d-flex">
                                        <ul class="review-stars d-flex">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">(2,533)</span>
                                        </span>
                                    </div><!-- end stats-average__rating -->
                                </div><!-- end review-rating-summary-inner -->
                                <div class="course-rating-text">
                                    <p class="course-rating-text__text">ความนิยมของหลักสูตร</p>
                                </div><!-- end course-rating-text -->
                            </div><!-- end review-rating-summary -->
                            <div class="review-rating-widget">
                                <div class="review-rating-rate">
                                    <ul>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">5 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width1"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">77 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">4 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width2"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">54 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">3 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width3"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">14 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">2 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width4"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">5 %</div>
                                            </div>
                                        </li>
                                        <li class="review-rating-rate__items">
                                            <div class="review-rating-inner__item">
                                                <div class="review-rating-rate__item-text">1 ดาว</div>
                                                <div class="review-rating-rate__item-fill">
                                                    <span class="review-rating-rate__item-fill__fill rating-fill-width5"></span>
                                                </div>
                                                <div class="review-rating-rate__item-percent-text">2 %</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div><!-- end review-rating-rate -->
                            </div><!-- end review-rating-widget -->
                        </div><!-- end review-content -->
                        <div class="section-block"></div>
                        <div class="comments-wrapper margin-top-50px">
                            <h3 class="widget-title"> คำติชม</h3>
                            <ul class="comments-list padding-top-30px">
                                <li>
                                    <div class="comment">
                                        <div class="comment-avatar">
                                            <img class="avatar__img" alt="" src="theme/aduca/assets/images/team7.jpg">
                                        </div>
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
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                Ut enim ad minim veniam, quis nostrud exercitation.
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
                                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target=".report-modal-form"><i class="la la-flag mr-2"></i>รายงานการละเมิด
</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end comment -->

                                    <div class="comment">
                                        <div class="comment-avatar">
                                            <img class="avatar__img" alt="" src="theme/aduca/assets/images/team9.jpg">
                                        </div>
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <h3 class="comment__author">Mike Doe</h3>
                                                <p class="comment__date">17 Dec, 2018 - 4:00 pm</p>
                                                <ul class="review-stars review-stars3">
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                    <li><span class="la la-star"></span></li>
                                                </ul>
                                            </div>
                                            <p class="comment-content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                                Ut enim ad minim veniam, quis nostrud exercitation.
                                            </p>
                                            <div class="comment-reply">
                                                <a class="theme-btn" href="#" data-toggle="modal" data-target=".modal-action-form">
                                                    <span class="la la-mail-reply"></span> Reply
                                                </a>
                                                <div class="helpful__action d-flex align-items-center">
                                                    <span class="helpful__action-text">บทวิจารณ์นี้มีประโยชน์หรือไม่?</span>
                                                    <button class="btn">Yes</button>
                                                    <button class="btn">No</button>
                                                    <div class="msg-action-dot">
                                                        <div class="dropdown">
                                                            <a class="action-dot" href="#" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="la la-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu border" aria-labelledby="dropdownMenuLink3">
                                                                <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target=".report-modal-form"><i class="la la-flag mr-2"></i>Report abuse</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end comment -->
                                </li>
                            </ul>
                        </div><!-- end comments-wrapper -->
                    </div><!-- end review-wrap -->
                    <div class="view-more-courses mt-5">
                        <h3 class="widget-title">หลักสูตรเพิ่มเติมจาก คุณยุทธนา ศิลป์สรรค์วิชช์</h3>
                        <div class="view-more-carousel margin-top-30px margin-bottom-50px">
                            <div class="card-item">
                                <div class="card-image">
                                    <a href="course-details.html" class="card__img"><img src="theme/aduca/assets/images/img8.jpg" alt=""></a>
                                    <div class="card-badge">
                                        <span class="badge-label">bestseller</span>
                                    </div>
                                </div><!-- end card-image -->
                                <div class="card-content">
                                    <p class="card__label">
                                        <span class="card__label-text">beginner</span>
                                        <a href="#" class="card__collection-icon" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="la la-heart-o"></span></a>
                                    </p>
                                    <h3 class="card__title">
                                        <a href="course-details.html">WordPress for Beginners – Master WordPress</a>
                                    </h3>
                                    <p class="card__author">
                                        <a href="teacher-detail.html">alex smith</a>
                                    </p>
                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                        <ul class="review-stars">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">4.4</span>
                                            <span class="star__count">(20)</span>
                                        </span>
                                    </div><!-- end rating-wrap -->
                                    <div class="card-action">
                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-play-circle"></i> 45 Classes
                                                </span>
                                            </li>
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-clock-o"></i> 3 hours 20 min
                                                </span>
                                            </li>
                                        </ul>
                                    </div><!-- end card-action -->
                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                        <span class="card__price">$58.00</span>
                                        <a href="#" class="text-btn">Add to cart</a>
                                    </div><!-- end card-price-wrap -->
                                </div><!-- end card-content -->
                            </div><!-- end card-item -->
                            <div class="card-item">
                                <div class="card-image">
                                    <a href="course-details.html" class="card__img"><img src="theme/aduca/assets/images/img9.jpg" alt=""></a>
                                </div><!-- end card-image -->
                                <div class="card-content">
                                    <p class="card__label">
                                        <span class="card__label-text">beginner</span>
                                        <a href="#" class="card__collection-icon" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="la la-heart-o"></span></a>
                                    </p>
                                    <h3 class="card__title">
                                        <a href="course-details.html">Learn Ethical Hacking from Scratch Your Stepping</a>
                                    </h3>
                                    <p class="card__author">
                                        <a href="teacher-detail.html">brad travesy</a>
                                    </p>
                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                        <ul class="review-stars">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">4.2</span>
                                            <span class="star__count">(30)</span>
                                        </span>
                                    </div><!-- end rating-wrap -->
                                    <div class="card-action">
                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-play-circle"></i> 45 Classes
                                                </span>
                                            </li>
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-clock-o"></i> 3 hours 20 min
                                                </span>
                                            </li>
                                        </ul>
                                    </div><!-- end card-action -->
                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                        <span class="card__price">Free</span>
                                        <a href="#" class="text-btn">Get Enrolled</a>
                                    </div><!-- end card-price-wrap -->
                                </div><!-- end card-content -->
                            </div><!-- end card-item -->
                            <div class="card-item">
                                <div class="card-image">
                                    <a href="course-details.html" class="card__img"><img src="theme/aduca/assets/images/img10.jpg" alt=""></a>
                                    <div class="card-badge">
                                        <span class="badge-label">highest rated</span>
                                    </div>
                                </div><!-- end card-image -->
                                <div class="card-content">
                                    <p class="card__label">
                                        <span class="card__label-text">advanced</span>
                                        <a href="#" class="card__collection-icon" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="la la-heart-o"></span></a>
                                    </p>
                                    <h3 class="card__title">
                                        <a href="course-details.html">Microsoft SQL Server 2019 for Everyone</a>
                                    </h3>
                                    <p class="card__author">
                                        <a href="teacher-detail.html">mark hardson</a>
                                    </p>
                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                        <ul class="review-stars">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">4.5</span>
                                            <span class="star__count">(40)</span>
                                        </span>
                                    </div><!-- end rating-wrap -->
                                    <div class="card-action">
                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-play-circle"></i> 45 Classes
                                                </span>
                                            </li>
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-clock-o"></i> 3 hours 20 min
                                                </span>
                                            </li>
                                        </ul>
                                    </div><!-- end card-action -->
                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                        <span class="card__price">$68.00</span>
                                        <a href="#" class="text-btn">Add to cart</a>
                                    </div><!-- end card-price-wrap -->
                                </div><!-- end card-content -->
                            </div><!-- end card-item -->
                            <div class="card-item">
                                <div class="card-image">
                                    <a href="course-details.html" class="card__img"><img src="theme/aduca/assets/images/img11.jpg" alt=""></a>
                                </div><!-- end card-image -->
                                <div class="card-content">
                                    <p class="card__label">
                                        <span class="card__label-text">all levels</span>
                                        <a href="#" class="card__collection-icon" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="la la-heart-o"></span></a>
                                    </p>
                                    <h3 class="card__title">
                                        <a href="course-details.html">User Experience Design - Adobe XD UI UX Design</a>
                                    </h3>
                                    <p class="card__author">
                                        <a href="teacher-detail.html">kamran paul</a>
                                    </p>
                                    <div class="rating-wrap d-flex mt-2 mb-3">
                                        <ul class="review-stars">
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star"></span></li>
                                            <li><span class="la la-star-o"></span></li>
                                        </ul>
                                        <span class="star-rating-wrap">
                                            <span class="star__rating">4.4</span>
                                            <span class="star__count">(20)</span>
                                        </span>
                                    </div><!-- end rating-wrap -->
                                    <div class="card-action">
                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-play-circle"></i> 45 Classes
                                                </span>
                                            </li>
                                            <li>
                                                <span class="meta__date">
                                                    <i class="la la-clock-o"></i> 3 hours 20 min
                                                </span>
                                            </li>
                                        </ul>
                                    </div><!-- end card-action -->
                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                        <span class="card__price">Free</span>
                                        <a href="#" class="text-btn">Get Enrolled</a>
                                    </div><!-- end card-price-wrap -->
                                </div><!-- end card-content -->
                            </div><!-- end card-item -->
                        </div><!-- end view-more-carousel -->
                    </div><!-- end view-more-courses -->
                    <div class="report-modal-box">
                        <button type="button" class="theme-btn theme-btn-light" data-toggle="modal" data-target=".report-modal-form">
                            <i class="la la-flag font-size-18 mr-1"></i>รายงานการละเมิด

                        </button>
                    </div>
                </div><!-- end course-detail-content-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar-component">
                    <div class="sidebar">
                        <div class="sidebar-widget sidebar-preview">
                           <div class="sidebar-preview-titles">
                               <h3 class="widget-title">ตัวอย่างเนื้อหา</h3>
                           </div>
                            <div class="preview-video-and-details">
                                <div class="preview-course-video">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target=".preview-modal-form">
                                        <img src="theme/aduca/assets/images/preview-img.jpg" alt="course-img">
                                        <div class="play-button">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8" style=" enable-background:new -307.4 338.8 91.8 91.8;" xml:space="preserve">
                                                   <style type="text/css">
                                                       .st0{opacity:0.6;fill:#000000;border-radius: 100px;enable-background:new;}
                                                       .st1{fill:#FFFFFF;}
                                                   </style>
                                                <g>
                                                    <circle class="st0" cx="-261.5" cy="384.7" r="45.9"/><path class="st1" d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                                <div class="preview-course-content">
                                    <p class="preview-course__price d-flex align-items-center">
                                        <span class="price-current">	<?php
                        									if($data["Lesson"]['lesson_sale_price']=="0")
                        									{
                        										echo "เรียนฟรี";
                        									}
                        									else
                        									{
                        										echo engine::baht($data["Lesson"]['lesson_sale_price']) . " <small>บาท</small>";
                        									}
                        									?></span>
                                        <span class="price-before">฿0</span>
                                        <span class="price-discount">100% off</span>
                                    </p>
                                    <p class="preview-price-discount__text">
                                        <span class="discount-left__text-text">อีก 4 วัน</span> โปรโมชั่นหมดอายุ
                                    </p>
                                    <div class="buy-course-btn mb-3 text-center">
                                        <a href="#" class="theme-btn w-100 mb-3">ลงทะเบียนคอร์สนี้</a>
                                        <a href="lesson-details.html" class="theme-btn w-100 theme-btn-light">เข้าเรียน</a>
                                    </div>
                                    <div class="preview-course-incentives">
                                        <p class="preview-course-incentives__text mb-4">
                                            <i class="la la-thumbs-up"></i> รับประกันคืนเงินภายใน 30 วัน
                                        </p>
                                        <h3 class="widget-title font-size-18">ในหลักสูตรนี้ประกอบด้วย</h3>
                                        <ul class="list-items pb-3">
                                            <li><i class="la la-play-circle-o"></i>เนื้อหาวีดีโอ 2.5 ชั่วโมง</li>
                                            <li><i class="la la-file"></i>34 บทเรียน</li>
                                            <li><i class="la la-file-text"></i>12 แบบทดสอบ</li>
                                            <li><i class="la la-key"></i>เรียนได้ตลอดอายุการใช้งาน</li>
                                            <li><i class="la la-television"></i>สามารถเข้าเรียนได้บนอุปกรณ์เคลื่อนที่</li>
                                            <li><i class="la la-certificate"></i>ใบรับรองการสำเร็จการศึกษา</li>
                                        </ul>
                                        <div class="section-block"></div>
                                        <div class="video-content-btn d-flex align-items-center justify-content-between pb-3 pt-3">
                                            <button class="btn">
                                                <i class="la la-heart-o mr-1 bookmark-icon"></i>
                                                <span class="swapping-btn" data-text-swap="Wishlisted" data-text-original="Wishlist">เพิ่มคอร์สที่ชอบ</span>
                                            </button>
                                            <button class="btn" data-toggle="modal" data-target=".share-modal-form">
                                                <i class="la la-share mr-1"></i>
                                                <span>แชร์</span>
                                            </button>
                                        </div>
                                        <div class="section-block"></div>
                                        <div class="business-content pt-4">
                                            <h3 class="widget-title mb-1 font-size-18">ต้องการเรียนคอร์สนี้แบบกลุ่ม?</h3>
                                            <p class="line-height-25 pb-2">คุณต้องการลงทะเบียนเรียนแบบกลุ่ม สำหรับใช้งานภายในองค์กร.</p>
                                            <a href="#">สมัครแบบองค์กร</a>
                                        </div>
                                    </div><!-- end preview-course-incentives -->
                                </div><!-- end preview-course-content -->
                            </div><!-- end preview-video-and-details -->
                        </div><!-- end sidebar-widget -->
                        <div class="sidebar-widget sidebar-feature">
                            <h3 class="widget-title">ข้อมูลหลักสูตร</h3>
                            <span class="section-divider"></span>
                            <ul class="list-items">
                                <li>
                                    <span><i class="la la-clock-o"></i>ความยาวเนื้อหา</span>
                                    <span>2.5 hours</span>
                                </li>
                                <li>
                                    <span><i class="la la-play-circle-o"></i>บทเรียน</span>
                                    <span>17</span>
                                </li>
                                <li>
                                    <span><i class="la la-file-text"></i>แบบทดสอบ</span>
                                    <span>12</span>
                                </li>
                                <li>
                                    <span><i class="la la-level-up"></i>ระดับผู้เรียน</span>
                                    <span>ทุกระดับ</span>
                                </li>
                                <li>
                                    <span>  <i class="la la-users"></i>ผู้เรียน</span>
                                    <span>585</span>
                                </li>
                                <li>
                                    <span><i class="la la-certificate"></i>ใบรับรอง</span>
                                    <span>มี</span>
                                </li>
                            </ul>
                        </div><!-- end sidebar-widget -->
                        <div class="sidebar-widget category-widget">
                            <h3 class="widget-title">หมวดหมู่</h3>
                            <span class="section-divider"></span>
                            <ul class="list-items">
                                <li><a href="#">Web design</a></li>
                                <li><a href="#">Development</a></li>
                                <li><a href="#">fron-end</a></li>
                                <li><a href="#">photography</a></li>
                                <li><a href="#">technology</a></li>
                                <li><a href="#">IT & Software</a></li>
                                <li><a href="#">backend</a></li>
                                <li><a href="#">marketing</a></li>
                            </ul>
                        </div><!-- end sidebar-widget -->
                    </div><!-- end sidebar -->
                </div><!-- end sidebar-component -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-detail -->
<!--======================================
        END COURSE DETAIL
======================================-->

<!--================================
        START GET STAR AREA
=================================-->
<div class="subscriber-area call-to-action padding-top-40px padding-bottom-40px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="call-to-action-heading d-flex align-items-center">
                    <div class="call-to-action-icon">
                        <svg viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg"><path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"/><path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"/><path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"/><path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"/><path d="m152 288h16v80h-16zm0 0"/><path d="m120 288h16v80h-16zm0 0"/><path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"/></svg>
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-20 pb-1">เข้าร่วมเป็นวิทยากร เพื่อแบ่งปันความรู้ของคุณ</h2>
                        <p class="section__desc mb-0">สร้างหลักสูตรวิดีโอออนไลน์เข้าถึงนักเรียนทั่วโลกและสร้างรายได้</p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="btn-box text-right">
                    <a href="#" class="theme-btn">สมัครวิทยากร</a>
                </div><!-- end btn-box-->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end subscriber-area -->
<!--================================
        END GET STAR AREA
=================================-->



<div class="modal-form">
    <div class="modal fade preview-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <h5 class="modal-title">Course Preview: The Complete Digital Finance Marketing Course</h5>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <video controls crossorigin playsinline poster="https://fti-central.s3.ap-southeast-1.amazonaws.com/16040049161069986692.png" id="player">
                        <!-- Video files -->
                        <source src="https://fti-central.s3.ap-southeast-1.amazonaws.com/1601063390723126820/16010634811876166676/16010640721000214770.mp4" type="video/mp4" size="720"/>

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="https://fti-central.s3.ap-southeast-1.amazonaws.com/1601063390723126820/16010634811876166676/16010640721000214770.mp4" download>Download</a>
                    </video>
                </div>
            </div>
        </div>
    </div><!-- end modal -->
</div>

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade report-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <div>
                        <h4 class="modal-title widget-title font-size-20"><span class="la la-flag mr-1"></span>Report Abuse</h4>
                        <p class="mt-2 font-size-15 line-height-26">
                            Flagged content is reviewed by Aduca staff to determine whether it violates Terms of Service or Community Guidelines.
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
                                        <option value="3">Aduca Policy Violation</option>
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
                            <input type="text" class="form-control copy-input" value="https://www.aduca.com/share/101WxMB0oac1hVQQ==/">
                            <div class="copy-tooltip">
                                <button class="theme-btn theme-btn-light copy-text">Copy</button>
                            </div>
                        </div>
                    </div><!-- end copy-to-clipboard -->
                    <ul class="social-profile">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->


<section class="inner-header bg-holder bg-overlay-black-90" style="background-image: url('<?php engine::html('img','images/bg/03.jpg');?>');">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
        <h1 class="breadcrumb-title mb-0 text-white"><?php echo $data["Lesson"]['lesson_name'];?></h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb d-flex justify-content-center justify-content-md-end ml-auto">
          <li class="breadcrumb-item"><a href="student"><i class="fas fa-home mr-1"></i>ข้อมูลผู้ใช้</a></li>
          <li class="breadcrumb-item active"><span><?php echo $data["Lesson"]['department_name'];?></span></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<?php //print_r($data["Student"]);?>

<section class="space-pb teacher-detail">
  <div class="container">
      <div class="row">
        <div class="col-md-5 col-xl-4 position-relative z-index-1 mt-n5">


          <div class="progress-item">
            <div class="d-flex">
              <div class="progress-title mb-1 mr-auto percent-text">ความคืบหน้า</div>
              <span class="percent-text"><?php echo $course_status_complete['percent'];?>%</span>
            </div>
            <div class="progress" style="height: 6px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $course_status_complete['percent'];?>%" aria-valuenow="<?php echo $course_status_complete['percent'];?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>

          <img class="img-fluid" src="https://<?php echo $data["Lesson"]['school_s3_bucket'];?>.<?php echo $data["Lesson"]['school_s3_url']?>/<?php echo $data["Lesson"]['lesson_cover']?>" alt="">

          <div class="border border-top-0 py-4 py-sm-5">

            <div class="row" style="padding: 15px;">
              <div class="col-md-6">
                <a class="btn btn-sm btn-block btn-mes mr-4" href="student">ข้อมูลส่วนตัว</a>
              </div>
              <div class="col-md-6">
                <a class="btn btn-sm btn-block btn-fol" href="student">หลักสูตร</a>
              </div>
            </div>

            <!-- <ul class="pl-0 mb-0">
              <li class="d-flex align-items-center px-4 mb-4">
                <i class="flaticon-skype fa-2x mt-2 text-light mr-3"></i>
                <span class="h6 text-light font-weight-normal mb-0">online.courses</span>
              </li>
              <li class="d-flex align-items-center px-4 mb-4">
                <i class="flaticon-link fa-2x mt-2 text-light mr-3"></i>
                <span class="h6 text-light font-weight-normal mb-0">https://www.guruma.com</span>
              </li>
              <li class="d-flex align-items-center px-4">
                <i class="flaticon-pin-1 fa-2x mt-2 text-light mr-3"></i>
                <span class="h6 text-light font-weight-normal mb-0">Hamilton Rd. Willoughby, OH</span>
              </li>
            </ul> -->

          </div>
          <!-- <div class="social-icon-round mt-4 mt-sm-5">
            <ul>
              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
              <li><a href="#"><i class="fab fa-instagram"></i></a></li>
              <li><a href="#"><i class="fab fa-google"></i></a></li>
            </ul>
          </div> -->
        </div>
        <div class="col-md-7 col-xl-8 space-sm-pt">
          <h2><?php echo $data["Student"]['fullname']?></h2>
          <h4 class="mb-4">เนื้อหาหลักสูตร :</h4>
          <div class="table-responsive">

            <?php if ($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL) { ?>

            <?php
            // Seting Before Quiz
            if($data["Quiz_status"]['before']['status']=="true")
            {
              $before_title    = "<span class='text-success'><i class='fa fa-check-circle'></i> " . $data["Quiz_status"]['before']['contest_name'] . "</span>";
              $before_score    = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> " . $data["Quiz_status"]['before']['score_number'] . "/" . $data["Quiz_status"]['before']['contest_choice'] . " คะแนน</span>";
              $before_percent  = (100/$data["Quiz_status"]['before']['contest_choice']) * $data["Quiz_status"]['before']['score_number'];;
            }
            else
            {
              $before_title    = "<span class='text-primary'><i class='fa fa-play-circle'></i> " . $data["Quiz_status"]['before']['contest_name'] . "</span>";
              $before_score    = "<span class='badge badge-notifications badge-dark'><i class='fa fa-check-circle'></i> ยังไม่ได้ทำ</span>";
              $before_percent  = "0";
            }
            ?>

            <table class="table table-striped border mb-4">
              <thead>
                <tr>
                  <th width="60%">แบบทดสอบก่อนเรียน</th>
                  <th>ความคืบหน้า</th>
                  <th>สถานะ</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <a href='student/quiz/<?php echo $data["Lesson"]['lesson_code']?>/<?php echo $data["Quiz_status"]['before']['contest_token']?>'>
                      <span class="text-primary"><?php echo $before_title;?></span>
                      <span class="">(<?php echo $data["Quiz_status"]['before']['contest_choice']?> ข้อ / <?php echo $data["Quiz_status"]['before']['contest_time']?> นาที)</span>
                    </a>
                  </td>
                  <td><span class="d-none d-sm-block">
                    <span class="survey-progress">
                      <span class="survey-progress-bg">
                        <span class="survey-progress-fg" style="width: <?php echo $before_percent;?>%;"></span>
                      </span>
                    </span>
                    <span class="text-muted text-percent"><?php echo $before_percent;?>%</span>
                  </span> </td>
                  <td><?php echo $before_score;?></td>
                </tr>
              </tbody>
            </table>

            <?php } else { ?>

            <?php } ?>

            <?php

            foreach ($data["Course"] as $Course)
            {
              $main ++;

              echo
              "<table class='table table-striped border mb-4'>
                <thead>
                  <tr>
                    <th width='60%'>{$main}.{$Course['course_name']}</th>
                    <th>ความคืบหน้า</th>
                    <th>สถานะ</th>
                  </tr>
                </thead>
                <tbody>";

                $sub = "1";

                foreach ($Course['topic'] as $Topic)
                {

                  if($demo=="all")
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
                      if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                      {
                        // Check Quiz before Status
                        if($data["Quiz_status"]['before']['status']=="false")
                        {
                          $topic_icon     = "play-circle";
                          $topic_text     = "bold";
                          $topic_color    = "text-primary";
                          $topic_percent  = "50";
                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                            $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                            $topic_option   = "topic-option-active";
                          }
                          else if($Topic['topic_player_finish'] =="1")
                          {
                            $topic_icon     = "check-circle";
                            $topic_text     = "normal";
                            $topic_color    = "text-success";
                            $topic_percent  = "100";
                            $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                            $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                            $topic_option   = "topic-option-active";
                          }
                          else
                          {
                            $topic_icon     = "play-circle";
                            $topic_text     = "bold";
                            $topic_color    = "text-primary";
                            $topic_percent  = "50";
                            $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                            $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                          $topic_option   = "topic-option-active";
                        }
                        else if($Topic['topic_player_finish'] =="1")
                        {
                          $topic_icon     = "check-circle";
                          $topic_text     = "normal";
                          $topic_color    = "text-success";
                          $topic_percent  = "100";
                          $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                          $topic_option   = "topic-option-active";
                        }
                        else
                        {
                          $topic_icon     = "play-circle";
                          $topic_text     = "bold";
                          $topic_color    = "text-primary";
                          $topic_percent  = "50";
                          $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                        //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        if($Topic['topic_type']=="7")
                        {
                          $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                        }
                        else
                        {
                          $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                        //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        if($Topic['topic_type']=="7")
                        {
                          $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                        }
                        else
                        {
                          $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        }
                      }
                      else
                      {
                        $topic_icon     = "play-circle";
                        $topic_text     = "bold";
                        $topic_color    = "text-primary";
                        $topic_percent  = "50";
                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        $topic_option   = "topic-option-active";
                      }
                      else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                      {
                        $topic_icon     = "check-circle";
                        $topic_text     = "normal";
                        $topic_color    = "text-success";
                        $topic_percent  = "100";
                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        $topic_option   = "topic-option-active";
                      }
                      else
                      {
                        $topic_icon     = "play-circle";
                        $topic_text     = "bold";
                        $topic_color    = "text-primary";
                        $topic_percent  = "50";
                        $topic_msg      = "<span class='badge badge-notifications badge-primary'><i class='fa fa-check-circle'></i> เริ่มเรียน..</span>";
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                      $topic_title  = "<span class='{$topic_color}'><i class='fa fa-{$topic_icon}'></i> {$main}.{$sub}.{$Topic['contest']['contest_name']}</span> <span class='{$topic_option}'>{$Topic['contest']['contest_choice']} ข้อ</span>";
                    }
                    else
                    {
                      $topic_title  = "<span class='{$topic_color}'><i class='fa fa-{$topic_icon}'></i> {$main}.{$sub}.{$Topic['topic_name']}</span> <span class='{$topic_option}'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>";
                    }
                  }
                  else if($demo=="step")
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
                      if($data["Quiz_status"]['before']['contest_id']!=""||$data["Quiz_status"]['before']['contest_id']!=NULL)
                      {
                        // Check Quiz before Status
                        if($data["Quiz_status"]['before']['status']=="false")
                        {
                          $topic_icon     = "lock";
                          $topic_text     = "normal";
                          $topic_color    = "text-mute";
                          $topic_percent  = "0";
                          $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                          $topic_url      = "javascript:void();";
                          $topic_option   = "topic-option-unactive";
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
                            $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                            $topic_option   = "topic-option-active";
                          }
                          else if($Topic['topic_player_finish'] =="1")
                          {
                            $topic_icon     = "check-circle";
                            $topic_text     = "normal";
                            $topic_color    = "text-success";
                            $topic_percent  = "100";
                            $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                            $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                            $topic_option   = "topic-option-active";
                          }
                          else
                          {
                            $topic_icon     = "lock";
                            $topic_text     = "normal";
                            $topic_color    = "text-mute";
                            $topic_percent  = "0";
                            $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                            $topic_url      = "javascript:void();";
                            $topic_option   = "topic-option-unactive";
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
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                          $topic_option   = "topic-option-active";
                        }
                        else if($Topic['topic_player_finish'] =="1")
                        {
                          $topic_icon     = "check-circle";
                          $topic_text     = "normal";
                          $topic_color    = "text-success";
                          $topic_percent  = "100";
                          $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                          $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                          $topic_option   = "topic-option-active";
                        }
                        else
                        {
                          $topic_icon     = "lock";
                          $topic_text     = "normal";
                          $topic_color    = "text-mute";
                          $topic_percent  = "0";
                          $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                          $topic_url      = "javascript:void();";
                          $topic_option   = "topic-option-unactive";
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
                        //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        if($Topic['topic_type']=="7")
                        {
                          $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                        }
                        else
                        {
                          $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
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
                        //$topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        if($Topic['topic_type']=="7")
                        {
                          $topic_url  = "student/quiz/seven_wastes/{$Topic['contest']['contest_token']}";
                        }
                        else
                        {
                          $topic_url  = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        }
                      }
                      else
                      {
                        $topic_icon     = "lock";
                        $topic_text     = "normal";
                        $topic_color    = "text-mute";
                        $topic_percent  = "0";
                        $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                        $topic_url      = "javascript:void();";
                        $topic_option   = "topic-option-unactive";
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
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        $topic_option   = "topic-option-active";
                      }
                      else if($before_stage_player=="1" && $Course['player_complete'] =="1")
                      {
                        $topic_icon     = "check-circle";
                        $topic_text     = "normal";
                        $topic_color    = "text-success";
                        $topic_percent  = "100";
                        $topic_msg      = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> เรียนจบแล้ว..</span>";
                        $topic_url      = "student/course/{$data["Lesson"]['lesson_code']}/{$Topic['topic_code']}";
                        $topic_option   = "topic-option-active";
                      }
                      else
                      {
                        $topic_icon     = "lock";
                        $topic_text     = "normal";
                        $topic_color    = "text-mute";
                        $topic_percent  = "0";
                        $topic_msg      = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่เปิด..</span>";
                        $topic_url      = "javascript:void();";
                        $topic_option   = "topic-option-unactive";
                      }
                    }

                    $total_player_time = round((100/$Topic['player_total_time'])*$Topic['player_play_time']);

                    if($total_player_time>"100")
                    {
                      $total_player_time ="100";
                    }

                    if($Topic['topic_type']=="7")
                    {
                      $topic_title  = "<span class='{$topic_color}'><i class='fa fa-{$topic_icon}'></i> {$main}.{$sub}.{$Topic['contest']['contest_name']}</span> <span class='{$topic_option}'>{$Topic['contest']['contest_choice']} ข้อ</span>";
                    }
                    else
                    {
                      $topic_title  = "<span class='{$topic_color}'><i class='fa fa-{$topic_icon}'></i> {$main}.{$sub}.{$Topic['topic_name']}</span> <span class='{$topic_option}'><i class='fa fa-clock-o'></i> {$Topic['topic_duration']}</span>";
                    }
                  }


                  echo
                  "<tr>
                      <td><a href='{$topic_url}'>{$topic_title}</a></td>
                      <td><span class='d-none d-sm-block'>
                        <span class='survey-progress'>
                          <span class='survey-progress-bg'>
                            <span class='survey-progress-fg' style='width: {$total_player_time}%;'></span>
                          </span>
                        </span>
                        <span class='text-muted text-percent'>{$total_player_time}%</span>
                      </span> </td>
                      <td> {$topic_msg} </td>
                  </tr>";

                  $sub++;
                }

                echo
                "</tbody>
              </table>";
            }

            ?>

            <?php if ($data["Quiz_status"]['after']['contest_id']!=""||$data["Quiz_status"]['after']['contest_id']!=NULL) { ?>

            <?php
            // Seting After Quiz
            if($data["Quiz_status"]['after']['status']=="true")
            {
              $after_title    = "<span class='text-success'><i class='fa fa-check-circle'></i> " . $data["Quiz_status"]['after']['contest_name'] . "</span>";
              $after_score    = "<span class='badge badge-notifications badge-success'><i class='fa fa-check-circle'></i> " . $data["Quiz_status"]['after']['score_number'] . "/" . $data["Quiz_status"]['after']['contest_choice'] . " คะแนน</span>";
              $after_percent  = (100/$data["Quiz_status"]['after']['contest_choice']) * $data["Quiz_status"]['after']['score_number'];;
            }
            else
            {
              $after_title    = "<span class='text-mute'><i class='fa fa-lock'></i> " . $data["Quiz_status"]['after']['contest_name'] . "</span>";
              $after_score    = "<span class='badge badge-notifications badge-dark'><i class='fa fa-times'></i> ยังไม่ได้ทำ</span>";
              $after_percent  = "0";
            }
            ?>

            <table class="table table-striped border mb-4">
              <thead>
                <tr>
                  <th width="60%">แบบทดสอบหลังเรียน</th>
                  <th>ความคืบหน้า</th>
                  <th>สถานะ</th>
                </tr>
              </thead>
              <tbody>
                <tr onclick="page('student/quiz/<?php echo $data["Lesson"]['lesson_code']?>/<?php echo $data["Quiz_status"]['after']['contest_token']?>')">
                  <td>
                    <a href='student/quiz/<?php echo $data["Lesson"]['lesson_code']?>/<?php echo $data["Quiz_status"]['after']['contest_token']?>'>
                      <span class="text-primary"><?php echo $after_title;?></span>
                      <span class="">(<?php echo $data["Quiz_status"]['after']['contest_choice']?> ข้อ / <?php echo $data["Quiz_status"]['after']['contest_time']?> นาที)</span>
                    </a>
                  </td>
                  <td><span class="d-none d-sm-block">
                    <span class="survey-progress">
                      <span class="survey-progress-bg">
                        <span class="survey-progress-fg" style="width: <?php echo $after_percent;?>%;"></span>
                      </span>
                    </span>
                    <span class="text-muted text-percent"><?php echo $after_percent;?>%</span>
                  </span> </td>
                  <td><?php echo $after_score;?></td>
                </tr>
              </tbody>
            </table>

            <?php } else { ?>

            <?php } ?>

          </div>

          <h4 class="mb-4">คำอธิบายรายวิชา :</h4>
          <p><?php echo $data["Lesson"]['lesson_detail'];?></p>

        </div>
    </div>
  </div>
</section>
