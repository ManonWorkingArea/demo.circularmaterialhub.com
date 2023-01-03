   <!-- Main Menu-->
   <div id="menu-main" class="menu menu-box-left rounded-0" data-menu-load="menu-main.html" data-menu-width="280" data-menu-active="nav-welcome"></div>
    <!-- Share Menu-->
    <div id="menu-share" class="menu menu-box-bottom rounded-m" data-menu-load="menu-share.html" data-menu-height="370"></div>
    <!-- Colors Menu-->
    <div id="menu-colors" class="menu menu-box-bottom rounded-m" data-menu-load="menu-colors.html" data-menu-height="480"></div>
    <!-- Be sure this is on your main visiting page, for example, the index.html page-->
    <!-- Install Prompt for Android -->

    <!-- <div id="menu-install-pwa-android" class="menu menu-box-bottom rounded-m"
        data-menu-height="400"
        data-menu-effect="menu-parallax">
        <img class="mx-auto mt-4 rounded-m" src="app/icons/icon-128x128.png" alt="img" width="90">
        <h4 class="text-center mt-4 mb-2">Eco Factory on your Home Screen</h4>
        <p class="text-center boxed-text-xl">
            Install Eco Factory on your home screen, and access it just like a regular app. It really is that simple!
        </p>
        <div class="boxed-text-l">
            <a href="#" class="pwa-install btn-center-l btn btn-m font-600 gradient-highlight rounded-sm">Add to Home Screen</a>
            <a href="#" class="pwa-dismiss close-menu btn-full mt-3 pt-2 text-center text-uppercase font-600 color-red-light font-12">Maybe later</a>
        </div>
    </div> -->

    <!-- Install instructions for iOS -->

    <!-- <div id="menu-install-pwa-ios"
        class="menu menu-box-bottom rounded-m"
        data-menu-height="360"
        data-menu-effect="menu-parallax">
        <div class="boxed-text-xl top-25">
            <img class="mx-auto mt-4 rounded-m" src="app/icons/icon-128x128.png" alt="img" width="90">
            <h4 class="text-center mt-4 mb-2">Eco Factory on your Home Screen</h4>
            <p class="text-center ml-3 mr-3">
                Install Eco Factory on your home screen, and access it just like a regular app. Open your Safari menu and tap "Add to Home Screen".
            </p>
            <a href="#" class="pwa-dismiss close-menu btn-full mt-3 text-center text-uppercase font-900 color-red-light opacity-90 font-110">Maybe later</a>
        </div>
    </div> -->

</div>

<!-- START Bootstrap-Cookie-Alert -->
<div class="alert text-center cookiealert" role="alert">
    <b>แอปพลิเคชั่น มีการเก็บข้อมูลการใช้งานเว็บไซต์ (Cookies)</b> &#x1F36A; เพื่อมอบบริการที่ดีที่สุดสำหรับคุณ โดยการเข้าใช้งานเว็บไซต์ ถือเป็นการยอมรับในเงื่อนไขการใช้งานเว็บไซต์ <a href="cookiepolicy" target="_blank">คำอธิบาย</a>
    <button type="button" class="btn btn-primary btn-sm acceptcookies">
        ยอมรับ
    </button>
</div>
<!-- END Bootstrap-Cookie-Alert -->

<?php engine::html("app-theme","js","scripts/jquery.js");?>
<?php engine::html("app-theme","js","scripts/bootstrap.min.js");?>
<?php engine::html("app-theme","js","scripts/custom.js");?>

<?php engine::html("activenav");?>
<?php engine::html("global-js");?>
<?php engine::html("js");?>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<!-- Include cookiealert script -->
<!-- <script src="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.js"></script> -->
<script>
// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;
var pusher = new Pusher('b8ef5ae057e5b187d725', {
cluster: 'ap1'
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
alert(JSON.stringify(data));
});
</script>