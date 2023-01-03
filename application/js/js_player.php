<!--
<link rel="stylesheet" type="text/css"  href="theme/assets/theme-player/js/plugin/TreeViewJS/jquery.treeView.css"/>
<script type="text/javascript" src="theme/assets/theme-player/js/plugin/TreeViewJS/jquery.treeView.js"></script>

<?php engine::html("theme","css","theme-player/js/plugin/jstree/themes/proton/style.css");?>
<?php engine::html("theme","css","theme-player/js/plugin/jstree/themes/default/style.min.css");?>
<?php engine::html("theme","css","theme-player/js/plugin/jstree/themes/icons.css");?>

<script src="theme/assets/theme-player/js/plugin/jstree/jstree.js"></script>
<script src="theme/assets/js/plugin/fileuploader/src/jquery.fileuploader.js"></script>
<link href="theme/assets/js/plugin/fileuploader/src/jquery.fileuploader.css" rel="stylesheet">
<link href="theme/assets/js/plugin/fileuploader/examples/drag-drop/css/jquery.fileuploader-theme-dragdrop.css" rel="stylesheet">
<script type="text/javascript" src="theme/assets/js/plugin/bootstrap-filestyle/src/bootstrap-filestyle.min.js"> </script>

-->
<script src="https://cdn.plyr.io/2.0.13/plyr.js"></script>
<link rel="stylesheet" href="https://cdn.plyr.io/2.0.13/plyr.css">

<?php engine::html("theme","js","core/plugin/quiz/quiz.js");?>
<?php engine::html("theme","js","core/plugin/quiz/timer.js");?>

<script>

var timer = false;
$(function ()
{

	var readURL = function(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function (e)
			{
				$('.profile-pic').attr('src', e.target.result);

				$.ajax(
				{
					type : "POST",
					url : "player/action/change-avatar",
					data : {'avatar':e.target.result},
					dataType : "json",
					success : function(response)
					{
						console.log(response)
						status 	= response.status

						if(status == "true")
						{

						}
						else
						{

						}
					}
				});

			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$(".file-upload").on('change', function()
	{
		readURL(this);
	});

	$(".upload-button").on('click', function()
	{
	   $(".file-upload").click();
	});


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

	//---------------------------------------------------
	//---------------------------------------------------
	$('.note-body').on('keyup', function()
	{
		topic = $('#player_code').val();
		text = $('.note-body').text();

		updateNote(topic,text);
	});
	//---------------------------------------------------
	//---------------------------------------------------

});

$("#quiz-timer").createTimer({time_in_seconds: Questionstime});

function updateNote(topic,text)
{
	$.ajax(
	{
		type : "POST",
		url : "player/action/update-note",
		data : {'topic':topic,'note':text},
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			status 	= response.status
			code 	= response.code

			if(status == "true")
			{
			}
			else
			{
			}
		}
	});
}

function getTopic(topic)
{
	console.log("getTopic");
	$.ajax(
	{
		type : "POST",
		url : "player/action/get-topic",
		data : {'topic':topic},
		dataType : "json",
		success : function(response)
		{
			//console.log(response)

			status 	= response.status
			code 	= response.code

			vdo 		= response.vdo
			name 	= response.name
			poster 	= response.poster
			resume 	= response.resume
			note 	= response.note
			message 	= response.message
			count 	= response.messagecount

			//console.log("Code : " + code)

			if(status == "true")
			{
				if(vdo === undefined || vdo === null)
				{
					//console.log("Folder Click !!");
				}
				else
				{
					$('.topic-title').html(name);

					$('#topiccode').val(code);
					$('#topiclastplay').val(resume);
					$('.topiclastplay').html(resume);
					$('.note-body').html(note);
					$('#player_code').val(code);

					player1.setVideoSource(<?php echo $GLOBALS["School"]['cdn'];?>"player.php?video=" + code);
					player1.setPosterSource(<?php echo $GLOBALS["School"]['cdn'];?>"img.php?file=" + poster);
					scrub = $('#videoplayer').attr('data-scrub-at-time-at-first-play');

					$('.list-discussion').html(message);
					$('.messagecount').text(count + " คำถาม");

				}
			}
			else
			{
			}
		}
	});
}

function submitscore()
{

	var score 		= $('#contest-score').val();
	var timer 		= $('#contest-timer').val();
	var contest 	= $('#contest-code').val();
	var lesson 		= $('#contest-lesson').val();

	console.log("Score : " + score);

	$.ajax(
	{
		type : "POST",
		url : "player/action/submit-score",
		data : {'score':score,'timer':timer,'contest':contest,'lesson':lesson},
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			status 	= response.status
			msg 		= response.return

			//console.log("Code : " + code)

			if(status == "true")
			{
				swal(
				{
					title: "ข้อความจากระบบ",
					text: msg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
					back();
				});
			}
			else
			{
				swal(
				{
					title: "ข้อความจากระบบ",
					text: msg,
					html: true,
					showConfirmButton: true
				},
				function()
				{
				});
			}
		}
	});
}

function sendMessage()
{
	player1.pause();

	var subject 		= $('#subject').val();
	var message 	= $('#message').val();
	var player 		= $('#player_code').val();
	var playtimer 	= player1.getCurrentTime();

	$.ajax(
	{
		type : "POST",
		url : "player/action/send-message",
		data : {'playtimer':playtimer,'subject':subject,'message':message,'player':player},
		dataType : "json",
		success : function(response)
		{
			console.log(response)

			status 	= response.status
			msg 		= response.return
			message = response.message
			count 	= response.messagecount

			if(status == "true")
			{
				$('#subject').val("");
				$('#message').val("");
				$('.list-discussion').html(message);
				$('.messagecount').text(count + " คำถาม");
				player1.play();
			}
			else
			{

			}
		}
	});
}

function playFromMessage(time)
{
	player1.scrubbAtTime(time);
}


</script>
