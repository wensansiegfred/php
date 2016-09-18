<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller{
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
   }

   public function index(){
   		$this->session->sess_destroy();
   		echo json_encode(array("success"=>1));
   }
}