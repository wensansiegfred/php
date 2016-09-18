<?php
echo "<pre>";
print_r($service);
if(!empty($service))
{?>
	<span id="service-tab-title">Service</span>
	<table id="servicelist">
		<tr>
			<th>Service Name</th>
			<th>Service Type</th>
			<th>Alerts</th>
			<th>Status</th>
			<th></th>
		</tr>
		<?php foreach($service as $key=>$values): ?>
		<tr>
			<td><?php echo (!empty($values['servicename']))?$values['servicename']:'';?></td>
			<td><?php echo (!empty($values['servicetype']))?$values['servicetype']:'';?></td>
			<td>&nbsp;</td>
			<td><?php echo (!empty($values['servicename']))?$values['servicename']:'';?></td>
		</tr>
		<?php endforeach;?>
	</table>
<?php
}
?>