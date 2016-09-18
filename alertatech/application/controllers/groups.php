<?php
class Groups extends CI_Controller
{
	private $userid;
	private $messsage = "";
	private $groupname;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->library("groupslib");
		$this->load->library("session");
		$this->load->library("probeslib");
	}
	
	public function showgroups()
	{
		$this->userid = $this->getUserId();
		if( $this->userid >= 0 )
		{
			$data = array();
			//get list of groups for this user
			$data['groups'] = $this->groupslib->getgrouplist($this->userid);
			//probes count per group
			$data["probescount"] = 	$this->groupslib->getprobecounts($this->userid);		
			//log user id
			$data['userid'] = $this->userid;
			//loads view
			$this->load->view("grouplist",$data);
			
		}
		else
			redirect("/");
	}
	
	public function creategroup()
	{
		$this->groupname = $this->input->post("groupname");
		$this->userid = $this->input->post("userid");
		
		$created = $this->groupslib->creategroup($this->groupname,$this->userid);
		if($created) 
			$this->message = "SUCCESS";
		else 
			$this->message = "FAILURE";
		echo json_encode($this->message);
	}
	
	public function showgraphfilter()
	{
		$this->userid = $this->getUserId();
		$data = array();
		
		if( $this->userid >= 0 )
		{
			//get list of groups for this user
			$data['groups'] = $this->groupslib->getgrouplist($this->userid);
			//get probes per group
			if(!empty($data['groups']))
			{
				$probelist = array();
				
				foreach($data['groups'] as $key=>$val)
				{
					$probelist[$val['groupid']] = $this->probeslib->getProbeIdByGroup($val['groupid']);
				}
				
				$data['probes'] = $probelist;
			}
			//probes count per group
			$data["probescount"] = 	$this->groupslib->getprobecounts($this->userid);		
			//log user id
			$data['userid'] = $this->userid;			
		}
		else {
		
			echo "session error";
		}
		//loads view
		$this->load->view("graphs",$data);
	}
	
	private function getUserId()
	{	
		return $this->session->userdata("userid");
	}
}
?>