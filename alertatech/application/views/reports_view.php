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
	function getReports()
	{
		var data = "<?php echo base_url()?>reports/getreports";
				$.ajax({
				url: data,  
				type: "POST", 
				cache: false,
				success: function (html) {
					$('#report-contents').html(html);
					$('#report-contents').fadeIn('slow');       
				}       
			});	
	}
	
	function showGraph(hostid)
	{
		var data = "<?php echo base_url()?>reports/getHistory/"+hostid;
	}
</script>
<style type="text/css">
	body {
		border:0;
		font-family: Georgia, "Times New Roman", Times, serif;
	}
	#container {
		width: 1000px;
		margin-top:10px;
		margin-left: auto;
  		margin-right: auto;
		border: 1px solid #ddd;
	}
	#top-menu,#setup-menu,#report-contents {
		float:left;
	}
	* {
		margin: 0;
		padding: 0;
	}
	ul {
		list-style-type: none;
		background-image: url('<?php echo base_url()?>media/images/background.gif');
		height: 27px;
		width: 1000px;
		margin: auto;
		padding: 0;
	}
	li {
		float: left;
	}
	ul li {
		display: inline;
	}
	ul a {
		background-image: url('<?php echo base_url()?>media/images/border.gif');
		background-repeat: no-repeat;
		background-position: right;
		padding-right: 32px;
		padding-left: 32px;
		display: block;
		line-height: 27px;
		text-decoration: none;		
		font-size: 11px;
		color: #371C1C;
	}
	ul a:hover {
		color: #FFF;
	}
	#add-probe-btn {
		float:right;
		font-size: 11px;
	}
	#probelist {
		width:900px; 
		border:1px solid #ccc; 
		border-bottom:none;
		font-family:Arial, Helvetica, sans-serif;
		font-size:small;
		border:1px solid #ddd;
		border-collapse:collapse;
	}
	#probelist th {
		background:#0060A9 6px center no-repeat; 
		cursor:pointer;
		height: 27px;
		color:#ffffff;
		text-align:left;
	}
	#probelist td {
		border-bottom: 1px solid #ddd;
		border-right:1px solid #ddd;
	}
	.add-probe-btn {
		height:28px;
		border: 1px solid #fff;
		background:#277DB0;
		font-size: 1em;
		font-weight:bold;
		cursor:pointer;
		color:#fff;
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
	#report-contents {
		margin-top:20px;
	}	
</style>
</head>
<body onload="getReports()">
	<div id="container">
		<div id="top-menu">
			<img src="<?php echo base_url();?>/media/images/aalert.png" width="311px" height="120px">
		</div>
		<div id="setup-menu">
			<ul>
				<li><?php echo anchor("setup/probes","Probes",'title="Probes"');?></li>
				<li><?php echo anchor("setup/report","Reports",'title="Reports"');?></li>
				<li><?php echo anchor("setup/issues","Issues",'title="Issues"');?></li>
				<li><?php echo anchor("setup/profiles","Profiles",'title="Profiles"');?></li>
				<li><?php echo anchor("setup/tools","Tools",'title="Tools"');?></li>
				<li><?php echo anchor("setup/signout","Sign Out",'title="Sign Out"');?></li>
			</ul>
		</div>		
		<div id="report-contents">&nbsp;</div>	
	</div>
</body>
</html>