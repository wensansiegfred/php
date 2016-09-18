<div class="panel panel-success" style="width:40%;">
	<div class="panel-heading">
		<div class="panel-title">Grading Assessment</div>
	</div>
	<div class="panel-body" style="padding: 0px;" >
		<table class="table_student_grading_form">
			<?php foreach($result['list'] as $key=>$val): ?>
			<tr>
				<td align="right"><label for="<?php echo $val['id'];?>"><?php echo $val["name"];?>:</label></td>
				<td><input type="text" class="form-control" id="<?php echo $val['id'];?>" style="width:100px;" ps_score="<?php echo $val["ps_score"];?>"/></td>
			</tr>
			<?php endforeach;?>
			<tr>
				<td>&nbsp;</td>
				<td><button type="submit" id="create_student_group_grade" class="btn btn-default"><i class="fa fa-floppy-o"></i>&nbsp;Save</button></td>
			</tr>
		</table>
	</div>
</div>