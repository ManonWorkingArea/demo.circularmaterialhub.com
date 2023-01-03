<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="learnly-index.html" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">

            <span class="avatar avatar-sm navbar-brand-icon mr-0">
                <span class="avatar-title rounded bg-primary"><img src="theme/luma/assets/images/illustration/student/128/white.svg" alt="logo" class="img-fluid" /></span>
            </span>

            FTI Academy
        </a>
        <p class="m-0">สมัครสมาชิก FTI Academy</p>
    </div>

    <a href="learnly-index.html" class="btn btn-light btn-block mb-24pt">
        <span class="fab fa-facebook icon--left"></span>
        สมัครสมาชิกด้วยบัญชี Facebook
    </a>

    <div class="page-separator justify-content-center">
        <div class="page-separator__text bg-white">หรือ</div>
    </div>

    <form action="learnly-index.html" novalidate>
        <div class="form-group">
            <label class="text-label" for="name_2">ชื่อ/นามสกุล:</label>
            <div class="input-group input-group-merge">
                <input id="name_2" type="text" required="" class="form-control form-control-prepended" placeholder="John Doe">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-user"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="email_2">อีเมล์:</label>
            <div class="input-group input-group-merge">
                <input id="email_2" type="email" required="" class="form-control form-control-prepended" placeholder="john@doe.com">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password_2">รหัสผ่าน:</label>
            <div class="input-group input-group-merge">
                <input id="password_2" type="password" required="" class="form-control form-control-prepended" placeholder="Enter your password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mb-5">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" checked="" class="custom-control-input" id="terms" />
                <label class="custom-control-label" for="terms">ฉันยอมรับ <a href="#">เงื่อนไขและข้อตกลงการใช้งาน</a></label>
            </div>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary mb-2" type="submit">สมัครสมาชิก</button><br>
            <a class="text-body text-underline" href="learnly-login.html">มีบัญชี FTI Academy แล้ว? เข้าสู่ระบบ</a>
        </div>
    </form>
</div>

<!--
<section class="page_header padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content text-center">
        <h1>สมัครสมาชิกใหม่</h1>
        <p><i>"<?php echo $_SESSION["School"]['slogan'];?>"</i></p>
      </div>
    </div>
  </div>
</section>

<section id="error" class="padding">

  <div class="container" id="register-form">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	  <div class="col-md-6">
		  <div class="well">
				<form id="frm-signup">
					<div class="form-group">
						<label for="username" class="control-label">ชื่อบัญชีผู้ใช้</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="ระบุชื่อผู้ใช้งาน" title="ระบุชื่อผู้ใช้งาน">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
					  <label for="email" class="control-label">อีเมล์</label>
					  <input type="text" class="form-control" id="email" name="email" placeholder="ระบุอีเมล์" title="ระบุอีเมล์">
					  <span class="help-block"></span>
					</div>
					<div class="form-group">
					  <label for="password" class="control-label">รหัสผ่าน</label>
					  <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" title="กรอกรหัสผ่าน">
					  <span class="help-block"></span>
					</div>
					<div class="form-group">
					  <label for="cpassword" class="control-label">รหัสผ่าน</label>
					  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="ยืนยันรหัสผ่านอีกครั้ง" title="ยืนยันรหัสผ่านอีกครั้ง">
					  <span class="help-block"></span>
					</div>
					<div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>

				</form>

		  </div>
	  </div>
	  <div class="col-md-6">
		  <p class="lead">สมัครสมาชิก <span class="text-success">ฟรี</span></p>
		  <ul class="list-unstyled" style="line-height: 2">
			  <li><span class="fa fa-check text-success"></span> See all your orders</li>
			  <li><span class="fa fa-check text-success"></span> Fast re-order</li>
			  <li><span class="fa fa-check text-success"></span> Save your favorites</li>
			  <li><span class="fa fa-check text-success"></span> Fast checkout</li>
			  <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
			  <li><small>เมื่อคุณเลือก สมัครสมาชิก แล้วถือว่าคุณยอมรับ <a href="#">ข้อตกลงการใช้งาน</a> แล้ว</small></li>
		  </ul>
		  <p><button type="button" class="btn btn-primary btn-block btn-lg" onclick="register();">สมัครสมาชิก</button></p>
	  </div>
	  </div>
  </div>
  </div>
</section>

<script>
$('#frm-signup').keypress(function (e)
{
	console.log("enter");
	var key = e.which;
	if(key == 13)
	{
		register();
		return false;
	}
});
</script> -->
