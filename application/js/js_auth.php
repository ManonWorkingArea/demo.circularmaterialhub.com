<!-- Global Settings -->
<?php engine::html("luma","js","js/settings.js");?>
<!-- Flatpickr -->
<?php engine::html("luma","js","vendor/flatpickr/flatpickr.min.js");?>
<?php engine::html("luma","js","js/flatpickr.js");?>
<!-- Moment.js -->
<?php engine::html("luma","js","vendor/moment.min.js");?>
<?php engine::html("luma","js","vendor/moment-range.min.js");?>
<!-- Chart.js -->
<?php engine::html("luma","js","vendor/Chart.min.js");?>
<?php engine::html("luma","js","js/chartjs.js");?>
<!-- Chart.js Samples -->
<?php engine::html("luma","js","js/page.student-dashboard.js");?>
<!-- List.js -->
<?php engine::html("luma","js","vendor/list.min.js");?>
<?php engine::html("luma","js","js/list.js");?>
<!-- Tables -->
<?php engine::html("luma","js","js/toggle-check-all.js");?>
<?php engine::html("luma","js","js/check-selected-row.js");?>

<script>

$(document).ready(function()
{

	var $myDiv = $('#bypass_login');

    if ( $myDiv.length)
		{
    login();
    }

});


$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password")
	{
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});


function confirm()
{
	run_waitMe($('.confirmation-wrapper'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/confirm",
		data : $("#frm-confirm").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.confirmation-wrapper').waitMe('hide');

			status = response.status
			returntitle 	= response.title
			returnmsg 	= response.return
			returndo 	= response.do

			if(status=="true")
			{
				swal(
				{
					title: returntitle,
					text: returnmsg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
					if(returndo=="login")
					{
						var $modal = $('#ajaxLoginModal');

						$('body').modalmanager('loading');
						setTimeout(function()
						{
							$('#ajaxLoginModal').load('student/page/signin', '', function()
							{
								$('#ajaxLoginModal').modal();
							});
						}, 100);
					}
					else
					{
						page("student/profile");
					}

				});

			}
			else
			{
				$("body").overhang(
				{
					type: "warn",
					message: msg,
					duration: 2,
					upper: true
				});
			}
		}
	});

}


function login()
{
	run_waitMe($('body'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/login",
		data : $("#frm-signin").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('body').waitMe('hide');

			status = response.status
			msg 	 = response.return

			if(status=="true")
			{
				$.prompt(msg,
				{
					title		: "แจ้งการเข้าสู่ระบบ",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						page("member");
					}
				});
			}
			else
			{
				$.prompt(msg,
				{
					title		: "ไม่สามารถเข้าสู่ระบบได้",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						close_waitMe($('.page-content'));
					}
				});
			}
		}

	});
}

function forgotpassword()
{
	run_waitMe($('.card-box-shared'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/forgotpassword",
		data : $("#frm-forgot").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.card-box-shared').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				$.prompt(msg,
				{
					title		: "ส่งคำขอแก้ไขรหัสผ่านแล้ว กรุณาตรวจสอบอีเมล์เพื่อทำรายยืนยันหารเปลี่ยนรหัส่ผ่าน",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						page("auth/login");
					}
				});
			}
			else
			{
				$.prompt(msg,
				{
					title		: "เกิดข้อผิดพลาด",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						close_waitMe($('.page-content'));
					}
				});
			}
		}
	});
}

function register()
{
	run_waitMe($('body'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/signup",
		data : $("#frm-signup").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('body').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{

				$.prompt(msg,
				{
					title		: "สมัครสมาชิกเรียบร้อย",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						page("auth/login");
					}
				});
			}
			else
			{
				$.prompt(msg,
				{
					title		: "ไม่สามารถสมัครสมาชิกได้",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						close_waitMe($('.page-content'));
					}
				});
			}
		}
	});
}

function resetPassword()
{
	run_waitMe($('.card-box-shared'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/recovery",
		data : $("#frm-reset").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.card-box-shared').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				$.prompt(msg,
				{
					title		: "เปลี่ยนรหัสผ่านเรียบร้อย",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						page("auth/login");
					}
				});
			}
			else
			{
				$.prompt(msg,
				{
					title		: "เกิดข้อผิดพลาด",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						close_waitMe($('.page-content'));
					}
				});
			}
		}
	});
}

</script>
