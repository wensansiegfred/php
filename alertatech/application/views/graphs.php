<?php
if(!empty($groups) && !empty($probes)) {

$tmpgroupid = '';
$i = 0;
?>	
	<table id="graph-select-table" style="padding:3px;">
		<tr>
			<td align="right">Group:</td>
			<td>
				<select id="group-list">
					<?php foreach($groups as $key=>$value):?>
						<option value="<?php echo $value['groupid'];?>"><?php echo $value['groupname'];?></option>
					<?php 
						if($i == 0)
						{
							$tmpgroupid = $value['groupid'];
						}
						$i++;
						endforeach;
					?>		
				</select>
			</td>
			<td align="right">Probe:</td>
			<td>
				<div id="probelist-from-group">
					<?php
						
						if(!empty($probes[$tmpgroupid]))
						{
						?>
							<select id="probe-list">
								<?php foreach($probes[$tmpgroupid] as $k=>$v): ?>
									<option value="<?php echo $v['probeid'];?>"><?php echo $v['probename'];?></option>
								<?php endforeach;?>
							</select>								
						<?php 
						}
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td align="right">From:</td>
			<td><input type="text" id="graph-fromdate" value="" size="10" readonly/></td>
			<td align="right">To:</td>
			<td><input type="text" id="graph-todate" value="" size="10" readonly/></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="3"><button id="showgraph">Show Graph</button></td>
		</tr>
	</table>
	<br/>
	<div id="graph-content" style='font-size: 10px;width: 700px;'></div>
<?php
}
else 
{
	echo "No graph to display.";
}
?>
<script>
	$(document).ready(function(){		
		$('#graph-fromdate').datepicker({
			showOn: 'button',
			buttonImage: '<?php echo base_url();?>media/images/calendar.gif',
			dateFormat: 'yy-mm-dd',
			buttonImageOnly: true
		});
		$('#graph-todate').datepicker({
			showOn: 'button',
			buttonImage: '<?php echo base_url();?>media/images/calendar.gif',
			dateFormat: 'yy-mm-dd',
			buttonImageOnly: true
		});
		$("#showgraph").click(function(){
			
			var probeid = $("#probe-list option:selected").val();
			var probename = $("#probe-list option:selected").text();
			var fromdate = $("#graph-fromdate").val();
			var todate = $("#graph-todate").val();
			var url = "<?php echo base_url();?>charting/getHistory/"+probeid+"/"+probename+"/"+fromdate+"/"+todate;
			$.ajax({
				url: url,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#graph-content').html(html);
					$('#graph-content').fadeIn('slow');       
				}    
			});	
		});
	});
</script>