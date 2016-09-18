<?php
	if(!empty($groups))
	{?>
		<span id="grouplistaccordion">Current list:</span>
		<div id="grouplistacc">
	<?php foreach ($groups as $key=>$value):?>
			<h3><a href="#" class="accordionitem" id="<?php echo $value['groupid'];?>" style="padding-right:270px;"><?php echo ucwords($value['groupname']);?></a>
					<span id="group-status" style="right:1em;position:absolute;margin-top:-18px;">
						Probes:<?php echo isset($probescount[$value['groupid']])?$probescount[$value['groupid']]:0; ?>
					</span>
			</h3>
				<div style="background-color:#f9fafd;display:block;" id="acc-content<?php echo $value['groupid'];?>">&nbsp;</div>	
<?php
		  endforeach;?>
		</div> 
<?php 
	}
?>
<input type="hidden" id="userid" value="<?php echo $userid;?>"/>
<br/>
<input type="button" id="addgroupbtn" value="Add a Group"/>
<script>
	$(function(){
		//default loader for accordion,set all to close; user has option what group should be opened
		$("#grouplistacc").accordion({active:false,alwaysOpen:false,autoHeight:false});
		//click event when an accordion header is clicked,this will load probes under this group name
		$('.accordionitem').click(function(event){			
			var groupid = $(this).attr('id');
			var data = "<?php echo base_url();?>probes/showprobes/"+groupid;
			$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#acc-content'+groupid).html(html);
					$('#acc-content'+groupid).fadeIn('slow');       
				}       
			});
		});
		$("#addgroupbtn").click(function(){			
			jPrompt('Group Name:', '', 'Add Group Dialog', function(r) {
				if( r )
				{
					var userid = $("#userid").val();
					var phpaction = "groups/creategroup";

					$.post(phpaction,{groupname:r,userid:userid},
							function(data)
							{
								if(data == "SUCCESS")
								{
									window.location.href = "<?php echo base_url()?>setup/groups";
								}
								else if(data == "FAILURE")
								{
									alert("FAIL. Please try again.");
								}
							},"json"
					);
				}
			});
		});
	});
</script>