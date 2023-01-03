<?php

if($data["Certification"]['lesson']['lesson_code'] == "auditor-eco")
{
  $cer_bg = "theme/interface/aduca/assets/images/cert/cert-consultant-2.jpg";
}
else if($data["Certification"]['lesson']['lesson_code'] == "verify-eco")
{
  $cer_bg = "theme/interface/aduca/assets/images/cert/cer-auditor.jpg";
}

?>

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

      <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">

      <!-- jQuery -->
      <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>

      <!-- Bootstrap files (jQuery first, then Popper.js, then Bootstrap JS) -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>

      <script type="text/JavaScript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>


      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
      <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

      <style type="text/css">

			body
			{
				background: rgb(204,204,204);
        margin: 0 auto;
        font-family: 'Sarabun', sans-serif;
			}

			page
			{
				position: relative;
				background: white;
				display: block;
				margin: 0 auto;
				margin-bottom: 0.5cm;
			}

			page:before
			{
				content: "";
		    position: absolute;
		    top: 0;
		    bottom: 0;
		    left: 0;
		    right: 0;
				background-image: url("<?php echo $cer_bg;?>");
				background-repeat: no-repeat;
				background-position: center;
				background-size: cover;
		    opacity: 1;
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
					background-image: url("<?php echo $cer_bg;?>");
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
				text-align: right;
				padding: 0.5cm;
				position: relative;
        z-index: 2;
			}

			.logo
			{
				height: 50px;
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

      .student {
    margin-top: 6.8cm;
    margin-bottom: 1.3cm;
    font-size: 1cm;
    margin-right: 0.9CM;
    color: #000000;
}

			.paragraph
			{
				 margin-top: 0.1cm;
				 font-size: 0.8cm;
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
        bottom: -9.3cm;
        right: 1.1cm;
			}

      .code {
            position: relative;
            font-size: 0.3cm;
            /* left: -4.5cm; */
            width: 100%;
            bottom: -0.5cm;
            text-transform: uppercase;
            font-weight: bold;
        }

      .navbar {
        min-height: 50px;
        color: #000;
        background: rgb(246,246,246);
        background: linear-gradient(0deg, rgba(246,246,246,1) 0%, rgba(233,233,233,1) 54%);
      }

      .page_bg
      {
        position: absolute;
        top: 0;
        width: 29.7cm;
        height: 21cm;
        z-index: 1;
      }

      .page_bg img
      {
        width: 29.7cm;
        height: 21cm;
      }

      </style>

      <script>

        function print()
        {
          $("#printarea").print();
        }

        function download()
        {
            $('#topbar').hide();
            html2canvas(document.querySelector('#printarea'), {useCORS: true}).then(function(canvas)
            {
              let img = new Image();
              img.src = canvas.toDataURL('image/jpeg');
              img.onload = function ()
              {
                let pdf = new jsPDF('landscape', 'mm', 'a4');
                pdf.addImage(img, 0, 0, pdf.internal.pageSize.width, pdf.internal.pageSize.height);
                pdf.save('<?php echo $data["Certification"]['certification']['stu_cert_token'];?>.pdf');
                $('#topbar').show();
              };
            });
        }

      </script>

   </head>
   <body>

     <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="topbar">
       <div class="col-md-4 text-left"><img src="theme/interface/aduca/assets/images/logo.png" alt="logo" class="logo"></div>
       <div class="col-md-4 text-center">Certifications</div>
       <div class="col-md-4 text-right">
         <button type="button" class="btn btn-primary" onclick="download();"><i class="fa fa-download"></i> Download</button>
         <button type="button" class="btn btn-primary" onclick="print();"><i class="fa fa-print"></i> Print</button>
     </nav>

     <div class="container">
       <page size="A4" layout="landscape" id="printarea" class="html-content">
         <div class="certified">
           <?php //print_r($data["Certification"]);?>
           <div class="student"><strong><?php echo $data["Certification"]['student']['student_firstname'] . " " . $data["Certification"]['student']['student_lastname'];?></strong></div>
           <div class="footer">
             <div class="qrcode">
               <div class="code">CERTIFICATE NO.<?php echo $data["Certification"]['certification']['stu_cert_token'];?></div>
              <div class="code">CERTIFICATE DATE.<?php echo engine::thaidate($data["Certification"]['certification']['stu_cert_adddate']);?></div>
             </div>
           </div>
         </div>
         <div class="page_bg"><img src="<?php echo $cer_bg;?>" title="Link to my Website" /></div>
       </page>
     </div>


   </body>
</html>
