<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>CAPSTONE::LOGIN</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/reset.css">
	<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/animate.css">-->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/styles.css">
	<script type="text/javascript" src="<?php echo base_url();?>assets/dashboard/js/jquery-1.9.1.js"></script>
	<script>
		$(document).ready(function(){
			$("#login_btn").click(function(e){
				e.preventDefault();
				var username = $("#username").val();
				var password = $("#password").val();
				var keeplogin = $("#keeplogin").is(":checked");
				var params = {
					username: username,
					password: password,
					keeplogin: keeplogin
				}
				
				var url = "login/validate";
				$.ajax({
					data: params,
					url: url,
					type: "POST",
					cache: false,
					dataType: 'json',
					success: function(d){
						if(d.result == "success"){
							window.location.href = "dashboard";
						}else{
							$("#error").removeClass("hidden");
						}
					},
					error: function(d){
						console.log("Internal Server Error! Please check back later.");
					}
				});
				return false;
			});
		});
	</script>
	<style type="text/css">
		.hidden{
			display: none !important;
		}
		#error{
			color: #ff0000;
			font-size: 60%;
			position: absolute;
			margin-left: -110px;
			margin-top: 10px;
		}
	</style>
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<form>
		
		<label for="name">Username:</label>
		
		<input id="username" type="name">
		
		<label for="username">Password:</label>
		
		<!--<p><a href="#">Forgot your password?</a>-->
		
		<input id="password" type="password">
		
		<div id="lower">
		
		<!--<input id="keeplogin" type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>-->
		<span id="error" class="hidden">Invalid Username & Password</span>
		<input type="submit" id="login_btn" value="Login">
		
		</div>
		
		</form>
		
	</div>
</body>

</html>
	
	
	
	
	
		
	