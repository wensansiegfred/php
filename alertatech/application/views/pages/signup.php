<br/>
<br/>
<br/>
<br/>
<br/>
<span id="signuptext">Sign Up</span>
<?php echo validation_errors(); ?>
<?php echo form_open('signmeup'); ?>
<table>
	<tr>
		<td>Email:</td>
		<td><input type="text" id="email" name="email"/></td>
	</tr>
	<tr>
		<td>Retype Email:</td>
		<td><input type="text" id="reemail" name="reemail"/></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" id="password" name="password"/></td>
	</tr>
	<tr>
		<td>Retype Password:</td>
		<td><input type="password" id="repassword" name="repassword"/></td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><input type="text" id="name" name="name"/></td>
	</tr>
	<tr>
		<td>Company:</td>
		<td><input type="text" id="company" name="company"/></td>
	</tr>
	<tr>
		<td>Address:</td>
		<td><input type="text" id="address" name="address"/></td>
	</tr>
	<tr>
		<td>City:</td>
		<td><input type="text" id="city" name="city"/></td>
	</tr>
	<tr>
		<td>State:</td>
		<td><input type="text" id="state" name="state"/></td>
	</tr>
	<tr>
		<td>Postal Code:</td>
		<td><input type="text" id="pcode" name="pcode"/></td>
	</tr>
	<tr>
		<td>Country:</td>
		<td><input type="text" id="country" name="country"/></td>
	</tr>	
	<tr>
		<td>Time Zone:</td>
		<td><input type="text" id="tzone" name="tzone"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Submit" /></td>
	</tr>
</table>
</form>