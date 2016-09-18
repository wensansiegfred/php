<?php if(!empty($result)){ ?>
	<?php foreach($result as $key=>$val): ?>
		<a href="#" class="list-group-item list-group-item-warning" style="border:0px;" date="<?php echo $val['date_added'];?>">
			<strong><?php echo $val['name'];?>:</strong> <?php echo $val['message'];?></a>
	<?php endforeach; ?>
<?php } else {?>
<a href="#"	class="list-group-item list-group-item-warning" style="border:0px;">No Message</a>
<?php } ?>