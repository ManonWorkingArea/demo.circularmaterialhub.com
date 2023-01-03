<!--Header Start-->
<header class="header-style-2">
   <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="home"><img src="theme/skin/ecova/assets/images/h2logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <i class="fas fa-bars"></i> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
           <li class="nav-item"> <a class="nav-link" href="page/view/guidelines">หลักเกณฑ์ Eco Factory</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/benefits">สิทธิประโยชน์</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/procedure">ขั้นตอนและตารางประชุม</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/news">ประชาสัมพันธ์</a> </li>
           <li class="nav-item"> <a class="nav-link" href="course">เรียนออนไลน์</a> </li>
         </ul>
      </div>
   </nav>

   <nav class="navbar navbar-expand-lg sub-menu">
      <a class="navbar-brand" href="home"></a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav">
           <li class="nav-item"> <a class="nav-link" href="page/view/download">ดาวน์โหลดเอกสาร</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/certified_verifier">รายชื่อที่ปรึกษา</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/certified_auditor">รายชื่อผู้ตรวจประเมิน</a> </li>
           <li class="nav-item"> <a class="nav-link" href="page/view/certified_factory">รายชื่อโรงงานที่ได้รับการรับรอง</a> </li>
           <!--<li class="nav-item"> <a class="nav-link" href="app">แบบฟอร์มการสมัคร</a> </li>-->

           <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

             <li class="nav-item"> <a class="nav-link" href="member"><i class="fa fa-user"></i> <?php echo engine::student("firstname");?></a> </li>
             <li class="nav-item"> <a class="nav-link" href="javascript:void(0);" onclick="signout();"><i class="fa fa-power-off"></i> ออกจากระบบ</a> </li>

           <?php else: ?>

             <li class="nav-item"> <a class="nav-link" href="auth/login"><i class="mdi mdi-account-plus-outline"></i> เข้าสู่ระบบ</a> </li>
             <li class="nav-item"> <a class="nav-link" href="auth/register"><i class="mdi mdi-login"></i> สมัครสมาชิก</a> </li>

           <?php endif; ?>

         </ul>
         <!-- <ul class="topnav-right">
            <li> <a class="mdonate" href="app"><span>ใบสมัคร</span></a> </li>

            <?php if(isset($_SESSION["Student"]) && $_SESSION["Student"]["login"]): ?>

              <li class="login-reg"> <a href="student">เข้าเรียน</a></li>

            <?php else: ?>

              <li> <a class="search-icon" href="#search"> <i class="fas fa-search"></i> </a> </li>
              <li class="login-reg"> <a href="auth/login">เข้าสู่ระบบ</a> | <a href="auth/register">สมัครสมาชิก</a> </li>

            <?php endif; ?>

         </ul> -->
      </div>
   </nav>
</header>
<div id="search">
   <button type="button" class="close">×</button>
   <form class="search-overlay-form">
      <input type="search" value="" placeholder="type keyword(s) here" />
      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
   </form>
</div>
