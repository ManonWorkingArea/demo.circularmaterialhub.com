<div class="page-content">
    <?php
    foreach ($data["meeting"] as $meeting)
    {
        echo "
        <div class='card card-style'>
            <div class='content content-calendar'>
                <p class='mb-n1 color-highlight font-600'>กำหนดการประชุมรับรอง Eco Factory " . (date("Y")+543) . "</p>
                <h1>{$meeting['meeting_round']}</h1>
            </div>
            <div class='cal-footer'>
                
                <div class='cal-schedule'>
                    <strong>วันประชุมรับรองฯ</strong>
                    <span><i class='fa fa-calendar'></i>{$meeting['meeting_date']} {$meeting['meeting_time']}</span>
                </div>
                <div class='cal-schedule'>
                    <strong>บริษัทส่งใบสมัครให้ฝ่ายเลขาฯ</strong>
                    <span><i class='fa fa-calendar'></i>{$meeting['meeting_document_submit']}</span>
                </div>
                <div class='cal-schedule'>
                    <strong>บริษัทชำระเงิน</strong>
                    <span><i class='fa fa-calendar'></i>{$meeting['meeting_payment']}</span>
                </div>
                <div class='cal-schedule'>
                    <strong>Auditorกำหนดส่งเอกสารเพื่อเข้ารับรอง</strong>
                    <span><i class='fa fa-calendar'></i>{$meeting['meeting_document_auditor']}</span>
                </div>

            </div>
        </div>";
    }
    ?>
</div>