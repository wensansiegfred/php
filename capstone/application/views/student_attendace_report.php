<br/>
<table class="table table-bordered table-hover">
	<thead>
		<th>Student Name</th>
		<th>Course</th>
		<th>Student #</th>
		<th># times present in class</th>
	</thead>
	<tbody>
		<?php if(!empty($result)){ ?>
			<?php foreach($result["list"] as $key=>$val): ?>
				<tr>
					<td><?php echo $val["name"];?></td>
					<td><?php echo $val["course"];?></td>
					<td><?php echo $val["id"];?></td>
					<td><?php echo $val["cnts"];?></td>
				</tr>
			<?php endforeach;?>
		<?php } ?>
	</tbody>
</table>