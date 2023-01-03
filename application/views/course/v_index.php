
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">หลักสูตรมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ (Eco-Factory)</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="home">หน้าหลัก</a></li>
                        <li>หลักสูตรของเรา</li>
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
        START COURSE AREA
======================================-->
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container">

            <div class="course-content-wrapper mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="row">

                                <?php

                                foreach ($data["Course"]['lesson'] as $Lesson)
                                {
                                    $detail 	= engine::shorttext($Lesson['post_detail'], 100);
                                    $date 	  = engine::thaidate($Lesson['post_adddate']);

                                    if($Lesson['lesson_sale_price']=="0")
                                    {
                                        $price = "เรียนฟรี";
                                    }
                                    else
                                    {
                                        $price = $Lesson['lesson_sale_price'];
                                    }

                                    if($Lesson['lesson_counter']==""||$Lesson['lesson_counter']==NULL)
                                    {
                                        $visitor = "0";
                                    }
                                    else
                                    {
                                        $visitor = $Lesson['lesson_counter'];
                                    }

                                    echo
                                    "<div class='col-lg-6'>
                                        <div class='card-item card-preview' data-tooltip-content='#tooltip_content_1'>
                                            <div class='card-image'>
                                                <a href='course/detail/{$Lesson['lesson_code']}' class='card__img'><img src='https://{$Lesson['school_s3_url']}/{$Lesson['school_s3_bucket']}/{$Lesson['lesson_cover']}' alt=''></a>
                                                <div class='card-badge'>
                                                    <span class='badge-label'>Eco Factory</span>
                                                </div>
                                            </div>
                                            <div class='card-content'>
                                                <p class='card__label'>
                                                    <span class='card__label-text'>beginner</span>
                                                    <a href='javascript:void(0);' class='card__collection-icon' data-toggle='tooltip' data-placement='top' title='Add to Wishlist'><span class='la la-heart-o'></span></a>
                                                </p>
                                                <h3 class='card__title'>
                                                    <a href='course/detail/{$Lesson['lesson_code']}'>{$Lesson['lesson_name']}</a>
                                                </h3>
                                                <p class='card__author'>
                                                    <a href='javascript:void(0);'>{$Lesson['teacher_name']}</a>
                                                </p>
                                                <div class='rating-wrap d-flex mt-2 mb-3'>
                                                    <ul class='review-stars'>
                                                        <li><span class='la la-star'></span></li>
                                                        <li><span class='la la-star'></span></li>
                                                        <li><span class='la la-star'></span></li>
                                                        <li><span class='la la-star'></span></li>
                                                        <li><span class='la la-star-o'></span></li>
                                                    </ul>
                                                    <span class='star-rating-wrap'>
                                                    <span class='star__rating'>0</span>
                                                    <span class='star__count'>({$visitor})</span>
                                                </span>
                                                </div>
                                                <div class='card-action'>
                                                    <ul class='card-duration d-flex justify-content-between align-items-center'>
                                                        <li>
                                                        <span class='meta__date'>
                                                            <i class='la la-money'></i> {$price}
                                                        </span>
                                                        </li>
                                                        <li>
                                                        <span class='meta__date'>
                                                            <i class='la la-clock-o'></i> {$Lesson['duration']}
                                                        </span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class='card-price-wrap d-flex justify-content-between align-items-center'>
                                                    <a href='course/detail/{$Lesson['lesson_code']}' class='btn btn-primary btn-lg btn-block'>ดูข้อมูล</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                }

								?>

                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                        </div>
                    </div>
                </div><!-- end row -->
            </div><!-- end card-content-wrapper -->
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->
