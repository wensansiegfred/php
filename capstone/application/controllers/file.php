<?php
class File extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
        
    }
}