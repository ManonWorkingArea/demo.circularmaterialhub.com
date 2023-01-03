<?php


// FORM CONFIG ---------------------------------------
$member_id       = $data["Application"]['member_id'];
$form_id         = $data["Application"]['ap_form'];
$app_id          = $data["Application"]['app_id'];
$ap_id           = $data["Application"]['ap_id'];
$ap_token        = $data["Application"]['ap_token'];
$set_id          = $data["FormSetRow"]['set_id'];
$set_relate      = $data["FormSetRow"]['set_relate'];
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
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current"><?php echo $data["FormSetRow"]['set_name']?></span>
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
                          <div class="form-title">แบบฟอร์มใบสมัครทั้งหมด</div>
                        </div>

                        <?php
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

                          echo
                          "<div class='col-md-3' onclick='page(\"app/fill/{$ap_token}/{$FormSet['set_code']}\");'>
                            <div class='form-card app-file-list {$active_class}'>
                            {$active}
                            <div class='app-file-icon'>
                              <i class='{$active_icon}'></i>
                            </div>
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

                      <?php if ($data["Detail"]['linkage']['app_id'] != "" || $data["Detail"]['linkage']['app_id'] != NULL) { ?>

                      <section class="tabs tabs4">
                        <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" onchange="page('app/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                        <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> กรอกใบสมัคร</label>

                        <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" onchange="page('app/fill/<?php echo $data['Detail']['linkage_app']['ap_token'];?>/<?php echo $data['Detail']['linkage_first'];?>')"/>
                        <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-edit"></i> แบบประเมิน</label>

                        <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" onchange="page('app/upload/<?php echo $data["Application"]['ap_token']?>')"/>
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
                      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" onchange="page('app/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                      <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> กรอกใบสมัคร</label>

                      <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" onchange="page('app/upload/<?php echo $data["Application"]['ap_token']?>')"/>
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
                    <h2 class="section__title"><?php echo $data["FormSetRow"]['set_name']?></h2>
                    <p><?php echo $data["FormSetRow"]['set_desc']?></p>
                </div>
            </div>
        </div>

        <div class="row margin-top-20px">

            <?php if($data["Status"]['lock']=="lock"): ?>

              <div class="inactive"><p><strong>เกิดข้อผิดพลาด</strong></br>ไม่สามารถแก้ไขข้อมูลได้ในขณะที่เจ้าหน้าที่กำลังตรวจสอบข้อมูล</p></div>
              <script>
              $(".contact-form-action").css('pointer-events','none');
              $(".contact-form-action").bind('dragstart', function(event) { event.preventDefault(); });
              </script>

            <?php endif; ?>

            <div class="col-lg-12">
              <div class="contact-form-action">
                <div class="search_section">
                   <span class="search_head">เครื่องมือในการค้นหารายชื่อ</span>
                   <div class="form-group has-feedback has-search input-lg">
                     <span class="mdi mdi-file-search-outline form-control-feedback"></span>

                     <input type="text"
                     class = "form-control search_box"
                     placeholder    = "ค้นหารายชื่อ..." id="advance_search"
                     data-status    = "<?php echo $data["FormSetRow"]['set_relate_option'];?>"
                     data-app       = "<?php echo $data["FormSetRow"]['set_relate'];?>"
                     data-formset   = "<?php echo $data["FormSetRow"]['set_id'];?>"
                     data-owner     = "<?php echo $member_id;?>">

                     <?php

                     $url       = "form/relate/" . $set_relate . "/" . $set_id . "/" . $member_id;
                     $output    = engine::api("GET", $url);

                     if($output['status']=="done")
                     {
                       $result_msg = "
                       <div class='alert alert-success'>
                        <strong>สำเร็จ!</strong> {$output['result']}
                       </div>";
                     }
                     else
                     {
                       $result_msg = "
                       <div class='alert alert-danger'>
                        <strong>ผิดพลาด!</strong> {$output['result']}
                       </div>";
                     }

                     ?>

                     <div id="advance_search_result"></div>

                   </div>
                   <span class="search_helper"><i class="la la-question-circle"></i> พิมพ์ชื่อ เบอร์โทร อีเมล์ ของทีมงานที่คุณได้เลือกใช้บริการ โดยสามารถพิมพ์เพียงบางส่วน ระบบจะทำการดึงผลลัพธ์ที่ใกล้เคียงกับข้อมูลของคุณให้อัตโนมัติ เมื่อได้ข้อมูลที่ต้องการแล้ว ให้คลิ๊กที่รายชื่อเพื่อเลือกข้อมูลค่ะ</span>
                 </div>
              </div>
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          <h5 class="datatable-title"><i class="fa fa-save"></i> ตาราง <?php echo $data["FormSetRow"]['set_name']?> ที่เลือกไว้ <div class="pull-right form-relate-result-message"><?php echo $result_msg;?></div></h5>
                          <?php

                            // GENERATE FORM
                            echo "<form id='{$data["FormSetRow"]['set_token']}' autocomplete='off'>";
                            echo
                            "<div class='form-group row'>
                              <input type='hidden'name='form_application' id='form_application' value='{$app_id}'>
                              <input type='hidden'name='form_token' id='form_token' value='{$data["FormSetRow"]['set_token']}'>
                              <input type='hidden'name='form_member' id='form_member' value='{$member_id}'>
                              <input type='hidden'name='form_reference' id='form_reference' value='{$form_reference}'>
                            </div>";
                            echo "</form>";

                            // Design Table
                            // print_r($formCreate);
                            /*
                            echo $app_id . "</br>";
                            echo $set_id . "</br>";
                            echo $set_token . "</br>";
                            echo $member_id . "</br>";
                            */

                            echo $output['relate'];

                           ?>

                        </div>

                        <script>

                        $("#advance_search").keyup(function()
                        {
                         var searchid 	= $(this).val();
                         var status 		= $(this).attr('data-status');
                         var app 			= $(this).attr('data-app');
                         var owner 		= $(this).attr('data-owner');
                         var formset 		= $(this).attr('data-formset');

                         var dataString = 'search='+ searchid + '&status='+ status + '&app='+ app + '&owner='+ owner + '&formset='+ formset;
                         if(searchid!='')
                         {
                           $.ajax({
                           type: "POST",
                           url: "app/action/advance-search",
                           data: dataString,
                           cache: false,
                           success: function(html)
                           {
                             $("#advance_search_result").html(html).show();
                           }
                           });
                         }return false;
                        });

                        $("#advance_search").blur(function()
                        {
                         $('#advance_search_result').fadeOut();
                        });

                        $( "#advance_search" ).click(function()
                        {
                         var searchtext = $(this).val();
                         if(searchtext!="")
                         {
                           $("#advance_search").val("");
                         }
                        });

                        function selectRelate(app,member,formset,owner)
                        {
                         $.ajax(
                         {
                           type: "POST",
                           url: "app/action/save-form-relate",
                           data:
                           {
                             'app': app,'formset': formset,'owner': owner,'member': member
                           },
                           dataType : "json",
                           success: function(response)
                           {
                             status 	= response.status
                             msg 		= response.return

                             if(status=="true")
                             {
                               iziToast.show(
                               {
                                   title: 'แจ้งเตือน',
                                   message: msg,
                                   theme: 'dark',
                                   displayMode: 2,
                                   position: 'bottomRight',
                                   layout: 2,
                                   timeout: 1000,
                                   onClosing: function(instance, toast, closedBy)
                                   {
                                     console.log("Update Success");
                                     reload();
                                   }
                               });
                             }
                             else
                             {
                               iziToast.show(
                               {
                                   title: 'แจ้งเตือน',
                                   message: msg,
                                   theme: 'light',
                                   color: 'red',
                                   displayMode: 2,
                                   position: 'bottomRight',
                                   layout: 2,
                                   timeout: 2000,
                                   onClosing: function(instance, toast, closedBy)
                                   {
                                     console.log("Update Not Success");
                                   }
                               });
                             }
                           }
                         });

                        }

                       </script>

                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<script>
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
