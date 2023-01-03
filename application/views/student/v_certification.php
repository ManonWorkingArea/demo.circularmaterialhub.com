
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area breadcrumb-area-member instructor-breadcrumb-area text-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                    <div class="bread-img-wrap flex-shrink-0">
                        <img src="<?php echo engine::student("avatar");?>" alt="">
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-40"><?php echo $data["Student"]['fullname']?></h2>
                        <p class="section__desc font-size-16 mb-1">โทร <?php echo $data["Student"]['phone']?> อีเมล์ <?php echo $data["Student"]['email']?></p>
                        <p class="section__desc font-size-16 mb-0">สมัครเมื่อ <?php echo engine::thaidate($data["Student"]['regdate'])?></p>
                    </div>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->

</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<div class="quiz-action-nav bg-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quiz-action-content d-flex align-items-center justify-content-between">
                        <ul class="quiz-nav d-flex align-items-center">
                            <li><a href="student"><i class="fa fa-home"></i></a></li>
                            <li><a href="app"><span class="badge badge-dark"><?php echo $data["Overview"]['total']?></span> ใบสมัคร</a></li>
                            <li><a href="student/course"><span class="badge badge-dark"><?php echo $data["Overview"]['total']?></span> หลักสูตร</a></li>
                            <li><a href="student/certification" class="active"><span class="badge badge-dark"><?php echo $data["Overview"]['certification']?></span> ใบรับรองผล</a></li>
                            <li><a href="student/profile">ข้อมูลส่วนตัว</a></li>
                        </ul>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div>
<!--======================================
        START SPEAKER AREA
======================================-->
<section class="team-detail-area section-flat-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
							<h3 class="widget-title pb-3">ใบรับรองผลการเรียนของคุณ</h3>
							<div class="section-block"></div>
            </div>
        </div>

				<div class="row mt-5">

					<?php

						foreach ($data["Certification"] as $Cert)
						{
							$detail 	  = engine::shorttext($Cert['post_detail'], 100);
							$date 	    = engine::thaidate($Cert['stu_cert_adddate']);

							echo
							"<div class='col-lg-4 column-td-half'>
									<div class='card-item card-preview'>
											<div class='card-image'>
													<a href='certification/show/{$Cert['stu_cert_token']}' target='_blank' class='card__img'><img src='https://{$Cert['school_s3_bucket']}.{$Cert['school_s3_url']}/{$Cert['template_certification_bg']}' alt=''></a>
													<div class='card-badge'>
															<span class='badge-label'>ใบรับรอง</span>
													</div>
											</div><!-- end card-image -->
											<div class='card-content'>
													<p class='card__label'>
															<span class='card__label-text'>เมื่อ {$date}</span>
															<a href='certification/show/{$Cert['stu_cert_token']}/print' target='_blank' class='card__collection-icon' data-toggle='tooltip' data-placement='top' title='พิมพ์'><span class='fa fa-print'></span></a>
                              <a href='certification/show/{$Cert['stu_cert_token']}/download' target='_blank' class='card__collection-icon' data-toggle='tooltip' data-placement='top' title='ดาวน์โหลด'><span class='fa fa-download'></span></a>
													</p>
													<h3 class='card__title'>
															<a href='certification/show/{$Cert['stu_cert_token']}' target='_blank'>{$Cert['lesson_name']}</a>
													</h3>
													<p class='card__author'>
															{$Cert['stu_cert_token']}
													</p>
											</div>
									</div>
							</div>";
						}

						?>
				</div>
    </div>
</section>
<!--======================================
        END SPEAKER AREA
======================================-->
