<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Naviera{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('naviera');		
	}
	
	public function add_naviera( $naviera ){
		if($this->CI->naviera->set_naviera(array('naviera' => $naviera)))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_naviera( $naviera ){
		if($this->CI->naviera->update_naviera($naviera) >= 0)
			return TRUE;
		else 
			return FALSE;
	}
	
	public function list_navieras(){
		return $this->CI->naviera->get_list_navieras();
	}
}