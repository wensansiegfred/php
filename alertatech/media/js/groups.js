$(document).ready(function(){
	$("#tabs").tabs();
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$('#graphs-loader').click(function(){
		var data = "groups/showgraphfilter";
		var loader = "<img src='<?php echo base_url();?>media/images/ajax-loader.gif'/>";
		$('#graphs-content').html(loader);
		$.ajax({
			url: data,  
			type: "POST", 
			cache: false,
			success: function (html) {
				$('#graphs-content').html(html);
				$('#graphs-content').fadeIn('slow');       
			},
			error: function (html) {
				$('#graphs-content').html(html);
				$('#graphs-content').fadeIn('slow');
			}       
		});	
	});
});