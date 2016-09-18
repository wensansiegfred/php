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
input[type='checkbox'] {
	border: none;
	border-radius: 5px;
	background: #E4E4E4;
}
.paidSignUpContainer {
	padding-left: 20px;
}
.paidSignUpButton {
	width: 150px;
	height: 30px;
	font-family: "SquareBT";
	color: #FFF;
	border: none;
	border-radius: 5px;
	background: #B4B4B4;
	cursor: pointer;
}
select {
width: 210px;
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
});
function validateEmail(elementValue){  
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
	return emailPattern.test(elementValue);  
}
</script>
<br /><br />
<br>
<?php echo form_open('signup'); ?>
<div class="paidSignUpContainer">
<table><tr><td>
<table>
	<tr><td align="right">Email :</td><td><input type="text" id="email" name="email" size="30" maxlength="40" class="textInput email" value="<?php echo set_value('email'); ?>" /></td></tr>
	<tr><td align="right">Re-type Email :</td><td><input type="text" id="emailconf" name="emailconf" size="30" maxlength="40" class="textInput email" value="<?php echo set_value('emailconf'); ?>" /></td></tr>
	<tr><td align="right">Password :</td><td><input type="password" id="password" name="password" size="30" maxlength="100" class="textInput password" value="<?php echo set_value('password'); ?>" /></td></tr>
	<tr><td align="right">Re-type Password :</td><td><input type="password" id="passconf" name="passconf" size="30" maxlength="100" class="textInput password" value="<?php echo set_value('passconf'); ?>" /></td></tr>
	<tr><td align="right">Name :</td><td><input type="text" id="name" name="name" size="30" maxlength="40" class="textInput" value="<?php echo set_value('name'); ?>" /></td></tr>
	<tr><td align="right">Company :</td><td><input type="text" id="company" name="company" size="30" maxlength="40" class="textInput" value="<?php echo set_value('company'); ?>" /></td></tr>
	<tr><td align="right">Address :</td><td><input type="text" id="address" name="address" size="30" maxlength="50" class="textInput" value="<?php echo set_value('address'); ?>" /></td></tr>
	<tr><td align="right">City :</td><td><input type="text" id="city" name="city" size="30" maxlength="15" class="textInput" value="<?php echo set_value('city'); ?>" /></td></tr>
	<tr><td align="right">State :</td><td><input type="text" id="state" name="state" size="30" maxlength="2" class="textInput" value="<?php echo set_value('state'); ?>" /></td></tr>
	<tr><td align="right">Postal Code :</td><td><input type="text" id="postal" name="postal" size="30" maxlength="100" class="textInput" value="<?php echo set_value('postal'); ?>" /></td></tr>
	<tr><td align="right">Country :</td>
        <td>
           <?php echo form_dropdown('country', $countries, '1'); ?>
        </td>
    </tr>
	<tr>
        <td align="right">Timezone :</td>
        <td>
            <?php echo timezone_menu('timezone'); ?>
        </td>
    </tr>
	<tr><td align="right"><input type="checkbox" id="dst" name="dst" class="checkbox" value="<?php echo set_value('dst'); ?>" /></td><td align="left">Daylight Savings Time</td></tr>
	<tr><td align="right">Alert Email :</td><td><input type="text" id="alertemail" name="alertemail" size="30" maxlength="100" class="textInput" value="" /></td></tr>
	<tr><td align="right"><input type="checkbox" id="newletter" name="newletter" class="checkbox" checked="true" disabled="true" /></td><td align="left">Receive Monthly Newsletter</td></tr>
</table>
</td>
<td valign="top" style="padding-left:20px;" width="500">
<input type="checkbox" id="agree" name="agree" /> I agree to the Alert A Tech Terms of Service
<br /><br />
<input type="button" value="Next" class="paidSignUpButton" />
</td></tr></table>
</div>
<br /><br /><br />