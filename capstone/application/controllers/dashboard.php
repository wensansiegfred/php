<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function sendchatmessage(){
        $data = array();
        $id = $this->session->userdata("userid");
        $msg = $this->input->post("mes");
        $sql = "insert into messaging(user_id,message,date_added) values({$id}, '{$msg}', now())";
        $this->db->query($sql);

        $sql1 = "select m.message,m.date_added,ac.first_name,ac.last_name from messaging m inner join users u on m.user_id=u.id
                inner join accounts ac on u.account_id=ac.id order by date_added DESC limit 30";
        $query = $this->db->query($sql1);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"][$i]['message'] = $row->message;
            $data["result"][$i]["date_added"] = $row->date_added;
            $data["result"][$i]["name"] = $row->first_name . " " .$row->last_name;
            $i++;
        }
        $this->load->view("dashboard_home_msg", $data); 
    }

    public function updatechatmessage(){
        $data = array();
        $sql1 = "select m.message,m.date_added,ac.first_name,ac.last_name from messaging m inner join users u on m.user_id=u.id
                inner join accounts ac on u.account_id=ac.id order by date_added DESC limit 30";
        $query = $this->db->query($sql1);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"][$i]['message'] = $row->message;
            $data["result"][$i]["date_added"] = $row->date_added;
            $data["result"][$i]["name"] = $row->first_name . " " .$row->last_name;
            $i++;
        }
        $this->load->view("dashboard_home_msg", $data); 
    }

    public function home(){
        $data = array();
        $sql = "select m.message,m.date_added,ac.first_name,ac.last_name from messaging m inner join users u on m.user_id=u.id
                inner join accounts ac on u.account_id=ac.id order by date_added DESC limit 30";
        $query = $this->db->query($sql);
        $i = 0;
        foreach($query->result() as $row){
            $data["result"][$i]['message'] = $row->message;
            $data["result"][$i]["date_added"] = $row->date_added;
            $data["result"][$i]["name"] = $row->first_name . " " .$row->last_name;
            $i++;
        }
        $this->load->view("dashboard_home", $data);
    }

    public function index(){
    	$id = $this->session->userdata("userid");
        $u_group = $this->session->userdata("groupid");
    	$data = array();
    	
    	$group_id = "";
    	if(empty($id)){
    		redirect("login", 'refresh');
    	}else{
    		$data["result"]["userid"] = $id;
    		$st = "select u.group_id,a.first_name,a.last_name from users u inner join accounts a on u.account_id = a.id where u.id = {$id}";
    		$query_user = $this->db->query($st);
    		foreach($query_user->result() as $row){
			    $data["result"]["info"]["firstname"] = $row->first_name;
			    $data["result"]["info"]["lastname"] = $row->last_name;
			    $group_id = $row->group_id;
			}
            if(empty($data["result"]["info"])){
                redirect("profile", 'refresh');
            }else{
                $st1 = "select * from menus where group_id = {$group_id} and isactive = 1";
                $query_menu = $this->db->query($st1);
                foreach($query_menu->result() as $row1){
                    $data["result"]["menus"][] = array("name"=>$row1->name,"links"=>$row1->link);
                }
                //get alerts
                if($u_group == 1){
                    $st2 = "SELECT fromtable, COUNT( * ) as cnt FROM  alerts WHERE student_group = {$group_id} GROUP BY fromtable";
                }else{
                    $st2 = "SELECT fromtable, COUNT( * ) as cnt FROM  alerts WHERE p_group = {$u_group} GROUP BY fromtable";
                }
                
                $query_alerts = $this->db->query($st2);
                $a = 0;
                $total_alerts = 0;
                foreach($query_alerts->result() as $r_alerts){
                    $data["result"]["alerts"][$a]["table"] = $r_alerts->fromtable;
                    $data["result"]["alerts"][$a]["count"] = $r_alerts->cnt;
                    $total_alerts += $data["result"]["alerts"][$a]["count"];
                    $a++;
                }
                $data["result"]["group_id"] = $u_group;
                $data["result"]["total_alerts"] = $total_alerts;                   
                $this->load->view("dashboard_page",$data);
            }			
    	}
    }
}