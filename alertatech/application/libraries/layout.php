<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 
 * 
 * default layout
 * 
 * 
 */
class Layout
{
	private $objinstance;
	private $doctype;
	private $header;
	private $footer;
	
	public function __construct()
	{
		$this->objinstance =& get_instance(); 
		$this->objinstance->load->helper("url");
	}
	
	public function loadDoctype() 
	{
		$this->doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						 <html xmlns="http://www.w3.org/1999/xhtml">';
		return $this->doctype;
	}
	
	public function loadHeader($jscript=array(),$cssarr = array())
	{		
		$this->header = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    					 <title>Alert A Tech</title>';
		if(!empty($jscript))
		{
			foreach($jscript as $key=>$scripts)
			{
				$this->header.= '<script language="javascript" type="text/javascript" src="';
				$this->header.= base_url().$scripts.'"></script>';
			}
		}
		if(!empty($cssarr))
		{
			foreach($cssarr as $key=>$css)
			{
				$this->header.= '<link rel="stylesheet" href="';
				$this->header.= base_url().$css.'"/>';
			}
		}
		return $this->header;
	}
	
	public function loadFooter()
	{
		$signup_form = '<div id="signup-form-dialog" title="Sign up with Alert A Tech"><div id="sign-up-form"></div></div>';
		$login_form = '<div id="login-form-dialog" title="Member Login"><div id="login-form"></div></div>';
		$this->footer = $signup_form.$login_form.'<div class="right copyright">
        					Copyright 2010 by Alert A Tech Services &bull; All Rights Reserved
        				 </div>
    					</div>
						<div style="height:30px;"></div>
						</div>						
					</body>
					</html>';		
		return $this->footer;
	}
}
?>