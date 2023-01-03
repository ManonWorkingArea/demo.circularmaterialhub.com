<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,maximum-scale=1.0">

      <?php engine::html("title");?>
      <meta name="description" content="">
      <meta name="keywords" content="">


      <!-- Favicon -->
      <link rel="icon" href="https://www.fti.or.th/wp-content/uploads/2020/03/cropped-favicon_v2-32x32.png" sizes="32x32" />
      <link rel="icon" href="https://www.fti.or.th/wp-content/uploads/2020/03/cropped-favicon_v2-192x192.png" sizes="192x192" />

      <style type="text/css">

			body
			{
				background: rgb(204,204,204);
        margin: 0 auto;
			}

			page
			{
				position: relative;
				background: white;
				display: block;
				margin: 0 auto;
				margin-bottom: 0.5cm;
				box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
			}

			page:before
			{
				content: "";
		    position: absolute;
		    top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
				background-image: url("https://academy.ecobz.training/theme/luma/assets/images/cer-bg-2.jpg");
				background-repeat: no-repeat;
				background-position: center;
				background-size: cover;
		    opacity: .3;
			}

			page[size="A4"]
			{
				width: 21cm;
				height: 29.7cm;
			}

			page[size="A4"][layout="landscape"]
			{
				width: 29.7cm;
				height: 21cm;
        top: 2cm;
			}

			page[size="A3"]
			{
				width: 29.7cm;
				height: 42cm;
			}

			page[size="A3"][layout="landscape"]
			{
				width: 42cm;
				height: 29.7cm;
			}

			page[size="A5"] {
				width: 14.8cm;
				height: 21cm;
			}

			page[size="A5"][layout="landscape"]
			{
				width: 21cm;
				height: 14.8cm;
			}

			@media print
			{
				body,html
				{
					margin-bottom: 0cm;
					margin: 0;
					box-shadow: 0 0 0cm rgba(0,0,0,0);
					border: 0px solid black;
					background-image: url("theme/luma/assets/images/cer-bg.jpg");
				}

				page
				{
					margin-bottom: 0cm;
					margin: 0;
					box-shadow: 0 0 0cm rgba(0,0,0,0);
					border: 0px solid black;
				}

        page[size="A4"][layout="landscape"]
  			{
  				width: 29.7cm;
  				height: 21cm;
          top: 0cm;
  			}

				@page
				{
					size: landscape;
					margin-bottom: 0cm;
					margin: 0;
				}
        .top-bar {
          display: none;
        }
			}

			.certified
			{
				text-align: center;
				padding: 0.5cm;
				position: relative;
			}

			.logo
			{
				margin-top: 1.3cm;
			}

			.title
			{
				 margin-top: 1cm;
				font-size: 0.4cm;
			}

			.sub
			{
				 margin-top: 1cm;
				font-size: 0.3cm;
			}

			.student
			{
				 margin-top: 1.5cm;
				font-size: 0.6cm;
			}

			.paragraph
			{
				 margin-top: 1cm;
				 font-size: 0.3cm;
			}

			.lesson
			{
				margin-top: 1cm;
				font-size: 0.6cm;
			}

			.teacher
			{
				 margin-top: 1cm;
				font-size: 0.4cm;
			}

			.footer
			{
				 margin-top: 1cm;
				font-size: 0.3cm;
			}

			.sign
			{
				text-align: center;
				padding: 0.5cm;
			}

			.qrcode
			{
				position: absolute;
				bottom: 0;
				right: 1.2cm;
			}

			.code
			{
				position: absolute;
				font-size: 0.3cm;
        left: 0.5cm;
			}

      </style>
   </head>
   <body>

			<page size="A4" layout="landscape">
				<div class="certified">
          <?php //print_r($data["Certification"]);?>
					<div class="logo"><img src="https://www.fti.or.th/wp-content/uploads/2019/09/fti_logo400_v1.png" alt="" title=""></div>
					<div class="title">FTI Academy สภาอุตสาหกรรมแห่งประเทศไทย</div>
					<div class="sub">มอบประกาศนียบัตรนี้ไว้เพื่อแสดงว่า</div>
					<div class="student"><?php echo $data["Certification"]['student']['student_firstname'] . " " . $data["Certification"]['student']['student_lastname'];?></div>
					<div class="paragraph">ได้ผ่านการเรียนออนไลน์ตามเกณฑ์การวัดผลในรายวิชา</div>
					<div class="lesson"><?php echo $data["Certification"]['lesson']['lesson_name'];?> (<?php echo $data["Certification"]['lesson']['lesson_hour'];?> ชั่วโมงการเรียนรู้)</div>
					<div class="teacher">พัฒนารายวิชาโดย <?php echo $data["Certification"]['school']['school_name'];?></div>
					<div class="footer">
						<div class="qrcode">
							<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=https://fti.academy/certification/show/<?php echo $data["Certification"]['certification']['stu_cert_token'];?>" title="Link to my Website" />
							<div class="code"><?php echo $data["Certification"]['certification']['stu_cert_token'];?></div>
						</div>
						<div class="sign"><img src="https://upload.wikimedia.org/wikipedia/commons/1/1c/Rose_Mofford_Signature.png" alt="" title="" width="150px"></div>
						นาย เก่งกาจ ชำนาญสอน</br>
						วิทยากร</br>
						สภาอุตสาหกรรมแห่งประเทศไทย</br>
					</div>
				</div>
			</page>

   </body>
</html>
