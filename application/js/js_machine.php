<script>

<?php
	/*if(isset($_SESSION["Machine"]))
	{
		echo "activeArea();";
	}
	else
	{
		echo "deactiveArea();";
	}*/
?>

function checkStatusMachine(machine)
{
	$.ajax(
	{
		type : "POST",
		url : "machine/action/check-status",
		data : {'machine':machine},
		dataType : "json",
		success : function(response)
		{

			status 			= response.status
			checkstatus 	= response.checkstatus
			client				= response.machine
			session			= response.session
			matching		= response.matching
			actionmatching	= response.actionmatching
			action			= response.action
			
			current 	= $('#machine-' + machine).data("status");
			
			//console.log(action);
			//console.log("status : " + status + " client :  " + client  + " current : " + current + " matching : " + matching + " session : " + session + " checkstatus : " + checkstatus)
			
			if(current != status)
			{
				$('#machine-' + machine).data('status', status);
				$('.machine-status-' + machine).html(status);
				if(status=="2")
				{
					$('#machine-' + machine).addClass("disabled");
				}
				else
				{
					$('#machine-' + machine).removeClass("disabled");
					
					if(matching == "true")
					{
						deactiveArea();
					}
				}
			}
			
			if(machine == client)
			{
				currentstatus = checkstatus;
				if(currentstatus !== null)
				{
					if(currentstatus=="online")
					{
						unlockArea()
							
						if(action =="learn")
						{
							learnActive();
						}
						else if(action =="contest")
						{
							contestActive();
						}
						else if(action =="doc")
						{
							documentActive();
						}
						else if(action =="demo")
						{
							demoActive();
						}
						else
						{
							waitActive()
							unlockArea()
						}
						
						console.log(action);
					}
					else if(currentstatus=="offline")
					{
						deactiveArea()
						unlockArea()
					}
					else if(currentstatus=="lock")
					{
						lockArea()
					}
				}
			}
		}
	});
}

function activeMachine(machine)
{
	$.ajax(
	{
		type : "POST",
		url : "machine/action/online-machine",
		data : {'machine':machine},
		dataType : "json",
		success : function(response)
		{
			status 	= response.status
			waitActive()
		}
	});
}

function learnActive()
{
	$("#learn-section").hasClass("hide")
	{
		$('#machine-section').addClass("hide");
		$('#learn-section').removeClass("hide");
		$('#doc-section').addClass("hide");
		$('#contest-section').addClass("hide");
		$('#demo-section').addClass("hide");
		$('#wait-section').addClass("hide");
	}
}

function contestActive()
{
	$("#contest-section").hasClass("hide")
	{
		$('#machine-section').addClass("hide");
		$('#learn-section').addClass("hide");
		$('#doc-section').addClass("hide");
		$('#contest-section').removeClass("hide");
		$('#demo-section').addClass("hide");
		$('#wait-section').addClass("hide");
	}
}

function documentActive()
{
	$("#doc-section").hasClass("hide")
	{
		$('#machine-section').addClass("hide");
		$('#learn-section').addClass("hide");
		$('#doc-section').removeClass("hide");
		$('#contest-section').addClass("hide");
		$('#demo-section').addClass("hide");
		$('#wait-section').addClass("hide");
	}
}

function demoActive()
{
	$("#demo-section").hasClass("hide")
	{
		$('#machine-section').addClass("hide");
		$('#learn-section').addClass("hide");
		$('#doc-section').addClass("hide");
		$('#contest-section').addClass("hide");
		$('#demo-section').removeClass("hide");
		$('#wait-section').addClass("hide");
	}
}

function waitActive()
{
	$("#wait-section").hasClass("hide")
	{
		$('#machine-section').addClass("hide");
		$('#learn-section').addClass("hide");
		$('#doc-section').addClass("hide");
		$('#contest-section').addClass("hide");
		$('#demo-section').addClass("hide");
		$('#wait-section').removeClass("hide");
	}
}

function deactiveArea()
{
	$('#machine-section').removeClass("hide");
	$('#learn-section').addClass("hide");
}

function lockArea()
{
	$("#lock-section").hasClass("hide")
	{
		$('#lock-section').removeClass("hide");
		$('#machine-section').addClass("hide");
		$('#learn-section').addClass("hide");
		$('#doc-section').addClass("hide");
		$('#contest-section').addClass("hide");
		$('#demo-section').addClass("hide");
		$('#wait-section').addClass("hide");
	}
}

function unlockArea()
{
	$('#lock-section').addClass("hide");
}

</script>