<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Puerto{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('puerto');		
	}
	
	public function add_puerto( $puerto ){
		if($this->CI->puerto->set_puerto($puerto))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_puerto( $puerto ){
		if($this->CI->puerto->update_puerto($puerto) > 0)
			return TRUE;
		else 
			return FALSE;
	}
	
	public function list_puertos(){
		return $this->CI->puerto->get_list_puertos();
	}
}