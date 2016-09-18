<div class="form-group" stype="padding: 2px;">
	<!--<span class="errormessagestud hide" style="color:#ff0000">User Already Exists.</span>-->
	<input type="hidden" value="<?php echo $result['id']?>" id="studentid"/>
	<br/>	
	<table class="edit_student_class">
		<tr>
			<td><label>Username:</label></td>
			<td><input type="input" id="username" class="form-control" value="<?php echo (!empty($result['username'])) ? $result['username'] : '' ?>" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td><label>Password:</label></td>
			<td><input type="input" id="password" class="form-control" value="<?php echo !empty($result['password']) ? $result['password']: ''?>" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td><label>Name:</label></td>
			<td><input type="input" id="name" class="form-control" value="<?php echo !empty($result['tmpname']) ? $result['tmpname'] : ''?>" style="width: 300px;"/></td>
		</tr>
		<tr>
			<td><label>Group:</label></td>
			<td>
				<select id="group" class="form-control" style="width: 300px;">
					<?php foreach($result["groups"] as $key=>$val): ?>
						<?php if($result["id"] == $val['id']){ ?>
						<option selected="selected" value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
						<?php } else {?>
						<option value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
						<?php } ?>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" id="edit_student_user" class="btn btn-default">Submit</button></td>
		</tr>
	</table>
</div>