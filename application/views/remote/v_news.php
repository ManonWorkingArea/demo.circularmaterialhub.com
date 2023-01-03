<div class="page-content">

        <div class="single-slider owl-carousel owl-no-dots mb-0">
            <a href="remote/news/detail?code=001" class="card card-style bg-rule-1" data-card-height="300">
                <div class="card-bottom px-3">
                    <h1 class="color-white mb-n1">สนส. จับมือกรมทรัพยากรน้ำบาดาล...</h1>
                    <p class="color-white opacity-50 mb-3">
                    สนส. จับมือกรมทรัพยากรน้ำบาดาลหนุนภาคอุตสาหกรรมเติมน้ำใต้ดินระดับตื้น…
                    </p>
                </div>
                <div class="card-overlay bg-gradient"></div>
            </a>
            <a href="remote/news/detail?code=002" class="card card-style bg-rule-2" data-card-height="300">
                <div class="card-bottom px-3">
                    <h1 class="color-white mb-n1"> ขอเชิญเข้าร่วมงานสัมมนาเผยแพร่ผล...</h1>
                    <p class="color-white opacity-50 mb-3">
                    ขอเชิญเข้าร่วมงานสัมมนาเผยแพร่ผลการดำเนินโครงการอุตสาหกรรมเติมน้ำใต้ดินระดับตื้น…
                    </p>
                </div>
                <div class="card-overlay bg-gradient"></div>
            </a>
            <a href="remote/news/detail?code=003" class="card card-style bg-rule-3" data-card-height="300">
                <div class="card-bottom px-3">
                    <h1 class="color-white mb-n1"> ขอเชิญดูงานเพื่อส่งเสริมและสร้าง...</h1>
                    <p class="color-white opacity-50 mb-3">
                    ขอเชิญดูงานเพื่อส่งเสริมและสร้างเครือข่ายแลกเปลี่ยนประสบการณ์การจัดการของเสียอย่างยั่งยืน
                    </p>
                </div>
                <div class="card-overlay bg-gradient"></div>
            </a>
        </div>

        <div class="topic-slider owl-carousel owl-no-dots mb-3">
            <h1><a href="#" class="px-3 color-theme">ล่าสุด</a></h1>
            <h1><a href="#" class="px-3">โรงงาน</a></h1>
            <h1><a href="#" class="px-3">หน่วยงานราชการ</a></h1>
            <h1><a href="#" class="px-3">องค์กร</a></h1>
            <h1><a href="#" class="px-3">สถาบันน้ำ</a></h1>
        </div>

        <div class="card card-style">
            <div class="content mb-0">

                <p class="mb-n1 color-highlight font-600">What's Hot in </p>
                <h1 class="font-26 font-800 mb-3">ข่าวล่าสุด</h1>

                <?php 
            
                foreach ($data["Page"]['post'] as $post)
                {
                    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post['post_detail'], $image);
                    $thumbnail =  $image['src'];

                    $date   = engine::thaidate($post['post_adddate']);
                    $viewer = engine::currency($post['post_view']);
                    $title  = mb_strimwidth($post['post_name'], 0, 90, '...');

                    echo "
                    <a href='remote/news/detail/{$post['post_slug']}' class='d-flex'>
                        <div class='mr-auto'>
                            <h5 class='font-600 pt-2'>{$title}</h5>
                            <span class='color-highlight opacity-60'>{$date}</span>
                        </div>
                        <div class='ml-4 mb-4'>
                            <img src='{$thumbnail}' class='rounded-sm' width='100'>
                        </div>
                    </a>";
                }
                
                ?>
            </div>
        </div>
</div>