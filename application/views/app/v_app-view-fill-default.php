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
                    <div class="section-tab section-tab-2  viewer">

                      <div class="row custom-row">

                        <div class="col-md-12">
                          <div class="form-title">แบบฟอร์มใบสมัครทั้งหมด</div>
                        </div>

                        <?php
                        /*
                        echo "<pre>";
                        print_r($data["Output"]);
                        echo "</pre>";
                        */

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
                          "<div class='col-md-3' onclick='page(\"app/view_fill/{$ap_token}/{$FormSet['set_code']}\");'>
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
                                <div class='form-status'>กรอกข้อมูลแล้ว</div>
                              </div>
                            </div>
                            </div>
                          </div>
                          ";
                        }
                        ?>
                      </div>

                      <section class="tabs tabs4">

                      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" onchange="page('app/view_fill/<?php echo $data['Application']['ap_token'] . "/" . $first;?>')"/>
                      <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> ข้อมูลใบสมัคร</label>

                      <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" onchange="page('app/view_upload/<?php echo $data['Application']['ap_token']?>')"/>
                      <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-upload"></i> ข้อมูลเอกสาร</label>

                      <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" onchange="page('app/view_fill/<?php echo $data['Detail']['linkage_app']['ap_token'];?>/<?php echo $data['Detail']['linkage_first'];?>')"/>
                      <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-edit"></i> ข้อกำหนดมาตรฐาน</label>

                      <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" onchange="page('app/view/<?php echo $data['Application']['ap_token']?>')"/>
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
                    <h2 class="section__title"><?php echo $data["FormSetRow"]['set_name']?></h2>
                    <p><?php echo $data["FormSetRow"]['set_desc']?></p>
                </div>
            </div>
        </div>
        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">

                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          <?php
                            // GENERATE FORM -------------------------------------
                            echo "<form id='{$data["FormSetRow"]['set_token']}' autocomplete='off'><fieldset class='fieldset'>";
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

                            $url       = "form/standard/" . $app_id . "/" . $set_id . "/" . $set_token . "/" . $member_id;
                            $output    = engine::api("GET", $url);

                            /*  */

                            echo $output['standard'];

                           ?>

                           <script>

                            $('.fieldset').prop('disabled', true);
                            $('.footer-form-remark').remove();

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

                           </script>

                           <?php echo $output['addressOption'];?>

                           <script>generateAddressOption("FRM-53-select-province_1","FRM-53-select-amphur_1","FRM-53-select-tambon_1","","","");</script>

                        </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
