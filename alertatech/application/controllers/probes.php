<?php
/*
/
/Probes Controller probes.php
/Create Probes/Host on the database
/
/*/
define('ADD_PROBE_SUCCESS','Successfully addded Probe.');
define('ADD_PROBE_FAILURE','Failed to add Probe. Please check your parameters.');
define('PROBE_ALREADY_EXIST','Probe name already exist, please choose another probe name.');
define('CREATE_PROBE_GENERAL_ERROR','There was an error adding your probe, please try again and check your parameters.');
define('ADD_SERVICE_SUCCESS','Successfully added Service.');
define('ADD_SERVICE_FAILURE','Failed to add Service. Please check your parameters.');
define('ADD_SERVICE_GENERAL_ERROR','There was an error adding your service, please try again and check your parameters.');
define('ADD_SERVICE_ALREADY_EXIST','Service already exist for this host, please select another one.');

class Probes extends CI_Controller
{
	private $data;
	private $groupid;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AZabbix');
		$this->load->library('probeslib');
		$this->load->helper('url');
		$this->load->database();
	}
	//creates Probe in Zabbix
	public function create()
	{
		$probeExist = $this->isProbeExist(urldecode($this->input->get("probename")));
		//$url = str_replace("\\","/",urldecode($url));
		//$url = urldecode($url);
		//check database if probe name already exist, will throw an error if it does
		$probename = urldecode($this->input->get("probename"));
		$ip = $this->input->get("ipadd");
		$dns = urldecode($this->input->get("url"));
		$port = $this->input->get("port");
		$probetype = $this->input->get("probetype");
		$groupid = $this->input->get("groupid");
		
		if($probeExist) 
			echo PROBE_ALREADY_EXIST;
		else 
		{	
			$datadb = array(
				"probename"=>$probename,
				"ip"=>$ip,
				"dns"=>$dns,			
				"port"=>$port,
				"probetype"=>$probetype
			);
			
			//upload to zabbix
			$result = $this->azabbix->addHost($probename,$ip,$port,$probetype);
			
			if(!empty($result))
			{
				
				$datadb['hostids'] = $result;
				$insertToProbes = $this->db->insert('probe',$datadb);
				if($insertToProbes)
				{ 
					$id = $this->db->insert_id();
					$dataGroupProbe = array(
						'groupid'=>$groupid,
						'probeid'=>$id
					);
					$insertToGroupProbes = $this->db->insert('group_probe',$dataGroupProbe);
					if($insertToGroupProbes)
						echo ADD_PROBE_SUCCESS;
					else 
						echo ADD_PROBE_FAILURE;
				}
				else 
					echo ADD_PROBE_FAILURE;
				
			}
			else
			{
				echo CREATE_PROBE_GENERAL_ERROR;
			}
		}
	}
	//check if Probe already exist in Table
	public function isProbeExist($probename)
	{	
		//query database server if this host/probe already exist
		$counts = $this->db->where('probename',$probename)->from('probe')->count_all_results();
		return ($counts > 0)?true:false;
	}
	
	//Add probes form
	public function addprobe()
	{
		$groupid = $this->input->get("groupid");
		$data = array();
		$data['servertype'] = $this->probeslib->getServerType();
		$data['groupid'] = $groupid;
		$this->load->view('forms/addprobes_form',$data);
	}
	
	public function showprobes($groupid)
	{		
		$this->groupid = $groupid;
		$this->data['groupid'] = $this->groupid;
		$this->data['probes'] = $this->probeslib->getProbesByGroup($this->groupid);
	
		$this->load->view('probelist',$this->data);
	}
	
	public function loadserviceform($probeid,$hostid,$hostname)
	{

		$this->db->select('*')->from('itemlistselection')->where('name !=','');
		$queryserviceitem = $this->db->get();
		$i = 0;
		$data = array();
		foreach ($queryserviceitem->result() as $rows)
		{
			$data['serviceitemlist'][$i]['itemid'] = $rows->itemlistselectionid;
			$data['serviceitemlist'][$i]['name'] = $rows->name;
			$i++;
		}
		$data['id'] = $probeid;
		$data['hostid'] = $hostid;
		$data['hostname'] = urldecode($hostname);
		$this->load->view('serviceform',$data);
	}
	
	public function addservice($probeid,$hostid,$itemselid,$interval,$description,$history,$trends)
	{
		$itemlistkey = "";
		$result = "";
		$itemtype = "";
		$insert = false;
		//get key value from alert a tech db	
		$this->db->select('*')->from('itemlistselection')->where('itemlistselectionid',$itemselid);
		$itemObject = $this->db->get();
		foreach($itemObject->result() as $key)
		{
			$itemlistkey = $key->key_;
			$itemtype = $key->itemtype;
		}
		//check if this service is already added, will throw an error if it does
		$keyexist = $this->checkService($hostid,$itemlistkey);
		
		//if service doesnt exist for this host
		if(!$keyexist)
		{
			//upload to zabbix
			if(!empty($itemlistkey))
				$result = $this->azabbix->addItem($hostid,$itemlistkey,$interval,urldecode($description),$itemtype,$history,$trends);
			
			if(!empty($result))
			{
				$insertToServices = array(
						'itemid'=>$result,
						'probeid'=>$probeid,
						'servicename'=>urldecode($description),						
						'status'=>1
				);
				$insert = $this->db->insert('services',$insertToServices);				
				
				if($insert) 
					echo ADD_SERVICE_SUCCESS;
				else 
					echo ADD_SERVICE_FAILURE;
			}
			else echo ADD_SERVICE_GENERAL_ERROR;
		}
		else 
		{
			echo ADD_SERVICE_ALREADY_EXIST;
		}
	}

	public function getGraph()
	{
		$hostid = '10069';
		$itemid = '22175';
		$result = $this->azabbix->getGraphById('387');
		echo "<pre>";
		print_r($result);
	}
	
	public function getHistroy()
	{
		echo strtotime(date("Y-m-d h:i:s"));
	}
	
	public function checkService($hostid,$key)
	{
		return $this->azabbix->isServiceExists($hostid,$key);
	}
	
	public function addTrigger()
	{
	//to do next	
	}
	
	//list down all all services added for a Host/Probe
	public function service($hostid)
	{
		$data = array();
		$res = $this->db->where('probeid',$hostid)->from('services')->get();
		$i = 0;
		foreach($res->result() as $row)
		{
			$data['service'][$i]['servicename'] = $row->servicename;
			$data['service'][$i]['servictype'] = $row->servicetype;
			$data['service'][$i]['itemid'] = $row->itemid;
			$data['service'][$i]['probeid'] = $row->probeid;
			$data['service'][$i]['status'] = $row->status;
			$i++;
		}
		
		$this->load->view('service',$data);
	}
}
?>
