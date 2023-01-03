<div class="page-content">
    <div class='single-slider owl-carousel owl-no-dots owl-has-controls mb-0'>
    <?php
    foreach ($data["Banner"]['post'] as $post)
    {
    preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post['post_detail'], $image);
    $slideImage = $image['src'];
    echo "<div data-card-height='300' class='card mb-0 bg-6 shadow-l' style='background-image:url(" . $slideImage . ")'></div>";
    }
    ?>
    </div>

    <div class="card card-style mt-3">
        <div class="content">
            <div class="d-flex mb-4">
                <div class="align-self-center">
                    <h1 class="font-50 opacity-40 color-highlight mb-0 icon-80">01</h1>
                </div>
                <div class="align-self-center">
                    <h1 class="mb-0">Highlight หลักสูตรปรึกษามาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ</h1>
                </div>
            </div>
            <div class="">
                <div class="responsive-iframe mb-3">
                    <video controls="" src="https://content.fti.academy/fti-weis/16074945192106155542/1607494538809604095/16074946591360337336/16074947011317283164.mp4" poster="https://content.fti.academy/fti-weis/16212029391827577769/162120294984044618/1621202961134803479.JPG" width="330">
                    Sorry, your browser doesn't support embedded videos,
                    </video>
                </div>
                <p>EP.1.Highlight หลักสูตรปรึกษามาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ</p>
            </div>
        </div>
    </div>

    <div class="row mt-3">
    <?php
    $order  = 0;
    $odd    = 0;
    foreach ($data["Menu"]['post'] as $post) {
        $order++;
        $odd++;
        $padding  = ($odd % 2 == 1) ? "pr-2" : "pl-2";
        $margin   = ($odd % 2 == 1) ? "mr-0" : "ml-0";
        echo "
        <div class='col {$padding}'>
            <a href='{$post['post_detail']}' class='card card-style rounded-m {$margin} p-3 mb-3'>
                <i class='{$post['post_slug']}'></i>
                <h4 class='pt-3'>{$post['post_name']}</h4>
            </a>
        </div>";
        if($order==2) {
            echo "<div class='w-100'></div>";
            $order = 0;
        }
    }
    ?>
    </div>
</div>