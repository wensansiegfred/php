<style>
table td {
	font-family: arial;
	font-size: 10pt;
	color: #7F7F7F;
}
input.textInput {
	width: 200px;
	padding: 4px;
	font-size: 10pt;
	border: 1px solid #E4E4E4;
	border-radius: 5px;
	background: #E4E4E4;
}
</style>
<script>
$(document).ready(function() {
	$("input.email").blur(function() {
		var valid = validateEmail( $(this).val() );
		var css = valid ? {'border':'1px solid #E4E4E4'} : {'border':'1px solid #F00'};
		$(this).css(css);
	});
});
function validateEmail(elementValue){  
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	return emailPattern.test(elementValue);  
}
function sendReset() {
	var valid = validateEmail( $("input.email").val() );
	if( !valid ) {
		alert("Invalid email!");
		$("input.email").focus();
	} else {
		alert("put function here that actually requests for a password reset!");
	}
}
</script>
<br /><br />
<h1>Password Recovery</h1>
<p>Enter your email below and we will send the login information associated with that email.</p>
<p>
	Email : <input type="text" maxlength="40" class="textInput email" />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" value="Send Password Reset" style="cursor:pointer" onClick="sendReset()" />
</p>
