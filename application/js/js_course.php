<script>

 $('#accordion').on('shown', function ()
 {
  $('#accordion .in').parent().find('input[name=address]').prop('checked',true);
  console.log("select");
});

$(function ()
{

  if( $('.preview_player').length )         // use this if you are using id to check
  {
    var player = new Plyr('.preview_player');
  }

  if( $('.datepicker').length )         // use this if you are using id to check
  {
    $('.datepicker').datepicker(
	{
		format: 'yyyy-mm-dd'
	});
  }

  if( $('.timepicker').length )         // use this if you are using id to check
  {
	$('.timepicker').timepicker(
	{
		showMeridian: false,
		minuteStep:1
	});
  }


	$('input[name="additional_checkbox"]').on('click',function ()
	{
       if($('input[name="additional_checkbox"]').is(':checked'))
		{
			console.log("Check");
			console.log($(this).data('code'));
			addToCart_option($(this));
		}
		else
		{
			console.log("Uncheck");
			console.log($(this).data('code'));
			removeProduct($('.product-' + $(this).data('code')));
		}
    });

	if( $(':file').length )         // use this if you are using id to check
	{
		$(":file").filestyle('buttonText', 'เลือกรูป',{buttonBefore: true,badge: false,size: "md"});
	}

	if( $('#coursetree').length )         // use this if you are using id to check
	{
		$('#coursetree').jstree(
		{
			'core':
			{
				'themes':
				{
					'name': 'proton',
					'responsive': true
				}
			},
			"plugins" : [ "search","types"],
			'types' :
			{
				'default' :
				{
					'icon' : 'folder-close'
				},
				'f-open' :
				{
					'icon' : 'folder-open'
				},
				'f-closed' :
				{
					'icon' : 'folder-close'
				}
			}
		});
	}


	

  var to = false;
  $('#plugins4_q').keyup(function ()
  {
    if(to)
	{
		clearTimeout(to);
	}
    to = setTimeout(function ()
	{
      var v = $('#plugins4_q').val();
      $('#coursetree').jstree(true).search(v);
    }, 250);
  });


$('#coursetree')
  // listen for event
  .on('changed.jstree', function (e, data)
  {
    var i, j, r = [];
	var topic = "";
    for(i = 0, j = data.selected.length; i < j; i++)
	{
		r.push(data.instance.get_node(data.selected[i]).text);

		topic = data.node.data.jstree.id
		console.log(data.node.data.jstree.id);

		getTopic(topic);

    }
    $('#event_result').html('<strong>Selected : </strong>' + r.join(', '));
  })
  // create the instance
  .jstree();

  /* Toggle between folder open and folder closed */
$("#coursetree").on('open_node.jstree', function (event, data)
{
    data.instance.set_type(data.node,'f-open');
});
$("#coursetree").on('close_node.jstree', function (event, data)
{
    data.instance.set_type(data.node,'f-closed');
});

function getTopic(topic)
{
	$.ajax(
	{
		type : "POST",
		url : "course/action/get-topic",
		data : {'topic':topic},
		dataType : "json",
		success : function(response)
		{
			//console.log(response)

			status 	= response.status
			msg 		= response.return

			vdo 		= response.topic_video
			name 	= response.topic_name
			poster 	= response.topic_poster

			//console.log("vdo : " + vdo)

			if(status == "true")
			{
				if(vdo === undefined || vdo === null)
				{
					//console.log("Folder Click !!");
				}
				else
				{
					$('.topic-title').html(name);
					player1.setVideoSource("https://content.me-rean.com/player.php?video=" + vdo);
					player1.setPosterSource("https://content.me-rean.com/img.php?file=" + poster);
				}
			}
			else
			{
			}
		}
	});
}

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

$("#district").select2();
$("#amphures").select2();
$("#province").select2();
$("#zipcode").select2();

});

function updateProfile()
{
	run_waitMe($('#frm-editprofile'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "course/action/update-profile",
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

function confirmOrder()
{
	var payment = $('input[name=payments]:checked').val();
	var complete = "<?php $student = engine::student("complete"); echo $student['status']?>";

	if(payment === undefined || payment === null)
	{
		swal(
		{
			title: "เกิดข้อผิดพลาด",
			text: "กรุณาเลือกวิธีการชำระเงิน",
			html: true,
			showConfirmButton: true
		});
	}
	else if(complete == "false")
	{
		swal(
		{
			title: "เกิดข้อผิดพลาด",
			text: "กรุณาตรวจสอบข้อมูลส่วนตัวให้เรียบร้อย",
			html: true,
			showConfirmButton: true
		});
	}
	else
	{
		swal(
		{
			title: "ยืนยันการสั่งซื้อคอร์สนี้ ?",
			text: "คุณต้องการยืนยันการสั่งซื้อคอร์สนี้",
			imageUrl: "https://content.me-rean.com/img.php?file=<?php echo $_SESSION["School"]['logo'];?>",
			confirmButtonText: "ยืนยันการสั่งซื้อ",
			cancelButtonText: "ยกเลิก",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: false,
		},
		function()
		{
			run_waitMe($('.creditly-card-form'), 1, "win8_linear");
			$.ajax(
			{
				type : "POST",
				url : "course/action/confirm-order",
				data : $('#frm-order,#frm-voucher,#frm-optional').serialize(),
				dataType : "json",
				beforeSend: function()
				{
					run_waitMe($('.sweet-alert'), 1, "win8_linear");
				},
				success : function(response)
				{
					console.log(response)

					$('.creditly-card-form').waitMe('hide');
					$('.sweet-alert').waitMe('hide');

					status 		= response.status
					returntitle 	= response.title
					returnmsg 	= response.return
					returncode = response.code
					returnorder = response.order

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
							page("course/complete/" + returnorder);
						});
					}
					else
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
						});
						/*
						$("body").overhang(
						{
							type: "warn",
							message: returnmsg,
							duration: 2,
							upper: true
						});*/
					}
				}
			});
		});
	}

}


function cancelOrder()
{

	swal(
	{
	  title: 'คุณต้องการยกเลิกรายการสั่งซื้อนี้ ?',
	  text: "เมื่อลบแล้วคุณจะไม่สามารถกู้คืนข้อมูลได้อีก !",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel plx!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm)
	{
	  if(isConfirm)
	  {
		$.ajax(
		{
			type : "POST",
			url : "course/action/cancel-order",
			dataType : "json",
			success : function(response)
			{

				status 	= response.status
				msg 		= response.return

				console.log(status);

				if(status == "true")
				{
					swal(
					{
						 title: 'ลบเรียบร้อย !',
						  text: 'ข้อมูลของคุณถูกลบเรียบร้อย.',
						  type: 'success',
						timer: 2000,
						showConfirmButton: true
					},
					function()
					{
						reload();
					});
				}
				else
				{
					swal(
					{
						title: 'เกิดข้อผิดพลาด !',
						html: msg,
						type: 'error',
						timer: 2000,
						showConfirmButton: true
					},
					function()
					{
					});
				}
			}
		});
	  }
	  else
	  {
		swal("Cancelled", "Your imaginary file is safe :)", "error");
	  }
	});
};

function transferBox()
{
    $('.confirm-form').slideToggle('slow');
}

function confirmTransfer()
{
	run_waitMe($('#review-form'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "course/action/confirm-transfer",
		data : $("#frm-confirmtransfer").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#review-form').waitMe('hide');

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

function readURL(input)
{
	if (input.files && input.files[0])
	{
		var reader = new FileReader();
		reader.onload = function (e)
		{
			$('#falseinput').attr('src', e.target.result);
			$('#preview-slip').attr('src', e.target.result);
			$('#base').val(e.target.result);
			$('#slipimg').val(e.target.result);
		};
		reader.readAsDataURL(input.files[0]);

	}
}

function redeemVoucherCode()
{
	run_waitMe($('.confirmation-wrapper'), 1, "win8_linear");
	voucher = $("#vouchercode").val();

	$.ajax(
	{
		type : "POST",
		url : "course/action/redeem-voucher",
		data : {'voucher':voucher},
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.confirmation-wrapper').waitMe('hide');

			status 	= response.status
			msg 		= response.return

			if(status=="true")
			{

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
	$('#editprofile').toggle('slow');
}

function checkVoucherCode()
{
	run_waitMe($('.confirmation-wrapper'), 1, "win8_linear");
	voucher = $("#voucher").val();

	$.ajax(
	{
		type : "POST",
		url : "course/action/check-voucher",
		data : {'voucher':voucher},
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.confirmation-wrapper').waitMe('hide');

			status 	= response.status
			msg 		= response.return

			if(status=="true")
			{
				name	= response.name
				code 	= response.code
				price 	= response.price
				type 		= response.type

				addToCart_voucher(voucher, "1", type);
				$('.voucher-return').inlineReturn("slow","<strong>แจ้งเตือน </strong> " +  msg + ".");

				$('.order-item').AddAndFadeIn(
				"<figure class='order-item-" + code + "'>"
					+"<span><strong>" + name + "</strong> (" + code + ")</span>"
					+"<span>1</span>"
					+"<span>" + price + " <a href='#0' class='delete-item'><i class='fa fa-trash'></i></a></span>"
				+"</figure>",".order-item-order-item-" + code ,"slow");
				//
				$(".usage-voucher-btn").attr("disabled", true);
				$('#voucher').prop('readonly', true);

				currentPrice 	=	$('.checkout-total').text();
				clearPrice 		=	currentPrice.replace(",", "")
				newPrice 		=	(Number(clearPrice) - Number(price))

				thaibath = ArabicNumberToText(newPrice);

				$('.checkout-total').text(bath(newPrice));
				$('.checkout-totaltext').text(thaibath);

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




function show_demo_topic(item)
{
	console.log(item);
}

function genetareCert(token)
{
  run_waitMe($('body'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "course/action/generate-certification",
		data : {'token':token},
		dataType : "json",
		success : function(response)
		{
      $('body').waitMe('hide');
			console.log(response)

			status 	 = response.status
		  cert     = response.return

			if(status=="true")
			{
				name	= response.name
        $.prompt("ใบรับรองของคุณได้รับการตรวจสอบและอนุมัติแล้ว",
				{
					title		: "สร้างใบรับรอง",
					buttons	: {"ตกลง":true},
					submit	: function(e,v,m,f)
					{
						page("certification/show/" + cert,"new");
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


if ($('#timer-count').length > 0)
{
	var sec = 0;
     function pad ( val ) { return val > 9 ? val : "0" + val; }
     setInterval( function()
		 {
         $("#seconds").html(pad(++sec%60));
         $("#minutes").html(pad(parseInt(sec/60,10)));
     }, 1000);
}

function sendAnswer(cid,qid,next,lid)
{
	run_waitMe($('body'), 1, "win8_linear");
	var aid = $("input[name=answer]:checked").val();

	console.log(aid);

	if (typeof aid === 'undefined')
	{
		$.prompt("ต้องเลือกคำตอบของคำถามนี้ก่อน ทำข้อถัดไป",
		{
			title		: "เกิดข้อผิดพลาด",
			buttons	: {"ตกลง":true},
			submit	: function(e,v,m,f)
			{
				$('body').waitMe('hide');
			}
		});
	}
	else
	{
		console.log(sec)

		$.ajax(
		{
			type : "POST",
			url : "student/action/save-answer",
			data : {'cid':cid,'qid':qid,'aid':aid,'next':next,'timer':sec},
			dataType : "json",
			success : function(response)
			{
				status 	= response.status
				msg 		= response.return

				if(status === "true")
				{
					if(next!="submit")
					{
						page("course/quiz/" + lid + "/" + cid + "/" + next);
					}
					else
					{
						$.ajax(
						{
							type : "POST",
							url : "student/action/submit-answer",
							data : {'cid':cid},
							dataType : "json",
							success : function(response)
							{
								$('body').waitMe('hide');

								status 	= response.status
								msg 		= response.return

								if(status === "true")
								{
									page("course/result/" + cid);
								}
							}
						});
					}
				}
			}
		});
	}
}


function addMessage()
{
  run_waitMe($('.lecture-video-detail-body'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "course/action/add-message",
		data : $("#frm-add-message").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.lecture-video-detail-body').waitMe('hide');

			status 	= response.status
			title   = response.title
			msg 		= response.return

      if(status=="true")
			{
				name	= response.name
        $.prompt("บันทึกคำถามของคุณแล้ว",
				{
					title		: "ถามคำถาม",
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

function addReply(ids)
{
  run_waitMe($('.replay-question-body'), 1, "win8_linear");
  console.log($("#reply_message_id").val());
	$.ajax(
	{
		type : "POST",
		url : "course/action/add-reply",
		data : $("#frm-add-reply-" + ids).serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.replay-question-body').waitMe('hide');

			status 	= response.status
			title   = response.title
			msg 		= response.return

      if(status=="true")
			{
				name	= response.name
        $.prompt("บันทึกข้อความของคุณแล้ว",
				{
					title		: "ตอบคำถาม",
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

function showReply(message)
{
  $(".replay-question-" + message).addClass("active");
  $('.question-overview-result-wrap').addClass('active');
}

function closeReply(message)
{
  $(".replay-question-wrap").removeClass("active");
  $('.question-overview-result-wrap').removeClass('active');
}

function showMessage(message)
{
  $('.new-question-wrap, .question-overview-result-wrap').addClass('active');
}

function closeMessage(message)
{
  $('.new-question-wrap, .question-overview-result-wrap').removeClass("active");
}

</script>
