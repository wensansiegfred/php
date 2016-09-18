<?php
class Dbtest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function index()
	{
		$data = array(
				"testid"=>rand(0,99999999999));
		$this->db->insert('testtable',$data);
		echo "<pre>";
		print_r($this->db->get('testtable'));
	}
}
?>