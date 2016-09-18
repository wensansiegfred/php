<?php
if(!empty($probes))
{	
?>
<span id="probes-tab-title">Probes</span>
<table id="probelist">
	<th>Probe Name</th>
	<th>URL</th>
	<th>Ip Address</th>
	<th>Port</th>
	<th>Service</th>
	<th>Date Created</th>
	<th></th>
<?php foreach($probes as $key=>$values): ?>
	<tr>
		<td><?php echo $values['probename'];?></td>
		<td><?php echo $values['dns'];?></td>
		<td><?php echo $values['ip'];?></td>
		<td><?php echo $values['port'];?></td>
		<td align="center">
		<?php
			if($values['numitems']>0)
				$service = '<a href="#" onclick="showService('.$values['probeid'].')" title="Click here to view list of service added">'.$values['numitems'].'</a>';
			else
				$service = '0';
		?>
			<?php echo $service;?>
		</td>
		<td><?php echo (!empty($values['datecreated']))?date("m/d/Y",strtotime($values['datecreated'])):'';?></td>
		<td align="center">
			<img style="cursor:pointer;" src="<?php echo base_url();?>/media/images/probes/gear.png" onclick="showAddItem(<?php echo $values['probeid'];?>,<?php echo $values['hostid'];?>,'<?php echo $values['probename'];?>')" title="add a service for this Probe"/>
		</td>
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
<input type="hidden" id="groupid" value="<?php echo $groupid; ?>"/>
<div id="div-probe-btn" style="margin-left: 3px;margin-top: 3px;"><input style="cursor:pointer" type="button" value="Add New Probe" id="addprobebtn"/></div>
<div id="add-service-from-probe" title="Add Service:">&nbsp;</div>
<div id="addprobe-form-dialog" title="Add Probe"><div id="addprobe-form"></div></div>
<script>
$(function(){
	$("#addprobebtn").click(function(){
		$( "#addprobe-form-dialog" ).dialog( "open" );
		var groupid = $("#groupid").val();
		
		var data = "<?php echo base_url()?>probes/addprobe/?groupid="+groupid;
				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#addprobe-form').html(html);
					$('#addprobe-form').fadeIn('slow');       
				}       
			});
	});
	$( "#addprobe-form-dialog" ).dialog({
		autoOpen:false,
		height: 250,
		width: 450,
		modal: true,
		buttons: {
			"Save": function() {
				var valid = true;
				var probename = $("#probename").val();
					if(probename.length < 1) { 
						errorMessage('Please indicate Probe name.','errProbename');
						valid = false;
					}
				var url = $("#urlname").val();
					if(!isValidUrl(url)) {
						errorMessage('Invalid URL.','errURL');
						valid = false;
					}
				var ipadd = $("#ipadd").val();
					if(!validateIp(ipadd)) {
						errorMessage('Invalid Ip Address.','errIp');
						valid = false;
					}
				var port = $("#portname").val();
					if(port.length < 1) {
						errorMessage('Please indicate port.','errPort');
						valid = false;
					}
				var probetype = $("#probetype").val();
				var groupname = $("#probetype").text();
				var groupid = $("#groupid").val();
				//trim replace the url path so it can be passed to code igniter function as parameter
				var newurl = url.replace(/\//g, "\\");
				var url = "<?php echo base_url()?>probes/create/?probename="+probename+"&ipadd="+ipadd+"&url="+url+"&port="+port+"&probetype="+probetype+"&groupid="+groupid;
				
				if(valid)
				{
					$.ajax({
							url: url,  
							type: "POST", 
							cache: false,
							success: function (html) {
							$('#message').html(html);
							$('#message').fadeIn('slow');       
							}
						}); 
				}
			},
			"Close": function() {
				$(this).dialog("close");
				$('.accordionitem').click();
			}
		}
	});
	$( "#add-service-from-probe" ).dialog({
		autoOpen: false,
		height: 350,
		width: 350,
		modal: true,
		buttons: {
			"Save": function() {
				var valid = true;
				var history = $("#history").val();		
				var trends = $("#trends").val();
				$("input").focus(function(){
					$(".errormessage").html('&nbsp;');
				});
				
				var probeid = $("#probeid").val();
				var hostid = $("#hostid").val();
				var servicedescription = $("#description").val();
				if(servicedescription.length < 1)
				{
					valid = false;
					errorMessage('Please indicate Service Description name.','err');
				}		
				var itemidsel = $("#servicetype").val();
				var interval = $("#interval").val();
				if(isNumeric(trends) == null)
				{
					valid = false;
					errorMessage('Invalid Trends value.','err');
				}
				if(isNumeric(history) == null)
				{
					valid = false;
					errorMessage('Invalid History value.','err');
				}
				if(valid)
				{
					var data = "<?php echo base_url()?>probes/addservice/"+probeid+"/"+hostid+"/"+itemidsel+"/"+interval+"/"+servicedescription+"/"+history+"/"+trends;
					
					$.ajax({
						url: data,  
						type: "POST", 
						cache: false,
						success: function (html) {
							$('#message').html(html);
							$('#message').fadeIn('slow'); 
						}       
					});
				}
				},			
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		}
	});
});
function showAddItem(id,hostid,hostname)
{	
	$( "#add-service-from-probe" ).dialog( "open" );
	
	var data = "<?php echo base_url()?>probes/loadserviceform/"+id+"/"+hostid+"/"+hostname;
	$.ajax({
		url: data,  
		type: "POST", 
		cache: false,
		success: function (html) {
			$('#add-service-from-probe').html(html);
			$('#add-service-from-probe').fadeIn('slow');       
		}       
	});	
}

function isNumeric(num)
{
	var patern =  /^\d+$/;
	return num.match(patern);
}

function errorMessage(msg,id)
{
	$('#'+id).html(msg);
}

function validateIp(ipval)
{
	var ipPattern = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	var ipArray = ipval.match(ipPattern);
	var segment;
	var valid = true;
	for (i = 0; i < 4; i++) {
		segment = ipArray[i];
		if (segment > 255) {
			valid = false;
			i = 4;
		}
		if ((i == 0) && (segment > 255)) valid = false;
	}
	if(ipval == "0.0.0.0") valid = false;
	if(ipval.length < 1) valid = false;
	if(ipval == "255.255.255.255") valid = false;
		
	return valid;
}
	
function isValidUrl(url)
{
	var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(url);
}
</script>