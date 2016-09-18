<?php 
/**
 * Chart controller
 * chart.php
 * 
 * 
 */
include("application/third_party/graph/class/pData.class.php"); 
include("application/third_party/graph/class/pDraw.class.php"); 
include("application/third_party/graph/class/pImage.class.php");

class Chart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AZabbix');
		$this->load->library('probeslib');
		$this->load->helper("url");
	}
	
	public function getLineGraph($itemid, $probename, $from = '', $to = '', $random)
	{
		#convert time format to unix timestamp
		$fromdate = !empty($from)?strtotime($from." 00:00:01"):strtotime(date("Y-m-d 00:00:01"));
		$todate = !empty($to)?strtotime($to." 23:59:59"):strtotime(date("Y-m-d 23:59:59"));
		$_uptime = $this->azabbix->getHistoryUp(array($itemid), $fromdate, $todate);
		
		$uptime = $this->groupItem($_uptime);
		
		$this->showLineGraph($probename, $uptime);
	}
	
	public function groupItem($uptime)
	{
		$res = array();
		
		if(!empty($uptime))
		{
			foreach($uptime as $key=>$val)
			{
				$res[$val['itemid']][date("H",$val['clock'])] = $val['value'];
			}
		}
		
		return $res;
	}	
	
	public function showLineGraph($name, $data = array())
	{
		/* Create and populate the pData object */ 
	
	 $_x = array();
	 $_y = array();
	 $name = urldecode($name);
	 foreach($data as $k=>$v)
	 {
		foreach($v as $key=>$val)
		{
			$_y[] = $val;
			$_x[] = $key;
		}
	 }	
	 $MyData = new pData();   
	 $MyData->addPoints($_y,"Probe 1"); 
	 #$MyData->addPoints(array(3,12,15,8,5,-5),"Probe 2"); 
	 #$MyData->addPoints(array(2,7,5,18,19,22),"Probe 3"); 
	 #$MyData->setSerieTicks("Probe 2",4); 
	 #$MyData->setSerieWeight("Probe 3",2); 
	 $MyData->setAxisName(0,"Value"); 
	 $MyData->addPoints($_x,"Labels"); 
	 $MyData->setSerieDescription("Labels","Time"); 
	 $MyData->setAbscissa("Labels"); 


	 /* Create the pChart object */ 
	 $myPicture = new pImage(900,230,$MyData); 

	 /* Turn of Antialiasing */ 
	 $myPicture->Antialias = FALSE; 

	 /* Add a border to the picture */ 
	 $myPicture->drawRectangle(0,0,890,229,array("R"=>0,"G"=>0,"B"=>0)); 
	  
	 /* Write the chart title */  
	 $myPicture->setFontProperties(array("FontName"=>"media/graph/fonts/Forgotte.ttf","FontSize"=>11)); 
	 $myPicture->drawText(150,35,$name,array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE)); 

	 /* Set the default font */ 
	 $myPicture->setFontProperties(array("FontName"=>"media/graph/fonts/pf_arma_five.ttf","FontSize"=>6)); 

	 /* Define the chart area */ 
	 $myPicture->setGraphArea(60,40,850,200); 

	 /* Draw the scale */ 
	 $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE); 
	 $myPicture->drawScale($scaleSettings); 

	 /* Turn on Antialiasing */ 
	 $myPicture->Antialias = TRUE; 

	 /* Draw the line chart */ 
	 $myPicture->drawLineChart(); 

	 /* Write the chart legend */ 
	 #$myPicture->drawLegend(540,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL)); 

	 /* Render the picture (choose the best way) */ 
	 $myPicture->autoOutput("media/graph/pictures/example.drawLineChart.simple.png");
	}
}
?>