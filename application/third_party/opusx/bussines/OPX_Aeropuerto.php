<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Aeropuerto{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('aeropuerto');		
	}
	
	public function add_aeropuerto( $aeropuerto ){
		if($this->CI->aeropuerto->set_aeropuerto( $aeropuerto))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_aeropuerto( $aeropuerto ){
		if($this->CI->aeropuerto->update_aeropuerto($aeropuerto) > 0)
			return TRUE;
		else 
			return FALSE;
	}	
	
	public function list_aeropuertos(){
		return $this->CI->aeropuerto->get_list_aeropuertos();
	}
}