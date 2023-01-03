<!-- PAGE WRAP -->
<div id="page-wrap">
	<?php $profile = engine::student("profile");?>
    <div class="top-nav">
		
        <h4 class="sm black">
			<img src="https://content.me-rean.com/img.php?file=<?php echo $_SESSION["School"]['logo'];?>" alt="Image" class="img-logo-course">
			<span class="bold"><?php echo $_SESSION["School"]['name'];?></span>
		</h4>

        <ul class="top-nav-list">
            <li class="prev-course"><a href="javascript:void(0);"><i class="icon md-angle-left"></i><span class="tooltip">ก่อนหน้า</span></a></li>
            <li class="next-course"><a href="javascript:void(0);"><i class="icon md-angle-right"></i><span class="tooltip">ถัดไป</span></a></li>
            <li class="outline-learn">
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


    <section id="machine-section" class="learning-section learn-section">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail">
				
					<h4 class="sm black">
						<span class="bold">รายชื่อเครื่อง</span> <small>ที่พร้อมใช้งาน</small>
					</h4>
						
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
					
					<ul class="list-unstyled video-list-thumbs row">
					
						<?php
							
							foreach ($data["Private"]['machine'] as $Machine)
							{
								if($Machine['machine_status'] != "1")
								{
									$active = "disabled";
									$icon = "success";
								}
								else
								{
									$active = "";
									$icon = "danger";
								}
								
								echo  "
								<li class='col-md-6 col-sm-6'>
								
								   <article class='card fl-left {$active}' data-bg-text='{$Machine['machine_name']}' id='machine-{$Machine['machine_id']}' data-status='{$Machine['machine_status']}'>
										
									  <section class='date'>
										<div class='corner-ribbon left color-{$Machine['lesson_mode_key']} machine-status-{$Machine['machine_id']}'>{$Machine['machine_status']}</div>
										<time datetime='23th feb'>
										  <span>{$Machine['count_course']}</span><span>บทเรียน</span>
										</time>
									  </section>
									  <section class='card-cont'>
										<small><i class='fa fa-circle text-{$icon}'></i> {$Machine['machine_name']}</small>
										<h3>{$Machine['lesson_name']}</h3>
										<div class='even-date'>
										 <i class='fa fa-calendar'></i>
										 <time>
										   <span{$Machine['lesson_adddate']}</span>
										   <span>เรียนได้ {$Machine['lesson_hour']} ชม. {$Machine['lesson_days']} วัน</span>
										 </time>
										</div>
										<div class='even-info'>
										  <i class='fa fa-clock-o'></i>
										  <p>หมดอายุ {$expire} <small>({$expires})</small></p>
										</div>
										<a href='javascript:void(0);' onclick='activeMachine(\"{$Machine['machine_id']}\");'> <i class='fa fa-youtube-play' aria-hidden='true'></i> Online</a>
									  </section>
									</article>
	
								</li>";
							}
						
						?>
						
					</ul>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="lock-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-lock text-danger" aria-hidden="true"></i></br>
						<span class="bold">This computer has been locked</span></br><small>เครื่องนี้ยังไม่พร้อมให้บริการ กรุณาติดต่อเจ้าหน้าที่ค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="contest-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-pencil text-primary" aria-hidden="true"></i></br>
						<span class="bold">ทำแบบทดสอบ</span></br><small>ทำแบบทดสอบเพื่อวัดผลก่อนการเรียนค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="learn-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-youtube-play text-success" aria-hidden="true"></i></br>
						<span class="bold">เข้าสู่บทเรียน</span></br><small>เข้าสู่บทเรียนที่ลงทะเบียนไว้ค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="doc-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-book text-info" aria-hidden="true"></i></br>
						<span class="bold">ทบทวนหนังสือ</span></br><small>อ่านเอกสารทบทวนบทเรียนก่อนเริ่มเรียนค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="demo-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-play-circle text-info" aria-hidden="true"></i></br>
						<span class="bold">ทดลองเรียน</span></br><small>เข้าสู่เนื้อหาสำหรับทดลองเรียนค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>
	
	<section id="wait-section" class="learning-section learn-section hide">
	
        <div class="container">
            <div class="abc">
			
				<div class="course-thumbnail text-center locked">
				
					<h4 class="sm black">
						<i class="fa fa-clock-o text-info" aria-hidden="true"></i></br>
						<span class="bold">กรุณารอทีมงาน</span></br><small>กรุณารอทีมงานเตรียมข้อมูลสักครู่ค่ะ</small>
					</h4>
					<?php //echo "<pre>" . print_r($_SESSION["Machine"]) . "</pre>";?>
				</div>
				
            </div>
        </div>
		
	</section>

</div>
<!-- END / PAGE WRAP -->

<script>
<?php

foreach ($data["Private"]['machine'] as $Machine)
{
	echo  "setInterval(\"checkStatusMachine('{$Machine['machine_id']}')\", 5000 );";
	//echo  "setInterval(\"actionMachine('{$Machine['machine_id']}')\", 10000 );";
}

?>
</script>
