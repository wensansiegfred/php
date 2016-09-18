<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller{
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
    	$data = array();
    	$gid = $this->session->userdata("groupid");
    	$data["result"]["groupid"] = $gid;
    	$this->load->view("user_profile_page", $data);
    }

    public function add(){
        $firstname = $this->input->post("fname");
        $lastname = $this->input->post("lname");
        $password = $this->input->post("password");
        $course = $this->input->post("course");
        $bday = $this->input->post("b_year") . "-" . $this->input->post("b_month") . "-" . $this->input->post("b_day");
        $address = $this->input->post("address");
        $phone = $this->input->post("phone");
        $username = $this->session->userdata("username");
        $id = $this->session->userdata("userid");

        $account = array(
            'first_name' => $firstname,
            'last_name' => $lastname,
            'address' => $address,
            'course' => $course,
            'birth_day' => $bday,
            'phone' => $phone,
            'email' => $username,
            'date_added' => date("Y-m-d H:i:s"),
            'is_active' => 1
        );

        $this->db->trans_start();
        $this->db->insert('accounts', $account);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();

        $sql = "update users set account_id = {$insert_id},password= '{$password}' where id= {$id}";
        if($this->db->query($sql)){
            echo json_encode(array("success" => 1));
        }else{
            echo json_encode(array("success" => 0));
        }
    }
}