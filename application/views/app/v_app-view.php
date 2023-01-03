<?php

// FORM CONFIG ---------------------------------------
$member_id       = $data["Application"]['member_id'];
$form_id         = $data["Application"]['ap_form'];
$app_id          = $data["Application"]['app_id'];
$ap_id           = $data["Application"]['ap_id'];
$ap_token        = $data["Application"]['ap_token'];
$set_id          = $data["FormSetRow"]['set_id'];
$first           = $data["FormSetRow"]['first'];

/*
$formCreate      = tracking::form('generate', $form_id, $app_id);

// FORM CONFIG ---------------------------------------
$form_token      = $formCreate['form']['form_token'];
$form_action     = $formCreate['form']['form_action'];
$form_function   = $formCreate['form']['form_function'];
$form_reference  = "LINEID";
*/


// echo "<pre>";
// print_r($data["Application"]);
// echo "</pre>";

// echo "<pre>";
// print_r($data["Detail"]);
// echo "</pre>";

?>

<section class="breadcrumb-area my-courses-bread application-form">

    <div class="topbar-control">
      <div class="container">
        <div class="col-md-12">
          <div class="topbar-nav">
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <span class="current"><i class="fa fa-angle-right icon-divition"></i> ใบสมัครของ <?php echo $data["Output"]['Member']['mem_firstname']?> <?php echo $data["Output"]['Member']['mem_lastname']?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title"><i class="fa fa-edit"></i>  <?php echo $data["Detail"]['app_name']?></h2>
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2 viewer">

                      <section class="tabs tabs4">

                        <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" onchange="page('app/view_fill/<?php echo $data['Application']['ap_token'] . "/" . $first;?>')"/>
                        <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> ข้อมูลใบสมัคร</label>

                        <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" onchange="page('app/view_upload/<?php echo $data['Application']['ap_token']?>')"/>
                        <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-upload"></i> ข้อมูลเอกสาร</label>

                        <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" onchange="page('app/view_fill/<?php echo $data['Detail']['linkage_app']['ap_token'];?>/<?php echo $data['Detail']['linkage_first'];?>')"/>
                        <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-edit"></i> ข้อกำหนดมาตรฐาน</label>

                        <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" checked="checked" onchange="page('app/view/<?php echo $data['Application']['ap_token']?>')"/>
                        <label for="tab-4" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 4</span><i class="fa fa-user"></i> ข้อมูลการสมัคร</label>

                      </section>

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
                    <h2 class="section__title">ข้อมูลการสมัคร</h2>
                </div>
            </div>
        </div>

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          <div class="row">
                             <div class="col-md-12">
                                <div class="container-fluid">
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <div class="breadcrumb-content dashboard-bread-content align-items-center justify-content-between row">

                                              <?php //print_r($data["Status"]); ?>

                                              <div class="user-bread-content d-flex align-items-center col-md-6">
                                                  <div class="bread-img-wrap">
                                                      <img src="<?php echo engine::student("avatar");?>" alt="">
                                                  </div>
                                                  <div class="section-heading">
                                                      <h2 class="section__title font-size-30"><?php echo $data["User"]['mem_firstname'] . " " . $data["User"]['mem_lastname']?></h2>
                                                      <?php echo $data["User"]['mem_phone']?></br>
                                                      <?php echo $data["User"]['mem_email']?>
                                                  </div>
                                              </div>

                                              <div class="application-action-tools col-md-6">

                                                  <?php if($data["formAPI"]['fillStatus']=="error" || $data["documentAPI"]['status']=="error"): ?>

                                                  <div class="error">
                                                    <div class="application-document-status">
                                                    <span>
                                                    <?php echo $data["documentAPI"]['list']?>
                                                    </span>
                                                    <span class='form-percent font-30 text-muted'><?php echo $data["documentAPI"]['percent']?>%</span>
                                                    <span class="float-right text-right text-muted" style="line-height: 14px;"><small class="text-dark">สถานะเอกสาร</small><br><strong><?php echo $data["documentAPI"]['message']?></strong></span>
                                                    </div>

                                                    <div class="application-form-status">
                                                      <span class="form-percent font-30 text-muted"><i class="mdi mdi-square-edit-outline font-30 text-dark"></i> <?php echo $data["formAPI"]["overview"]['percent']?>%</span>
                                                      <span class="float-right text-right text-muted" style="line-height: 14px;"><small class="text-dark">แบบฟอร์ม</small><br><strong><?php echo $data["formAPI"]['overview']['message']?></strong></span>
                                                    </div>

                                                    <div class="">หากคุณเห็นข้อความนี้ กรุณาตรวจสอบการกรอกข้อมูลของคุณให้ครบถ้วน หลังจากที่กรอกข้อมูลครบถ้วนแล้ว ระบบจะแสดงเมนูสำหรับการส่งข้อมูลให้คุณโดยอัตโนมัติ</div>

                                                  </div>

                                                  <?php else: ?>

                                                  <div class="btn-group" role="group" aria-label="Basic example">

                                                  <?php

                                                  if(!isset($data["Certification"]['cert_id']))
                                                  {
                                                    $cert = "<button type='button' class='btn btn-secondary' disabled><i class='fa fa-file'></i> ใบรับรอง</button>";
                                                  }
                                                  else
                                                  {
                                                    $cert = "
                                                    <button class='btn btn-primary' type='button' aria-label='เรียกดูใบรับรอง' data-microtip-position='top' role='tooltip' onclick='page(\"https://weiscp.fti.or.th/etracking/external/display/{$data["Certification"]['cert_token']}\",\"new\");'>
                                                    <i class='fa fa-file-text'></i> ใบรับรอง
                                                    </button><span class='expire_date'><small><strong>วันหมดอายุ </strong></br>{$data["Certification"]['cert_expiredate']}</small></span>";
                                                  }

                                                  ?>

                                                  <?php if($data["Status"]['state']=="wait"): ?>

                                                  <button type="button" class="btn btn-success" disabled><i class="fa fa-send"></i> ส่งใบสมัคร</button>

                                                  <?php elseif ($data["Status"]['state']=="success"): ?>

                                                  <button type="button" class="btn btn-success" disabled><i class="fa fa-send"></i> ส่งใบสมัครแล้ว</button>

                                                  <?php elseif ($data["Status"]['state']=="submit"): ?>

                                                  <button type="button" class="btn btn-success" disabled><i class="fa fa-send"></i> ส่งใบสมัครแล้ว</button>

                                                  <?php else: ?>

                                                  <button type="button" class="btn btn-success" disabled><i class="fa fa-send"></i> ส่งใบสมัครแล้ว</button>

                                                  <?php endif; ?>

                                                  <?php echo $cert;?>

                                                  <button type="button" class="btn btn-default"><i class="fa fa-comment"></i> เสนอความเห็น</button>


                                                  </div>
                                                  </br></br>
                                                  <span>จัดการใบสมัคร</span></br>
                                                  <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-ban"></i> เคลียร์ข้อมูล</button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-envelope"></i> แจ้งปัญหา</button>
                                                    <button type="button" class="btn btn-default"><i class="fa fa-trash"></i> ยกเลิก</button>
                                                  </div>

                                                  <?php endif; ?>

                                              </div>

                                          </div>
                                      </div><!-- end col-lg-12 -->



                                  </div><!-- end row -->

                                  <div class="row mt-5">
                                    <div class="col-lg-6">
                                      <?php if($data["Status"]['state']=="wait"): ?>

                                        <div class="application-status alert alert-<?php echo $data["Status"]['detail']['status_style'];?> border-0" role="alert">
                                          <span class="status-icons"><i class="fa fa-<?php echo $data["Status"]['detail']['status_icon'];?>"></i></span>
                                          <span class="status-text">
                                            <small>สถานะการทำรายการ</small><br>
                                            <strong><?php echo $data["Status"]['detail']['status_name'];?></strong> <br>
                                            <span class=""><?php echo $data["Status"]['detail']['status_comment'];?></span>
                                          </span>
                                        </div>

                                      <?php elseif ($data["Status"]['state']=="success"): ?>

                                        <div class="application-status alert alert-<?php echo $data["Status"]['detail']['status_style'];?> border-0" role="alert">
                                          <span class="status-icons"><i class="fa fa-<?php echo $data["Status"]['detail']['status_icon'];?>"></i></span>
                                          <span class="status-text">
                                            <small>สถานะการทำรายการ</small><br>
                                            <strong><?php echo $data["Status"]['detail']['status_name'];?></strong> <br>
                                            <span class=""><?php echo $data["Status"]['detail']['status_comment'];?></span>
                                          </span>
                                        </div>

                                      <?php elseif ($data["Status"]['state']=="submit"): ?>

                                        <div class="application-status alert alert-<?php echo $data["Status"]['detail']['status_style'];?> border-0" role="alert">
                                          <span class="status-icons"><i class="fa fa-<?php echo $data["Status"]['detail']['status_icon'];?>"></i></span>
                                          <span class="status-text">
                                            <small>สถานะการทำรายการ</small><br>
                                            <strong><?php echo $data["Status"]['detail']['status_name'];?></strong> <br>
                                            <span class=""><?php echo $data["Status"]['detail']['status_comment'];?></span>
                                          </span>
                                        </div>

                                      <?php else: ?>

                                        <div class="application-status alert alert-<?php echo $data["Status"]['detail']['status_style'];?> border-0" role="alert">
                                          <span class="status-icons"><i class="fa fa-<?php echo $data["Status"]['detail']['status_icon'];?>"></i></span>
                                          <span class="status-text">
                                            <small>สถานะการทำรายการ</small><br>
                                            <strong><?php echo $data["Status"]['detail']['status_name'];?></strong> <br>
                                            <span class=""><?php echo $data["Status"]['detail']['status_comment'];?></span>
                                          </span>
                                        </div>

                                      <?php endif; ?>
                                    </div>

                                    <div class="col-lg-6">
                                      <strong>ข้อความ/ประกาศ</strong></br>
                                      <?php if($data["Status"]['state']=="wait"): ?>

                                      <span class="text-danger">** หลังจากกรอกข้อมูลครบถ้วนแล้ว ต้องทำการส่งข้อมูลใบสมัครเป็นขั้นตอนสุดท้าย เพื่อยืนยันข้อมูลของคุณ</span>

                                      <?php elseif ($data["Status"]['state']=="success"): ?>

                                        <?php
                                        if($data["Status"]['comment']['note_detail']!="")
                                        {
                                          echo $data["Status"]['comment']['note_detail'] . "</br>";
                                          echo "เมื่อ " . $data["Status"]['comment']['note_addtate'];
                                        }
                                        else
                                        {
                                          echo "ไม่มีข้อความ";
                                        }
                                        ?>

                                      <?php elseif ($data["Status"]['state']=="submit"): ?>

                                        <?php
                                        if($data["Status"]['comment']['note_detail']!="")
                                        {
                                          echo $data["Status"]['comment']['note_detail'] . "</br>";
                                          echo "เมื่อ " . $data["Status"]['comment']['note_addtate'];
                                        }
                                        else
                                        {
                                          echo "ไม่มีข้อความ";
                                        }
                                        ?>

                                      <?php else: ?>

                                        <?php
                                        if($data["Status"]['comment']['note_detail']!="")
                                        {
                                          echo $data["Status"]['comment']['note_detail'] . "</br>";
                                          echo "เมื่อ " . $data["Status"]['comment']['note_addtate'];
                                        }
                                        else
                                        {
                                          echo "ไม่มีข้อความ";
                                        }
                                        ?>

                                      <?php endif; ?>
                                    </div>
                                  </div>

                                  <div class="row mt-5">
                                      <div class="col-lg-12">
                                          <div class="section-block"></div>
                                      </div>
                                  </div>
                                  <div class="row mt-5">
                                      <div class="col-lg-12">
                                          <h3 class="widget-title">ข้อมูลการสมัครของคุณ</h3>
                                      </div>
                                  </div>

                                  <div class="row mt-5">

                                  <?php

                                    /*
                                    echo "<pre>";
                                    print_r($data["formAPI"]);
                                    echo "</pre>";

                                    echo "<pre>";
                                    print_r($data["documentAPI"]);
                                    echo "</pre>";
                                    */


                                    foreach ($data["FormSet"]['table'] as $FormSet)
                                    {
                                      if($data["FormSetRow"]['code'] == $FormSet['set_code'])
                                      {
                                        $active       = "<span class='active-icon'><i class='fa fa-check-circle'></i></span>";
                                        $active_class = "form-active";
                                        $active_icon  = "fas fa-folder-open";
                                      }
                                      else
                                      {
                                        $active       = "";
                                        $active_class = "";
                                        $active_icon  = "fas fa-folder";
                                      }

                                      if($FormSet['set_style']=="1")
                                      {
                                        $col = "col-lg-6";
                                      }
                                      else if($FormSet['set_style']=="2")
                                      {
                                        $col = "col-lg-12";
                                      }
                                      else if($FormSet['set_style']=="3")
                                      {
                                        $col = "col-lg-12";
                                      }

                                      echo
                                      "<div class='{$col}'>
                                          <div class='profile-detail pb-5'>
                                            <div class='form-detail-name'>
                                              {$FormSet['set_name']}</br><small>{$FormSet['set_desc']}</small>
                                              </div>";

                                              $all_item     = "0";
                                              $fill_item    = "0";
                                              $empty_item   = "0";

                                              if(!empty($FormSet['Render']))
                                              {
                                                if($FormSet['set_style']=="1")
                                                {

                                                  echo "<ul class='list-items'>";

                                                  /*

                                                  echo "<pre>";
                                                  print_r($FormSet['Render']);
                                                  echo "</pre>";

                                                  */

                                                  foreach ($FormSet['Render'] as $Form)
                                                  {
                                                    $all_item++;
                                                    if($Form['name']!="" && $Form['label']!="")
                                                    {
                                                      if($Form['value']==""||$Form['value']==NULL)
                                                      {
                                                        $Form['value'] = "<span class='text-danger'>- ยังไม่มีข้อมูล -</span>";
                                                        $empty_item++;
                                                      }
                                                      else
                                                      {
                                                        $fill_item++;
                                                      }
                                                      echo "<li><span class='profile-name'>{$Form['label']}:</span><span class='profile-desc'>{$Form['value']}</span></li>";
                                                    }
                                                  }

                                                  echo "</ul>";
                                                }
                                                else if($FormSet['set_style']=="2")
                                                {
                                                  echo $FormSet['Render'];
                                                }
                                                else if($FormSet['set_style']=="3")
                                                {
                                                  echo $FormSet['Render'];
                                                }
                                              }

                                          echo
                                          "</div>
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
        </div>

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          <div class="row">

                             <div class="col-md-12">
                                <div class="form-detail-name">
                                เอกสารประกอบการสมัคร<br><small>กรุณาอัพโหลดไฟล์ให้ครบทุกหัวข้อ</small>
                                </div>
                             </div>

                             <?php

                             $i = "0";
                             $token = $data["Application"]['ap_token'];
                             foreach ($data['Document'] as $document)
                              {
                                $i++;
                                $code = $document['document_code'];
                                $name = $document['document_name'];
                                $desc = $document['document_desc'];

                                $dir  = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/" . $token . "/" . $code . "/";
                                $url  = "https://weiscp.fti.or.th/img.php?file=voucher/document/" . $token . "/" . $code . "/";
                                $newest_mtime = 0;
                                $show_file = 'https://weiscp.fti.or.th/img.php?file=voucher/document/default/brocken-img.jpg';
                                if ($handle = opendir($dir)) {
                                 while (false !== ($file = readdir($handle)))
                                 {
                                    if (($file != '.') && ($file != '..'))
                                    {
                                       $mtime = filemtime("$dir/$file");
                                       if ($mtime > $newest_mtime)
                                       {
                                          $newest_mtime = $mtime;
                                          $show_file = "$url/$file";
                                       }
                                    }
                                  }
                                }
                                if($show_file=="https://weiscp.fti.or.th/img.php?file=voucher/document/default/brocken-img.jpg")
                                {
                                  $cover_img =  $show_file;
                                }
                                else
                                {
                                  $cover_img =  "";
                                }

                                echo "<div class='col-xl-3 col-lg-6 col-md-12 col-sm-6 col-6 p-1'>";

                                if($cover_img=="" || $cover_img ==NULL){}else
                                {
                                  echo
                                  "<div class='thumbnail'>
                                    <a data-fancybox='document-" . $code . "' data-caption='{$name}' href='{$cover_img}'>
                                      <img src='{$cover_img}'>
                                    </a>
                                    <div class='caption'>
                                    <span class='caption-name'>{$name}</span></br><small class='text-danger'>- ยังไม่มีไฟล์ -</small>
                                    </div>
                                  </div>";
                                }

                                $dir  = "/var/www/weiscp.fti.or.th/html/storage/files/client/voucher/document/" . $token . "/" . $code . "/";
                                $url  = "https://weiscp.fti.or.th/img.php?file=voucher/document/" . $token . "/" . $code . "/";
                                $totalFiles = glob($dir . "*");

                                if ($totalFiles)
                                {
                                 $countFile = count($totalFiles);
                                }

                                $order = "1";

                                foreach(glob($dir.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE) as $file)
                                {
                                  if($order=="1")
                                  {
                                    $hide = "";
                                  }
                                  else
                                  {
                                    $hide = "hidden";
                                  }

                                  $imag_path =  basename($file);
                                  echo
                                  "<div class='thumbnail {$hide}'>
                                    <a data-fancybox='document-" . $code . "' data-caption='{$name} {$order}/{$countFile}' href='{$url}{$imag_path}'>
                                      <img src='{$url}{$imag_path}' class='w-100'>
                                    </a>
                                    <div class='caption'><span class='caption-name'>{$name}</span></br><span class='badge badge-primary'>{$order}/{$countFile}</span></div>
                                  </div>";
                                  $order++;
                                }
                                echo "</div>";
                              }
                            ?>
                         </div>
                      </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<script>
function deleteMultiple(token)
{
 iziToast.show(
 {
   title: 'การดำเนินการ',
   message: 'ระบบกำลังบันทึกข้อมูลของคุณ',
   position: 'topRight',
   transitionIn: 'fadeInDown',
   timeout: 1000,
 });

  $.ajax(
  {
    type     : "POST",
    url      : "app/action/delete-form-multiple",
    data:
    {
      'token' : token
    },
    dataType : "json",
    success  : function(response)
    {
      status 	= response.status
      msg 		= response.return
      err 		= response.error
      if(status=="true")
      {
        iziToast.success(
       {
         title: 'สำเร็จ',
         position: 'topRight',
         transitionIn: 'fadeInDown',
         message: msg,
         timeout: 1000,
         onClosed: function ()
         {
           reload();
         }
       });
      }
      else
      {
       $.map(err, function(val)
       {
         $("#" + val).addClass("form-control-danger");
         $("#" + val).closest('.form-group').addClass("has-error");
         setInterval(function()
         {
           updateError(val);
         }, 2000);
       });
       iziToast.error(
       {
         title: 'เกิดข้อผิดพลาด',
         position: 'topRight',
         transitionIn: 'fadeInDown',
         timeout: 3000,
         message: msg,
       });
     }
    }
  });
}

function deleteRelate(token)
{
 iziToast.show(
 {
   title: 'การดำเนินการ',
   message: 'ระบบกำลังบันทึกข้อมูลของคุณ',
   position: 'topRight',
   transitionIn: 'fadeInDown',
   timeout: 1000,
 });

  $.ajax(
  {
    type     : "POST",
    url      : "app/action/delete-form-relate",
    data:
    {
      'token' : token
    },
    dataType : "json",
    success  : function(response)
    {
      status 	= response.status
      msg 		= response.return
      err 		= response.error
      if(status=="true")
      {
        iziToast.success(
       {
         title: 'สำเร็จ',
         position: 'topRight',
         transitionIn: 'fadeInDown',
         message: msg,
         timeout: 1000,
         onClosed: function ()
         {
           reload();
         }
       });
      }
      else
      {
       $.map(err, function(val)
       {
         $("#" + val).addClass("form-control-danger");
         $("#" + val).closest('.form-group').addClass("has-error");
         setInterval(function()
         {
           updateError(val);
         }, 2000);
       });
       iziToast.error(
       {
         title: 'เกิดข้อผิดพลาด',
         position: 'topRight',
         transitionIn: 'fadeInDown',
         timeout: 3000,
         message: msg,
       });
     }
    }
  });
}


</script>
