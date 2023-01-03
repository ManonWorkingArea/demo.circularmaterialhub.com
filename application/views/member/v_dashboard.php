<?php
//echo "UToken:" . print_r($_SESSION["Student"]);
//echo "<pre>";
$position = engine::user("profile","position");
if(empty($data["App"]['relate']))
{
  $assignment = false;
}
else
{
  $assignment = true;
}

//print_r($position);
//echo "</pre>";

// echo "<pre>";
// print_r($data["App"]['dashboard']);
// echo "</pre>";
?>
<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title"><?php echo $data["title"];?></h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="home">หน้าหลัก</a></li>
                        <li class="active__list-item">สมาชิก</li>
                        <li>บริการสมาชิก</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<div class="quiz-action-nav bg-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="quiz-action-content d-flex align-items-center justify-content-between">
                    <ul class="quiz-nav d-flex align-items-center">
                      <li><a href="member" class="active"><i class="fa fa-desktop"></i> เมนูสมาชิก</a></li>
                      <li><a href="member/profile"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a></li>
                      <li><a href="member/message"><i class="fa fa-envelope"></i> ข้อความ</a></li>

                      <?php if($position=="consultant" && $assignment): ?>
                      <li><a href="member/assignment"><i class="fa fa-industry"></i> รายชื่อโรงงาน</a></li>
                      <?php elseif($position=="auditor" && $assignment): ?>
                      <li><a href="member/assignment"><i class="fa fa-industry"></i> รายชื่อโรงงาน</a></li>
                      <?php else: ?>

                      <?php endif; ?>

                      <li><a href="javascript:void(0);" onclick="signout();"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div>
<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">

        <div class="container">
            <div class="course-content-wrapper mt-4">
                <div class="row">
                    <div class="col-lg-12">

                        <?php if($position=="consultant" && $assignment): ?>

                          <div class="tab-content">
                            <h3 class="title liner"><i class="mdi mdi-certificate"></i> โรงงานที่ Assign การปรึกษา</h3>
                              <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="contact-form-action">
                                    <table class="table">
                                        <tbody>
                                          <tr>
                                              <td>#</td>
                                              <th>ข้อมูลแบบฟอร์ม</th>
                                              <th>รหัสใบสมัคร</th>
                                              <th>วันที่สมัคร</th>
                                              <th>สถานะ</th>
                                              <th>#</th>
                                          </tr>
                                          <?php
                                          
                                            $order = 0;
                                            foreach ($data["App"]['relate'] as $Relate)
                                            {
                                              $order++;
                                              $first_formset         = $Relate["first"];
                                              $check_document        = $Relate["check_document"];
                                              $check_form            = $Relate["check_form"];
                                              $document_percent      = $Relate["document_percent"];
                                              $form_percent          = $Relate["form_percent"];
                                              $application_percent   = $Relate["application_percent"];
                                              $fillCheck             = $Relate["form_api"];
                                              //print_r($Relate["applicationLink"]);
                                              $date = engine::thaidate($Relate["application"]['ap_adddate']);
                                              echo
                                              "<tr>
                                                  <td>{$order}</td>
                                                  <td>{$Relate['app_name']}</br><span class='text-muted font-16'><i class='mdi mdi-account-box'></i> {$Relate['mem_firstname']} {$Relate['mem_lastname']}</span></td>
                                                  <td>{$Relate["application"]['ap_code']}</td>
                                                  <td>{$date}</td>
                                                  <td><span class='badge badge-{$Relate["application"]['status_style']}'><i class='fa fa-{$Relate["application"]['status_icon']}'></i> {$Relate["application"]['status_name']}</span></td>
                                                  <td>
                                                    <button class='btn btn-primary btn-sm' aria-label='ตรวจสอบข้อมูล' data-microtip-position='top' role='tooltip' onclick='page(\"app/view/{$Relate["application"]['ap_token']}\");'><i class='far fa-eye'></i> ตรวจสอบ</button>
                                                    <button class='btn btn-danger btn-sm' aria-label='ยกเลิกการทำงาน' data-microtip-position='top' role='tooltip' onclick='deleteMultiple();'><i class='far fa-trash-alt'></i></button>
                                                  </td>
                                              </tr>";
                                            }
                                          ?>
                                        </tbody>
                                    </table>
                                  </div>

                                    <!-- <div class="row application-card">

                                      <?php

                                      foreach ($data["App"]['relate'] as $Relate)
                                      {

                                        $first_formset         = $Relate["first"];
                                        $check_document        = $Relate["check_document"];
                                        $check_form            = $Relate["check_form"];
                                        $document_percent      = $Relate["document_percent"];
                                        $form_percent          = $Relate["form_percent"];
                                        $application_percent   = $Relate["application_percent"];
                                        $fillCheck             = $Relate["form_api"];

                                        echo
                                        "<div class='col-md-6'>
                                        <div class='card'>

                                            <div class='card-header'>
                                              <div class='float-left'>
                                                <h3 class='card-title'>{$Relate['app_name']} </br><span class='text-muted font-16'><i class='mdi mdi-account-box'></i> {$Relate['mem_firstname']} {$Relate['mem_lastname']}</span></h3>
                                              </div>
                                              <div class='float-right'>
                                                <i class='mdi mdi-folder-settings-outline card-icon'></i>
                                              </div>
                                            </div>
                                            <div class='card-body'>

                                              <div class='float-right'>
                                                  <span class='badge badge-{$Relate["application"]['status_style']}'><i class='fa fa-{$Relate["application"]['status_icon']}'></i> {$Relate["application"]['status_name']}</span>
                                              </div>

                                              <span class='text-muted font-16'>{$Relate["application"]['ap_code']}</span>

                                              <div class='application-document-status'>
                                                <span>{$check_document['list']}</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>สถานะเอกสาร</small></br><strong>{$check_document['message']}</strong></span>
                                              </div>

                                              <div class='application-form-status'>
                                                <span class='form-percent font-30 text-muted'><i class='mdi mdi-square-edit-outline font-30 text-dark'></i> {$fillCheck['fillPercent']}%</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>แบบฟอร์ม</small></br><strong>{$fillCheck['fillMessage']}</strong></span>
                                              </div>

                                              <p class='mb-2 text-muted text-truncate'>{$Relate['app_desc']}</p>

                                            </div>
                                            <div class='card-footer'>
                                              <div class='d-flex' role='group'>
                                                <button class='theme-btn btn-block' onclick='page(\"app/assumption_audit/{$Relate['applicationLink']['ap_token']}/{$Relate['applicationLink']['first']}/{$Relate['applicationLink']['owner']['mem_token']}/audit\");'><i class='mdi mdi-square-edit-outline'></i> ตรวจสอบแบบประเมิน</button>
                                              </div>
                                            </div>
                                        </div>
                                      </div>";

                                      }
                                    ?>

                                    </div> -->
                              </div>
                          </div>


                        <?php elseif($position=="auditor" && $assignment): ?>

                          <div class="tab-content">
                            <h3 class="title liner"><i class="mdi mdi-certificate"></i> โรงงานที่ Assign การตรวจประเมิน</h3>
                              <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">

                                <div class="contact-form-action">
                                  <table class="table">
                                      <tbody>
                                        <tr>
                                            <td>#</td>
                                            <th>ข้อมูลแบบฟอร์ม</th>
                                            <th>รหัสใบสมัคร</th>
                                            <th>วันที่สมัคร</th>
                                            <th>สถานะ</th>
                                            <th>#</th>
                                        </tr>
                                        <?php
                                        
                                          $order = 0;
                                          foreach ($data["App"]['relate'] as $Relate)
                                          {
                                            $order++;
                                            $first_formset         = $Relate["first"];
                                            $check_document        = $Relate["check_document"];
                                            $check_form            = $Relate["check_form"];
                                            $document_percent      = $Relate["document_percent"];
                                            $form_percent          = $Relate["form_percent"];
                                            $application_percent   = $Relate["application_percent"];
                                            $fillCheck             = $Relate["form_api"];
                                            //print_r($Relate["applicationLink"]);
                                            $date = engine::thaidate($Relate["application"]['ap_adddate']);
                                            echo
                                            "<tr>
                                                <td>{$order}</td>
                                                <td>{$Relate['app_name']}</br><span class='text-muted font-16'><i class='mdi mdi-account-box'></i> {$Relate['mem_firstname']} {$Relate['mem_lastname']}</span></td>
                                                <td>{$Relate["application"]['ap_code']}</td>
                                                <td>{$date}</td>
                                                <td><span class='badge badge-{$Relate["application"]['status_style']}'><i class='fa fa-{$Relate["application"]['status_icon']}'></i> {$Relate["application"]['status_name']}</span></td>
                                                <td>
                                                <button class='btn btn-primary btn-sm' aria-label='ตรวจสอบข้อมูล' data-microtip-position='top' role='tooltip' onclick='page(\"app/view/{$Relate["application"]['ap_token']}\");'><i class='far fa-eye'></i> ตรวจสอบ</button>
                                                <button class='btn btn-danger btn-sm' aria-label='ยกเลิกการทำงาน' data-microtip-position='top' role='tooltip' onclick='deleteMultiple();'><i class='far fa-trash-alt'></i></button>
                                                </td>
                                            </tr>";
                                          }
                                        ?>
                                      </tbody>
                                  </table>
                                </div>

                                  <!-- <div class="row application-card">
                                      <?php
                                      foreach ($data["App"]['relate'] as $Relate)
                                      {

                                        $first_formset         = $Relate["first"];
                                        $check_document        = $Relate["check_document"];
                                        $check_form            = $Relate["check_form"];
                                        $document_percent      = $Relate["document_percent"];
                                        $form_percent          = $Relate["form_percent"];
                                        $application_percent   = $Relate["application_percent"];
                                        $fillCheck             = $Relate["form_api"];

                                        //print_r($Relate["applicationLink"]);

                                        echo
                                        "<div class='col-md-6'>
                                          <div class='card'>

                                              <div class='card-header'>
                                                <div class='float-left'>
                                                  <h3 class='card-title'>{$Relate['app_name']} </br><span class='text-muted font-16'><i class='mdi mdi-account-box'></i> {$Relate['mem_firstname']} {$Relate['mem_lastname']}</span></h3>
                                                </div>
                                                <div class='float-right'>
                                                  <i class='mdi mdi-folder-settings-outline card-icon'></i>
                                                </div>
                                              </div>
                                              <div class='card-body'>

                                                <div class='float-right'>
                                                    <span class='badge badge-{$Relate["application"]['status_style']}'><i class='fa fa-{$Relate["application"]['status_icon']}'></i> {$Relate["application"]['status_name']}</span>
                                                </div>

                                                <span class='text-muted font-16'>{$Relate["application"]['ap_code']}</span>

                                                <div class='application-document-status'>
                                                  <span>{$check_document['list']}</span>
                                                  <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>สถานะเอกสาร</small></br><strong>{$check_document['message']}</strong></span>
                                                </div>

                                                <div class='application-form-status'>
                                                  <span class='form-percent font-30 text-muted'><i class='mdi mdi-square-edit-outline font-30 text-dark'></i> {$fillCheck['fillPercent']}%</span>
                                                  <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>แบบฟอร์ม</small></br><strong>{$fillCheck['fillMessage']}</strong></span>
                                                </div>

                                                <p class='mb-2 text-muted text-truncate'>{$Relate['app_desc']}</p>

                                              </div>
                                              <div class='card-footer'>
                                                <div class='d-flex' role='group'>
                                                  <button class='theme-btn btn-block' onclick='page(\"app/assumption_audit/{$Relate['applicationLink']['ap_token']}/{$Relate['applicationLink']['first']}/{$Relate['applicationLink']['owner']['mem_token']}/audit\");'><i class='mdi mdi-square-edit-outline'></i> ตรวจสอบแบบประเมิน</button>
                                                </div>
                                              </div>
                                          </div>
                                        </div>";

                                      }
                                    ?>

                                    </div> -->
                              </div>
                          </div>

                        <?php else: ?>

                        <?php endif; ?>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="row application-card">

                                  </div>

                                  <?php

                                  foreach ($data["App"]['dashboard'] as $FrontEnd)
                                  {
                                    if (empty($FrontEnd["application"]['detail'])) // No Application
                                    {
                                      if($FrontEnd['app_visible']=="1")
                                      {
                                        $notRegis .=
                                        "<div class='col-md-6'>
                                          <div class='card'>
                                              <div class='card-body'>
                                                <div class='float-right'>
                                                    <i class='fa fa-pencil font-24 text-secondary'></i>
                                                </div>
                                                <span class='badge badge-danger'>ใบสมัคร</span>
                                                <h3 class='card-title mt-2'>{$FrontEnd['app_name']}</h3>
                                                <p class='mb-4 text-muted text-truncate'>{$FrontEnd['app_desc']}</p>
                                                <button class='btn btn-warning btn-block' onclick='page(\"app/create/{$FrontEnd['app_token']}\");'><i class='mdi mdi-note-plus-outline'></i> สมัครตอนนี้</button>
                                              </div>
                                          </div>
                                        </div>
                                        ";
                                      }

                                    }
                                    else // Have Application
                                    {
                                      /*
                                      $form_app             = $FrontEnd["application"]['ap_form'];
                                      $form_id              = $FrontEnd["application"]['app_id'];
                                      $member_id            = $FrontEnd["application"]['member_id'];

                                      $check_document       = tracking::document($FrontEnd["application"]['ap_token']);
                                      $check_form           = tracking::form('count', $form_id, $form_app, $member_id);

                                      $document_percent     = $check_document['percent'];
                                      $form_percent         = $check_form['percent'];

                                      $application_percent  = ($document_percent+$form_percent)/2;

                                      */

                                      $first_formset         = $FrontEnd["first"];
                                      $check_document        = $FrontEnd["check_document"];
                                      $check_form            = $FrontEnd["check_form"];
                                      $document_percent      = $FrontEnd["document_percent"];
                                      $form_percent          = $FrontEnd["form_percent"];
                                      $application_percent   = $FrontEnd["application_percent"];
                                      $fillCheck             = $FrontEnd["formResult"];

                                      if($FrontEnd['app_type']=="form")
                                      {
                                        $btn = "
                                        <div class='card-footer'>
                                          <div class='d-flex' role='group'>
                                            <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}/member\");'><i class='mdi mdi-square-edit-outline'></i> ทำแบบประเมิน</button>
                                            <button class='theme-btn mr-2' onclick='page(\"app/assumption/result\");'><i class='mdi mdi-square-edit-outline'></i> ผลลัพธ์</button>
                                          </div>
                                        </div>";
                                      }
                                      else
                                      {

                                        if($FrontEnd['linkage']['app_id']!="" || $FrontEnd['linkage']['app_id']!=NULL)
                                        {
                                          $btn = "
                                          <div class='card-footer'>
                                            <div class='d-flex' role='group'>
                                              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}\");'><i class='mdi mdi-square-edit-outline'></i> กรอกใบสมัคร</button>
                                              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["linkage_app"]['detail']['ap_token']}/{$FrontEnd['linkage_first']}\");'><i class='mdi mdi-square-edit-outline'></i> ประเมิน</button>
                                              <button class='btn btn-default mr-2' onclick='page(\"app/upload/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-file-upload-outline'></i> อัพโหลดเอกสาร</button>
                                              <button class='btn btn-default mr-2' onclick='page(\"app/detail/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-content-paste'></i> รายละเอียด</button>
                                              <!--button class='btn btn-dark mr-2' onclick='removeApp(\"{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-delete'></i> ยกเลิก</button>-->
                                            </div>
                                          </div>";
                                        }
                                        else
                                        {
                                          $btn = "
                                          <div class='card-footer'>
                                            <div class='d-flex' role='group'>
                                              <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['detail']['ap_token']}/{$first_formset}\");'><i class='mdi mdi-square-edit-outline'></i> กรอกใบสมัคร</button>
                                              <button class='btn btn-default mr-2' onclick='page(\"app/upload/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-file-upload-outline'></i> อัพโหลดเอกสาร</button>
                                              <button class='btn btn-default mr-2' onclick='page(\"app/detail/{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-content-paste'></i> รายละเอียด</button>
                                              <!--button class='btn btn-dark mr-2' onclick='removeApp(\"{$FrontEnd["application"]['detail']['ap_token']}\");'><i class='mdi mdi-delete'></i> ยกเลิก</button>-->
                                            </div>
                                          </div>";
                                        }
                                        
                                      }

                                      if(count($FrontEnd["application"]['message']) == 0)
                                      {
                                        $message_count = "0";
                                        $message_alert = "";
                                      }
                                      else
                                      {
                                        if($FrontEnd["application"]['messageCount']>0)
                                        {
                                          $message_count = count($FrontEnd["application"]['message']);
                                          $message_alert = "
                                          <span class='message-btn' onclick='page(\"app/message/{$FrontEnd["application"]['detail']['ap_token']}\");'>
                                          <span class='message-label'>{$FrontEnd["application"]['messageCount']}</span>
                                          <span class='message-icon'><i class='mdi mdi-email'></i></span>
                                          </span>
                                          ";
                                        }
                                        else
                                        {
                                          $message_alert = "";
                                          $message_count = "0";
                                        }
                                      }

                                      $doRegis .=
                                      "<div class='col-md-6'>
                                        <div class='card'>

                                            <div class='card-header'>
                                              <div class='float-left'>
                                                <h3 class='card-title'>{$FrontEnd['app_name']}</h3>
                                              </div>
                                              <div class='float-right'>
                                                <i class='mdi mdi-folder-settings-outline card-icon'></i>
                                                {$message_alert}
                                              </div>
                                            </div>
                                            <div class='card-body'>

                                              <div class='float-right'>
                                                  <span class='badge badge-{$FrontEnd["application"]['detail']['status_style']}'><i class='fa fa-{$FrontEnd["application"]['detail']['status_icon']}'></i> {$FrontEnd["application"]['detail']['status_name']}</span>
                                              </div>

                                              <span class='text-muted font-16'>{$FrontEnd["application"]['detail']['ap_code']}</span>

                                              <div class='application-document-status'>
                                                <span>{$check_document['list']}</span>
                                                <span class='form-percent font-30 text-muted'>{$check_document['percent']}%</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>สถานะเอกสาร</small></br><strong>{$check_document['message']}</strong></span>
                                              </div>

                                              <div class='application-form-status'>
                                                <span class='form-percent font-30 text-muted'><i class='mdi mdi-square-edit-outline font-30 text-dark'></i> {$check_form['overview']['percent']}%</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>แบบฟอร์ม</small></br><strong>{$check_form['overview']['message']}</strong></span>
                                              </div>

                                              <p class='mb-2 text-muted text-truncate'>{$FrontEnd['app_desc']}</p>

                                            </div>

                                            {$btn}

                                        </div>
                                      </div>
                                      ";
                                    }
                                  }
                                  echo "<h3 class='title liner'><i class='mdi mdi-square-edit-outline'></i> ใบสมัครของคุณ</h3>";
                                  echo "<div class='row application-card'>" . $doRegis . "</div>";
                                  echo "<h3 class='title liner'><i class='mdi mdi-square-edit-outline'></i> ใบสมัครที่ยังไม่ได้ลงทะเบียน</h3>";
                                  echo "<div class='row application-card'>" . $notRegis . "</div>";
                                  ?>

                            </div>
                        </div>

                        <div class="tab-content">
                            <h3 class="title liner"><i class="fa fa-play-circle"></i> หลักสูตรออนไลน์</h3>
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="row application-card">
                                  <?php

                                  foreach ($data["Course"]['lesson'] as $Lesson)
                                  {
                                    $detail 	= engine::shorttext($Lesson['post_detail'], 100);
                                    $date 	  = engine::thaidate($Lesson['post_adddate']);

                                    if($Lesson['lesson_sale_price']=="0")
                                    {
                                      $price = "เรียนฟรี";
                                    }
                                    else
                                    {
                                      $price = $Lesson['lesson_sale_price'];
                                    }

                                    if($Lesson['lesson_counter']==""||$Lesson['lesson_counter']==NULL)
                                    {
                                      $visitor = "0";
                                    }
                                    else
                                    {
                                      $visitor = $Lesson['lesson_counter'];
                                    }

                                    echo
                                    "<div class='col-md-6'>
                                      <div class='card'>
                                          <div class='card-image'>
                                              <a href='course/detail/{$Lesson['lesson_code']}' class='card__img'><img src='https://{$Lesson['school_s3_url']}/{$Lesson['school_s3_bucket']}/{$Lesson['lesson_cover']}' alt=''></a>
                                              <div class='card-badge'>
                                                  <span class='badge-label'>Eco Factory</span>
                                              </div>
                                          </div>

                                          <div class='card-body'>
                                            <div class='float-right'>
                                                <i class='fa fa-play-circle font-24 text-secondary'></i>
                                            </div>
                                            <span class='badge badge-success'>E-Learning</span>
                                            <h3 class='card-title mt-2'>{$Lesson['lesson_name']}</h3>
                                            <hr>
                                            <div class='mb-2 text-muted text-truncate'>
                                            <p class='float-left'><i class='la la-play-circle'></i> {$Lesson['count']} บทเรียน</p>
                                            <p class='float-right'><i class='la la-clock-o'></i> {$Lesson['duration']}</p>
                                            </div>

                                            <button class='btn btn-warning btn-lg btn-block' onclick='page(\"course/detail/{$Lesson['lesson_code']}\");'><i class='mdi mdi-note-plus-outline'></i> ลงทะเบียน</button>
                                          </div>
                                      </div>
                                    </div>";
                                  }

                                  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================================
        END COURSE AREA
======================================-->
