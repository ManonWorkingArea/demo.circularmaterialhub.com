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
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container text-center">

            <div class="row">

              <div class="col-md-12">
                <div class="top-head">
                  <div class="text">ข้อกำหนดเฉพาะเกี่ยวกับการปรับปรุงอย่างต่อเนื่อง (Specific requirements for Continual improvement)<div class="back-home" onclick="page('app/assumption/dashboard/<?php echo $ap_token;?>/standard_specification');"><i class="fa fa-home"></i> กลับหน้าหลัก</div></div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered text-left">
                  <thead class="thead-dark">
                    <tr>
                      <th width="5"><i class="fa fa-check"></i></th>
                      <th>ด้านสิ่งแวดล้อมและเศรษฐกิจ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="top-form-head table-topic-header">

                      <td width="5">
                        <div class="form">
                          <div class="form-group">
                              <div class="custom-checkbox">
                                <input type="checkbox" id="topic_3" disabled>
                                <label for="topic_3"><span class="line-height-24 d-block"> </span></label>
                              </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="text">

                          เลือกประเด็นนำเสนอการปรับปรุงอย่างต่อเนื่องอย่างน้อย 1-2 ประเด็น</br>

                          <div class="inline-form">
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_1">
                                  <label for="topic_3_score_1"><span class="line-height-24 d-block"></span>การจัดการวัตถุดิบ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_2">
                                  <label for="topic_3_score_2"><span class="line-height-24 d-block"></span>การจัดการมลพิษอากาศ</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_3">
                                  <label for="topic_3_score_3"><span class="line-height-24 d-block"></span>การจัดการพลังงาน</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_4">
                                  <label for="topic_3_score_4"><span class="line-height-24 d-block"></span>การจัดการก๊าซเรือนระจก</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_5">
                                  <label for="topic_3_score_5"><span class="line-height-24 d-block"></span>การจัดการน้ำและน้ำเสีย</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_5">
                                  <label for="topic_3_score_5"><span class="line-height-24 d-block"></span>การจัดการกากของเสีย</label>
                                </div>
                            </div>
                          </div>

                        </div>
                      </td>

                    </tr>

                  </tbody>
                </table>


                <table class="table table-bordered text-left">
                  <thead class="thead-admin">
                    <tr>
                      <th width="5"><i class="fa fa-file"></i></th>
                      <th>ระบุเหตุผลความมีนัยสำคัญของหัวข้อที่เลือกนำเสนอการปรับปรุงอย่างต่อเนื่อง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="top-form-head">
                        <td width="5"></td>
                        <td>
                          <div class="text">
                              <div class="col-md-12">
                                  <div class="input-box">
                                    <label class="label-text">การจัดการพลังงาน <span class="primary-color-2 ml-1">*</span></label>
                                    <div class="form-group"><textarea class="message-control form-control" rows="4" cols="50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultricies placerat tristique. Aenean nec velit quis sapien lobortis lacinia. Mauris euismod laoreet pellentesque. Praesent leo lorem, congue quis iaculis sed, vestibulum sed arcu. Praesent cursus arcu at pharetra laoreet. Quisque fringilla</textarea></div>
                                    <a href="javascript:void(0);" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</a>
                                </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr class="top-form-head">
                          <td width="5"></td>
                          <td>
                            <div class="text">
                                <div class="col-md-12">
                                    <div class="input-box">
                                      <label class="label-text">การจัดการนำ้และน้ำเสีย <span class="primary-color-2 ml-1">*</span></label>
                                      <div class="form-group"><textarea class="message-control form-control" rows="4" cols="50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultricies placerat tristique. Aenean nec velit quis sapien lobortis lacinia. Mauris euismod laoreet pellentesque. Praesent leo lorem, congue quis iaculis sed, vestibulum sed arcu. Praesent cursus arcu at pharetra laoreet. Quisque fringilla</textarea></div>
                                      <a href="javascript:void(0);" class="btn btn-success"><i class="fa fa-save"></i> บันทึกข้อมูล</a>
                                  </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                  </tbody>
                </table>


              </div>

              <div class="col-lg-12">
                  <div class="btn-box">
                      <div class="padding-bottom-10px">จากข้อมูลและเอกสารของผู้สมัคร ผลการพิจารณาคะแนนตามข้อกำหนด ท่านมีความเห็นว่า</div>
                      <a href="/app/assumption/continual-calculator" class="btn btn-success btn-lg"><i class="fa fa-check"></i> ทำแบบฟอร์มคำนวนค่า Eco Efficiency</a>
                  </div>
              </div>

            </div>
        </div>
    </div>
</section>

<script>

var formset = "step1";
var recapGroups_count = 1;

$(document).ready(function()
{
  $('input[type="checkbox"]').click(function(){
  calculator();
  });

  $('input[type="text"]').bind("change paste keyup", function(){
  calculator();
  });
  $('.score-result').html("ผลลัพธ์ " + Cookies.get(formset) + " คะแนน");
});

function scoreCal(data, ids_check, ids_group)
{
  recapStepCheck(ids_check);
  recapGroupCheck(ids_group);

  if(data<25){obj = 1;}
  if(data>25 && data<50){obj = 2;}
  if(data>=50 && data<100){obj = 3;}
  if(data==100){obj = 4;}
  return obj;
}

function recapStepCheck(ids)
{
  $('#topic_' + ids + '_score').bind("change paste keyup", function()
  {
    if(!$(this).val())
    {
      $("#topic_" + ids).attr("checked", false);
    }
    else
    {
      $("#topic_" + ids).attr("checked", true);
    }
  });
}

function recapGroupCheck(ids)
{
  var count = $('input[name=topic_' + ids + '_score]:checked').length;

  if(count>=recapGroups_count)
  {
    $("#topic_" + ids).attr("checked", true);
  }
  else
  {
    $("#topic_" + ids).attr("checked", false);
  }
}

function calculator()
{
  topic2_raw_score  = $('#topic_2_score').val();
  topic2_real_score = scoreCal(topic2_raw_score,2,3);

  formStepCheck(topic2_real_score);
}

function formStepCheck(score)
{
  var step1 = ($('#topic_1').is(":checked") ? "yes" : "no");
  var step2 = ($('#topic_2').is(":checked") ? "yes" : "no");
  var step3 = ($('#topic_3').is(":checked") ? "yes" : "no");

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
    if(step2=="no")
    {
      formScore = "1";
    }
    else
    {
      if(step3=="no")
      {
        formScore = score+1
      }
      else
      {
        formScore = score+2
      }
    }
  }
  console.log("ALL SCORE : " + formScore);
  $('.score-result').html("ผลลัพธ์ " + formScore + " คะแนน");
  Cookies.set(formset, formScore);

}

</script>
