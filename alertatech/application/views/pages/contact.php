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
textarea.textarea {
	padding: 4px;
	font-family: arial;
	font-size: 10pt;
	border: 1px solid #E4E4E4;
	border-radius: 5px;
	background: #E4E4E4;
}
.headerInfo {
	color: #66C7A6;
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
</script>
<br /><br /><br /><br /><br /><br />
<div>
<h1>TALK TO US</h1>
<br /><br />
<table><tr><td>
<table>
	<tr><td align="right" nowrap>Name :</td><td><input type="text" maxlength="100" class="textInput" /></td></tr>
	<tr><td align="right" nowrap>Email Address :</td><td><input type="text" maxlength="100" class="email textInput" /></td></tr>
	<tr><td align="right" nowrap>Telephone :</td><td><input type="text" maxlength="100" class="textInput" /></td></tr>
	<tr><td colspan="2"><br /><br /></td></tr>
	<tr><td align="right" nowrap>Subject :</td><td><input type="text" maxlength="100" class="textInput" /></td></tr>
	<tr><td align="right" valign="top" nowrap>Message :</td><td><textarea class="textarea" rows="10" cols="50"></textarea></td></tr>
</table>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td valign="top">
<div class="headerInfo">ADDRESS:</div>
<span class="contentStyle">
	Lorem ipsum dolor sit amet, consetetur<br />
	sadipscing elitr,
</span>
<br /><br />
<div class="headerInfo">PHONE:</div>
<span class="contentStyle">
	0123456789
</span>
<br /><br />
<div class="headerInfo">FAX:</div>
<span class="contentStyle">
	0123456789
</span>
<div class="headerInfo">EMAIL:</div>
<span class="contentStyle">
	<a href="mailto:inquiry@alertatech.com">inquiry@alertatech.com</a>
</span>

</td></tr></table>
</div>