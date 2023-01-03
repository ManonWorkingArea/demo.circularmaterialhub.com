<div class="row">

	<div class="col-md-4">
	  <div class="portlet portlet-plain">
		<div class="portlet-header">
		  <h3><i class="fa fa-vcard"></i> ข้อมูลส่วนตัว</h3>
		</div>

		<div class="portlet-content">

		  <form id="frm-signup" class="form parsley-form">

			<div class="form-group">
			  <label for="nickname">ชื่อเรียกในระบบ</label>
			  <input type="text" id="nickname" name="nickname" class="form-control" placeholder="กรอกชื่อเรียกในระบบ">
			</div>
			
			<div class="form-group">
			  <label for="phone">เบอร์มือถือ</label>
			  <input type="text" id="phone" name="phone" class="form-control" placeholder="กรอกเบอร์โทร">
			</div>

			<div class="form-group">
			  <label for="email">อีเมล์</label>
			  <input type="text" id="email" name="email" class="form-control" placeholder="กรอกอีเมล์สำหรับใช้งานในระบบ">
			</div>


		</div>
	  </div>
	</div>

	<div class="col-md-4">
	  <div class="portlet portlet-plain">
		<div class="portlet-header">
		  <h3><i class="fa fa-cogs"></i> ข้อมูลในระบบ</h3>
		</div>

		<div class="portlet-content">

			<div class="form-group">
			  <label for="username">ชื่อผู้ใช้งาน</label>
			  <input type="text" id="username" name="username" class="form-control" placeholder="กรอกชื่อผู้ใช้งานเพื่อเข้าสู่ระบบ">
			</div>
			
			<div class="form-group">
			  <label for="password">รหัสผ่าน</label>
			  <input type="text" id="password" name="password" class="form-control" placeholder="ระบุรหัสผ่าน">
			</div>
			
			<div class="form-group">
			  <label for="cpassword">ยืนยันรหัสผ่าน</label>
			  <input type="text" id="cpassword" name="cpassword" class="form-control" placeholder="ระบุรหัสผ่านอีกครั้ง">
			</div>

		</div>
	  </div>
	</div>
	
	<div class="col-md-4">
	  <div class="portlet portlet-plain">
		<div class="portlet-header">
		  <h3><i class="fa fa-bank"></i> ข้อมูลบัญชีธนาคาร</h3>
		</div>

		<div class="portlet-content">

			<div class="form-group">
			  <label for="bankname">ชื่อบัญชี</label>
			  <input type="text" id="bankname" name="bankname" class="form-control" placeholder="ระบุชื่อบัญชี">
			</div>
			
			<div class="form-group">
				<label for="bankid">ธนาคาร</label>
				<select id="bankid" name="bankid" class="form-control">       
					<?php
						echo "<optgroup label='เลือกธนาคาร'>";
						foreach ($data["BankTable"] as $Bank)
						{
							echo  "<option value='{$Bank['b_id']}'>{$Bank['bank_name']}</option>";
						}
						echo "</optgroup>";
					?>
				</select>
			</div>
			
			<div class="form-group">
			  <label for="banknumber">เลขที่บัญชี</label>
			  <input type="text" id="banknumber" name="banknumber" class="form-control" placeholder="กรอกเลขที่บัญชี">
			</div>

		  </form>

		</div>
	  </div>
	</div>
	
	<div class="col-md-12">
		<p>มีบัญชี <strong>we-lotto.com แล้ว</strong> ? <a href="home/view/login"><strong>เข้าสู่ระบบ</strong></a></p>
		<hr>
		<button type="button" class="btn btn-primary" onclick="signup();">สมัครสมาชิก</button>
	</div>
		
</div>

<script>
	ref = "<?php echo $data["Data"]['ref'];?>";
</script>
