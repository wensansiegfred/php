<div class="form-group" stype="padding: 2px;">
	<input type="hidden" id="id" value="<?php echo $result['id'];?>"/>	
	<br/>
	<label>CODE</label>
	<input type="input" id="code" class="form-control" value="<?php echo $result['code'];?>" style="width: 300px;"/>
	<label>Description</label>
	<input type="input" id="description" class="form-control" value="<?php echo $result['description'];?>" style="width: 600px;"/>
	<label>Submission Date</label>
	<input type="input" id="submission_date" class="form-control submission_date" style="width: 100px;" value="<?php echo $result['date'];?>" readonly/>
	<br/>
	<button type="submit" id="submit_edit_deliverable" class="btn btn-default">Submit</button>
</div>