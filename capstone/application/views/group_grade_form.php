<div class="my_select_form">
	<select class="select_grade_type form-control" style="width:250px;" group_id="<?php echo $result['id'];?>">
		<option>---Select---</option>
		<?php foreach($result["list"] as $key=>$val): ?>
			<option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
		<?php endforeach;?>
	</select>
</div>
<br/>
<div id="grading_form_content">
</div>