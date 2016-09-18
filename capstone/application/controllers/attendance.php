<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attendance extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
    	$data = array();
    	$sql = "SELECT u.*,a.first_name,a.course,a.last_name FROM users u inner join accounts a on u.account_id=a.id WHERE group_id =1";
    	$query = $this->db->query($sql);
    	$i = 0;
    	foreach($query->result() as $row){
    		$data["result"]["list"][$i]["name"] = $row->first_name . " " . $row->last_name;
    		$data["result"]["list"][$i]["course"] = $row->course;
    		$data["result"]["list"][$i]["id"] = $row->id;
    		$i++;
    	}
    	
    	$this->load->view("student_attendace_page", $data);
    }

    public function viewreport(){
        $data = array();
        $sql = "SELECT u.id,a.first_name,a.course,a.last_name,count(*) as cnts 
                FROM users u 
                inner join accounts a on u.account_id=a.id
                inner join attendance at on at.student_id=u.id
                WHERE group_id =1
                group by 1";
        $i = 0;
        $query = $this->db->query($sql);
        foreach($query->result() as $row){
            $data["result"]["list"][$i]["name"] = $row->first_name . " " . $row->last_name;
            $data["result"]["list"][$i]["course"] = $row->course;
            $data["result"]["list"][$i]["id"] = $row->id;
            $data["result"]["list"][$i]["cnts"] = $row->cnts;
            $i++;
        }

        $this->load->view("student_attendace_report", $data);
    }

    public function studentlogin(){
    	$id = $this->input->post("id");
    	$sql = "insert into attendance(student_id,time_in) values({$id},now())";
    	if($this->db->query($sql)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }
    public function studentlogout(){
    	$id = $this->input->post("id");
    	$sql = "update attendance set time_out = now() where id = {$id}";
    	if($this->db->query($sql)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }
}