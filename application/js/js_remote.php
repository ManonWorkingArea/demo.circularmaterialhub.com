<script>
function login()
{
	$.ajax(
	{
		type : "POST",
		url : "auth/action/login",
		data : $("#frm-signin").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)
			status = response.status
			msg 	 = response.return

			if(status=="true")
			{
                page("remote/member");
			}
			else
			{
			}
		}

	});
}

function register()
{
	$.ajax(
	{
		type : "POST",
		url : "auth/action/signup",
		data : $("#frm-signup").serialize(),
		dataType : "json",
		success : function(response)
		{
			console.log(response)
            
			status = response.status
			msg = response.return

			if(status=="true")
			{
                page("remote/login");
			}
			else
			{
			}
		}
	});
}
</script>