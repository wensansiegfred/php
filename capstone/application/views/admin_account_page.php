<span style="font-weight:bold">List of Users:</span>
<table class="table table-bordered table-hover">
	<thead>
      <tr>
        <th>Username</th>
        <th>Group</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
  	<?php if(!empty($result)){ ?>
  		<?php foreach($result as $key=>$val): ?>
	    	<tr>
	    		<td><?php echo (!empty($val["username"])) ? $val["username"]: '';?></td>
	    		<td><?php echo (!empty($val["group_name"])) ? $val["group_name"] : ''; ?></td>
	    		<td><span style="cursor:pointer;cursor:hand;" class="fa fa-edit admin_edit_user" user_id = "<?php echo $val["id"];?>">&nbsp;</span>Edit</td>
	    		<td><span style="cursor:pointer;cursor:hand;" class="fa fa-minus-circle admin_delete_user" user_id="<?php echo $val["id"];?>">&nbsp;</span>Delete</td>
	    	</tr>
    	<?php endforeach; ?>
    <?php }else{ ?>
    	<tr>
    		<td colspan="4">No user available.</td>
    	</tr>
    <?php } ?>
    </tbody>
</table>
<button type="submit" id="create_user_admin" class="btn btn-default">Create User</button>