<?php
class Account extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
    	$data = array();
    	$id = $this->session->userdata("userid");
    	$st = "select u.group_id,a.first_name,a.last_name from users u inner join accounts a on u.account_id = a.id where u.id = {$id}";
    	$query_user = $this->db->query($st);
    	$group_id = "";
		foreach($query_user->result() as $row){
		    $group_id = $row->group_id;
		}       
		//if administrator, load advisers,panelist & subject adviser ONLY
		if($group_id == 5){
			$st1 = "select u.username,g.name, u.id from users u left join groups g on u.group_id = g.id where u.group_id in(2,3,4) and u.isactive=1";
			$query_advisers = $this->db->query($st1);
			$i = 0;
			foreach($query_advisers->result() as $row){
		    	$data["result"][$i]["username"] = $row->username;
		    	$data["result"][$i]["group_name"] = $row->name;
                $data["result"][$i]["id"] = $row->id;
		    	$i++;
			}
			
			$this->load->view("admin_account_page",$data);
		}else if($group_id == 2 || $group_id == 3){//if project adviser & subject adviser

            $data = array();
            $st = "select * from student_groups";
            $query = $this->db->query($st);
            $i = 0;
            foreach($query->result() as $row){
                $data["result"]["groups"][$i]["name"] = $row->name;
                $data["result"]["groups"][$i]["id"] = $row->id;
                $s = "select * from users where student_group_id = '{$row->id}' and isactive = 1";
                $q = $this->db->query($s);
                $x = 0;
                foreach($q->result() as $r){
                   $data["result"]["groups"][$i]["students"][$x]["name"] = $r->tmpname;
                   $data["result"]["groups"][$i]["students"][$x]["id"] = $r->id;
                   $x++; 
                }
                $i++;
            }

            $this->load->view("adviser_account_page", $data);            
        }
	}

    public function editstudentaccountform(){
        $id = $this->input->post("id");
        $data =array();
        if(!empty($id)){
            $sql = "select * from users where id = {$id}";
            $query = $this->db->query($sql);
            if($query){
                foreach($query->result() as $row){
                    $data["result"]["username"] = $row->username;
                    $data["result"]["password"] = $row->password;
                    $data["result"]["id"] = $row->id;
                    $data["result"]["tmpname"] = $row->tmpname;
                    $data["result"]["s_group"] = $row->student_group_id;
                    $s = "select * from student_groups";
                    $q = $this->db->query($s);
                    $x = 0;
                    foreach($q->result() as $r){
                       $data["result"]["groups"][$x]["name"] = $r->name;
                       $data["result"]["groups"][$x]["id"] = $r->id;
                       $x++; 
                    }                    
                }
            }

            $this->load->view("student_account_edit_page", $data);
        }
    }

    public function createuseradmin(){
    	$data = array();
    	$sql = "select * from groups where id in(2,3,4)";
    	$query = $this->db->query($sql);
    	$i = 0;
    	foreach($query->result() as $row){
    		$data["result"][$i]["id"] = $row->id;
    		$data["result"][$i]["name"] = $row->name;
    		$i++;
    	}
    	$this->load->view("admin_create_user", $data);
    }

    public function editadminuser(){
        $id = $this->input->get("id");        
        $data = array();
        $s = "select u.username,u.password,u.id, g.id as g_id from users u inner join groups g on g.id=u.group_id where u.id = {$id}";
        $query = $this->db->query($s);
        foreach($query->result() as $row){
            $data["result"]["username"] = $row->username;
            $data["result"]["password"] = $row->password;
            $data["result"]["id"] = $row->id;
            $data["result"]["g_id"] = $row->g_id;
        }
        $sg = "select * from groups where id in(2,3,4)";
        $q = $this->db->query($sg);
        $i = 0;
        foreach($q->result() as $r){
            $data["result"]["groups"][$i]["id"] = $r->id;
            $data["result"]["groups"][$i]["name"] = $r->name;
            $i++;
        }
        $this->load->view("admin_update_user", $data);
    }

    public function admindeleteuser(){
        $id = $this->input->post("id");
        $s = "update users set isactive = 0 where id = {$id}";
        if($this->db->query($s)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }

    public function studentdeleteuser(){
        $id = $this->input->post("id");
        $s = "update users set isactive = 0 where id = {$id}";
        if($this->db->query($s)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }
    public function adminuserupdate(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $groupid = $this->input->post("groupid");
        $userid = $this->input->post("userid");
        $s = "update users set username = '{$username}', password = '{$password}', group_id = {$groupid} where id = {$userid}";
        if($this->db->query($s)){
            echo json_encode(array("success"=>1));
        }else{
            echo json_ncode(array("success"=>0));
        }
    }
    public function adduser(){
    	$data = array();
    	$username = $this->input->post("username");
    	$password = $this->input->post("password");
    	$groupid = $this->input->post("groupid");
    	$checkuser = "select * from users where username = '{$username}'";
    	$q = $this->db->query($checkuser);
    	if($q->num_rows >= 1){
    		$data["result"]["success"] = 0;
    		$data["result"]["message"] = "User already exists.";
    	}else{
    		$sql = "insert into users(username,password,group_id,last_login,isactive) values('{$username}','{$password}',{$groupid},now(),1)";
	    	$query = $this->db->query($sql);
	    	if($query){
	    		$data["result"]["success"] = 1;
	    	}
    	}
    	echo json_encode($data);    	
    }

    public function addstudentgroup(){
        $this->load->view("addstudentgroup_page");
    }
    public function createstudentgroup(){
        $name = $this->input->post("name");
        $sql = "insert into student_groups(name) values('{$name}')";
        $query = $this->db->query($sql);
        if($query){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0));
        }
    }

    public function addstudent(){
        $data = array();
        $st = "select * from student_groups";
        $query = $this->db->query($st);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"][$i]["name"] = $row->name;
            $data["result"][$i]["id"] = $row->id;
            $i++;
        }
        $this->load->view("addstudent_page", $data);
    }

    public function createstudent(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $name = $this->input->post("name");
        $stud_group = $this->input->post("stud_group");
        $sql = "insert into users(username,password,tmpname,group_id,student_group_id,last_login,isactive) values('{$username}','{$password}','{$name}',1,{$stud_group},now(),1)";
        $query = $this->db->query($sql);
        if($query){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0,"message"=>"Server error, try again later."));
        }
    }
    public function updatestudentaccount(){
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $name = $this->input->post("name");
        $stud_group = $this->input->post("stud_group");
        $id = $this->input->post("id");
        $sql = "update users set username = '{$username}',password='{$password}',tmpname='{$name}',student_group_id={$stud_group} where id = {$id}";
        $query = $this->db->query($sql);
        if($query){
            echo json_encode(array("success"=>1));
        }else{
            echo json_encode(array("success"=>0,"message"=>"Server error, try again later."));
        }
    }
}