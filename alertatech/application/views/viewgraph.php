<?php
if(!empty($items))
{	
	foreach($items as $key=>$val)
	{
		$probename = $probename;
		$fromdate = $from;
		$todate = $to;
		$randnum = rand(0,1000000);
	?>
		<center>
			<img width="900" src='<?php echo base_url();?>chart/getLineGraph/<?php echo $val;?>/<?php echo $probename;?>/<?php echo $fromdate;?>/<?php echo $todate;?>/<?php echo $randnum;?>'/>
		</center>
		<br/>
<?php
	}
}