<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 
 * user Controller user.php
 * this will handle all request regarding user
 * 
 */

class User extends CI_Controller
{
	private $data;
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->library("userlib");		
		$this->data['page'] = 'home';
		$this->data['menu'] = array('home','about','support','clients','contact','setup');
	}
	
	public function login_old()
	{
		$jscripts = array("media/jquery/js/jquery-1.5.1.min.js",
						  "media/jquery/js/jquery.sha1.js",
						  "media/js/functions.js"
		);
		$css = array("media/css/styles.css");
		$this->data["doctype"] = $this->layout->loadDoctype();
		$this->data["header"] = $this->layout->loadHeader($jscripts,$css);
		$this->data["footer"] = $this->layout->loadFooter();
		
		$this->load->view("login",$this->data);
	}
	
	public function login() {
		
		$this->load->view('forms/login.php');
		
	}
	public function validate()
	{		
		$user = array(
				'email_address'=>$this->input->post("memuser"),
				'password'=>sha1($this->input->post("mempass"))
		);
		$userDetails = $this->userlib->validateuser($user);
		if(!empty($userDetails))
		{
			$this->load->library("session");
			$this->session->set_userdata($userDetails);
			
			echo $this->jasonize(array('ok'=>'ok','redirect'=>'setup'));
		}
		else
		{
			echo $this->jasonize(array('error'=>'Invalid username/password, please try again.'));
		}
	}
	
	private function jasonize($message=array())
	{
		return $_GET['callback'].'('.json_encode($message).')';
	}
}
?>