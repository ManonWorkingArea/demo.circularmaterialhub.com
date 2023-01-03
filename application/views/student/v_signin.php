<div class="layout-login-centered-boxed__form card">
    <div class="d-flex flex-column justify-content-center align-items-center mt-2 mb-5 navbar-light">
        <a href="learnly-index.html" class="navbar-brand flex-column mb-2 align-items-center mr-0" style="min-width: 0">

            <span class="avatar avatar-sm navbar-brand-icon mr-0">

                <span class="avatar-title rounded bg-primary"><img src="theme/luma/assets/images/logo/new_logo.png" alt="logo" class="img-fluid" /></span>

            </span>

            FTI Academy
        </a>
        <p class="m-0">เข้าสู่ระบบ FTI Academy </p>
    </div>

    <div class="alert alert-soft-success d-flex" role="alert">
        <i class="material-icons mr-12pt">check_circle</i>
        <div class="text-body">An email with password reset instructions has been sent to your email address, if it exists on our system.</div>
    </div>

    <a href="learnly-index.html" class="btn btn-light btn-block mb-24pt">
        <span class="fab fa-google icon--left"></span>
        เข้าระบบด้วยบัญชี Facebook
    </a>

    <div class="page-separator justify-content-center">
        <div class="page-separator__text bg-white">หรือ</div>
    </div>

    <form id="frm-signin" novalidate>
        <div class="form-group">
            <label class="text-label" for="username">อีเมล์ :</label>
            <div class="input-group input-group-merge">
                <input id="username" name="username" type="email" required="" class="form-control form-control-prepended" placeholder="john@doe.com">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="far fa-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="text-label" for="password">รหัสผ่าน :</label>
            <div class="input-group input-group-merge">
                <input id="password" name="password" type="password" required="" class="form-control form-control-prepended" placeholder="Enter your password">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span class="fa fa-key"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary" type="button" onclick="login();">เข้าสู่ระบบ</button>
        </div>
        <div class="form-group text-center">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="remember">
                <label class="custom-control-label" for="remember">จดจำบัญชีของฉัน</label>
            </div>
        </div>
        <div class="form-group text-center">
            <a href="">ลืมรหัสผ่าน ?</a> <br>
            ยังไม่มีบัญชี FTI Academy ? <a class="text-body text-underline" href="learnly-signup.html">สมัครสมาชิก!</a>
        </div>
    </form>
</div>





<!--Page Header-->
<!-- <section class="page_header padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content text-center">
        <h1>เข้าสู่ระบบ</h1>
        <p><i>"<?php echo $_SESSION["School"]['slogan'];?>"</i></p>
      </div>
    </div>
  </div>
</section> -->
<!--Page Header-->

<!-- <section id="error" class="padding">

  <div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	  <div class="col-md-6">
		  <div class="well">
				<form id="frm-signin">
					<div class="form-group">
						<label for="username" class="control-label">ชื่อบัญชีผู้ใช้</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="กรอกชื่อผู้ใช้งานของคุณ" title="Please enter you username">
						<span class="help-block"></span>
					</div>
					<div class="form-group">
					  <label for="password" class="control-label">รหัสผ่าน</label>
					  <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" title="Please enter your password">
					  <span class="help-block"></span>
					</div>
					<div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
					<div class="checkbox">
					  <label>
						  <input type="checkbox" name="remember" id="remember"> จำข้อมูล
					  </label>
					  <p class="help-block">(if this is a private computer)</p>
				  </div>

				</form>
				<button type="button" class="btn btn-success btn-block" onclick="login();">เข้าสู่ระบบ</button>
				<a href="student/forgot" class="btn btn-default btn-block">ลืมรหัสผ่าน</a>
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
			  <li><a href="/read-more/"><u>Read more</u></a></li>
		  </ul>
		  <p><a href="student/register" class="btn btn-info btn-block">สมัครสมาชิกใหม่ !</a></p>
	  </div>
	  </div>
  </div>
  </div>
</section> -->
