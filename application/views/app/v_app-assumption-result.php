<?php

$access = "user";
//$access = "audit";

?>

<?php


// FORM CONFIG ---------------------------------------
$member_id       = $data["Application"]['member_id'];
$form_id         = $data["Application"]['ap_form'];
$app_id          = $data["Application"]['app_id'];
$ap_id           = $data["Application"]['ap_id'];
$ap_token        = $data["Application"]['ap_token'];
$set_id          = $data["FormSetRow"]['set_id'];
$first           = $data["FormSetRow"]['first'];

/*

$formCreate      = tracking::form('generate', $form_id, $app_id);
$formResult      = tracking::form('result', $form_id, $app_id, $member_id);

// FORM CONFIG ---------------------------------------
$form_token      = $formCreate['form']['form_token'];
$form_action     = $formCreate['form']['form_action'];
$form_function   = $formCreate['form']['form_function'];
$form_reference  = "LINEID";

*/

?>

<section class="breadcrumb-area my-courses-bread application-form">

    <div class="topbar-control">
      <div class="container">
        <div class="col-md-12">
          <div class="topbar-nav">
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current"><?php echo $data["FormSetRow"]['set_name']?></span>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title"><i class="fa fa-edit"></i> <?php echo $data["Detail"]['app_name']?></h2>
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2">

                      <div class="row custom-row">

                        <div class="col-md-12">
                          <div class="form-title">แบบฟอร์มใบสมัครทั้งหมด</div>
                        </div>

                        <?php
                        /*
                        echo "<pre>";
                        print_r($data["Output"]);
                        echo "</pre>";
                        */

                        foreach ($data["FormSet"] as $FormSet)
                        {
                          if($data["FormSetRow"]['code'] == $FormSet['set_code'])
                          {
                            $active       = "<span class='active-icon'><i class='fa fa-check-circle'></i></span>";
                            $active_class = "form-active";
                            $active_icon  = "fas fa-folder-open";
                          }
                          else
                          {
                            $active       = "";
                            $active_class = "";
                            $active_icon  = "fas fa-folder";
                          }

                          echo
                          "<div class='col-md-3' onclick='page(\"app/fill/{$ap_token}/{$FormSet['set_code']}\");'>
                            <div class='form-card app-file-list {$active_class}'>
                            {$active}
                            <div class='app-file-icon'>
                              <i class='{$active_icon}'></i>
                            </div>
                            <div class='form-order'>
                              {$FormSet['set_order']}
                            </div>
                            <div class='description'>
                              <div>
                                <div class='form-name'>{$FormSet['set_name']}</div>
                                <div class='form-status'>กรอกข้อมูลแล้ว</div>
                              </div>
                            </div>
                            </div>
                          </div>
                          ";
                        }
                        ?>
                      </div>

                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->

</section>

<section class="course-area padding-top-20px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container text-center">

            <div class="row">

              <div class="col-md-12">
                <div class="top-head">
                  <div class="text">กราฟสรุปคะแนนการประเมินตาม ข้อกำหนดเฉพาะของมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ</div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="container-fluid">
                  <ul class="list-unstyled multi-steps">
                    <li onclick="page('app/assumption/specific/1');">แบบประเมิน</li>
                    <li onclick="page('app/assumption/result');" class="is-active">ผลลัพธ์</li>
                  </ul>
                </div>
              </div>

              <div class="col-md-12">

                <div class="skillsPieChart" data-width="1024" data-height="1024" data-red="0" data-green="128" data-blue="255">

                    <div style="text-align: center;">
                      <div class="chartCanvasWrap"></div>
                    </div>

                </div>
              </div>

              <div class="col-md-12">

                <table class="table text-left">
                  <thead>
                    <tr>
                      <th>หัวข้อ</th>
                      <th>ผลการประเมิน</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.ข้อกำหนดทั่วไป (General requirements)</td>
                      <td>ผ่าน/ไม่ผ่าน</td>
                    </tr>
                    <tr>
                      <td>2.ข้อกำหนดเฉพาะของมาตรฐานโรงงานอุตสาหกรรมเชิงนิเวศ</td>
                      <td><span class="step-total-score"> </span> คะแนน (<span class="step-percent-score"></span>%)</td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/1');">
                      <td>1 การจัดการวัตถุดิบ</td>
                      <td><span class="step-1-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/2');">
                      <td>2 การจัดการพลังงาน</td>
                      <td><span class="step-2-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/3');">
                      <td>3 การจัดการน้ำและน้ำเสีย</td>
                      <td><span class="step-3-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/4');">
                      <td>4 การจัดการมลภาวะทางอากาศ</td>
                      <td><span class="step-4-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/5');">
                      <td>5 การจัดการก๊าซเรือนกระจก</td>
                      <td><span class="step-5-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/6');">
                      <td>6 การจัดการของเสีย</td>
                      <td><span class="step-6-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/7');">
                      <td>7 การจัดการสารเคมีและวัตถุอันตราย</td>
                      <td><span class="step-7-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/8');">
                      <td>8 การจัดการสุขภาพและความปลอดภัยในการทำงาน</td>
                      <td><span class="step-8-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/9');">
                      <td>9 การจัดการระบบขนส่งและโลจิสติกส์</td>
                      <td><span class="step-9-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/10');">
                      <td>10 การจัดการโซ่อุปทานสีเขียว</td>
                      <td><span class="step-10-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/11');">
                      <td>11 การจัดการภูมิทัศน์สีเขียว</td>
                      <td><span class="step-11-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/12');">
                      <td>12 การจัดการความหลากหลายทางชีวภาพ</td>
                      <td><span class="step-12-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/13');">
                      <td>13 การกระจายรายได้ให้กับชุมชน</td>
                      <td><span class="step-13-score"></span></td>
                    </tr>
                    <tr onclick="page('app/assumption/specific/14');">
                      <td>14 การอยู่ร่วมกับชุมชนโดยรอบ</td>
                      <td><span class="step-14-score"></span></td>
                    </tr>

                  </tbody>
                  </table>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12"><div class="footer-topic"><div class="text bg1" onclick="page('app/assumption/general');">อุตสาหกรรมสีเขียวระดับ 3 หรือ ISO 14001 และไม่มีข้อร้องเรียน 1 ปี (โรงงานขนาดใหญ่)</div></div></div>
              <div class="col-md-12"><div class="footer-topic"><div class="text bg2" onclick="page('app/assumption/general');">อุตสาหกรรมสีเขียวระดับ 2 หรือ ธงขาวดาวเขียว และไม่มีข้อร้องเรียน 1 ปี (โรงงานขนาดกลางและขนาดย่อม)</div></div></div>
            </div>
        </div>
    </div>
</section>

<script>

$(function() {
	//OnLoad
	$(document).ready(function()
  {
		$('.skillsPieChart').radarChart({
		size: [1000, 900],
		step: 1,
		fixedMaxValue:5,
    values: {
      "1.การจัดการวัตถุดิบ": Cookies.get('step1'),
      "2.การจัดการพลังงาน": Cookies.get('step2'),
      "3.การจัดการน้ำและน้ำเสีย": Cookies.get('step3'),
      "4.การจัดการมลภาวะทางอากาศ": Cookies.get('step4'),
      "5.การจัดการก๊าซเรือนกระจก": Cookies.get('step5'),
      "6.การจัดการของเสีย": Cookies.get('step6'),
      "7.การจัดการสารเคมีและวัตถุอันตราย": Cookies.get('step7'),
      "8.การจัดการสุขภาพและความปลอดภัยในการทำงาน": Cookies.get('step8'),
      "9.การจัดการระบบขนส่งและโลจิสติกส์": Cookies.get('step9'),
      "10.การจัดการโซ่อุปทานสีเขียว": Cookies.get('step10'),
      "11.การจัดการภูมิทัศน์สีเขียว": Cookies.get('step11'),
      "12.การจัดการความหลากหลายทางชีวภาพ": Cookies.get('step12'),
      "13.การกระจายรายได้ให้กับชุมชน": Cookies.get('step13'),
      "14.การอยู่ร่วมกับชุมชนโดยรอบ": Cookies.get('step14'),
    },
		showAxisLabels: true
		});
  });

  $('.step-1-score').html(Cookies.get("step1"));
  $('.step-2-score').html(Cookies.get("step2"));
  $('.step-3-score').html(Cookies.get("step3"));
  $('.step-4-score').html(Cookies.get("step4"));
  $('.step-5-score').html(Cookies.get("step5"));
  $('.step-6-score').html(Cookies.get("step6"));
  $('.step-7-score').html(Cookies.get("step7"));
  $('.step-8-score').html(Cookies.get("step8"));
  $('.step-9-score').html(Cookies.get("step9"));
  $('.step-10-score').html(Cookies.get("step10"));
  $('.step-11-score').html(Cookies.get("step11"));
  $('.step-12-score').html(Cookies.get("step12"));
  $('.step-13-score').html(Cookies.get("step13"));
  $('.step-14-score').html(Cookies.get("step14"));
  real_score = 70
  total_score = parseInt(Cookies.get("step1"))+parseInt(Cookies.get("step2"))+parseInt(Cookies.get("step3"))+parseInt(Cookies.get("step4"))+parseInt(Cookies.get("step5"))+parseInt(Cookies.get("step6"))+parseInt(Cookies.get("step7"))+parseInt(Cookies.get("step8"))+parseInt(Cookies.get("step9"))+parseInt(Cookies.get("step10"))+parseInt(Cookies.get("step11"))+parseInt(Cookies.get("step12"))+parseInt(Cookies.get("step13"))+parseInt(Cookies.get("step14"))
  total_percent = (total_score*100)/real_score
  $('.step-total-score').html(total_score);
  $('.step-percent-score').html(Math.round(total_percent));

});

$(function(){
  $('#chart').radarChart({
    size: [1200, 1024],
    step: 1,
    title: "My Skills",
    values: {
      "1.การจัดการวัตถุดิบ": Cookies.get('step1'),
      "2.การจัดการพลังงาน": Cookies.get('step2'),
      "3.การจัดการน้ำและน้ำเสีย": Cookies.get('step3'),
      "4.การจัดการมลภาวะทางอากาศ": Cookies.get('step4'),
      "5.การจัดการก๊าซเรือนกระจก": Cookies.get('step5'),
      "6.การจัดการของเสีย": Cookies.get('step6'),
      "7.การจัดการสารเคมีและวัตถุอันตราย": Cookies.get('step7'),
      "8.การจัดการสุขภาพและความปลอดภัยในการทำงาน": Cookies.get('step8'),
      "9.การจัดการระบบขนส่งและโลจิสติกส์": Cookies.get('step9'),
      "10.การจัดการโซ่อุปทานสีเขียว": Cookies.get('step10'),
      "11.การจัดการภูมิทัศน์สีเขียว": Cookies.get('step11'),
      "12.การจัดการความหลากหลายทางชีวภาพ": Cookies.get('step12'),
      "13.การกระจายรายได้ให้กับชุมชน": Cookies.get('step13'),
      "14.การอยู่ร่วมกับชุมชนโดยรอบ": Cookies.get('step14'),
    },
    showAxisLabels: true
  });
});

/*
 * 	JQuery Radar Plus By Mehdi TAZI(http://www.tazimehdi.com)
 *  is an improved version of JQueryRadarChart created by Ryan ALLRED

Additional Features:
	fixed-max-value 		: 	Charts can take a fixed max value otherwise it will take the max value of chart.
	chartCanvasWrap 		: 	ChartCanvasWrap class allow us to define the order of insertion whittin a div.
	color 					:	Define a specific gradian color for the chart
	additionalLineDistance	:	allow the programmer to choose an additional distance for the labels from the center.
	add annimation delay	:	define the annimation fadding delay.otherwise 1s is the default value

Change:
	Canvas now reside inside a Div
	Chart configuration  can now be define using the metadata attributs(data-[attr]) or using the javascript constructor.
	Chart Title is no more required : if not fill nothing will appear.(allow us to use title using html direcly)
	Size are now dynamic according to div.
	Reponsive chart : the chart can now go throught a div and be responsive.( tested using bootsrap...)
	The lines and labels position are based on max value and on a defined fixed distance(if exist)
	Large labels text are now visible(whittin the chart,if not use additionalLineDistance).
	All the Drawing are now into just 1 canvas , this option allow us to :
		+Download the canvas png
		+Easy to manage nodes and the dom.
		+Less objects into the dom
		+Canvases annimation fadding are now based only on 1 and not many. if more effect needed use specific framework.

HOW TO :
	1-create a div with a class name "skillsPieChart".
	2-put inside a div with a class name "chartCanvasWrap" according to the desired position where to show the chart.
	3-Define data for skillsPieChart : either using the metadata attributs ( data-color , data-......) or using JavaScript.

	Simple Example :  See index.html
	<div class="skillsPieChart" data-values='{"JAVA": 4.5,"C#": 3.0,"PHP":3.0,"HTML5":4.0,"CSS3":4.0}'
		data-width="200" data-height="200" data-red="0" data-green="128" data-blue="255">
			<h2>MyChart</h2>
			<div class="chartCanvasWrap row"></div>
			<h5>some details .....</h5>
	</div>

*/
(function($) {

  var Radar = (function() {

    function Radar(ele, settings) {
      this.ele = ele;
      this.settings = $.extend({
        showAxisLabels: $(ele).data("showAxisLabels"),
        title: $(ele).data("text"),
        step: $(ele).data("step"),
        values: $(ele).data("values"),
        color: [$(ele).data("red"),$(ele).data("green"),$(ele).data("blue")],
		insertFirst : $(ele).data("insert-first"),
		fixedMaxValue:$(ele).data("fixed-max-value"),
		size : [$(ele).data("width"),$(ele).data("height")],
		additionalLineDistance: $(ele).data("additional-line-distance"),
		annimationDelay: $(ele).data("annimation-delay")
      },settings);
      this.width = this.settings.size[0];
      this.height = this.settings.size[1];
      $(ele).css({
        'position': 'relative',
      });
      this.canvas = {};
      this.draw();
    }

    Radar.prototype.newCanvas = function() {

	var div = $(this.ele).find(".chartCanvasWrap").first();

	$(div).css({
		'position': 'relative'//'margin-top': "0 px" //this.height * 0.20333 +
	});

      var canvas = document.createElement('canvas');
      canvas.width = this.width;
      canvas.height = this.height;
      canvas.style.position = "relative";

	  $(div).append(canvas);

      this.canvas = canvas;

	  /*if(this.settings.insertFirst){
		if(this.ele.firstChild){
		//	this.ele.insertBefore(canvas,this.ele.firstChild);
		}
	  }else{
		//this.ele.appendChild(canvas);
	  }*/

		var annimationDelay = 1000;
		if(this.settings.annimationDelay){
			annimationDelay=this.settings.annimationDelay;
		}
	  this.cxt = canvas.getContext('2d');

        $(canvas).css('opacity',0).delay(annimationDelay).animate({opacity: 1}, annimationDelay);

    }

    Radar.prototype.draw = function() {
      this.newCanvas();
      var min = 0;
      var max = 0;

      $.each(this.settings.values, function(i,val){
        if (val < min)
          min = val;
        if (val > max)
          max = val;
      });
      if(this.settings.fixedMaxValue){
		max=this.settings.fixedMaxValue;
	  }
      min = Math.floor(min);
      max = Math.ceil(max);

      var spacing = Math.ceil(this.width/20);

      for(var i = min; i <= max; i += this.settings.step) {
        this.cxt.beginPath();
        this.cxt.arc(this.width/2,
                     this.height/2,
                     this.settings.step * spacing * i,
                     0, 2 * Math.PI, false);
        this.cxt.strokeStyle = "#666";
        this.cxt.fillStyle = "#444";
        this.cxt.stroke();
        if (this.settings.showAxisLabels)
          this.cxt.fillText(i,this.width/2 + this.settings.step * spacing * i+4, this.height/2-2);
      }

      var size = 0;
      for(var key in this.settings.values)
        size += 1;

      for(var i = 0; i < size; i += 1) {
        this.cxt.beginPath();
        this.cxt.moveTo(this.width / 2, this.height /2);
        var x = this.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * max;
        var y = this.height /2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * max;
        this.cxt.lineTo(x, y);
        this.cxt.stroke();
      }

      //this.newCanvas('part',200);

      this.cxt.beginPath();
      var first = true;
      var i = 0;
      var that = this;
      var end = {x: null, y: null};
      $.each(this.settings.values, function(key,val){
        var x = that.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * val;
        var y = that.height / 2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * val;
        if (first) {
          that.cxt.moveTo(x, y);
          end.x = x;
          end.y = y;
          first = false;
        }
        that.cxt.lineTo(x, y);
        i += 1;
      });

      this.cxt.lineTo(end.x, end.y);
      var grad = this.cxt.createLinearGradient(0, 0, 0, this.height);
      grad.addColorStop(0,"rgba("+this.settings.color[0]+","+this.settings.color[1]+","+this.settings.color[2]+",0)");
      grad.addColorStop(1,"rgba("+this.settings.color[0]+","+this.settings.color[1]+","+this.settings.color[2]+",1)");
      this.cxt.fillStyle = grad;
      this.cxt.shadowBlur = 2;
      this.cxt.shadowColor = "rgba(0, 0, 0, .2)";
      this.cxt.stroke();
      this.cxt.fill();

      //this.newCanvas('labels',1000);
      var additionalLineDistance =  this.settings.additionalLineDistance;
      i = 0;
      $.each(this.settings.values, function(key,val){
        //that.newCanvas('label-'+i, i * 250);
        that.cxt.fillStyle = "rgba(0,0,0,.8)";
        that.cxt.strokeStyle = "rgba(0,0,0,.5)";
        that.cxt.font = "bold 12px Verdana";
        var dist = Math.min(spacing * val, size * spacing);
        var x = that.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * val;
        var y = that.height / 2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * val;

        var textX = that.width / 2 + Math.cos((Math.PI * 2) * (i / size)) * spacing * max;
        var textY = that.height / 2 + Math.sin((Math.PI * 2) * (i / size)) * spacing * max * 1.5;

        if (textX < that.width/2) {
          textX -= (max *3) ;

		if(additionalLineDistance){
			textX -= additionalLineDistance;
		 }

          that.cxt.textAlign="end";
          that.cxt.beginPath();
          var width = that.cxt.measureText(key).width;
          that.cxt.moveTo(textX - width - 15, textY + 4);
          that.cxt.lineTo(textX , textY + 4);
          that.cxt.lineTo(x - 2, y);
          that.cxt.lineWidth = 2;
          that.cxt.stroke();
        } else {
          textX += (max *3);

		if(additionalLineDistance){
			textX += additionalLineDistance;
		}
          that.cxt.textAlign="start";
          that.cxt.beginPath();
          var width = that.cxt.measureText(key).width;
          that.cxt.moveTo(x + 2,y);
          that.cxt.lineTo(textX , textY + 4);
          that.cxt.lineTo(textX + width + 15, textY + 4);
          that.cxt.lineWidth = 2;
          that.cxt.stroke();
        }
        that.cxt.fillText(key, textX, textY);
        //For arrows that aren't done.
        i += 1;
      });

      if(this.settings.title){
      //this.newCanvas('title',1000);
      this.cxt.font = "bold 22px Verdana";
      this.cxt.fillText(this.settings.title, 10, 30);
	  }
    }

    return Radar;

  })();

  $.fn.radarChart = function(settings){
    this.each(function(i,ele){
      var radar = new Radar(ele, settings);
    });
  }

})(jQuery);



</script>
