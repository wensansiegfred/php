<?php 
class userlib
{
	private $ci_lib;//this will store an instance of classes from code igniter library
	private $error;
	
	public function __construct()
	{
		$this->ci_lib =& get_instance();//create an instance of code igniter library,for further question/idea about this.refer to user_guide
		$this->ci_lib->load->database();//initialize code igniter db library
	}
	
	public function createuser($userdetails = array())
	{		
		$isSuccess = false;
		if(isset($userdetails['email']))		
		{			
			//check if this email has already registered
			$emailExist = $this->check_email($userdetails['email']);
			
			if($emailExist) return false;
			
			$activationcode = rand(1,9999999);
			$activation_expire_date = ($userdetails['free'])?date("Y-m-d h:i:s"):'';
			$activated = "N";
			$registerdate = date("Y-m-d h:i:s");
			$ipadd = $_SERVER['REMOTE_ADDR'];
			$password = sha1($userdetails['password']);
			//insert first user input form to user table,get the user_id and plug it in userdetails table
			$sql = "insert into user(email_address,password,activation_code,activation_expire_date,register_date,ip_address,alert_email,isfree)
					values('".$userdetails['email']."','".$password."',".$activationcode.",
					'".$activation_expire_date."','".$registerdate."','".$ipadd."','".$userdetails['alertemail']."',".$userdetails['free'].")";
			$useradd = $this->ci_lib->db->query($sql);
			//if successfully added,insert info to userdetails table
			if($useradd)
			{
				$userid = $this->ci_lib->db->insert_id();//last id inserted
				$sql = "insert into userdetails(user_id,name,company,address,city,state,postalcode,country,timezone)
						values(".$userid.",'".$userdetails['name']."','".$userdetails['company']."','".$userdetails['address']."'
						,'".$userdetails['city']."','".$userdetails['state']."','".$userdetails['postalcode']."','".$userdetails['country']."'
						,'".$userdetails['timezone']."')";
				$userdetailinsert = $this->ci_lib->db->query($sql);
				$isSuccess = $userdetailinsert;
			}
			else {
				$this->error = "DATABASE ERROR: unable to process user.";
			}
		}
		return $isSuccess;
	}
	
	public function validateuser($user = array())
	{		
		$userresult = array(); 
		if(!empty($user))
		{
			$this->ci_lib->db->select('user_id');
			$this->ci_lib->db->where($user);
			$this->ci_lib->db->from("user");
			$userquery = $this->ci_lib->db->get();
			if(!empty($userquery))
			{
				foreach($userquery->result_array() as $rows)
				{
					$userresult['userid'] = $rows['user_id'];
				}
			}
		}
		return $userresult;
	}
	
	public function getUserInfo($userid)
	{
		$result = array();
		if(isset($userid))
		{
			$this->ci_lib->db->select("*");
			$this->ci_lib->db->where("user_id",$userid);
			$this->ci_lib->db->from("userdetails");
			$qResult = $this->ci_lib->db->get();
			foreach($qResult->result_array() as $rows)
			{
				$result["userid"] = $rows["user_id"];
				$result["name"] = $rows["name"];				
			}
		}
		return $result;
	}
	
	public function check_email($email) {
		
		$doesExist = true;
		if(isset($email)) {
			
			$this->ci_lib->db->select('*');
			$this->ci_lib->db->where("email_address",$email);
			$this->ci_lib->db->from("user");
			$res = $this->ci_lib->db->count_all_results();
			
			if($res > 0 ) {
				$this->error = "This email address is already registered.";
			}
			else {
				$doesExist = false;
			}
		}
		
		return $doesExist;		
	}
	
	public function _get_error() {
		
		return (!empty($this->error)) ? $this->error : '';
	}
}
?>