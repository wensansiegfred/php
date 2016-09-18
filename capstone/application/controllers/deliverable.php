<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deliverable extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
        $data = array();
        $gid = $this->session->userdata("groupid");
       
        //if student
        if($gid == 1){
            $s = "select * from deliverables where isactive = 1 order by submission_date ASC";
            $query = $this->db->query($s);
            $i = 0;
            foreach($query->result() as $row){
                $sub_date = $row->submission_date;
                $data["result"][$i]["code"] = $row->code;
                $data["result"][$i]["description"] = $row->description;
                $data["result"][$i]["submission_date"] = $sub_date;
                $data["result"][$i]["backcolor"] = (date("Y-m-d") > date($sub_date,strtotime("Y-m-d")) ) ? "red" : "";
                $data["result"][$i]["id"] = $row->id;
                $i++;
            }
            $stu_group_id = $this->session->userdata("studentgroupid");
            $data["result"]["isgroupmember"] = !empty($stu_group_id) ? true : false;
            $this->load->view("student_deliverable_page", $data); 
        }else{
            $s = "select * from deliverables where isactive = 1 order by submission_date ASC";
            $query = $this->db->query($s);
            $i = 0;
            foreach($query->result() as $row){
                $data["result"][$i]["code"] = $row->code;
                $data["result"][$i]["description"] = $row->description;
                $data["result"][$i]["submission_date"] = $row->submission_date;
                $data["result"][$i]["backcolor"] = "";
                $data["result"][$i]["id"] = $row->id;
                $i++;
            }
            $this->load->view("adviser_deliverable_page", $data);
       }
    }

    public function editdeliverableform(){
        $data = array();
        $id = $this->input->post("id");
        $s = "select * from deliverables where isactive = 1 and id = {$id}";
        $query = $this->db->query($s);
        foreach($query->result() as $row){
            $data["result"]["code"] = $row->code;
            $data["result"]["description"] = $row->description;
            $data["result"]["date"] = $row->submission_date;
            $data["result"]["id"] = $row->id;
        }
        $this->load->view("adviser_deliverable_edit_page", $data);
    }

    public function updatedeliverable(){
        $id = $this->input->post("id");
        $code = $this->input->post("code");
        $date = $this->input->post("date");
        $description = $this->input->post("description");

        $sql = "update deliverables set code = '{$code}', submission_date = '{$date}', description = '{$description}' where id = {$id}";
        if($this->db->query($sql)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0, "message"=>"There was an internal server error, please try again later."));
        }
    }

    public function deletedeliverable(){
        $id = $this->input->post("id");
        $sql = "delete from deliverables where id = {$id}";
        if($this->db->query($sql)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }

    public function adddeliverable(){
        $this->load->view("adviser_deliverable_add_page");
    }

    public function createdeliverable(){
        $code = $this->input->post("code");
        $description = $this->input->post("description");
        $submission_date = $this->input->post("submission_date");
        $deliverable = array(
            "code"=>$code,
            "submission_date"=>$submission_date,
            "description"=>$description,
            "date_added"=>date("Y-m-d"),
            "isactive"=>1
        );
        $this->db->trans_start();
        $this->db->insert('deliverables', $deliverable);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        //get student_group
        $s = "select * from student_groups";
        $query = $this->db->query($s);
        $alert = array();
        $i = 0;
        foreach($query->result() as $row){
            $alert[$i] = array(
                "t_id" => $insert_id,
                "fromtable" => "deliverables",
                "student_group" => $row->id,
                "isvalid" => 1
            );
            $i++;
        }
        if($this->db->insert_batch("alerts", $alert)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }

    public function viewdeliverables(){
        $id = $this->input->post("id");
        $description = $this->input->post("description");
        $data = array();
        $sql = "select d.*,s.name from student_deliverable d inner join student_groups s on d.student_group_id = s.id where d.deliverable_id = {$id}";
        $query = $this->db->query($sql);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"]["list"][$i]["filename"] = $row->filename;
            $data["result"]["list"][$i]["raw_name"] = $row->raw_name;
            $data["result"]["list"][$i]["student_group"] = $row->student_group_id;
            $data["result"]["list"][$i]["student_deliverable_id"] = $row->id;
            $data["result"]["list"][$i]["student_group_name"] = $row->name;
            $data["result"]["list"][$i]["approved"] = $row->approved;
            $data["result"]["list"][$i]["note"] = $row->note;
            $data["result"]["list"][$i]["date_added"] = $row->date_added;
            $data["result"]["list"][$i]["id"] = $row->id;
            $i++;
        }
        $data["result"]["id"] = $id;
        $data["result"]["description"] = $description;
        $this->load->view("adviser_deliverable_view_page", $data);
    }

    public function viewdeliverablenotes(){
        $id = $this->input->get("id");
        $sql = "select note from student_deliverable where id = {$id}";
        $query = $this->db->query($sql);
        $data = array();
        foreach($query->result() as $row){
            $data["result"]["notes"] = $row->note;
        }
        $this->load->view("deliverable_notes", $data);
    }

    public function approvedeliverable(){
        $id = $this->input->post("id");
        $u_group = $this->session->userdata("groupid");
        if($u_group == 3){
            $sql = "update student_deliverable set approved=2 where id={$id}";
        }else{
            $sql = "update student_deliverable set approved=1 where id={$id}";
        }
        if($this->db->query($sql)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }

    public function paeditdeliverable(){
        $id = $this->input->get("id");
        $sql = "select * from student_deliverable where id = {$id}";
        $query = $this->db->query($sql);
        $data = array();
        foreach($query->result() as $row){
            $data["result"]["notes"] = $row->note;
        }
        $data["result"]["id"] = $id;
        $this->load->view("edit_show_deliverable", $data); 
    }
}