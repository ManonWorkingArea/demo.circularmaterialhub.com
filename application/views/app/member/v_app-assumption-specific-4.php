<?php

$access = "user";
//$access = "audit";

?>

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
                                <div class='form-status'>กรอกข้อมูลแล้ว</div>
                              </div>
                            </div>
                            </div>
                          </div>
                          ";
                        }
                        ?>
                      </div>

                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->

</section>

<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container text-center">

            <div class="row">

              <div class="col-md-12">
                <div class="top-head">
                  <div class="text">ข้อกำหนดเฉพาะของมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ (Specific requirements for Eco factory) <div class="back-home" onclick="page('app/assumption/dashboard/<?php echo $ap_token;?>/standard_specification');"><i class="fa fa-home"></i> กลับหน้าหลัก</div></div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="container-fluid">
                  <ul class="list-unstyled multi-steps">
                    <li onclick="page('app/assumption/specific/1');">ข้อที่ 1</li>
                    <li onclick="page('app/assumption/specific/2');">ข้อที่ 2</li>
                    <li onclick="page('app/assumption/specific/3');">ข้อที่ 3</li>
                    <li onclick="page('app/assumption/specific/4');" class="is-active">ข้อที่ 4</li>
                    <li onclick="page('app/assumption/specific/5');">ข้อที่ 5</li>
                    <li onclick="page('app/assumption/specific/6');">ข้อที่ 6</li>
                    <li onclick="page('app/assumption/specific/7');">ข้อที่ 7</li>
                    <li onclick="page('app/assumption/specific/8');">ข้อที่ 8</li>
                    <li onclick="page('app/assumption/specific/9');">ข้อที่ 9</li>
                    <li onclick="page('app/assumption/specific/10');">ข้อที่ 10</li>
                    <li onclick="page('app/assumption/specific/11');">ข้อที่ 11</li>
                    <li onclick="page('app/assumption/specific/12');">ข้อที่ 12</li>
                    <li onclick="page('app/assumption/specific/13');">ข้อที่ 13</li>
                    <li onclick="page('app/assumption/specific/14');">ข้อที่ 14</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-striped table-bordered text-left">
                  <thead class="thead-dark">
                    <tr>
                      <th width="5"><i class="fa fa-check"></i></th>
                      <th>4. การจัดการมลภาวะทางอากาศ (5 คะแนน)  </br><span class="description">ผู้ประกอบอุตสาหกรรมต้องดำเนินการจัดการมลพิษอากาศจากปล่องระบายมลพิษทางอากาศอย่างมีประสิทธิภาพ ตามข้อกำหนดดังนี้</span><span class="pull-right score-result">ผลลัพธ์ 0 คะแนน</span></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="top-form-head">

                      <td width="5">
                        <div class="form">
                          <div class="form-group">
                              <div class="custom-checkbox">
                                <input type="checkbox" id="topic_1" name="topic_1">
                                <label for="topic_1"><span class="line-height-24 d-block"> </span></label>
                              </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="text">จัดทำบัญชีรายการมลพิษทางอากาศ ระบุแหล่งปล่อยมลพิษอากาศ ชนิดของมลสารที่ปล่อย ปริมาณของมลสาร และ มาตรการควบคุม หรือบำบัดมลพิษอากาศ</div>
                      </td>

                    </tr>

                    <tr class="top-form-head">

                      <td width="5">
                        <div class="form">
                          <div class="form-group">
                              <div class="custom-checkbox">
                                <input type="checkbox" id="topic_2" name="topic_2" disabled>
                                <label for="topic_2"><span class="line-height-24 d-block"> </span></label>
                              </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="text">กำหนดวัตถุประสงค์ ระบุเป้าหมายขององค์กร จัดทำแผนการดำเนินงาน และ ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการมลพิษอากาศที่มีนัยสำคัญขององค์กรได้มากกว่าค่าที่กฎหมาย หรือ EIA กำหนดอย่าง
                          <div class="inline-form">
                            <div class="form-group">
                                <div class="custom-radio">
                                  <input type="radio" name="topic_2_score" id="topic_2_score_1" value="1">
                                  <label for="topic_2_score_1"><span class="line-height-24 d-block"></span>ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการมลพิษอากาศที่มีนัยสำคัญขององค์กรได้มากกว่าค่าที่กฎหมาย หรือ EIA กำหนดอย่างน้อยร้อยละ 5</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-radio">
                                  <input type="radio" name="topic_2_score" id="topic_2_score_2" value="2">
                                  <label for="topic_2_score_2"><span class="line-height-24 d-block"></span>ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการมลพิษอากาศที่มีนัยสำคัญขององค์กรได้มากกว่าค่าที่กฎหมาย หรือ EIA กำหนดอย่างน้อยร้อยละ 10</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-radio">
                                  <input type="radio" name="topic_2_score" id="topic_2_score_3" value="3">
                                  <label for="topic_2_score_3"><span class="line-height-24 d-block"></span>ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการมลพิษอากาศที่มีนัยสำคัญขององค์กรได้มากกว่าค่าที่กฎหมาย หรือ EIA กำหนดอย่างน้อยร้อยละ 15</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-radio">
                                  <input type="radio" name="topic_2_score" id="topic_2_score_4" value="4">
                                  <label for="topic_2_score_4"><span class="line-height-24 d-block"></span>ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการมลพิษอากาศที่มีนัยสำคัญขององค์กรได้มากกว่าค่าที่กฎหมาย หรือ EIA กำหนดอย่างน้อยร้อยละ 20</label>
                                </div>
                            </div>
                          </div>
                         <div class="col-md-3">
                           <div class="input-box">
                               <label class="label-text">ระบุค่าร้อยละเป็นตัวเลขจริง<span class="primary-color-2 ml-1">*</span></label>
                               <div class="form-group">
                                   <input class="form-control" type="text" id="topic_2_score_text" name="topic_2_score_text" placeholder="ระบุค่าร้อยละเป็นตัวเลขจริง">
                               </div>
                           </div>
                         </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-lg-12">
                    <div class="btn-box  pull-left">
                        <a href="javascript:void(0);" class="btn btn-success btn-lg" onclick="nextPage('5');"><i class="fa fa-step-forward"></i> ข้อต่อไป</a>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>

<script>

var formset = "step4";
var recapGroups_count = 1;

$(document).ready(function()
{
  //----------------------------------------------------------------------------
  // TOPIC 1
  var quiz4_topic_1 = localStorage.getItem("quiz4_topic_1");
  if (quiz4_topic_1 !== null)
  {
    if(quiz4_topic_1==="checked")
    {
      $('input[name="topic_1"]').attr("checked",true);
    }
    else
    {
      $('input[name="topic_1"]').attr("checked",false);
    }
  }
  // TOPIC 2
  var quiz4_topic_2 = localStorage.getItem("quiz4_topic_2");
  if (quiz4_topic_2 !== null)
  {
    if(quiz4_topic_2 === "checked")
    {
      $('input[name="topic_2"]').attr("checked",true);
    }
    else
    {
      $('input[name="topic_2"]').attr("checked",false);
    }
  }
  //----------------------------------------------------------------------------
  // TOPIC 2 SCORE
  var quiz4_topic_2_score = localStorage.getItem("quiz4_topic_2_score");
  if (quiz4_topic_2_score !== null)
  {
    $('input:radio[name=topic_2_score][value='+quiz4_topic_2_score+']').attr('checked', true);
  }
  //----------------------------------------------------------------------------

  $('input[type="checkbox"]').click(function(){
  calculator();
  });

  $('input[type="radio"]').click(function(){
  calculator();
  });

  $('input[type="text"]').bind("change paste keyup", function(){
  calculator();
  });

  calculator();
  $('.score-result').html("ผลลัพธ์ " + Cookies.get(formset) + " คะแนน");

});

function scoreCal(data, ids_check, ids_group)
{
  recapStepCheck(ids_check);
  recapStepCheck(ids_group);
}

function recapStepCheck(ids)
{
  var count = $('input[name=topic_' + ids + '_score]:checked').length;

  if(count>=recapGroups_count)
  {
    $("#topic_" + ids).attr("checked", true);
    radioanswer = $('input[name=topic_' + ids + '_score]:checked').val();
    localStorage.setItem("quiz4_topic_" + ids, "checked");
    localStorage.setItem("quiz4_topic_" + ids + "_score", radioanswer);
  }
  else
  {
    $("#topic_" + ids).attr("checked", false);
    localStorage.setItem("quiz4_topic_" + ids, "unchecked");
    localStorage.setItem("quiz4_topic_" + ids + "_score", "0");
  }
  return radioanswer;
}

function calculator()
{
  recapStepCheck(2);
  formStepCheck();
}

function formStepCheck()
{
  var step1 = ($('#topic_1').is(":checked") ? "yes" : "no");
  var step2 = ($('#topic_2').is(":checked") ? "yes" : "no");
  var step2_score = $('input[name="topic_2_score"]:checked').val();

  //console.log("STEP 1 : " + step1);
  //console.log("STEP 2 : " + step2);
  //console.log("STEP 2 Score : " + score);
  //console.log("STEP 3 : " + step3);

  var formScore = "0";

  if(step1=="no")
  {
    formScore = "0";
  }
  else
  {
    if(step2 == "no")
    {
      formScore = "1";
    }
    else
    {
      if(step2_score=="1")
      {
        formScore = "2";
      }
      else if(step2_score=="2")
      {
        formScore = "3";
      }
      else if(step2_score=="3")
      {
        formScore = "4";
      }
      else if(step2_score=="4")
      {
        formScore = "5";
      }
    }
  }
  console.log("ALL SCORE : " + formScore);
  $('.score-result').html("ผลลัพธ์ " + formScore + " คะแนน");
  Cookies.set(formset, formScore);
}

function nextPage(pagenumber)
{
  page("app/assumption/specific/" + pagenumber);
}

window.onbeforeunload = function()
{
  //----------------------------------------------------------------------------
  // TOPIC 1
  if($('input[name="topic_1"]').is(':checked'))
  {
    localStorage.setItem("quiz4_topic_1", "checked");
  }
  else
  {
    localStorage.setItem("quiz4_topic_1", "unchecked");
  }
  //----------------------------------------------------------------------------
  // TOPIC 2 SCORE
  localStorage.setItem("quiz4_topic_2_score_text", $('#topic_2_score_text').val());

}

</script>
