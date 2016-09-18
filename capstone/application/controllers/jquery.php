<?php
class Jquery extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->library('javascript');
       $this->load->library('javascript/jquery');
    }

    public function index(){
    	print_r($this->jquery);
    }
}