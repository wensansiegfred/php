$(document).ready(function() {
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$(".headerLinks .headerLink").click(function() {
		$(".headerLinks .headerLink").removeClass("selected");
		$(this).addClass("selected");
	});
	$("input[type=button]").click(function() {
		$("input[type=button]").blur();
	});    
	$("#submitloginbtn").click(function(){
		var username = $("#username").val();
		var password = $.sha1($("#password").val());
		var phpaction = "/user/validate";
		$.post
		(phpaction,
			{
				username:username,
				password:password
			},
			function(data,textStatus)
			{
				
			},
			'json'
		);
	});
	$("#signUp").click(function(){		
		$( "#signup-form-dialog" ).dialog( "open" );
		var url = "signup/usersignup";
		$.ajax({
			url: url,  
			type: "POST", 
			cache: false,
			success: function (html) {
				$('#sign-up-form').html(html);
				$('#sign-up-form').fadeIn('slow');       
			}    
		});	
	});
    $("#memberLogin").click(function(){
		//window.location.href = 'home/login';
		$("#login-form-dialog").dialog("open");
		var url = "user/login";
		$.ajax({
			url: url,  
			type: "POST", 
			cache: false,
			success: function (html) {
				$('#login-form').html(html);
				$('#login-form').fadeIn('slow');       
			}    
		});
	});
    $("#memberLogout").click(function(){
		window.location.href = 'home/logout';
	});
    $( "#signup-form-dialog" ).dialog({
		autoOpen: false,
		height: 805,
		width: 585,
		modal: true
	});
	$( "#login-form-dialog" ).dialog({
		autoOpen: false,
		height: 260,
		width: 380,
		modal: true
	});
});