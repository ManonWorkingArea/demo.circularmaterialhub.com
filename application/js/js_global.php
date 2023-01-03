<script type="text/javascript">

	
	/*//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

	function assignCourse(token)
	{
		run_waitMe($('body'), 1, "win8_linear");
		voucher = $("#voucher").val();

		$.ajax(
		{
			type : "POST",
			url : "course/action/assign-lesson",
			data : {'token':token},
			dataType : "json",
			success : function(response)
			{
	      $('body').waitMe('hide');
				console.log(response)

				status 	 = response.status
				msg 		 = response.return
	      mode 		 = response.mode
	      course   = response.course
	      callpage = response.callpage

				if(status=="true")
				{
					name	= response.name
	        $.prompt(msg,
					{
						title		: "ผลการลงทะเบียน",
						buttons	: {"ตกลง":true},
						submit	: function(e,v,m,f)
						{
							page("course/detail/" + course);
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
	            if(mode==="buy" || mode==="exists")
	            {
	              page(callpage);
	            }
	            else
	            {
	              page("auth/login");
	              //$('#login-menu')[0].click();
	            }
						}
					});
				}
			}
		});
	}

	var cartWrapper = $('.cd-cart-container');
	//product id - you don't need a counter in your real project but you can use your real product id
	var productId = 0;

	if( cartWrapper.length > 0 )
	{
		//store jQuery objects
		var cartBody = cartWrapper.find('.body')
		var cartList = cartBody.find('ul').eq(0);
		var cartTotal = cartWrapper.find('.checkout').find('span');
		var discountTotal = cartWrapper.find('.discounttotal').find('span');
		var cartTrigger = cartWrapper.children('.cd-cart-trigger');
		var cartCount = cartTrigger.children('.count')
		var addToCartBtn = $('.cd-add-to-cart');
		var undo = cartWrapper.find('.undo');
		var undoTimeoutId;
		var pathname = window.location.pathname; // Returns path only

		//add product to cart
		addToCartBtn.on('click', function(event)
		{
			event.preventDefault();
			addToCart($(this));
		});

		//open/close cart
		cartTrigger.on('click', function(event)
		{
			event.preventDefault();
			toggleCart();
		});

		//close cart when clicking on the .cd-cart-container::before (bg layer)
		cartWrapper.on('click', function(event)
		{
			if( $(event.target).is($(this)) ) toggleCart(true);
		});

		//delete an item from the cart
		cartList.on('click', '.delete-item', function(event)
		{
			event.preventDefault();
			removeProduct($(event.target).parents('.product'));
			console.log($(event.target).parents('.product'));
		});

		$('.order-item').on('click', '.delete-item', function(event)
		{
			event.preventDefault();
			removeProduct($(event.target).parents('.product'));
			console.log($(event.target).parents('.product'));
		});

		//update item quantity
		cartList.on('change', 'select', function(event)
		{
			quickUpdateCart();
		});

		//reinsert item deleted from the cart
		undo.on('click', 'a', function(event)
		{
			clearInterval(undoTimeoutId);
			event.preventDefault();
			cartList.find('.deleted').addClass('undo-deleted').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function()
			{
				$(this).off('webkitAnimationEnd oanimationend msAnimationEnd animationend').removeClass('deleted undo-deleted').removeAttr('style');
				quickUpdateCart();
			});
			undo.removeClass('visible');
		});
	}

	function toggleCart(bool)
	{
		console.log("toggleCart");

		var cartIsOpen = ( typeof bool === 'undefined' ) ? cartWrapper.hasClass('cart-open') : bool;

		if( cartIsOpen )
		{
			cartWrapper.removeClass('cart-open');
			//reset undo
			clearInterval(undoTimeoutId);
			undo.removeClass('visible');
			cartList.find('.deleted').remove();

			setTimeout(function()
			{
				cartBody.scrollTop(0);
				//check if cart empty to hide it
				if( Number(cartCount.find('li').eq(0).text()) == 0) cartWrapper.addClass('empty');
			}, 500);
		}
		else
		{
			cartWrapper.addClass('cart-open');
		}
	}

	function addToCart_option(trigger)
	{
		console.log("addToCart");
		var cartIsEmpty = cartWrapper.hasClass('empty');

		$.ajax(
		{
			type : "POST",
			url : "course/action/cart/add",
			data : {'item':trigger.data('code'),'quantity':'1','type':trigger.data('type')},
			dataType : "json",
			success : function(response)
			{
				console.log(response)
				code 	= response.code
				price 	= response.price
				cover 	= response.cover
				name 	= response.name
				status 	= response.status
				type 		= response.type
				msg 		= response.return

				if(status=="true")
				{
					//update cart product list
					addProduct(code,price,cover,name,type);
					//update number of items
					updateCartCount(cartIsEmpty);
					//update total price
					updateCartTotal(price, true, type);
					//show cart
					cartWrapper.removeClass('empty');
				}
				else
				{
				}
			}
		});

	}

	function addToCart_voucher(item,quantity,type)
	{
		console.log("addToCart");
		var cartIsEmpty = cartWrapper.hasClass('empty');

		$.ajax(
		{
			type : "POST",
			url : "course/action/cart/add",
			data : {'item':item, 'quantity':quantity, 'type':type},
			dataType : "json",
			success : function(response)
			{
				console.log(response)
				code 	= response.code
				price 	= response.price
				cover 	= response.cover
				name 	= response.name
				status 	= response.status
				type 		= response.type
				msg 		= response.return

				if(status=="true")
				{
					//update cart product list
					addProduct(code,price,cover,name,type);
					//update number of items
					updateCartCount(cartIsEmpty);
					//update total price
					updateCartTotal(price, true, type);
					//show cart
					cartWrapper.removeClass('empty');
				}
				else
				{
				}
			}
		});

	}

	function addToCart(trigger)
	{
		console.log("addToCart");
		var cartIsEmpty = cartWrapper.hasClass('empty');

		$.ajax(
		{
			type : "POST",
			url : "course/action/cart/add",
			data : {'item':trigger.data('code'),'quantity':'1','type':trigger.data('type')},
			dataType : "json",
			beforeSend: function()
			{
				$('.btn-cart').addClass('loader');
			},
			success : function(response)
			{
				console.log(response)
				code 	= response.code
				price 	= response.price
				cover 	= response.cover
				name 	= response.name
				status 	= response.status
				type 		= response.type
				msg 		= response.return

				if(status=="true")
				{
					//update cart product list
					addProduct(code,price,cover,name,type);
					//update number of items
					updateCartCount(cartIsEmpty);
					//update total price
					updateCartTotal(price, true, type);
					//show cart
					cartWrapper.removeClass('empty');

					$('.btn-cart').removeClass('loader');
					$('.btn-cart').parent().addClass('bought');
					$('.cart-output').html(msg);
				}
				else
				{
					$('.btn-cart').removeClass('loader');
					$('.btn-cart').parent().addClass('bought');
					$('.cart-output').html(msg);
				}
			}
		});

	}

	function clearCartBtn()
	{
		$('.btn_wrapper').removeClass('bought');
	}

	function addProduct(code,price,cover,name,type)
	{
		console.log("addProduct");
		//this is just a product placeholder
		//you should insert an item with the selected product info
		//replace productId, productName, price and url with your real product info
		productId = code;
		var productAdded = $('<li class="product product-' + code + '"><div class="product-image"><a href="#0"><img src="<?php echo $GLOBALS["School"]['cdn']?>img.php?file='+ cover +'" alt="placeholder"></a></div><div class="product-details"><h3><a href="#0"><span class="carttype">'+ type +'</span><span class="carttem">'+ code +'</span> '+ name +'</a></h3><span class="price">'+ price +'</span><div class="actions"><a href="#0" class="delete-item"><i class="fa fa-trash"></i> ลบ</a><div class="quantity"><label for="cd-product-'+ code +'">จำนวน</label><span class="select"><select id="cd-product-'+ code +'" name="quantity"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select></span></div></div></div></li>');
		cartList.prepend(productAdded);
	}

	function removeProduct(product)
	{
		console.log("removeProduct");
		console.log(product.find('.carttem').text());
		item = product.find('.carttem').text();

		$.ajax(
		{
			type : "POST",
			url : "course/action/cart/remove",
			data : {'item':item},
			dataType : "json",
			success : function(response)
			{
				console.log(response)
				var status 	= response.status

				if(status=="true")
				{

					if(pathname == "/course/checkout")
					{
						$('.order-item-' + item).fadeOutAndRemove("slow");
					}

					if($('.checkbox-' + item).is(':checked'))
					{
						$('.checkbox-' + item).attr('checked', false);
					}

					clearInterval(undoTimeoutId);
					cartList.find('.deleted').remove();

					var topPosition = product.offset().top - cartBody.children('ul').offset().top ,
						productQuantity	= Number(product.find('.quantity').find('select').val()),
						productTotPrice 	= Number(product.find('.price').text().replace('$', '')) * productQuantity;
						productType 		= product.find('.carttype').text()

						console.log(productType);

					product.css('top', topPosition+'px').addClass('deleted');

					//update items count + total price
					updateCartTotal(productTotPrice, false, productType);
					updateCartCount(true, -productQuantity);
					undo.addClass('visible');

					//wait 8sec before completely remove the item
					undoTimeoutId = setTimeout(function()
					{
						undo.removeClass('visible');
						cartList.find('.deleted').remove();
					}, 8000);
				}
				else
				{
				}
			}
		});

	}

	function quickUpdateCart()
	{
		console.log("quickUpdateCart");
		var quantity = 0;
		var price = 0;

		cartList.children('li:not(.deleted)').each(function()
		{
			var singleQuantity = Number($(this).find('select').val());
			quantity = quantity + singleQuantity;
			price = price + singleQuantity*Number($(this).find('.price').text().replace('$', ''));
		});

		cartTotal.text(price.toFixed(2));
		cartCount.find('li').eq(0).text(quantity);
		cartCount.find('li').eq(1).text(quantity+1);
	}

	function updateCartCount(emptyCart, quantity)
	{
		console.log("updateCartCount");

		if( typeof quantity === 'undefined' )
		{
			var actual = Number(cartCount.find('li').eq(0).text()) + 1;
			var next = actual + 1;

			if( emptyCart )
			{
				cartCount.find('li').eq(0).text(actual);
				cartCount.find('li').eq(1).text(next);

				updateBadge(actual);
			}
			else
			{
				cartCount.addClass('update-count');

				setTimeout(function()
				{
					cartCount.find('li').eq(0).text(actual);
				}, 150);

				setTimeout(function()
				{
					cartCount.removeClass('update-count');
				}, 200);

				setTimeout(function()
				{
					cartCount.find('li').eq(1).text(next);
				}, 230);

				updateBadge(actual);
			}
		}
		else
		{
			var actual = Number(cartCount.find('li').eq(0).text()) + quantity;
			var next = actual + 1;

			cartCount.find('li').eq(0).text(actual);
			cartCount.find('li').eq(1).text(next);

			updateBadge(actual);
		}
	}

	function updateCartTotal(price, bool, type)
	{
		console.log("updateCartTotal");

		if(bool)
		{
			if(type=="code-fix")
			{
				newprice = (Number(cartTotal.text()) - Number(price));
				cartTotal.text(newprice);
				discountTotal.text(price);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
			else if(type=="code-cal")
			{
				discount = (Number(cartTotal.text())/100)*Number(price);
				newprice = (Number(cartTotal.text()) - Number(discount));
				cartTotal.text(newprice);
				discountTotal.text(discount);

				console.log(discount);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
			else
			{
				newprice = (Number(cartTotal.text()) + Number(price));
				cartTotal.text(newprice);
				discountTotal.text(price);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
		}
		else
		{
			if(type=="code-fix")
			{
				newprice = (Number(cartTotal.text()) + Number(price));
				cartTotal.text(newprice);
				discountTotal.text(price);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
			else if(type=="code-cal")
			{
				newprice = Number(cartTotal.text()) + Number(discountTotal.text());
				cartTotal.text(newprice);

				discountTotal.text("0");

				console.log(discount);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
			else
			{
				newprice 	= (Number(cartTotal.text()) - Number(price));
				cartTotal.text(newprice);
				discountTotal.text(price);

				discountPrice.text(price);

				if(pathname == "/course/checkout")
				{
					$('.checkout-total').text(newprice);
				}
			}
		}
	}

	/*//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////*/

	function updateBadge(actual)
	{
		el = $('.cartcount');
        el.addClass('bounce');
        el.one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
        function (e)
		{
			$(".cartcount").html(actual);
            el.removeClass('bounce');
        });
  }


function reload()
{
	window.location.reload();
}

function back()
{
	history.back();
}

function close()
{
	window.close();
}

function page(location,page)
{
	if(location!="none")
	{
		var baseURL = '<?php echo $_SESSION["School"]['website'];?>';
		var ms_ie = false;
		var ua = window.navigator.userAgent;
		var old_ie = ua.indexOf('MSIE ');
		var new_ie = ua.indexOf('Trident/');
	    if ((old_ie > -1) || (new_ie > -1))
		{
	        ms_ie = true;
	    }
	    if (ms_ie)
		{
			if(page!="new" || page=="")
			{
				window.location.href = baseURL + location;
			}
			else
			{
				window.open(baseURL + location , '_blank');
			}
	    }
		else
		{
			if(page!="new" || page=="")
			{
				window.location.href = baseURL + location;
			}
			else
			{
				window.open(location , '_blank');
			}
		}
	}
}

function signout()
{
	$.prompt("คุณต้องการออกจากระบบ",
	{
		title: "แจ้งเตือนจากระบบ",
		buttons: { "ออกจากระบบ": true, "ยกเลิก": false },
		submit: function(e,v,m,f)
		{
			if(v)
			{
				$.ajax(
				{
					type: "POST",
					url: "student/action/signout",
					dataType : "json",
					success: function(response)
					{
						status = response.status
						msg = response.return

						if(status=="true")
						{
							$.prompt(msg,
							{
								title		: "การแจ้งเตือน",
								buttons	: {"ย้อนกลับ":true},
								submit	: function(e,v,m,f)
								{
									page("home");
								}
							});
						}
					}
				});
			}
		}
	});

	/*
	swal(
	{
		title: "ออกจากระบบ ?",
		text: "คุณต้องการออกจากระบบ",
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	},
	function()
	{
		$.ajax(
		{
			type: "POST",
			url: "student/action/signout",
			dataType : "json",
			success: function(response)
			{
				status = response.status
				msg = response.return

				if(status=="true")
				{
					$.prompt(msg,
					{
						title		: "การแจ้งเตือน",
						buttons	: {"ตกลง":true},
						submit	: function(e,v,m,f)
						{
							// e.preventDefault();
							page("home");
						}
					});

					swal(
					{
						title: "แจ้งเตือนจากระบบ",
						text: msg,
					},
					function()
					{
						page("home");
					});

				}
			}
		});
	});
	*/
}

function signup()
{
	run_waitMe($('#ajaxRegisterModal'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/signup",
		data : $("#frm-signup").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('#ajaxRegisterModal').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				$('#ajaxRegisterModal').modal('hide');
				$('#ajaxRegisterModal').on('hidden.bs.modal', function ()
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

function signinSplash()
{
	run_waitMe($('.splash'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "student/action/signin",
		data : $("#frm-signin-splash").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.splash').waitMe('hide');

			status = response.status
			msg = response.return

			if(status=="true")
			{
				swal(
				{
					title: "แจ้งเตือนจากระบบ",
					text: "เข้าสู่ระบบเรียบร้อย",
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

$('#frm-signin-splash').keypress(function (e)
{
	var key = e.which;
	if(key == 13)
	{
		signinSplash();
		return false;
	}
});

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

function run_waitMe(el, num, effect)
{
	text = 'กรุณารอสักครู่...';
	fontSize = '';
	switch (num)
	{
		case 1:
		maxSize = '';
		textPos = 'vertical';
		break;
		case 2:
		text = '';
		maxSize = 30;
		textPos = 'vertical';
		break;
		case 3:
		maxSize = 30;
		textPos = 'horizontal';
		fontSize = '18px';
		break;
	}
	console.log(effect)
	el.waitMe(
	{
		effect: effect,
		text: text,
		bg: 'rgba(255,255,255,0.7)',
		color: '#000',
		maxSize: maxSize,
		source: 'img.svg',
		textPos: textPos,
		fontSize: fontSize,
		onClose: function() {}
	});
}

function close_waitMe(el)
{
	el.waitMe("hide");
}

function Share(url)
{
		var width = 530;
		var height = 350;
		var toppx = ($(window).height() / 2) - (height / 2);
		var leftpx = ($(window).width() / 2) - (width / 2);

		window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, "Fb Share", "width=" + width + ",height=" + height + ",scrollbars=no,left=" + leftpx + "top="+toppx);
}

jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};

function bath(str)
{
    var parts = (str + "").split("."),
        main = parts[0],
        len = main.length,
        output = "",
        i = len - 1;

    while(i >= 0) {
        output = main.charAt(i) + output;
        if ((len - i) % 3 === 0 && i > 0) {
            output = "," + output;
        }
        --i;
    }
    // put decimal part back
    if (parts.length > 1) {
        output += "." + parts[1];
    }
    return output;
}


jQuery.fn.thaiBaht = function(Number)
{

}

// "use strict";

function ThaiNumberToText(Number)
{
	Number = Number.replace (/๐/gi,'0');
	Number = Number.replace (/๑/gi,'1');
	Number = Number.replace (/๒/gi,'2');
	Number = Number.replace (/๓/gi,'3');
	Number = Number.replace (/๔/gi,'4');
	Number = Number.replace (/๕/gi,'5');
	Number = Number.replace (/๖/gi,'6');
	Number = Number.replace (/๗/gi,'7');
	Number = Number.replace (/๘/gi,'8');
	Number = Number.replace (/๙/gi,'9');
	return 	ArabicNumberToText(Number);
}

function ArabicNumberToText(Number)
{
	var Number = CheckNumber(Number);
	var NumberArray = new Array ("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า", "สิบ");
	var DigitArray = new Array ("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
	var BahtText = "";
	if (isNaN(Number))
	{
		return "ข้อมูลนำเข้าไม่ถูกต้อง";
	} else
	{
		if ((Number - 0) > 9999999.9999)
		{
			return "ข้อมูลนำเข้าเกินขอบเขตที่ตั้งไว้";
		} else
		{
			Number = Number.split (".");
			if (Number[1].length > 0)
			{
				Number[1] = Number[1].substring(0, 2);
			}
			var NumberLen = Number[0].length - 0;
			for(var i = 0; i < NumberLen; i++)
			{
				var tmp = Number[0].substring(i, i + 1) - 0;
				if (tmp != 0)
				{
					if ((i == (NumberLen - 1)) && (tmp == 1))
					{
						BahtText += "เอ็ด";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 2))
					{
						BahtText += "ยี่";
					} else
					if ((i == (NumberLen - 2)) && (tmp == 1))
					{
						BahtText += "";
					} else
					{
						BahtText += NumberArray[tmp];
					}
					BahtText += DigitArray[NumberLen - i - 1];
				}
			}
			BahtText += "บาท";
			if ((Number[1] == "0") || (Number[1] == "00"))
			{
				BahtText += "ถ้วน";
			} else
			{
				DecimalLen = Number[1].length - 0;
				for (var i = 0; i < DecimalLen; i++)
				{
					var tmp = Number[1].substring(i, i + 1) - 0;
					if (tmp != 0)
					{
						if ((i == (DecimalLen - 1)) && (tmp == 1))
						{
							BahtText += "เอ็ด";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 2))
						{
							BahtText += "ยี่";
						} else
						if ((i == (DecimalLen - 2)) && (tmp == 1))
						{
							BahtText += "";
						} else
						{
							BahtText += NumberArray[tmp];
						}
						BahtText += DigitArray[DecimalLen - i - 1];
					}
				}
				BahtText += "สตางค์";
			}
			return BahtText;
		}
	}
}

function CheckNumber(Number)
{
	var decimal = false;
	Number = Number.toString();
	Number = Number.replace (/ |,|บาท|฿/gi,'');
	for (var i = 0; i < Number.length; i++)
	{
		if(Number[i] =='.'){
			decimal = true;
		}
	}
	if(decimal == false){
		Number = Number+'.00';
	}
	return Number
}

/*

function login()
{
	run_waitMe($('.page-content'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/login",
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
				page("student");
			}
			else
			{
				close_waitMe($('.page-content'));
				$('#login-tab')[0].click();
				$(".error-state").show()
				$(".error-state .title").text("ไม่สามารถเข้าสู่ระบบได้");
				$(".error-state .body").text(msg)
			}
		}

	});
}



function register()
{
	run_waitMe($('.page-content'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "auth/action/signup",
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
				$('#loginModal').modal('toggle');
				$('#loginModal').on('hidden.bs.modal', function ()
				{
					page("home");
				});
			}
			else
			{
				close_waitMe($('.page-content'));
				$(".error-state").show()
				$(".error-state .title").text("เกิดข้อผิดพลาด");
				$(".error-state .body").text(msg)
			}
		}
	});
}

*/






$.fn.digits = function()
{
	return this.each(function()
	{
		$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
	})
}

var ArrayInstanceExtensions =
{
    pick_and_remove: function(index){
        var picked_element = this[index];
        this.splice(index,1);
        return picked_element;
    }
};
$.extend(Array.prototype, ArrayInstanceExtensions);

Array.prototype.myCheck = function()
{
  var arr = this,
    i, max_i, myType;
  for (i = 0, max_i = arguments.length; i < max_i; i++) {
    arr = arr[arguments[i]];
    myType = typeof(arr);
    if (arr === undefined) {
      return false;
    }
  }
  return true;
};

String.prototype.toNum = function()
{
    return parseInt(this, 10);
}

jQuery.fn.inlineReturn = function(speed, msg)
{
	$(this).html('');
    $(this).fadeIn(speed,function()
	{
        $(this).html(msg).delay(1000).fadeOut(speed);
    })
}

jQuery.fn.fadeOutAndRemove = function(speed)
{
    $(this).fadeOut(speed,function()
	{
        $(this).remove();
    })
}

jQuery.fn.AddAndFadeIn = function(html,target,speed)
{
	$(this).append(html).ready(function ()
	{
		$(target).fadeIn(speed,function(){})
	});
}

</script>
