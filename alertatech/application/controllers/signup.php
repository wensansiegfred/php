<?php 
/**
 * 
 * Sign Up controller signup.php
 * 
 */

class Signup extends CI_Controller
{
	private $data;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->database();
		$this->data['page'] = 'home';
		$this->data['menu'] = array('home','about','support','clients','contact','setup');
	}
	
	public function index()
	{
		
		/*$jscripts = array("media/jquery/js/jquery-1.5.1.min.js",
						  "media/js/functions.js"
		);
		$css = array("media/css/styles.css",
					"media/jquery/themes/base/jquery.ui.all.css"
		);
		$this->data["doctype"] = $this->layout->loadDoctype();
		$this->data["header"] = $this->layout->loadHeader($jscripts,$css);
		$this->data["footer"] = $this->layout->loadFooter();
		$this->load->view("sign_up_view_select",$this->data);*/
		$this->usersignup();
	}
	
	public function usersignup()
	{
		$data = array();
		$countrylist = $this->db->get('countrylist');
		$i = 0;
		foreach($countrylist->result_array() as $rows)
		{
			$data['country'][$i]['countrycode'] = $rows['countrycode'];
			$data['country'][$i]['countryname'] = $rows['countryname'];
			$i++;
		}
		$this->load->view("/forms/free_signup_form",$data);
	}
	
	public function createfree()
	{
		$this->load->library("userlib");
		$message['res'] = "";
		$user = array(
			"email" => $this->input->post('email'),
			"password" => $this->input->post('password'),
			"name" => $this->input->post("name"),
			"company" => $this->input->post("company"),
			"address" => $this->input->post("address"),
			"city" => $this->input->post("city"),
			"state" => $this->input->post("state"),
			"postalcode" => $this->input->post("postalcode"),
			"country" => $this->input->post("country"),
			"timezone" => $this->input->post("timezone"),
			"alertemail" => $this->input->post("alertemail"),
			"free" => true	
		);
		
		if($this->userlib->createuser($user))
		{
			$message['res'] = "SUCCESS";
		}
		else
		{
			$message['res'] = $this->userlib->_get_error();
		}
		
		echo $message['res'];//return message*/
	}
	
	private function jasonize($message = "")
	{
		return json_encode($message);
	}
}
?>