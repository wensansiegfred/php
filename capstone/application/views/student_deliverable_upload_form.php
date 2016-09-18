<span style="font-weight:bold"><?php echo $result["d_name"];?></span>
<hr/>
<div class="form-group" stype="padding: 2px;">
	<form method="post" action="" id="upload_file">
		<input type="hidden" id="dev_id" value=""/>
		<input type="hidden" id="dev_id" value=""/>		
		<label>Notes</label>
		<textarea id="notes" class="form-control" rows="3"></textarea>
		<label>Document</label>
		<input type="file" name="userfile" id="userfile" size="20" />
		<br/>
		<button type="submit" id="add_deliverable" class="btn btn-default">Save</button>
	</form>
</div>