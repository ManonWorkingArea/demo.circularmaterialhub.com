<!-- PAGE WRAP -->
<div id="page-wrap">

    <div class="top-nav">

        <h4 class="sm black">
			<img src="<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $_SESSION["School"]['logo'];?>&wt=false" alt="Image" class="img-logo-course">
			<span class="bold"><?php echo $_SESSION["School"]['name'];?></span>
		</h4>

        <ul class="top-nav-list">
            <li class="prev-course"><a href="javascript:void(0);"><i class="icon md-angle-left"></i><span class="tooltip">ก่อนหน้า</span></a></li>
            <li class="next-course"><a href="javascript:void(0);"><i class="icon md-angle-right"></i><span class="tooltip">ถัดไป</span></a></li>
            <li class="outline-learn active">
                <a href="javascript:void(0);"><i class="icon md-list"></i></a>

                <div class="list-item-body outline-learn-body">

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> รายละเอียดคำสั่งซื้อ</h5>
						<div class="sidebar-content-area">

							<div class="timer-display">
								<span class="title"><i class="fa fa-clock-o"></i> เวลาคงเหลือ</span>
								<span class="timercount"><?php echo engine::permission("timer");?></span>
								<span class="title"><i class="fa fa-calendar"></i> วันคงเหลือ</span>
								<span class="datecount"><?php echo engine::permission("days");?>วัน <small>(<?php echo engine::permission("expire");?>)</small></span>
							</div>

							<table class="table table-condensed">
								<tbody>

									<tr>
										<td width="10%"><span class="label label-danger"><i class="fa fa-clock-o" aria-hidden="true"></i></span></td>
										<td width="40%"><span>ราคา</span></td>
										<td width="20%"><strong><?php  echo engine::baht($data["Lesson"]['invoice']['order_price']);?></strong> บาท</td>
									</tr>
									<tr>
										<td width="10%"><span class="label label-primary"><i class="fa fa-clock-o" aria-hidden="true"></i></span></td>
										<td width="40%"><span>วันที่สั่งซื้อ</span></td>
										<td width="20%"><strong><?php echo engine::thaidate($data["Lesson"]['invoice']['order_adddate']);?></strong></td>
									</tr>
									<tr>
										<td width="10%"><span class="label label-primary"><i class="fa fa-power-off" aria-hidden="true"></i></span></td>
										<td width="40%"><span>สถานะ</span></td>
										<td width="40%"><?php echo $data["Lesson"]['invoice']['status_label'];?></td>
									</tr>

								</tbody>
							</table>
							</br>
							<div class="text-center">
							<button class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> สั่งซื้อคอร์สใหม่ </button>
							</div>
						</div>
                    </div>

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-calculator" aria-hidden="true"></i> ใบเสร็จรับเงิน</h5>
						<div class="sidebar-content-area">

							<table class="table table-condensed">
								<tbody>

									<tr>
										<td width="40%">
											<div class="overflow-tip">
												<span><a href="course/invoice/<?php echo $data["Lesson"]['invoice']['order_code'];?>" target="_blank">1.ใบสั่งซื้อ <?php echo $data["Lesson"]['invoice']['order_code'];?></a></span>
											</div>
										</td>
										<td width="20%"><span class="label label-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</span></td>
										<td width="20%"><i class="fa fa-clock"></i> 1500 B</td>
										<td width="10%"><a href="course/invoice/<?php echo $data["Lesson"]['invoice']['order_code'];?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></td>
									</tr>

									<tr>
										<td width="40%">
											<div class="overflow-tip">
												<span><a href="course/receipt/<?php echo $data["Lesson"]['invoice']['order_code'];?>" target="_blank">2.ใบเสร็จ <?php echo $data["Lesson"]['invoice']['order_code'];?></a></span>
											</div>
										</td>
										<td width="20%"><span class="label label-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</span></td>
										<td width="20%"><i class="fa fa-clock"></i> 500 B</td>
										<td width="10%"><a href="course/receipt/<?php echo $data["Lesson"]['invoice']['order_code'];?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></td>
									</tr>

								</tbody>
							</table>

						</div>
                    </div>

					<div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-comment" aria-hidden="true"></i> ความเห็นจากผู้สั่งซื้อ</h5>
						<div class="sidebar-content-area">
							<?php echo $data["Lesson"]['invoice']['order_confirm_comment'];?>
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
                                <h5>3 หัวข้อ</h5>
                            </form>
                        </div>

                        <ul class="list-discussion">

                            <!-- LIST ITEM -->
                            <li>
                                <div class="list-body">
                                    <div class="list-content">
                                        <cite class="name-author"><a href="javascript:void(0);">Anna Molly</a></cite>
                                        <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                        <div class="comment-meta">
                                           <a href="javascript:void(0);">5 days ago</a>
                                           <a href="javascript:void(0);"><i class="icon md-arrow-up"></i>13</a>
                                           <a href="javascript:void(0);"><i class="icon md-arrow-down"></i>25</a>
                                           <a href=""><i class="icon md-back"></i>384 replies</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END / LIST ITEM -->

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
                <a href="player"><i class="icon fa fa-home homeicon"></i></a>
            </li>
        </ul>

    </div>


    <section id="learning-section" class="learning-section learn-section">

        <div class="container">
            <div class="abc">

				<div class="course-thumbnail">

					<ul class="list-unstyled video-list-thumbs row">

						<li class='col-lg-3 col-sm-4 col-xs-6'>
							<div class='ribbon'><i class='fa fa-youtube-play' aria-hidden='true'></i></div>
							<a href='player/play/<?php echo $data["Lesson"]['lesson_code']?>' title='(<?php echo $data["Lesson"]['lesson_code']?>') <?php echo $data["Lesson"]['lesson_name']?>''>
								<img src='<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $data["Lesson"]['lesson_cover']?>' alt='Barca' class='img-responsive' height='130px' />
								<h2><?php echo $data["Lesson"]['lesson_name']?></h2>
								<span>12 บทเรียนย่อย | 20 เนื้อหา</span>
								<i class='fa fa-play-circle-o' aria-hidden='true'></i>
								<span class='duration'><?php echo $data["Lesson"]['lesson_hour']?> ชั่วโมง</span>
								<span class='label'><?php echo $data["Lesson"]['lesson_type_name']?></span>
							</a>
						</li>
					</ul>
				</div>

            </div>
        </div>

	</section>

</div>
<!-- END / PAGE WRAP -->
