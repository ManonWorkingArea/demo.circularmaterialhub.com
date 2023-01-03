<!--Page Header-->
<section class="page_header padding-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12 page-content">
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
 <h3 class="hidden"><?php echo $data["Page"]['page_name'];?></h3>
 <div class="container">
     <div class="row">
	 
      <div class="col-md-12 col-sm-12 wow fadeIn" data-wow-delay="400ms">
        <article class="blog_item padding-bottom-half heading_space">
          <h3 class="text-core"><?php echo $data["Page"]['page_name'];?></h3>
		  
		  <ul class="comment post-meta margin10">
            <li><i class="fa fa-calendar"></i> <?php echo engine::thaidate($data["Page"]['page_adddate']);?></li>
            <li><i class="fa fa-users"></i> <?php echo $data["Page"]['page_view'];?></li>
			<li class="pull-right"><i class="fa fa-pencil"></i> <?php echo $data["Page"]['teacher_name'];?></li>
          </ul>
		  
          <p class="margin10"><?php echo $data["Page"]['page_detail'];?></p>
            
        </article>
        <div class="share clearfix heading_space">
			<div class="col-md-6 pull-left"><span class="caption"><i class="fa fa-share-alt" aria-hidden="true"></i> แชร์หน้านี้ :</span></div>
			<div class="col-md-6 pull-right">
				<ul class="rrssb-buttons">

				  <li class="rrssb-email">
					<!-- Replace subject with your message using URL Endocding: http://meyerweb.com/eric/tools/dencoder/ -->
					<a href="mailto:?Subject=Your%20Subject%20Here">
					  <span class="rrssb-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.386 2.614H2.614A2.345 2.345 0 0 0 .279 4.961l-.01 14.078a2.353 2.353 0 0 0 2.346 2.347h18.771a2.354 2.354 0 0 0 2.347-2.347V4.961a2.356 2.356 0 0 0-2.347-2.347zm0 4.694L12 13.174 2.614 7.308V4.961L12 10.827l9.386-5.866v2.347z"/></svg>
					  </span>
					  <span class="rrssb-text">email</span>
					</a>
				  </li>

				  <li class="rrssb-facebook">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $GLOBALS["share"]['url'];?>" class="popup">
					  <span class="rrssb-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29"><path d="M26.4 0H2.6C1.714 0 0 1.715 0 2.6v23.8c0 .884 1.715 2.6 2.6 2.6h12.393V17.988h-3.996v-3.98h3.997v-3.062c0-3.746 2.835-5.97 6.177-5.97 1.6 0 2.444.173 2.845.226v3.792H21.18c-1.817 0-2.156.9-2.156 2.168v2.847h5.045l-.66 3.978h-4.386V29H26.4c.884 0 2.6-1.716 2.6-2.6V2.6c0-.885-1.716-2.6-2.6-2.6z"/></svg>
					  </span>
					  <span class="rrssb-text">facebook</span>
					</a>
				  </li>

				  <li class="rrssb-instagram">
					<!-- Replace href with your URL  -->
					<a href="http://instagram.com/dbox">
					  <span class="rrssb-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="864" height="864" viewBox="0 0 864 864"><path d="M860.079 254.436c-2.091-45.841-9.371-77.147-20.019-104.542-11.007-28.32-25.731-52.338-49.673-76.28-23.943-23.943-47.962-38.669-76.282-49.675C686.711 13.292 655.404 6.013 609.564 3.92 563.628 1.824 548.964 1.329 432 1.329s-131.63.495-177.564 2.591c-45.841 2.093-77.147 9.372-104.542 20.019-28.319 11.006-52.338 25.731-76.28 49.675-23.943 23.942-38.669 47.96-49.675 76.28C13.292 177.288 6.013 208.595 3.92 254.436 1.824 300.37 1.329 315.036 1.329 432s.495 131.628 2.591 177.564c2.093 45.84 9.372 77.146 20.019 104.541 11.006 28.319 25.731 52.339 49.675 76.282 23.942 23.941 47.961 38.666 76.28 49.673 27.395 10.647 58.701 17.927 104.542 20.019 45.935 2.096 60.601 2.592 177.564 2.592s131.628-.496 177.564-2.592c45.84-2.092 77.146-9.371 104.541-20.019 28.32-11.007 52.339-25.731 76.282-49.673 23.941-23.943 38.666-47.962 49.673-76.282 10.647-27.395 17.928-58.701 20.019-104.541 2.096-45.937 2.592-60.601 2.592-177.564s-.496-131.63-2.592-177.564zm-77.518 351.591c-1.915 41.99-8.932 64.793-14.828 79.969-7.812 20.102-17.146 34.449-32.216 49.521-15.071 15.07-29.419 24.403-49.521 32.216-15.176 5.896-37.979 12.913-79.969 14.828-45.406 2.072-59.024 2.511-174.027 2.511s-128.622-.438-174.028-2.511c-41.988-1.915-64.794-8.932-79.97-14.828-20.102-7.812-34.448-17.146-49.518-32.216-15.071-15.071-24.405-29.419-32.218-49.521-5.897-15.176-12.912-37.979-14.829-79.968-2.071-45.413-2.51-59.034-2.51-174.028s.438-128.615 2.51-174.028c1.917-41.988 8.932-64.794 14.829-79.97 7.812-20.102 17.146-34.448 32.216-49.518 15.071-15.071 29.418-24.405 49.52-32.218 15.176-5.897 37.981-12.912 79.97-14.829 45.413-2.071 59.034-2.51 174.028-2.51s128.615.438 174.027 2.51c41.99 1.917 64.793 8.932 79.969 14.829 20.102 7.812 34.449 17.146 49.521 32.216 15.07 15.071 24.403 29.418 32.216 49.52 5.896 15.176 12.913 37.981 14.828 79.97 2.071 45.413 2.511 59.034 2.511 174.028s-.44 128.615-2.511 174.027z"/><path d="M432 210.844c-122.142 0-221.156 99.015-221.156 221.156S309.859 653.153 432 653.153 653.153 554.14 653.153 432c0-122.142-99.012-221.156-221.153-221.156zm0 364.713c-79.285 0-143.558-64.273-143.558-143.557 0-79.285 64.272-143.558 143.558-143.558 79.283 0 143.557 64.272 143.557 143.558 0 79.283-64.274 143.557-143.557 143.557z"/><circle cx="661.893" cy="202.107" r="51.68"/></svg>
					  </span>
					  <span class="rrssb-text">instagram</span>
					</a>
				  </li>

				  <li class="rrssb-twitter">
					<!-- Replace href with your Meta and URL information  -->
					<a href="https://twitter.com/intent/tweet?text=<?php echo $GLOBALS["share"]['url'];?>"
					class="popup">
					  <span class="rrssb-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28"><path d="M24.253 8.756C24.69 17.08 18.297 24.182 9.97 24.62a15.093 15.093 0 0 1-8.86-2.32c2.702.18 5.375-.648 7.507-2.32a5.417 5.417 0 0 1-4.49-3.64c.802.13 1.62.077 2.4-.154a5.416 5.416 0 0 1-4.412-5.11 5.43 5.43 0 0 0 2.168.387A5.416 5.416 0 0 1 2.89 4.498a15.09 15.09 0 0 0 10.913 5.573 5.185 5.185 0 0 1 3.434-6.48 5.18 5.18 0 0 1 5.546 1.682 9.076 9.076 0 0 0 3.33-1.317 5.038 5.038 0 0 1-2.4 2.942 9.068 9.068 0 0 0 3.02-.85 5.05 5.05 0 0 1-2.48 2.71z"/></svg>
					  </span>
					  <span class="rrssb-text">twitter</span>
					</a>
				  </li>
				  

				  <li class="rrssb-googleplus">
					<!-- Replace href with your meta and URL information.  -->
					<a href="https://plus.google.com/share?url=<?php echo $GLOBALS["share"]['url'];?>" class="popup">
					  <span class="rrssb-icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 8.29h-1.95v2.6h-2.6v1.82h2.6v2.6H21v-2.6h2.6v-1.885H21V8.29zM7.614 10.306v2.925h3.9c-.26 1.69-1.755 2.925-3.9 2.925-2.34 0-4.29-2.016-4.29-4.354s1.885-4.353 4.29-4.353c1.104 0 2.014.326 2.794 1.105l2.08-2.08c-1.3-1.17-2.924-1.883-4.874-1.883C3.65 4.586.4 7.835.4 11.8s3.25 7.212 7.214 7.212c4.224 0 6.953-2.988 6.953-7.082 0-.52-.065-1.104-.13-1.624H7.614z"/></svg>            </span>
					  <span class="rrssb-text">google+</span>
					</a>
				  </li>

				  <li class="rrssb-print">
					<a href="javascript:window.print()">
					  <span class="rrssb-icon">
						<svg viewbox="0 0 24 24"><path fill="#000000" d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z"></path></svg>
					  </span>
					  <span class="rrssb-text">print</span>
					</a>
				  </li>
				  
				</ul>
				<!-- Buttons end here -->

			</div>

        </div>
       
      </div>

    </div>
  </div>
</section>
