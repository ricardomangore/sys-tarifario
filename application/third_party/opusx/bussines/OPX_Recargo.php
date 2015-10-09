<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Recargo{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('recargo');		
	}
	
	public function add_recargo( $recargo ){
		if($this->CI->recargo->set_recargo($recargo))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_recargo( $recargo ){
		if($this->CI->recargo->update_recargo($recargo) >= 0)
			return TRUE;
		else 
			return FALSE;
	}
	
	public function list_recargos(){
		return $this->CI->recargo->get_list_recargos();
	}
}