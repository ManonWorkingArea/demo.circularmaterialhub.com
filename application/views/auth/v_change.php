
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">ตั้งค่ารหัสผ่านใหม่</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="home">หน้าหลัก</a></li>
                        <li class="active__list-item">สมาชิก</li>
                        <li>ลืมรหัสผ่าน</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START LOGIN AREA
================================= -->
<section class="login-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-title text-center">
                        <h3 class="widget-title font-size-25">ตั้งค่ารหัสผ่าน WEIS ใหม่</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form method="post" id="frm-reset">
                              <input type="hidden" id="token" name="token" placeholder="token" value="<?php echo $data["Auth"]['key'];?>">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <div class="input-box">
                                          <label class="label-text">รหัสผ่าน<span class="primary-color-2 ml-1">*</span></label>
                                          <div class="form-group">
                                              <input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน">
                                              <span class="la la-lock input-icon"></span>
                                          </div>
                                      </div>
                                  </div><!-- end col-md-12 -->
                                  <div class="col-lg-12">
                                      <div class="input-box">
                                          <label class="label-text">ยืนยันรหัสผ่าน<span class="primary-color-2 ml-1">*</span></label>
                                          <div class="form-group">
                                              <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="ยืนยันรหัสผ่าน">
                                              <span class="la la-lock input-icon"></span>
                                          </div>
                                      </div>
                                  </div><!-- end col-md-12 -->

                              </form>

                              <div class="col-lg-12 ">
                                  <div class="btn-box">
                                      <a href="javascript:void(0);" class="theme-btn" onclick="resetPassword();"><i class="fa fa-send"></i> เปลี่ยนรหัสผ่าน</a>
                                  </div>
                                  <p class="mt-4 text-danger"><strong>คำแนะนำ </strong></br>หลังจากบันทึกข้อมูลรหัสผ่านใหม่แล้ว คุณจะสามารถเข้าสู่ระบบด้วยรหัสผ่านใหม่ได้ทันที</p>
                                  <p class="mt-4">เป็นสมาชิก WEIS อยู่แล้ว ? <a href="auth/login" class="primary-color-2">เข้าสู่ระบบ</a></p>
                              </div><!-- end col-md-12 -->

                          </div><!-- end row -->

                        </div><!-- end contact-form -->
                    </div>
                </div>
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end login-area -->
<!-- ================================
       START LOGIN AREA
================================= -->
