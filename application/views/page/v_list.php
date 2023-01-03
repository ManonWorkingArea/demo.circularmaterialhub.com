<!--Page Header-->
<section class="page_header">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content padding-top">
        <h1><?php echo $data["Page"]['page_name'];?></h1>
        <p><i>"<?php echo $_SESSION["School"]['slogan'];?>"</i></p>
		<div class="page_nav">
			<span>คุณอยู่ที่ : </span> 
			<a href="home">หน้าหลัก</a> 
			<span><i class="fa fa-angle-double-right"></i><?php echo $data["Page"]['page_name'];?></span>
		</div>
      </div>
    </div>
  </div>
</section>

<!--BLOG SECTION-->
<section id="blog" class="padding-bottom-half padding-top-half">
  <div class="container">
    <h2 class="hidden"><?php echo $data["Page"]['page_name'];?></h2>
    <div class="row">
      <div class="col-md-8">
		<?php 
		
			foreach ($data["Post"]['list'] as $Post)
			{	
				$page 	= $data["Page"]['page_code'];
				$detail 	= engine::shorttext($Post['post_detail'], 150);
				$date 	= engine::thaidate($Post['post_adddate']);
				
				if($Post['post_thumbnail']=="" || $Post['post_thumbnail']==NULL)
				{
					$firstimg = engine::page_image($Post['post_detail']);
					//
					if($firstimg=="" || $firstimg ==NULL)
					{
						$imgtag = "theme/demo/assets/core/image/default-post.png";
					}
					else
					{
						$imgtag = str_replace("https://content.me-rean.com/img.php?file=", "", $firstimg);
					}
				}
				else
				{
					$imgtag = "https://content.me-rean.com/img.php?file=" . $Post['post_thumbnail'];
				}
				
				echo 
				"
				<article class='blog_item heading_space-half wow fadeInLeft' data-wow-delay='300ms'>
				  <div class='row'>
					<div class='col-md-4 col-sm-4 heading_space-half'>
					  <div class='image'><img src='{$imgtag}' alt='blog' class='border_radius'></div>
					</div>
					<div class='col-md-8 col-sm-8 heading_space-half'>
					  <h3  class='text-core'>{$Post['post_name']}</h3>
					  
					  <ul class='comment post-meta margin10'>
						<li><i class='fa fa-calendar'></i> {$date}</li>
						<li><i class='fa fa-users'></i> {$Post['post_view']}</li>
						<li class='pull-right'><i class='fa fa-pencil'></i> {$Post['teacher_name']}</li>
					  </ul>
		  
					  <p class='margin10'>{$detail}</p>
					  <a class=' btn_common btn_border margin10 border_radius' href='page/v/{$page}/{$Post['post_code']}'>ดูรายละเอียด</a>
					</div>
				  </div>
				</article>
				";
			}
			
		?>
        
        <div class="pager_nav wow fadeIn">
		
			<!--<pre><?php print_r($data["Post"]['pagination']);?></pre>-->
			<?php echo $data["Post"]['pagination']['render'];?>
        </div>
		
      </div>
      <div class="col-md-4">
        <aside class="sidebar bg_grey border-radius wow fadeIn" data-wow-delay="300ms">
          <div class="widget heading_space">
            <form class="widget_search border-radius">
              <div class="input-group">
                <input type="search" class="form-control" placeholder="ค้นหาข้อมูล" required>
                <i class="input-group-addon icon-icons185"></i>
              </div>
            </form>
          </div>
          <div class="widget heading_space">
            <h3 class="bottom20">คอร์สน่าสนใจ</h3>
			<?php
														
				foreach ($data["Post"]['course'] as $Random)
				{
					$price 	= engine::baht($Random['lesson_price'], "฿");
					$detail 	= engine::shorttext($Random['lesson_detail'], 20);
				
					echo 
					"<div class='media'>
						<a class='media-left' href='course/detail/{$Random['lesson_code']}'><img src='https://content.me-rean.com/img.php?file={$Random['lesson_cover']}' alt='{$Random['lesson_name']} Cover' class='feature-cover'></a>
						<div class='media-body'>
						  <h5 class='bottom5'>{$Random['lesson_name']}</h5>
						  <a href='course/detail/{$Random['lesson_code']}' class='btn-primary border_radius bottom5'>{$price}</a>
						  <form class='star_rating'>
							<div class='stars'>
							  <input type='radio' name='star' class='star-1' id='star-51' />
							  <label class='star-1' for='star-51'>1</label>
							  <input type='radio' name='star' class='star-2' id='star-52' />
							  <label class='star-2' for='star-52'>2</label>
							  <input type='radio' name='star' class='star-3' id='star-53' />
							  <label class='star-3' for='star-53'>3</label>
							  <input type='radio' name='star' class='star-4' id='star-54'  />
							  <label class='star-4' for='star-54'>4</label> 
							  <input type='radio' name='star' class='star-5'  id='star-55' checked  />
							  <label class='star-5' for='star-55'>5</label>
							  <span></span>
							</div>
						  </form>
						  <span class='name'>{$Random['class_name']}</span>
						</div>
					  </div>
					  ";
				}
				
			?>
			
          </div>
		  
          <div class="widget heading_space">
            <h3 class="bottom20">ประเภทวิชา</h3>
            <ul class="tags">
             <?php
														
				foreach ($data["Post"]['tags'] as $Tag)
				{				
					echo  "<li><a href='course/search/type/{$Tag['lesson_type_code']}'>{$Tag['lesson_type_name']} <span class='pull-right label label-success'> {$Tag['count_type']} </span></a></li>";
				}
				
			?>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
<!--BLOG SECTION-->