<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Alert A Tech</title>
    <link rel="stylesheet" href="<?php echo base_url()?>media/css/style.css" />
   <link rel="stylesheet" href="<?php echo base_url()?>media/css/jquery.alerts.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>media/jquery/themes/base/jquery.ui.all.css" />
    <script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/js/jquery-1.5.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/js/jquery.bgiframe-2.1.2.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.core.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.widget.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.datepicker.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.mouse.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.button.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.draggable.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.position.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.resizable.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.dialog.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.tabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.ui.accordion.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/js/jquery.alerts.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/jquery/ui/jquery.effects.core.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url()?>media/js/groups.js"></script>
<script type="text/javascript">
	/* getting list of */

	function getGroups()
	{
		var data = "<?php echo base_url();?>groups/showgroups";
		var loader = "<img src='<?php echo base_url();?>media/images/ajax-loader.gif'/>";
		$('#grouplist').html(loader);
		$.ajax({
			url: data,  
			type: "POST", 
			cache: false,
			success: function (html) {
				$('#grouplist').html(html);
				$('#grouplist').fadeIn('slow');       
			},
			error: function (html) {
				$('#grouplist').html(html);
				$('#grouplist').fadeIn('slow');
			}       
		});	
	}
	
	// end of groups	
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>media/css/groups.css" />
</head>
<body onload="getGroups()">
	<div id="container">
		<div id="top-menu">
			<img src="<?php echo base_url();?>/media/images/aalert.png" width="311px" height="120px">
		</div>
		<div id="container-body">
			<div id="setup-menu">
				<ul>
					<li><?php echo anchor("setup/signout","Sign Out",'title="Sign Out"');?></li>					
					<li class="logged-user">Welcome, <?php echo $userinfo['name'];?></li>
				</ul>
			</div>		
			<div id="group-div">
				<div id="tabs">
					<ul>
						<li><a href="#grouplist-tab">Groups</a></li>
						<li><a href="#graphs-tab" id="graphs-loader">Graphs</a></li>						
					</ul>
					<div id="grouplist-tab">
						<div id="grouplist">&nbsp;</div>
					</div>
					<div id="graphs-tab">
						<div id="graphs-content">Soon to come.</div>
					</div>						
				</div>
			</div>
		</div>
		<div id="footer">Copyright - 2011 Alert A Tech</div>
	</div>
</body>
</html>