<?php
$avatar = engine::student("avatar");
?>
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area breadcrumb-area-member instructor-breadcrumb-area text-left">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                    <div class="bread-img-wrap flex-shrink-0">
                        <img src="<?php echo $avatar;?>" alt="">
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
                            <li><a href="student/certification"><span class="badge badge-dark"><?php echo $data["Overview"]['certification']?></span> ใบรับรองผล</a></li>
                            <li><a href="student/profile" class="active">ข้อมูลส่วนตัว</a></li>
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
							<div class="section-tab section-tab-2">
		              <ul class="nav nav-tabs" role="tablist" id="review">
		                  <li role="presentation">
		                      <a href="#profile" role="tab" data-toggle="tab" class="active" aria-selected="true">
		                          <span class="la la-user input-icon"></span> ข้อมูลส่วนตัว
		                      </a>
		                  </li>
                      <!-- <li role="presentation">
		                      <a href="javascript:void(0);" role="tab" data-toggle="tab" class="" aria-selected="false">
		                          แก้ไขที่อยู่
		                      </a>
		                  </li> -->
		                  <li role="presentation">
		                      <a href="#password" role="tab" data-toggle="tab" aria-selected="false" class="">
		                           <span class="la la-lock input-icon"></span> แก้ไขรหัสผ่าน
		                      </a>
		                  </li>
		                  <!-- <li role="presentation">
		                      <a href="#account" role="tab" data-toggle="tab" aria-selected="false" class="">
		                          จัดการบัญชี
		                      </a>
		                  </li> -->
		              </ul>
		          </div>
            </div>

            <?php //print_r($_SESSION["Student"]);?>

						<div class="col-lg-12">
							<div class="dashboard-tab-content mt-5">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active show" id="profile">
                        <div class="user-form">
													<div class="user-profile-action-wrap mb-5">
																<h3 class="widget-title font-size-18 padding-bottom-40px">ตั้งค่าบัญชี</h3>
																<div class="user-profile-action d-flex align-items-center">
																		<div class="user-pro-img">
																				<img src="<?php echo $avatar;?>" alt="user-image" class="img-fluid radius-round border" id="preview-profile">
																		</div>
																		<div class="upload-btn-box course-photo-btn">
																				<form action="#" method="post" enctype="multipart/form-data">
																						<input type="file" name="files[]" class="filer_input" multiple="multiple" onchange="getBaseUrl()">
																				</form>
																				<p><small>ขนาดไฟล์สูงสุด 5MB, ขนาดรูป: 200x200 และเป็นนามสกุล .jpg &amp; .png</small></p>
																		</div>
																</div>
														</div>
                            <div class="contact-form-action">

                                <form method="post" id="frm-edit-profile">
                                    <input class="form-control" type="hidden" name="avatar" id="avatar">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">ชื่อจริง<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $_SESSION["Student"]['firstname'];?>">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">นามสกุลจริง<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $_SESSION["Student"]['lastname'];?>">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">อีเมล์<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION["Student"]['email'];?>">
                                                    <span class="la la-envelope input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">เบอร์โทร<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $_SESSION["Student"]['phone'];?>">
                                                    <span class="la la-phone input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="btn-box">
                                                <button class="theme-btn" type="button" onclick="editProfile();"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="password">
                        <div class="user-form padding-bottom-60px">
                            <div class="user-profile-action-wrap">
                                <h3 class="widget-title font-size-18 padding-bottom-40px">เปลี่ยนรหัสผ่าน</h3>
                            </div>
                            <div class="contact-form-action">

                                <form method="post" id="frm-edit-password">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">ชื่อบัญชี<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $_SESSION["Student"]['username'];?>" disabled readonly>
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">รหัสผ่านเก่า<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="password" id="password" placeholder="รหัสผ่านเก่า">
                                                    <span class="la la-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">รหัสผ่านใหม่<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="new_password" id="new_password" placeholder="รหัสผ่านใหม่">
                                                    <span class="la la-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="input-box">
                                                <label class="label-text">ยืนยันรหัสผ่านใมห่<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="confirm_new_password" id="confirm_new_password" placeholder="ยืนยันรหัสผ่านใหม่">
                                                    <span class="la la-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="btn-box">
                                                <button class="theme-btn" type="button" onclick="editPassword();">บันทึกรหัสผ่าน</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="account">
                        <div class="user-profile-action-wrap">
                            <h3 class="widget-title font-size-18 padding-bottom-40px">จัดการบัญชี</h3>
                        </div>
                       <div class="user-account-wrap padding-bottom-40px">
                           <div class="row">
                               <div class="col-lg-4">
                                   <div class="deactivate-account d-flex align-items-center">
                                       <div class="payment-option">
                                           <label for="radio-7" class="radio-trigger mb-0">
                                               <input type="radio" id="radio-7" name="radio">
                                               <span class="checkmark"></span>
                                               <span class="widget-title font-size-18">ยกเลิกบัญชี</span>
                                           </label>
                                       </div>
                                       <div class="btn-box ml-3">
                                           <button class="theme-btn line-height-40 font-size-14">ยกเลิกบัญชีนี้</button>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                        <div class="section-block"></div>
                        <div class="user-profile-action-wrap padding-top-40px">
                            <div class="delete-account-wrap">
                                <h3 class="widget-title font-size-18 pb-2 text-danger">ลบบัญชีถาวร</h3>
                                <p><span class="text-warning">คำเตือน:</span> เมื่อลบข้อมูลแล้ว ประวัติการเรียนและรายการการทำรายการทั้งหมดจะถูกลบ กรุณาตรวจสอบให้ถูกต้องก่อนทำรายการ</p>
                                <div class="btn-box mt-4">
                                    <button class="theme-btn line-height-40 font-size-14" data-toggle="modal" data-target=".account-delete-modal">ลบบัญชีของฉัน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
						</div>
        </div>

				<div class="row mt-5">

				</div>
    </div>
</section>
<!--======================================
        END SPEAKER AREA
======================================-->
