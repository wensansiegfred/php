<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filemanagement extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');        
    }

    public function uploaddeliverableform(){
    	$id = $this->input->get("id");
    	$u_group = $this->session->userdata("groupid");
    	$data["result"]["d_id"] = $id;
    	$data["result"]["s_group_id"] = $u_group;
    	$s = "select * from deliverables where id= {$id}";
    	$query = $this->db->query($s);
    	foreach($query->result() as $row){
    		$data["result"]["d_name"] = $row->description;
    	}
    	$this->load->view("student_deliverable_upload_form", $data);
    }

    public function uploadstudentdeliverable(){
        $error = false;
        $msg = "";
        $id = $this->input->post("d_id");
        $notes = $this->input->post("notes");
        $isupdate = $this->input->post("isupdate");
        $stu_group_id = $this->session->userdata("studentgroupid");
        //config settings
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'doc|DOC|docx|DOCX|xls|pdf|txt';
        $config['max_size']  = 1024 * 20;
        $config['encrypt_name'] = TRUE;
        // $_file = explode(".", $_FILES['userfile']['name']);        
        // $config["file_name"] = $_file[0] . "_" . $id . "_" . $stu_group_id;

        $this->load->library('upload', $config); 

        if(!$this->upload->do_upload("userfile")){
            $error = true;
            $msg = $this->upload->display_errors('', '');
        }else{
            $data = $this->upload->data();
                      
            $f_name = $data['file_name'];
            $r_name = $data['orig_name']; 
            $f_ext = $data["file_ext"];
            if(!empty($isupdate)){
                $sql = "update student_deliverable set note = '{$notes}',filename='{$f_name}',file_extension='{$f_ext}',raw_name='{$r_name}' where id={$id}";
            }else{
                $sql = "insert into student_deliverable (student_group_id, deliverable_id, filename, file_extension, note, date_added, isvalid, raw_name, approved) values({$stu_group_id}, {$id}, '{$f_name}', '{$f_ext}', '{$notes}', now(), 1, '{$r_name}', 0)";
            }            
           
            if(!$this->db->query($sql)){
                $error = true;
                unlink($data['full_path']);
                $msg = "Something went wrong when saving the file, please try again.";
            }else{
                
            }
        }
        @unlink($_FILES["userfile"]);

        echo json_encode(array("status" => $error, "msg" => $msg));
    }

    public function download(){
        $id = $this->input->get("id");
        $sql = "select * from student_deliverable where id ={$id}";
        $query = $this->db->query($sql);
        $filename = "";
        $name = "";
        $ext = "";
        $dir = "./assets/uploads/";
        foreach($query->result() as $row){
            $filename = $row->filename;
            $name = $row->raw_name;
            $ext = $row->file_extension;
        }
        $ext = $this->getMime($ext);
        header("Content-disposition: attachment; filename=".$name);
        header("Content-type: application/" . $ext);
        readfile($dir . $filename);
    }

    private function getMime($ext){
        switch($ext){
            case ".docx":
            return "doc";
            break;
            case ".doc":
            return "doc";
            break;
            case ".xls":
            return "xls";
            break;
            case ".pdf":
            return "pdf";
            break;
        }
        return "doc";
    }
}