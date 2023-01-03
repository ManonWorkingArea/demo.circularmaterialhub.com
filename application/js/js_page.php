<link rel="stylesheet" href="theme/demo/assets/core/plugin/pagination/simplePagination.css" />
<script src="theme/demo/assets/core/plugin/pagination/jquery.simplePagination.js"></script>
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>

<script>

<?php if($GLOBALS["pagination"]['record']!="" || $GLOBALS["pagination"]['record'] !=NULL) { ?>

$(document).ready(function()
{
	$('.pagination').pagination(
	{
		items: <?php echo $GLOBALS["pagination"]['record'];?>,
		itemsOnPage: <?php echo $GLOBALS["pagination"]['limit'];?>,
		cssStyle: 'light-theme',
		currentPage : <?php echo $GLOBALS["pagination"]['current'];?>,
		hrefTextPrefix : 'page/v/<?php echo $GLOBALS["pagination"]['main'];?>?page=',
		prevText: 'ก่อนหน้า',
		nextText: 'ถัดไป',
	});
});

<?php } else { ?>

<?php } ?>

function postComment()
{
	run_waitMe($('.post-comment'), 1, "win8_linear");

	$.ajax(
	{
		type : "POST",
		url : "page/action/send-comment",
		data : $("#frm-comment").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.post-comment').waitMe('hide');

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

$("#frm-search").on( "keypress", function(event)
{
	if (event.which == 13 && !event.shiftKey)
	{
	  event.preventDefault();
	  search();
	}
});

function search()
{
	run_waitMe($('.card-box-shared'), 1, "win8_linear");
	$("#result-table").html("");
	$.ajax(
	{
		type : "POST",
		url : "page/action/search",
		data : $("#frm-search").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			$('.card-box-shared').waitMe('hide');

			status 	= response.status
			title 		= response.title
			msg 		= response.return

			if(status=="true")
			{
				$(window).scrollTop($('#page-result-title').offset().top);
				$("#result-table").html(msg);
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

function exportExcel(table,filename)
{
	TableToExcel.convert(document.getElementById(table),
	{
		name: filename + ".xlsx",
		sheet:
		{
			name: "Sheet1"
		}
	});
}

function searchFactory()
{
	var reg_code_old 	= $("#factory_reg_code_old").val();
	var reg_code_new 	= $("#factory_reg_code_new").val();
	var reg_code_fti 	= $("#factory_reg_code_fti").val();
	var name 			= $("#factory_name").val();
	var province 		= $("#factory_province").val();
	var year 			= $("#factory_year").val();
	var type 			= $("#factory_type").val();
	var area 			= $("#factory_area").val();
	var estate 			= $("#factory_estate").val();

	var reg_code_old = (reg_code_old != '') ? '&reg_code_old=' + reg_code_old :'';
	var reg_code_new = (reg_code_new != '') ? '&reg_code_new=' + reg_code_new :'';
	var reg_code_fti = (reg_code_fti != '') ? '&reg_code_fti=' + reg_code_fti :'';
	var name = (name != '') ? '&name=' + name :'';
	var province = (province != '') ? '&province=' + province :'';
	var year = (year != '') ? '&year=' + year :'';
	var type = (type != '') ? '&type=' + type :'';
	var area = (area != '') ? '&area=' + area :'';
	var estate = (estate != '') ? '&estate=' + estate :'';

	console.log("reg_code_old",reg_code_old);
	console.log("reg_code_new",reg_code_new);
	console.log("reg_code_fti",reg_code_fti);
	console.log("name",name);
	console.log("province",province);
	console.log("year",year);
	console.log("type",type);
	console.log("area",area);
	console.log("estate",estate);

	page("page/view/certified_factory?search=true"+reg_code_old+reg_code_new+reg_code_fti+name+province+year+type+area+estate);
}


if ($("#frm-factory-search").length > 0)
{
	const urlParams 	= new URLSearchParams(window.location.search);
	const reg_code_old 	= urlParams.get('reg_code_old');
	const reg_code_new 	= urlParams.get('reg_code_new');
	const reg_code_fti 	= urlParams.get('reg_code_fti');
	const name 			= urlParams.get('name');
	const province 		= urlParams.get('province');
	const year 			= urlParams.get('year');
	const type 			= urlParams.get('type');
	const area 			= urlParams.get('area');
	const estate 		= urlParams.get('estate');

	console.log("Search Page :> ");
	console.log("reg_code_old",reg_code_old);
	console.log("reg_code_new",reg_code_new);
	console.log("reg_code_fti",reg_code_fti);
	console.log("name",name);
	console.log("province",province);
	console.log("year",year);
	console.log("type",type);
	console.log("area",area);
	console.log("estate",estate);

	(reg_code_old != null) ? $("#factory_reg_code_old").val(reg_code_old) : $("#factory_reg_code_old").val();
	(reg_code_new != null) ? $("#factory_reg_code_new").val(reg_code_new) : $("#factory_reg_code_new").val();
	(reg_code_fti != null) ? $("#factory_reg_code_fti").val(reg_code_fti) : $("#factory_reg_code_fti").val();
	(name != null) ? $("#factory_name").val(name) : $("#factory_name").val();
	(province != null) ? $("#factory_province").val(province) : $("#factory_province").val("all");
	(year != null) ? $("#factory_year").val(year) : $("#factory_year").val();
	(type != null) ? $("#factory_type").val(type) : $("#factory_type").val("all");
	(area != null) ? $("#factory_area").val(area) : $("#factory_area").val("all");
	(estate != null) ? $("#factory_estate").val(estate) : $("#factory_estate").val("all");
}

function searchAuditor()
{
	var name 			= $("#auditor_name").val();
	var company 		= $("#auditor_company").val();
	var specializes 	= $("#auditor_specializes").val();

	var specializes = new Array();
	$("input:checkbox[name=auditor_specializes]:checked").each(function() {
		specializes.push($(this).val());
  	});

	  specializes = specializes.toString()

	var name 			= (name != '') ? '&name=' + name :'';
	var company 		= (company != '') ? '&company=' + company :'';
	var specializes 	= (specializes != '') ? '&specializes=' + specializes :'';

	console.log("name",name);
	console.log("company",company);
	console.log("specializes",specializes);

	page("page/view/certified_auditor?search=true"+name+company+specializes);
}

if ($("#frm-auditor-search").length > 0)
{
	const urlParams 				= new URLSearchParams(window.location.search);
	const auditor_name 				= urlParams.get('name');
	const auditor_company 			= urlParams.get('company');
	const auditor_specializes 		= urlParams.get('specializes');

	if(auditor_specializes != null){
		var array = auditor_specializes.split(",");
		$.each(array,function(i){
			console.log(array[i]);
			$( "#specializes-" + array[i]).prop('checked', true);
		});
	}

	console.log("Search Page :> ");
	console.log("auditor_name",auditor_name);
	console.log("auditor_company",auditor_company);
	console.log("auditor_specializes",auditor_specializes);

	(auditor_name != null) ? $("#auditor_name").val(auditor_name) : $("#auditor_name").val("");
	(auditor_company != null) ? $("#auditor_company").val(auditor_company) : $("#auditor_company").val("");
}

function searchVerifier()
{
	var name 			= $("#verifier_name").val();
	var company 		= $("#verifier_company").val();
	var specializes 	= $("#verifier_specializes").val();

	var specializes = new Array();
	$("input:checkbox[nameverifier_specializes]:checked").each(function() {
		specializes.push($(this).val());
  	});

	  specializes = specializes.toString()

	var name 			= (name != '') ? '&name=' + name :'';
	var company 		= (company != '') ? '&company=' + company :'';
	var specializes 	= (specializes != '') ? '&specializes=' + specializes :'';

	console.log("name",name);
	console.log("company",company);
	console.log("specializes",specializes);

	page("page/view/certified_verifier?search=true"+name+company+specializes);
}

if ($("#frm-verifier-search").length > 0)
{
	const urlParams 				= new URLSearchParams(window.location.search);
	const verifier_name 			= urlParams.get('name');
	const verifier_company 			= urlParams.get('company');
	const verifier_specializes 		= urlParams.get('specializes');

	if(verifier_specializes != null){
		var array = verifier_specializes.split(",");
		$.each(array,function(i){
			console.log(array[i]);
			$( "#specializes-" + array[i]).prop('checked', true);
		});
	}

	console.log("Search Page :> ");
	console.log("verifier_name",verifier_name);
	console.log("verifier_company",verifier_company);
	console.log("verifier_specializes",verifier_specializes);

	(verifier_name != null) ? $("#verifier_name").val(verifier_name) : $("#verifier_name").val("");
	(verifier_company != null) ? $("#verifier_company").val(verifier_company) : $("#verifier_company").val("");
}

</script>
