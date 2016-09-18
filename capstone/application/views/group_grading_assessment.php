<?php if(!empty($result["grouplist"])){ ?>
	<br/>	
	<table class="table table-bordered table-hover group_grading_table">
		<tr>
			<th style="border-left:1px solid #fff;border-top:1px solid #fff;border-bottom:1px solid #fff;">&nbsp;</th>
			<th colspan="7" style="text-align:center;background-color:#dff0d8;color:#468847;">Title Hearing</th>
			<th colspan="8" style="text-align:center;background-color:#dff0d8;color:#468847;">Proposal Hearing</th>
			<th colspan="7" style="text-align:center;background-color:#dff0d8;color:#468847;">Final Oral Defense</th>
		</tr>
		<tr>
			<td style="border-left:1px solid #fff;border-top:1px solid #fff;">&nbsp;</td>
			<?php foreach($result["gradinglist"] as $k=>$v): ?>
				<td style="font-size:80%;"><?php echo $v["abbr"];?></td>
			<?php endforeach; ?>
		</tr>
		<?php foreach($result["grouplist"] as $key=>$val): ?>
			<tr>
				<td nowrap style="font-size:80%"><strong><?php echo $val["name"];?></strong></td>
				<?php foreach($result["gradinglist"] as $k=>$v): ?>
					<td class="cursor input-box-td" style="text-align:center;font-size:80%;padding:0px;vertical-align:middle;">
						<div class="display">val</div>
						<div class="hide input-box">
							<input type="text" class="input-grade" style="width:30px;" value=""/>
						</div>
					</td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>
<?php } ?>