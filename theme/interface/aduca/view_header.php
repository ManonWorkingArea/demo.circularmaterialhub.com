<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php engine::html("title");?>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;300;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Favicon -->
    <link rel="icon" href="https://www.fti.or.th/wp-content/uploads/2020/03/cropped-favicon_v2-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://www.fti.or.th/wp-content/uploads/2020/03/cropped-favicon_v2-192x192.png" sizes="192x192" />

    <link rel="stylesheet" href="https://unpkg.com/microtip/microtip.css">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <!-- cookiealert styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
    <!-- inject:css -->
    <?php engine::html("theme","css","css/bootstrap.min.css");?>
    <?php engine::html("theme","css","css/font-awesome.min.css");?>
    <?php engine::html("theme","css","css/line-awesome.css");?>
    <?php engine::html("theme","css","css/animate.min.css");?>
    <?php engine::html("theme","css","css/owl.carousel.min.css");?>
    <?php engine::html("theme","css","css/owl.theme.default.min.css");?>
    <?php engine::html("theme","css","css/bootstrap-select.min.css");?>
    <?php engine::html("theme","css","css/fancybox.css");?>
    <?php engine::html("theme","css","css/tooltipster.bundle.css");?>
    <?php engine::html("theme","css","css/jquery.filer.css");?>

    <?php engine::html("theme","css","css/style.css");?>
    <?php engine::html("theme","css","css/custom.css");?>

    <!-- template js files -->
    <?php engine::html("theme","js","js/jquery-3.4.1.min.js");?>

    <?php engine::html("iehack");?>
    <?php engine::html("css");?>

    <!-- end inject -->
</head>
<?php engine::html("body");?>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<div class="modal fade" id="messagePopup" tabindex="-1" aria-labelledby="messagePopup" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title root-subject">...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message-content">
            <div class="header">
                <div class="sender root-sender"></div>
                <div class="date root-date"></div>
            </div>
            <div class="body root-body"></div>
        </div>
        <div class="message-reply" id="reply-table"></div>
        <div class="message-return">
            <form method="post" id="frm-message" class="contact-form">
                <input type="hidden" class="form-control form--control" id="token" name="token" value="">
                <input type="hidden" class="form-control form--control" id="member" name="member" value="<?php echo engine::user("etracking");?>">
                <div class="input-box">
                    <label class="label-text">ตอบกลับ</label>
                    <div class="form-group">
                        <textarea id="message" class="form-control form--control" name="message" rows="5" placeholder="เขียนข้อความ..."></textarea>
                    </div>
                </div><!-- end input-box -->
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
        <button type="button" id="send-message-btn" class="btn btn-primary float-right" onclick="replyMessage();"><i class="fa fa-send"></i> ส่งข้อความ</button>
      </div>
    </div>
  </div>
</div>
