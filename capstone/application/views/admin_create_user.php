<div class="form-group" stype="padding: 2px;">
	<span class="errormessage hide" style="color:#ff0000">User Already Exists.</span>
	<br/>
	<label>Username</label>
	<input type="input" id="username" class="form-control" placeholder="Enter Username:Email Address" style="width: 300px;"/>
	<label>Password</label>
	<input type="input" id="password" class="form-control" placeholder="Enter Password" style="width: 300px;"/>
	<label>Group</label>
	<select id="group" class="form-control" style="width: 300px;">
		<?php foreach($result as $key=>$val): ?>
			<option value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
		<?php endforeach; ?>
	</select>
	<br/>
	<button type="submit" id="create_user_by_admin" class="btn btn-default">Submit</button>
</div>