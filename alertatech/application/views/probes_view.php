<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Alert A Tech</title>
    <link rel="stylesheet" href="<?php echo base_url()?>media/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>media/jquery/themes/redmond/jquery.ui.all.css" />
    <script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/js/jquery-1.5.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/js/jquery.bgiframe-2.1.2.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.core.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.widget.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.mouse.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.button.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.draggable.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.position.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.resizable.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript">
	function getProbes()
	{
		var data = "<?php echo base_url()?>probes/showprobes";
				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#probe-contents').html(html);
					$('#probe-contents').fadeIn('slow');       
				}       
			});	
	}
	
	function showAddItem(id,hostid,hostname)
	{	
		var data = "<?php echo base_url()?>probes/loadserviceform/"+id+"/"+hostid+"/"+hostname;

				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#probe-contents').html(html);
					$('#probe-contents').fadeIn('slow');       
				}       
			});	
	}
	
	function createService()
	{
		var probeid = $("#probeid").val();
		var hostid = $("#hostid").val();
		var servicedescription = $("#description").val();
		var itemidsel = $("#servicetype").val();
		var interval = $("#interval").val();
		var history = $("#history").val();
		var trends = $("#trends").val();
		
		if(servicedescription != "" && isNaN(history)==false && isNaN(trends)==false)
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
		else
		{
			alert("Invalid values(s).")
		}
	}
	
	function addProbe()
	{
		var data = "<?php echo base_url()?>probes/addprobe";
				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#probe-contents').html(html);
					$('#probe-contents').fadeIn('slow');       
				}       
			});	
	}

	function showService(hostid)
	{
		var data = "<?php echo base_url()?>probes/service/"+hostid;
	
				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#probe-contents').html(html);
					$('#probe-contents').fadeIn('slow');       
				}       
			});	
	}
</script>
<style type="text/css">
	html,body {
		font: 75% georgia, sans-serif;
		line-height: 1.88889;
		margin: 0; 
		padding: 0;
		background-color: #f5f5f5;
	}
	#container {
		width:1000px;
	  	margin: 0 auto;
	  	display:block;
	  	height:100%;
	  	min-height:500px;
	}
	#container-body {
		width:1000px;
		background-color: #ffffff;
		border: 1px solid #ddd;
		margin-top: 5px;	
	}
	#top-menu {
		border: 1px solid #ddd;
		background-color: #ffffff;
	}
	#top-menu,#setup-menu,#probe-contents {
		width:100%;		
	}
	
	* {
		margin: 0;
		padding: 0;
	}
	ul {
		list-style-type: none;
		/*background-image: url('<?php echo base_url()?>media/images/backgroundred.gif');*/
		background-color: #B51B13;
		height: 27px;
		width: 100%;
		margin: auto;
		padding: 0;
	}
	li {
		float: right;
	}
	ul li {
		display: inline;
	}
	ul a {
		/*background-image: url('<?php echo base_url()?>media/images/borderred.gif');*/
		background-repeat: no-repeat;
		background-position: right;
		padding-right: 32px;
		padding-left: 32px;
		display: block;
		line-height: 27px;
		text-decoration: none;		
		font-size: 11px;
		color: #fff;
	}
	ul a:hover {
		color: #371C1C;
	}
	#add-probe-btn {
		float:right;
		font-size: 11px;
	}
	#probelist {
		width:99%; 
		border:1px solid #ccc; 
		border-bottom:none;
		font-size: 11px;
		border:1px solid #ddd;
		border-collapse:collapse;
		margin: 0 auto;
	}
	#probelist th {
		background:#eeeeee 6px center no-repeat; 
		cursor:pointer;
		height: 27px;
		color:#000;
		text-align:left;
	}
	#probelist td {
		border-bottom: 1px solid #ddd;
		border-right:1px solid #ddd;
		padding-left: 3px;
	}
	/*.add-probe-btn,#saveprobebtn,#cancelprobebtn {
		height:28px;
		border: 1px solid #fff;
		font-size: 1em;
		font-weight:bold;
		cursor:pointer;
		color:#B51B13;
		padding: 0 2px 0 2px;
		width: auto;
	}*/	
		.add-probe-btn,#saveprobebtn,#cancelprobebtn {
		height:28px;
		font-size: 1em;
		font-weight:bold;
		cursor:pointer;
		
	}	
	#serviceform {
		width:900px; 
		border:1px solid #ccc; 
		border-bottom:none;
		font-family:Arial, Helvetica, sans-serif;
		font-size:small;
		border:1px solid #ddd;
		border-collapse:collapse;
	}
	#probe-contents {
		margin-top:20px;
		margin-bottom:20px;
	}
	#probes-tab-title {
		padding-left: 5px;
		font-size: small;
		font-weight: bold;
		color: #B51B13;
	}
	#service-tab-title {
		font-size: small;
		font-weight: bold;
		color: #B51B13;
	}
	#add-probe-table,#serviceform {
		width: 75%;
		margin: 0 auto;
		font-size:11px;
		border: 1px solid #ddd;
		background-color:#fff;
		padding: 2px;
	}
	#add-probe-table td,#serviceform {
		padding-left: 2px;
	}
	.add-probe-name {
		text-align:right;
		width:20%;
	}
	#footer {
		width: 100%;
		height: 27px;
		text-align: center;
		font-size: 11px;
		margin-top: 5px;
		color: #000;
	}
	.errormessage {
		color: #FF0000;
		font-size: 10px;
		padding-left: 3px;
	}
	.probemessage {
		font-size: 10px;
		padding-left: 4px;
	}
	.logged-user {
		float:left;
		margin-left: 5px;
		line-height: 27px;
		font-size: 11px;
		color: #fff;
	}
	.service-tab-title-header {
		border-top: 1px solid #fff;
		border-bottom:1px solid #ddd;
		border-left: 1px solid #fff;
		border-right: 1px solid #fff;
	}
	</style>
</head>
<body onload="getProbes()">
	<div id="container">
		<div id="top-menu">
			<img src="<?php echo base_url();?>/media/images/aalert.png" width="311px" height="120px">
		</div>
		<div id="container-body">
			<div id="setup-menu">
				<ul>
					<li><?php echo anchor("setup/signout","Sign Out",'title="Sign Out"');?></li>
					<li style="border-right: 1px solid #fff;"><?php echo anchor("setup/tools","Tools",'title="Tools"');?></li>
					<li style="border-right: 1px solid #fff;"><?php echo anchor("setup/profiles","Profiles",'title="Profiles"');?></li>
					<li style="border-right: 1px solid #fff;"><?php echo anchor("setup/issues","Issues",'title="Issues"');?></li>
					<li style="border-right: 1px solid #fff;"><?php echo anchor("setup/report","Reports",'title="Reports"');?></li>
					<li style="border-right: 1px solid #fff;"><?php echo anchor("setup/probes","Probes",'title="Probes"');?></li>
					<li class="logged-user">Welcome, Wensan</li>
				</ul>
			</div>		
			<div id="probe-contents">&nbsp;</div>
		</div>
		<div id="footer">Copyright - 2011 Alert A Tech</div>
	</div>
</body>
</html>