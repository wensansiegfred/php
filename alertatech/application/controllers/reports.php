<?php
/**
 * 
 * Controller for Reports report.php
 * all about the reporting
 * 
 */
class reports extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AZabbix');
		$this->load->helper('url');
		$this->load->database();
	}
	
	public function getreports()
	{
		$queryhost = $this->db->get("probe");
		$data = array();
		$i = 0;
		foreach($queryhost->result() as $rows)
		{
			$probeid = $rows->probeid;
			
			$data['probes'][$i]['probeid'] = $probeid;			
			$data['probes'][$i]['probename'] = $rows->probename;
			$data['probes'][$i]['dns'] = $rows->dns;			
			$data['probes'][$i]['hostid'] = $rows->hostids;
			$data['probes'][$i]['status'] = $rows->status;
			$i++;
		}
	
		$this->load->view('reportslist',$data);
	}
	
	public function getHistory($hostid)
	{
		$result = $this->azabbix->getHistory($hostid);
		$items = array();
		if(!empty($result))
		{
			$this->load->model('Itemgraph');
			$items = $this->Itemgraph->getItem($result);
		}
		return $items;
	}
	
	public function showChart()
	{
		//$data['items'] = $items;
		//$this->load->view('chart',$data);
		$data['items'] = array('item1'=>array(1,2,3,4,5,6),'item2'=>array(2,3,4,5,6,7),'item3'=>array(3,4,5,6,7,8));
		//$data['items'] = $items;
		$this->load->view('chart_view',$data);
	}
}
?>