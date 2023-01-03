<!-- PAGE WRAP -->
<div id="page-wrap">

    <div class="top-nav">

        <h4 class="sm black">
			<img src="<?php echo $GLOBALS["School"]['cdn'];?>img.php?file=<?php echo $_SESSION["School"]['logo'];?>&wt=false" alt="Image" class="img-logo-course">
			<span class="bold">ชื่อคอร์ส : </span><?php echo $data["Lesson"]['lesson_name'];?>

			<input type="hidden" id="topiccode" value="<?php echo $data["FirstTopic"]['playercode'];?>">
			<input type="hidden" id="topiclastplay" value="<?php echo $data["FirstTopic"]['playerresume'];?>">

		</h4>

        <ul class="top-nav-list">
			<li class="prev-course">
				<div class="timer">
					<span class="clock"><img src="theme/demo/assets/core/player/images/clock.gif"></span>
					<span class="number"><?php echo engine::permission("timer");?></span>
				</div>
			</li>
            <li class="prev-course"><a href="javascript:void(0);"><i class="icon md-angle-left"></i><span class="tooltip">ก่อนหน้า</span></a></li>
            <li class="next-course"><a href="javascript:void(0);"><i class="icon md-angle-right"></i><span class="tooltip">ถัดไป</span></a></li>
            <li class="outline-learn">
                <a href="#"><i class="icon md-list"></i></a>
                <div class="list-item-body outline-learn-body">

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> บทเรียนทั้งหมด</h5>

						<div class="treeview-search">
							<input type="text" class="form-control" id="plugins4_q" name="plugins4_q" placeholder="ค้นหาบทเรียน">

							<div class="treeview-tool">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-default" onclick="$('#coursetree').jstree('close_all');"><i class="fa fa-minus-square" aria-hidden="true"></i> ย่อรายการ</button>
									<button type="button" class="btn btn-sm btn-default" onclick="$('#coursetree').jstree('open_all');"><i class="fa fa-plus-square" aria-hidden="true"></i> ขยายรายการ</button>
								</div>
							</div>

						</div>

						<div id="coursetree">
						<?php echo engine::createCourseTreeview($data["Lesson"]['lesson_id'],"lesson");?>
						</div>

						<div id="event_result" style="margin-top:10px; margin-bottom:10px; text-align:center;"><strong>คุณเลือก : </strong><?php echo $data["FirstTopic"]['topic_name'];?></div>

                    </div>

                    <div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-check-square-o" aria-hidden="true"></i> แบบทดสอบทั้งหมด</h5>
						<div class="sidebar-content-area">

							<table class="table table-condensed">
								<tbody>

								<?php

								$order_contest = "0";

								foreach ($data["Contest"] as $Contest)
								{
									$order_contest++;
									echo
									"<tr>
										<td width='60%'>
											<div class='overflow-tip'>
												<span>
													<a href='{$GLOBALS["School"]['cdn']}doc.php?file={$Contest['contest_name']}'>
														{$order_contest}.{$Contest['contest_name']}
													</a>
												</span>
											</div>
										</td>
										<td width='20%'><strong>{$Contest['contest_choice']}</strong> ข้อ</td>
										<td width='20%'><i class='fa fa-clock'></i> <strong>{$Contest['contest_time']}</strong> นาที</td>
									</tr>";
								}

								?>

							</tbody>
						</table>
					</div>
                    </div>

					<div class="section-learn-outline">
                        <h5 class="section-title"><i class="fa fa-download" aria-hidden="true"></i> เอกสารประกอบการเรียน</h5>

						<div class="sidebar-content-area">
							<table class="table table-condensed">
								<tbody>

								<?php
								$order_doc = "0";
								foreach ($data["Document"] as $Document)
								{
									$order_doc++;
									$type = $Document['document_type'];
									switch ($type)
									{
										case "PDF":
											$type = "<i class='fa fa-file-pdf-o' aria-hidden='true'></i> PDF";
										break;

										case "DOCX":
											$type = "<i class='fa fa-file-word-o' aria-hidden='true'></i> DOCX";
										break;

										case "DOC":
											$type = "<i class='fa fa-file-word-o' aria-hidden='true'></i> DOC";
										break;

										case "JPG":
											$type = "<i class='fa fa-file-photo-o' aria-hidden='true'></i> JPG";
										break;
									}

									echo
									"<tr>
										<td width='40%'>
											<div class='overflow-tip'>
												<span>
													<a href='{$GLOBALS["School"]['cdn']}doc.php?file={$Document['document_link']}'>
														{$order_doc}.{$Document['document_name']}
													</a>
												</span>
											</div>
										</td>
										<td width='20%'><span class='label label-danger'>{$type}</span></td>
										<td width='20%'><i class='fa fa-clock'></i> {$Document['document_size']}</td>
										<td width='10%'><a href='{$GLOBALS["School"]['cdn']}doc.php?file={$Document['document_link']}'><i class='fa fa-download' aria-hidden='true'></i></a></td>
									</tr>";
								}
								?>

								</tbody>
							</table>
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
                                           <a href="#">5 days ago</a>
                                           <a href="#"><i class="icon md-arrow-up"></i>13</a>
                                           <a href="#"><i class="icon md-arrow-down"></i>25</a>
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
                <a href="player/play/<?php echo $data["Lesson"]['lesson_code'];?>"><i class="icon md-close-1"></i></a>
            </li>
        </ul>

    </div>

	<section id="" class="quizz-intro-section learn-section">
        <div class="container">

            <div class="title-ct">
                <h3><strong>แบบทดสอบ : </strong><?php echo $data["ContestRow"]['contest_name'];?></h3>
                <div class="tt-right">
                    <a href="player/play/<?php echo $data["Lesson"]['lesson_code'];?>" class="skip"><i class="icon md-arrow-right"></i>ข้ามแบบทดสอบนี้</a>
                </div>
            </div>

            <div class="question-content-wrap">

                <div class="row">

				<div class="col-md-8">
					<div class="question-content">
						<h4 class="sm">Question 1 - <?php echo $data["ContestRow"]['type_name'];?></h4>

						<div class="row">
							<div class="col-md-12">
								<div class="question"></div>
							</div>
						</div>

						<div class="answer">
							<h4 class="sm">คำตอบ</h4>
							<ul class="answer-list row"></ul>
						</div>

						<div id="back" class="mc-btn btn-style-1 hidden">ข้อก่อนหน้า</div>
						<div id="submit" class="mc-btn btn-style-1">ข้อถัดไป</div>

						<div id="message-area" class="hidden">
							<div class="alert alert-danger" role="alert"> <strong>ผิดพลาด !</strong> กรุณาเลือกคำตอบก่อนค่ะ. </div>
						</div>

					</div>
				</div>

                    <div class="col-md-4">
                        <aside class="question-sidebar">
                            <div class="score-sb">

								<input type="hidden" name="contest-score" id="contest-score" value="">
								<input type="hidden" name="contest-timer" id="contest-timer" value="">
								<input type="hidden" name="contest-lesson" id="contest-lesson" value="<?php echo $data["Lesson"]['lesson_id'];?>">
								<input type="hidden" name="contest-code" id="contest-code" value="<?php echo $data["ContestRow"]['contest_id'];?>">

                                <h4 class="title-sb sm">เวลาในการทำแบบทดสอบ<span>
								<div id="quiz-timer" class="number"></div></span></h4>

                                <ul>
                                    <li>จำนวนข้อสอบ<span><strong><?php echo $data["ContestRow"]['contest_choice'];?></strong> ข้อ</span></li>
                                    <li>เวลาในการทำ<span><strong><?php echo $data["ContestRow"]['contest_time'];?></strong> นาที</span></li>
									<li>ประเภท <span><strong><?php echo $data["ContestRow"]['type_name'];?></strong></span></li>
                                </ul>

                            </div>
							<button class="submit mc-btn btn-style-1"onclick="submitscore();">ส่งคำตอบ</button>
                        </aside>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
<!-- END / PAGE WRAP -->

<script>
	<?php engine::createQuiz($data["ContestRow"]['contest_code']);?>
</script>
