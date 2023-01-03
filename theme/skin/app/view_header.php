<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />

<?php engine::html("title");?>

<?php engine::html("app-theme","css","styles/bootstrap.css");?>
<?php engine::html("app-theme","css","styles/style.css");?>
<?php engine::html("app-theme","css","fonts/css/fontawesome-all.min.css");?>
<?php engine::html("app-theme","css","styles/custom.css");?>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<!-- cookiealert styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">

<link rel="apple-touch-icon" sizes="180x180" href="theme/skin/app/assets/app/icons/icon-192x192.png">

<?php engine::html("iehack");?>
<?php engine::html("css");?>

</head>

<body class="theme-light">

<div id="preloader">
  <div class="spinner-border color-highlight" role="status"></div>
</div>

<div id="page">

    <div class="header header-auto-show header-fixed header-logo-center">
        <a href="remote" class="header-title"><?php echo $GLOBALS["title"];?></a>
    </div>

    <div id="footer-bar" class="footer-bar-2">

        <a href="remote/calendar" id="remote-calendar-menu" class="">
            <i class="fa fa-calendar"></i>
            <span>การประชุม</span>
        </a>

        <a href="remote/news" id="remote-news-menu" class="">
            <i class="fa fa-bell"></i>
            <span>ข่าวสาร</span>
        </a>

        <a href="remote">
            <img class="nav-brand" src="theme/skin/app/assets/app/icons/icon-logo-72x72.png" alt="img" width="60">
        </a>

        <a href="remote/factory" id="remote-factory-menu" class="">
            <i class="fa fa-industry"></i>
            <span>โรงงาน</span>
        </a>

        <a href="remote/course" id="remote-course-menu" class="">
            <i class="fa fa-cube"></i>
            <span>ความรู้</span>
        </a>

    </div>

    <div class="page-title page-title-fixed">
        <h1><?php echo $GLOBALS["subtitle"];?></h1>
    </div>

    <div class="page-title-clear"></div>