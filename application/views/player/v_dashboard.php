<!-- PAGE WRAP -->
<div id="page-wrap">
	<?php $profile = engine::student("profile");?>
    <div class="top-nav">

        <h4 class="sm black">
			<img src="<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $_SESSION["School"]['logo'];?>&wt=false" alt="Image" class="img-logo-course">
			<span class="bold"><?php echo $_SESSION["School"]['name'];?></span>
		</h4>

        <ul class="top-nav-list">
            <li class="prev-course"><a href="javascript:void(0);"><i class="icon md-angle-left"></i><span class="tooltip">ก่อนหน้า</span></a></li>
            <li class="next-course"><a href="javascript:void(0);"><i class="icon md-angle-right"></i><span class="tooltip">ถัดไป</span></a></li>
            <li class="outline-learn active">
                <a href="javascript:void(0);"><i class="icon md-users"></i></a>

                <div class="list-item-body outline-learn-body">

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-area-chart" aria-hidden="true"></i> ข้อมูลนักเรียน</h5>
						<div class="sidebar-content-area">

							<div class="timer-display">


								<div class="avatar-wrapper">
									<img class="profile-pic" src="<?php echo $profile['avatar']?>" />
									<div class="upload-button">
										<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
									</div>
									<input class="file-upload" type="file" accept="image/*"/>
								</div>

								<span class="profiletitle"><i class="fa fa-user"></i> <?php echo $profile['fullname']?></span>
								<span class="profiletitle"><i class="fa fa-tag"></i> <?php echo $profile['username']?></span>

							</div>

							<table class="table table-condensed">
								<tbody>

									<tr>
										<td width="10%"><span class="label label-danger"><i class="fa fa-envelope" aria-hidden="true"></i></span></td>
										<td width="20%"><span>อีเมล์</span></td>
										<td width="40%"><strong><?php echo $profile['email']?></strong></td>
									</tr>
									<tr>
										<td width="10%"><span class="label label-primary"><i class="fa fa-phone" aria-hidden="true"></i></span></td>
										<td width="20%"><span>เบอร์โทร</span></td>
										<td width="40%"><strong><?php echo $profile['phone']?></strong></td>
									</tr>
									<tr>
										<td width="10%"><span class="label label-primary"><i class="fa fa-power-off" aria-hidden="true"></i></span></td>
										<td width="40%"><span>เข้าสู่ระบบครั้งล่าสุด</span></td>
										<td width="40%">1 ก.ค. 60, 18:30 น.</td>
									</tr>

								</tbody>
							</table>
							</br>
							<div class="text-center">
							<button class="btn btn-primary" onclick="page('student/edit');"><i class="fa fa-pencil" aria-hidden="true"></i> แก้ไขข้อมูลส่วนตัว </button>
							<button class="btn btn-default" onclick="signout();"><i class="fa fa-power-off" aria-hidden="true"></i> ออกจากระบบ </button>
							</div>
						</div>
                    </div>

                </div>
            </li>

            <!-- DISCUSSION -->
            <li class="discussion-learn">
                <a href="javascript:void(0);"><i class="icon md-comments"></i></a>
                <div class="list-item-body discussion-learn-body">
                    <div class="inner">
                        <div class="form-discussion">
                            <form>
                                <div class="text-title">
                                    <input type="text" placeholder="ระบุหัวข้อ">
                                </div>
                                <div class="post-editor text-form-editor">
                                    <textarea placeholder="พิมพ์คำถาม"></textarea>
                                </div>
                                <div class="form-submit">
                                    <input type="submit" value="ส่งคำถาม" class="mc-btn-2 btn-style-2">
                                </div>
                                <h5>0 หัวข้อ</h5>
                            </form>
                        </div>

                        <ul class="list-discussion">


                        </ul>
                    </div>
                </div>
            </li>

            <!-- NOTE LEARN -->
            <li class="note-learn">
                <a href="javascript:void(0);"><i class="icon md-file"></i></a>
                <div class="list-item-body note-learn-body">
                    <div class="note-title">
                        <h5>บันทึกช่วยจำ</h5>
                        <a href="javascript:void(0);"><i class="fa fa-send"></i></a>
                    </div>
                    <div contenteditable="true" class="note-body">
                       พิมพ์ข้อความของคุณ
                    </div>
                </div>
            </li>
            <li class="backpage">
                <a href="home"><i class="icon md-close-1"></i></a>
            </li>
        </ul>

    </div>


    <section id="learning-section" class="learning-section learn-section">

        <div class="container">
            <div class="abc">

				<div class="course-thumbnail">

					<h4 class="sm black">
						<span class="bold">รายวิชาที่มีสิทธิ์เรียน</span> <small>อนุมัติแล้ว</small>
					</h4>

					<ul class="list-unstyled video-list-thumbs row">

						<?php

							foreach ($data["Lesson"] as $Course)
							{
								$today = engine::today();
								$mode = $Course['lesson_mode'];
								$expire = engine::thaidate($Course['permission_expire'], "date");
								$expires = engine::daydiff($today, $Course['permission_expire'], "format");

								echo  "
								<li class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>

								   <article class='card fl-left' data-bg-text='{$Course['permission_code']}'>

									  <section class='date'>
										<div class='corner-ribbon left color-{$Course['lesson_mode_key']}'>{$Course['lesson_mode_name']}</div>
										<time datetime='23th feb'>
										  <span>{$Course['count_course']}</span><span>บทเรียน</span>
										</time>
									  </section>
									  <section class='card-cont'>
										<small><i class='fa fa-circle text-success'></i> {$Course['lesson_type_name']}</small>
										<h3>{$Course['lesson_name']}</h3>
										<div class='even-date'>
										 <i class='fa fa-calendar'></i>
										 <time>
										   <span{$Course['lesson_adddate']}</span>
										   <span>เรียนได้ {$Course['lesson_hour']} ชม. {$Course['lesson_days']} วัน</span>
										 </time>
										</div>
										<div class='even-info'>
										  <i class='fa fa-clock-o'></i>
										  <p>หมดอายุ {$expire} <small>({$expires})</small></p>
										</div>
										<a href='player/show/{$Course['permission_code']}'> <i class='fa fa-youtube-play' aria-hidden='true'></i> เข้าเรียน</a>
									  </section>
									</article>

								</li>";
							}

						?>

					</ul>
				</div>

				<div class="course-thumbnail">
					<h4 class="sm black">
						<span class="bold">รายการสั่งซื้อ</span> <small>รอยืนยัน</small>
					</h4>
					<ul class="list-unstyled video-list-thumbs row">

						<?php

							foreach ($data["Order"] as $Order)
							{
								$today = engine::today();
								$mode = $Order['lesson_mode'];

								$buy = engine::thaidate($Order['order_adddate']);
								$expire = engine::thaidate($Order['order_expire']);

								$expires = engine::daydiff($today, $Order['order_expire'], "format");

								$price = engine::baht($Order['order_price']);

								if($Order['order_status']!="3")
								{
									echo
									"<li class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>

									   <article class='card fl-left' data-bg-text='{$Order['order_code']}'>

										  <section class='price'>
											<div class='corner-ribbon left color-{$Order['lesson_mode_key']}'>{$Order['lesson_mode_name']}</div>
											<time datetime='23th feb'>
											  <span>{$price}</span><span>บาท</span>
											</time>
										  </section>
										  <section class='card-cont'>
											<small><i class='fa fa-circle {$Order['status_class']}'></i> {$Order['status_name']}</small>
											<h3>#{$Order['order_code']}</h3>
											<div class='even-date'>
											 <i class='fa fa-calendar'></i>
											 <time>
											   <span{$Order['lesson_adddate']}</span>
											   <span>สั่งซื้อเมื่อ  {$buy}</span>
											 </time>
											</div>
											<div class='even-info'>
											  <i class='fa fa-clock-o'></i>
											  <p>หมดอายุ {$expire} <small>({$expires})</small></p>
											</div>
											<a href='course/order/{$Order['order_code']}' target='_blank'> <i class='fa fa-money' aria-hidden='true'></i> แจ้งโอน</a>
										  </section>
										</article>

									</li>";
								}

							}

						?>

					</ul>
				</div>



            </div>
        </div>

	</section>

</div>
<!-- END / PAGE WRAP -->
