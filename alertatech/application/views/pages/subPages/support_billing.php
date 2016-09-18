<style>
table td {
	font-family: arial;
	font-size: 10pt;
	color: #7F7F7F;
}
input.textInput, select {
	width: 220px;
	padding: 4px;
	font-size: 10pt;
	border: 1px solid #E4E4E4;
	border-radius: 5px;
	background: #E4E4E4;
}
input[type='checkbox'] {
	border: none;
	border-radius: 5px;
	background: #E4E4E4;
}
select {
	width: 230px;
}
.freeSignUpContainer {
	padding-left: 20px;
}
.freeSignUpButton {
	width: 150px;
	height: 30px;
	font-family: "SquareBT";
	color: #FFF;
	border: none;
	border-radius: 5px;
	background: #B4B4B4;
	cursor: pointer;
}
</style>
<script>
$(document).ready(function() {
	$("input.email").blur(function() {
		var email1 = $("input.email:eq(0)");
		var email2 = $("input.email:eq(1)");
		var valid = validateEmail( $(this).val() );
		var css = valid ? {'border':'1px solid #E4E4E4'} : {'border':'1px solid #F00'};
		$(this).css(css);
		if( email1.val().length > 0 && email2.val().length > 0 ) {
			valid = email1.val() == email2.val();
			css = valid ? {'border':'1px solid #E4E4E4'} : {'border':'1px solid #F00'};
			email2.css( css );
		}
	});
	$("input.password").blur(function() {
		var pass1 = $("input.password:eq(0)");
		var pass2 = $("input.password:eq(1)");
		if( pass1.val().length > 0 && pass2.val().length > 0 ) {
			var valid = pass1.val() == pass2.val();
			var css = valid ? {'border':'1px solid #E4E4E4'} : {'border':'1px solid #F00'};
			pass2.css( css );
		}
	});
	$("select option:odd").css("background","#FFF");
});
function validateEmail(elementValue){  
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	return emailPattern.test(elementValue);  
}
</script>
<br /><br />
<div class="freeSignUpContainer">
<table>
	<tr><td align="right">Plan :</td><td><input type="text" size="30" maxlength="100" class="textInput" /></td></tr>
	<tr><td align="right">Terms :</td>
		<td>
			<select id="supportBillingTerms">
				<option value="X">Please select a term period</option>
				<option value="1">Monthly</option>
				<option value="2">Quarterly</option>
				<option value="3">Bi-Annual</option>
				<option value="4">Annual</option>
			</select>
		</td>
	</tr>
	<tr><td align="right">Total :</td><td><input type="text" size="30" maxlength="100" class="textInput" /></td></tr>
	<tr><td align="right">Select :</td>
		<td>
			<select id="supportBillingSelectPaymentMode">
				<option value="X">Please select a payment mode</option>
				<option value="1">PayPal</option>
				<option value="2">2Checkout.com</option>
			</select>
		</td>
	</tr>
	<tr><td align="right">&nbsp;</td><td><input type="button" value="SIGN UP" class="freeSignUpButton" /></td></tr>
</table>
</div>
<br /><br /><br />