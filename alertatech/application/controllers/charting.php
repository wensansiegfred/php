<?php
class Charting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AZabbix');
		$this->load->library('probeslib');
		$this->load->helper("url");
	}
	
	public function getHistory($probeid, $probename, $from = '', $to = '')
	{
		$data = array();
		$items = array();
		
		if(!empty($probeid))
		{
			$items = $this->probeslib->getItemsByProbe($probeid);
		}
		$data['items'] = $items;
		$data['probename'] = $probename;
		$data['from'] = $from;
		$data['to'] = $to;
		
		$this->load->view('viewgraph',$data);
	}
	
	public function showHistory($probeid, $probename, $from = '', $to = '')
	{
		$data = array();
		$items = array();
		if(!empty($probeid))
		{
			$items = $this->probeslib->getItemsByProbe($probeid);
			
			if(!empty($items))
			{
				#convert time format to unix timestamp
				$fromdate = !empty($from)?strtotime($from." 00:00:01"):strtotime(date("Y-m-d 00:00:01"));
				$todate = !empty($to)?strtotime($to." 23:59:59"):strtotime(date("Y-m-d 23:59:59"));
				$uptime = $this->azabbix->getHistoryUp($items, $fromdate, $todate);
				$data['uptime'] = $this->groupItem($uptime);
				#$data['downtime'] = $this->azabbix->getHistoryDown($hostid, $fromdate, $todate);
				$date['probename'] = $probename;
			}
		}
		#$this->showHistory1();
		$this->load->view('viewgraph', $data);
	}
	public function groupItem($uptime)
	{
		$res = array();
		
		if(!empty($uptime))
		{
			foreach($uptime as $key=>$val)
			{
				$res[$val['itemid']][date("H:i:s",$val['clock'])] = $val['value'];
			}
		}
		
		return $res;
	}	
}