<div class="form-group" stype="padding: 2px;">
	<input type="hidden" id="userid" value="<?php echo $result["id"];?>"/>
	<span class="errormessage hide" style="color:#ff0000">User Already Exists.</span>
	<br/>
	<label>Username</label>
	<input type="input" id="username" class="form-control" value="<?php echo $result["username"];?>" style="width: 300px;"/>
	<label>Password</label>
	<input type="input" id="password" class="form-control" value="<?php echo $result["password"];?>" style="width: 300px;"/>
	<label>Group</label>
	<select id="group" class="form-control" style="width: 300px;">
		<?php foreach($result["groups"] as $key=>$val): ?>
			<?php if($val["id"] == $result["g_id"]){ ?>
				<option selected value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
			<?php } else { ?>
				<option value="<?php echo $val['id']; ?>"><?php echo $val["name"];?></option>
			<?php } ?>
		<?php endforeach; ?>
	</select>
	<br/>
	<button type="submit" id="update_user_by_admin" class="btn btn-default">Submit</button>
</div>