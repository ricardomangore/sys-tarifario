<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Flete_Maritimo{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('');		
	}
	
	public function add_flete_maritimo( $flete_maritimo ){
		if($this->CI->flete_maritimo->set_flete_maritimo( $flete_maritimo))
			return TRUE;
		else
			return FALSE;
	}
	
	public function list_cargas_aereas(){
		return $this->CI->flete_maritimo->get_list_fletes_aereos();
	}
}