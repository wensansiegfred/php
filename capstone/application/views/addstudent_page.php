<div class="form-group" stype="padding: 2px;">
	<span class="errormessagestud hide" style="color:#ff0000">User Already Exists.</span>
	<br/>	
	<table class="add_student_class">
		<tr>
			<td style="text-align:right;"><label>Username:</label></td>
			<td><input type="input" id="username" class="form-control" placeholder="Enter Username:Email Address" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td style="text-align:right;"><label>Password:</label></td>
			<td><input type="input" id="password" class="form-control" placeholder="Enter Password" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td style="text-align:right;"><label>Name:</label></td>
			<td><input type="input" id="name" class="form-control" placeholder="Enter Name" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td style="text-align:right;"><label>Group:</label></td>
			<td><select id="group" class="form-control" style="width: 300px;">
				<?php foreach($result as $key=>$val): ?>
					<option value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" id="create_student_user" class="btn btn-default">Submit</button></td>
		</tr>
	</table>	
</div>