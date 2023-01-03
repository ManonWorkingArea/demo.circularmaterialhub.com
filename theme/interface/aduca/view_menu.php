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
                            <li><a href="#"><span class="la la-phone mr-2"></span>02 345 1000</a> </li>
                            <li><a href="#"><span class="la la-envelope-o mr-2"></span>info@fti.academy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-widget d-flex align-items-center justify-content-end">
                        <div class="header-right-info">
                            <ul class="header-social-profile">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <div class="header-right-info">

                            <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

                              <ul class="header-action-list">
                                  <li><a href="student"><i class="fa fa-user"></i> <?php echo engine::student("firstname");?></a></li>
                                  <li><a href="javascript:void(0);" onclick="signout();"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                              </ul>

                            <?php else: ?>

                              <ul class="header-action-list">
                                  <li><a href="auth/login"><i class="fa fa-power-off"></i> เข้าสู่ระบบ</a></li>
                                  <li>หรือ</li>
                                  <li><a href="auth/register"><i class="fa fa-user-plus"></i> สมัครเรียน</a></li>
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
                            <a href="home" class="logo"><img src="theme/aduca/assets/images/logo.png" alt="logo"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            <div class="menu-category">
                                <ul>
                                    <li>
                                        <a href="#"><i class="la la-th-large mr-1"></i>หมวดหมู่</a>
                                        <ul class="cat-dropdown-menu">
                                            <li><a href="course-grid.html">การลดต้นทุน/ประสิทธิภาพการผลิต</a></li>
                                            <li><a href="course-grid.html">ทักษะความเข้าใจและใช้เทคโนโลยีดิจิทัล</a></li>
                                            <li><a href="course-grid.html">กฎหมาย/มาตรฐาน</a></li>
                                            <li><a href="course-grid.html">การบริหารจัดการ</a></li>
                                            <li><a href="course-grid.html">การเงิน</a></li>
                                            <li><a href="course-grid.html">การตลาด</a></li>
                                            <li><a href="course-grid.html">ทักษะเฉพาะทาง (Skill set)</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="input-box">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="search" placeholder="ค้นหาข้อมูล">
                                            <span class="la la-search search-icon"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <nav class="main-menu">
                                <ul>
                                    <li><a href="course">หลักสูตรของ ส.อ.ท.</a></li>
                                    <li><a href="course/alliance">หลักสูตรจากพันธมิตร</a></li>
                                    <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>
                                    <li><a href="student/course">หลักสูตรนักเรียน</a></li>
                                    <?php else: ?>
                                    <?php endif; ?>
                                    <li><a href="contact">ติดต่อสถาบัน</a></li>
                                </ul>
                            </nav>

                            <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

                              <div class="logo-right-button">
                                  <a href="student" class="theme-btn-primary"><i class="fa fa-play-circle"></i> เข้าเรียน</a>
                              </div>

                            <?php else: ?>

                              <div class="logo-right-button">
                                  <a href="auth/login" class="theme-btn"><i class="fa fa-power-off"></i> เข้าระบบ</a>
                              </div>

                            <?php endif; ?>

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
