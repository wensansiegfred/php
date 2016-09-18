<?php
class Info extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('AZabbix');
	}
	
	public function index()
	{
		echo $this->azabbix->info();
	}
}