<!--Page Header-->
<section class="page_header padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content text-center">
        <h1>ลืมรหัสผ่าน</h1>
        <p>We offer the most complete house renovating services in the country</p>
      </div>
    </div>
  </div>
</section>
<!--Page Header-->

<section id="error" class="padding">
		
  <div class="container">
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
	  <div class="col-md-6">
		  <div class="well">
			  <form id="loginForm" method="POST" action="/login/" novalidate="novalidate">
				  <div class="form-group">
					  <label for="username" class="control-label">Username</label>
					  <input type="text" class="form-control" id="username" name="username" placeholder="กรอกชื่อผู้ใช้งานของคุณ" title="Please enter you username">
					  <span class="help-block"></span>
				  </div>
				  <div class="form-group">
					  <label for="password" class="control-label">Password</label>
					  <input type="password" class="form-control" id="password" name="password" placeholder="กรอกรหัสผ่าน" title="Please enter your password">
					  <span class="help-block"></span>
				  </div>
				  <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
				  <div class="checkbox">
					  <label>
						  <input type="checkbox" name="remember" id="remember"> Remember login
					  </label>
					  <p class="help-block">(if this is a private computer)</p>
				  </div>
				  <button type="button" class="btn btn-success btn-block" onclick="signin();">Login</button>
				  <a href="/forgot/" class="btn btn-default btn-block">Help to login</a>
			  </form>
		  </div>
	  </div>
	  <div class="col-md-6">
		  <p class="lead">Register now for <span class="text-success">FREE</span></p>
		  <ul class="list-unstyled" style="line-height: 2">
			  <li><span class="fa fa-check text-success"></span> See all your orders</li>
			  <li><span class="fa fa-check text-success"></span> Fast re-order</li>
			  <li><span class="fa fa-check text-success"></span> Save your favorites</li>
			  <li><span class="fa fa-check text-success"></span> Fast checkout</li>
			  <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
			  <li><a href="/read-more/"><u>Read more</u></a></li>
		  </ul>
		  <p><a href="/new-customer/" class="btn btn-info btn-block">Yes please, register now!</a></p>
	  </div>
	  </div>
  </div>
  </div>
</section>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title text-center">ลืมรหัสผ่านของคุณ</h4>
</div>

<div class="modal-body">
	<div class="row gap-20">
		<form id="frm-forgot">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<p class="mb-20">ระบุอีเมล์ที่คุณใช้สมัครสมาชิก ระบบจะทำการจัดส่งลิงค์สำหรับสร้างรหัสผ่านให้ทางอีเมล์ หากไม่ได้รับอีเมล์กรุณาแจ้งผู้ดูแลระบบค่ะ</p>
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">

			<div class="form-group"> 
				<label>อีเมล์</label>
				<input class="form-control" id="email" name="email" placeholder="กรอกอีเมล์ของคุณ" type="text"> 
			</div>
		
		</div>
		
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="login-box-box-action">
				ย้อนไป <a data-toggle="modal" href="#loginModal">เข้าสู่ระบบ</a>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="modal-footer text-center">
	<button type="button" class="btn btn-primary" onclick="forgotpassword();">ส่งข้อมูล</button>
	<button type="button" data-dismiss="modal" class="btn btn-dark">ปิด</button>
</div>

<?php engine::html("theme","js","js/plugin/waitMe-gh-pages/waitMe.js");?>
<?php engine::html("theme","css","js/plugin/waitMe-gh-pages/waitMe.css");?>

<script>
$('#frm-forgot').keypress(function (e) 
{
	console.log("enter");
	var key = e.which;
	if(key == 13)
	{
		forgotpassword();
		return false;  
	}
});
</script>