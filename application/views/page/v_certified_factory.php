<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">โรงงานที่ได้รับการรับรอง</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="home">หน้าหลัก</a></li>
                        <li class="active__list-item">ผู้ผ่านการรับรอง</li>
                        <li>โรงงานที่ได้รับการรับรอง</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="team-area section-padding">
    <div class="container">
      <div class="row margin-top-10px">
        <div class="col-lg-12 mx-auto">

          <h4 class="pb-5"><span class="la la-search input-icon"></span> ค้นหาข้อมูลรายชื่อโรงงานที่ได้รับการรับรอง</h4>

        </div>
        <div class="col-lg-12 mx-auto">
            <div class="card-box-shared">
                <div class="card-box-shared-body">
                    <div class="contact-form-action">
                        <form method="get" id="frm-factory-search">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">เลขทะเบียน โรงงานแบบเก่า</label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="factory_reg_code_old" id="factory_reg_code_old" placeholder="ระบุ เลขทะเบียน โรงงานแบบเก่า" value="">
                                            <span class="la la-search input-icon"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">เลขทะเบียน โรงงานแบบใหม่</label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="factory_reg_code_new" id="factory_reg_code_new" placeholder="ระบุ เลขทะเบียน โรงงานแบบใหม่" value="">
                                            <span class="la la-search input-icon"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">เลขที่สมาชิก ส.อ.ท</label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="factory_reg_code_fti" id="factory_reg_code_fti" placeholder="ระบุ เลขที่สมาชิก ส.อ.ท" value="">
                                            <span class="la la-search input-icon"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">ชื่อบริษัท</label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="factory_name" id="factory_name" placeholder="ระบุ ชื่อบริษัท" value="">
                                            <span class="la la-search input-icon"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">ปีที่ได้รับการรับรอง</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" name="factory_year" id="factory_year">
                                                    <option value="all">ทั้งหมด</option>
                                                    <?php 
                                                    foreach ($data["factory"]['year']['table'] as $factoryYear)
                                                    {
                                                        echo "<option value='{$factoryYear['factory_cert_year']}'>{$factoryYear['factory_cert_year']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                            <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">จังหวัด</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" name="factory_province" id="factory_province">
                                                    <option value="all">ทั้งหมด</option>
                                                    <?php 
                                                    foreach ($data["factory"]['province']['table'] as $factoryProvince)
                                                    {
                                                        echo "<option value='{$factoryProvince['factory_province']}'>{$factoryProvince['factory_province']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">ประเภทการประกอบกิจการ</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" name="factory_type" id="factory_type">
                                                    <option value="all">ทั้งหมด</option>
                                                    <?php 
                                                    foreach ($data["factory"]['type']['table'] as $factoryType)
                                                    {
                                                        echo "<option value='{$factoryType['factory_type']}'>{$factoryType['factory_type']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">พื้นที่</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" name="factory_area" id="factory_area">
                                                    <option value="all">ทั้งหมด</option>
                                                    <?php 
                                                    foreach ($data["factory"]['area']['table'] as $factoryArea)
                                                    {
                                                        echo "<option value='{$factoryArea['factory_area']}'>{$factoryArea['factory_area']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="input-box">
                                        <label class="label-text">นิคม/เขตประกอบการ/สวนอุตสาหกรรม</label>
                                        <div class="form-group">
                                            <div class="sort-ordering user-form-short">
                                                <select class="sort-ordering-select" name="factory_estate" id="factory_estate">
                                                    <option value="all">ทั้งหมด</option>
                                                    <?php 
                                                    foreach ($data["factory"]['estate']['table'] as $factoryEstate)
                                                    {
                                                        echo "<option value='{$factoryEstate['factory_estate']}'>{$factoryEstate['factory_estate']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                            </div>
                            <div class="row">

                                <div class="col-lg-12 text-left">
                                  <div class="btn-box">
                                      <button class="theme-btn" onclick="searchFactory();" type="button"><span class="la la-search input-icon"></span> ค้นหา</button>
                                      <button class="btn btn-default" type="button" onclick="page('page/view/certified_factory');"> เคลียร์ข้อมูล</button>
                                  </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="container">
    <div class="row">

        <div class="col-lg-12">
            <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                <nav class="mr-auto d-flex align-items-center" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="active breadcrumb-item" aria-current="page"><i class="mdi mdi-factory"></i></li>
                        <li class="active breadcrumb-item" aria-current="page">รายชื่อโรงงานที่ได้รับการรับรอง</li>
                    </ol>
                </nav>
                <div role="toolbar" class="btn-toolbar">
                  <div role="group" class="btn-group pr-2">
                      <button id="tooltipAddNew" class="align-self-center btn btn-success" onclick="exportExcel('data-table','รายชื่อโรงงานที่ได้รับการรับรอง')"><i class="mdi mdi-file-excel"></i> Download (Excel)</button>
                  </div>
                </div>
            </div>
            <div class="mb-3 Card_custom-card--border_5wJKy card">
                <div class="table-responsive-xl">
                    <table class="mb-0 table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th class="align-middle bt-0">ลำดับ</th>
                                <th class="align-middle bt-0" width="40%">ชื่อโรงงาน</th>
                                <th class="align-middle bt-0">สถานที่ตั้ง</th>
                                <th class="align-middle bt-0">ประเภทอุตสาหกรรม</th>
                                <th class="align-middle bt-0 text-right">สถานะใบรับรอง</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $order = $data["factory"]["Paging"]['order'];
                            foreach ($data["factory"]['table'] as $factory)
                            {
                              $order++;
                              if($factory['factory_first_app']=="yes"){
                                $first = "<span class='badge badge-success badge-pill'><i class='fa fa-check'></i> ครั้งแรก</span>";
                              }
                              else {
                                $first = "";
                              }
                              echo 
                              "
                                <tr>
                                    <td class='align-middle'>{$order}.</td>
                                    <td class='align-middle'>
                                        <span><strong>{$factory['factory_name']}</strong><br></span>
                                        <span>{$factory['factory_regcode']}</br>{$factory['factory_code']}</span>
                                    </td>
                                    <td class='align-middle'>
                                        <span>{$factory['factory_address']}<br></span>
                                        <span><strong>{$factory['factory_area']} {$factory['factory_estate']}</strong></span>
                                    </td>
                                    <td class='align-middle'>
                                        <span>{$factory['factory_type']}</span><span></span>
                                    </td>
                                    <td class='align-middle text-right'>
                                        {$first}
                                    </td>
                                </tr>";
                            }
                            ?>
                            <!-- <tr>
                              <td class="align-middle">1.</td>
                                <td class="align-middle">
                                    <span><strong>บริษัท แกรนด์ สยาม คอมโพสิต จำกัด (โรงงานที่ 1)</strong><br></span>
                                    <span>น.53(5)-1/2540-ญนพ.</br>001/2558</span>
                                </td>
                                <td class="align-middle">
                                    <span>เลขที่ 5 ถนนไอ-หนึ่ง ตำบลมาบตาพุด อำเภอเมือง จังหวัดระยอง 21150<br></span>
                                    <span><strong>ในนิคม มาบตาพุด</strong></span>
                                </td>
                                <td class="align-middle">
                                    <span>พลาสติก</span><span></span>
                                </td>
                                <td class="align-middle text-right">
                                  <span class="badge badge-success badge-pill"><i class="fa fa-check"></i> ครั้งแรก</span>
                                </td>
                            </tr>

                            <tr>
                              <td class="align-middle">2.</td>
                                <td class="align-middle">
                                    <span><strong>บริษัท แกรนด์ สยาม คอมโพสิต จำกัด (โรงงานที่ 2)</strong><br></span>
                                    <span>น.53(5)-1/2552-ญอล.</br>002/2558</span>
                                </td>
                                <td class="align-middle">
                                    <span>เลขที่ 88/7 ถนนทางหลวงหมายเลข 3191 ตำบลมาบตาพุด อำเภอเมือง  จังหวัดระยอง 21150<br></span>
                                    <span><strong>ในนิคม อาร์ไอแอล</strong></span>
                                </td>
                                <td class="align-middle">
                                    <span>พลาสติก</span><span></span>
                                </td>
                                <td class="align-middle text-right">
                                  <span class="badge badge-success badge-pill"><i class="fa fa-check"></i> ครั้งแรก</span>
                                </td>
                            </tr>

                            <tr>
                              <td class="align-middle">3.</td>
                                <td class="align-middle">
                                    <span><strong>บริษัท ดาว เคมิคอล ประเทศไทย จำกัด </strong><br></span>
                                    <span>น.53(5)-1/2540-ญนพ.</br>003/2558</span>
                                </td>
                                <td class="align-middle">
                                    <span>เลขที่ 10/4 หมู่ที่ 2 ตำบลบ้านฉาง อำเภอบ้านฉาง จังหวัดระยอง 21130<br></span>
                                    <span><strong>ในนิคม เอเซีย</strong></span>
                                </td>
                                <td class="align-middle">
                                    <span>เคมีภัณฑ์</span><span></span>
                                </td>
                                <td class="align-middle text-right">
                                  <span class="badge badge-success badge-pill"><i class="fa fa-check"></i> ครั้งแรก</span>
                                </td>
                            </tr> -->


                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center pb-3 card-footer">
                    <?php echo $data["factory"]["Paging"]['display'];?>
                </div>

                <?php // print_r($data["factory"]['query']);?>

            </div>


            <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                <nav class="mr-auto d-flex align-items-center" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="active breadcrumb-item" aria-current="page"><i class="mdi mdi-file-chart"></i></li>
                        <li class="active breadcrumb-item" aria-current="page">สรุปจำนวนใบรับรอง</li>
                    </ol>
                </nav>
                <div role="toolbar" class="btn-toolbar">
                  <div role="group" class="btn-group pr-2">
                      <button id="tooltipAddNew" class="align-self-center btn btn-success" onclick="exportExcel('data-table','รายชื่อโรงงานที่ได้รับการรับรอง')"><i class="mdi mdi-file-excel"></i> Download (Excel)</button>
                  </div>
                </div>
            </div>

            <!-- <div class="mb-3 Card_custom-card--border_5wJKy card">

              <div class="table-responsive-xl">

                  <table class="mb-0 table table-hover">
                      <thead>
                          <tr>
                              <th class="align-middle bt-0">จำแนกข้อมูลตาม</th>
                              <th class="align-middle bt-0">จำนวนใบรับรอง</th>
                              <th class="align-middle bt-0">จำนวนสถานประกอบการ</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td class="align-middle bt-0">ตำบล</td>
                            <td class="align-middle bt-0">1</td>
                            <td class="align-middle bt-0">1</td>
                          </tr>
                          <tr>
                            <td class="align-middle bt-0">อำเภอ</td>
                            <td class="align-middle bt-0">1</td>
                            <td class="align-middle bt-0">1</td>
                          </tr>
                          <tr>
                            <td class="align-middle bt-0">จังหวัด</td>
                            <td class="align-middle bt-0">1</td>
                            <td class="align-middle bt-0">1</td>
                          </tr>
                      </tbody>
                  </table>
              </div>
            </div> -->

        </div>
    </div>
</div>
</section>

<div class="subscriber-area call-to-action padding-top-40px padding-bottom-40px">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="call-to-action-heading d-flex align-items-center">
                    <div class="call-to-action-icon">
                        <svg viewBox="0 -48 496 496" xmlns="http://www.w3.org/2000/svg"><path d="m472 0h-448c-13.230469 0-24 10.769531-24 24v352c0 13.230469 10.769531 24 24 24h448c13.230469 0 24-10.769531 24-24v-352c0-13.230469-10.769531-24-24-24zm8 376c0 4.414062-3.59375 8-8 8h-448c-4.40625 0-8-3.585938-8-8v-352c0-4.40625 3.59375-8 8-8h448c4.40625 0 8 3.59375 8 8zm0 0"></path><path d="m448 32h-400v240h400zm-16 224h-368v-208h368zm0 0"></path><path d="m328 200.136719c0-17.761719-11.929688-33.578125-29.007812-38.464844l-26.992188-7.703125v-2.128906c9.96875-7.511719 16-19.328125 16-31.832032v-14.335937c0-21.503906-16.007812-39.726563-36.449219-41.503906-11.183593-.96875-22.34375 2.800781-30.574219 10.351562-8.25 7.550781-12.976562 18.304688-12.976562 29.480469v16c0 12.503906 6.03125 24.328125 16 31.832031v2.128907l-26.992188 7.710937c-17.078124 4.886719-29.007812 20.703125-29.007812 38.464844v39.863281h160zm-16 23.863281h-128v-23.863281c0-10.664063 7.160156-20.152344 17.40625-23.082031l38.59375-11.023438v-23.070312l-3.976562-2.3125c-7.527344-4.382813-12.023438-12.105469-12.023438-20.648438v-16c0-6.703125 2.839844-13.160156 7.792969-17.695312 5.007812-4.601563 11.496093-6.832032 18.382812-6.207032 12.230469 1.0625 21.824219 12.285156 21.824219 25.566406v14.335938c0 8.542969-4.496094 16.265625-12.023438 20.648438l-3.976562 2.3125v23.070312l38.59375 11.023438c10.246094 2.9375 17.40625 12.425781 17.40625 23.082031zm0 0"></path><path d="m32 364.945312 73.886719-36.945312-73.886719-36.945312zm16-48 22.113281 11.054688-22.113281 11.054688zm0 0"></path><path d="m152 288h16v80h-16zm0 0"></path><path d="m120 288h16v80h-16zm0 0"></path><path d="m336 288h-48v32h-104v16h104v32h48v-32h128v-16h-128zm-16 64h-16v-48h16zm0 0"></path></svg>
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-20 pb-1">เข้าร่วมเป็นส่วนหนึ่งของทีมงานคุณภาพของเรา</h2>
                        <!-- <p class="section__desc mb-0">สร้างหลักสูตรวิดีโอออนไลน์เข้าถึงนักเรียนทั่วโลกและสร้างรายได้</p> -->
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="btn-box text-right">
                    <a href="app/create/eZ2tJbrAQmVxa9hm515FSAY0eQLKcV" class="theme-btn">ตรวจประเมินมาตรฐานโรงงานห</a>
                </div><!-- end btn-box-->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</div>
