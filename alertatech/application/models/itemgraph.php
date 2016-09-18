<?php
class Itemgraph extends CI_Model
{
	private $result = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItem($history)
	{
		
		if(!empty($history))
		{
			foreach($history as $key=>$value)
			{
				$curtime = date("Y-m-d H:i:s",$value['clock']);
				$this->result[$value['itemid']][$curtime] = $value['value'];
			}
		}
		
		return $this->result;
	}
}
?>