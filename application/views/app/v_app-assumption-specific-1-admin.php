<?php

$access = "user";
//$access = "audit";


echo "Admin";
print_r($_SESSION["AppData"]);
?>
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container text-center">

            <div class="row">

              <div class="col-md-12">
                <div class="top-head">
                  <div class="text">ข้อกำหนดเฉพาะของมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ (Specific requirements for Eco factory)<div class="back-home" onclick="page('app/assumption/dashboard');"><i class="fa fa-home"></i> กลับหน้าหลัก</div></div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="container-fluid">
                  <ul class="list-unstyled multi-steps">
                    <li onclick="page('app/assumption/specific/1');" class="is-active">ข้อที่ 1</li>
                    <li onclick="page('app/assumption/specific/2');">ข้อที่ 2</li>
                    <li onclick="page('app/assumption/specific/3');">ข้อที่ 3</li>
                    <li onclick="page('app/assumption/specific/4');">ข้อที่ 4</li>
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
                <table class="table table-bordered text-left">
                  <thead class="thead-dark">
                    <tr>
                      <th width="5"><i class="fa fa-check"></i></th>
                      <th>1. การจัดการวัตถุดิบ (5 คะแนน) </br><span class="description">ผู้ประกอบอุตสาหกรรมต้องดำเนินการการจัดการวัตถุดิบอย่างมีประสิทธิภาพตามข้อกำหนดดังนี้ </span><span class="pull-right score-result">ผลลัพธ์ 0 คะแนน</span></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="top-form-head table-topic-header">

                      <td width="5">
                        <div class="form">
                          <div class="form-group">
                              <div class="custom-checkbox">
                                <input type="checkbox" id="topic_1">
                                <label for="topic_1"><span class="line-height-24 d-block"> </span></label>
                              </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="text">จัดทำบัญชีรายการวัตถุดิบหลัก วัตถุดิบรอง และทรัพยากรสนับสนุนอื่นๆ รวมทั้งระบุปริมาณการใช้</div>
                      </td>

                    </tr>

                    <tr class="top-form-head table-topic-header">

                      <td width="5">
                        <div class="form">
                          <div class="form-group">
                              <div class="custom-checkbox">
                                <input type="checkbox" id="topic_2" disabled>
                                <label for="topic_2"><span class="line-height-24 d-block"> </span></label>
                              </div>
                          </div>
                        </div>
                      </td>

                      <td>
                        <div class="text">กำหนดวัตถุประสงค์ ระบุเป้าหมายขององค์กร จัดทำแผนการดำเนินงาน และ ดำเนินมาตรการเพิ่มประสิทธิภาพการจัดการวัตถุดิบ โดยมีผลการดำเนินงานบรรลุตามค่าเป้าหมายที่องค์กรกำหนด
                          <div class="inline-form">
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_1">
                                  <label for="topic_3_score_1"><span class="line-height-24 d-block"></span>มากกว่า 25% ขึ้นไป</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_2">
                                  <label for="topic_3_score_2"><span class="line-height-24 d-block"></span>มากกว่า 50% ขึ้นไป</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_3">
                                  <label for="topic_3_score_3"><span class="line-height-24 d-block"></span>มากกว่า 100% ขึ้นไป</label>
                                </div>
                            </div>
                          </div>

                        <div class="col-md-3">
                          <div class="input-box">
                              <label class="label-text">ระบุค่าร้อยละเป็นตัวเลขจริง<span class="primary-color-2 ml-1">*</span></label>
                              <div class="form-group">
                                  <input class="form-control" type="text" id="topic_2_score" name="topic_2_score" placeholder="ระบุค่าร้อยละเป็นตัวเลขจริง">
                              </div>
                          </div>
                        </div>
                        </div>
                      </td>

                    </tr>

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
                        ดำเนินการจัดการวัตถุดิบอย่างมีประสิทธิภาพตามมาตรการอย่างใดอย่างหนึ่งดังนี้ี้</br>
                          <div class="inline-form">
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_1">
                                  <label for="topic_3_score_1"><span class="line-height-24 d-block"></span>ประเมินค่าประสิทธิภาพการใช้ทรัพยากร (Resource intensity) โดยมีค่าประสิทธิภาพดีขึ้นอย่างต่อเนื่องทุกปี อ้างอิงข้อมูล 3 ปี ย้อนหลัง</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_2">
                                  <label for="topic_3_score_2"><span class="line-height-24 d-block"></span>ใช้วัสดุที่ไม่ใช้แล้วจากสถานประกอบการหรือภาคส่วนอื่นๆ มาใช้เป็นวัตถุดิบ (Symbiosis) ภายในระยะเวลา 3 ปี ย้อนหลัง</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_3">
                                  <label for="topic_3_score_3"><span class="line-height-24 d-block"></span>ประเมินค่าเปรียบเทียบเชิงสมรรถนะ (Performance benchmarking) การจัดการวัตถุดิบ โดยมีค่าเปรียบเทียบเชิงสมรรถนะสูงกว่าค่าเฉลี่ยของกลุ่มอุตสาหกรรมภายในระยะเวลา 3 ปี ย้อนหลัง</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_4">
                                  <label for="topic_3_score_4"><span class="line-height-24 d-block"></span>ได้รับรางวัลด้านการจัดการวัตถุดิบระดับองค์กรที่เป็นที่ยอมรับระดับชาติ ภูมิภาค หรือ สากลภายในระยะเวลา 3 ปี ย้อนหลัง</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-checkbox">
                                  <input type="checkbox" name="topic_3_score" id="topic_3_score_5">
                                  <label for="topic_3_score_5"><span class="line-height-24 d-block"></span>ประเมินฟุตพริ้นท์วัสดุ (Material footprint) อ้างอิงตามมาตรฐานสากลโดยเฉพาะรายการวัตถุดิบหลักและนำไปบริหารจัดการเพื่อลดฟุตพรินต์วัสดุของวัตถุดิบหลัก ภายในระยะเวลา 3 ปี ย้อนหลัง</label>
                                </div>
                            </div>
                          </div>

                        </div>
                      </td>

                    </tr>

                  </tbody>
                </table>

                <table class="table table-bordered text-left">
                  <thead class="thead-unactive">
                    <tr>
                      <th width="5"><i class="fa fa-file"></i></th>
                      <th>เอกสารอ้างอิงตามข้อกำหนด การจัดการวัตถุดิบ (5 คะแนน)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="top-form-head">
                        <td width="5"></td>
                        <td>
                          <div class="text">
                            <div class="row padding-bottom-10px padding-left-10px padding-right-10px">
                              <div class="col-md-6">1.ไฟล์อ้างอิงการประเมินตามข้อกำหนด การจัดการวัตถุดิบ.pdf</div>
                              <div class="col-md-3">4.5 Mb</div>
                              <div class="col-md-3 text-right"><a href="javascript:void(0);" class="btn btn-primary btn-xs"><i class="fa fa-download text-white"></i></a></div>
                            </div>
                            <div class="row padding-bottom-10px padding-left-10px padding-right-10px">
                              <div class="col-md-6">2.ไฟล์อ้างอิงการประเมินตามข้อกำหนด การจัดการวัตถุดิบ.pdf</div>
                              <div class="col-md-3">4.5 Mb</div>
                              <div class="col-md-3 text-right"><a href="javascript:void(0);" class="btn btn-primary btn-xs"><i class="fa fa-download text-white"></i></a></div>
                            </div>
                            <div class="row padding-bottom-10px padding-left-10px padding-right-10px">
                              <div class="col-md-6">3.ไฟล์อ้างอิงการประเมินตามข้อกำหนด การจัดการวัตถุดิบ.pdf</div>
                              <div class="col-md-3">4.5 Mb</div>
                              <div class="col-md-3 text-right"><a href="javascript:void(0);" class="btn btn-primary btn-xs"><i class="fa fa-download text-white"></i></a></div>
                            </div>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>

                <table class="table table-bordered text-left">
                  <thead class="thead-unactive">
                    <tr>
                      <th width="5"><i class="fa fa-file"></i></th>
                      <th>ข้อเสนอแนะจากผู้ตรวจประเมิน <span class="pull-right">นาย มานนท์ สาน้อย</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="top-form-head">
                        <td width="5"></td>
                        <td>
                          <div class="text">
                              <div class="col-md-12">
                                  <div class="input-box">
                                    <label class="label-text">ส่งเมื่อ 20/00/2021 เวลา 15:00น. <span class="primary-color-2 ml-1">*</span></label>
                                    <div class="form-group">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultricies placerat tristique. Aenean nec velit quis sapien lobortis lacinia. Mauris euismod laoreet pellentesque. Praesent leo lorem, congue quis iaculis sed, vestibulum sed arcu. Praesent cursus arcu at pharetra laoreet. Quisque fringilla</div>
                                </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>

                <table class="table table-bordered text-left reply-table">
                  <thead class="thead-unactive">
                    <tr>
                      <th width="5"><i class="fa fa-file"></i></th>
                      <th>คำชี้แจงจากสถานประกอบการ <span class="pull-right">โรงงานผลิตสินค้า</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="top-form-head">
                        <td width="5"></td>
                        <td>
                          <div class="text">
                              <div class="col-md-12">
                                  <div class="input-box">
                                    <label class="label-text">ส่งเมื่อ 20/00/2021 เวลา 15:00น. <span class="primary-color-2 ml-1">*</span></label>
                                    <div class="form-group">
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ultricies placerat tristique. Aenean nec velit quis sapien lobortis lacinia. Mauris euismod laoreet pellentesque. Praesent leo lorem, congue quis iaculis sed, vestibulum sed arcu. Praesent cursus arcu at pharetra laoreet. Quisque fringilla</br>
                                    </br><a href="javascript:void(0);"><i class="fa fa-file"></i> ไฟล์ประกอบคำชี้แจง.pdf</a>
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
                      <th>ข้อเสนอแนะจากเจ้าหน้าที่</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="top-form-head">
                        <td width="5"></td>
                        <td>
                          <div class="text">
                              <div class="col-md-12">
                                  <div class="input-box">
                                    <label class="label-text">ข้อเสนอแนะ <span class="primary-color-2 ml-1">*</span></label>
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
                      <a href="javascript:void(0);" class="btn btn-success btn-lg"><i class="fa fa-check"></i> เห็นด้วย</a>
                      <a href="javascript:void(0);" class="btn btn-danger btn-lg"><i class="fa fa-close"></i> ไม่เห็นด้วย</a>
                      <a href="javascript:void(0);" class="btn btn-default btn-lg" onclick="calculator('2');"><i class="fa fa-step-forward"></i> ข้อต่อไป</a>
                  </div>
              </div>
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

function calculator(newpage)
{
  topic2_raw_score  = $('#topic_2_score').val();
  topic2_real_score = scoreCal(topic2_raw_score,2,3);

  formStepCheck(topic2_real_score,newpage);
}

function formStepCheck(score,newpage)
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
  page("app/assumption/specific/"+newpage);

}

</script>
