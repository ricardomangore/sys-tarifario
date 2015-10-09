<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class OPX_Region{

	private $CI;
	
	public function __construct(){
		$this->CI = & get_instance();
		$this->CI->load->model('region');		
	}
	
	public function add_region( $region ){
		if($this->CI->region->set_region(array('region' => $region)))
			return TRUE;
		else 
			return FALSE;
	}
	
	public function edit_region( $region ){
		if($this->CI->region->update_region($region) >= 0)
			return TRUE;
		else 
			return FALSE;
	}
	
	public function list_regiones(){
		return $this->CI->region->get_list_regiones();
	}
}