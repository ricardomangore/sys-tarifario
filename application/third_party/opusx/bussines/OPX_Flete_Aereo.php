<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Flete_Aereo{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('');		
	}
	
	public function add_flete_aereo( $flete_aereo ){
		if($this->CI->flete_aereo->set_flete_aereo( $flete_aereo))
			return TRUE;
		else
			return FALSE;
	}
	
	public function list_cargas_aereas(){
		return $this->CI->flete_aereo->get_list_fletes_aereos();
	}
}