<div class="page-content">
    <div class="tab-controls mr-3 ml-3 tabs-round tab-animated tabs-medium tabs-rounded clearfix shadow-xl mb-4"
        data-tab-items="1"
        data-tab-active="bg-highlight activated color-white">
        <a href="#" class="font-12" data-tab-active data-tab="tab-1">หลักสูตร</a>
    </div>

    <div class="tab-content" id="tab-1">

        <?php

        foreach ($data["Course"]['lesson'] as $Lesson)
        {
        $detail 	= engine::shorttext($Lesson['post_detail'], 100);
        $date 	  = engine::thaidate($Lesson['post_adddate']);

        if($Lesson['lesson_sale_price']=="0")
        {
            $price = "เรียนฟรี";
        }
        else
        {
            $price = $Lesson['lesson_sale_price'];
        }

        if($Lesson['lesson_counter']==""||$Lesson['lesson_counter']==NULL)
        {
            $visitor = "0";
        }
        else
        {
            $visitor = $Lesson['lesson_counter'];
        }
        
        $detail = $Lesson['lesson_short_detail'];

        echo
        "
        <div class='card card-style'>
            <div class='card rounded-0 mb-0' data-card-height='250' style='background-image: url(https://{$Lesson['school_s3_url']}/{$Lesson['school_s3_bucket']}/{$Lesson['lesson_cover']});'>
                <div class='card-top pr-3 pt-3'>
                    <h1 class='color-white text-right'>{$price}</h1>
                    <p class='color-white opacity-50 text-right font-10 mt-n3'>Lifetime Access</p>
                </div>
            </div>
            <div class='content'>
                <p class='mb-n1 color-highlight font-600'>บทเรียนออนไลน์</p>
                <h1>{$Lesson['lesson_name']}</h1>
                <p class='opacity-60 text-uppercase font-10 mt-n2 font-600 mb-1'>เนื้อหา {$Lesson['count']} บท | เวลา {$Lesson['duration']} ชม.</p>

                <p>
                {$detail}
                </p>

                <div class='d-flex'>
                    <div class='mr-auto'>
                        <div class='list-group list-custom-large mt-n3'>
                            <a href='remote/course/{$Lesson['lesson_code']}' class='border-0'>
                                <span>{$Lesson['teacher_name']}</span>
                                <strong>ผู้บรรยาย/วิทยากร</strong>
                            </a>
                        </div>
                    </div>
                    <div>
                        <a href='remote/course/{$Lesson['lesson_code']}' class='btn btn-full btn-s font-600 rounded-s gradient-highlight mt-1 float-left '>ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
        </div>";
        }

        ?>

        <div class="divider divider-margins"></div>

    </div>

    <div class="tab-content" id="tab-2">
        <div class="card card-style">
            <div class="content">
                <h1>หลักสูตรวอเตอร์ฟุตปรินต์ 1</h1>
                <span class="badge bg-highlight mb-3 p-1">PREMIUM</span>
                <span class="badge bg-highlight mb-3 p-1">1 Hour 40 Minutes</span>
                <h5 class="font-13 opacity-30 line-height-s mb-4">สมิติเวชไอซ์จีดีพีเวิร์กช็อปด็อกเตอร์ รุสโซชนะเลิศสปอตซิ่งเพียบแปร้ สแตนเลส ยากูซ่าไนน์จิตเภท อพาร์ทเมนท์สหัสวรรษ ซิ่งชัตเตอร์สตีลเฟรม โปลิศ ทับซ้อนพรีเมียมแอ็คชั่น</h5>
                <div class="row mb-0">
                    <div class="col-8">
                        <p class="font-600 mb-0 font-10 color-highlight">80% Complete</p>
                        <div class="progress" style="height:10px;">
                            <div class="progress-bar border-0 bg-highlight text-left pl-2"
                                    role="progressbar" style="width: 80%"
                                    aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="#" class="btn btn-full btn-s font-600 font-12 rounded-s gradient-highlight">เข้าเรียน</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-style">
            <div class="content">
                <h4 class="mb-2">หลักสูตรวอเตอร์ฟุตปรินต์ 2</h4>
                <span class="badge bg-red-dark mb-3 p-1">PREMIUM</span>
                <span class="badge bg-red-dark mb-3 p-1">2 Hours</span>
                <h5 class="font-13 opacity-30 line-height-s mb-4">สมิติเวชไอซ์จีดีพีเวิร์กช็อปด็อกเตอร์ รุสโซชนะเลิศสปอตซิ่งเพียบแปร้ สแตนเลส ยากูซ่าไนน์จิตเภท อพาร์ทเมนท์สหัสวรรษ ซิ่งชัตเตอร์สตีลเฟรม โปลิศ ทับซ้อนพรีเมียมแอ็คชั่น</h5>
                <div class="row mb-0">
                    <div class="col-8">
                        <p class="font-600 mb-0 font-10 color-red-dark">50% Complete</p>
                        <div class="progress" style="height:10px;">
                            <div class="progress-bar border-0 gradient-red text-left pl-2"
                                    role="progressbar" style="width: 50%"
                                    aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="#" class="btn btn-full btn-s font-600 font-12 rounded-s gradient-red">เข้าเรียน</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-style">
            <div class="content">
                <h2 class="mb-2">หลักสูตรวอเตอร์ฟุตปรินต์ 3</h2>
                <span class="badge bg-green-dark mb-3 p-1">COMPLETED</span>
                <h5 class="font-13 opacity-30 line-height-s mb-4">สมิติเวชไอซ์จีดีพีเวิร์กช็อปด็อกเตอร์ รุสโซชนะเลิศสปอตซิ่งเพียบแปร้ สแตนเลส ยากูซ่าไนน์จิตเภท อพาร์ทเมนท์สหัสวรรษ ซิ่งชัตเตอร์สตีลเฟรม โปลิศ ทับซ้อนพรีเมียมแอ็คชั่น</h5>
                <div class="row mb-0">
                    <div class="col-8">
                        <p class="font-600 mb-0 font-10 color-green-dark">10% Complete</p>
                        <div class="progress" style="height:10px;">
                            <div class="progress-bar border-0 gradient-green text-left pl-2"
                                    role="progressbar" style="width: 10%"
                                    aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="#" class="btn btn-full btn-s font-600 font-12 rounded-s gradient-green">เข้าเรียน</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>