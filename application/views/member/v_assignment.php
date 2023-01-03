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
                      <li><a href="member"><i class="fa fa-desktop"></i> เมนูสมาชิก</a></li>
                      <li><a href="member/profile"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a></li>

                      <?php if($position=="consultant" && $assignment): ?>
                      <li><a href="member/assignment" class="active"><i class="fa fa-industry"></i> รายชื่อโรงงาน</a></li>
                      <?php elseif($position=="auditor" && $assignment): ?>
                      <li><a href="member/assignment" class="active"><i class="fa fa-industry"></i> รายชื่อโรงงาน</a></li>
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
                                                    <button class='btn btn-primary btn-sm' aria-label='แก้ไขข้อมูล - FRM' data-microtip-position='top' role='tooltip' onclick='editMultiple();'><i class='far fa-eye'></i> ตรวจสอบ</button>
                                                    <button class='btn btn-danger btn-sm' aria-label='ลบข้อมูล' data-microtip-position='top' role='tooltip' onclick='deleteMultiple();'><i class='far fa-trash-alt'></i></button>
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
                                                  <button class='btn btn-primary btn-sm' aria-label='แก้ไขข้อมูล - FRM' data-microtip-position='top' role='tooltip' onclick='editMultiple();'><i class='far fa-eye'></i> ตรวจสอบ</button>
                                                  <button class='btn btn-danger btn-sm' aria-label='ลบข้อมูล' data-microtip-position='top' role='tooltip' onclick='deleteMultiple();'><i class='far fa-trash-alt'></i></button>
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--======================================
        END COURSE AREA
======================================-->
