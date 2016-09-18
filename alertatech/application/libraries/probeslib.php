<?php
class probeslib
{
	private $data = array();
	private $ci_lib;//this will store an instance of classes from code igniter library
	
	public function __construct()
	{
		$this->ci_lib =& get_instance();//create an instance of code igniter library,for further question/idea about this.refer to user_guide
	}
	
	public function getProbesByGroup($groupid)
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		$sql = "select p.* from probe p inner join group_probe g on p.probeid=g.probeid where g.groupid=".$groupid;
		
		$queryhost = $this->ci_lib->db->query($sql);
		$i = 0;
		foreach($queryhost->result() as $rows)
		{
			$probeid = $rows->probeid;
			
			$this->data[$i]['probeid'] = $probeid;
			$this->data[$i]['numitems'] = $this->ci_lib->db->where('probeid',$probeid)->from('services')->count_all_results();
			$this->data[$i]['probename'] = $rows->probename;
			$this->data[$i]['dns'] = $rows->dns;
			$this->data[$i]['ip'] = $rows->ip;
			$this->data[$i]['port'] = $rows->port;
			$this->data[$i]['hostid'] = $rows->hostids;
			$this->data[$i]['datecreated'] = $rows->datecreated;
			$i++;
		}	
		return $this->data;
	}
	
	public function getServerType()
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		//get host group
		$queryservertype = $this->ci_lib->db->get("server_type");
		
		foreach($queryservertype->result() as $rows)
		{
			$this->data[$rows->server_typeid] = $rows->server_type_name;
		}
		return $this->data;
	}
	
	public function getProbeIdByGroup($groupid)
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		$sql = "select p.* from probe p 
				inner join group_probe g 
				on p.probeid=g.probeid where g.groupid=".$groupid;
		
		$queryhost = $this->ci_lib->db->query($sql);
		$i = 0;
		foreach($queryhost->result() as $rows)
		{
			$probeid = $rows->probeid;
			
			$this->data[$i]['probeid'] = $probeid;
			$this->data[$i]['probename'] = $rows->probename;
			$i++;
		}	
		return $this->data;
	}
	
	public function getItemsByProbe($hostid)
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		
		$sql = "select itemid from services where probeid=".$hostid;
		$queryitems = $this->ci_lib->db->query($sql);
		$i = 0;
		foreach($queryitems->result() as $rows)
		{
			$this->data[$i] = $rows->itemid;
			$i++;
		}
		return $this->data;
	}
}
?>