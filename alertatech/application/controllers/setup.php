<?php
/*
/
/	Setup Controller setup.php
/
*/
class Setup extends CI_Controller
{
	private $userid;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->library("session");
		$this->load->library("userlib");
	}
	public function index()
	{
		//loads the default method/page
		//$this->probes();//old re route controller,change by wensan to route to groups 2011-09-26
		$this->groups();
	}
	
	public function groups()
	{		
		$userid = $this->session->userdata("userid");
		if(!empty($userid))
		{
			$data["userinfo"] = $this->userlib->getUserInfo($userid);
			$data["session"] = $this->session->all_userdata();
			$this->load->view("groups_view",$data);
		}
		else
		redirect("home");		
	}
	
	public function probes()
	{
		/*$data = array();
		$i = 0;
		//get host group
		$queryhost = $this->db->get("hostgroup");
		
		foreach($queryhost->result() as $rows)
		{
			$data['hosts'][$rows->hostgroupid] = $rows->name;
		}
		$this->load->view("probes_view",$data);*/
	}
	
	public function report()
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
		$this->load->view("reports_view",$data);
	}
	
	public function issues()
	{
		$this->load->view("issues_view");
	}
	
	public function profiles()
	{
		$this->load->view("profiles_view");
	}
	
	public function tools()
	{
		$this->load->view("tools_view");
	}
	
	public function signout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}
}
?>