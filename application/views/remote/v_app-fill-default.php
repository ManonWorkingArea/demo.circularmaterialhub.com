    <div class="page-content">

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

    //echo "<pre>";
    //print_r($data["Detail"] );
    //echo "</pre>";

    ?>



    <div class="card card-style bg-theme pb-0">
        <div class="content">
            
                
                <?php if ($data["Detail"]['linkage']['app_id'] != "" || $data["Detail"]['linkage']['app_id'] != NULL) { ?>
                
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="3" data-tab-active="bg-blue-dark color-white">
                    <a href="#" data-tab-active="" data-tab="tab-1" class="bg-blue-dark color-white no-click" 6onclick="page('remote/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')">กรอกข้อมูล</a>
                    <a href="#" data-tab="tab-2" class="" onclick="page('app/fill/<?php echo $data['Detail']['linkage_app']['ap_token'];?>/<?php echo $data['Detail']['linkage_first'];?>')">ประเมิน</a>
                    <a href="#" data-tab="tab-3" class="" onclick="page('remote/detail/<?php echo $data["Application"]['ap_token']?>')">ใบสมัคร</a>
                </div>

                <?php } else { ?>

                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="2" data-tab-active="bg-blue-dark color-white">
                    <a href="#" data-tab-active="" data-tab="tab-1" class="bg-blue-dark color-white no-click" onclick="page('remote/fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')">กรอกข้อมูล</a>
                    <a href="#" data-tab="tab-2" class="" onclick="page('remote/detail/<?php echo $data["Application"]['ap_token']?>')">ใบสมัคร</a>
                </div>

                <?php } ?>

            
            <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-1" style="display: block;">
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

                $url       = "form/standard/" . $app_id . "/" . $set_id . "/" . $set_token . "/" . $member_id;
                $output    = engine::api("GET", $url);

                /*  */

                echo $output['standard'];

                ?>

                <script>

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
            </div>
        
        </div>    
    </div>
</div>