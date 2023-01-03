<div class="main-wrapper scrollspy-container">

	<div class="breadcrumb-wrapper">
	
		<div class="container">

			<h1 class="page-title">แก้ไขข้อมูลส่วนตัว</h1>
			
			<div class="row">
			
				<div class="col-xs-12 col-sm-8">
							<ol class="breadcrumb">
								<li><a href="#">หน้าหลัก</a></li>
								<li><a href="#">ข้อมูล</a></li>
								<li class="active">แก้ไขข้อมูลส่วนตัว</li>
							</ol>
						</div>
				
				<div class="col-xs-12 col-sm-4 hidden-xs">
					<p class="hot-line"> <i class="fa fa-phone"></i> Hot Line: 1-222-33658</p>
				</div>
				
			</div>
			
		</div>

	</div>
	
	<div class="equal-content-sidebar-wrapper detail-page-wrapper">
		<div class="equal-content-sidebar-by-gridLex">
			<div class="container">
			
				<div class="GridLex-grid-noGutter-equalHeight">
				
					<div class="GridLex-col-3_sm-4_xs-12_xss-12">
					
						<aside class="sidebar-wrapper profile-sidebar">
							<div class="sidebar-menu-wrapper">
								<ul class="sidebar-menu">
									<li class="sidebar-menu-title"><h5 class="text-primary">Quick Menu</h5></li>
									<li class="active"><a href="#profile-tab" data-toggle="tab"><i class="fa fa-user"></i> ตั้งค่าข้อมูลส่วนตัว</a></li>
									<li><a href="#address-tab" data-toggle="tab"><i class="fa fa-envelope"></i> ตั้งค่าที่อยู่</a></li>
									<li><a href="#password-tab" data-toggle="tab"><i class="fa fa-key"></i> เปลี่ยนรหัสผ่าน</a></li>
								</ul>
							</div>
						</aside>
						
					</div>

					<div class="GridLex-col-9_sm-8_xs-12_xss-12">
						
						<div class="content-wrapper">
					
							<div class="payment-content-wrapper mb-0">
								<div class="tab-content stacked-content">

									<div class="tab-pane fade in active" id="profile-tab">
									  
									  <h4 class="thai bold">แก้ไขข้อมูลส่วนตัว</h4>
									  <p>แก้ไขข้อมูลส่วนตัวของคุณ เพื่อการใช้งานอย่างราบรื่น กรุณาใช้อีเมล์และเบอร์โทรที่ใช้งานจริง เพื่อจะได้ไม่พลาดโปรโมชั่นดีๆจากเรา</p>
									  <hr />
										
										<?php $profile = engine::student("profile");?>
										
									  <form class="contact-form-wrapper" id="frm-editprofile">
									  
										<div class="row">
									
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="firstname">ชื่อจริง <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $profile['firstname']?>">
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="lastname">นามสกุลจริง <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $profile['lastname']?>">
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="username">ชื่อผู้ใช้งาน</label>
													<input type="text" class="form-control" id="username" name="username" value="<?php echo $profile['username']?>" disabled>
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="email">อีเมล์</label>
													<input type="text" class="form-control" id="email" name="email" value="<?php echo $profile['email']?>" disabled>
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
										</div>
										
										<div class="row">
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="phone">เบอร์โทร <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $profile['phone']?>">
													<div class="help-block with-errors"></div>
												</div>
												
											</div>

											<div class="col-sm-12">
												<div class="form-group">
													<button type="button" class="btn btn-success" onclick="editprofile();"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
													&nbsp;
													<button type="reset" class="btn btn-default">ยกเลิก</button>
												</div>
											</div>
										</div>
										
									</form>
									</div>
									
									<div class="tab-pane fade" id="password-tab">
									  <h4 class="thai bold">เปลี่ยนรหัสผ่าน</h4>
									  <p>เพื่อป้องกันการแฮกหรือสุ่มรหัสผ่าน สมาชิกอย่าใช้พาสง่ายต่อการเดาหรือรหัสผ่านคล้ายๆกับuser หากเกิดปัญหาเราจะไม่รับผิดชอบ</p>
									  <br />

									  <form class="form-horizontal" id="frm-editpassword">

										<div class="form-group">

										  <label class="col-md-3">รหัสผ่านเก่า</label>

										  <div class="col-md-7">
											<input type="password" name="old-password" id="old-password" class="form-control" placeholder="กรอกรหัสผ่านเก่า" />
										  </div>

										</div>

										<hr />

										<div class="form-group">

										  <label class="col-md-3">รหัสผ่านใหม่</label>

										  <div class="col-md-7">
											<input type="password" name="new-password-1" id="new-password-1" class="form-control" placeholder="กรอกรหัสผ่านใหม่"/>
										  </div>

										</div>

										<div class="form-group">

										  <label class="col-md-3">ยืนยันรหัสผ่านใหม่</label>

										  <div class="col-md-7">
											<input type="password" name="new-password-2" id="new-password-2" class="form-control" placeholder="กรอกรหัสผ่านใหม่อีกครั้ง"/>
										  </div>

										</div>

										<br />

										<div class="form-group">

										  <div class="col-md-7 col-md-push-3">
											<button type="button" class="btn btn-success" onclick="editpassword();" ><i class="fa fa-save"></i> บันทึกข้อมูล</button>
											&nbsp;
											<button type="reset" class="btn btn-default">ยกเลิก</button>
										  </div>

										</div>

									  </form>
									</div>


									<div class="tab-pane fade" id="address-tab">
										<h4 class="thai bold">แก้ไขข้อมูลส่วนตัว</h4>
										<p>แก้ไขข้อมูลส่วนตัวของคุณ เพื่อการใช้งานอย่างราบรื่น กรุณาใช้อีเมล์และเบอร์โทรที่ใช้งานจริง เพื่อจะได้ไม่พลาดโปรโมชั่นดีๆจากเรา</p>

										<hr />

									<form class="contact-form-wrapper" id="frm-editaddress">

										<div class="row">
											
											<div class="col-sm-12">
											
												<div class="form-group">
													<label for="address">ที่อยู่ <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<textarea type="text" class="form-control" rows="8" id="address" name="address"><?php echo $profile['address']?></textarea>
													<div class="help-block with-errors"></div>
												</div>

											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="district">ตำบล <span class="font10 text-danger">(*ต้องระบุ)</span></label>

													<select id="district" name="district" class="form-control" style="width:100%;">       
														<?php
															
															echo "<optgroup label='เลือกตำบล'>";
															foreach ($data["Districts"] as $Districts)
															{
																if($profile['district'] == $Districts['DISTRICT_CODE'])
																{
																	$select = "selected";
																}
																else
																{
																	$select = "";
																}
																
																echo  "<option value='{$Districts['DISTRICT_CODE']}' data-val='{$Districts['AMPHUR_ID']}' data-zip='{$Districts['DISTRICT_CODE']}' {$select}>{$Districts['DISTRICT_NAME']}</option>";
															}
															echo "</optgroup>";
														?>
													</select>
												
						
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="amphures">อำเภอ <span class="font10 text-danger">(*ต้องระบุ)</span></label>
																										
													<select id="amphures" name="amphures" class="form-control" style="width:100%;">       
														<?php
															
															echo "<optgroup label='เลือกอำเภอ'>";
															foreach ($data["Amphures"] as $Amphures)
															{
																if($profile['amphures'] == $Amphures['AMPHUR_ID'])
																{
																	$select = "selected";
																}
																else
																{
																	$select = "";
																}
																
																echo  "<option value='{$Amphures['AMPHUR_ID']}' data-val='{$Amphures['PROVINCE_ID']}' {$select}>{$Amphures['AMPHUR_NAME']}</option>";
															}
															echo "</optgroup>";
														?>
													</select>
													
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="province">จังหวัด <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<select id="province" name="province" class="form-control" style="width:100%;">       
														<?php
															
															echo "<optgroup label='เลือกจังหวัด'>";
															foreach ($data["Provinces"] as $Provinces)
															{
																if($profile['province'] == $Provinces['PROVINCE_ID'])
																{
																	$select = "selected";
																}
																else
																{
																	$select = "";
																}
																
																echo  "<option value='{$Provinces['PROVINCE_ID']}' {$select}>{$Provinces['PROVINCE_NAME']}</option>";
															}
															echo "</optgroup>";
														?>
													</select>
													
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-6">
											
												<div class="form-group">
													<label for="zipcode">รหัสไปรษณีย์ <span class="font10 text-danger">(*ต้องระบุ)</span></label>
													<select id="zipcode" name="zipcode" class="form-control" style="width:100%;">       
														<?php
															
															echo "<optgroup label='เลือกรหัสไปรษณีย์'>";
															foreach ($data["Zipcode"] as $Zipcode)
															{
																if($profile['zipcode'] == $Zipcode['id'])
																{
																	$select = "selected";
																}
																else
																{
																	$select = "";
																}
																
																echo  "<option value='{$Zipcode['id']}' data-val='{$Zipcode['district_code']}' {$select}>{$Zipcode['zipcode']}</option>";
															}
															echo "</optgroup>";
														?>
													</select>
													<div class="help-block with-errors"></div>
												</div>
												
											</div>
											
											<div class="col-sm-12">
												<div class="form-group">
													<button type="button" class="btn btn-success" onclick="editaddress();"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
													&nbsp;
													<button type="reset" class="btn btn-default">ยกเลิก</button>
												</div>
											</div>
											
										</div>
										
									</form>
									
									</div> <!-- /.tab-pane -->
								</div> <!-- /.tab-content -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>