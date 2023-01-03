<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title"><?php echo $data["Page"]['detail']['post_name'];?></h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="home">หน้าหลัก</a></li>
                        <li><?php echo $data["Page"]['detail']['post_name'];?></li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="blog-grid section-padding">
    <div class="container">
        <div class="row">

            <?php //print_r($data["Page"]);?>

            <?php 
            
            foreach ($data["Page"]['post'] as $post)
            {
                preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post['post_detail'], $image);
                $thumbnail =  $image['src'];

                $date   = engine::thaidate($post['post_adddate']);
                $viewer = engine::currency($post['post_view']);

                echo 
                "<div class='col-lg-4 column-td-half'>
        
                    <div class='card-item blog-card'>

                        <div class='card-image'>
                            <a href='page/view/news/{$post['post_slug']}' class='card__img'><img src='{$thumbnail}' alt=''></a>
                            <div class='card-badge'>
                                <span class='badge-label'>{$date}</span>
                            </div>
                        </div>

                        <div class='card-content'>
                            <h3 class='card__title mt-0'>
                                <a href='page/view/news/{$post['post_slug']}'>{$post['post_name']}</a>
                            </h3>
                            <div class='card-action'>
                                <ul class='card-duration d-flex align-items-center'>
                                    <li>By<a href='#' class='blog-admin-name'>WEIS Admin</a></li>
                                    <li><span class='blog__panel-likes'>{$viewer} Views</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
            
            ?>

        </div><!-- end row -->
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="page-navigation-wrap mt-4 text-center">
                    <div class="page-navigation-inner d-inline-block">
                        <div class="page-navigation">
                            <a href="#" class="page-go page-prev">
                                <i class="la la-arrow-left"></i>
                            </a>
                            <ul class="page-navigation-nav">
                                <li><a href="#" class="page-go-link">1</a></li>
                                <li class="active"><a href="#" class="page-go-link">2</a></li>
                                <li><a href="#" class="page-go-link">3</a></li>
                                <li><a href="#" class="page-go-link">4</a></li>
                            </ul>
                            <a href="#" class="page-go page-next">
                                <i class="la la-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div><!-- end container -->
</section>
