<?php
$spages = array("faq"=>"FAQs","pricing_info"=>"PRICING INFO","free_signup"=>"FREE SIGN UP","paid_signup"=>"PAID SIGN UP","billing"=>"BILING PAGE");
$styles = array("faq"=>"","pricing_info"=>"","free_signup"=>"","paid_signup"=>"","billing"=>"");
$styles[$spage] = "spageSelected";
?>
<style rel="stylesheet">
.subMenu a {
	font-family: "SquareDM",arial;
	font-size: 11pt;
	color: #DFDFDF;
	text-decoration: none;
}
a.spageSelected {
	color: #4EC099;
}
</style>
<div class="subMenu">
	<?if( strIn($spage,'faq,pricing_info') ) {?> <div style="float:right;padding-top:80px"><img src="<?php echo base_url()?>media/images/support_faq.png" /></div><?}?>
	<div style="height:90px;"></div>
	<h1>WE'LL BE HAPPY TO HELP!</h1>
	<div style="display:table-cell">
		<a class="<?php echo $styles['faq'];?>" href="/support/faq">FAQs</a> | 
		<a class="<?php echo $styles['pricing_info'];?>" href="/support/pricing_info">PRICING INFO</a> | 
		<a class="<?php echo $styles['free_signup'];?>" href="/support/free_signup">FREE SIGN UP</a> | 
		<a class="<?php echo $styles['paid_signup'];?>" href="/support/paid_signup">PAID SIGN UP</a> | 
		<a class="<?php echo $styles['billing'];?>" href="/support/billing">BILLING PAGE</a>
	</div>
	<?php echo include("subPages/support_".$spage.".php"); ?>
</div>