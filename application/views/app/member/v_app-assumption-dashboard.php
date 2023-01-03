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

          <div class="row triangle-area">

            <div class="col-md-9">

                <div class="row">
                  <div class="col-md-12">
                    <div class="triangle">
                      <div class="text">การพัฒนาที่ยั่งยืน</br>(Sustainable Development)</div>
                    </div>
                  </div>

                  <!-- <div class="col-md-12">
                    <div class="top-topic">
                      <div class="text" onclick="page('app/assumption/general');">1.ข้อกำหนดทั่วไป (General requirements)</div>
                    </div>
                  </div> -->

                  <div class="col-md-6">
                    <div class="top-head">
                      <div class="text" onclick="page('app/assumption/continual-calculator');">ประสิทธิภาพเชิงเศรษฐนิเวศ </br>(Eco Efficiency)</div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="top-head" style="padding-right: 10px;">
                      <div class="text" onclick="page('app/assumption/continual');">การประเมินตามตัวชี้วัดทางด้านสังคม </br>(Outcome/Impact Evaluation)</div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <!-- <div class="col-md-12">
                    <div class="top-head">
                      <div class="text">ข้อกำหนดเฉพาะของมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ (Specific requirements for Eco factory)</div>
                    </div>
                  </div> -->
                  <div class="col-md-6">
                    <div class="row no-gutters">
                      <div class="col-md-6">
                        <div class="main-topic">
                          <div class="text" onclick="page('app/assumption/specific/1');">1. การจัดการวัตถุดิบ</div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/2');">2. การจัดการพลังงาน</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic">
                        <div class="text" onclick="page('app/assumption/specific/3');">3. การจัดการน้ำและน้ำเสีย</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/4');">4. การจัดการมลภาวะทางอากาศ</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic">
                        <div class="text" onclick="page('app/assumption/specific/5');">5. การจัดการก๊าซเรือนกระจก</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/6');">6. การจัดการของเสีย</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic">
                        <div class="text" onclick="page('app/assumption/specific/7');">7. การจัดการสารเคมีและวัตถุอันตราย</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/8');">8. การจัดการสุขภาพและความปลอดภัยในการทำงาน</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic">
                        <div class="text" onclick="page('app/assumption/specific/9');">9. การจัดการระบบขนส่งและโลจิสติกส์</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/10');">10. การจัดการโซ่อุปทานสีเขียว</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic">
                        <div class="text" onclick="page('app/assumption/specific/11');">11. การจัดการภูมิทัศน์สีเขียว</div></div></div>
                      <div class="col-md-6">
                        <div class="main-topic main-topic-left">
                        <div class="text" onclick="page('app/assumption/specific/12');">12. การจัดการความหลากหลายทางชีวภาพ</div></div></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row no-gutters">
                      <div class="col-md-12">
                        <div class="sub-topic" style="padding-right: 10px;">
                          <div class="text" onclick="page('app/assumption/specific/13');">
                            13. การกระจายรายได้ให้กับชุมชน
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="sub-topic" style="padding-right: 10px;">
                          <div class="text" onclick="page('app/assumption/specific/14');">
                            14. การอยู่ร่วมกับชุมชนโดยรอบ
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12"><div class="footer-topic"><div class="text bg1" onclick="page('app/assumption/general');">อุตสาหกรรมสีเขียวระดับ 3 หรือ ISO 14001 และไม่มีข้อร้องเรียน 1 ปี (โรงงานขนาดใหญ่)</div></div></div>
                  <div class="col-md-12"><div class="footer-topic"><div class="text bg2" onclick="page('app/assumption/general');"s>อุตสาหกรรมสีเขียวระดับ 2 หรือ ธงขาวดาวเขียว และไม่มีข้อร้องเรียน 1 ปี (โรงงานขนาดกลางและขนาดย่อม)</div></div></div>
                </div>

              </div>


              <div class="col-md-3" style="margin-top: 160px;">
                <div class="card-box-shared text-left">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">แบบประเมินตนเอง</h3>
                    </div>
                    <div class="card-box-shared-body">
                      <div class="recent-item">
                          <div class="recentpost-body">
                              <h4 class="recent__link">
                                  <a href="app/assumption/continual">ข้อกำหนดเฉพาะ Continual improvement</a>
                              </h4>
                          </div><!-- end recent-img -->
                      </div>
                      <div class="recent-item">
                          <div class="recentpost-body">
                              <h4 class="recent__link">
                                  <a href="app/assumption/specific/1">ข้อกำหนดเฉพาะ Specific requirements</a>
                              </h4>
                          </div><!-- end recent-img -->
                      </div>

                      <div class="recent-item">
                          <div class="recentpost-body">
                              <h4 class="recent__link">
                                  <a href="app/assumption/general">ข้อกำหนดทั่วไป General requirements</a>
                              </h4>
                          </div><!-- end recent-img -->
                      </div>

                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->

            </div><!-- end col-lg-5 -->

          </div>
        </div>
    </div>
</section>

<script>

$(document).ready(function()
{
  //----------------------------------------------------------------------------
  // TOPIC 1
  var ap_token    = localStorage.getItem("ap_token");
  var formset     = localStorage.getItem("formset");
  var user_token  = localStorage.getItem("user_token");

  if (ap_token === null)
  {
    localStorage.setItem("ap_token", "<?php echo $_SESSION["AppData"]['ap_token'];?>");
    localStorage.setItem("formset", "<?php echo $_SESSION["AppData"]['formset'];?>");
    localStorage.setItem("user_token", "<?php echo $_SESSION["AppData"]['user_token'];?>");
  }
});

</script>
