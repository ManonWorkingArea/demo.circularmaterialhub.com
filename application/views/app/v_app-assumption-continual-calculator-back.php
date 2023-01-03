<?php

$access = "user";
//$access = "audit";

?>
<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container text-center">

            <div class="row">

              <div class="col-md-12">
                <div class="top-head">
                  <div class="text">ข้อกำหนดเฉพาะเกี่ยวกับการปรับปรุงอย่างต่อเนื่อง (Specific requirements for Continual improvement)<div class="back-home" onclick="page('app/assumption/dashboard');"><i class="fa fa-home"></i> กลับหน้าหลัก</div></div>
                </div>
              </div>

            </div>

            <div class="row padding-top-20px">
              <div class="col-md-12">


              <table class="table table-bordered text-center continual-calculator">
                <thead class="thead-head">
                  <tr>
                    <th colspan="3">รายละเอียด</th>
                    <th colspan="3">ปี</th>
                  </tr>
                  <tr>
                    <td>ปริมาณการผลิตผลิตภัณฑ์</td>
                    <td>Production Volume</td>
                    <td>Unit</td>
                    <td>2020</td>
                    <td>2021</td>
                    <td>2022</td>
                  </tr>
                </thead>
                <tbody  class="text-left">
                  <tr class="tr-head">
                    <td colspan="5">ข้อมูลที่นำมาใช้ประเมิน</td>
                  </tr>
                  <tr>
                    <td>ปริมาณผลิตภัณฑ์</td>
                    <td>ปริมาณผลิตภัณฑ์</td>
                    <td width="10">ton</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณการใช้วัตถุดิบ</td>
                    <td>ปริมาณการใช้วัตถุดิบ</td>
                    <td>ton</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณการใช้พลังงาน</td>
                    <td>ปริมาณการใช้พลังงาน</td>
                    <td>MJ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณการใช้น้ำ</td>
                    <td>ปริมาณการใช้น้ำ</td>
                    <td>m3</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณมลภาวะทางอากาศ</td>
                    <td>ปริมาณมลภาวะทางอากาศ</td>
                    <td>g/s</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณการปล่อยก๊าซเรือนกระจก</td>
                    <td>ปริมาณการปล่อยก๊าซเรือนกระจก</td>
                    <td>ton CO2e</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>ปริมาณกากของเสีย</td>
                    <td>ปริมาณกากของเสีย</td>
                    <td>ton</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr class="tr-head">
                    <td colspan="5">ค่าประสิทธิภาพเชิงเศรษฐนิเวศ (Eco Efficiency)</td>
                  </tr>
                  <tr>
                    <td>การจัดการวัตถุดิบ</td>
                    <td>การจัดการวัตถุดิบ</td>
                    <td>Ton/ton</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการพลังงาน</td>
                    <td>การจัดการพลังงาน</td>
                    <td>Ton/MJ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการน้ำและน้ำเสีย</td>
                    <td>Ton/m3</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการมลภาวะทางอากาศ</td>
                    <td>Ton/g/s</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การปล่อยก๊าซเรือนกระจก</td>
                    <td>ton/ton/CO2e</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการกากของเสีย</td>
                    <td>Ton/ton</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr class="tr-head">
                    <td colspan="5">แฟกเตอร์ (X)</td>
                  </tr>
                  <tr>
                    <td>การจัดการวัตถุดิบ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการพลังงาน</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการน้ำและน้ำเสีย</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการมลภาวะทางอากาศ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การปล่อยก๊าซเรือนกระจก</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการกากของเสีย</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr class="tr-head">
                    <td colspan="5">แฟกเตอร์ (Loading)</td>
                  </tr>
                  <tr>
                    <td>การจัดการวัตถุดิบ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการพลังงาน</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการน้ำและน้ำเสีย</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการมลภาวะทางอากาศ</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การปล่อยก๊าซเรือนกระจก</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                  <tr>
                    <td>การจัดการกากของเสีย</td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                    <td width="10"><div class="form-group"><input class="form-control" type="text"></div></td>
                  </tr>
                </tbody>
              </table>

              </div>

              <div class="col-lg-12 text-left">
                  <div class="btn-box">
                      <a href="javascript:void(0);" class="btn btn-success btn-lg"><i class="fa fa-check"></i> คำนวนค่า Eco Efficiency</a>
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
