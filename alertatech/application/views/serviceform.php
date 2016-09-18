<?php

if(!empty($serviceitemlist))
{
?>
	<input type="hidden" value="<?php echo $id;?>" id="probeid"/>
	<input type="hidden" value="<?php echo $hostid;?>" id="hostid"/>
	Probe Name: <span style="color:#1bab18;"><?php echo $hostname;?></span>
		<br/>
			<label for="description">Service Description:</label>
			<br/>
				<input type="text" name="description" id="description" size="45" class="text ui-widget-content ui-corner-all"/>
				<br/>
			<label for="servicetype">Service Type:</label>
				<br/>
				<select name="servicetype" id="servicetype">
						<?php foreach ($serviceitemlist as $key=>$values):?>
						<option value="<?php echo $values['itemid'];?>"><?php echo $values['name'];?></option>
						<?php endforeach;?>
					</select>
				<br/>
			<label for="interval">Interval: (min)</label>
				<br/>		
					<select name="interval" id="interval">
						<option value="30">30</option>
						<option value="60">60</option>
					</select>
				<br/>
			<label for="history">History: (days)</label>
			<br/>
				<input type="text" name="history" id="history" value="30" class="text ui-widget-content ui-corner-all"/>&nbsp; (How long we keep history)
				<br/>
			<label for="trends">Trends: (days)</label>
				<br/>
				<input type="text" name="trends" id="trends" value="180" class="text ui-widget-content ui-corner-all"/>&nbsp; (How long we keep Trends)
			<br/>
			<br/>
			<span id="err" class="errormessage"></span>
			<span id="message"></span>
<?php
}
?>
