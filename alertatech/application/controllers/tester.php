<?php
class Tester extends CI_Controller{

	public function __construct() {
		
		parent::__construct();
	}
	
	public function test() {
		
		$this->load->library('AZabbix');
		
		echo $this->azabbix->info();
	}
	
}