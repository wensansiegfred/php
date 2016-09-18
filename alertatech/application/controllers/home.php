<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    private $data = array();
    
	public function __construct() {
		parent::__construct();
        $this->load->helper('url');
		$this->load->helper('defines');
        $this->data['page'] = 'home';
        $this->load->helper('form');
		$this->load->library(array('encrypt', 'form_validation', 'session', 'layout'));
        $this->load->database();
        $this->data['menu'] = array('home','about','support','clients','contact','setup');
	}

    private function loadPage($page) {
        $this->data['page'] = $page;
		$this->load->view('home', $this->data);
    }

    public function index() {
        $jscripts = array("media/jquery/js/jquery-1.5.1.min.js",
        				  "media/jquery/js/jquery.bgiframe-2.1.2.js",
        				  "media/jquery/ui/jquery.ui.core.js",
        				  "media/jquery/ui/jquery.ui.widget.js",
        				  "media/jquery/ui/jquery.ui.mouse.js",
        				  "media/jquery/ui/jquery.ui.button.js",
        				  "media/jquery/ui/jquery.ui.draggable.js",
        				  "media/jquery/ui/jquery.ui.position.js",
        				  "media/jquery/ui/jquery.ui.resizable.js",
        				  "media/jquery/ui/jquery.ui.dialog.js",
        				  "media/jquery/ui/jquery.effects.core.js",
        				  "media/js/jquery.validate.js",
						  "media/js/functions.js"
		);
		$css = array("media/css/styles.css",
					 "media/jquery/themes/base/jquery.ui.all.css",
		);
		$this->data["doctype"] = $this->layout->loadDoctype();
		$this->data["header"] = $this->layout->loadHeader($jscripts,$css);
		$this->data["footer"] = $this->layout->loadFooter();
        $this->loadPage('home',$this->data);
    }

    public function about() {
        $this->loadPage('about');
    }

    public function support() {
		$this->data['spage'] = "faq";
        $this->loadPage('support');
    }

    public function clients() {
        $this->loadPage('clients');
    }

    public function contact() {
        $this->loadPage('contact');
    }
    
    public function signup()
    {
        $this->loadPage('signup');
    }
    
    public function login()
    {
        redirect("/user/login");
    }

    function logout()
    {
        if (!isset($this->session))
            $this->load->library('session');
        $this->session->sess_destroy();
        redirect('home');
    }
}
