<span style="font-weight:bold">EDIT:</span>
<hr/>
<div class="form-group" stype="padding: 2px;">
	<form method="post" action="" id="upload_file">
		<input type="hidden" id="id" value="<?php echo $result['id'];?>"/>	
		<label>Notes</label>
		<textarea id="notes" class="form-control" rows="3">
			<?php echo $result["notes"];?>
		</textarea>
		<label>Document</label>
		<input type="file" name="userfile" id="userfile" size="20" />
		<br/>
		<button type="submit" id="add_deliverable" class="btn btn-default">Save</button>
	</form>
</div>