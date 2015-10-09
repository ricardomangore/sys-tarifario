<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Carga_Aerea{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('carga_aerea');		
	}
	
	public function add_carga_aerea( $carga_aerea ){
		if($this->CI->carga_aerea->set_carga_aerea( $carga_aerea))
			return TRUE;
		else
			return FALSE;
	}
	
	public function list_cargas_aereas(){
		return $this->CI->carga_aerea->get_list_cargas_aereas();
	}
}