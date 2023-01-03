<div class="page-content">
    <div class="card card-style">
        <div class="card rounded-0 mb-0" data-card-height="250" style='background-image: url(<?php echo "https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$data["Lesson"]['lesson_cover']}";?>);'></div>
        <div class="card-top mt-3 pb-5 pl-3">
            <a href="#" data-back-button="" class="icon icon-s bg-theme rounded-xl float-left mr-3"><i class="fa color-theme fa-arrow-left"></i></a>
        </div>
        <div class="content">
            <p class="mb-n1 color-highlight font-600">บทเรียนออนไลน์</p>
            <h1><?php echo $data["Lesson"]['lesson_name'];?></h1>
            <p class="opacity-60 text-uppercase font-10 mt-n2 font-600 mb-1">

            <i class="fa color-red-dark fa-book"></i> <strong>เนื้อหา : </strong> <?php echo $data["Lesson"]['count_course']?> บทเรียน | 
            <i class="fa color-red-dark fa-clock"></i> <strong>เวลาเรียน : </strong> <?php echo $data["Lesson"]['duration_course']?> ชม.
            
            </p>

            <?php echo $data["Lesson"]['lesson_short_detail'];?>

            <div class="d-flex">
                <div class="mr-auto">
                    <div class="list-group list-custom-large mt-n3">
                        <a href="#" class="border-0">
                            <span><?php echo $data["Teacher"]['teacher_name']?></span>
                            <strong>ผู้บรรยาย/วิทยากร</strong>
                        </a>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn btn-full btn-s font-600 rounded-s gradient-highlight mt-1 float-left ">ดูรายละเอียด</a>
                </div>
            </div>
        </div>
        <div class="divider mb-0"></div>
        <div class="content">

            <?php

                $corder = "1";

                foreach ($data["Lesson"]['course'] as $Course)
                {
                    $num_padded = sprintf("%02d", $corder);

                    echo
                    "<div class='d-flex mb-4'>
                        <div class='align-self-center'>
                            <h1 class='font-50 opacity-40 color-highlight mb-0 icon-80'>{$num_padded}</h1>
                        </div>
                        <div class='align-self-center'>
                            <h1 class='mb-0'>{$Course['course_name']}</h1>
                        </div>
                    </div>";

                    $torder = "1";

                    foreach ($Course['topic'] as $Topic)
                    {
                        if($Topic['topic_type']=="2") // บทเรียน
                        {
                            echo
                            "<div class='mb-4'>
                                <div class='responsive-iframe mb-3'>
                                    <video controls 
                                    src='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_video']}' 
                                    poster='https://{$data["Lesson"]['school_s3_url']}/{$data["Lesson"]['school_s3_bucket']}/{$Topic['topic_poster']}' width='330'
                                    >
                                    Sorry, your browser doesn't support embedded videos,
                                    </video>
                                </div>
                                <p>{$Topic['topic_name']}</p>
                            </div>";
        
                            $torder++;
                        }
                    }
                    $corder++;

                    echo '<div class="divider mb-4"></div>';
                }
            ?>
            <div class="d-flex mb-0">
                <div class="mr-auto">
                    <div class="list-group list-custom-large mt-n3">
                        <a href="#" class="border-0">
                            <span>WEIS Teacher</span>
                            <strong>ผู้บรรยาย/วิทยากร</strong>
                        </a>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn btn-full btn-s font-600 rounded-s gradient-highlight mt-1 float-left ">หลักสูตรอื่น</a>
                </div>
            </div>

            <!-- <div class="divider"></div>

            <p class="font-600 mb-n1 color-highlight">การรับรองผล</p>
            <h1 class="mb-0">ใบรับรองผลการเรียน</h1>
            <p>
                After finishing this course you'll get a graduation diploma. Be sure to watch all the chapters all the way.
            </p>
            <a href="#" class="btn btn-full btn-m rounded-sm gradient-highlight font-600">ดาวน์โหลดใบรับรอง</a> -->

        </div>
    </div>
</div>