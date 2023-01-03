
<?php

if(isset($_GET["dev"]))
{

    echo "<pre>";
    echo "<strong>:::::::: DEV CASE DEPLOY ::::::::</strong></br>";
    echo "Eco factory etracking_session " . print_r(engine::user("access"));
    echo "<br>";
    echo "<strong>:::::::: DEV CASE DEPLOY ::::::::</strong></br>";
    echo $salt = uniqid(mt_rand(), true);
    echo "<br>";

    echo "<strong>Load Default Data Override</strong></br></br>";
    echo "<strong>:::::::: DATA ::::::::</strong></br>";
    
    print_r($data);
    
    echo "<strong>:::::::: DEV CASE DEPLOY ::::::::</strong></br</br>>";
    $accessData = array
    (
        'elearning' => "7jlraijizUl3gsr5gaA0",
        'etracking' => "x6A1JufvNYPJljxNxXZpRwrhv8EsN7",
    );
    $accessData = serialize($accessData);
    echo $accessData;
    echo "</br><strong>:::::::: DEV CASE DEPLOY :::::::: </strong></br>";
    echo "<br>";
    echo "<br>";

    echo "</pre>";
}

?>

<!-- ================================
         END FOOTER AREA
================================= -->


<section class="footer-area section-bg-2 padding-top-40px padding-bottom-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 column-td-half">
                <div class="footer-widget">
                    <a href="home">
                        <img src="theme/interface/aduca/assets/images/logo.png" alt="footer logo" class="footer__logo">
                    </a>
                    <ul class="list-items footer-address">
                        <li><strong>The Federation of Thai Industries.</strong></li>
                        <li>8th Flr, Creative Technology Bldg. 2 Nang Linchi Rd., Thung Maha Mek, Sathon, Bangkok 10120 Thailand</li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title">Eco Factory</h3>
                    <span class="section-divider"></span>
                    <ul class="list-items">
                        <li><a href="page/view/guidelines">หลักเกณฑ์ Eco Factory</a></li>
                        <li><a href="page/view/benefits">สิทธิประโยชน์</a></li>
                        <li><a href="page/view/procedure">ขั้นตอนและตารางประชุม</a></li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title">ฐานข้อมูล</h3>
                    <span class="section-divider"></span>
                    <ul class="list-items">
                        <li><a href="page/view/certified_verifier">รายชื่อที่ปรึกษา</a></li>
                        <li><a href="page/view/certified_auditor">รายชื่อผู้ตรวจประเมิน</a></li>
                        <li><a href="page/view/certified_factory">รายชื่อโรงงานที่ได้รับการรับรอง</a></li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-3 -->
            <div class="col-lg-3 column-td-half">
                <div class="footer-widget">
                    <h3 class="widget-title">สำหรับสมาชิก</h3>
                    <span class="section-divider"></span>
                    <ul class="list-items">
                        <li><a href="course">หลักสูตร</a></li>
                        <li><a href="app">แบบฟอร์มการสมัคร</a></li>
                        <li><a href="auth/register">สมัครสมาชิก</a></li>
                    </ul>
                </div><!-- end footer-widget -->
            </div><!-- end col-lg-3 -->

        </div><!-- end row -->
        <div class="copyright-content">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <p class="copy__desc">&copy; 2022 สงวนลิขสิทธิ์ สภาอุตสาหกรรมแห่งประเทศไทย The Federation of Thai Industries.</p>
                </div><!-- end col-lg-9 -->

            </div><!-- end row -->
        </div><!-- end copyright-content -->
    </div><!-- end container -->
</section><!-- end footer-area -->
<!-- ================================
          END FOOTER AREA
================================= -->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<!-- START Bootstrap-Cookie-Alert -->
<div class="alert text-center cookiealert" role="alert">
    <b>เว็บไซต์นี้ มีการเก็บข้อมูลการใช้งานเว็บไซต์ (Cookies)</b> &#x1F36A; เพื่อมอบบริการที่ดีที่สุดสำหรับคุณ โดยการเข้าใช้งานเว็บไซต์ ถือเป็นการยอมรับในเงื่อนไขการใช้งานเว็บไซต์ <a href="cookiepolicy" target="_blank">คำอธิบาย</a>
    <button type="button" class="btn btn-primary btn-sm acceptcookies">
        ยอมรับ
    </button>
</div>
<!-- END Bootstrap-Cookie-Alert -->

<?php engine::html("theme","js","js/popper.min.js");?>
<?php engine::html("theme","js","js/bootstrap.min.js");?>
<?php engine::html("theme","js","js/bootstrap-select.min.js");?>
<?php engine::html("theme","js","js/owl.carousel.min.js");?>
<?php engine::html("theme","js","js/isotope.js");?>
<?php engine::html("theme","js","js/waypoint.min.js");?>
<?php engine::html("theme","js","js/jquery.counterup.min.js");?>
<?php engine::html("theme","js","js/particles.min.js");?>
<?php engine::html("theme","js","js/particlesRun.js");?>
<?php engine::html("theme","js","js/fancybox.js");?>
<?php engine::html("theme","js","js/wow.js");?>
<?php engine::html("theme","js","js/date-time-picker.js");?>
<?php engine::html("theme","js","js/jquery.filer.min.js");?>
<?php engine::html("theme","js","js/emojionearea.min.js");?>
<?php engine::html("theme","js","js/smooth-scrolling.js");?>
<?php engine::html("theme","js","js/tooltipster.bundle.min.js");?>
<?php engine::html("theme","js","js/main.js");?>

<!-- Player -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.js" integrity="sha512-+nn8ZHNL4PtaT9wOGsm2KgJJ8fgptDelTVnxBxmLJCoFX84r/vzQjD5XSs6MyUrQdZ4BaNoEzf/TdsNjildIPA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.2/plyr.css" integrity="sha512-jrLDXl9jUPe5DT19ukacvpX39XiErIBZxiaVMDFRe+OAKoBVYO126Dt7cvhMJ3Fja963lboD9DH+ev/2vbEnMw==" crossorigin="anonymous" />

<!-- Impromptu -->
<?php engine::html("theme","js","js/Impromptu/src/jquery-impromptu.js");?>
<?php engine::html("theme","css","js/Impromptu/src/jquery-impromptu.css");?>

<!-- Wait Me -->
<?php engine::html("theme","js","js/waitMe/waitMe.js");?>
<?php engine::html("theme","css","js/waitMe/waitMe.css");?>

<!-- iziToast -->
<?php engine::html("theme","js","js/iziToast/iziToast.js");?>
<?php engine::html("theme","css","js/iziToast/iziToast.css");?>

<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

<!-- Include cookiealert script -->
<!-- <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script> -->

<?php engine::html("activenav");?>
<?php engine::html("global-js");?>
<?php engine::html("js");?>
