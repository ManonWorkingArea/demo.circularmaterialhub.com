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
// echo "<pre>";
// print_r($data["Output"] );
// echo "</pre>";

?>

<?php
                        
// echo "<pre>";
// print_r($data["FormSet"]);
// echo "</pre>";

$result_data    = "";
$result_table   = "";
$order = 0;
foreach ($data["FormSet"] as $FormSet)
{
    if($FormSet['approveRow']['app_ass_id']!="" || $FormSet['approveRow']['app_ass_id']!= NULL)
    {
    if($FormSet['approveRow']['app_ass_status']=="pending")
    {
        $score = "<div class='result'>กำลังพิจารณา</div>";
    }
    else if($FormSet['approveRow']['app_ass_status']=="approve")
    {
        $score = "<div class='result'>{$FormSet['approveRow']['app_ass_score']} คะแนน</div>";
    }
    else if($FormSet['approveRow']['app_ass_status']=="reject")
    {
        $score = "<div class='result'>ปฏิเสธ</div>";
    }
    else if($FormSet['approveRow']['app_ass_status']=="change")
    {
        $score = "<div class='result'>แก้ไขข้อมูล</div>";
    }
    else
    {
        $score = "<div class='result'>รอพิจารณา</div>";
    }
    }
    else
    {
    $score = "<div class='result'>รอพิจารณา</div>";
    }
    if($FormSet['approveRow']['app_ass_score']!="" || $FormSet['approveRow']['app_ass_score'] !=NULL)
    {
        $score = $FormSet['approveRow']['app_ass_score'];
    }
    else
    {
        $score = "0";
    }
    // Result Data
    
    if($FormSet['set_mode'] == "GR")
    {
        $order++;
        $result_data .= "'{$FormSet['set_name']}':{$score},";
        $result_table .= "
        <tr>
        <td>{$order}.{$FormSet['set_name']}</td>
        <td>{$score}</td>
        </tr>
        ";
    }

    // Result Data
    if($FormSet['set_mode'] == "BR")
    {
        $result_table_br .= "
        <tr>
        <td>1.{$FormSet['set_name']}</td>
        <td>{$score}</td>
        </tr>
        ";
    }

    // Result Data
    if($FormSet['set_mode'] == "BL")
    {
        $result_table_bl .= "
        <tr>
        <td>2.{$FormSet['set_name']}</td>
        <td>{$score}</td>
        </tr>
        ";
    }
}
?>

<section class="breadcrumb-area my-courses-bread application-form">

    <div class="topbar-control">
      <div class="container">
        <div class="col-md-12">
          <div class="topbar-nav">
            <a href="member"><i class="fa fa-home"></i></a> <i class="fa fa-angle-right icon-divition"></i> <span class="parent"><?php echo $data["Detail"]['app_name']?></span> <i class="fa fa-angle-right icon-divition"></i> <span class="current">ผลการประเมินมาตรฐาน<i class="fa fa-angle-right icon-divition"></i> ใบสมัครของ <?php echo $data["Output"]['Member']['mem_firstname']?> <?php echo $data["Output"]['Member']['mem_lastname']?></span>
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

                    <section class="tabs tabs4">

                    <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" onchange="page('app/view_fill/<?php echo $data["Application"]['ap_token'] . "/" . $first;?>')"/>
                    <label for="tab-1" class="tab-label-1"><span class="form-step">ขั้นตอนที่ 1</span><i class="fa fa-file"></i> ข้อกำหนดมาตรฐาน</label>

                    <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" checked="checked" onchange="page('app/view_result/<?php echo $data["Application"]['ap_token']?>')"/>
                    <label for="tab-2" class="tab-label-2"><span class="form-step">ขั้นตอนที่ 2</span><i class="fa fa-bar-chart"></i> ผลลัพธ์</label>

                    <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3"  onchange="page('app/view_upload/<?php echo $data['Output']['Linkage']['linkage_app']['ap_token'];?>')"/>
                    <label for="tab-3" class="tab-label-3"><span class="form-step">ขั้นตอนที่ 3</span><i class="fa fa-upload"></i> ข้อมูลเอกสาร</label>

                    <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4"  onchange="page('app/view/<?php echo $data['Output']['Linkage']['linkage_app']['ap_token'];?>')"/>
                    <label for="tab-4" class="tab-label-4"><span class="form-step">ขั้นตอนที่ 4</span><i class="fa fa-pencil"></i> ข้อมูลใบสมัคร</label>

                    <!--<div class="clear-shadow"></div>-->
                    </section>

                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

<section class="admission-area section--flat-padding">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h5 class="section__meta">ผลการประเมินมาตรฐานโรงงาน (Eco Factory)</h5>
                    <h2 class="section__title">Eco Factory</h2>
                    <p>User Assumption Result</p>
                </div>
            </div>
        </div>
        <div class="row margin-top-20px">
            <div class="col-lg-12 mx-auto">
                <div class="card-box-shared">

                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                          
                            <div class="row">
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
                                        <?php echo $result_table_br;?>
                                        <?php echo $result_table_bl;?>
                                        <?php echo $result_table;?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-10 -->
        </div><!-- end row -->
    </div><!-- end container -->
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
        values: {<?php echo $result_data;?>},
		showAxisLabels: true
		});
  });

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
    values: {<?php echo $result_data;?>},
    showAxisLabels: true
  });
});

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
