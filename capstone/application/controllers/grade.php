<?php
class Grade extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
        $u_group = $this->session->userdata("groupid");
        if($u_group != 1 ){
            $this->load->view("group_grading_main_page");
        }
    }

    public function loadgroupgrade(){
        $data = array();
        $sql = "select * from new_group_grade_assessment";
        $query = $this->db->query($sql);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"]["gradinglist"][$i]["id"] = $row->id;
            $data["result"]["gradinglist"][$i]["title"] = $row->title;
            $data["result"]["gradinglist"][$i]["abbr"] = $row->abbr;
            $data["result"]["gradinglist"][$i]["pscore"] = $row->ps_score;
            $data["result"]["gradinglist"][$i]["gid"] = $row->group_grade_main;
            $i++;
        }

        $sql1 = "select * from student_groups";
        $query1 = $this->db->query($sql1);
        $x = 0;
        foreach($query1->result() as $r){
            $data["result"]["grouplist"][$x]["id"] = $r->id;
            $data["result"]["grouplist"][$x]["name"] = $r->name;
            $x++;
        }
        $data["result"]["title"] = array("Title Hearing", "Proposal Hearing", "Final Oral Defense");
        $this->load->view("group_grading_assessment", $data);
    }
  //   public function index(){
  //   	$data = array();
  //   	$id = $this->session->userdata("userid");
  //   	$st = "select u.group_id,a.first_name,a.last_name from users u inner join accounts a on u.account_id = a.id where u.id = {$id}";
  //   	$query_user = $this->db->query($st);
  //   	$group_id = "";
		// foreach($query_user->result() as $row){
		//     $group_id = $row->group_id;
		// }

		// if($group_id == 2 || $group_id == 3){//if project adviser /subject adviser
  //           $data = array();
  //           $st = "select * from student_groups";
  //           $query = $this->db->query($st);
  //           $i = 0;
  //           foreach($query->result() as $row){
  //               $data["result"]["groups"][$i]["name"] = $row->name;
  //               $data["result"]["groups"][$i]["id"] = $row->id;
  //               $s = "select * from users where student_group_id = '{$row->id}' and isactive = 1";
  //               $q = $this->db->query($s);
  //               $x = 0;
  //               foreach($q->result() as $r){
  //                  $data["result"]["groups"][$i]["students"][$x]["name"] = $r->tmpname;
  //                  $data["result"]["groups"][$i]["students"][$x]["id"] = $r->id;
  //                  $x++; 
  //               }
  //               $i++;
  //           }
  //           $this->load->view("adviser_grade_page", $data);            
  //       }
  //   }

    //Class Record
    public function viewclassrecord(){
        $data = array();
        //$sql = "select u.id,a.first_name,a.last_name,a.course from users u inner join accounts a on u.account_id=a.id where u.group_id=1";
        $sql = "select u.id,a.first_name,a.last_name,a.course,sa.grade_id,sa.grade_value,sal.title from users u 
                inner join accounts a on u.account_id=a.id
                inner join sa_grades sa  on u.id=sa.student_id
                inner join sa_grade_list sal on sa.grade_id=sal.id
                where u.group_id=1";

        $query = $this->db->query($sql);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"]["list"][$row->id]["name"] = $row->first_name . " " . $row->last_name;
            $data["result"]["list"][$row->id]["course"] = $row->course;
            $data["result"]["list"][$row->id]["id"] = $row->id;
            $data["result"]["list"][$row->id]["grades"][$i]["gradeid"] = $row->grade_id;
            $data["result"]["list"][$row->id]["grades"][$i]["gradevalue"] = $row->grade_value;
            $i++;
        }

       $this->load->view("adviser_class_record", $data);
    }

    //Group
    public function groupgradeform(){
    	$id = $this->input->get("id");
    	$data = array();
    	$sql = "select * from grade_from";
    	$query = $this->db->query($sql);
    	$i = 0;
    	foreach($query->result() as $row){
    		$data["result"]["list"][$i]["name"] = $row->name;
    		$data["result"]["list"][$i]["id"] = $row->id;
    		$i++;
    	}
    	$data["result"]["id"] = $id;
    	$this->load->view("group_grade_form", $data);
    }
    //Student individual
    public function studentgradeform(){
        $u_group = $this->session->userdata("groupid");
    	$id = $this->input->get("id");
    	$data = array();
        //Project adviser
        if($u_group == 2){
            $sql = "select * from grade_from where from_table != 'pa_grade_list'";
        }else{
           $sql = "select * from grade_from where from_table != 'sa_grade_list'"; 
       }    	
    	$query = $this->db->query($sql);
    	$i = 0;
    	foreach($query->result() as $row){
    		$data["result"]["list"][$i]["name"] = $row->name;
    		$data["result"]["list"][$i]["id"] = $row->id;
    		$i++;
    	}
    	$data["result"]["id"] = $id;
    	$this->load->view("student_grade_form", $data);
    }

    public function studentgradingformload(){
    	$student_id = $this->input->get("s_id");
    	$tograde = $this->input->get("id_g");
    	$sql = "select * from grade_from where id = {$tograde}";       
    	$query = $this->db->query($sql);
    	$table_name = "";
    	foreach($query->result() as $row){
    		$table_name = $row->from_table;
    	}
    	$data = array();
        if($tograde == 5 || $tograde == 6){
            $sql2 = "select * from {$table_name}";           
            $query2 = $this->db->query($sql2);
            $i = 0;
            foreach($query2->result() as $row2){
                $data["result"]["list"][$i]["name"] = $row2->title;
                $data["result"]["list"][$i]["id"] = $row2->id;
                $data["result"]["list"][$i]["ps_score"] = $row2->ps_score;
                $i++;
            }
        }
    	else if(!empty($table_name)){
    		$sql2 = "select * from oral_examination";    		
    		$query2 = $this->db->query($sql2);
    		$i = 0;
    		foreach($query2->result() as $row2){
    			$data["result"]["list"][$i]["name"] = $row2->title;
    			$data["result"]["list"][$i]["id"] = $row2->id;
    			$data["result"]["list"][$i]["ps_score"] = $row2->ps_score;
    			$i++;
    		}
    	}
    	$data["result"]["student_id"] = $student_id;
    	$data["result"]["from_table"] = $tograde;

    	$this->load->view("adviser_grade_set_form_student", $data);
    }

    public function groupgradingformload(){
    	$gid = $this->input->get("id");
    	$tograde = $this->input->get("g");//(Title HEaring etc)
    	$sql = "select * from grade_from where id = {$tograde}";
    	$query = $this->db->query($sql);
    	$table_name = "";
    	foreach($query->result() as $row){
    		$table_name = $row->from_table;
    	}
    	$data = array();
    	if(!empty($table_name)){
    		$sql2 = "select * from {$table_name}";    		
    		$query2 = $this->db->query($sql2);
    		$i = 0;
    		foreach($query2->result() as $row2){
    			$data["result"]["list"][$i]["name"] = $row2->title;
    			$data["result"]["list"][$i]["id"] = $row2->id;
    			$data["result"]["list"][$i]["ps_score"] = $row2->ps_score;
    			$i++;
    		}
    	}
    	$data["result"]["student_group"] = $gid;
    	$data["result"]["from_table"] = $tograde;

    	$this->load->view("adviser_grade_set_form", $data);
    }

    public function groupsavegrade(){
    	$inputdata = $this->input->post("data");
    	$g = $this->input->post("g");
    	$student_group_id = $this->input->post("group");

    	//getting the group number of current user
    	$id = $this->session->userdata("userid");
    	$st = "select u.group_id,a.first_name,a.last_name from users u inner join accounts a on u.account_id = a.id where u.id = {$id}";
    	$query_user = $this->db->query($st);
    	$group_id = "";
		foreach($query_user->result() as $row){
		    $group_id = $row->group_id;
		}

		$sql_grade_check = "select * from group_grades where student_group_id = {$student_group_id} and grade_group_id = {$g}";
		$query = $this->db->query($sql_grade_check);
		
		$d = array();
		//update
		if($query->num_rows > 0){
			if($group_id == 2 || $group_id == 3 || $group_id == 4){
				$i = 0;
				foreach($inputdata as $key=>$val){
					$d[$i] = array(
						"student_group_id" => $student_group_id,
						"grade_group_id" => $g,
						"who_graded_id" => $group_id,
						"grade_id" => $val["id"],
						"grade_value" => $val["val"]
					);
					$i++;
				}
				 if($this->db->update_batch("group_grades", $d)){
            		echo json_encode(array("success"=>1));
		        }else{
		            echo json_encode(array("success"=>0,"message"=>"error"));
		        }
			}
		}else{ //save
			if($group_id == 2 || $group_id == 3 || $group_id == 4){
				$i = 0;
				foreach($inputdata as $key=>$val){
					$d[$i] = array(
						"student_group_id" => $student_group_id,
						"grade_group_id" => $g,
						"who_graded_id" => $group_id,
						"grade_id" => $val["id"],
						"grade_value" => $val["val"]
					);
					$i++;
				}
				 if($this->db->insert_batch("group_grades", $d)){
            		echo json_encode(array("success"=>1));
		        }else{
		            echo json_encode(array("success"=>0));
		        }
			}
		}
		
    }

    public function studentsavegrade(){        
        $inputdata = $this->input->post("data");
        $id_g = $this->input->post("id_g");
        $student_id = $this->input->post("student_id");
        $t = "";
        if($id_g == 5){
            $t = "sa_grades";
        }else if($id_g == 6){
            $t = "pa_grades";
        }else{
            $t = "student_grades";
        }
        //getting the group number of current user
        $id = $this->session->userdata("userid");
        $st = "select u.group_id,a.first_name,a.last_name from users u inner join accounts a on u.account_id = a.id where u.id = {$id}";
        $query_user = $this->db->query($st);
        $group_id = "";
        foreach($query_user->result() as $row){
            $group_id = $row->group_id;
        }
        if($id_g == 5 || $id_g == 6){
            $sql_grade_check = "select * from {$t} where student_id = {$student_id} and grade_id = {$id_g}";
        }else{
            $sql_grade_check = "select * from {$t} where student_id = {$student_id} and grade_from_id = {$id_g}";
        }
        
        $query = $this->db->query($sql_grade_check);
        
        $d = array();
        //update
        if($query->num_rows > 0){
            if($group_id == 2 || $group_id == 3 || $group_id == 4){
                $i = 0;
                foreach($inputdata as $key=>$val){
                    $d[$i] = array(
                        "student_id" => $student_id,
                        "grade_from_id" => $id_g,
                        "who_graded_id" => $group_id,
                        "grade_id" => $val["id"],
                        "grade_value" => $val["val"]
                    );
                    $i++;
                }
                 if($this->db->update_batch($t, $d)){
                    echo json_encode(array("success"=>1));
                }else{
                    echo json_encode(array("success"=>0,"message"=>"error"));
                }
            }
        }else{ //save
            if($group_id == 2 || $group_id == 3 || $group_id == 4){
                $i = 0;
                if($id_g == 5 || $id_g == 6){
                    foreach($inputdata as $key=>$val){
                        $d[$i] = array(
                            "student_id" => $student_id,                            
                            "grade_id" => $val["id"],
                            "grade_value" => $val["val"]
                        );
                        $i++;
                    }
                }else{
                      foreach($inputdata as $key=>$val){
                        $d[$i] = array(
                            "student_id" => $student_id,
                            "grade_from_id" => $id_g,
                            "who_graded_id" => $group_id,
                            "grade_id" => $val["id"],
                            "grade_value" => $val["val"]
                        );
                        $i++;
                    }
                }                 
                if($this->db->insert_batch($t, $d)){
                    echo json_encode(array("success"=>1));
                }else{
                    echo json_encode(array("success"=>0));
                }
            }
        }
        
    }
}