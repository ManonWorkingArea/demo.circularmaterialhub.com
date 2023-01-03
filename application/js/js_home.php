<script>
	
$(document).ready(function() 
{
	var resultElement = $("#show-data");
	
	$.getJSON('home/action/get-lesson', function(data) 
	{
        $.each (data, function (bb) 
		{
			/*
			var course_item = '<div class="GridLex-col-3_mdd-4_sm-6_xs-6_xss-12">';
				course_item += '<div class="course-item">';
					course_item += '<a href="course/detail/' + data[bb].lesson_code + '">';
						course_item += '<div class="course-item-image">';
							course_item += '<img src="https://content.me-rean.com/img.php?file=' + data[bb].lesson_cover + '" alt="Image" class="img-responsive" />';
						course_item += '</div>';
						course_item += '<div class="course-item-top clearfix">';
							course_item += '<div class="course-item-instructor">';
								course_item += '<div class="image">';
									course_item += '<img src="https://content.me-rean.com/img.php?file=' + data[bb].school_logo + '" alt="Image" class="img-circle" />';
								course_item += '</div>';
								course_item += '<span>' + data[bb].school_name + '</span>';
							course_item += '</div>';
							course_item += '<div class="course-item-price bg-danger">$19.56</div>';
						course_item += '</div>';
						course_item += '<div class="course-item-content">';
							course_item += '<div class="rating-wrapper">';
								course_item += '<div class="rating-item">';
									course_item += '<input type="hidden" class="rating" data-filled="fa fa-star" data-empty="fa fa-star-o" data-fractions="2" data-readonly value="3.5"/>';
								course_item += '</div>';
								course_item += '<span> (7 review)</span>';
							course_item += '</div>';
							course_item += '<h3 class="text-primary">' + data[bb].lesson_name + '</h3>';
							course_item += '<p>' + data[bb].lesson_detail + '</p>';
						course_item += '</div>';
						course_item += '<div class="course-item-bottom clearfix">';
							course_item += '<div><i class="fa fa-folder-open-o"></i><span class="block"> Programming</span></div>';
							course_item += '<div><i class="fa fa-calendar"></i><span class="block"> ' + data[bb].lesson_days + ' วัน</span></div>';
							course_item += '<div><i class="fa fa-clock-o"></i><span class="block"> ' + data[bb].lesson_hour + ' ช.ม.</span></div>';
						course_item += '</div>';
					course_item += '</a>';
				course_item += '</div>';
			course_item += '</div>';
			
			
			resultElement.append(course_item);
			
			console.log (data[bb]);
			console.log (data[bb].lesson_name);*/
		});
    });

});

</script>