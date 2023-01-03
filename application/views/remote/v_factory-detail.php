<div class="page-content">

    <div class="card rounded-0 bg-rule-5" data-card-height="450">
        <div class="card-bottom pl-3 pb-4">
            <h1 class="color-white font-24 mb-n1">
            <?php echo $data["Factory"]['factory_name']?>
            </h1>
            <p class="color-white font-14 opacity-50">
                รายละเอียดโรงงานที่ผ่านการรับรอง
            </p>
        </div>
        <div class="card-top mt-3 pb-5 pl-3">
            <a href="#" data-back-button class="icon icon-s bg-theme rounded-xl float-left mr-3"><i class="fa color-theme fa-arrow-left"></i></a>
        </div>
        <div class="card-overlay bg-gradient"></div>
    </div>

    <div class="card card-style">
        <div class="content">
            <p class="mb-n1 color-highlight font-600"><?php echo $data["Factory"]['factory_regcode']?></p>

            <h1>
            <?php echo $data["Factory"]['factory_type']?>
            </h1>

            <h4>วันรับรอง</h4>
            <p>
            <?php echo $data["Factory"]['factory_cert_date']?>
            </p>

            <h4>วันสิ้นอายุ</h4>
            <p>
            <?php echo $data["Factory"]['factory_expire_date']?>
            </p>

        </div>
    </div>

</div>