<section class="breadcrumb-area about-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content about-breadcrumb-content">
                    <div class="section-heading">
                        <p class="section__meta section__metalight">Certification Process</p>
                        <h2 class="section__title"><?php echo $data["Post"]['post_name'];?></h2>
                    </div>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="about-area padding-top-20px padding-bottom-110px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <?php echo $data["Post"]['post_detail'];?>
            </div>
        </div><!-- end row -->
        <div class="about-widget-wrap choose-area margin-top-120px text-center">
            <div class="row">

                <div class="col-lg-12">
                  <div class="section-heading text-center">
                    <h5 class="section__meta">Certification Meeting Schedule</h5>
                    <h2 class="section__title">ตารางการประชุมรับรอง Eco Factory <?php echo (date('Y')+543);?></h2>
                    <span class="section-divider"></span>

                </div>
                </div>

                <div class="col-lg-12">
                  <table class="table">
                    <thead class="bg-primary">
                      <tr class="text-white">
                        <th scope="col">ครั้งที่</th>
                        <th scope="col">วันประชุมรับรอง</th>
                        <th scope="col">เวลา</th>
                        <th scope="col">บริษัทส่งใบสมัครให้ฝ่ายเลขาฯ</th>
                        <th scope="col">บริษัทชำระเงิน</th>
                        <th scope="col">Auditor กำหนดส่งเอกสารเพื่อเข้ารับรอง</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      foreach ($data["meeting"] as $meeting)
                      {
                        echo "
                        <tr>
                          <th scope='row'>{$meeting['meeting_round']}</th>
                          <td>{$meeting['meeting_date']}</td>
                          <td>{$meeting['meeting_time']}</td>
                          <td>{$meeting['meeting_document_submit']}</td>
                          <td>{$meeting['meeting_payment']}</td>
                          <td>{$meeting['meeting_document_auditor']}</td>
                        </tr>
                        ";
                      }
                      ?>
                      
                    </tbody>
                  </table>
                </div>

            </div><!-- end row -->
        </div><!-- end about-widget-wrap -->
    </div><!-- end container -->
</section>
