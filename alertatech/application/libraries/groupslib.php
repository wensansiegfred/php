<?php 
class groupslib
{
	private $data = array();
	private $ci_lib;//this will store an instance of classes from code igniter library
	
	public function __construct()
	{
		$this->ci_lib =& get_instance();//create an instance of code igniter library,for further question/idea about this.refer to user_guide
	}
	
	public function getgrouplist($user_id=0)
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		$i = 0;
		//get group for this user
		$sql = "select g.groupid,g.groupname,g.datecreated 
				from groups g inner join group_user u on g.groupid=u.groupid
				where u.user_id = ".$user_id;
		try{
			$groupsQuery = $this->ci_lib->db->query($sql);
		}
		catch(Exception $r)
		{
			echo $r->getMessage();
		}
		if($groupsQuery->num_rows > 0)
		{
			foreach($groupsQuery->result_array() as $rows)
			{
				$this->data[$i]['groupid'] = $rows['groupid'];
				$this->data[$i]['groupname'] = $rows['groupname'];
				$this->data[$i]['datecreated'] = $rows['datecreated'];
				$i++;
			}
		}
		return $this->data;
	}
	
	public function creategroup($name,$userid)
	{
		$this->ci_lib->load->database();//initialize code igniter db library
		$valid = false;
		if(!empty($name))
		{
			//this will insert groupname to groups table
			$sql = "insert into groups (groupname,datecreated) values ('".$name."',now())";
			$this->ci_lib->db->query($sql);
			//get the last insert id and insert it to group_user table
			$id = $this->ci_lib->db->insert_id();
			$sql1 = "insert into group_user(groupid,user_id) values(".$id.",".$userid.")";
			$valid = $this->ci_lib->db->query($sql1); 
		}
		return $valid;
	}
	
	public function getprobecounts($userid)
	{
		$data = array();
		$this->ci_lib->load->database();//initialize code igniter db library
		$sql = "select g.groupid,count(*) as cnts from group_probe g
				inner join group_user u on g.groupid=u.groupid
				where u.user_id =".$userid;
		$numProbes = $this->ci_lib->db->query($sql);
		
		if(!empty($numProbes))
		{
			foreach($numProbes->result_array() as $rows)
			{
				$data[$rows['groupid']] = $rows['cnts'];
			}
		}
		return $data;
	}
}
?>