<input type="hidden" id="groupid" value="<?php echo $groupid; ?>"/>
<table width="100%">	
	<tr>
		<td class="add-probe-name">Probe Name:</td>
		<td><input type="text" id="probename" name="probename" class="probename" size="42"/><span id="errProbename" class="errormessage"></span></td>
	</tr>
	<tr>
		<td class="add-probe-name">URL:</td>
		<td><input type="text" id="urlname" name="urlname" class="urlname" size="32"/><span id="errURL" class="errormessage"></span></td>
	</tr>
	<tr>
		<td class="add-probe-name">IP Address:</td>
		<td><input type="text" id="ipadd" name="ipadd" class="ipadd" value="0.0.0.0"/><span id="errIp" class="errormessage"></span></td>
	</tr>
	<tr>
		<td class="add-probe-name">Port:</td>
		<td><input type="text" id="portname" name="portname" class="portname" value="10050"/><span id="errPort" class="errormessage"></span></td>
	</tr>
	<tr>
		<td class="add-probe-name">Probe Type:</td>
		<td>
			<select id="probetype">
			<?php foreach($servertype as $key=>$value):?>
			<option value="<?php echo $key;?>"><?php echo $value;?></option>
			<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>		
		<td colspan="2"><span id="message" class="probemessage">&nbsp;</span>	</td>
	</tr>				
</table>		
<script>
	$(document).ready(function(){
		$("input").focus(function(){
			$(".errormessage").html('&nbsp;');
		});
		
		$("#saveprobebtn").click(function(){
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
		});
		$("#cancelprobebtn").click(function(){
			window.location.href = "<?php echo base_url()?>setup/groups";
		});		
	});
	
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