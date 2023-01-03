<?php

// FORM CONFIG -----------------------------------------------------------------

$member_id       = $data["Application"]['member_id'];
$form_id         = $data["Application"]['ap_form'];
$app_id          = $data["Application"]['app_id'];
$ap_id           = $data["Application"]['ap_id'];
$ap_token        = $data["Application"]['ap_token'];
$set_id          = $data["FormSetRow"]['set_id'];
$first           = $data["FormSetRow"]['first'];

/*
--------------------------------------------------------------------------------
$formCreate      = tracking::form('generate', $form_id, $app_id);
$formResult      = tracking::form('result', $form_id, $app_id, $member_id);
// FORM CONFIG -----------------------------------------------------------------
$form_token      = $formCreate['form']['form_token'];
$form_action     = $formCreate['form']['form_action'];
$form_function   = $formCreate['form']['form_function'];
$form_reference  = "LINEID";
--------------------------------------------------------------------------------
*/

// echo "<pre>";
// print_r($data["Detail"] );
// echo "</pre>";

?>

<section class="breadcrumb-area my-courses-bread application-form">

    <div class="topbar-control">
      <div class="container">
        <div class="col-md-12">
          <div class="topbar-nav">
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current">อัพโหลดเอกสารต่างๆ</span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title"><i class="fa fa-edit"></i> <?php echo $data["Detail"]['app_name']?></h2>
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2">

                    <?php if ($data["Detail"]['linkage']['app_id'] != "" || $data["Detail"]['linkage']['app_id'] != NULL) { ?>

                    <section class="tabs tabs4">
                      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" onchange="page('app/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                      <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> กรอกใบสมัคร</label>

                      <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" onchange="page('app/fill/<?php echo $data['Detail']['linkage_app']['ap_token'];?>/<?php echo $data['Detail']['linkage_first'];?>')"/>
                      <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-edit"></i> แบบประเมิน</label>

                      <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" checked="checked" onchange="page('app/upload/<?php echo $data["Application"]['ap_token']?>')"/>
                      <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-upload"></i> อัพโหลดเอกสาร</label>

                      <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" onchange="page('app/detail/<?php echo $data["Application"]['ap_token']?>')"/>
                      <label for="tab-4" class="tab-label-4"><span class="form-step">ขั้นตอนที่ 4</span><i class="fa fa-user"></i> ข้อมูลการสมัคร
                      <?php if ($data["Message"]['unread']>0) { ?>
                      <span class="tab-notification">
                        <i class="fa fa-envelope"></i> <span class="message-count-label"><?php echo $data["Message"]['unread'];?></span>
                      </span>
                      <?php } ?>
                      </label>
                    </section>

                    <?php } else { ?>

                    <section class="tabs">
                    <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" onchange="page('app/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                    <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> กรอกใบสมัคร</label>

                    <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" checked="checked" onchange="page('app/upload/<?php echo $data["Application"]['ap_token']?>')"/>
                    <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-upload"></i> อัพโหลดเอกสาร</label>

                    <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" onchange="page('app/detail/<?php echo $data["Application"]['ap_token']?>')"/>
                    <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-user"></i> ข้อมูลการสมัคร</label>
                    </section>

                    <?php } ?>

                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="admission-area section--flat-padding">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h5 class="section__meta"><?php echo $data["Application"]['ap_code']?></h5>
                    <h2 class="section__title">อัพโหลดเอกสาร</h2>
                </div>
            </div>
        </div>
        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                  <div class="contact-form-action">

                    <div class="row">


                    <?php if($data["Status"]['lock']=="lock"): ?>

                      <div class="inactive"><p><strong>เกิดข้อผิดพลาด</strong></br>ไม่สามารถแก้ไขข้อมูลได้ในขณะที่เจ้าหน้าที่กำลังตรวจสอบข้อมูล</p></div>
                      <script>
                      $(".contact-form-action").css('pointer-events','none');
                      $(".contact-form-action").bind('dragstart', function(event) { event.preventDefault(); });
                      </script>

                    <?php endif; ?>

                    <div class="col-md-12">
                    <strong>คำแนะนำ</strong></br>
                    - รองรับไฟล์ประเภท JPG,PNG,GIF,PDF</br>
                    - รองรับขนาดไฟล์สูงสุด 100MB</br>
                    - ควรตั้งความละเอียดของรูปไว้ที่ 72 DPI - 150 DPI</br></br>
                    </div>

                    <input type="hidden" id="ap_form_token" name="ap_form_token" value="<?php echo $data["Application"]['ap_token']?>">

                    <?php

                    $i     = "0";
                    $token = $data["Application"]['ap_token'];
                    
                    /*
                    echo "<pre>";
                    print_r($data['Document']);
                    echo "</pre>";
                    */

                    foreach ($data['Document'] as $document)
                    {
                      $i++;
                      $code = $document['document_code'];
                      $name = $document['document_name'];
                      $desc = $document['document_desc'];

                      //echo $code;
                      $dir  = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/" . $token . "/" . $code . "/";
                      $url  = "https://weiscp.fti.or.th/img.php?file=voucher/document/" . $token . "/" . $code . "/";

                      $newest_mtime = 0;
                      $show_file    = 'background-image: url(https://weiscp.fti.or.th/img.php?file=voucher/document/default/brocken-img.jpg);';

                      //echo $token;

                      is_dir($dir) || mkdir($dir, 0755, true);

                      if ($handle = opendir($dir))
                      {
                       while (false !== ($file = readdir($handle)))
                       {
                          if (($file != '.') && ($file != '..'))
                          {
                             $mtime = filemtime("$dir/$file");
                             if ($mtime > $newest_mtime)
                             {
                                $newest_mtime = $mtime;
                                $filetype     = substr(strrchr($file, "."), 1);

                                if($filetype=="pdf")
                                {
                                  $thumb        = str_replace(".pdf", ".png", $file);
                                  $show_file    = "background-image: url({$url}/{$thumb});";
                                }
                                else
                                {
                                  $show_file    = "background-image: url({$url}/{$file});";
                                }

                                $data = array
                                (
                                  "type" 		=> "DIS",
                                  "message" => $code . " - " . $filetype,
                                );
                                //
                                //engine::logs($data);
                             }
                          }
                        }
                      }

                      if($document['document_lms']=="0")
                      {
                        if($document['approve']['app_doc_status']=="approve")
                        {
                          $file_manager = "<a href='javascript:void(0);' class='btn btn-default btn-block btn-lg' disabled><i class='fa fa-folder'></i> ผ่านแล้ว </a>";
                        }
                        else if($document['approve']['app_doc_status']=="reject")
                        {
                          $file_manager = "<a href='javascript:void(0);' class='btn btn-default btn-block btn-lg' disabled><i class='fa fa-folder'></i> ไม่ผ่าน </a>";
                        }
                        else if($document['approve']['app_doc_status']=="edit")
                        {
                          $file_manager = "<a href='javascript:void(0);' class='btn btn-warning btn-block btn-lg' data-toggle='modal' data-animation='bounce' data-target='#hint_brand_{$code}'><i class='fa fa-folder'></i> แก้ไขไฟล์  </a>";
                        }
                        else
                        {
                          $file_manager = "<a href='javascript:void(0);' class='btn btn-warning btn-block btn-lg' data-toggle='modal' data-animation='bounce' data-target='#hint_brand_{$code}'><i class='fa fa-folder'></i> จัดการไฟล์  </a>";
                        }
                      }
                      else if($document['document_lms']=="1")
                      {
                        $file_manager = "<a href='javascript:void(0);' class='btn btn-info btn-block btn-lg'><i class='fa fa-refresh'></i> ดึงข้อมูล  </a>";
                      }

                      if($document['approve']['app_doc_status']=="approve")
                      {
                        $doc_approve_icon = "<span class='document-approve-label'><i class='fa fa-check' aria-hidden='true'></i></span>";
                        $doc_status       = "unactive";
                      }
                      else if($document['approve']['app_doc_status']=="reject")
                      {
                        $doc_approve_icon = "<span class='document-reject-label'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></span>";
                        $doc_status       = "unactive";
                      }
                      else if($document['approve']['app_doc_status']=="edit")
                      {
                        $doc_approve_icon = "<span class='document-edit-label'><i class='fa fa-upload' aria-hidden='true'></i></span>";
                        $doc_status       = "active";
                      }
                      else
                      {
                        $doc_approve_icon = "";
                        $doc_status       = "active";
                      }

                      echo
                      "<div class='col-md-4 col-xs-4 col-sm-4 col-lg-3 imgUp'>
                            <div class='card {$doc_status}'>
                                {$doc_approve_icon}
                                <div class='card-img-top img-fluid imagePreview' id='image_{$code}_preview' style='{$show_file}'></div>
                                <div class='card-body'>
                                    <div class='upload-item'>
                                    <h4 class='card-title mt-0 caption'>{$i}.{$name}</h4>
                                    <span class='card-text detail'>{$desc}</span>
                                    </div>
                                    <div class='upload-footer'>
                                    {$file_manager}
                                    <input type='hidden' id='ap_document_{$code}' name='ap_document_{$code}' class='documentdata'>
                                    </div>
                                </div>
                            </div>
                        </div>";

                        echo
                        "<!--boostatrp modal-->
                        <div class='modal fade bs-example-modal-center' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true' id='hint_brand_{$code}' data-backdrop='false'>
                            <div class='modal-dialog modal-dialog-centered'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title mt-0' id='exampleModalLabel'>{$i}.{$name}</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                      <ul class='media-list clearfix'>";

                                      $dir2        = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/{$token}/{$code}/";
                                      $url2        = "voucher/document/{$token}/{$code}/";
                                      $doc_order  = "0";

                                      foreach(glob($dir2.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE) as $file)
                                      {
                                          $imag_path = basename($file);
                                          $doc_order++;
                                          echo
                                          "<li class='tip' tooltip='{$name}' title='{$name}' id='img_{$code}_{$doc_order}'>
                                            <img src='https://weiscp.fti.or.th/img.php?file={$url2}{$imag_path}' title='{$name}'>
                                            <div class='post-thumb'>
                                              <div class='inner-post-thumb'>
                                                <a href='javascript:void(0);' data-id='{$name}' class='delete-img' onclick='deleteDocument(\"{$url2}{$imag_path}\",\"img_{$code}_{$doc_order}\");'><i class='fa fa-times' aria-hidden='true'></i></a>
                                                <div></div>
                                              </div>
                                            </div>
                                          </li>";
                                      }

                                      echo "</ul>

                                      <ul id='media-list-{$code}' class='media-list clearfix'>
                                        <li class='myupload'>
                                          <span>
                                          <i class='fa fa-plus' aria-hidden='true'></i> <input type='file' click-type='type2' id='picupload' class='picupload' multiple>
                                          <p>เพิ่มไฟล์</p>
                                          </span>
                                        </li>
                                      </ul>
                                    </div>

                                    <div class='modal-footer'>
                                        <div class='upload-detail'>
                                        1. คลิก <strong><i class='fa fa-plus'></i> เพิ่มไฟล์</strong> เพื่อเลือกไฟล์ที่ต้องการอัพโหลด สามารถเลือกได้ครั้งละหลายไฟล์ </br>
                                        2. หลังจากเพิ่มเสร็จแล้ว คลิก <strong>อัพโหลดไฟล์</strong> เพื่อทำการส่งข้อมูลขึ้นระบบ </br>
                                        3. คลิก <i class='fa fa-times'></i> เพื่อลบไฟล์ที่ไม่ต้องการออก </br>
                                        </div>
                                        <div class='upload-button'><button type='button' class='btn btn-info btn-lg btn-block btn-upload' onclick='uploadMultiple(\"{$code}\");'><i class='fa fa-upload'></i> อัพโหลดไฟล์</button></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--bootstrap modal end-->";
                    }
                    ?>
                  </div>
              </div><!-- end contact-form-action -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
