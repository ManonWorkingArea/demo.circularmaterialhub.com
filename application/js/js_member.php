<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<script>

function submitApplication(token)
{
	$.ajax(
  {
    type 	: "POST",
    url 	: "app/action/submit-application",
		data	: {'token': token},
    dataType : "json",
    success : function(response)
    {
      status 	= response.status
      msg 		= response.return
      //console.log(response);
      if(status == "true")
      {
				$.prompt(msg,
				{
					title		: "การแจ้งเตือน",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						reload();
					}
				});
      }
      else
      {
				$.prompt(msg,
				{
					title		: "การแจ้งเตือน",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
					}
				});
      }
    }
  });
}

//MULTIPLE UPLOAD JS
//------------------------------------------------------------------------------

function uploadMultiple(type)
{
	var images = $('#media-list-' + type).find('img').map(function() { return this.src; }).get();
	var token  = $("#ap_form_token").val();
	//console.log(images);
	localStorage.upload = "yes";

	//blockLoading();

	$.ajax(
  {
    type : "POST",
    url : "app/action/upload-multiple-document",
		data:
		{
        myarray: images,type:type,token:token
    },
    dataType : "json",
    success : function(response)
    {
			//$.unblockUI();

      status 	= response.status
      msg 		= response.return
			logic 	= response.logic
      //console.log(response);
      if(status == "true")
      {
				$('.toast').toast('show');
				iziToast.success(
				{
						title: 'สำเร็จ',
						position: 'topRight',
						transitionIn: 'fadeInDown',
						message: msg,
						timeout: 1000,
						onClosed: function ()
						{
							//reload();
						}
				});
      }
      else
      {
				iziToast.error(
				{
						title: 'เกิดข้อผิดพลาด',
						position: 'topRight',
						transitionIn: 'fadeInDown',
						timeout: 1000,
						message: msg,
						onClosed: function(instance, toast, closedBy)
						{
							if(logic=="back")
							{
								page("app/detail");
							}
						}
				});
      }
    }
  });
}

function deleteDocument(image,ids)
{
	//console.log(image);
	//blockLoading();
	localStorage.upload = "yes";

	$.ajax(
  {
    type : "POST",
    url : "app/action/delete-document",
		data:
		{
        image: image
    },
    dataType : "json",
    success : function(response)
    {
			//$.unblockUI();

      status 	= response.status
      msg 		= response.return
      //console.log(response);
      if(status == "true")
      {
				iziToast.success(
				{
						title: 'สำเร็จ',
						position: 'topRight',
						transitionIn: 'fadeInDown',
						message: msg,
						timeout: 1000,
				});
				$("#" + ids).fadeOut("slow");
      }
      else
      {
				iziToast.error(
				{
						title: 'เกิดข้อผิดพลาด',
						position: 'topRight',
						transitionIn: 'fadeInDown',
						timeout: 1000,
						message: msg
				});
      }
    }
  });
}



$('.bs-example-modal-center').on('hidden.bs.modal', function (e)
{
	if(localStorage.upload==="yes")
	{
		localStorage.upload = "no";
		reload();
	}
})

function upload_document(doc)
{
	console.log("Modal");
	$('#hint_brand_' + doc).modal('show');
}

<?php

	$i = "0";
	foreach ($GLOBALS['document'] as $document)
	{
		$code = $document['document_code'];
		echo "$('[data-fancybox=\"document-{$code}\"]').fancybox({thumbs :{autoStart : true}});";
	}

	echo "$(function(){var names = [];";

	$i = "0";
	foreach ($GLOBALS['document'] as $document)
	{
		$i++;
		$code = $document['document_code'];
		$name = $document['document_name'];
		$desc = $document['document_desc'];
		echo'
		$("#hint_brand_'.$code.'").on("click", ".remove-pic", function()
    {
        $(this).parent().parent().parent().remove();
        var removeItem = $(this).attr("data-id");
        var yet = names.indexOf(removeItem);

        if (yet != -1)
        {
            names.splice(yet, 1);
        }
        console.log(names);
    });

		// Multiple upload
		//--------------------------------------------------------------------------

		$("#hint_brand_' . $code . '").on("change", ".picupload", function(event)
    {
      var getAttr = $(this).attr("click-type");
      var files = event.target.files;
      var output = document.getElementById("media-list-' . $code . '");
      var z = 0
      if (getAttr == "type2")
      {
          for (var i = 0; i < files.length; i++)
          {
              var file = files[i];
              names.push($(this).get(0).files[i].name);

							console.log($(this).get(0).files[i].type);

              if (file.type.match("image"))
              {
                  var picReader = new FileReader();
                  picReader.fileName = file.name
                  picReader.addEventListener("load", function(event)
                  {
                      var picFile = event.target;
                      var div = document.createElement("li");
                      div.className = "tip";
                      div.setAttribute("tooltip", event.target.fileName);
                      div.title = event.target.fileName;
                      div.innerHTML = "<img src=\'" + picFile.result + "\'" + "title=\'" + event.target.fileName + "\'/><div  class=\'post-thumb\'><div class=\'inner-post-thumb\'><a href=\'javascript:void(0);\' data-id=\'" + event.target.fileName + "\' class=\'remove-pic\'><i class=\'fa fa-times\' aria-hidden=\'true\'></i></a><div></div>";
                      $("#media-list-' . $code . '").prepend(div);
                  });
              }

							if (file.type.match("pdf"))
              {
                  var picReader = new FileReader();
                  picReader.fileName = file.name
                  picReader.addEventListener("load", function(event)
                  {
                      var picFile = event.target;
                      var div = document.createElement("li");
                      div.className = "tip";
                      div.setAttribute("tooltip", event.target.fileName);
                      div.title = event.target.fileName;
                      div.innerHTML = "<img src=\'" + picFile.result + "\'" + "title=\'" + event.target.fileName + "\'/><div  class=\'post-thumb\' style=\'background-image: url(https://cdn.ftievoucher.com/img.php?file=voucher/document/default/pdf-file.jpg);background-size: cover;\'><div class=\'inner-post-thumb\'><a href=\'javascript:void(0);\' data-id=\'" + event.target.fileName + "\' class=\'remove-pic\'><i class=\'fa fa-times\' aria-hidden=\'true\'></i></a><div></div>";
                      $("#media-list-' . $code . '").prepend(div);
                  });
              }
              picReader.readAsDataURL(file);
          }
          console.log(names);
        }
    });';
	}
	echo "});";
?>

</script>
