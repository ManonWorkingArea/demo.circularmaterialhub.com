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
// print_r($data["Output"] );
// echo "</pre>";

?>

<link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

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
                          "<div class='col-md-3' onclick='page(\"app/fill/{$ap_token}/{$FormSet['set_code']}\");'>
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

                    <section class="tabs">

                      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" onchange="page('app/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                      <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> แบบประเมินตามหัวข้อ</label>

                      <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2"  onchange="page('app/result/<?php echo $data["Application"]['ap_token']?>')"/>
                      <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-bar-chart"></i> ผลลัพธ์</label>

                      <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3"  onchange="page('app/fill/<?php echo $data['Output']['Linkage']['linkage_app']['ap_token'];?>/<?php echo $data['Output']['Linkage']['linkage_first'];?>')"/>
                      <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-edit"></i> กรอกใบสมัคร
                      <?php if ($data["Message"]['unread']>0) { ?>
                      <span class="tab-notification">
                        <i class="fa fa-envelope"></i> <span class="message-count-label"><?php echo $data["Message"]['unread'];?></span>
                      </span>
                      <?php } ?>
                      </label>

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
                <div class="card-box-shared">

                    <?php if($data["Status"]['lock']=="lock"): ?>

                      <div class="inactive"><p><strong>เกิดข้อผิดพลาด</strong></br>ไม่สามารถแก้ไขข้อมูลได้ในขณะที่เจ้าหน้าที่กำลังตรวจสอบข้อมูล</p></div>
                      <script>
                      $(".card-box-shared-body").css('pointer-events','none');
                      $(".card-box-shared-body").bind('dragstart', function(event) { event.preventDefault(); });
                      </script>

                    <?php endif; ?>

                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          <?php
                            $url       = "form/standard/" . $app_id . "/" . $set_id . "/" . $set_token . "/" . $member_id;
                            $output    = engine::api("GET", $url);
                            // GENERATE FORM -------------------------------------
                            echo "<form id='{$data["FormSetRow"]['set_token']}' autocomplete='off'><fieldset {$output['active']}>";
                            echo
                            "<div class='form-group row'>
                              <input type='hidden'name='form_application' id='form_application' value='{$app_id}'>
                              <input type='hidden'name='form_app_token' id='form_app_token' value='{$ap_token}'>
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

                            

                            /*  */

                            echo $output['standard'];

                           ?>

                           <script>

                            $('.input-unactive').hide();

                           function getDistrict(province_data, district_data, var2 ,var3)
                           {
                             var district         = $("#" + var2);
                             var subdistrict      = $("#" + var3);

                             $.ajax(
                             {
                               type : "POST",
                               url  : "app/action/get-district",
                               data :
                               {
                                  'province': province_data,
                                  'district': district_data,
                               },
                               success  : function(response)
                               {
                                 district.empty().append(response);
                               }
                             });
                           }

                           function getSubdistrict(district_data, subdistrict_data, var2 ,var3)
                           {
                             var district         = $("#" + var2);
                             var subdistrict      = $("#" + var3);

                             $.ajax(
                             {
                               type : "POST",
                               url  : "app/action/get-subdistrict",
                               data :
                               {
                                  'district': district_data,
                                  'subdistrict': subdistrict_data,
                               },
                               success  : function(response)
                               {
                                 subdistrict.empty().append(response);
                               }
                             });
                           }

                           function generateAddressOption(var1, var2, var3, var4, var5, var6)
                           {
                             console.log(var1 + "-" + var2 + "-" + var3);

                             var province         = $("#" + var1);
                             var district         = $("#" + var2);
                             var subdistrict      = $("#" + var3);

                             var province_val     = var4;
                             var district_val     = var5;
                             var subdistrict_val  = var6;

                             //district.prop("disabled", true);
                             //subdistrict.prop("disabled", true);

                             if(district_val!=""&&subdistrict_val!="")
                             {
                               getDistrict(province_val, district_val, var2, var3);
                               getSubdistrict(district_val, subdistrict_val, var2, var3);
                             }

                             province.on('change', function()
                             {
                               getDistrict(this.value, district_val, var2, var3);
                             });

                             district.on('change', function()
                             {
                               getSubdistrict(this.value, subdistrict_val, var2, var3);
                             });
                           }

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
                               url      : "app/action/save-form",
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
                            

                            /*
                            
                            Upload Function for upload plugin form 

                            */

                            $("#fileUploadArea").on("dragover", function() {
                              $(this).addClass("drag_over");
                              return false;
                            });

                            $("#fileUploadArea").on("dragleave", function() {
                              $(this).removeClass("drag_over");
                              return false;
                            });

                            $("#fileUploadArea").on("click", function(e) {
                              file_explorer();
                            });

                            $("#fileUploadArea").on("drop", function(e) {
                              e.preventDefault();
                              $(this).removeClass("drag_over");
                              var formData = new FormData();
                              var files = e.originalEvent.dataTransfer.files;
                              for (var i = 0; i < files.length; i++) {
                                formData.append("file[]", files[i]);
                              }
                              uploadFormData(formData);
                            });

                            function file_explorer() 
                            {
                              document.getElementById("uploadfileElement").click();
                              document.getElementById("uploadfileElement").onchange = function() 
                              {
                                files = document.getElementById("uploadfileElement").files;
                                var formData = new FormData();

                                form_application    = document.getElementById("form_application").value;
                                form_token          = document.getElementById("form_token").value;
                                form_member         = document.getElementById("form_member").value;
                                form_reference      = document.getElementById("form_reference").value;
                                form_app_token      = document.getElementById("form_app_token").value;
                                field_code          = document.getElementById("uploadfileElement").getAttribute("data-code")

                                for (var i = 0; i < files.length; i++) 
                                {
                                  formData.append("file[]", files[i]);
                                  formData.append("form_application", form_application);
                                  formData.append("form_token", form_token);
                                  formData.append("form_member", form_member);
                                  formData.append("form_reference", form_reference);
                                  formData.append("form_app_token", form_app_token);
                                  formData.append("field_code", field_code);
                                  formData.append("field", document.getElementById("uploadfileElement").getAttribute("data-field"));
                                  formData.append("app", document.getElementById("uploadfileElement").getAttribute("data-app"));
                                  formData.append("set", document.getElementById("uploadfileElement").getAttribute("data-set"));
                                }
                                uploadFormData(formData);
                              };
                            }

                            function uploadFormData(form_data) {
                              token        = document.getElementById("uploadfileElement").getAttribute("data-code");
                              run_waitMe($('.file-upload-window-' + token), 1, "win8_linear");

                              $.ajax({
                                url: "app/action/upload-single-file",
                                method: "POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                dataType 	: "json",
                                success: function(data) 
                                {
                                  if(data.status)
                                  {
                                    console.log("Upload Success : Loading File List");
                                    getFileContent();
                                  }
                                  else
                                  {
                                    console.log("Show Alert");

                                    $('.file-upload-window-' + token).waitMe('hide');
                                    $('.fileUploadAlert').show();
                                    $('.fileUploadAlert .text').html('<strong class="text-danger">เกิดข้อผิดพลาด</strong> ' + data.return);
                                    
                                    setTimeout(function() 
                                    {
                                      $('.fileUploadAlert').hide();
                                      $('.fileUploadAlert .text').html("");
                                      console.log("Hide Alert");
                                    }, 2000)

                                    console.log(data.return);
                                  }
                                }
                              });
                            }

                            function deleteFileContent(filetoken)
                            {
                              token        = document.getElementById("uploadfileElement").getAttribute("data-code");
                              run_waitMe($('.file-upload-window-' + token), 1, "win8_linear");
                              $.ajax(
                              {
                                type : "POST",
                                url  : "app/action/delete-file-content",
                                data :
                                {
                                  'token': filetoken,
                                },
                                success  : function(response)
                                {
                                  getFileContent();
                                  console.log(response);
                                }
                              });
                            }

                            function getFileContent()
                            {
                              field    = document.getElementById("uploadfileElement").getAttribute("data-field");
                              app      = document.getElementById("uploadfileElement").getAttribute("data-app");
                              set      = document.getElementById("uploadfileElement").getAttribute("data-set");
                              token    = document.getElementById("uploadfileElement").getAttribute("data-code");
                              member   = document.getElementById("form_member").value;

                              $.ajax(
                              {
                                type : "POST",
                                url  : "app/action/get-file-content",
                                data :
                                {
                                  'token': token,
                                  'field': field,
                                  'app': app,
                                  'set': set,
                                  'member': member,
                                },
                                dataType 	: "json",
                                success  : function(response)
                                {
                                  console.log(response);
                                  $('.file-upload-window-' + token).waitMe('hide');
                                  $("#file-list-table").html(response);
                                }
                              });
                            }

                          </script>
                          <style>
                          #fileUploadArea
                          {
                            height: 250px;
                            border: 1px dashed #d3d3d3;
                            line-height: 200px;
                            text-align: center;
                            font-size: 20px;
                            background: #fffbef;
                            margin-bottom: 15px;
                            text-align: center;
                          }

                          #fileUploadArea .upload-icon
                          {
                            width: 100%;
                            float: left;
                            position: relative;
                            height: 40px;
                            top: -45px;
                            font-size: 55px;
                            color: #d3d3d3;
                          }

                          .input-box {
                              position: relative;
                          }

                          .fileUploadAlert
                          {
                            width: 100%;
                            height: 100%;
                            float: left;
                            background: rgb(0 0 0 / 60%);
                            position: absolute;
                            z-index: 999;
                            text-align: center;
                            padding-top: 50%;
                          }

                          .fileUploadAlert .text
                          {
                            color: #5e5e5e;
                            background: #eee;
                            padding: 20px;
                            border-radius: 5px;
                            min-width: 119px;
                            width: 160px;
                            height: 50px;
                            margin: 0 auto;
                            position: relative;
                          }

                          .file-upload-btn
                          {
                            background: #007bff;
                            border: 1px solid #005bbd;
                            color: #fff;
                            padding: 10px;
                            border-radius: 5px;
                            font-size: 16px;
                            font-weight: bold;
                            
                          }

                          .file-upload-btn:hover
                          {
                            color: #000;
                          }

                          .fileBrowserArea
                          {
                              text-align: left;
                          }

                          .fileBrowserArea .list
                          {
                            padding-top: 10px;
                            margin-top: 10px;
                          }

                          .fileBrowserArea .item
                          {
                            border-top: 1px solid #e7e7e7;
                            padding-bottom: 10px;
                            padding-top: 10px;
                          }

                          .fileBrowserArea .item a
                          {
                            color: #838383;
                          }

                          .fileBrowserArea .item a:hover
                          {
                            color: #000;
                          }
                          .fileBrowserArea .file_content
                          {
                            
                          }

                          .fileBrowserArea .data_delete_btn
                          {
                            float: right;
                          }

                          .fileBrowserArea a.data_delete_btn
                          {
                            color: #ee5564;
                          }

                          .fileBrowserArea a.data_delete_btn:hover
                          {
                            color: #78131d;
                          }

                          .drag_over {
                            color: #000;
                            border-color: #000;
                          }

                          .thumbnail {
                            width: 100px;
                            height: 100px;
                            padding: 2px;
                            margin: 2px;
                            border: 2px solid lightgray;
                            border-radius: 3px;
                            float: left;
                          }

                          .d-none {
                            display: none;
                          }

                          .label-size {
                            font-size: 10px;
                            background: #233d63;
                            color: #fff;
                            padding: 4px;
                            border-radius: 4px;
                          }

                          .label-ext {
                            font-size: 10px;
                            background: #007bff;
                            color: #fff;
                            padding: 4px;
                            border-radius: 4px;
                            text-transform: uppercase;
                            font-weight: bold;
                          }

                          </style>

                          <?php echo $output['addressOption'];?>
                          
                        </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
