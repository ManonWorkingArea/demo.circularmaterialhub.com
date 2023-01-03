<section class="inner-header bg-holder bg-overlay-black-90" style="background-image: url('<?php engine::html('img','images/bg/03.jpg');?>');">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-left mb-2 mb-md-0">
        <h1 class="breadcrumb-title mb-0 text-white">เข้าสู่ระบบ F.T.I. Academy</h1>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb d-flex justify-content-center justify-content-md-end ml-auto">
          <li class="breadcrumb-item"><a href="/"><i class="fas fa-home mr-1"></i>หน้าหลัก</a></li>
          <li class="breadcrumb-item active"><span>บัญชีผู้เรียน</span></li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="space-ptb login" id="bypass_login">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title text-center">
          <h2>เข้าสู่ระบบ</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-10 col-sm-11">

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade active show" id="login" role="tabpanel" aria-labelledby="login-tab">

            <form class="form-row mt-4 mb-4 mb-sm-5 align-items-center form-flat-style" id="frm-signin">

              <div class="form-group col-sm-12">
                <label>ชื่อบัญชี:</label>
                <input type="text" class="form-control" placeholder="ชื่อบัญชี" id="username" name="username" value="demo">
              </div>
              <div class="form-group col-sm-12">
                <label>รหัสผ่าน:</label>
                <input type="Password" class="form-control" placeholder="รหัสผ่าน" id="password" name="password" value="qaz1234">
              </div>
              <div class="col-sm-6">
                <button type="button" class="btn btn-primary btn-flat btn-block" onclick="login();">เข้าสู่ระบบ</button>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled d-flex mb-1 mt-sm-0 mt-3 justify-content-sm-end">
                  <li class="mr-1"><a class="text-dark" href="auth/register">ยังไม่ได้สมัครสมาชิก ? คลิ๊กที่นี่</a></li>
                </ul>
              </div>

            </form>
            <!-- <div class="login-social-media border pl-4 pr-4 pb-4 pt-0 rounded-sm">
              <div class="mb-4 d-block text-center"><b class="bg-white pl-2 pr-2 mt-3 d-block">Login or Sign in with</b></div>
              <form class="row">
                <div class="col-sm-6">
                  <a class="btn facebook-bg social-bg-hover d-block mb-3" href="#"><span><i class="fab fa-facebook-f mr-2"></i>Login with Facebook</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn twitter-bg social-bg-hover d-block mb-3" href="#"><span><i class="fab fa-twitter mr-2"></i>Login with Twitter</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn instagram-bg social-bg-hover d-block mb-3 mb-sm-0" href="#"><span><i class="fab fa-instagram mr-2"></i>Login with Instagram</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn linkedin-bg social-bg-hover d-block" href="#"><span><i class="fab fa-linkedin-in mr-2"></i>Login with Linkedin</span></a>
                </div>
              </form>
            </div> -->
          </div>
          <!-- <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form class="form-row mt-4 mb-4 mb-sm-5 align-items-center form-flat-style">
              <div class="form-group col-sm-12">
                <label>Username:</label>
                <input type="text" class="form-control" placeholder="">
              </div>
              <div class="form-group col-sm-12">
                <label>Email Address:</label>
                <input type="email" class="form-control" placeholder="">
              </div>
              <div class="form-group col-sm-12">
                <label>Password:</label>
                <input type="Password" class="form-control" placeholder="">
              </div>
              <div class="form-group col-sm-12">
                <label>Confirm Password:</label>
                <input type="Password" class="form-control" placeholder="">
              </div>
              <div class="col-sm-6">
                <button type="submit" class="btn btn-primary btn-flat btn-block">Sign up</button>
              </div>
              <div class="col-sm-6">
                <ul class="list-unstyled d-flex mb-1 mt-sm-0 mt-3">
                  <li class="mr-1"><a href="#">Already Registered User? Click here to login</a></li>
                </ul>
              </div>
            </form>
            <div class="login-social-media border pl-4 pr-4 pb-4 pt-0 rounded-sm">
              <div class="mb-4 d-block text-center"><b class="bg-white pl-2 pr-2 mt-3 d-block">Login or Sign in with</b></div>
              <form class="row">
                <div class="col-sm-6">
                  <a class="btn facebook-bg social-bg-hover d-block mb-3" href="#"><span><i class="fab fa-facebook-f mr-2"></i>Login with Facebook</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn twitter-bg social-bg-hover d-block mb-3" href="#"><span><i class="fab fa-twitter mr-2"></i>Login with Twitter</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn instagram-bg social-bg-hover d-block mb-3 mb-sm-0" href="#"><span><i class="fab fa-instagram mr-2"></i>Login with Instagram</span></a>
                </div>
                <div class="col-sm-6">
                  <a class="btn linkedin-bg social-bg-hover d-block" href="#"><span><i class="fab fa-linkedin-in mr-2"></i>Login with Linkedin</span></a>
                </div>
              </form>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</section>
