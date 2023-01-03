<div class="page-content">

    <div class="card rounded-0 bg-rule-5" data-card-height="450">
        <div class="card-bottom pl-3 pb-4">
            <h1 class="color-white font-24 mb-n1"><?php echo mb_strimwidth($data["Post"]['post_name'], 0, 97, '...');?></h1>
            <p class="color-white font-14 opacity-50"><?php echo engine::thaidate($data["Post"]['post_adddate']);?></p>
        </div>
        <div class="card-top mt-3 pb-5 pl-3">
            <a href="#" data-back-button class="icon icon-s bg-theme rounded-xl float-left mr-3"><i class="fa color-theme fa-arrow-left"></i></a>
        </div>
        <div class="card-overlay bg-gradient"></div>
    </div>
    
    <div class="card card-style">
        <div class="content">
            <p class="mb-n1 color-highlight font-600">ข่าวประชาสัมพันธ์</p>
            <h1><?php echo $data["Post"]['post_name'];?></h1>
            <?php 

            $doc = new DOMDocument();
            $doc->loadHTML($data["Post"]['post_detail']);
            $tags = $doc->getElementsByTagName('img');
            
            foreach ($tags as $tag) 
            {
                $oldSrc = $tag->getAttribute('src');
                $tag->setAttribute('src', $oldSrc);
                $tag->setAttribute('width', "100%");
            } 
            
            $htmlString = $doc->saveHTML();

            echo $htmlString;
            ?>
        </div>
    </div>

</div>