<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {

    private $data = array();
    
	public function __construct() {
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('defines');
        $this->data['page'] = 'home';
		$this->data['spage'] = 'faq';
		$this->data['menu'] = array('home','about','support','clients','contact','setup');
	}

    private function loadPage($page) {
        $this->data['page'] = $page;
		$this->load->view('home', $this->data);
    }

    public function index() {
		$this->data['spage'] = "faq";
        $this->loadPage('home');
    }

    public function faq() {
		$this->data['spage'] = "faq";
		$this->loadPage('support');
    }
    public function pricing_info() {
		$this->data['spage'] = "pricing_info";
		$this->loadPage('support');
    }
    public function free_signup() {
		//$this->data['spage'] = "free_signup";
		//$this->loadPage('support');
        redirect('signup');
    }
    public function paid_signup() {
		$this->data['spage'] = "paid_signup";
		$this->loadPage('support');
    }
    public function billing() {
		$this->data['spage'] = "billing";
		$this->loadPage('support');
    }
}
