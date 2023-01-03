<?php
// FORM CONFIG ---------------------------------------
$member_id       = $data["Application"]['member_id'];
$form_id         = $data["Application"]['ap_form'];
$app_id          = $data["Application"]['app_id'];
$ap_id           = $data["Application"]['ap_id'];
$ap_token        = $data["Application"]['ap_token'];
$set_id          = $data["FormSetRow"]['set_id'];
$first           = $data["FormSetRow"]['first'];
?>

<section class="breadcrumb-area my-courses-bread application-form">

    <div class="topbar-control">
      <div class="container">
        <div class="col-md-12">
          <div class="topbar-nav">
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current">ข้อความ</span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title"><i class="fa fa-edit"></i>  <?php echo $data["Detail"]['app_name']?></h2>
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2">
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
                    <h2 class="section__title">ข้อความทั้งหมด <div class="float-right"><button type="button" class="btn btn-default" onclick="page('app/detail/<?php echo $ap_token?>');"><i class="fa fa-edit"></i> ย้อนกลับ</button></div></h2>
                    
                </div>
            </div>
        </div>

        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <div class="row">
                            
                                <div class="col-lg-12">
                                    <div class="profile-detail pb-5">

                                        <div class="form-detail-name">
                                            ข้อความที่เกี่ยวข้องกับใบสมัคร<br><small><?php echo $data["Detail"]['app_name']?></small>
                                        </div>

                                        <table class="table table-striped table-sm table-hover" id="message-table" data-app="<?php echo $ap_id;?>" data-member="<?php echo $member_id;?>">
                                            <tbody>
                                                <tr>
                                                    <th>หัวข้อ</th>
                                                    <th>ผู้ส่ง</th>
                                                    <th>วันที่ส่ง</th>
                                                    <th>สถานะ</th>
                                                    <th>#</th>
                                                </tr>

                                                <?php
                                                foreach ($data["Message"]['table'] as $Message)
                                                {
                                                    echo "
                                                    <tr>
                                                        <td>{$Message['subject']}</td>
                                                        <td>{$Message['sender_name']}</td>
                                                        <td>{$Message['createAt']}</td>
                                                        <td>{$Message['status']}</td>
                                                        <td width='15%'>
                                                        <button class='btn btn-sm' aria-label='ลบรายชื่อ' data-microtip-position='top' role='tooltip' onclick='deleteRelate(\"{$Message['token']}\");'><i class='far fa-trash-alt'></i></button>
                                                        <button class='btn btn-sm' onclick='openMessage(\"{$Message['token']}\");'><i class='fa fa-eye'></i> ดูข้อความ</button>
                                                        </td>
                                                    </tr>
                                                    ";
                                                }
                                                ?>
                                    
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->


    </div><!-- end container -->
</section>