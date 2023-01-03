<!-- Global Settings -->
<?php //engine::html("luma","js","js/settings.js");?>
<!-- Flatpickr -->
<?php //engine::html("luma","js","vendor/flatpickr/flatpickr.min.js");?>
<?php //engine::html("luma","js","js/flatpickr.js");?>
<!-- Moment.js -->
<?php //engine::html("luma","js","vendor/moment.min.js");?>
<?php //engine::html("luma","js","vendor/moment-range.min.js");?>
<!-- Chart.js -->
<?php //engine::html("luma","js","vendor/Chart.min.js");?>
<?php //engine::html("luma","js","js/chartjs.js");?>
<!-- Chart.js Samples -->
<?php //engine::html("luma","js","js/page.student-dashboard.js");?>
<!-- List.js -->
<?php //engine::html("luma","js","vendor/list.min.js");?>
<?php //engine::html("luma","js","js/list.js");?>
<!-- Tables -->
<?php //engine::html("luma","js","js/toggle-check-all.js");?>
<?php //engine::html("luma","js","js/check-selected-row.js");?>

<script>

$(document).ready(function()
{
	//$("#district").select2();
	//$("#amphures").select2();
	//$("#province").select2();
	//$("#zipcode").select2();

	$("#province").change(function()
	{
	  if ($(this).data('options') === undefined)
	  {
		$(this).data('options', $('#amphures option').clone());
	  }
	  var id = $(this).val();
	  var options = $(this).data('options').filter('[data-val=' + id + ']');
	  $('#amphures').html(options);

	    $("#amphures").select2("destroy");
		$("#amphures").select2();

		console.log(options);

	});

	$("#amphures").change(function()
	{
	  if ($(this).data('options') === undefined)
	  {
		$(this).data('options', $('#district option').clone());
	  }
	  var id = $(this).val();
	  var options = $(this).data('options').filter('[data-val=' + id + ']');
	  $('#district').html(options);

	    $("#district").select2("destroy");
		$("#district").select2();

		console.log(options);

	});

	$("#district").change(function()
	{
	  if ($(this).data('options') === undefined)
	  {
		$(this).data('options', $('#zipcode option').clone());
	  }
	  var id = $(this).val();
	  var options = $(this).data('options').filter('[data-val=' + id + ']');
	  $('#zipcode').html(options);

	    $("#zipcode").select2("destroy");
		$("#zipcode").select2();

		console.log(options);

	});

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

function editaddress()
{
	run_waitMe($('#frm-editaddress'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/edit-address",
		data : $("#frm-editaddress").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#frm-editaddress').waitMe('hide');

			status 	= response.status
			title 		= response.title
			msg 		= response.return

			if(status=="true")
			{
				swal(
				{
					title: title,
					text: msg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
					reload();
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

function editprofile()
{
	run_waitMe($('#frm-editprofile'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/edit-profile",
		data : $("#frm-editprofile").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#frm-editprofile').waitMe('hide');

			status 	= response.status
			title 		= response.title
			msg 		= response.return

			if(status=="true")
			{
				swal(
				{
					title: title,
					text: msg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
					reload();
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

function editpassword2()
{
	run_waitMe($('#frm-editpassword'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/edit-password",
		data : $("#frm-editpassword").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#frm-editpassword').waitMe('hide');

			status 	= response.status
			title 		= response.title
			msg 		= response.return

			if(status=="true")
			{
				swal(
				{
					title: title,
					text: msg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
					reload();
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
	run_waitMe($('.page-content'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/signin",
		data : $("#frm-signin").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.padding').waitMe('hide');

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
						page("home");
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
	run_waitMe($('#ajaxForgotPasswordModal'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/forgotpassword",
		data : $("#frm-forgot").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#ajaxForgotPasswordModal').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				$('#ajaxForgotPasswordModal').modal('hide');
				$('#ajaxForgotPasswordModal').on('hidden.bs.modal', function ()
				{
					swal(
					{
						title: "สมัครสมาชิกเรียบร้อย",
						text: "กรุณาตรวจสอบอีเมล์ที่คุณใช้สมัคร <br>เพื่อทำการยืนยันการสมัครสมาชิก..",
						html: true,
						showConfirmButton: true
					},
					function()
					{
					});
				})
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

function register()
{
	run_waitMe($('#register-form'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/signup",
		data : $("#frm-signup").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#register-form').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				$('#register-form').modal('hide');
				$('#register-form').on('hidden.bs.modal', function ()
				{
					swal(
					{
						title: "สมัครสมาชิกเรียบร้อย",
						text: "กรุณาตรวจสอบอีเมล์ที่คุณใช้สมัคร <br>เพื่อทำการยืนยันการสมัครสมาชิก..",
						html: true,
						showConfirmButton: true
					},
					function()
					{
						page("home");
					});
				})
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

function editProfile()
{
	run_waitMe($('.user-form'), 1, "win8_linear");
	$.ajax(
	{
		type : "POST",
		url : "student/action/edit-profile",
		data : $("#frm-edit-profile").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.user-form').waitMe('hide');

			status 	= response.status
			msg 		= response.return

      if(status=="true")
			{
				name	= response.name
        $.prompt("บันทึกข้อมูลของคุณแล้ว",
				{
					title		: "แก้ไขข้อมูลส่วนตัว",
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
					title		: "เกิดข้อผิดหลาด",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
					}
				});
			}
		}
	});
}

function editPassword()
{
	run_waitMe($('.user-form'), 1, "win8_linear");
	$.ajax(
	{
		type : "POST",
		url : "student/action/edit-password",
		data : $("#frm-edit-password").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.user-form').waitMe('hide');

			status 	= response.status
			msg 		= response.return

      if(status=="true")
			{
				name	= response.name
        $.prompt("บันทึกข้อมูลของคุณแล้ว",
				{
					title		: "แก้ไขข้อมูลส่วนตัว",
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
					title		: "เกิดข้อผิดหลาด",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
					}
				});
			}
		}
	});
}

function getBaseUrl ()
{
    var file = document.querySelector('input[type=file]')['files'][0];
    var reader = new FileReader();
    var baseString;
    reader.onloadend = function ()
		{
        baseString = reader.result;
				$("#preview-profile").attr('src',baseString);
				$("#avatar").val(baseString);

    };
    reader.readAsDataURL(file);
}


</script>
