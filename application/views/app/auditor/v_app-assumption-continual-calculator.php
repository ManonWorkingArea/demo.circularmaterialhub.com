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

            <div class="row padding-top-20px">

            <div class="col-md-12">

              <h3 class="highcharts-title">การคำนวณเทียบต่อยอดขาย</h3>

              <table class="table table-bordered text-center continual-calculator">
                <thead class="thead-head">
                  <tr>
                    <th colspan="2" rowspan="2">รายละเอียด</th>
                    <th rowspan="2">หน่วย</th>
                    <th colspan="3">ปี</th>
                  </tr>
                  <tr>
                    <th width="15%" class="base-year-1">...</th>
                    <th width="15%" class="base-year-2">...</th>
                    <th width="15%" class="base-year-3">...</th>
                  </tr>
                </thead>
                <tbody  class="">
                  <tr class="tr-head text-left table-tr-bg">
                    <td colspan="6"><strong>ข้อมูลที่นำมาใช้ประเมิน</strong></td>
                  </tr>

                  <tr class="">
                    <td class="text-left">ปริมาณการผลิตผลิตภัณฑ์</td>
                    <td class="text-left">Production Volume </td>
                    <td class="text-center">ton Product</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="production_volume" data-year="2020" value="500000000"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="production_volume" data-year="2021" value="650000000"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="production_volume" data-year="2022" value="780000000"></div></td>
                  </tr>

                  <tr class="">
                    <td class="text-left">ปริมาณการใช้วัตถุดิบ</td>
                    <td class="text-left"><strong>Raw material</strong></td>
                    <td class="text-center">ton</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="raw_material" data-year="2020" value="300"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="raw_material" data-year="2021" value="300"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="raw_material" data-year="2022" value="300"></div></td>
                  </tr>
                  <tr>
                    <td class="text-left">ปริมาณการใช้พลังงาน</td>
                    <td class="text-left"><strong>Energy usage</strong></td>
                    <td class="text-center">MJ</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="energy_usage" data-year="2020" value="200"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="energy_usage" data-year="2021" value="220"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="energy_usage" data-year="2022" value="250"></div></td>
                  </tr>
                  <tr>
                    <td class="text-left">ปริมาณการใช้น้ำ</td>
                    <td class="text-left"><strong>Water consumption</strong></td>
                    <td class="text-center">m3</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="water_consumption" data-year="2020" value="200"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="water_consumption" data-year="2021" value="200"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="water_consumption" data-year="2022" value="200"></div></td>
                  </tr>
                  <tr>
                    <td class="text-left">ปริมาณมลภาวะทางอากาศ</td>
                    <td class="text-left"><strong>Air Pollution</strong></td>
                    <td class="text-center">g/s</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="air_pollution" data-year="2020" value="30"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="air_pollution" data-year="2021" value="30"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="air_pollution" data-year="2022" value="30"></div></td>
                  </tr>
                  <tr>
                    <td class="text-left">ปริมาณการปล่อยก๊าซเรือนกระจก</td>
                    <td class="text-left"><strong>GHG emission</strong></td>
                    <td class="text-center">ton CO2e</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="ghg_emission" data-year="2020" value="1000"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="ghg_emission" data-year="2021" value="800"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="ghg_emission" data-year="2022" value="700"></div></td>
                  </tr>
                  <tr>
                    <td class="text-left">ปริมาณกากของเสีย</td>
                    <td class="text-left"><strong>waste generation (Haz&Non Haz)</strong></td>
                    <td class="text-center">ton</td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="waste_generation" data-year="2020" value="100"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="waste_generation" data-year="2021" value="90"></div></td>
                    <td><div class="form-group"><input class="form-control calculator-input" type="text" data-name="waste_generation" data-year="2022" value="80"></div></td>
                  </tr>
                </tbody>
              </table>

              </div>

              <div class="col-md-12">

                <h3 class="highcharts-title">ค่าประสิทธิภาพเชิงเศรษฐนิเวศและแฟคเตอร์ (X)</h3>

                <table class="table table-bordered text-center continual-calculator">
                  <thead class="thead-head">
                    <tr>
                      <th colspan="2" rowspan="2">รายละเอียด</th>
                      <th rowspan="2">หน่วย</th>
                      <th colspan="3">ปี</th>
                    </tr>
                    <tr>
                      <th width="15%" class="base-year-1">...</th>
                      <th width="15%" class="base-year-2">...</th>
                      <th width="15%" class="base-year-3">...</th>
                    </tr>
                  </thead>
                  <tbody  class="">

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>Raw material</strong></td>
                      <td class="text-center text-primary">ton product/ton</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_raw_material" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_raw_material" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_raw_material" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_raw_material" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_raw_material" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_raw_material" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>Energy usage</strong></td>
                      <td class="text-center text-primary">ton product/kwh</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_energy_usage" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_energy_usage" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_energy_usage" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_energy_usage" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_energy_usage" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_energy_usage" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>Water consumption </td>
                      <td class="text-center text-primary">ton product/m3</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_water_consumption" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_water_consumption" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_water_consumption" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_water_consumption" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_water_consumption" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_water_consumption" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>Air Pollution</strong></td>
                      <td class="text-center text-primary"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_air_pollution" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_air_pollution" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_air_pollution" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_air_pollution" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_air_pollution" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_air_pollution" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>GHG emission</strong></td>
                      <td class="text-center text-primary">ton product/tonCO2</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_ghg_emission" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_ghg_emission" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_ghg_emission" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_ghg_emission" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_ghg_emission" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_ghg_emission" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>eco efficiency </strong></td>
                      <td class="text-left text-primary"><strong>waste generation (Haz&Non Haz)</strong></td>
                      <td class="text-center text-primary">ton product/ton</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_waste_generation" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_waste_generation" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_waste_generation" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_waste_generation" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_waste_generation" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="eco_efficiency_base_waste_generation" data-year="2022" placeholder="0"></div></td>
                    </tr>

                  </tbody>
                </table>

              </div>

              <div class="col-md-12">

                <h3 class="highcharts-title">ค่าประเมินนผลกระทบต่อสิ่งแวดล้อมและแฟคเตอร์ (X)</h3>

                <table class="table table-bordered text-center continual-calculator">
                  <thead class="thead-head">
                    <tr>
                      <th colspan="2" rowspan="2">รายละเอียด</th>
                      <th rowspan="2">หน่วย</th>
                      <th colspan="3">ปี</th>
                    </tr>
                    <tr>
                      <th width="15%" class="base-year-1">...</th>
                      <th width="15%" class="base-year-2">...</th>
                      <th width="15%" class="base-year-3">...</th>
                    </tr>
                  </thead>
                  <tbody  class="">

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td>
                      <td class="text-left text-primary"><strong>Raw material</strong></td>
                      <td class="text-center text-primary">ton/ton product</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_raw_material" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_raw_material" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_raw_material" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_raw_material" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_raw_material" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_raw_material" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td>
                      <td class="text-left text-primary"><strong>Energy usage</strong></td>
                      <td class="text-center text-primary">ton/Mton product</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_energy_usage" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_energy_usage" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_energy_usage" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_energy_usage" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_energy_usage" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_energy_usage" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td>
                      <td class="text-left text-primary"><strong>Water consumption </td>
                      <td class="text-center text-primary">ton/ton product</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_water_consumption" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_water_consumption" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_water_consumption" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_water_consumption" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_water_consumption" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_water_consumption" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td>
                      <td class="text-left text-primary"><strong>Air Pollution</strong></td>
                      <td class="text-center text-primary"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_air_pollution" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_air_pollution" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_air_pollution" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_air_pollution" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_air_pollution" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_air_pollution" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td> 
                      <td class="text-left text-primary"><strong>GHG emission</strong></td>
                      <td class="text-center text-primary">tonCo2/ton product</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_ghg_emission" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_ghg_emission" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_ghg_emission" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_ghg_emission" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_ghg_emission" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_ghg_emission" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="table-tr-bg">
                      <td class="text-left text-danger"><strong>environment load point</strong></td>
                      <td class="text-left text-primary"><strong>waste generation (Haz&Non Haz)</strong></td>
                      <td class="text-center text-primary">ton/ton product</td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_waste_generation" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_waste_generation" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_waste_generation" data-year="2022" placeholder="0"></div></td>
                    </tr>

                    <tr class="">
                      <td class="text-left text-mute">Faxtor X</td>
                      <td class="text-left text-mute">base year (2020)</td>
                      <td class="text-center"></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_waste_generation" data-year="2020" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_waste_generation" data-year="2021" placeholder="0"></div></td>
                      <td><div class="form-group"><input class="form-control form-control-value calculator-input" type="text" data-name="load_point_base_waste_generation" data-year="2022" placeholder="0"></div></td>
                    </tr>

                  </tbody>
                </table>

              </div>

              <div class="col-lg-12 text-left" style="float: left;margin-bottom: 15px;">
                  <div class="btn-box">
                      <a href="javascript:void(0);" class="btn btn-success btn-lg" onclick="ecoefficiencyCal();"><i class="fa fa-check"></i> คำนวนค่า Eco Efficiency</a>
                      <a href="javascript:void(0);" class="btn btn-success btn-lg" onclick="ecoefficiencyCal();"><i class="fa fa-save"></i> บันทึกข้อมูล</a>
                  </div>
              </div>

              <div class="col-md-12 chart-area">
                <h3 class="highcharts-title">Base year <span class="base-year-text">....</span></h3>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_raw_material" class="highcharts-box"></div>
                </figure>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_energy_usage" class="highcharts-box"></div>
                </figure>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_water_consumption" class="highcharts-box"></div>
                </figure>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_air_pollution" class="highcharts-box"></div>
                </figure>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_ghg_emission" class="highcharts-box"></div>
                </figure>
              </div>

              <div class="col-md-6 chart-area">
                <figure class="highcharts-figure">
                    <div id="chart_waste_generation" class="highcharts-box"></div>
                </figure>
              </div>

            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.7/jquery.inputmask.min.js" integrity="sha512-x3zoB6e8YsZipoDoCTClRYkEpqucilZ8IYsaJFE0XUtUJQdO7v2xFzvd1zQKrb3ParCNpvdAE0C85msCw3NrLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<style>

.text-mute
{
  color: #898989;
}

.form-group {
  margin-bottom:0;
  border-radius: 0;
}

.form-control {
  border-radius: 0;
}

.form-control-value {
  border-radius: 0;
  border: 0px;
  background: transparent;
  pointer-events:none;
  text-align: center;
}

.table-tr-bg {
  background: #f5f5f5;
}

.table thead th {
  vertical-align: middle;
  border: 1px solid #dfdfdf;
  background: #ebfff2;
}

.highcharts-box {
  border: #e5e5e5 solid 1px;
}

.highcharts-title {
  font-size: 20px;
  color: #5e3400;
  background: #ffc107;
  padding: 10px;
  margin-bottom: 20px;
}

.highcharts-figure,
.highcharts-data-table table {
  min-width: 360px;
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}

</style>

<script>

var yearArray         = ["2020","2021","2022"];
var itemArray         = ["raw_material","energy_usage","water_consumption","air_pollution","ghg_emission","waste_generation"];
var base              = yearArray[0];
var arrayLength       = yearArray.length;
var itemarrayLength   = itemArray.length;

$(document).ready(function()
{
  for (var i = 0; i < arrayLength; i++) 
  {
    year = yearArray[i];
    $(".base-year-" + (i+1)).html(year);
  }

  $(".base-year-text").html(base);
  $('.chart-area').hide();
});

function ecoefficiencyCal()
{
  for (var i = 0; i < arrayLength; i++) 
  {
    year = yearArray[i];
    $(".base-year-" + (i+1)).html(year);

    for (var x = 0; x < itemarrayLength; x++) 
    {
      item = itemArray[x];
      calculatorItem(item,base,year);
    }
  }

  function calculatorItem(item,base,year)
  {
    var production_volume                 = $("input[data-name=production_volume][data-year='" + year + "']").val()
    var eco_efficiency                    = $("input[data-name=" + item + "][data-year='" + year + "']").val()

    var eco_efficiency_raw_material       = production_volume/eco_efficiency

    $("input[data-name=eco_efficiency_" + item + "][data-year='" + year + "']").val(addZeroes(eco_efficiency_raw_material))

    var eco_efficiency_base               = $("input[data-name=eco_efficiency_" + item + "][data-year='" + base + "']").val()
    
    if(year==base)
    {
      var eco_efficiency_base_raw_material  = eco_efficiency_base/eco_efficiency_base
      console.log(year + " : " + eco_efficiency_base + "/ base : " + base + " : " + eco_efficiency_base)
    }
    else
    {
      var eco_efficiency_base_raw_material  = eco_efficiency_raw_material/eco_efficiency_base
      console.log(year + " : " + eco_efficiency_raw_material + "/ base : " + base + " : " + eco_efficiency_base)
    }
    
    $("input[data-name=eco_efficiency_base_" + item + "][data-year='" + year + "']").val(eco_efficiency_base_raw_material)

    var load_point_raw_material = eco_efficiency/production_volume

    console.log("load_point_raw_material : " + load_point_raw_material);

    $("input[data-name=load_point_" + item + "][data-year='" + year + "']").val(load_point_raw_material)

    var eco_efficiency_load_point_base   = $("input[data-name=load_point_" + item + "][data-year='" + base + "']").val()
    
    if(year==base)
    {
      var load_point_base_raw_material  = eco_efficiency_load_point_base/eco_efficiency_load_point_base
    }
    else
    {
      var load_point_base_raw_material  = load_point_raw_material/eco_efficiency_load_point_base
    }

    $("input[data-name=load_point_base_" + item + "][data-year='" + year + "']").val(load_point_base_raw_material)

    // RAW MASTER DATA INPUT
    //
    eco_efficiency_2020       = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2020']").val();
    eco_efficiency_2021       = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2021']").val();
    eco_efficiency_2022       = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2022']").val();

    loadpoint_2020            = $("input[data-name=load_point_base_" + item + "][data-year='2020']").val();
    loadpoint_2021            = $("input[data-name=load_point_base_" + item + "][data-year='2021']").val();
    loadpoint_2022            = $("input[data-name=load_point_base_" + item + "][data-year='2022']").val();

    // RE-FORMAT INPUT DATA
    //
    data_eco_efficiency_2020  = addZeroes(eco_efficiency_2020);
    data_eco_efficiency_2021  = addZeroes(eco_efficiency_2021);
    data_eco_efficiency_2022  = addZeroes(eco_efficiency_2022);

    data_loadpoint_2020       = addZeroes(loadpoint_2020);
    data_loadpoint_2021       = addZeroes(loadpoint_2021);
    data_loadpoint_2022       = addZeroes(loadpoint_2022);

    // RESET MASTER DATA INPUT
    //
    $("input[data-name=eco_efficiency_base_" + item + "][data-year='2020']").val(data_eco_efficiency_2020);
    $("input[data-name=eco_efficiency_base_" + item + "][data-year='2021']").val(data_eco_efficiency_2021);
    $("input[data-name=eco_efficiency_base_" + item + "][data-year='2022']").val(data_eco_efficiency_2022);

    $("input[data-name=load_point_base_" + item + "][data-year='2020']").val(data_loadpoint_2020);
    $("input[data-name=load_point_base_" + item + "][data-year='2021']").val(data_loadpoint_2021);
    $("input[data-name=load_point_base_" + item + "][data-year='2022']").val(data_loadpoint_2022);

    // RAW MASTER DATA INPUT
    //
    eco_efficiency_2020           = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2020']").val();
    eco_efficiency_2021           = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2021']").val();
    eco_efficiency_2022           = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2022']").val();

    loadpoint_2020                = $("input[data-name=load_point_base_" + item + "][data-year='2020']").val();
    loadpoint_2021                = $("input[data-name=load_point_base_" + item + "][data-year='2021']").val();
    loadpoint_2022                = $("input[data-name=load_point_base_" + item + "][data-year='2022']").val();

    var data_eco_efficiency_2020  = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2020']").val();
    var data_eco_efficiency_2021  = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2021']").val();
    var data_eco_efficiency_2022  = $("input[data-name=eco_efficiency_base_" + item + "][data-year='2022']").val();

    var data_loadpoint_2020       = $("input[data-name=load_point_base_" + item + "][data-year='2020']").val();
    var data_loadpoint_2021       = $("input[data-name=load_point_base_" + item + "][data-year='2021']").val();
    var data_loadpoint_2022       = $("input[data-name=load_point_base_" + item + "][data-year='2022']").val();

    chartTitle = item.replace(/_/g, " ");
    chartTitle = capitalize(chartTitle)  // => "Alfredo"

    Highcharts.chart("chart_" + item, 
    {
      chart: {
        type: 'line'
      },
      title: {
        text: chartTitle
      },
      credits: {
        enabled: false
      },
      xAxis: 
      {
        categories: yearArray,
        title: {
            text: 'Year Range'
        }
      },
      yAxis: {
        title: {
            text: 'Requirements Values'
        }
      },
      plotOptions: 
      {
        line: 
        {
          dataLabels: 
          {
            enabled: true
          },
          enableMouseTracking: false
        }
      },
      responsive: 
      {
        rules: [{
            condition: 
            {
                maxWidth: 500
            },
            chartOptions: 
            {
              legend: 
              {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
        }]
      },
      series: [
      {
        color: '#007bff',
        name: 'eco efficiency',
        data: [Number(data_eco_efficiency_2020), Number(data_eco_efficiency_2021), Number(data_eco_efficiency_2022)]
      },
      {
        color: '#F08080',
        name: 'environment load point',
        data: [Number(data_loadpoint_2020), Number(data_loadpoint_2021), Number(data_loadpoint_2022)]
      }]
    });
  }
  //console.log("ecoefficiencyCal");
  $('.chart-area').show();
}

// The function
function addZeroes(num) 
{
  num = Number(num).toFixed(2)
  const dec = num.split('.')[1]
  const len = dec && dec.length > 2 ? dec.length : 2
  return Number(num).toFixed(len)
}

function capitalize(string) {
  return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}

</script>