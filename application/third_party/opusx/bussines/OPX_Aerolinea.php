<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Aerolinea{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('aerolinea');		
	}
	
	public function add_aerolinea( $aerolinea ){
		if($this->CI->aerolinea->set_aerolinea( $aerolinea))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_aerolinea( $aerolinea ){
		if($this->CI->aerolinea->update_aerolinea($aerolinea) >= 0)
			return TRUE;
		else 
			return FALSE;
	}	
	
	public function list_aerolineas(){
		return $this->CI->aerolinea->get_list_aerolineas();
	}
}