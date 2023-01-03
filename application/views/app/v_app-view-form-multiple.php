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
$formResult      = tracking::form('result', $form_id, $app_id, $member_id);

// FORM CONFIG ---------------------------------------
$form_token      = $formCreate['form']['form_token'];
$form_action     = $formCreate['form']['form_action'];
$form_function   = $formCreate['form']['form_function'];
$form_reference  = "LINEID";

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
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current"><?php echo $data["FormSetRow"]['set_name']?><i class="fa fa-angle-right icon-divition"></i> ใบสมัครของ <?php echo $data["Output"]['Member']['mem_firstname']?> <?php echo $data["Output"]['Member']['mem_lastname']?></span>
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

                      <div class="row custom-row">

                        <div class="col-md-12">
                          <div class="form-title">ข้อกำหนดทั้งหมด</div>
                        </div>

                        <?php
                        
                        // echo "<pre>";
                        // print_r($data["FormSet"]);
                        // echo "</pre>";
                      
                        foreach ($data["FormSet"] as $FormSet)
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

                          if($FormSet['approveRow']['app_ass_id']!="" || $FormSet['approveRow']['app_ass_id']!= NULL)
                          {
                            if($FormSet['approveRow']['app_ass_status']=="pending")
                            {
                              $score = "<div class='result'>กำลังพิจารณา</div>";
                            }
                            else if($FormSet['approveRow']['app_ass_status']=="approve")
                            {
                              $score = "<div class='result'>{$FormSet['approveRow']['app_ass_score']} คะแนน</div>";
                            }
                            else if($FormSet['approveRow']['app_ass_status']=="reject")
                            {
                              $score = "<div class='result'>ปฏิเสธ</div>";
                            }
                            else if($FormSet['approveRow']['app_ass_status']=="change")
                            {
                              $score = "<div class='result'>แก้ไขข้อมูล</div>";
                            }
                            else
                            {
                              $score = "<div class='result'>รอพิจารณา</div>";
                            }
                          }
                          else
                          {
                            $score = "<div class='result'>รอพิจารณา</div>";
                          }

                          echo
                          "<div class='col-md-3' onclick='page(\"app/view_fill/{$ap_token}/{$FormSet['set_code']}\");'>
                            <div class='form-card app-file-list {$active_class}'>
                            {$active}
                            <div class='app-file-icon'>
                              <i class='{$active_icon}'></i>
                            </div>
                            {$score}
                            <div class='form-order'>
                              {$FormSet['set_order']}
                            </div>
                            <div class='description'>
                              <div>
                                <div class='form-name'>{$FormSet['set_name']}</div>
                                <div class='form-status'>กรอกข้อมูลแล้ว {$FormSet['summary']}</div>
                              </div>
                            </div>
                            </div>
                          </div>
                          ";
                        }
                        ?>
                      </div>

                    <section class="tabs tabs4">

                      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" onchange="page('app/view_fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                      <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> ข้อกำหนดมาตรฐาน</label>
                    
                      <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2"  onchange="page('app/view_result/<?php echo $data["Application"]['ap_token']?>')"/>
                      <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-bar-chart"></i> ผลลัพธ์</label>
                      
                      <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3"  onchange="page('app/view_upload/<?php echo $data['Output']['Linkage']['linkage_app']['ap_token'];?>')"/>
                      <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-upload"></i> ข้อมูลเอกสาร</label>

                      <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4"  onchange="page('app/view/<?php echo $data['Output']['Linkage']['linkage_app']['ap_token'];?>')"/>
                      <label for="tab-4" class="tab-label-4"><span class="form-step">ขั้นตอนที่ 4</span><i class="fa fa-pencil"></i> ข้อมูลใบสมัคร</label>

                      <!--<div class="clear-shadow"></div>-->
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
                    <h2 class="section__title"><?php echo $data["FormSetRow"]['set_name']?></h2>
                    <p><?php echo $data["FormSetRow"]['set_desc']?></p>
                </div>
            </div>
        </div>

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">

                <?php if($data["Status"]['lock']=="lock"): ?>

                  <div class="inactive"><p><strong>เกิดข้อผิดพลาด</strong></br>ไม่สามารถแก้ไขข้อมูลได้ในขณะที่เจ้าหน้าที่กำลังตรวจสอบข้อมูล</p></div>
                  <script>
                  $(".contact-form-action").css('pointer-events','none');
                  $(".contact-form-action").bind('dragstart', function(event) { event.preventDefault(); });
                  </script>

                <?php endif; ?>

                <div class="card-box-shared">
                    <div class="card-box-shared-body">



                        <div class="contact-form-action">

                          <?php
                            // GENERATE FORM -------------------------------------
                            echo "<form id='{$data["FormSetRow"]['set_token']}' autocomplete='off'>";
                            echo
                            "<div class='form-group row'>
                              <input type='hidden'name='form_application' id='form_application' value='{$app_id}'>
                              <input type='hidden'name='form_token' id='form_token' value='{$data["FormSetRow"]['set_token']}'>
                              <input type='hidden'name='form_member' id='form_member' value='{$member_id}'>
                              <input type='hidden'name='form_reference' id='form_reference' value='{$form_reference}'>
                            </div>";

                            // Design Table
                            //print_r($formCreate);
                            /*
                            echo $app_id . "</br>";
                            echo $set_id . "</br>";
                            echo $set_token . "</br>";
                            echo $member_id . "</br>";
                            */

                            $url       = "form/multiple/" . $app_id . "/" . $set_id . "/" . $set_token . "/" . $member_id;
                            $output    = engine::api("GET", $url);
                            echo $output['multiple'];

                           ?>

                        </div>
                        <script>

                        function saveForm()
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
                            url      : "app/action/save-form-multiple",
                            data     : $("#<?php echo $data["FormSetRow"]['set_token'];?>").serialize(),
                            dataType : "json",
                            success  : function(response)
                            {
                              status 	= response.status
                              msg 		  = response.return
                              err 		  = response.error

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
                                 //alert("Value is :" + val);
                                 $("#" + val).addClass("form-control-danger");
                                 $("#" + val).closest('.form-group').addClass("has-error");
                                 //
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
                                 //alert("Value is :" + val);
                                 $("#" + val).addClass("form-control-danger");
                                 $("#" + val).closest('.form-group').addClass("has-error");
                                 //
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

                        function updateError(div)
                        {
                          $("#" + div).removeClass("form-control-danger")
                          $("#" + div).closest('.form-group').removeClass("has-error")
                        }

                        </script>

                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">

                           <h5 class="datatable-title"><i class="fa fa-save"></i> ตาราง<?php echo $data["FormSetRow"]['set_name']?> ที่ได้บันทึกไว้</h5>

                           <?php echo $output['datatable'];?>

                        </div>

                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->


    </div><!-- end container -->
</section>

<!-- <div class="container-fluid">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                  <div class="col-md-12">
                    <div class="multitab-section">
                      <ul class="multitab-widget multitab-widget-content-tabs-id">
                        <li class="multitab-tab icon-tab"><a href="app/dashboard" class=""><i class="mdi mdi-chevron-left"></i></a></li>
                        <li class="multitab-tab normal-tab"><a href="app/detail/<?php echo $data["Application"]['ap_token']?>" class="multitab-widget-current"><i class="mdi mdi-square-edit-outline"></i> แบบฟอร์ม</a></li>

                        <?php
                        foreach ($data["FormSet"] as $FormSet)
                        {
                          if($data["FormSetRow"]['code'] == $FormSet['set_code'])
                          {
                            $active = "multitab-widget-subcurrent";
                          }
                          else
                          {
                            $active = "";
                          }

                          echo "<li class='multitab-tab normal-tab'><a href='app/fill/{$ap_token}/{$FormSet['set_code']}' class='{$active}'><i class='mdi mdi-file-document-outline'></i> {$FormSet['set_order']}.{$FormSet['set_name']}</a></li>";
                        }
                        ?>

                      </ul>
                    </div>
                  </div>
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="action-title float-left">
                          <h4>
                            <i class="mdi mdi-file-document-box-multiple-outline"></i> <?php echo $data["Detail"]['app_name']?> <span class='text-muted'><?php echo $data["Application"]['ap_code']?></span><br>
                            <span class="action-sub-title"> ขั้นตอน : <?php echo $data["FormSetRow"]['set_name']?></span>
                          </h4>
                        </div>
                      </div>
                    </div>
                    <pre><?php //echo print_r($data["FormSetRow"]);?></pre>
                </div>
            </div>
        </div>
    </div>
</div> -->
