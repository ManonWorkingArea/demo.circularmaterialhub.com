
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">เข้าสู่ระบบ</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="index.html">หน้าหลัก</a></li>
                        <li class="active__list-item">สมาชิก</li>
                        <li>เข้าสู่ระบบ</li>
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
                        <h3 class="widget-title font-size-25">เข้าสู่ระบบบ WEIS</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form method="post" id="frm-signin">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">อีเมล์<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="username" name="username" placeholder="อีเมล์/บัญชีผู้ใช้งาน">
                                                <span class="la la-envelope input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">รหัสผ่าน<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน">
                                                <span class="la la-lock input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12 ">
                                        <div class="btn-box">
                                            <a href="javascript:void(0);" class="theme-btn" onclick="login();"><i class="fa fa-key"></i> เข้าสู่ระบบ</a>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <p class="mt-4">ยังไม่มีบัญชี WEIS ? <a href="auth/register" class="primary-color-2">ลงทะเบียน</a></p> <p class="mt-4">มีบัญชีแล้วแต่จำรหัสผ่านหรือชื่อผู้ใช้งานไม่ได้ ? <a href="auth/reset" class="primary-color-2">แจ้งลืมรหัสผ่าน</a></p>
                                    </div><!-- end col-md-12 -->
                                </div><!-- end row -->
                            </form>
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
<style>
.widget-title {
    font-size: 22px;
    font-weight: 600;
    min-height: 25px;
    line-height: 20px;
}
</style>