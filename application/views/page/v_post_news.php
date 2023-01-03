<section class="breadcrumb-area about-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content about-breadcrumb-content">
                    <div class="section-heading">
                        <p class="section__meta section__metalight"><a href='page/view/news'><?php echo $data["Page"]['post_name'];?></a></p>
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

            <div class="col-lg-12 padding-top-20px">
			<?php echo engine::thaidate($data["Post"]['post_adddate']);?></br>
			<h3><?php echo $data["Post"]['post_name'];?></h3></br>
			<?php echo $data["Post"]['post_detail'];?>
            </div>

        </div><!-- end row -->

    </div><!-- end container -->
</section>
