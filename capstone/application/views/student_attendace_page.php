<button type="button" class="btn btn-default attendance_report" data-dismiss="modal">
	<i class="fa fa-th-list"></i>&nbsp;View Attendance Report
</button>
<br/>
<br/>
<table class="table table-bordered table-hover">
	<thead>
		<th>Student Name</th>
		<th>Course</th>
		<th>Student #</th>
	</thead>
	<tbody>
		<?php if(!empty($result)){ ?>
			<?php foreach($result["list"] as $key=>$val): ?>
				<tr>
					<td><?php echo $val["name"];?></td>
					<td><?php echo $val["course"];?></td>
					<td><?php echo $val["id"];?></td>
					<td align="center"><button type="button" class="btn btn-default attendance_login" data-dismiss="modal" s_id="<?php echo $val["id"];?>"><i class="fa fa-calendar-o"></i>&nbsp;Login</button></td>
					<td align="center"><button type="button" class="btn btn-default attendance_logout" data-dismiss="modal" s_id="<?php echo $val["id"];?>"><i class="fa fa-calendar"></i>&nbsp;Logout</button></td>
				</tr>
			<?php endforeach;?>
		<?php } ?>
	</tbody>
</table>