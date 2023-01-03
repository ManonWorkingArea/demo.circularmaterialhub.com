
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">สมัครสมาชิก</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="index.html">หน้าหลัก</a></li>
                        <li class="active__list-item">สมาชิก</li>
                        <li>สมัครสมาชิก</li>
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
       START SIGN UP AREA
================================= -->
<section class="sign-up section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-title text-center">
                        <h3 class="widget-title font-size-25">ลงทะเบียนบัญชี WEIS</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form method="post" id="frm-signup">
                                <div class="row">

                                  <div class="col-lg-2">
                                    <div class="input-box">
                                          <label class="label-text">คำนำหน้าชื่อ<span class="primary-color-2 ml-1">*</span></label>
                                          <div class="form-group">
                                              <div class="sort-ordering user-form-short">
                                                  <select class="sort-ordering-select" name="title">
                                                      <option selected>เลือกคำนำหน้าชื่อ</option>
                                                        <option value='mr'>นาย</option>
                                                        <option value='mrs'>นาง</option>
                                                        <option value='ms'>นางสาว</option>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                    <div class="col-lg-5">
                                        <div class="input-box">
                                            <label class="label-text">ชื่อ<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="name" name="name" placeholder="ชื่อ">
                                                <span class="la la-user input-icon"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="input-box">
                                            <label class="label-text">นามสกุล<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="lastname" name="lastname" placeholder="นามสกุล">
                                                <span class="la la-user input-icon"></span>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">อีเมล์<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="email" name="email" placeholder="อีเมล์">
                                                <span class="la la-user input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">เบอร์โทรที่สามารถติดต่อได้<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="phone" name="phone" placeholder="เบอร์โทร">
                                                <span class="la la-phone input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">รหัสผ่าน<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน">
                                                <span class="la la-lock input-icon"></span>
                                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">ยืนยันรหัสผ่าน<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="ยืนยันรหัสผ่าน">
                                                <span class="la la-lock input-icon"></span>
                                                <span toggle="#cpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">หน่วยงาน<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" name="depart_type">
                                                        <option selected>เลือกหน่วยงาน</option>
                                                          <option value='factory'>โรงงานอุตสาหกรรม</option>
                                                          <option value='company'>บริษัทเอกชน</option>
                                                          <option value='education'>สถาบันการศึกษา</option>
                                                          <option value='gov'>หน่วยงานราชการ</option>
                                                          <option value='auditor'>ที่ปรึกษาอิสระ</option>
                                                          <option value='other'>อื่นๆ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-6 -->


                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <label class="label-text">ชื่อหน่วยงาน<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="depart_name" name="depart_name" placeholder="ชื่อหน่วยงาน">
                                                <span class="la la-lock input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->


                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text">อาชีพ<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="occupation" name="occupation" placeholder="อาชีพ">
                                                <span class="la la-lock input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text">เพศ<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" name="sex">
                                                        <option selected>เลือกเพศ</option>
                                                          <option value='men'>ชาย</option>
                                                          <option value='women'>หญิง</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-6 -->

                                    <div class="col-lg-4">
                                        <div class="input-box">
                                            <label class="label-text">ช่วงอายุ<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <div class="sort-ordering user-form-short">
                                                    <select class="sort-ordering-select" name="age">
                                                        <option selected>เลือกช่วงอายุ</option>
                                                          <option value='18-24'>18-24 ปี</option>
                                                          <option value='25-34'>25-34 ปี</option>
                                                          <option value='35-44'>35-44 ปี</option>
                                                          <option value='45-54'>45-54 ปี</option>
                                                          <option value='55-64'>55-64 ปี</option>
                                                          <option value='65'>65 ปีขึ้นไป</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-lg-6 -->
                                    <div class="col-lg-12 ">
                                        <div class="btn-box">
                                            <button class="theme-btn" type="button" onclick="register();">สมัครสมาชิก</button>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <p class="mt-4">เป็นสมาชิก WEIS อยู่แล้ว ? <a href="auth/login" class="primary-color-2">เข้าสู่ระบบ</a></p>
                                    </div><!-- end col-md-12 -->
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form -->
                    </div>
                </div>
            </div><!-- end col-md-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end sign-up -->
<!-- ================================
       START SIGN UP AREA
================================= -->
<style>
.widget-title {
    font-size: 22px;
    font-weight: 600;
    min-height: 25px;
    line-height: 20px;
}
</style>