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

<section class="checkout-area padding-top-80px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="row">
              
              <?php
              
              foreach ($data["Page"]['post'] as $post)
              {
                echo "
                <div class='col-md-3'>
                  <div class='card-box-shared'>
                      <div class='card-box-shared-title'>
                          <h3 class='widget-title font-size-14'>{$post['post_name']}</h3>
                      </div>
                      <div class='card-box-shared-body'>
                          <div class='user-form'>
                              <div class='contact-form-action'>
                                <div class='pt-10 text-center'>
                                  <i class='fa fa-download file-download-icon'></i>
                                </div>
                                </br>
                                <div class='pt-20'>
                                  <div role='group' class='pr-2'>
                                      <a href='{$post['post_detail']}' download='{$post['post_name']}' class='align-self-center btn btn-success btn-block' download><i class='mdi mdi-download'></i> Download File</a>
                                  </div>
                                </div>

                              </div>
                          </div>
                      </div>
                  </div>
                </div>";
              }

              ?>

              </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section>
