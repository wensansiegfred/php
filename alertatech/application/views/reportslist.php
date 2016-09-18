<?php
if(!empty($probes))
{
	
?>
<table id="probelist">
	<th>Status</th>
	<th>Probe Name</th>
	<th>HostName/URL</th>
	<th>Last check</th>
	<th colspan="2">Options</th>
	<?php foreach($probes as $key=>$values): ?>
	<tr>
		<td><?php echo $values['status'];?></td>
		<td><?php echo $values['probename'];?></td>
		<td><?php echo $values['dns'];?></td>
		<td><?php echo date("Y-m-d");?></td>
		<td align="center"><img style="cursor:pointer" src="<?php echo base_url();?>media/images/probes/charts.png" onclick="showGraph(<?php echo $values['hostid'];?>)"/></td>
		<td>Summary</td>		
	</tr>
	<?php endforeach;?>	
</table>
<?php

}
else
{
	echo "There is no probe to display, please create a new probe.(temporary message ;)).";
}
?>