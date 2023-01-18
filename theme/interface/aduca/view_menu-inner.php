<!--======================================
        START HEADER AREA
    ======================================-->
<header class="header-menu-area">
    <div class="header-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="header-action-list">
                            <li><a href="#"><span class="la la-phone mr-2"></span>123456789</a></li>
                            <li><a href="#"><span class="la la-envelope-o mr-2"></span>info@circularmaterialhub.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-widget d-flex align-items-center justify-content-end">
                        <div class="header-right-info">
                            <ul class="header-social-profile">
                                <li><a href="www.facebook.com/WEIS.FTI"><i class="fa fa-facebook"></i></a></li>

                            </ul>
                        </div>
                        <div class="header-right-info">

                            <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

                              <ul class="header-action-list">
                                  <li><a href="member"><i class="fa fa-user"></i> <?php echo engine::student("firstname");?></a></li>
                                  <li><a href="javascript:void(0);"><i class="fa fa-envelope"></i> <span class="notification-badge">2</span></a></li>
                                  <li><a href="javascript:void(0);" onclick="signout();"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                              </ul>

                            <?php else: ?>

                              <ul class="header-action-list">
                                  <li><a href="auth/login"><i class="fa fa-power-off"></i> เข้าสู่ระบบ</a></li>
                                  <li>หรือ</li>
                                  <li><a href="auth/register"><i class="fa fa-user-plus"></i> สมัครสมาชิก</a></li>
                              </ul>

                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-menu-content">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="home" class="logo">CMH Logo</a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <nav class="main-menu">
                                <ul>
                                    <li id="page-guidelines-menu"><a href="page/view/guidelines">หลักเกณฑ์ CMH</a></li>
                                </ul>
                            </nav>

                            <!-- <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

                              <div class="logo-right-button">
                                  <a href="student" class="theme-btn-primary"><i class="fa fa-play-circle"></i> ข้อมูลสมาชิก</a>
                              </div>

                            <?php else: ?>

                              <div class="logo-right-button">
                                  <a href="auth/login" class="theme-btn"><i class="fa fa-power-off"></i> เข้าระบบ</a>
                              </div>

                            <?php endif; ?> -->

                        </div>
                        <div class="menu-wrapper">
                            <nav class="main-menu">
                                <ul>
                                    <!-- <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>
                                    <li><a href="student/course">หลักสูตรของผู้ใช้</a></li>
                                    <?php else: ?>
                                    <?php endif; ?> -->
                                    <!--<li id="app-index-menu"><a href="app">แบบฟอร์มการสมัคร</a></li>-->
                                </ul>
                            </nav>

                            <!-- <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

                              <div class="logo-right-button">
                                  <a href="student" class="theme-btn-primary"><i class="fa fa-play-circle"></i> ข้อมูลสมาชิก</a>
                              </div>

                            <?php else: ?>

                              <div class="logo-right-button">
                                  <a href="auth/login" class="theme-btn"><i class="fa fa-power-off"></i> เข้าระบบ</a>
                              </div>

                            <?php endif; ?> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--======================================
        END HEADER AREA
======================================-->
