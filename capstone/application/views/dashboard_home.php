<div class="panel panel-success">
	<div class="panel-heading">
		<div class="panel-title">Chat Box</div>
	</div>
	<div class="panel-body" style="padding: 0px; max-height: 250px;overflow:auto;" >
		<ul class="list-group">
			<?php if(!empty($result)){ ?>
				<?php foreach($result as $key=>$val): ?>
					<a href="#" class="list-group-item list-group-item-warning" style="border:0px;" date="<?php echo $val['date_added'];?>">
						<strong><?php echo $val['name'];?>:</strong> <?php echo $val['message'];?></a>
				<?php endforeach; ?>
			<?php } else {?>
			<a href="#"	class="list-group-item list-group-item-warning" style="border:0px;">No Message</a>
			<?php } ?>		
		</ul>
	</div>
</div>
<div>
	<input type="text" class="form-control message_input" style="width:50%; float:left;"/>&nbsp;
	<button type="submit" class="btn btn-default send_message_button"><i class="fa fa-comments"></i>&nbsp;Send</button>
</div>
