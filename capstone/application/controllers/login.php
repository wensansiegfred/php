<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
   }
	public function index(){
		$this->load->helper('url');
		$this->load->view("login_page");
	}

	public function validate(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$keeplogin = $this->input->post("keeplogin");

		$query = $this->db->get_where("users",array("username"=>$username,"password"=>$password));
		$id = "";
		if($query->num_rows > 0){
			foreach ($query->result() as $row){
			    $id = $row->id;
			    $gid = $row->group_id;
			    $sgid = $row->student_group_id;
			}
			if(!empty($id)){
				$this->session->set_userdata("userid", $id);
				$this->session->set_userdata("groupid", $gid);
				$this->session->set_userdata("username", $username);
				$this->session->set_userdata("studentgroupid", $sgid);
			}
			$data["result"] = array("result"=>"success");
		}else{
			$data["result"] = array("result"=>"failure");
		}
		
		echo json_encode($data["result"]);
	}
}