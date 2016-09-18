<form id="member-login-form" action="" method="post" onsubmit="return false">
	<ul>
		<li>Username:</li>
		<li><input type="text" value="" id="username" name="username" size="35"/></li>
		<li>Password:</li>
		<li><input type="password" value="" id="password" name="password" size="35"/></li>
		<li><hr/></li>
		<li><input type="submit" value="Login" id="login-submit"/>&nbsp;<input type="button" value="Cancel" id="cancel-login"/><span id="errormessage"></span></li>
		<li>cant access user account?</li>
		<li>forgot password?</li>
	</ul>
</form>
<script>
	$(document).ready(function(){
		
		$("#login-submit").click(function(){
			var username = $('#username').val();
			var password = $('#password').val();
			
			var url = 'user/validate';
			$.post(url,
				{
					memuser:username,
					mempass:password
				},
				function(data,st)
				{
					if(data.error){
						
						$("#errormessage").html(data.error);				
					}
					else if(data.ok){
						
						$("#login-form-dialog").dialog("close");
						window.location.href = data.redirect;
					}
				},
				'json'
			);
		});
	});
</script>