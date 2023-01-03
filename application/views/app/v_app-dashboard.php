
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
                        <li class="active__list-item">แบบฟอร์ม</li>
                        <li>ใบสมัคร</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">

        <div class="container">
            <div class="course-content-wrapper mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="row application-card">

                                  <?php

                                  /*
                                  echo "--</br>";
                                  print_r($data["App"]);
                                  echo "--</br>";
                                  */

                                  foreach ($data["App"]['dashboard'] as $FrontEnd)
                                  {
                                    if (empty($FrontEnd["application"])) // No Application
                                    {
                                      echo
                                      "<div class='col-md-4'>
                                        <div class='card'>
                                            <div class='card-body'>
                                              <div class='float-right'>
                                                  <i class='fa fa-pencil font-24 text-secondary'></i>
                                              </div>
                                              <span class='badge badge-danger'>ใบสมัคร</span>
                                              <h3 class='card-title mt-2'>{$FrontEnd['app_name']}</h3>
                                              <p class='mb-2 text-muted text-truncate'>{$FrontEnd['app_desc']}</p>
                                              <button class='btn btn-warning btn-block' onclick='page(\"app/create/{$FrontEnd['app_token']}\");'><i class='mdi mdi-note-plus-outline'></i> สมัครตอนนี้</button>
                                            </div>
                                        </div>
                                      </div>
                                      ";
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

                                      //print_r($check_document);

                                      echo
                                      "<div class='col-md-6'>
                                        <div class='card'>
                                            <div class='card-header'>
                                              <div class='float-left'>
                                                <h3 class='card-title'>{$FrontEnd['app_name']}</h3>
                                              </div>
                                              <div class='float-right'>
                                                <i class='mdi mdi-folder-settings-outline card-icon'></i>
                                              </div>
                                            </div>
                                            <div class='card-body'>

                                              <div class='float-right'>
                                                  <span class='badge badge-{$FrontEnd["application"]['status_style']}'><i class='fa fa-{$FrontEnd["application"]['status_icon']}'></i> {$FrontEnd["application"]['status_name']}</span>
                                              </div>

                                              <span class='text-muted font-16'>{$FrontEnd["application"]['ap_code']}</span>

                                              <div class='application-document-status'>
                                                <span>{$check_document['list']}</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>สถานะเอกสาร</small></br><strong>{$check_document['message']}</strong></span>
                                              </div>

                                              <div class='application-form-status'>
                                                <span class='form-percent font-30 text-muted'><i class='mdi mdi-square-edit-outline font-30 text-dark'></i> {$check_form['percent']}%</span>
                                                <span class='float-right text-right text-muted' style='line-height: 14px;'><small class='text-dark'>แบบฟอร์ม</small></br><strong>{$check_form['message']}</strong></span>
                                              </div>

                                              <p class='mb-2 text-muted text-truncate'>{$FrontEnd['app_desc']}</p>

                                            </div>
                                            <div class='card-footer'>
                                              <div class='d-flex' role='group'>
                                                <button class='theme-btn mr-2' onclick='page(\"app/fill/{$FrontEnd["application"]['ap_token']}/{$first_formset}\");'><i class='mdi mdi-square-edit-outline'></i> แบบฟอร์ม</button>
                                                <button class='theme-btn mr-2' onclick='page(\"app/upload/{$FrontEnd["application"]['ap_token']}\");'><i class='mdi mdi-file-upload-outline'></i> อัพโหลด</button>
                                                <button class='theme-btn mr-2' onclick='page(\"app/detail/{$FrontEnd["application"]['ap_token']}\");'><i class='mdi mdi-content-paste'></i> รายละเอียด</button>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      ";
                                    }
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
